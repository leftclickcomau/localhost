<?php
$list = array();
foreach (scandir('.') as $entry) {
	if (is_dir($entry) && preg_match('/^[^\.].*\...*$/', $entry)) {
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
			html, body { padding: 0; margin: 0; }
			html { background-color: #ccc; }
			body { background-color: #f8f8f8; padding: 1em 0 0 0; }
			* { font-family: sans-serif; }
			h1 { text-align: center; }
			h2 { color: #333; }
			ul, li { display: block; list-style: none; padding: 0; margin: 0; }
			img { border: none; }
			address { margin-top: 1em; border-top: 1px solid #666; padding: 1em; text-align: center; background-color: #ccc; }
			a { text-decoration: none; color: #00f; }
			a.button { border: solid 1px #006; padding: .25em; background-color: #eef; color: #006; -moz-box-shadow: 0 0 8px #000; }
			a.button:hover { background-color: #ccf; }
			a.button:active { color: #00f; }
			#container { max-width: 1200px; margin: 0 auto 1em auto; padding: 0; border: 1px solid #666; background-color: #fff; }
			ul#top-level { list-style: none; margin: 0; padding: 0; }
			li.column { width: 33.33%; float: left; }
			ul.column-content { margin: 0 1em; }
			li.project { text-align: center; margin: 0 0 1.5em 0; padding: .5em; border: solid 1px #666; background-color: #f8f8f8; -moz-box-shadow: 0 0 8px #000; }
			li.project h2 { display: inline-block; font-size: 1em; line-height: 1em; padding: 0; margin: 1em 0; }
			li.project img { width: 16px; height: 16px; vertical-align: middle; }
			li.project img.left { padding-right: 4px; }
			li.project img.right { padding-left: 4px; }
			ul.project-content { text-align: center; margin: 0 0 1em 0; }
			li.project-link { display: inline-block; font-size: smaller; padding: 0 .5em; }
			ul#buttons { text-align: center; margin: 1.5em auto; }
			.clear { clear: both; }
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
				<li id="column-<?=$j?>" class="column">
					<ul id="column-content-<?=$j?>" class="column-content">
<?php
	for ($i=0; ($i<$max) && ($j<sizeof($list)); $i++, $j++) {
		$value = $list[$j];
		$img_src = file_exists($value . '/favicon.ico') ? ($value . '/favicon.ico') : 'unknown.ico';
		$project_name = preg_replace('/\W/', '-', $value);
?>
						<li id="project-<?=$project_name?>" class="project">
							<h2>
								<img src="<?=$img_src?>" alt="?" class="left" />
								<?=$value?>
								<img src="<?=$img_src?>" alt="?" class="right" />
							</h2>
							<ul id="project-content-<?=$project_name?>" class="project-content">
								<li class="project-link local">
									<a href="<?=$value?>" title="Local" rel="external" class="button">Local</a>
								</li>
								<li class="project-link testing">
									<a href="http://troll/<?=$value?>/" title="Testing" rel="external" class="button">Testing</a>
								</li>
								<li class="project-link production">
									<a href="http://<?=$value?>/" title="Production" rel="external" class="button">Production</a>
								</li>
							</ul>
						</li>
<?php
	}
?>
					</ul>
				</li>
<?php
}
?>
			</ul>
			<div class="clear"></div>
		</div>
		<ul id="buttons">
			<li><a href="phpinfo" class="button">PHP Information</a></li>
		</ul>
		<address><?=php_uname()?></address>
<script type="text/javascript">
//<![CDATA[
// Open "external" links in a new window.
// This is a one-liner with jQuery! ;-)
var links = document.getElementsByTagName('a');
for (var i=0; i<links.length; i++) {
	var link = links[i];
	if (link.rel === 'external') {
		link.onclick = function() {
			window.open(this.href);
			return false;
		}
	}
}
//]]>
</script>
	</body>
</html>
