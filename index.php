<?php require_once("lib/init.php"); ?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="styles/style.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>
<body>
	<header>
		<nav>
			<input type="text" class="search" placeholder="search"/>
			<?php if (User::isIn()) : ?>
				<a href="#dropbox" class="button dropbox">Dropbox</a>
				<a href="#upload" class="button upload">Upload</a>
			<?php else : ?>
				<a href="#login" class="button login">Login</a>
			<?php endif; ?>
		</nav>
	</header>
	<section></section>
</body>
</html>
