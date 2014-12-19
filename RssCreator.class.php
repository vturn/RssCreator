<?php
class RssCreator {
    var $rss_items = array();
    var $config = array();

    function __construct($config, $rss) {
        $this->config = $config;
        $this->rss_items = $rss;
    }

    public function create_feed() {
        $currTimeStr = date("D, d M Y H:i:s O");
        $generator = 'WebRSS Compiler 1.1';
        $ttl = 360;
        $xml = '<?xml version="1.0" encoding="utf-8"?>' . "\n";
        $xml .= '<rss version="2.0">' . "\n";
        // channel required properties
        $xml .= '<channel>' . "\n";
        $xml .= '<title>' . $this->config["channel"]["title"] . '</title>' . "\n";
        $xml .= '<link>' . $this->config["channel"]["link"] . '</link>' . "\n";
        $xml .= '<description><![CDATA[' . $this->config["channel"]["description"] . ']]></description>' . "\n";
        $xml .= '<lastBuildDate>' . $currTimeStr . '</lastBuildDate>' . "\n";
        $xml .= '<generator>' . $generator . '</generator>' . "\n";
        $xml .= '<ttl>' . $ttl . '</ttl>' . "\n";

        // get RSS channel items
        foreach ($this->rss_items as $rss_item) {
            $xml .= '<item>' . "\n";
            $xml .= '<title>' . htmlspecialchars(html_entity_decode($rss_item['title'])) . '</title>' . "\n";
            $xml .= '<link>' . $rss_item['link'] . '</link>' . "\n";
            $xml .= '<description><![CDATA[' . $rss_item['description'] . ']]></description>' . "\n";
            $xml .= '<published>' . $rss_item['published'] . '</published>' . "\n";
            $xml .= '</item>' . "\n";
        }
        $xml .= '</channel>';
        $xml .= '</rss>';
        return $xml;
    }
}
?>
