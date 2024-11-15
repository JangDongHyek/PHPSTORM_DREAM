<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";

if( !$MemberLevel || ($MemberLevel > 2) ){
	echo("
		<script>
		parent.location.href='../login.html';
		</script>
	");
	exit;
}
?>
<?
if($flag == "update"){

	//================== 업로드 파일을 불러옴 ================================================
	include "../../upload.php";
	$upload = "$UploadRoot/$mart_id/";
	//================== 첨부 파일을 업로드함 ================================================
	
	/* 메인 슬라이드 이미지 업로드 시작 */
	for($i=1;$i<6;$i++){
		if($_FILES['slideImg'.$i]['name']){
			$dotIndexOf=strpos($_FILES['slideImg'.$i]['name'],".")+1;
			$imgLength=strlen($_FILES['slideImg'.$i]['name']);
			$ext=substr($_FILES['slideImg'.$i]['name'],$dotIndexOf,$imgLength);//확장자
			$uploadPath=$upload;
			$filename=date("YmdHis").$i.".".$ext;
			${upslideImg.$i}=$filename;
			move_uploaded_file($_FILES['slideImg'.$i]['tmp_name'],$uploadPath.$filename);
		}else{
			if(!${slideImg.$i._del}){
				${upslideImg.$i}=${old_slideImg.$i};
			}else{
				${upslideImg.$i}="";
				@unlink("../../data/icon/".${old_slideImg.$i});
			}
		}
	}
	/* 메인 슬라이드 이미지 업로드 시작 */
	for($i=1;$i<6;$i++){
		if($_FILES['mobileslideImg'.$i]['name']){
			$dotIndexOf=strpos($_FILES['mobileslideImg'.$i]['name'],".")+1;
			$imgLength=strlen($_FILES['mobileslideImg'.$i]['name']);
			$ext=substr($_FILES['mobileslideImg'.$i]['name'],$dotIndexOf,$imgLength);//확장자
			$uploadPath=$upload;
			$filename=date("YmdHis").$i.".".$ext;
			${upmobileslideImg.$i}=$filename;
			move_uploaded_file($_FILES['mobileslideImg'.$i]['tmp_name'],$uploadPath.$filename);
		}else{
			if(!${mobileslideImg.$i._del}){
				${upmobileslideImg.$i}=${old_mobileslideImg.$i};
			}else{
				${upmobileslideImg.$i}="";
				@unlink("../../data/icon/".${old_mobileslideImg.$i});
			}
		}
	}
	$SQL = "update $MartInfoTable set name='$name', shopname='$shopname', passport='$passport', ".
	"email = '$email', tel1 = '$tel1', tel2 = '$tel2', place = '$place' where mart_id='$mart_id'";
	
	$dbresult = mysql_query($SQL, $dbconn); 
	
	if($xpay_id && $xpay_key){ //lg u+ 상점아디키,머트키
		$xpay_query=" , xpay_id='$xpay_id', xpay_key='$xpay_key'";
	}

	$SQL = "update $MartMngInfoTable set
	slideImg1='$upslideImg1',
	slideLink1='$_POST[slideLink1]',
	slideImg2='$upslideImg2',
	slideLink2='$_POST[slideLink2]',
	slideImg3='$upslideImg3',
	slideLink3='$_POST[slideLink3]',
	slideImg4='$upslideImg4',
	slideLink4='$_POST[slideLink4]',
	slideImg5='$upslideImg5',
	slideLink5='$_POST[slideLink5]',
	mobileslideImg1='$upmobileslideImg1',
	mobileslideLink1='$_POST[mobileslideLink1]',
	mobileslideImg2='$upmobileslideImg2',
	mobileslideLink2='$_POST[mobileslideLink2]',
	mobileslideImg3='$upmobileslideImg3',
	mobileslideLink3='$_POST[mobileslideLink3]',
	mobileslideImg4='$upmobileslideImg4',
	mobileslideLink4='$_POST[mobileslideLink4]',
	mobileslideImg5='$upmobileslideImg5',
	mobileslideLink5='$_POST[mobileslideLink5]'
	where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn); 
	
	
	
	echo "<meta http-equiv='refresh' content='0; URL=banner_setting.php'>";
}else if( $flag == "insert" ){
	//$sql0 = "insert into";
}

mysql_close($dbconn);
?>