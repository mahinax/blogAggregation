<?php
class settingFeed
{

    // RSS出力先ディレクトリ
    private $exportDir          = "./bsrStageCasts/";
    // RSS出力ファイル名
    private $exportFileName     = "index.rdf";

    // ATOM Feed ID
    private $atomFeedId         = "tag:oddeye.net:feed/";
    // ATOMタイトル
    private $atomFeedTitle      = "舞台戦国BASARAキャストフィード";

    // RSS一覧
    private $rssDataList = array(
        array(
            "name" => "久保田悠来",
            "url" => "http://rssblog.ameba.jp/kubotayuki0615/rss20.xml",
        ),
        array(
            "name" => "吉田友一",
            "url" => "http://tomokazu-diary.blog.houyhnhnm.jp/feed",
        ),
        array(
            "name" => "AKIRA",
            "url" => "https://lineblog.me/akiriot/index.rdf",
        ),
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
        array(
            "name" => "",
            "url" => "",
        )
    );

    /**
     * getExportDir
     * RSS出力先ディレクトリ取得
     *
     */
    function getExportDir(){
        return $this->exportDir;
    }

    /**
     * getExportFileName
     * RSS出力先ファイル名取得
     *
     */
    funtion getExportFileName(){
        return $this->exportFileName;
    }

    /**
     * getRssDataList
     * RSS一覧取得
     *
     */
    function getRssDataList(){
        return $this->rssDataList;
    }

    /**
     * getAtomHeader
     * ATOMヘッダー取得
     *
     */
    function getAtomHeader(){
        $xml  = "<?xml version='1.0' encoding='UTF-8'?>\n";
        $xml .= "<feed xmlns='http://www.w3.org/2005/Atom' xml:lang='ja'>\n";
        $xml .= "<id>" . $this->atomFeedId . "</id>\n";
        $xml .= "<title>" . $this->atomFeedTitle . "</title>\n";
        $xml .= "<updated>" . date(DATE_ATOM) . "</updated>\n";
        $xml .= "<link rel='alternate' type='text/html' href='https://www.oddeye.net/feed/' />\n";
        $xml .= "<link rel='self' type='application/atom+xml' href='https://www.oddeye.net/feed/atom.xml' />\n";
        return $xml;
    }
}

?>
