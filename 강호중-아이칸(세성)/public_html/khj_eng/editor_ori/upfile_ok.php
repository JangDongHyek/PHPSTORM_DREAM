<?
##-------------------------------------------------------------------##
##  ���α׷��� : gmEditor v1.0
##-------------------------------------------------------------------##
##  ���� ���� �Ϸ��� : 2006-01-05
##  ���߻� �� ���۱��� : PHP����
##  ������Ʈ : http://www.phpmonster.co.kr
##  �� �� �� : �ڿ��� (misnam@gmail.com)
##-------------------------------------------------------------------##
##                           ī�Ƕ���Ʈ
##-------------------------------------------------------------------##
##  �� ���α׷��� ���� ���α׷����� �����˴ϴ�.
##  gmEditor�� GNU General Public License(GPL) �� �����ϴ�.
##  ���� �ڼ��� ������ LICENSE�� �����Ͻʽÿ�.
##  ����: http://korea.gnu.org/people/chsong/copyleft/gpl.ko.html
##-------------------------------------------------------------------##
##                           ����ȯ��
##-------------------------------------------------------------------##
##  ���� OS : IE 5 �̻�
##  ����ȯ�� : Win XP
##  IE ���� ȯ�濡���� �ùٷ� �۵����� ���� �� �ֽ��ϴ�.
##-------------------------------------------------------------------##


// �̹����� ����Ǵ� ���
$dir = "./upload";


/*
*************************   �޼����� ������ �ڷ� �̵�   *************************
*/
function goBack($message){
	echo"
		<script language='javascript'>
		window.alert('".$message."');
		history.go(-1);
		</script>
	";
	exit;
} // end func


/*
*************************   ���� ȣ��Ʈ���� �Ѿ�Դ��� üũ   *************************
*/
function referer(){

	$referer = explode('/',preg_replace("/http:\/\//",'',$_SERVER[HTTP_REFERER]));

	if ($referer[0] <> $_SERVER[HTTP_HOST]) {

		echo"
			<script language='javascript'>
				window.alert('Not a possibility of searching the Root');
				history.go(-1);
			</script>
		";
		exit;
	}

} // end func


referer();



if($_SERVER['REQUEST_METHOD'] <> 'POST') {

	goBack('�������� ������� �����Ͻʽÿ�.');
}



// ���ε� ���丮�� �ִ��� üũ 
if (!@is_dir($dir)) {
	goBack('���ε� ������ �������� �ʽ��ϴ�.');
}

// ���ε� ������ �۹̼� 707���� üũ
if(substr(decoct(fileperms($dir)),2) <> 707){
	goBack("���ε� ������ �۹̼� 707�� ������ �ּ���.");
}



/***************************************************************************************
*************************   ���� ����
****************************************************************************************/
//�뷮üũ
if($_FILES['upfile']['size'] > 1024000){
	goBack('�̹����뷮���� 1Mbyte�� �ʰ��Ͽ����ϴ�.');
}
if(is_uploaded_file($_FILES['upfile']['tmp_name']) && ($_FILES['upfile']['size'] > 0)) {

	$upfile = time().'.jpg';

	$tmp_file = @getimagesize($_FILES['upfile']['tmp_name'],&$type);

	/*
		(1) = gif, (2) = jpg, (3) = png, (4) = swf, (5) = psd, (6) = bmp  
	*/
	if(($tmp_file[2] != 1) && ($tmp_file[2] != 2) && ($tmp_file[2] != 6)) {
		goBack('GIF,JPG,BMP Ȯ���ڰ� ���ε� �����մϴ�.');
	}

	if(!@move_uploaded_file($_FILES['upfile']['tmp_name'],$dir.'/'.$upfile)) {
		@unlink($dir.'/'.$upfile);
		goBack('�̹��������ϴµ� �����Ͽ����ϴ�.');
	}
	@chmod($dir.'/'.$upfile,0606);
}




/***************************************************************************************
*************************   ������ �����Ϳ� ����
****************************************************************************************/
if(is_file($dir.'/'.$upfile)){

	$imgsize = (int)$_POST['imgsize'];
	$title = addslashes($_POST['title']);
	$alignment = $_POST['alignment'];
	$upfile_ok = $dir.'/'.addslashes($upfile);

	ECHO "<script language='javascript'>\n";
	ECHO "<!--\n";
	ECHO "	var key_2 = '".$alignment."';\n";
	ECHO "	val = '<TABLE border=\"0\" cellSpacing=\"0\" cellPadding=\"0\" align=\"' + key_2 + '\">';\n";
	ECHO "	val += '	<TR>';\n";
	ECHO "	val += '		<TD align=center>';\n";
	ECHO "	val += '		<img src=\"".$_POST['url'].'/'.$upfile_ok."\" ";

	if(!empty($imgsize)) ECHO " width=\"".$imgsize."\"";

	ECHO ">';\n";

	ECHO "	val += '		</TD>';\n";
	ECHO "	val += '	</TR>';\n";

// �������� �ִٸ� ����
	if(!empty($title)){
		
		ECHO "	val += '	<TR bgcolor=\"#DEDEDE\">';\n";
		ECHO "	val += '		<TD>';\n";
		ECHO "	val += '		&nbsp;".$title."'\n";
		ECHO "	val += '		</TD>';\n";
		ECHO "	val += '	</TR>';\n";
	}

	ECHO "	val += '</TABLE>';\n";
	ECHO "	window.opener.HTMLPaste(val);\n";
	ECHO "	window.close();\n";
	ECHO "//-->\n";
	ECHO "</script>\n";
}
else{

	ECHO "<script language='javascript'>\n";
	ECHO "<!--\n";
	ECHO "	window.close();\n";
	ECHO "//-->\n";
	ECHO "</script>\n";
}
?>
