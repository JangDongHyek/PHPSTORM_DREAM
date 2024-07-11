<?
##-------------------------------------------------------------------##
##  프로그램명 : gmEditor v1.0
##-------------------------------------------------------------------##
##  최초 개발 완료일 : 2006-01-05
##  개발사 및 저작권자 : PHP몬스터
##  웹사이트 : http://www.phpmonster.co.kr
##  개 발 자 : 박요한 (misnam@gmail.com)
##-------------------------------------------------------------------##
##                           카피라이트
##-------------------------------------------------------------------##
##  본 프로그램은 무료 프로그램으로 배포됩니다.
##  gmEditor는 GNU General Public License(GPL) 를 따릅니다.
##  보다 자세한 내용은 LICENSE를 참조하십시요.
##  참고: http://korea.gnu.org/people/chsong/copyleft/gpl.ko.html
##-------------------------------------------------------------------##
##                           개발환경
##-------------------------------------------------------------------##
##  지원 OS : IE 5 이상
##  개발환경 : Win XP
##  IE 외의 환경에서는 올바로 작동하지 않을 수 있습니다.
##-------------------------------------------------------------------##


// 이미지가 저장되는 경로
$dir = "./upload";


/*
*************************   메세지를 보내고 뒤로 이동   *************************
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
*************************   같은 호스트에서 넘어왔는지 체크   *************************
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

	goBack('정상적인 방법으로 접근하십시요.');
}



// 업로드 디렉토리가 있는지 체크 
if (!@is_dir($dir)) {
	goBack('업로드 폴더가 존재하지 않습니다.');
}

// 업로드 폴더의 퍼미션 707인지 체크
if(substr(decoct(fileperms($dir)),2) <> 707){
	goBack("업로드 폴더의 퍼미션 707로 변경해 주세요.");
}



/***************************************************************************************
*************************   파일 전송
****************************************************************************************/
//용량체크
if($_FILES['upfile']['size'] > 1024000){
	goBack('이미지용량제한 1Mbyte를 초과하였습니다.');
}
if(is_uploaded_file($_FILES['upfile']['tmp_name']) && ($_FILES['upfile']['size'] > 0)) {

	$upfile = time().'.jpg';

	$tmp_file = @getimagesize($_FILES['upfile']['tmp_name'],&$type);

	/*
		(1) = gif, (2) = jpg, (3) = png, (4) = swf, (5) = psd, (6) = bmp  
	*/
	if(($tmp_file[2] != 1) && ($tmp_file[2] != 2) && ($tmp_file[2] != 6)) {
		goBack('GIF,JPG,BMP 확장자가 업로드 가능합니다.');
	}

	if(!@move_uploaded_file($_FILES['upfile']['tmp_name'],$dir.'/'.$upfile)) {
		@unlink($dir.'/'.$upfile);
		goBack('이미지복사하는데 실패하였습니다.');
	}
	@chmod($dir.'/'.$upfile,0606);
}




/***************************************************************************************
*************************   내용을 에디터에 삽입
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

// 참조글이 있다면 삽입
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
