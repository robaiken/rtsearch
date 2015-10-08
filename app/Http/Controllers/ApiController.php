<?php

namespace App\Http\Controllers;

use App\Search;
use App\Http\Requests;

class ApiController extends Controller
{

    private $search;

    public function __construct()
    {
        $this->search = new Search();
    }

    public function topic( $query )
    {
        return $this->search->topic( $query );
    }

    public function guests( $guests )
    {
        return $this->search->guests( $guests );
    }

}
