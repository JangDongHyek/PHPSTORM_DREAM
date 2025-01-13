<?php
header("Content-Type: text/html; charset=UTF-8");

ini_set("display_errors",1);
error_reporting(E_ALL);
require_once 'excel_reader2.php';
$xls = new Spreadsheet_Excel_Reader("a.xls");
?>
<html>
<head>
<meta charset="utf-8">
</head>
<body>

<?php
echo $xls->rowcount();
?>

<!--
<table border="1">
<? for ($row=1;$row<=$xls->rowcount();$row++) { ?>
	<tr>
	<? for ($col=1;$col<=$xls->colcount();$col++) {	?>
		<td><?= $xls->val($row,$col) ?>&nbsp;
		<div><br>Format=<?=$xls->format($row,$col)?><br>FormatIndex=<?=$xls->formatIndex($row,$col)?><br>Raw=<?=$xls->raw($row,$col)?></div></td>
	<? } ?>
	</tr>
<? } ?>
</table>
-->

</body>
</html>
