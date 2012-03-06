<?php require_once("lib/init.php"); ?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="styles/style.css" />
	<link rel="stylesheet" href="styles/armata/stylesheet.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://raw.github.com/LeaVerou/prefixfree/master/prefixfree.min.js"></script>
	<script type="text/javascript" src="https://raw.github.com/quirkey/sammy/master/lib/min/sammy-latest.min.js"></script>
	<script type="text/javascript" src="scripts/readly.sammy.js"></script>
</head>
<body>
	<header>
		<nav>
			<span>Read.ly</span>
			<?php if (User::isIn()) : ?>
				<a href="#/dropbox" class="button dropbox">Dropbox</a>
				<a href="#/upload" class="button upload">Upload</a>
			<?php else : ?>
				<a href="#/login" class="button login">Login</a>
			<?php endif; ?>
		</nav>
	</header>
	<section></section>
</body>
</html>
