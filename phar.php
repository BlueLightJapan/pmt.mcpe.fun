<?php
include("lang/setlang.php");
define('PACKAGE', 'phar');

// gettext setting
bindtextdomain(PACKAGE, 'lang'); // or $your_path/lang, ex: /var/www/test/lang
textdomain(PACKAGE);
?>
<html>
<head>
	<title><?php echo _('Pharの作成'); ?></title>
	<link rel="stylesheet" href="/css/main.css" />
	<script>
	function fillPmStub(){
		document.getElementById("stubInput").value = '<?= "<?php" ?> define("pocketmine\\\\PATH", "phar://". __FILE__ ."/"); require_once("phar://". __FILE__ ."/src/pocketmine/PocketMine.php");  __HALT_COMPILER();';
	}
	</script>
</head>
<body>
	<h1><?php echo _('Pharメーカー'); ?></h1>
	<h3><?php echo _('使い方'); ?></h3>
	<ol>
		<li><?php echo _('もちろん、プラグインのコードそのものは書いてください　:D'); ?></li>
		<li><?php echo _('正しい形（namespace)などのファイルやフォルダを用意してくださ'); ?></li>
		<li><?php echo _('zipで圧縮してください。 ZIPファイルのどこにでもファイルを置けますが, plugin.ymlとsrcフォルダとその中身は正しく入れてください。'); ?></li>
		<li><?php echo _('それをアップロードしてください :)'); ?></li>
	</ol>

	<form method="post" action="/phar-result.php" enctype="multipart/form-data">
		<p><input type="file" name="file"></p>
        <?php readfile("ad.txt");?>
		<p><?php echo _('スタブ (知らない設定はそのままにしてください):'); ?>
			<?php
			echo '<input type="text" name="stub" value="';
			echo '<?php __HALT_COMPILER();';
			echo '" size="100" id="stubInput">';
			?>

			<button onclick="fillPmStub(); return false;"><?php echo _('PocketMine-MP.pharのスタブを使うか'); ?></button>
		</p>
		<p><?php echo _('プラグイン調整機能:'); ?> <br>
			<input type="checkbox" name="tune_top_namespace_optimization">
				<?php echo _('定数参照を最適化するには、<code>\</code> 接頭語を追加して、それが最上位名前空間参照であ​ることを示します。'); ?><br>
			<input type="checkbox" name="tune_obfuscation"> <?php echo _('コードの難読化（BluelightやGenisysなどのプラグイン開発者はこれを使ってはいけない可能性があります'); ?>
		</p>
		<p><font color="#8b0000"><?php echo _('注意: これらの機能は、php内のコメントを消してしまう恐れがあります'); ?></font></p>
		<p>
			<?php echo _('検査機能:'); ?> <br>
			<input type="checkbox" name="inspection_classpath"> <?php echo _('クラスパスのチェック'); ?><br>
			<input type="checkbox" name="inspection_bad_practice"> <?php echo _('悪い実装の調査 '); ?><br>
			<input type="checkbox" name="inspection_lint"> <?php echo _('シンタックスエラーの調査'); ?>
		</p>
        <?php readfile("ad.txt");?>
		<p><input type="submit" value="<?php echo _('pharの作成'); ?>"></p>
	</form>
	<p><?php echo _('New: フレームページを使ってください <a href="pm.php" target="_parent">ここ</a> (もし使っていなければ）'); ?></p>
<pre>
	<?php echo _("免責事項：
	このサービスは無料で提供されており、常に利用可能であることが保証されていません。
	作業の過程で、 ファイルは、 （ウェブサイトからアクセス可能でないであろう）サーバのファイルシステム上のファイルに抽出し、一定期間保管します。
	私たちは（このウェブサイトの所有者）は、著作権侵害やその他の違法行為に関連する行為のための責任を負いません。"); ?>
</pre>
</body>
</html>
