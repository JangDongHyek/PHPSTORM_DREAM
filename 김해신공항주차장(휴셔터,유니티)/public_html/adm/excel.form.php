<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$g5['title'] .= "";
$g5['title'] .= '회원 '.$html_title;
include_once('./admin.head.php');

?>

<form name="form" id="fmember" action="./excel.form.update.php" method="post" enctype="multipart/form-data">

<input type="file" name="file" value=""/>
<button type="submit">전송</button><br/>
<a href="./excel.search.php">검색폼가기</a>
</form>


<?php
include_once('./admin.tail.php');
?>
