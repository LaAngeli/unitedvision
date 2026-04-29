<?php


namespace app\services;

use DOMDocument;
use DOMXPath;


class DomService
{


    function filterHtml($options)
    {
        $dom = new DOMDocument;
        libxml_use_internal_errors(true);

        if (!strlen($options['html_string'])) {
            return false;
        }
        $html = $dom->loadHTML('<html>' . $options['html_string'] . '</html>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        if ($html) {
            foreach (iterator_to_array($dom->getElementsByTagName("*")) as $tag) {

                if (!in_array($tag->tagName, $options['allowed_tags'])) {

                    $tag->remove();
                } else {
                    foreach (iterator_to_array($tag->attributes) as $attr) {
                        if (!in_array($attr->nodeName, $options['allowed_attrs'])) {
                            $tag->removeAttribute($attr->nodeName);
                        }
                    }
                }
            }
        }

        $final_html = str_replace(array('<html>', '</html>'), '', $dom->saveHTML());


        return $final_html;
    }


    public function htmlStructure($options)
    {

        $dom = new DOMDocument();

        libxml_use_internal_errors(true);


        $dom->loadHTML('<html>' . $options['html_string'] . '</html>',  LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);


        $xpath = new DOMXPath($dom);


        $xpathQuery = "//text()";


        $textNodes = $xpath->query($xpathQuery);

        foreach ($textNodes as $textNode) {
            $textNode->nodeValue = '';
        }

        $modifiedHtml = str_replace(array('<html>', '</html>'), '', $dom->saveHTML());

        return $modifiedHtml;
    }



    public function compareHtmlStructure($options)
    {
        $html1 = $options['original_html'];

        $html2 = $options['client_html'];

        if ($this->htmlToString($html1) === $this->htmlToString($html2)) {
            return true;
        } else {
            return false;
        }
    }


    private function htmlToString($html)
    {
        return htmlspecialchars(preg_replace("/\s+|\n+|\r/", '', $html));
    }
}
