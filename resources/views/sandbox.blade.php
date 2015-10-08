<h1>Topic</h1>
<p>
    <input type="text" name="topic" value="left" placeholder="Topic">
    <button name="topic-submit">Search</button>
</p>

<h1>Guests</h1>
<p>
    <input type="text" name="guest" placeholder="Guest" value="gus">
    <button name="guest-submit">Search</button>
</p>

<table id="podcasts-topics" border="1">
    <thead>
        <tr>
            <th>Podcast number</th>
            <th>Guest</th>
            <th>Topic</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<table id="podcasts-guests" border="1">
    <thead>
        <tr>
            <th>Podcast number</th>
            <th>Guest</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script>
    $(document).ready(function(){

        $(document).on('click','button[name="guest-submit"]',function(){
            var guests = $('input[name="guest"]').val();
            $.get( '{{ url('/api/guests')  }}/' + guests, function( results ){
                $('table#podcasts-topics').hide();
                $('table#podcasts-guests').show();
                $('table#podcasts-guests tbody').html('');

                $.each( results.hits, function( id, podcast ){
                    $('table#podcasts-guests tbody').append(getGuestTableRow( podcast, combineGuestArrays( podcast.highlight.guests, podcast._source.guests )  ) );
                });
            });
        });

        $(document).on('click','button[name="topic-submit"]',function(){
            var topic = $('input[name="topic"]').val();
            $.get( '{{ url('/api/topic')  }}/' + topic, function( results ){
                $('table#podcasts-guests').hide();
                $('table#podcasts-topics').show();
                $('table#podcasts-topics tbody').html('');

                $.each( results.hits, function( id, podcast ){
                    var linkDump = podcast.highlight['linkDump.name'];
                    if( typeof linkDump === 'undefined' ){
                        linkDump = podcast.highlight['linkDump.url'];
                    }
                    $('table#podcasts-topics tbody').append(getTopicTableRow( podcast, podcast._source.guests, linkDump ) );
                });
            });
        });

    });

    function combineGuestArrays( hightlighted, guests ) {
        for (var i = 0; i < hightlighted.length; i++ ) {
            var guest = $(hightlighted[i]).text();
            var id = guests.indexOf( guest );
            guests[id] = hightlighted[i];
        }
        return guests;
    }

    function getTopicTableRow( podcast, guests, topics ){
        return '<tr>' +
                '<td><a href="' + podcast._source.roosterTeethUrl + '">' + podcast._id + '</a></td>' +
                '<td>' + arrayToUl( guests ) + '</td>' +
                '<td>' + arrayToUl( topics ) + '</td>' +
                '</tr>'
    }

    function getGuestTableRow( podcast, guests ){
        return '<tr>' +
                '<td><a href="' + podcast._source.roosterTeethUrl + '">' + podcast._id + '</a></td>' +
                '<td>' + arrayToUl( guests ) + '</td>' +
                '</tr>'
    }

    function arrayToUl( array ){
        if( typeof array === 'undefined' ){
            return '';
        }

        var guests = '<ul>';
        for (var i = 0; i < array.length; i++ ) {
            guests += "<li>"  + array[i] + "</li>";
        }
        guests += '</ul>';
        return guests;
    }


</script>
