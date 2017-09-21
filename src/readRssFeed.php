<?php
require('./settingFeed.php');

class execFeed
{
    // 収集RSSデータ配列
    private $rssDataList;
    // フォーマットデータ配列
    private $customizeDataList;
    // SettingFeedクラスオブジェクト
    private $settingFeed;
    // 出力先ディレクトリ
    private $exportDir;
    // 出力先ファイル名
    private $exportFileName;

    /**
     * __construct
     * コンストラクタ
     *
     */
    function __construct() {
        $this->settingFeed      = new settingFeed();
        $this->rssDataList      = $this->settingFeed->getRssDataList();
        $this->exportDir        = $this->settingFeed->getExportDir();
        $this->exportFileName   = $this->settingFeed->getExportFileName();
    }

    /**
     * customizeRss
     * 指定RSSデータ整形
     *
     */
    function customizeRss(){
        $rssIndex = 0;
        for ($i = 0; $i < count($this->rssDataList); $i++){
            $rssData = simplexml_load_string(file_get_contents($this->rssDataList[$i]["url"])); 

            if ($rssData->entry){
                // atom
                foreach ($rssData->entry as $entry){
                    // ユーザ名
                    $this->customizeDataList[$rssIndex]["author"] = $this->rssDataList[$i]["name"];
                    // タイトル
                    $this->customizeDataList[$rssIndex]["title"] = (string)$entry->title;
                    // リンク
                    $this->customizeDataList[$rssIndex]["link"] = (string)$entry->link['href'];
                    // 日付
                    $this->customizeDataList[$rssIndex]["date"] = strtotime((string)$entry->updated);
                    // 本文
                    $this->customizeDataList[$rssIndex]["description"] = (string)$entry->summary;
                    $rssIndex++;
                }
            } else if ($rssData->item){
                // rss1.0
                 foreach ($rssData->item as $entry){
                    if(preg_match("/^PR:.+/",$entry->title)) {
                        continue;
                    }
                    // ユーザ名
                    $this->customizeDataList[$rssIndex]["author"] = $this->rssDataList[$i]["name"];
                    // タイトル
                    $this->customizeDataList[$rssIndex]["title"] = (string)$entry->title;
                    // リンク
                    $this->customizeDataList[$rssIndex]["link"] = (string)$entry->link;
                    // 日付
                    $this->customizeDataList[$rssIndex]["date"] = strtotime((string)$entry->children("http://purl.org/dc/elements/1.1/")->date);
                    // 本文
                    $this->customizeDataList[$rssIndex]["description"] = (string)$entry->description;
                    $rssIndex++;
                }
            } else if ($rssData->channel->item){
                // rss2.0
                foreach ($rssData->channel->item as $entry){
                    // ユーザ名
                    $this->customizeDataList[$rssIndex]["author"] = $this->rssDataList[$i]["name"];
                    // タイトル
                    $this->customizeDataList[$rssIndex]["title"] = (string)$entry->title;
                    // リンク
                    $this->customizeDataList[$rssIndex]["link"] = (string)$entry->link;
                    // 日付
                    $this->customizeDataList[$rssIndex]["date"] = strtotime((string)$entry->pubDate);
                    // 本文
                    $this->customizeDataList[$rssIndex]["description"] = (string)$entry->description;
                    $rssIndex++;
                }
            }
        }

        // ソート（時系列：新⇒古）
        $tmpFormattedDatas;
        foreach ((array) $this->customizeDataList as $key => $value) {
            $tmpFormattedDatas[$key] = $value["date"];
        }
        array_multisort($tmpFormattedDatas, SORT_DESC, $this->customizeDataList);
    }

    /**
     * exportCustomizeAtom
     * 編集済みRSS出力(ATOM形式)
     *
     */
    function exportCustomizeAtom(){

        // ATOM ヘッダー取得
        $xml .= $this->settingFeed->getAtomHeader();

        $feedCount = 0;

        // 記事別情報取得＆フォーマット(最大15記事分)
        foreach($this->customizeDataList as $f){
            if ($feedCount < 15){
                $xml .= "<entry>\n";
                $xml .= "<author>" . $f["author"] . "</author>\n";
                $xml .= "<title type='html'><![CDATA[" . $f["title"] . "]]></title>\n";
                $xml .= "<summary type='html'><![CDATA[" . $f["description"] . "]]></summary>\n";
                $xml .= "<link>" . $f["link"] . "</link>\n";
                $xml .= "<updated>" . date(DATE_ATOM, $f["date"]) . "</updated>\n";
                $xml .= "</entry>\n";
                $feedCount++;
            }
        }
        $xml .= "</feed>\n";

        // ファイル保存場所を設定
        $file = $this->exportDir . $this->exportFileName;

        // ファイル保存
        @file_put_contents($file , $xml);
    }
}

$execFeed = new execFeed();
// RSS記事データ収集
$execFeed->customizeRss();
// カスタマイズフィード出力
$execFeed->exportCustomizeAtom();

header("Location: http://www.oddeye.net"); exit();

?>
