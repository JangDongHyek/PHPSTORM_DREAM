<?php
/**
이지웹에디터 PHP 이미지 삽입
2007-01-02
*/

//-----------------------------------------------------
//서버경로에 맞게 수정

$abs_dir = "./tmp";   //파일저장 절대경로
$web_dir = "./editor/tmp";                  //웹경로
//-----------------------------------------------------


//업로드 이미지 저장
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
        echo "<script>alert('이미지 첨부 에러입니다!'); self.close(); </script>";
    }

    exit;
} //end if
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>이미지 삽입</title>
<style>
body {
    background: threedface;
    color: windowtext;
    margin: 10px;
    border-style: none;
    font:9pt 돋움;
    text-align:center;
}
body, button, div, input, select, td, legend { font:9pt 돋움; }
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
    if(!src.match(/\.(gif|jpg|png)$/i)) { alert("이미지파일을 첨부 해주세요!"); return; }
    f.submit();
}
function viewImage(src)
{
    var str = "";
    var f=document.tform;
    if(!src.match(/\.(gif|jpg|png)$/i))  { alert("gif,jpg,png 파일만 첨부 가능합니다!"); return; }
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
        str = "미리보기 지원은 MS IE 에서만 가능!"; 
    document.getElementById("td_img").innerHTML = str;
}
//-->
</script>
</head>

<body scroll="no">
<form name="tform" method="post" enctype="multipart/form-data">

    <fieldset>
    <legend>미리보기</legend>
    <table border=0 cellspacing=0 cellpadding=0 width="100%">
    <tr><td align="center" style="height:150px" id="td_img"></td></tr></table>
    </fieldset>
    
    <fieldset>
    <legend>이미지 선택</legend>
    <input type="file" name="upimage" style="width:100%" onchange="viewImage(this.value)" />
    </fieldset>

    <fieldset>
    <legend>옵션</legend>
    <table border=0 cellspacing=6 cellpadding=0>
    <tr>
    <td>정렬</td>
    <td>
    <select name="align">
    <option value="" selected>없음
    <option value="baseline">기준선</option>
    <option value="top">위쪽</option>
    <option value="middle">가운데</option>
    <option value="bottom">아래쪽</option>
    <option value="texttop">문자열 위쪽</option>
    <option value="absmiddle">선택 영역의 가운데</option>
    <option value="absbottom">선택 영역의 아래쪽</option>
    <option value="left">왼쪽</option>
    <option value="right">오른쪽</option>
    </select>
    </td>
    </tr>
    <tr>
    <td>가로*세로</td>
    <td>
    <input type="text" name="width" value="" size="3" maxlength=3> * 
    <input type="text" name="height" value="" size="3" maxlength=3>px
    </td>
    </tr>
    <tr>
    <td>두께</td>
    <td>
    <input type="text" name="border" value="0" size="2" maxlength=1>px
    </td>
    </tr>
    </table>
    </fieldset>

    <button onclick="insertImage()">확인</button>

</form>
</body>
</html> 
