<?php
/**
������������ PHP �̹��� ����
2007-01-02
*/

//-----------------------------------------------------
//������ο� �°� ����

$abs_dir = "./tmp";   //�������� ������
$web_dir = "./editor/tmp";                  //�����
//-----------------------------------------------------


//���ε� �̹��� ����
if($_FILES['upimage']['name'] && $_FILES['upimage']['size']>0)
{
    $m = substr(microtime(),2,4);
    $filename = date("YmdHis").$m.eregi_replace("(.+)(\.[gif|jpg|png])","\\2",$_FILES['upimage']['name']);
    $alt = $_FILES['upimage']['name'];
    $b = $_POST['border'];
    $width = $_POST['width'];
    $height = $_POST['height'];
    if($width) $w = "width='{$width}'";
    if($height) $h = "height='{$height}'";
    $align = $_POST['align'];
    if($align) $a = "align='{$align}'";

    $u = "{$web_dir}/{$filename}";


    $result=move_uploaded_file($_FILES['upimage']['tmp_name'], $abs_dir.'/'.$filename);

    if($result)
    {
        echo "
        <script>
        var str = \"<img src='{$u}' border='{$b}' {$w} {$h} {$a} alt='{$alt}'>\";
        opener.easyUtil._editor.innerHTML(str);
        self.close();
        </script>
        ";
    }
    else
    {
        echo "<script>alert('�̹��� ÷�� �����Դϴ�!'); self.close(); </script>";
    }

    exit;
} //end if
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>�̹��� ����</title>
<style>
body {
    background: threedface;
    color: windowtext;
    margin: 10px;
    border-style: none;
    font:9pt ����;
    text-align:center;
}
body, button, div, input, select, td, legend { font:9pt ����; }
input,select {color:highlight}
button {width:80px;}
fieldset { margin-bottom:5px;text-align:left;padding:5px }

</style>
<script type="text/javascript">
<!--
function insertImage()
{
    var str="";
    var f=document.tform;
    var src = f.upimage.value;    
    if(!src.match(/\.(gif|jpg|png)$/i)) { alert("�̹��������� ÷�� ���ּ���!"); return; }
    f.submit();
}
function viewImage(src)
{
    var str = "";
    var f=document.tform;
    if(!src.match(/\.(gif|jpg|png)$/i))  { alert("gif,jpg,png ���ϸ� ÷�� �����մϴ�!"); return; }
    if(window.showModalDialog) 
    { 
        var h_str=""; var height=0,width=0;
        var img = new Image(); img.src =src;
        f.width.value = img.width;
        f.height.value = img.height;
        if(img.height>150) h_str="150";
        if(h_str) h_str = "height='"+h_str+"'";
        str = "<img src='"+src+"' "+h_str+" />";
    }    
    else 
        str = "�̸����� ������ MS IE ������ ����!"; 
    document.getElementById("td_img").innerHTML = str;
}
//-->
</script>
</head>

<body scroll="no">
<form name="tform" method="post" enctype="multipart/form-data">

    <fieldset>
    <legend>�̸�����</legend>
    <table border=0 cellspacing=0 cellpadding=0 width="100%">
    <tr><td align="center" style="height:150px" id="td_img"></td></tr></table>
    </fieldset>
    
    <fieldset>
    <legend>�̹��� ����</legend>
    <input type="file" name="upimage" style="width:100%" onchange="viewImage(this.value)" />
    </fieldset>

    <fieldset>
    <legend>�ɼ�</legend>
    <table border=0 cellspacing=6 cellpadding=0>
    <tr>
    <td>����</td>
    <td>
    <select name="align">
    <option value="" selected>����
    <option value="baseline">���ؼ�</option>
    <option value="top">����</option>
    <option value="middle">���</option>
    <option value="bottom">�Ʒ���</option>
    <option value="texttop">���ڿ� ����</option>
    <option value="absmiddle">���� ������ ���</option>
    <option value="absbottom">���� ������ �Ʒ���</option>
    <option value="left">����</option>
    <option value="right">������</option>
    </select>
    </td>
    </tr>
    <tr>
    <td>����*����</td>
    <td>
    <input type="text" name="width" value="" size="3" maxlength=3> * 
    <input type="text" name="height" value="" size="3" maxlength=3>px
    </td>
    </tr>
    <tr>
    <td>�β�</td>
    <td>
    <input type="text" name="border" value="0" size="2" maxlength=1>px
    </td>
    </tr>
    </table>
    </fieldset>

    <button onclick="insertImage()">Ȯ��</button>

</form>
</body>
</html> 
