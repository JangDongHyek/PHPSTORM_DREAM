<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<?
if($flag == "update"){



$sql = "select * from item where sea_num='$sea_num' and sung_num='$sung_num' and khan_num='$khan_num' and last_num='$last_num' and sudong_num='$sudong_num'";

$res = mysql_query($sql,$dbconn);
$count = mysql_num_rows($res);
if($count > 0){
			echo ("
		<script language='javascript'>
			alert(\"중복된 고유번호가 있습니다.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;	
}


$sql = "select * from item where sea_num='$sea_num' and sung_num='$sung_num' and khan_num='$khan_num' and last_num='$last_num' and item_code='$item_code'";
$res = mysql_query($sql,$dbconn);
$count = mysql_num_rows($res);
if($count > 0){
			echo ("
		<script language='javascript'>
			alert(\"중복된 회원번호가 있습니다.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;	
}
############################# 이미지 용량 및 사이즈 제한 ##############################
	if (isset($img_big_name)&&($img_big_name != "")){
		$size_big = filesize($img_big);
		$size_width_big = getimagesize($img_big);
		if($size_big > 5120000){
			echo ("
		<script language='javascript'>
			alert(\"1번 이미지의 크기는 5Mbyte를 넘을 수 없습니다.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
	}
#######################################################################################
	//$opt = $op1."=".$op2."=".$op3;
	$opt=$op_name1;



	if((isset($img_big_name)&&($img_big_name != "")) || $del_big == "y"){ // 화일 입력난이 공란아니고
		if($img_big_updateflag=="ok"){ // 화일 업데이트 되었고..
			if($img_big_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_big_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_big_old"); // 삭제...
				}
			}
		}
			
	}
	
					
	
		//================== 업로드 파일을 불러옴 ================================================
		include "../../upload.php";
		$upload = "$Co_img_UP"."$mart_id/";
		//================== 첨부 파일을 업로드함 ================================================
##################################img_big###############################################
	
	if (isset($img_sml_name)&&($img_sml_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}


		
		if( $img_sml_name ){


			$file = FileUploadName( "", "$upload", $img_sml, $img_sml_name );//파일을 업로드 함

			if( !$file ){
				echo("
					<script>
					window.alert('파일 업로드에 실패했습니다.');
					history.go(-1)
					</script>
				");
				exit;
			}
		}
	}
	if (isset($img_name)&&($img_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}


		
		if( $img_name ){


			$file = FileUploadName( "", "$upload", $img, $img_name );//파일을 업로드 함

			if( !$file ){
				echo("
					<script>
					window.alert('파일 업로드에 실패했습니다.');
					history.go(-1)
					</script>
				");
				exit;
			}
		}
	}
	if (isset($img_big_name)&&($img_big_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}


		
		if( $img_big_name ){


			$file = FileUploadName( "", "$upload", $img_big, $img_big_name );//파일을 업로드 함

			if( !$file ){
				echo("
					<script>
					window.alert('파일 업로드에 실패했습니다.');
					history.go(-1)
					</script>
				");
				exit;
			}
		}
	}
###########################################################################################




	if($img_big_updateflag=="ok" && $img_big_name != ""){
		$img_big_new = "item_big_".$item_no."_".$img_big_name;
	}





	if($img_big_updateflag=="ok" && $img_big_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big_name"))
		copy ("$Co_img_UP$mart_id/$img_big_name","$Co_img_UP$mart_id/$img_big_new" );	//업로드 파일 저장
	}


	//임시화일 삭제
	if($img_big_updateflag=="ok" && $img_big_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big_name"))
			unlink("$Co_img_UP$mart_id/$img_big_name");
	}



	
	
	
	
	################################ 이미지 매직 ##################################33
	$rg_file1_path = "$Co_img_UP$mart_id/$img_big_new";

	/*
	$FileName : 파일명
	$ori_path : 원본파일경로
	$maxItem_no_1 : 가장최근글번호 + 1한값
	$mart_id : 계정 아이디
	맨마지막숫자 : 유일성을 두기위해

	썸네일 경로중 home2를 최신서버로 옮길시 home로 변경
	*/
	function MakeThum1($FileName,$ori_path,$maxItem_no_1,$mart_id,$unique) 
	{
			$ThumFileName120 = $maxItem_no_1."_".$unique."_".$FileName."120.gif";
			
			$FileName = $ori_path;
			$ThumFileName120 = "/home/".$mart_id."/public_html/co_img/".$mart_id."/" . $ThumFileName120;
			
			exec ("convert -geometry 120x $FileName $ThumFileName120");




			if(file_exists("$ori_path")){ 
				unlink ("$ori_path");	
			}



	}

	################################ 이미지 매직 ##################################33
	
	
	if(isset($img_big_name)&&($img_big_name != "")){ // 화일 입력난이 공란아니고

		
		MakeThum1($img_big_name,$rg_file1_path,$item_no,$mart_id,1); 

		
		
		$img_big_new_th =  $item_no."_1_".$img_big_name."120.gif";

		
		
		
		$img_big_query = ", img_big='$img_big_new_th'";
	}
	




	
	//대기회원 회원등록시 필요한 필드들
	$sql0 = "select * from item where item_no='$item_no'";
	$res0 = mysql_query($sql0,$dbconn);
	$row0 = mysql_fetch_array($res0);

	$sql09 = "SELECT * FROM category WHERE sea_num='$row0[sea_num]' AND sung_num='$row0[sung_num]' AND khan_num='$row0[khan_num]' AND last_num='$row0[last_num]'";
	$res09 = mysql_query($sql09,$dbconn);
	$row09 = mysql_fetch_array($res09);




	$sql = "select * from category where g_id='$row09[g_id]'";
	$res = mysql_query($sql,$dbconn);
	$row = mysql_fetch_array($res);


	$sql2 = "select * from category where category_num='$row[prevno]'";
	$res2 = mysql_query($sql2,$dbconn);
	$row2 = mysql_fetch_array($res2);


	$sql3 = "select * from category where category_num='$row2[prevno]'";
	$res3 = mysql_query($sql3,$dbconn);
	$row3 = mysql_fetch_array($res3);

	$firstno=$row3[category_num];
	$prevno=$row2[category_num];
	$thirdno=$row[category_num];
	$category_num= $row[category_num];
	$provider_id =$Mall_Admin_ID;



	$SQL = "select * from $CategoryTable where g_id='$_SESSION[Mall_Admin_ID]'";
	$dbresult = mysql_query($SQL, $dbconn);
	$rows = mysql_fetch_array($dbresult);
	$my_category_num = $rows[category_num];
	$category_limit_start = $rows[category_limit_start];
	$category_limit_end = $rows[category_limit_end];
	$SQL = "select max(item_code) from $ItemTable where if_hide='0' and category_num='$my_category_num'";
	$dbresult = mysql_query($SQL, $dbconn);
	$max_item_code = mysql_result($dbresult,0,0);

	if(!$max_item_code){
		$final_item_code = $category_limit_start;
	}else{	
		$final_item_code = $max_item_code + 1;
	}
	if($category_limit_end >= $final_item_code){
		$item_code = $final_item_code;
	}else{
		echo "
		 <script>	
			alert(\"더 이상의 회원을 등록할 수 없습니다.\");
			hisgory.go(-1);
		</script>
		";
	}




	$add_query=" ,firstno='$firstno',prevno='$prevno',thirdno='$thirdno',category_num='$category_num', sudong_num='$sudong_num', item_code='$item_code',provider_id ='$provider_id ' ";
	
	
	
	
	$short_explain = str_replace( "\n", "<br>", $short_explain );
	if($item_pw){
	$item_pw_qry = ", item_pw='$item_pw'";
	}










	$SQL = "update $ItemTable set item_name='$item_name', start_date='$start_date', end_date='$end_date', jumin1='$jumin1', jumin2='$jumin2', sex='$sex', co_name='$co_name', co_num='$co_num', tel='$tel', address2='$address2', g_margin='$g_margin', zip='$zip', bonus='$bonus', use_bonus='$use_bonus', address='$address', job='$job',hobby='$hobby' $img_query $img_big_query $img_big2_query $img_big3_query $img_big4_query $img_big5_query,  doctype='$doctype', item_explain='$item_explain', short_explain='$short_explain', reg_date='$reg_date',  mobile='$mobile', email='$email',com_bank_name='$com_bank_name', com_bank_account='$com_bank_account', com_bank_master='$com_bank_master', my_bank_name='$my_bank_name', my_bank_account='$my_bank_account', my_bank_master='$my_bank_master' , provider_id='$provider_id' $add_query $item_pw_qry $img_sml_query , img_high='$img_high_new' where item_no='$item_no' and mart_id='$mart_id'";



	$dbresult = mysql_query($SQL, $dbconn);
	
	if( $dbresult ){
		echo "
			<script>
				alert('회원으로 등록 되었습니다.');
			</script>
		";

			echo "<meta http-equiv='refresh' content='0; URL=mem_list.php?item_no=$item_no&category_num=$category_num&page=$page&searchword=$searchword&pu=$pu'>";
	}else{
		echo "
			<script>
				alert('상품 수정에 실패했습니다');
				history.go(-1);
			</script>
		";
		exit;
	}





}	
?>