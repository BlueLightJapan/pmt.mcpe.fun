<?php
include("lang/setlang.php");
define('PACKAGE', 'pocketmine-frame-left');

// gettext setting
bindtextdomain(PACKAGE, 'lang'); // or $your_path/lang, ex: /var/www/test/lang
textdomain(PACKAGE);
?>
<html>
<head>
<link rel="stylesheet" href="/css/main.css" />
</head>
<body>

	<ul class="menu">
		<li><a href="/phar.php" target="content"><?php echo _('Zip to Phar converter'); ?></a></li><br>
		<li><a href="/unphar.php" target="content"><?php echo _('Phar to Zip converter'); ?></a></li><br>
		<li><a href="/insta/" target="_blank"><?php echo _('Instant GistPlugin Generator+Converter'); ?></a></li><br>
		<!--		<li><a href="/data/builds/" target="content">Development build archive of some plugins</a></li>-->
		<li><a href="/varDump.php" target="content"><?php echo _('<code>var_dump()</code> viewer (<code>xdebug</code>-style dumps are
				not supported yet)'); ?></a></li><br>
		<li><a href="/crashdump/" target="content"><?php echo _('PocketMine Crash Dump parsing'); ?></a></li><br>
		<li><a href="/pmb/" target="content"><?php echo _('PocketMine phar build archive'); ?></a></li><br>
		<li><a href="/api2/" target="content"><?php echo _('Plugin API 3.0.0 Injector'); ?></a></li><br>
		<li><a href="#" class="disabled"><?php echo _('<strong>[W.I.P.]</strong> Plugin Generator'); ?></a></li><br>
	</ul>
	<input type="button" value="<?php echo _('Reload content frame'); ?>" onclick="parent.content.location.reload()">
	<br>

</body>
</html>
