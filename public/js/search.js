/**
 * Created by rob on 06/09/15.
 */
$(document).ready(function(){

    $(".results-table  #checkall").click(function () {
        if ($(".results-table #checkall").is(':checked')) {
            $(".results-table input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $(".results-table input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });

    $(document).on('click','button[name="guests-submit"]',function(){
        var btn = $(this).button('loading');

        var guests = $('select[name="guests"]').val();
        $.get( '/rt/api/guests/' + guests, function( results ){
            $('table#podcasts-topics').hide();
            $('table#podcasts-guests').show();
            $('table#podcasts-guests tbody').html('');

            $.each( results.hits, function( id, podcast ){
                $('table#podcasts-guests tbody').append(getGuestTableRow( podcast, combineGuestArrays( podcast.highlight.guests, podcast._source.guests )  ) );
            });
            btn.button('reset');

        });
    });

    $(document).on('click','button[name="topic-submit"]',function(){

        var topic = $('input[name="topic"]').val();
        $.get( '/rt/api/topic/' + topic, function( results ){
            $('table#podcasts-guests').hide();
            $('table#podcasts-topics').show();
            $('table#podcasts-topics tbody').html('');

            $.each( results.hits, function( id, podcast ){
                var linkDump = podcast.highlight['linkDump.name'];
                if( typeof linkDump === 'undefined' ){
                    linkDump = podcast.highlight['linkDump.url'];
                }
                if(typeof podcast.highlight['title'] !== 'undefined' ){
                    podcast._source.title = podcast.highlight['title'];
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
        '<td class="text-center">' + podcast._id + '</td>' +
        '<td><a target="_blank" href="' + podcast._source.roosterTeethUrl + '">' + podcast._source.title + '</a></td>' +
        '<td class="text-center">' + podcast._source.releaseDate + '</a></td>' +
        '<td class="text-center">' + podcast._source.duration  + '</a></td>' +
        '<td>' + arrayToUl( guests ) + '</td>' +
        '<td>' + arrayToUl( topics ) + '</td>' +
        '</tr>'
}

function getGuestTableRow( podcast, guests ){
    return '<tr>' +
        '<td class="text-center">' + podcast._id + '</td>' +
        '<td><a target="_blank" href="' + podcast._source.roosterTeethUrl + '">' + podcast._source.title + '</a></td>' +
        '<td class="text-center">' + podcast._source.releaseDate + '</a></td>' +
        '<td class="text-center">' + podcast._source.duration  + '</a></td>' +
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