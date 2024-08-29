<?
	$path="./up/jsbusan";
	$fileName=$_FILES[ex_file][name];
	move_uploaded_file($_FILES[ex_file][tmp_name],$path."/".$fileName);
	$fp=fopen($path."/".$fileName);
	$csv=fread($fp,30);
	echo $csv;
?>