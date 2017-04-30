<?php
include "functions.php";
?><html>
<head>
	<title>Phar展開結果</title>
	<link rel="stylesheet" href="/css/main.css" />
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script>
		$(document).ready(function(){
			var dl = $("#dlButton");
			if(typeof pmt.agree.lock !== typeof undefined){
				var agreeKey = "yes";
				if(typeof pmt.agree.key !== typeof undefined){
					agreeKey = pmt.agree.key;
				}else{
					agreeLock += "\nType \"yes\" 下の規約に同意するならばボタンを押してください";
				}
				if(prompt(pmt.agree.lock).toLowerCase() != agreeKey.toLowerCase()){
					alert("利用規約に同意してください！");
					window.location.replace("/unphar.php");
					return;
				}
			}
			dl.css("display", "block");
		});
	</script>
</head>
<body>
<?php
if(!isset($_FILES["file"])){
	http_response_code(400);
	echo <<<EOD
<h1>400 Bad Request</h1>
<p>postでファイルをアップロードしてください</p>
EOD;
	return;
}
$file = $_FILES["file"];
if($file["error"] !== 0){
	echo "<h1>失敗</h1>";
	echo "不適切なアップデート: ";
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
	goto end;
}
unphar_toZip($file["tmp_name"], $result, substr($file["name"], 0, -5));
$pmt = [];
/** @var string|null $tmpDir */
/** @var string|null $zipPath */
/** @var string|null $zipRelativePath */
/** @var string|null $basename */
/** @var bool $error */
extract($result);
if(!is_array($pmt)) $pmt = [];
if($error){
	goto end;
}
usage_inc("unphar", $timestamp);
echo "<script>var pmt = " + json_encode($pmt) + ";</script>";
echo <<<EOS
<h1>成功</h1>
<p>Pharはzipに変換されました<br>
<?php readfile("ad.txt");?>
 <a id="dlButton" href="$zipRelativePath">ダウンロード</a></p>
<p>２時間は少なくともダウンロード可能です</p>
EOS;
end:
?>
</body>
</html>
