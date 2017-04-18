<html><head><title>var_dump Result</title>
<link rel="stylesheet" href="/css/main.css" />
</head>
<body>

<?php
use vardump\VarDumpParser;

include "functions.php";

if(!isset($_POST["dump"])){
	header("Location: varDump.php");
	return;
}

$parser = new VarDumpParser($_POST["dump"]);

try{
	$var = $parser->readVar();
	echo "<p>Variable content:</p>";
	$var->presentInHtml();
}
catch(Exception $e){
	echo "Error parsing dump: <code>{$e->getMessage()}</code>";
}

?>


</body>
</html>
