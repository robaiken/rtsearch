<?php
/**
 * Author: Rob Aiken
 * Datetime: 30/08/15 22:13
 */

namespace App;

use DOMElement;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class LinkDump {

    private $url;

    public function __construct( $url = null )
    {
        $this->setUrl( $url );
    }

    public function get()
    {
        $linkDump = $this->getLinkDump( $this->getPodcastPage() );
        return $this->pruneAdvertisers( $linkDump );
    }

        private function pruneAdvertisers( $linkDump )
        {
            $advertisers = ['HuluPlus','Audible'];
            foreach( $linkDump as $id => $link ){
                if( in_array( $link['name'], $advertisers ) ){
                    unset( $linkDump[ $id ] );
                }
            }
            return array_values( $linkDump );
        }

        private function getPodcastPage()
        {
            $client = new Client();
            $request = $client->get( $this->url );
            return $request->getBody( true )->getContents();
        }

        private function getLinkDump( $html )
        {
            $linkDump = [];
            $crawler = new Crawler( $html );
            $filter = $crawler->filter( 'aside.linkdump ul li' );
            foreach( $filter as $match ){
                $linkDump[] = $this->getLinkDumpArrayItem( $match );
            }
            return $linkDump;
        }

        /**
         * @param DomElement $match
         * @return array
         */
        private function getLinkDumpArrayItem( $match )
        {
            $url =  $match->getElementsByTagName('a')
                ->item(0)
                ->getAttribute('href');

            return [ 'name' => trim( $match->nodeValue ), 'url' => $url ];
        }

    public function setUrl( $url )
    {
        $this->url = $url;
        return $this;
    }

}