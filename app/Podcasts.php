<?php
/**
 * Author: Rob Aiken
 * Datetime: 30/08/15 19:08
 */

namespace App;

use Elasticsearch\ClientBuilder;

class Podcasts {

    public static function all()
    {
        $elasticSearch = ClientBuilder::create()->build();

        $searchParams['body']['query']['match_all'] = [];
        $searchParams['body']['size'] = 10000;
        $searchParams['body']['sort'] = [ '_uid' => 'desc' ];
        $hits =  $elasticSearch->search( $searchParams )['hits'];
        return Podcasts::sortPodcastsByPodcastId( $hits );
    }

        /**
         * elastic search's id sort only sorts by alpha and not integer
         */
        private static function sortPodcastsByPodcastId( $podcasts )
        {
            usort( $podcasts['hits'], function( $a, $b ){
                return  $b['_id'] - $a['_id'];
            });

            return $podcasts;
        }

    public static function getGuests( $podcasts )
    {
        $guests = [];
        foreach( $podcasts['hits'] as $podcast ){
            $guests = array_merge( $guests, $podcast['_source']['guests'] );
        }
        return array_unique( $guests );
    }



}