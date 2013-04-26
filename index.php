<?php
// Scan the server top-level directory for project directories, build an array.
$projects = array();
foreach (scandir('.') as $entry) {
	if (is_dir($entry) && preg_match('/^[^\.].*$/', $entry)) {
		$projects[] = array(
			'dirname' => $entry,
			'imgSrc' => (file_exists($entry . '/favicon.ico') ? $entry . '/favicon.ico' : 
						(file_exists($entry . '/public/favicon.ico') ? $entry . '/public/favicon.ico' : 
						(file_exists($entry . '/public_html/favicon.ico') ? $entry . '/public_html/favicon.ico' : 'unknown.ico'))),
			'id' => preg_replace('/\W/', '-', $entry)
		);
	}
}
// Overrides for projects that do not use the standard link URL
$projectOverrides = array(
	'quokka.wanews.com.au' => array(
		'local' => 'http://localhost:81/'
	),
	'twc.com.au' => array(
		'local' => 'http://localhost:82/'
	)
);
// Specify the available environments; links to each environment will be generated for each project.
$environments = array(
	array(
		'id' => 'local',
		'label' => 'Local',
		'urlPrefix' => '',
		'useSubdir' => array( '/public', '/public_html' )
	),
	array(
		'id' => 'test',
		'label' => 'Test',
		'urlPrefix' => 'http://test.leftclick.com.au/',
		'useSubdir' => array( '/public', '/public_html' )
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
			'label' => 'MySQL Admin',
			'url' => 'phpmyadmin/'
		),
		array(
			'label' => 'Memcache Admin',
			'url' => 'phpmemcacheadmin/'
		),
		array(
			'label' => 'PHP Information',
			'url' => 'phpinfo.php'
		),
		array(
			'label' => 'PHP Constants',
			'url' => 'phpconst.php'
		),
	)
);
// Determine the link URL for each project in each environment
foreach ($projects as $index => $project) {
	if (!isset($project['linkUrl'])) {
		$project['linkUrl'] = array();
	}
	foreach ($environments as $environment) {
		if (isset($projectOverrides[$project['dirname']]) && isset($projectOverrides[$project['dirname']][$environment['id']])) {
			// Use project override for this project/environment combination
			$projects[$index]['linkUrl'][$environment['id']] = $projectOverrides[$project['dirname']][$environment['id']];
		} elseif (isset($environment['useSubdir'])) {
			// Use a subdirectory according to environment, if one exists
			$subdir = '';
			foreach ($environment['useSubdir'] as $option) {
				if (file_exists($project['dirname'] . $option)) {
					$subdir = $option;
				}
			}
			$projects[$index]['linkUrl'][$environment['id']] = $environment['urlPrefix'] . $project['dirname'] . $subdir;
		} else {
			// No subdir specified in this environment, just past together the prefix and directory name
			$projects[$index]['linkUrl'][$environment['id']] = $environment['urlPrefix'] . $project['dirname'];
		}
	}
}
?>
<!DOCTYPE html>
<html>
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
								<a href="<?=$project['linkUrl'][$environment['id']]?>" title="<?=$environment['label']?>" rel="external" class="button"><?=$environment['label']?></a>
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
