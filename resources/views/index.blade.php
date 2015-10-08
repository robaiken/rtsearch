@extends( 'layout.master' )

@section('title', 'RT Podcast Search Engine')

@section('javascript')
    <script src="{{ url('/rt/js/search.min.js')  }}"></script>
@stop

@section('css')
    <link rel="stylesheet" href="{{ url('/rt/css/style.css')  }}" />
@stop

@section('content')
<div class="container" role="main" id="search-engine-wrapper">

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#topics-search"><h4>Topics</h4></a></li>
        <li><a data-toggle="pill" href="#guests-search"><h4>Guests</h4></a></li>
    </ul>

        <div class="tab-content" id="search-types">

        <div id="topics-search" class="tab-pane fade in active">
            <div class="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text" name="topic" class="form-control input-lg" placeholder="Topics" autofocus>
                    <span class="input-group-btn">
                        <button name="topic-submit" class="btn btn-info btn-lg" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>

        <div id="guests-search" class="tab-pane fade">
            <div class="row">
                <div class="col-md-10">
                    <select id="basic" name="guests" class="selectpicker show-tick form-control" data-live-search="true" multiple>
                        @foreach( $guests as $guest )
                            <option>{{ $guest }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary" name="guests-submit" data-loading-text="Loading...">Search</button>
                </div>
            </div>
        </div>

    </div>

    <hr />

    <div id="advert" class="text-center">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- rt search leaderboard -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:728px;height:90px"
             data-ad-client="ca-pub-2093338673360790"
             data-ad-slot="1508137504"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>

    <hr />

    <div class="row">
        <div class="col-md-12">

            <table id="podcasts-guests" class="results-table table table-bordred table-striped">
                <thead>
                <tr>
                    <th class="text-center">Podcast number</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Release date</th>
                    <th class="text-center">length</th>
                    <th class="text-center">Guest</th>
                </tr>
                </thead>
                <tbody>
                    @foreach( $podcasts['hits'] as $podcast )
                        <tr>
                            <td class="text-center">{{ $podcast['_id'] }}</td>
                            <td><a target="_blank" href="{{ $podcast['_source']['roosterTeethUrl'] }}">{{ $podcast['_source']['title'] }}</a></td>
                            <td class="text-center">{{ $podcast['_source']['releaseDate'] }}</td>
                            <td class="text-center">{{ $podcast['_source']['duration'] }}</td>
                            <td>
                                <ul>
                                    @foreach( $podcast['_source']['guests'] as $guest )
                                    <li>{{ $guest }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <table id="podcasts-topics" class="results-table table table-bordred table-striped">
                <thead>
                <tr>
                    <th class="text-center">Podcast number</th>
                    <th>Title</th>
                    <th class="text-center">Release date</th>
                    <th class="text-center">length</th>
                    <th class="text-center">Guest</th>
                    <th class="text-center">Topic</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>

        </div>
    </div>
</div>
@stop