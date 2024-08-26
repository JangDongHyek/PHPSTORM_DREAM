<html>
<head></head>

<?
include_once('./func_editor.php');
$content = "샘플입니다.";
?>

<body>
<form action="#" method="post" name="add_form">

<?=myEditor(1,'.','add_form','content','100%','200');?>

<input type="button" value="글쓰기" onClick="editor_wr_ok();">
</form>
</body>
</html>