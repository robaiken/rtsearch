<?php
/**
 * Author: Rob Aiken
 * Datetime: 31/08/15 17:10
 */

namespace App;

use Elasticsearch\ClientBuilder;

class PodcastProcessor {

    public function addNewPodcasts()
    {
        $podcasts = $this->formatPodcastSpreadsheetResults();
        $this->savePodcasts( $podcasts );
    }

        private function savePodcasts( $podcastList )
        {
            $client = ClientBuilder::create()->build();
            foreach( $podcastList as $id => $podcast ){
                echo "Adding podcast number: {$id}\n";
                $client->index(  $this->build( $id, $podcast ) );
            }
        }

            private function build( $id, $body )
            {
                return [
                    'index' => 'podcasts',
                    'type' => 'podcast',
                    'id' => $id,
                    'body' => $body
                ];
            }

    public function formatPodcastSpreadsheetResults()
    {
        $spreadsheet = ( new Spreadsheet() )->get();
        $data = [];
        foreach( $spreadsheet as $line ) {
            $data[ $line[2] ] = $this->mapSpreadsheetResults( $line );
            echo "Got podcast number: {$line[2]}\n";
        }
        return $data;
    }

        private function mapSpreadsheetResults( $line )
        {
            return [
                'title' => $line[35],
                'youtubeUrl' => $line[0],
                'roosterTeethUrl' => $line[1],
                'releaseDate' => $line[3],
                'duration' => $line[4],
                'guests' => $this->getGuestsFromLine( $line ),
                'linkDump' => $this->getLinkDump( $line[1] )
            ];
        }

            private function getLinkDump( $url )
            {
                $linkDump = new LinkDump( $url );
                return $linkDump->get();
            }

            private function getGuestsFromLine( $line )
            {
                $guests = [];
                for( $i = 6 ;  $i < count( $line ) ; $i++ ){
                    if( !empty( $line[ $i ] ) ){
                        $guests = array_merge( $guests, $this->explodeGuests( $line[ $i ] ) );
                    }
                    // line 34 is is the "One-Timers and Special Guests" section
                    if( $line[ 5 ] == count( $guests ) ||  $i == 34 ){
                        break;
                    }
                }
                return $guests;
            }

                /**
                 *  This part is a little hacky, but i have work in the morning and its late.
                 */
                private function explodeGuests( $guests )
                {
                    $ands = explode(' and ', $guests);
                    $commas = explode(',', $guests);
                    $plus = explode('+', $guests);
                    $amp = explode('&', $guests);
                    $newGuests = array_merge( $ands, $commas, $plus, $amp );
                    $guestsToReturn = [];

                    foreach( $newGuests as $guest ){
                        if( strpos( $guest, ' and ' ) === false &&
                            strpos( $guest, ',' ) === false &&
                            strpos( $guest, '&' ) === false &&
                            strpos( $guest, '+' ) === false ){
                            $guestsToReturn[] = ucwords( trim( $guest ) );
                        }
                    }

                    return array_unique( $guestsToReturn );
                }

}