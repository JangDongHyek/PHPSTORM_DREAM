<html>
<head></head>

<?
include_once('./func_editor.php');
$content = "�����Դϴ�.";
?>

<body>
<form action="#" method="post" name="add_form">

<?=myEditor(1,'.','add_form','content','100%','200');?>

<input type="button" value="�۾���" onClick="editor_wr_ok();">
</form>
</body>
</html>