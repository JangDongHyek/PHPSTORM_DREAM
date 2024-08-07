<?php
$sub_menu = "200100";
include_once('./_common.php');
header( "Content-type: application/vnd.ms-excel" );   
header( "Content-type: application/vnd.ms-excel; charset=utf-8");  
header( "Content-Disposition: attachment; filename = member.xls" );   
header( "Content-Description: PHP4 Generated Data" ); 
print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel; charset=utf-8\">"); 
$sql_common = " from {$g5['member_table']} ";

$sql_search = " where (1) ";
if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}
$sql_order = " order by {$sst} {$sod} ";

$g5['title'] = '회원관리';

$sql = " select * {$sql_common} {$sql_search} {$sql_order}  ";
$result = sql_query($sql);

?>
<table border="1">
	<thead>
		<tr>
			<th>아이디</th>
			<th>성명</th>
			<th>이메일</th>
			<th>연락처</th>
			<th>휴대폰번호</th>
			<th>우편번호</th>
			<th>주소</th>
			<th>상세주소</th>
			<th>가입일</th>
			<th>포인트</th>
		</tr>
	</thead>
	<tbody>
		<?php
			for($i=0;$row=sql_fetch_array($result);$i++){
		?>
		<tr>
			<td><?php echo $row[mb_id]?></td>
			<td><?php echo $row[mb_name]?></td>
			<td><?php echo $row[mb_email]?></td>
			<td><?php echo $row[mb_tel]?></td>
			<td><<?php echo $row[mb_hp]?>/td>
			<td><?php echo $row[mb_zip1].$row[mb_zip2]?></td>
			<td><?php echo $row[mb_addr1]?></td>
			<td><?php echo $row[mb_addr2]?></td>
			<td><?php echo $row[mb_datetime]?></td>
			<td><?php echo $row[mb_point]?></td>
		</tr>
		<?php }?>
	</tbody>

</table>