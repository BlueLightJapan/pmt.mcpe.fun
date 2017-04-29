<?php
include("lang/setlang.php");
define('PACKAGE', 'unphar');

// gettext setting
bindtextdomain(PACKAGE, 'lang'); // or $your_path/lang, ex: /var/www/test/lang
textdomain(PACKAGE);
?>
<html>
<head>
	<title><?php echo _('Unphar'); ?></title>
	<link rel="stylesheet" href="/css/main.css" />
</head>
<body>
<h1><?php echo _('Unphar'); ?></h1>
<hr>
<form method="post" action="/unpharResult.php" enctype="multipart/form-data">
	<p><?php echo _('ここにpharファイルをアップロードしてください:'); ?><br><input type="file" name="file" accept=".phar"></p>
    <?php readfile("ad.txt");?>
    <p><input type="submit" value="変換！"></p>
</form>
<pre>
	<?php echo _("免責事項：
	このサービスは無料で提供されており、常に利用可能であることが保証されていません。
	作業の過程で、 ファイルは、 （ウェブサイトからアクセス可能でないであろう）サーバのファイルシステム上のファイルに抽出し、一定期間保管します。
	私たちは（このウェブサイトの所有者）は、著作権侵害やその他の違法行為に関連する行為のための責任を負いません。"); ?>
</pre>

</body>
</html>
