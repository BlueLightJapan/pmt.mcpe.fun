<?php
include("lang/setlang.php");
define('PACKAGE', 'pocketmine-frame-up');

// gettext setting
bindtextdomain(PACKAGE, 'lang'); // or $your_path/lang, ex: /var/www/test/lang
textdomain(PACKAGE);
?>
<html><head><title><?php echo _('PocketMineプラグイン作成ツール'); ?></title>

<link rel="stylesheet" href="/css/main.css" />
</head>
<body>
	<h1>
		<a name="title"><?php echo _('PocketMine-MPプラグイン作成ツール'); ?></a>
	</h1>

	<?php echo _('このプロジェクトはオープンソースです
	<a href="https://github.com/bluelightjapan/pmt.mcpe.fun" target="_blank">GitHub</a>.'); ?>
	<br>
	<?php echo _('このサイトは <a href="https://github.com/PEMapModder">PEMapModder</a> に書かれ、(様々な人の助けもあって）、今は次の人がホスティングをしています <a href="http://haniokasai.com" target="_blank">haniokasai</a>.'); ?>

<a name="bottom"></a>
</body></html>
