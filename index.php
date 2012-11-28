<?php
// Scan the server top-level directory for project directories, build an array.
$projects = array();
foreach (scandir('.') as $entry) {
	if (is_dir($entry) && preg_match('/^[^\.].*$/', $entry)) {
		$projects[] = array(
			'dirname' => $entry,
			'imgSrc' => file_exists($entry . '/favicon.ico') ? ($entry . '/favicon.ico') : 'unknown.ico',
			'id' => preg_replace('/\W/', '-', $entry)
		);
	}
}
// Specify the available environments; links to each environment will be generated for each project.
$environments = array(
	array(
		'id' => 'local',
		'label' => 'Local',
		'urlPrefix' => ''
	),
	array(
		'id' => 'test',
		'label' => 'Test',
		'urlPrefix' => 'http://test.leftclick.com.au/'
	),
	array(
		'id' => 'production',
		'label' => 'Production',
		'urlPrefix' => 'http://'
	)
);
// Specify custom links to display at the bottom.
$customLinks = array(
	array(
		array(
			'label' => 'Quokka',
			'url' => 'http://localhost:81/'
		),
		array(
			'label' => 'TWC',
			'url' => 'http://localhost:82/'
		)
	),
	array(
		array(
			'label' => 'MySQL Admin',
			'url' => 'phpmyadmin'
		),
		array(
			'label' => 'Memcache Admin',
			'url' => 'phpmemcacheadmin'
		),
		array(
			'label' => 'PHP Information',
			'url' => 'phpinfo'
		),
		array(
			'label' => 'PHP Constants',
			'url' => 'phpconst'
		),
	)
);
?>
<?='<?xml version="1.0" encoding="utf-8" ?>' . "\n"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>localhost</title>
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" /> 
		<link rel="stylesheet" type="text/css" href="localhost.css" />
	</head>
	<body class="index">
		<div id="container">
			<h1><span>localhost</span></h1>
			<ul id="projects">
<?php
foreach ($projects as $project) {
?>
				<li id="project-<?=$project['id']?>" class="project">
					<div id="project-panel-<?=$project['id']?>" class="project-panel">
						<h2><img src="<?=$project['imgSrc']?>" alt="*" /><?=$project['dirname']?></h2>
						<ul id="project-content-<?=$project['id']?>" class="project-content">
<?php
	foreach ($environments as $environment) {
?>
							<li class="project-link <?=$environment['id']?>">
								<a href="<?=$environment['urlPrefix'] . $project['dirname']?>" title="<?=$environment['label']?>" rel="external" class="button"><?=$environment['label']?></a>
							</li>
<?php
	}
?>
						</ul>
					</div>
				</li>
<?php
}
?>
			</ul>
			<div class="clear"></div>
<?php
foreach ($customLinks as $customLinkSet) {
?>
			<ul class="buttons">
<?php
	foreach ($customLinkSet as $customLink) {
?>
				<li><a href="<?=$customLink['url']?>" class="button" title="<?=$customLink['label']?>" rel="external"><?=$customLink['label']?></a></li>
<?php
	}
?>
			</ul>
<?php
}
?>
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
