<hr />

<footer class="text-center">
    {{ date('Y') }} &copy; <a href="http://nu-voo.co.uk">Rob Aiken</a>
</footer>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-41219392-1', 'nu-voo.co.uk');
    ga('send', 'pageview');

</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="{{ url('/rt/dist/js/bootstrap-select.js')}}"></script>
<script src="{{ url('/rt/js/adBlockKiller.js')}}"></script>
<script>
    $('#advert').adBlockKiller({
        stopMessage: '<h2 style="color: red">Please read!!</h2><br><br><b style="color: red">Hosting this website is costing me more money than I can afford, as I am a student. <br><br>Please consider white listing this web site on your ad blocker or make a <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DHJM48MST7MWL">donation</a> or I may have to close this web site down in the future. <br><br>thank you  :)<b>'
    });
</script>

@yield( 'javascript' )
</body>
</html>