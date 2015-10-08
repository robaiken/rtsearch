<?php
/**
 * Author: Rob Aiken
 * Datetime: 30/08/15 19:08
 */

namespace App;

use Elasticsearch\ClientBuilder;

class Search {

    private $elasticSearch;

    public function __construct()
    {
        $this->elasticSearch = ClientBuilder::create()->build();
    }

    public function all()
    {
        $searchParams['body']['query']['match_all'] = [];
        return $this->elasticSearch->search( $searchParams )['hits'];
    }

    public function topic( $query )
    {
        return $this->elasticSearch->search( $this->buildTopicQuery( $query ) )['hits'];
    }

        private function buildTopicQuery( $query )
        {
            $searchParams = $this->getBaseSearchQuery();
            $searchParams['body']['query']['bool']['should'][]['match']['title'] = $query;
            $searchParams['body']['query']['bool']['should'][]['match']['linkDump.name'] = $query;
            $searchParams['body']['query']['bool']['should'][]['match']['linkDump.url'] = $query;

            $searchParams['body']['highlight']['tags_schema'] = 'styled';
            $searchParams['body']['highlight']['fields']['title'] = $this->getHighlightingArray();
            $searchParams['body']['highlight']['fields']['linkDump.name'] = $this->getHighlightingArray();
            $searchParams['body']['highlight']['fields']['linkDump.url'] = $this->getHighlightingArray();

            return $searchParams;
        }

    public function guests( $guests )
    {
        $guests = explode( ',', $guests );
        return $this->elasticSearch->search( $this->buildGuestsQuery( $guests ) )['hits'];
    }

        private function buildGuestsQuery( $guests )
        {
            $searchParams = $this->getBaseSearchQuery();
            $searchParams['body']['highlight']['fields']['guests'] = $this->getHighlightingArray();
            $searchParams['body']['highlight']['tags_schema'] = 'styled';

            foreach( $guests as $guest ) {
                $searchParams['body']['query']['bool']['should'][]['match']['guests'] = $guest;
            }

            return $searchParams;
        }


    private function getBaseSearchQuery()
    {
        $searchParams = [];
        $searchParams['index'] = 'podcasts';
        $searchParams['type'] = 'podcast';

        return $searchParams;
    }

    private function getHighlightingArray()
    {
        return ["pre_tags" => ["<em>"], "post_tags" => ["</em>"] ];
    }

}