#!/usr/local/bin/php -q
<?
$HostName = "localhost";
$DbName = "jsbusan";
$Admin = "jsbusan";
$AdminPass = "ffpcm080";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);

$file = "/home/jsbusan/Book1.csv"; 
$SQL="LOAD DATA LOCAL INFILE '".$file."' INTO TABLE loaddata FIELDS TERMINATED BY ','"; 
$dbresult = mysql_query($SQL, $dbconn);
exec($dbresult);
?>