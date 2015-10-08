<?php
/**
 * Author: Rob Aiken
 * Datetime: 30/08/15 20:12
 */

namespace App;


class Spreadsheet {

    private $spreadsheetURL = "https://docs.google.com/feeds/download/spreadsheets/Export?key=0AocS9OiCbn__dEN4LVN3Y1dSRlU3U0lad2QtUERRMEE&exportFormat=csv&gid=0";

    public function get()
    {
        $data = $this->getSpreadsheet();
        return $this->pruneData( $data );
    }

    private function pruneData( $data )
    {
        return array_slice( $data, 2 );
    }

    private function getSpreadsheet()
    {
        $file = fopen( $this->getSpreadsheetLocation() , 'r');
        $data = [];
        while (($line = fgetcsv($file)) !== FALSE) {
            $data[] = $line;
        }
        fclose($file);
        return $data;
    }

        public function getSpreadsheetLocation()
        {
            return storage_path() . '/app/podcasts.csv';
        }

}