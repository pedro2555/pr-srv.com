<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="$ThemeDir/apple-touch-icon.png">
        
        <link rel="shortcut icon" href="$ThemeDir/images/favicon.ico?v=065831e6dbb251dea4ed4fe9e74a62bca006aef9" />

        <link rel="stylesheet" href="$ThemeDir/css/bootstrap.min.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="$ThemeDir/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="$ThemeDir/css/main.css">

        <script src="$ThemeDir/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->


    <div class="container">
      <!-- Example row of columns -->
      <div class="row">

      		<!-- PAGE CODE GOES HERE -->
          <% if CurrentMember %>
      		  <a href="{$Link}recalc">Recalcular</a>
          <% end_if %>

          <div class="col-xs-12">
            <h3>Contas</h3>
            <div class="list-group">
              <% loop Children %>
                <a href="$Link" class="list-group-item"><span class="badge">$Balance.Nice $CurrencySymbol</span>$Title</a>
              <% end_loop %>
            </div>
      		</div>

      </div>

      <hr>

      <footer>
        <p>$Title</p>
      </footer>
    </div>
    	<script src="$ThemeDir/js/vendor/jquery-1.11.2.min.js"><\/script>

        <script src="$ThemeDir/js/vendor/bootstrap.min.js"></script>

        <script src="$ThemeDir/js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
      <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-20904639-7', 'auto');
        ga('send', 'pageview');

      </script>
    </body>
</html>