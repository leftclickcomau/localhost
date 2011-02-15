<?php
$list = array();
foreach (scandir('.') as $entry) {
	if (is_dir($entry) && (substr($entry, 0, 1) !== '.')) {
		$list[] = $entry;
	}
}
?>
<?='<?xml version="1.0" encoding="utf-8" ?>'?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>localhost</title>
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" /> 
		<style type="text/css">
			* { font-family: sans-serif; }
			h1 { text-align: center; }
			img { border: none; }
			a { text-decoration: none; }
			#container { max-width: 1000px; margin: 0 auto; padding: 0 0 2em 0; border: 1px solid #666; }
			ul#top-level { list-style: none; margin: 0; padding: 0; }
			ul#top-level li.top-level { width: 33%; float: left; }
			ul#top-level li.top-level ul { list-style: disc; line-height: 2em; }
			ul#top-level li.top-level ul li img { padding-right: .5em; }
		</style>
	</head>
	<body class="index">
		<div id="container">
			<h1>localhost</h1>
			<ul id="top-level">
<?php
$max = sizeof($list) / 3;
for ($j=0; $j<sizeof($list); ) {
?>
				<li class="top-level">
					<ul>
<?php
	for ($i=0; ($i<$max) && ($j<sizeof($list)); $i++, $j++) {
?>
						<li><a href="<?=$list[$j]?>" rel="external" onclick="window.open(this.href); return false;"><img src="<?=$list[$j]?>/favicon.ico" alt="" /><?=$list[$j]?></a></li>
<?php
	}
?>
					</ul>
				</li>
<?php
}
?>
			</ul>
			<div style="clear:both;"></div>
		</div>
	</body>
</html>
