<?php
include('xmlBrazilNF.php');

$xmlBrazilNF = new xmlBrazilNF();
$xmlBrazilNF->pathFile = 'test.xml';

?>

<html>
<head>
	<meta charset="utf-8">
</head>
<body>
<?php
echo (($xmlBrazilNF->getXMLFile()));
?>
</body>
</html>
