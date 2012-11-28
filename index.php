<?php
$list = array();
foreach (scandir('.') as $entry) {
	if (is_dir($entry) && preg_match('/^[^\.].*$/', $entry)) {
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
			html, body { padding: 0; margin: 0; overflow-x: hidden; }
			html { background: #333 url(Thor4Andreo.jpg) center no-repeat; background-size: cover; }
			* { font-family: sans-serif; }
			h1 { text-align: center; }
			h1 span { color: #fff; background-color: #000; font-family: monospace; padding: .33em; opacity: .7; -moz-box-shadow: 0 0 24px #000; }
			h2 { color: #333; }
			ul, li { display: block; list-style: none; padding: 0; margin: 0; }
			img { border: none; }
			address { position: fixed; bottom: 0; left: 0; right: 0; padding: 1em; text-align: center; background-color: #000; color: #fff; opacity: .7; -moz-box-shadow: 0 -16px 16px #000; }
			a { text-decoration: none; color: #00f; }
			a.button { border: solid 1px #006; padding: .25em; background-color: #eef; color: #006; -moz-box-shadow: 0 0 8px #000; }
			a.button:hover { background-color: #ccf; }
			a.button:active { color: #00f; }
			#container { margin: 0; padding: 0 0 5em 0; text-align: center; }
			ul#projects { list-style: none; margin: 0 100px; }
			li.project { display: inline-block; width: 360px; text-align: center; }
			li.project div.project-panel { position: relative; margin: 1em; padding: .5em; border: dotted 1px #666; background-color: #000; background-position: 8px 8px; background-repeat: no-repeat; -moz-box-shadow: 0 0 16px #000; }
			li.project div.project-panel h2 { display: inline-block; font-size: 1em; line-height: 1em; padding: 0; margin: 0; color: #eee; }
			li.project div.project-panel img { width: 16px; height: 16px; position: absolute; top: 8px; left: 8px; }
			ul.project-content { text-align: center; margin: 1em 0 .5em 0; }
			li.project-link { display: inline-block; font-size: smaller; padding: 0 .5em; }
			ul.buttons { text-align: center; margin: 1em 0; }
			ul.buttons li { display: inline; }
			ul.buttons li a { display: inline-block; margin: 0 .5em; width: 200px; }
			.clear { clear: both; }
		</style>
	</head>
	<body class="index">
		<div id="container">
			<h1><span>localhost</span></h1>
			<ul id="projects">
<?php
	for ($i=0; $i<sizeof($list); $i++) {
		$value = $list[$i];
		$img_src = file_exists($value . '/favicon.ico') ? ($value . '/favicon.ico') : 'unknown.ico';
		$project_name = preg_replace('/\W/', '-', $value);
?>
				<li id="project-<?=$project_name?>" class="project">
					<div id="project-panel-<?=$project_name?>" class="project-panel">
						<h2><img src="<?=$img_src?>" alt="*" /><?=$value?></h2>
						<ul id="project-content-<?=$project_name?>" class="project-content">
							<li class="project-link local">
								<a href="<?=$value?>" title="Local" rel="external" class="button">Local</a>
							</li>
							<li class="project-link test">
								<a href="http://test.leftclick.com.au/<?=$value?>/" title="Test" rel="external" class="button">Test</a>
							</li>
							<li class="project-link production">
								<a href="http://<?=$value?>/" title="Production" rel="external" class="button">Production</a>
							</li>
						</ul>
					</div>
				</li>
<?php
	}
?>
			</ul>
			<div class="clear"></div>
			<ul class="buttons">
				<li><a href="http://localhost:81/" class="button" rel="external">Quokka</a></li>
				<li><a href="http://localhost:82/" class="button" rel="external">TWC</a></li>
			</ul>
			<ul class="buttons">
				<li><a href="phpmyadmin" class="button" rel="external">MySQL Admin</a></li>
				<li><a href="phpmemcacheadmin" class="button" rel="external">Memcache Admin</a></li>
				<li><a href="phpinfo" class="button" rel="external">PHP Information</a></li>
				<li><a href="phpconst" class="button" rel="external">PHP Constants</a></li>
			</ul>
			<div class="clear"></div>
		</div>
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
