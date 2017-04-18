<?php
include("lang/setlang.php");
define('PACKAGE', 'pocketmine-frame-up');

// gettext setting
bindtextdomain(PACKAGE, 'lang'); // or $your_path/lang, ex: /var/www/test/lang
textdomain(PACKAGE);
?>
<html><head><title><?php echo _('PocketMine Plugin Making Tools'); ?></title>

<link rel="stylesheet" href="/css/main.css" />
</head>
<body>
	<h1>
		<a name="title"><?php echo _('PocketMine-MP Plugin Making Tools'); ?></a>
	</h1>
	<?php echo _('This project is open-source on
	<a href="https://github.com/Ad5001/pmt.mcpe.fun" target="_blank">GitHub</a>.'); ?>
	<br>
	<?php echo _('Please feel free to report any bugs to
	<a href="https://github.com/Ad5001/pmt.mcpe.fun/issues" target="_blank">the issue tracker</a>.
	When you create a report, please provide as much information as possible.'); ?>
	<br>
	<?php echo _('This website was authored by <a href="https://github.com/PEMapModder">PEMapModder</a> (with help from many people) and is now authored and hosted by <a href="https://ad5001.eu" target="_blank">Ad5001</a>.'); ?>

<a name="bottom"></a>
</body></html>
