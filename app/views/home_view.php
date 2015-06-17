<!DOCTYPE html>
<html lang="en">
<head>
	<title>Works4VC default example view</title>
	<meta charset="utf-8">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--[if lt ie 9]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<link rel="stylesheet" href="<?=BASEPATH?>assets/css/app.css">
	<style type="text/css">
		body {
			font: 100%/1.5em 'Helvetica Neue', 'Arial', sans-serif;
			font-weight: 300;
			color: rgb(100,100,100);
			padding-left: 1em;
			padding-right: 1em;
		}
		body > div {
			max-width: 768px;
			margin: 12.5% auto 2em;
			border: 1px solid rgb(215,215,215);
			border-radius: 8px;
			box-shadow: 0px 0px 20px rgba(0,0,0,.1);
		}
		div > div {
			padding: 2em 4em;
		}
		h2 {
			color: black;
			font-weight: bold; 
			font-size: 2em;
			text-align: center;
		}
		h2, p {
			margin-bottom: 1em;
		}
		hr {
			margin: 2em 0;
		}
		b { 
			font-weight: bold;
		}
		i {
			color: black;
			font-size: .9em;
			font-family: 'Monaco', 'Courier New', sans-serif;
			font-weight: 600;
		}
		small {
			display: block;
			margin: 1em auto 0;
			font-size: .8em;
			font-weight: 400;
			line-height: 1.5em;
			color: rgb(120,120,120);
			text-align: center;
			max-width: 568px;
		}
		small:first-child {
			font-weight: 300;
			text-align: left;
			margin-top: 0;
			color: rgb(180,180,180);
		}
	</style>
</head>
<body>
	
	<div>
		<div>
			<h2>Hello World!</h2>
			<p>Congratulations, it looks like the Works4VC PHP web application framework was installed successfully. You're currently looking at the default view.</p>
			<p>This default view is loaded by the default Home controller: <i>/app/controllers/home.php</i>.</p>
			<p>This default view file is located here: <i>/app/views/home_view.php</i>.</p>
			<p>You can change this default setup however you like. Any settings, i.e. those for URI routing and a database (MySQL) can be changed in <i>/app/config/settings.php</i></p>
			<p>If you want to add views within views, i.e. a header or a footer, use <br><i>&lt;? Controller<b>::loadView</b>('name-of-view-without-dot-php', $data); ?&gt;</i>
			<p>You might want to create your own libraries. You can add them here: <i>/app/libs/</i></p>
			<footer>
				<hr>
				<p>
					<small><b>Tiny disclaimer:</b> The code for this framework is published and released 'as is'. It is pure experimental and was designed for our own use in the first place. You can make no claims and we don't claim responsibility for anything positive or negative that happens because you are using it. Also, I'm sure there are far better frameworks out there in terms of security, stability and what not. Either way, have fun if you decide to use it! ;-)</small>
					<small>Works4VC was pooped out by <a href="http://www.works4sure.nl" target="_blank">Works4sure</a></small>
				</p>
			</footer>
		</div>
	</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?=BASEPATH?>assets/js/app.js"></script>
</body>
</html>