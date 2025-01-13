<?php
include_once('./_common.php');
ini_set("display_errors",1);
error_reporting(E_ALL);
require_once './php_excel_reader/excel_reader2.php';
$xls = new Spreadsheet_Excel_Reader();
$xls->setOutputEncoding('utf-8');
$xls->read('./a.xls');

error_reporting(E_ALL ^ E_NOTICE);

echo "<table border=1 style='font-size:13px; border-collapse:collapse;'>";
echo "<tr>";
echo "<th style='width:90px;'>회원권한</th>";
echo "<th style='width:120px;'>회원구분</th>";
echo "<th style='width:110px;'>아이디</th>";
echo "<th style='width:110px;'>비밀번호</th>";
echo "<th style='width:70px;'>이름</th>";
echo "<th style='width:110px;'>휴대폰번호</th>";
echo "<th style=''>sql문</th>";
echo "<tr>";
for ($i = 1; $i <= $xls->sheets[0]['numRows']; $i++) {
	$mb_id = trim(str_replace(' ','',$xls->sheets[0]['cells'][$i][3]));
	$mb_password = trim(str_replace(' ','',$xls->sheets[0]['cells'][$i][4]));
	$mb_password = get_encrypt_string($mb_password);
	$mb_name = trim(str_replace(' ','',$xls->sheets[0]['cells'][$i][5]));
	$mb_1 = trim(str_replace(' ','',$xls->sheets[0]['cells'][$i][2]));
	$mb_hp = trim(str_replace(' ','',$xls->sheets[0]['cells'][$i][6]));

	echo "<tr>";
?>

<td style="padding:5px 5px;"><?php echo $xls->sheets[0]['cells'][$i][1] ?></td>
<td style="padding:5px 5px;"><?php echo $xls->sheets[0]['cells'][$i][2] ?></td>
<td style="padding:5px 5px;"><?php echo $xls->sheets[0]['cells'][$i][3] ?></td>
<td style="padding:5px 5px;"><?php echo $xls->sheets[0]['cells'][$i][4] ?></td>
<td style="padding:5px 5px;"><?php echo $xls->sheets[0]['cells'][$i][5] ?></td>
<td style="padding:5px 5px;"><?php echo $xls->sheets[0]['cells'][$i][6] ?></td>
<td style="padding:5px 5px;">
<?php
//$sql = " insert into g5_member set mb_id='{$mb_id}', mb_password='{$mb_password}', mb_name='{$mb_name}', mb_level='3', mb_1='{$mb_1}', mb_hp='{$mb_hp}', mb_datetime='".date('Y-m-d H:i:s')."', mb_mailling='1', mb_sms='1', mb_open='1' ";
//if(sql_query($sql)){
	//echo 'ok';
//}else{
	//echo 'xxxxxxxxxxxx';
//}
?>
</td>

<?php
	echo "</tr>\n";
}
echo "</table>";

echo $i;
?>