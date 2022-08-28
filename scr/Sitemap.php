<?php
namespace Sitemap;
/**
 * @version 1.0
 */
class Sitemap
{
    protected object $dom;
    protected object $urlset;


    /**
     * @throws DOMException
     */
    public function __construct()
    {
        $this->dom = new DOMDocument('1.0', 'utf-8');
        $this->urlset = $this->dom->createElement('urlset');
        $this->urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $this->dom->appendChild($this->urlset);
    }

    /**
     * @param $_date
     * @param $_link
     * @param null $_priority
     * @throws DOMException
     */
    public function add($_link, $_date, $_priority = NULL): void
    {
        $url = $this->dom->createElement('url');
        $loc = $this->dom->createElement('loc');
        $text = $this->dom->createTextNode($_link);
        $loc->appendChild($text);
        $url->appendChild($loc);
        $lastmod = $this->dom->createElement('lastmod');
        $text = $this->dom->createTextNode($_date);
        $lastmod->appendChild($text);
        $url->appendChild($lastmod);
        $priority = $this->dom->createElement('priority');
        $text = $this->dom->createTextNode(($_priority ?: '0.5'));
        $priority->appendChild($text);
        $url->appendChild($priority);
        $this->urlset->appendChild($url);
    }

    /**
     * @return bool|string
     */
    public function getBrowser(): bool|string
    {
        header('Content-Type: text/xml');
        return $this->dom->saveXML();
    }

    /**
     * @return bool|string
     */
    public function getFile(): bool|string
    {
        if ($this->dom->save($_SERVER['DOCUMENT_ROOT'] . '/sitemap.xml')) {
            return true;
        } else {
            return 'File save error';
        }
    }

}