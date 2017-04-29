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
		<li><a href="/phar.php" target="content"><?php echo _('ZipからPharに変換'); ?></a></li><br>
		<li><a href="/unphar.php" target="content"><?php echo _('PharからZipに変換する'); ?></a></li><br>
		<li><a href="/varDump.php" target="content"><?php echo _('<code>var_dump()</code> ビュアー (<code>xdebug</code>-スタイルのダンプはサポートしません)'); ?></a></li><br>
		<li><a href="/crashdump/" target="content"><?php echo _('PocketMineのCrash Dump解析'); ?></a></li><br>
		<li><a href="/pmb/" target="content"><?php echo _('PocketMineのpharの作成'); ?></a></li><br>
	</ul>
	<input type="button" value="<?php echo _('メニューを更新'); ?>" onclick="parent.content.location.reload()">
	<br>

</body>
</html>
