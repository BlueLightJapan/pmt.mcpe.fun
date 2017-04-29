<?php
include("lang/setlang.php");
define('PACKAGE', 'phar');

// gettext setting
bindtextdomain(PACKAGE, 'lang'); // or $your_path/lang, ex: /var/www/test/lang
textdomain(PACKAGE);
?>
<?php
include "functions.php";
$jsonExpected = $_SERVER["HTTP_ACCEPT"] === "application/json";
if(!$jsonExpected):
?>
<html>
<head>
	<title><?php echo _('Phar作成結果'); ?></title>
<link rel="stylesheet" href="/css/main.css" />
</head>
<body>
<font face="Comic Sans MS">
	<?php endif; ?>
	<?php

	use inspections\BadPracticeInspection;
	use inspections\ClasspathInspection;
	use inspections\SyntaxErrorInspection;

	if(!isset($_FILES["file"])){
		http_response_code(400);
		$out = "ファイルがポストされたうえで開かれる必要があります";
		echo $jsonExpected ? json_encode(["error" => $out]) : $out;
		return;
	}
	$file = $_FILES["file"];
	if($file["error"] !== 0){
		echo _("<h1>Failure</h1>");
		echo _("不正なアップロード: ");
		switch($err = $file["error"]){
			case UPLOAD_ERR_INI_SIZE:
				$errMsg = "ファイルが大きすぎます UPLOAD_ERR_INI_SIZE($err)";
				break;
			case UPLOAD_ERR_FORM_SIZE:
				$errMsg = "ファイルが大きすぎます UPLOAD_ERR_FORM_SIZE($err)";
				break;
			case UPLOAD_ERR_PARTIAL:
				$errMsg = "ファイルが一部しかありません UPLOAD_ERR_PARTIAL($err)";
				break;
			case UPLOAD_ERR_NO_FILE:
				$errMsg = "ファイルがアップロードされていません UPLOAD_ERR_NO_FILE($err)";
				break;
			case UPLOAD_ERR_NO_TMP_DIR:
				$errMsg = "tempフォルダ不調です　UPLOAD_ERR_NO_TMP_DIR($err)";
				break;
			case UPLOAD_ERR_CANT_WRITE:
				$errMsg = "書き込みエラー UPLOAD_ERR_CANT_WRITE($err)";
				break;
			case UPLOAD_ERR_EXTENSION:
				$errMsg = "PHPエクステンションが停止しました UPLOAD_ERR_EXTENSION($err)";
				break;
		}
		if(!$jsonExpected){
			goto the_end;
		}else{
			echo json_encode(["error" => $errMsg]);
			die;
		}
	}
	$args = new TuneArgs;
	$tno = "tune_top_namespace_optimization";
	$obs = "tune_obfuscation";
	$args->topNamespaceBackslash = isset($_POST[$tno]) ? ($_POST[$tno] === "on") : false;
	$args->obfuscate = isset($_POST[$tno]) ? ($_POST[$tno] === "on") : false;
	$result = phar_buildFromZip($file["tmp_name"], substr($file["name"], 0, -4), $args);
	if($result["error"] !== MAKEPHAR_ERROR_NO){
		if(!$jsonExpected){
			echo _("<h1>Failed to create phar</h1>");
			echo _("<p>Error: ");
			echo $MAKEPHAR_ERROR_MESSAGES[$result["error"]];
			echo "<br>";
			echo "<code>" . $result["error_name"] . "(" . $result["erorr_id"] . ")</code>: ";
			echo $result["error_msg"];
			echo "</p>";
			goto the_end;
		}else{
			json_encode(["error" => $MAKEPHAR_ERROR_MESSAGES[$result["error"]]]);
		}
	}
	$url = $result["pharpath"];
	$basename = urlencode(substr($url, 12));

	$cnt = usage_inc("pharbuild", $time);
	$diff = time() - $time;
	$itv = "";
	if($diff >= 3600 * 24){
		$itv .= ((int) ($diff / (3600 * 24))) . " day(s), ";
		$diff %= 3600 * 24;
		while($diff < 0){
			$diff += 3600 * 24;
		}
	}
	if($diff >= 3600){
		$itv .= ((int) ($diff / 3600)) . " hour(s), ";
		$diff %= 3600;
		while($diff < 0){
			$diff += 3600;
		}
	}
	if($diff >= 60){
		$itv .= ((int) ($diff / 60)) . " minute(s), ";
		$diff %= 60;
		while($diff < 0){
			$diff += 60;
		}
	}
	$itv .= "$diff second(s)";
	/** @var inspections\Inspection[] $inspections */
	$inspections = [];
	$dir = $result["extractpath"];
	foreach(["inspection_classpath", "inspection_bad_practice", "inspection_lint"] as $field){
		if(!isset($_POST[$field])){
			$_POST[$field] = "off";
		}
	}
	if($_POST["inspection_classpath"] === "on"){
		$inspections[] = new ClasspathInspection($dir);
	}
	if($_POST["inspection_bad_practice"] === "on"){
		$inspections[] = new BadPracticeInspection($dir);
	}
	if($_POST["inspection_lint"] === "on"){
		$inspections[] = new SyntaxErrorInspection($dir);
	}
	if($jsonExpected){
		$jsonData = [
			"phar" => "http://pmt.haniokasai.com" . $url,
			"expiry" => time() + 7200,
			"inspections" => []
		];
		foreach($inspections as $inspection){
			$jsonData["inspections"][$result->getName()] = $inspection->run()->jsonResult();
		}
		echo json_encode($jsonData);
		die;
	}
	echo <<<EOP
<h1>Pharの作成に成功しました</h1>
<p><a href="/data/phars/$basename">pharをここからダウンロードします</a></p>
<?php readfile("ad.txt");?>
<p>少なくとも、２時間はファイルがダウンロードできます。</p>
EOP;
	echo _("<p> $itv 秒前に, $cnt 個pharが作られています</p>");
	echo "<hr>";
	echo _("<h2>検査</h2>");
	echo "<ul>";
	foreach($inspections as $inspection){
		$inspection->run()->htmlEcho();
	}
	echo "</ul>";
	echo _("<p>検査の終了</p>");
	?>
	<p><?php echo _(' <a href="http://www.pocketmine.net/pluginReview.php"
	                                                         target="_blank">公式 PocketMineプラグイン評価ツール</a> でパーミッションや実装の悪さを確認できます'); ?></p>
    <?php readfile("ad.txt");?>
    <?php the_end: ?>
</body>
</html>
