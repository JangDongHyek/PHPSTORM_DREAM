<?php
$sub_menu = "200100";
include_once('./_common.php');

$role = trim($_POST['role']);

$sql = " select * from g5_code where co_code_name = '사회적 역할' and co_main_code_value = '{$role}' order by co_code*1 ";
$result = sql_query($sql);

$option = array();
for($i=0;$row=sql_fetch_array($result);$i++) {
?>
    <option value="<?=$row['co_code']?>"><?=$row['co_middle_code_value']?></option>
<?php
}
?>