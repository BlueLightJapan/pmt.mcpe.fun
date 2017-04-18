<?php if(!isset($_GET["main"])) $_GET["main"] = "/phar.php"; ?>
<html>
<link rel="stylesheet" href="/css/main.css" />
<frameset cols="200,*">
	<frame src="/pocketmine-frame-left.php" name="left" scrolling="on">
	<frame src="<?php echo $_GET["main"]; ?>" name="content" scrolling="on">
</frameset>
</html>
