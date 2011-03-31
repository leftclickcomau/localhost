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
			html { background-color: #eee; }
			body { background-color: #fff; padding: 1em 0 0 0; }
			* { font-family: sans-serif; }
			h1 { text-align: center; }
			h2 { display: inline; font-size: 1em; color: #333; }
			img { border: none; }
			address { margin-top: 1em; border-top: 1px solid #666; padding: 1em; text-align: center; background-color: #eee; }
			a { text-decoration: none; color: #00f; }
			a.button { border: solid 1px #006; padding: .25em; background-color: #eef; color: #006; }
			ul, li { display: block; list-style: none; padding: 0; margin: 0; }
			#container { max-width: 1200px; margin: 0 auto 1em auto; padding: 0; border: 1px solid #666; background-color: #f8f8f8; }
			ul#top-level { list-style: none; margin: 0; padding: 0; }
			li.column { width: 33%; float: left; }
			ul.column-content { margin: 0 0 0 2em; }
			ul.column-content li { padding: 1em 0 1.5em 0; text-align: center; }
			ul.column-content li img { width: 16px; height: 16px; }
			ul.column-content li img.left { padding-right: 4px; }
			ul.column-content li img.right { padding-left: 4px; }
			ul.project-content { text-align: center; }
			ul.project-content li { display: inline-block; font-size: smaller; padding-right: .5em; }
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
							<img src="<?=$img_src?>" alt="" class="left" />
							<h2><?=$value?></h2>
							<img src="<?=$img_src?>" alt="" class="right" />
							<ul id="project-content-<?=$project_name?>" class="project-content">
								<li class="project-link local">
									<a href="<?=$value?>" title="Local" rel="external" class="button" onclick="window.open(this.href); return false;">Local</a>
								</li>
								<li class="project-link testing">
									<a href="http://troll/<?=$value?>/" title="Testing" rel="external" class="button" onclick="window.open(this.href); return false;">Testing</a>
								</li>
								<li class="project-link production">
									<a href="http://<?=$value?>/" title="Production" rel="external" class="button" onclick="window.open(this.href); return false;">Production</a>
								</li>
							</ul>
							<div class="clear"></div>
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
			<div style="clear:both;"></div>
		</div>
		<center><a href="phpinfo" class="button">PHP Information</a></center>
		<address><?=php_uname()?></address>
	</body>
</html>
