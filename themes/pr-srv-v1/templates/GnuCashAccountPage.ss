<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
	<% base_tag %>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="$ThemeDir/apple-touch-icon.png">

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
		<div class="row">
			<!-- PAGE CODE GOES HERE -->
			<div class="col-xs-12">
				<h1>$Title</h1>
				<div class="jumbotron">
					<% if $IsBalanceCredit %>
						<h2>Total em crédito <strong>$Balance</strong></h2>
					<% else %>
						<h2>Total em dívida <strong>$Balance</strong></h2>
					<% end_if %>
				</div>

			</div>



			<div class="col-xs-12">
				<h2>Detalhe</h2>
				<table class="table table-condensed table-hover table-striped">
					<thead>
						<tr style="font-weight: bold">
							<td>Data</td>
							<td>Descrição</td>
							<td>Conta de Destino</td>
							<td align="right">Valor</td>
							<td align="right">Saldo</td>
						</tr>					
					</thead>
					<tbody>
						<% loop $Transactions %>
							<% if $Balance == "0.00" %>
								<tr class="warning">
							<% else %>
								<tr>
							<% end_if %>
								<td>$Date</td>
								<td>$Description</td>
								<td>$DestinationAccount</td>
								<td align="right">$Amount</td>
								<td align="right">$Balance</td>
							</tr>
						<% end_loop %>
					</tbody>
				</table>
			</div>

		</div>
	</div>
	<script src="$ThemeDir/js/vendor/jquery-1.11.2.min.js"></script>

	<script src="$ThemeDir/js/vendor/bootstrap.min.js"></script>

	<script src="$ThemeDir/js/main.js"></script>

	<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
	<script>
	(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
	function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
	e=o.createElement(i);r=o.getElementsByTagName(i)[0];
	e.src='//www.google-analytics.com/analytics.js';
	r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
	ga('create','UA-XXXXX-X','auto');ga('send','pageview');
	</script>
</body>
</html>