<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<?
//================== 상품을 등록함 =======================================================
if($flag == "add"){
	if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
	}
	
	/*if(isset($op1)&&$op1!=""){
		$opt = $op1;
		if(isset($op2)&&$op2!=""){
			$opt = $opt."=".$op2;
			if(isset($op3)&&$op3!=""){
				$opt = $opt."=".$op3;
			}
		}
	}
	else $opt = "";
	
	$opt = $op1."=".$op2."=".$op3;*/
	$opt=$op_name1;
	$SQL = "select max(item_no), count(*) from $ItemTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0)
		$maxItem_no = mysql_result($dbresult, 0, 0);
	else
		$maxItem_no = 0;
	$maxItem_no_1 = $maxItem_no+1;
		
	if($img_sml_updateflag=="ok" && $img_sml != ""){
		$img_sml_new = "item_sml_".$maxItem_no_1."_".$img_sml;
	}
	if($img_updateflag=="ok" && $img != ""){
		$img_new = "item_".$maxItem_no_1."_".$img;
	}
	if($img_big_updateflag=="ok" && $img_big != ""){
		$img_big_new = "item_big_".$maxItem_no_1."_".$img_big;
	}
	if($img_big2_updateflag=="ok" && $img_big2 != ""){
		$img_big2_new = "item_big2_".$maxItem_no_1."_".$img_big2;
	}
	if($img_big3_updateflag=="ok" && $img_big3 != ""){
		$img_big3_new = "item_big3_".$maxItem_no_1."_".$img_big3;
	}
	if($img_big4_updateflag=="ok" && $img_big4 != ""){
		$img_big4_new = "item_big4_".$maxItem_no_1."_".$img_big4;
	}
	if($img_big5_updateflag=="ok" && $img_big5 != ""){
		$img_big5_new = "item_big5_".$maxItem_no_1."_".$img_big5;
	}
	if($img_high_updateflag=="ok" && $img_high != ""){
		$img_high_new = "item_high_".$maxItem_no_1."_".$img_high;
	}

	$jaego = str_replace( ",", "", $jaego );
	$price = str_replace( ",", "", $price );
	$z_price = str_replace( ",", "", $z_price );
	$z_price2 = str_replace( ",", "", $z_price2 );
	$z_price3 = str_replace( ",", "", $z_price3 );
	$member_price = str_replace( ",", "", $member_price );
	$short_explain = str_replace( "\n", "<br>", $short_explain );

	$SQL = "insert into $ItemTable (mart_id, firstno, prevno, category_num, item_name, price, z_price,z_price2,z_price3, g_margin, member_price, bonus,bonus2,bonus3, use_bonus, jaego, img, img_big, img_big2, img_big3, img_big4, img_big5, opt, doctype, item_explain, short_explain, reg_date, item_company, read_num, item_code, icon_no, use_opt1, use_opt23, item_order, jaego_use, if_strike, if_provide_item, provider_id, provide_price, img_sml, flash_big_width, flash_big_height, if_hide, img_high, if_cash, fee) values ('$mart_id', '$prevno2', '$prevno', '$category_num', '$item_name', '$price', '$z_price','$z_price2','$z_price3', '$g_margin', '$member_price', '$bonus','$bonus2','$bonus3', '$use_bonus','$jaego','$img_new','$img_big_new','$img_big2_new','$img_big3_new','$img_big4_new','$img_big5_new','$opt','$doctype','$item_explain', '$short_explain', '$reg_date','$item_company', 0, '$item_code', '$icon_no','$use_opt1','$use_opt23','100','$jaego_use','$if_strike','$if_provide_item', '$provider_id', '$provide_price', '$img_sml_new','$flash_big_width','$flash_big_height','$if_hide', '$img_high_new', '$if_cash', '$fee')";

	$dbresult = mysql_query($SQL, $dbconn);
	
	if($img_sml_updateflag=="ok" && $img_sml != ""){
		//echo "img_new = $img_new";
		if(file_exists("$Co_img_UP$mart_id/$img_sml"))
			copy ("$Co_img_UP$mart_id/$img_sml","$Co_img_UP$mart_id/$img_sml_new" );	//업로드 파일 저장
	}
	if($img_updateflag=="ok" && $img != ""){
		//echo "img_new = $img_new";
		if(file_exists("$Co_img_UP$mart_id/$img"))
			copy ("$Co_img_UP$mart_id/$img","$Co_img_UP$mart_id/$img_new" );	//업로드 파일 저장
	}
	if($img_big_updateflag=="ok" && $img_big != ""){
		//echo "img_new = $img_new";
		if(file_exists("$Co_img_UP$mart_id/$img_big"))
			copy ("$Co_img_UP$mart_id/$img_big","$Co_img_UP$mart_id/$img_big_new" );	//업로드 파일 저장
	}
	if($img_big2_updateflag=="ok" && $img_big2 != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big2"))
			copy ("$Co_img_UP$mart_id/$img_big2","$Co_img_UP$mart_id/$img_big2_new" );	//업로드 파일 저장
	}
	if($img_big3_updateflag=="ok" && $img_big3 != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big3"))
			copy ("$Co_img_UP$mart_id/$img_big3","$Co_img_UP$mart_id/$img_big3_new" );	//업로드 파일 저장
	}
	if($img_big4_updateflag=="ok" && $img_big4 != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big4"))
			copy ("$Co_img_UP$mart_id/$img_big4","$Co_img_UP$mart_id/$img_big4_new" );	//업로드 파일 저장
	}
	if($img_big5_updateflag=="ok" && $img_big5 != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big5"))
			copy ("$Co_img_UP$mart_id/$img_big5","$Co_img_UP$mart_id/$img_big5_new" );	//업로드 파일 저장
	}
		
	if($img_high_updateflag=="ok" && $img_high != ""){
		//echo "img_new = $img_new";
		if(file_exists("$Co_img_UP$mart_id/$img_high"))
			copy ("$Co_img_UP$mart_id/$img_high","$Co_img_UP$mart_id/$img_high_new" );	//업로드 파일 저장
	}
	
	//임시화일 삭제
	if($img_sml_updateflag=="ok" && $img_sml != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_sml"))
			unlink("$Co_img_UP$mart_id/$img_sml");
	}
	if($img_updateflag=="ok" && $img != ""){
		if(file_exists("$Co_img_UP$mart_id/$img"))
			unlink("$Co_img_UP$mart_id/$img");
	}
	if($img_big_updateflag=="ok" && $img_big != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big"))
			unlink("$Co_img_UP$mart_id/$img_big");
	}
	if($img_big2_updateflag=="ok" && $img_big2 != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big2"))
			unlink("$Co_img_UP$mart_id/$img_big2");
	}
	if($img_big3_updateflag=="ok" && $img_big3 != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big3"))
			unlink("$Co_img_UP$mart_id/$img_big3");
	}
	if($img_big4_updateflag=="ok" && $img_big4 != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big4"))
			unlink("$Co_img_UP$mart_id/$img_big4");
	}
	if($img_big5_updateflag=="ok" && $img_big5 != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big5"))
			unlink("$Co_img_UP$mart_id/$img_big5");
	}
	if($img_high_updateflag=="ok" && $img_high != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_high"))
			unlink("$Co_img_UP$mart_id/$img_high");
	}

	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$category_num&pu=$pu'>";
}
//========================================================================================
//================== 상품을 수정함 =======================================================
if($flag == "update"){


if($thumbnail == 'n'){
	$img_sml = $zimg_sml;
	$img_sml_name = $zimg_sml_name;

	$img = $zimg;
	$img_name = $zimg_name;

	$img_big = $zimg_big;
	$img_big_name = $zimg_big_name;

	$img_big2 = $zimg_big2;
	$img_big2_name = $zimg_big2_name;

	$img_big3 = $zimg_big3;
	$img_big3_name = $zimg_big3_name;

	$img_big4 = $zimg_big4;
	$img_big4_name = $zimg_big4_name;

	$img_big5 = $zimg_big5;
	$img_big5_name = $zimg_big5_name;
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
	if (isset($img_big2_name)&&($img_big2_name != "")){
		$size_big2 = filesize($img_big2);
		$size_width_big2 = getimagesize($img_big2);
		if($size_big2 > 5120000){
			echo ("
		<script language='javascript'>
			alert(\"2번 이미지의 크기는 5Mbyte를 넘을 수 없습니다.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
	}
	if (isset($img_big3_name)&&($img_big3_name != "")){
		$size_big3 = filesize($img_big3);
		$size_width_big3 = getimagesize($img_big3);
		if($size_big3 > 5120000){
			echo ("
		<script language='javascript'>
			alert(\"3번 이미지의 크기는 5Mbyte를 넘을 수 없습니다.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
	}
	if (isset($img_big4_name)&&($img_big4_name != "")){
		$size_big4 = filesize($img_big4);
		$size_width_big4 = getimagesize($img_big4);
		if($size_big4 > 5120000){
			echo ("
		<script language='javascript'>
			alert(\"4번 이미지의 크기는 5Mbyte를 넘을 수 없습니다.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
	}
	if (isset($img_big5_name)&&($img_big5_name != "")){
		$size_big5 = filesize($img_big5);
		$size_width_big5 = getimagesize($img_big5);
		if($size_big5 > 5120000){
			echo ("
		<script language='javascript'>
			alert(\"5번 이미지의 크기는 5Mbyte를 넘을 수 없습니다.\");
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

if($thumbnail == 'y'){
	if((isset($img_big_name)&&($img_big_name != "")) || $del_big == "y"){ // 화일 입력난이 공란아니고
		if($img_sml_updateflag=="ok"){ // 화일 업데이트 되었고..
			if($img_sml_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_sml_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_sml_old"); // 삭제...
				}
			}
		}
		if($img_updateflag=="ok"){
			
			if($img_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_old"); // 삭제...
				}
			}
		}
		if($img_big_updateflag=="ok"){ // 화일 업데이트 되었고..
			if($img_big_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_big_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_big_old"); // 삭제...
				}
			}
		}	
	}
}else{
	if((isset($img_sml_name)&&($img_sml_name != "")) || $del_sml == "y"){ // 화일 입력난이 공란아니고
		if($img_sml_updateflag=="ok"){ // 화일 업데이트 되었고..
			if($img_sml_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_sml_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_sml_old"); // 삭제...
				}
			}
		}
			
	}
	if((isset($img_name)&&($img_name != "")) || $del == "y"){ // 화일 입력난이 공란아니고
		if($img_updateflag=="ok"){ // 화일 업데이트 되었고..
			if($img_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_old"); // 삭제...
				}
			}
		}
			
	}
	if((isset($img_big_name)&&($img_big_name != "")) || $del_big == "y"){ // 화일 입력난이 공란아니고
		if($img_big_updateflag=="ok"){ // 화일 업데이트 되었고..
			if($img_big_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_big_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_big_old"); // 삭제...
				}
			}
		}
			
	}
}
	if((isset($img_big2_name)&&($img_big2_name != "")) || $del_big2 == "y"){ // 화일 입력난이 공란아니고
		if($img_big2_updateflag=="ok"){ // 화일 업데이트 되었고..
			if($img_big2_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_big2_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_big2_old"); // 삭제...
				}
			}
		}
			
	}
	
	if((isset($img_big3_name)&&($img_big3_name != "")) || $del_big3 == "y"){ // 화일 입력난이 공란아니고
		if($img_big3_updateflag=="ok"){ // 화일 업데이트 되었고..
			if($img_big3_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_big3_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_big3_old"); // 삭제...
				}
			}
		}
			
	}
	
	if((isset($img_big4_name)&&($img_big4_name != "")) || $del_big4 == "y"){ // 화일 입력난이 공란아니고
		if($img_big4_updateflag=="ok"){ // 화일 업데이트 되었고..
			if($img_big4_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_big4_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_big4_old"); // 삭제...
				}
			}
		}	
	}
	
	if((isset($img_big5_name)&&($img_big5_name != "")) || $del_big5 == "y"){ // 화일 입력난이 공란아니고
		if($img_big5_updateflag=="ok"){ // 화일 업데이트 되었고..
			if($img_big5_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_big5_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_big5_old"); // 삭제...
				}
			}
		}	
	}
					
	
		//================== 업로드 파일을 불러옴 ================================================
		include "../../upload.php";
		$upload = "$Co_img_UP"."$mart_id/";
		//================== 첨부 파일을 업로드함 ================================================
		$now_time = date("YmdHis");
##################################img_big###############################################
	
	if (isset($img_sml_name)&&($img_sml_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}


		
		if( $img_sml_name ){
			
			$img_sml_name = "us1_".$now_time.".jpg";
		
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

			$img_name = "um1_".$now_time.".jpg";

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

			$img_big_name = "ub1_".$now_time.".jpg";

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
##################################img_big2###############################################
	
	if (isset($img_big2_name)&&($img_big2_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}

		
		if( $img_big2_name ){

			$img_big2_name = "ub2_".$now_time.".jpg";
	
			$file = FileUploadName( "", "$upload", $img_big2, $img_big2_name );//파일을 업로드 함

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
##################################img_big3###############################################
	
	if (isset($img_big3_name)&&($img_big3_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}

		
		if( $img_big3_name ){

			$img_big3_name = "ub3_".$now_time.".jpg";

			$file = FileUploadName( "", "$upload", $img_big3, $img_big3_name );//파일을 업로드 함

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
##################################img_big4###############################################
	
	if (isset($img_big4_name)&&($img_big4_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}


		
		if( $img_big4_name ){

			$img_big4_name = "ub4_".$now_time.".jpg";

			$file = FileUploadName( "", "$upload", $img_big4, $img_big4_name );//파일을 업로드 함

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
##################################img_big5###############################################
	
	if (isset($img_big5_name)&&($img_big5_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}

		
		if( $img_big5_name ){

			$img_big5_name = "ub5_".$now_time.".jpg";

			$file = FileUploadName( "", "$upload", $img_big5, $img_big5_name );//파일을 업로드 함

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

	if($img_sml_updateflag=="ok" && $img_sml_name != ""){
		$img_sml_new = "item_sml_".$item_no."_".$img_sml_name;
	}
	if($img_updateflag=="ok" && $img_name != ""){
		$img_new = "item_".$item_no."_".$img_name;
	}


	if($img_big_updateflag=="ok" && $img_big_name != ""){
		$img_big_new = "item_big_".$item_no."_".$img_big_name;
	}
	if($img_big2_updateflag=="ok" && $img_big2_name != ""){
		$img_big2_new = "item_big2_".$item_no."_".$img_big2_name;
	}
	if($img_big3_updateflag=="ok" && $img_big3_name != ""){
		$img_big3_new = "item_big3_".$item_no."_".$img_big3_name;
	}
	if($img_big4_updateflag=="ok" && $img_big4_name != ""){
		$img_big4_new = "item_big4_".$item_no."_".$img_big4_name;
	}
	if($img_big5_updateflag=="ok" && $img_big5_name != ""){
		$img_big5_new = "item_big5_".$item_no."_".$img_big5_name;
	}





	if($img_sml_updateflag=="ok" && $img_sml_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_sml_name"))
		copy ("$Co_img_UP$mart_id/$img_sml_name","$Co_img_UP$mart_id/$img_sml_new" );	//업로드 파일 저장
	}
	if($img_updateflag=="ok" && $img_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_name"))
		copy ("$Co_img_UP$mart_id/$img_name","$Co_img_UP$mart_id/$img_new" );	//업로드 파일 저장
	}
	if($img_big_updateflag=="ok" && $img_big_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big_name"))
		copy ("$Co_img_UP$mart_id/$img_big_name","$Co_img_UP$mart_id/$img_big_new" );	//업로드 파일 저장
	}
	if($img_big2_updateflag=="ok" && $img_big2_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big2_name"))
			copy ("$Co_img_UP$mart_id/$img_big2_name","$Co_img_UP$mart_id/$img_big2_new" );	//업로드 파일 저장
	}
	if($img_big3_updateflag=="ok" && $img_big3_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big3_name"))
			copy ("$Co_img_UP$mart_id/$img_big3_name","$Co_img_UP$mart_id/$img_big3_new" );	//업로드 파일 저장
	}
	if($img_big4_updateflag=="ok" && $img_big4_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big4_name"))
			copy ("$Co_img_UP$mart_id/$img_big4_name","$Co_img_UP$mart_id/$img_big4_new" );	//업로드 파일 저장
	}
	if($img_big5_updateflag=="ok" && $img_big5_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big5_name"))
			copy ("$Co_img_UP$mart_id/$img_big5_name","$Co_img_UP$mart_id/$img_big5_new" );	//업로드 파일 저장
	}


	//임시화일 삭제
	if($img_sml_updateflag=="ok" && $img_sml_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_sml_name"))
			unlink("$Co_img_UP$mart_id/$img_sml_name");
	}
	if($img_updateflag=="ok" && $img_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_name"))
			unlink("$Co_img_UP$mart_id/$img_name");
	}
	if($img_big_updateflag=="ok" && $img_big_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big_name"))
			unlink("$Co_img_UP$mart_id/$img_big_name");
	}
	if($img_big2_updateflag=="ok" && $img_big2_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big2_name"))
			unlink("$Co_img_UP$mart_id/$img_big2_name");
	}
	if($img_big3_updateflag=="ok" && $img_big3_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big3_name"))
			unlink("$Co_img_UP$mart_id/$img_big3_name");
	}
	if($img_big4_updateflag=="ok" && $img_big4_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big4_name"))
			unlink("$Co_img_UP$mart_id/$img_big4_name");
	}
	if($img_big5_updateflag=="ok" && $img_big5_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big5_name"))
			unlink("$Co_img_UP$mart_id/$img_big5_name");
	}



	
	
	
if($thumbnail == 'y'){//썸네일 사용시	
	
	################################ 이미지 매직 ##################################33
	$rg_file1_path = "$Co_img_UP$mart_id/$img_big_new";
	$rg_file2_path = "$Co_img_UP$mart_id/$img_big2_new";
	$rg_file3_path = "$Co_img_UP$mart_id/$img_big3_new";
	$rg_file4_path = "$Co_img_UP$mart_id/$img_big4_new";
	$rg_file5_path = "$Co_img_UP$mart_id/$img_big5_new";

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
			$ThumFileName130 = $maxItem_no_1."_".$unique."_".$FileName."130.jpg";
			$ThumFileName300 = $maxItem_no_1."_".$unique."_".$FileName."300.jpg";
			$ThumFileName600 = $maxItem_no_1."_".$unique."_".$FileName."600.jpg";
			
			$FileName = $ori_path;
			$ThumFileName130 = "/home/".$mart_id."/public_html/co_img/".$mart_id."/" . $ThumFileName130;
			$ThumFileName300 = "/home/".$mart_id."/public_html/co_img/".$mart_id."/" . $ThumFileName300;
			$ThumFileName600 = "/home/".$mart_id."/public_html/co_img/".$mart_id."/" . $ThumFileName600;
			
			exec ("convert -geometry 130x $FileName $ThumFileName130");
			exec ("convert -geometry 300x $FileName $ThumFileName300");
			exec ("convert -geometry 600x $FileName $ThumFileName600");




			if(file_exists("$ori_path")){ 
				unlink ("$ori_path");	
			}



	}
	function MakeThum2($FileName,$ori_path,$maxItem_no_1,$mart_id,$unique) 
	{
			$ThumFileName600 = $maxItem_no_1."_".$unique."_".$FileName . "600.jpg";
			
			$FileName = $ori_path;
			$ThumFileName600 = "/home/".$mart_id."/public_html/co_img/".$mart_id."/" . $ThumFileName600;
			
			exec ("convert -geometry 600x $FileName $ThumFileName600");




			if(file_exists("$ori_path")){ 
				unlink ("$ori_path");	
			}



	}
	################################ 이미지 매직 ##################################33
	
	
	if(isset($img_big_name)&&($img_big_name != "")){ // 화일 입력난이 공란아니고

		
		MakeThum1($img_big_name,$rg_file1_path,$item_no,$mart_id,1); 

		
		
		$img_new = $item_no."_1_".$img_big_name."300.jpg";
		$img_sml_new = $item_no."_1_".$img_big_name."130.jpg";
		$img_big_new_th =  $item_no."_1_".$img_big_name."600.jpg";

		
		
		
		$img_query = ", img='$img_new'";
		$img_sml_query = ", img_sml='$img_sml_new'";
		$img_big_query = ", img_big='$img_big_new_th'";
	}
	if(isset($img_big2_name)&&($img_big2_name != "")){ // 화일 입력난이 공란아니고

		MakeThum2($img_big2_name,$rg_file2_path,$item_no,$mart_id,2);
		
		$img_big2_new_th =  $item_no."_2_".$img_big2_name."600.jpg";

		$img_big2_query = ", img_big2='$img_big2_new_th'";
	}
	if(isset($img_big3_name)&&($img_big3_name != "")){ // 화일 입력난이 공란아니고

		MakeThum2($img_big3_name,$rg_file3_path,$item_no,$mart_id,3); 

		$img_big3_new_th =  $item_no."_3_".$img_big3_name."600.jpg";

		$img_big3_query = ", img_big3='$img_big3_new_th'";
	}
	if(isset($img_big4_name)&&($img_big4_name != "")){ // 화일 입력난이 공란아니고

		MakeThum2($img_big4_name,$rg_file4_path,$item_no,$mart_id,4); 
		
		$img_big4_new_th =  $item_no."_4_".$img_big4_name."600.jpg";
		
		$img_big4_query = ", img_big4='$img_big4_new_th'";
	}
	if(isset($img_big5_name)&&($img_big5_name != "")){ // 화일 입력난이 공란아니고

		MakeThum2($img_big5_name,$rg_file5_path,$item_no,$mart_id,5); 
		
		$img_big5_new_th =  $item_no."_5_".$img_big5_name."600.jpg";
		
		$img_big5_query = ", img_big5='$img_big5_new_th'";
	}
}else{
		if(isset($img_sml_name)&&($img_sml_name != "")){ // 화일 입력난이 공란아니고
			$img_sml_query = ", img_sml='$img_sml_new'";
		}
		if(isset($img_name)&&($img_name != "")){ // 화일 입력난이 공란아니고
			$img_query = ", img='$img_new'";
		}
		if(isset($img_big_name)&&($img_big_name != "")){ // 화일 입력난이 공란아니고
			$img_big_query = ", img_big='$img_big_new'";
		}
		if(isset($img_big2_name)&&($img_big2_name != "")){ // 화일 입력난이 공란아니고
			$img_big2_query = ", img_big2='$img_big2_new'";
		}
		if(isset($img_big3_name)&&($img_big3_name != "")){ // 화일 입력난이 공란아니고
			$img_big3_query = ", img_big3='$img_big3_new'";
		}
		if(isset($img_big4_name)&&($img_big4_name != "")){ // 화일 입력난이 공란아니고
			$img_big4_query = ", img_big4='$img_big4_new'";
		}
		if(isset($img_big5_name)&&($img_big5_name != "")){ // 화일 입력난이 공란아니고
			$img_big5_query = ", img_big5='$img_big5_new'";
		}
}	
	
	
	
	
	
	
	
	
	$jaego = str_replace( ",", "", $jaego );
	$price = str_replace( ",", "", $price );
	$z_price = str_replace( ",", "", $z_price );
	$z_price2 = str_replace( ",", "", $z_price2 );
	$z_price3 = str_replace( ",", "", $z_price3 );
	$member_price = str_replace( ",", "", $member_price );
	$short_explain = str_replace( "\n", "<br>", $short_explain );

	if( $use_opt1_chk ){
		$use_opt1 = "t";
	}
	if( $use_opt23_chk ){
		$use_opt23 = "t";
	}
	$opt2=$op_name2;
	$opt3=$op_name3;
	$opt4=$op_name4;
	$opt5=$op_name5;
	$opt6=$op_name6;



	if($old_z_price != $z_price || $old_item_name != $item_name){
		$now_time=date("Y-m-d H:i:s");
		$sql_add1=" ,update_time='$now_time', update_type='U' ";
	}
	if(($jaego_use == 1 && $jaego == 0) || $if_hide=='1'){
		$now_time=date("Y-m-d H:i:s");
		$sql_add1=" ,update_time='$now_time', update_type='U' ";
	}



	$SQL = "update $ItemTable set item_name='$item_name', price='$price', z_price='$z_price',z_price2='$z_price2',z_price3='$z_price3', g_margin='$g_margin', member_price='$member_price', bonus='$bonus',bonus2='$bonus2',bonus3='$bonus3', use_bonus='$use_bonus', jaego='$jaego' $img_query $img_big_query $img_big2_query $img_big3_query $img_big4_query $img_big5_query, opt='$opt', doctype='$doctype', item_explain='$item_explain', short_explain='$short_explain', reg_date='$reg_date', item_company ='$item_company', item_code='$item_code', icon_no='$icon_no', use_opt1='$use_opt1', use_opt23='$use_opt23', jaego_use='$jaego_use', if_strike='$if_strike', if_provide_item='$if_provide_item', provider_id='$provider_id', provide_price='$provide_price' $img_sml_query , flash_big_width='$flash_big_width', flash_big_height='$flash_big_height', if_hide='$if_hide', img_high='$img_high_new', if_cash='$if_cash', fee='$fee', thumbnail='$thumbnail',opt2='$opt2',opt3='$opt3',opt4='$opt4',opt5='$opt5',opt6='$opt6',if_opt_jaego='$if_opt_jaego',if_opt_jaego2='$if_opt_jaego2',if_opt_jaego3='$if_opt_jaego3',if_opt_jaego4='$if_opt_jaego4', item_origin='$item_origin',item_bestbefore='$item_bestbefore' $sql_add1 where item_no='$item_no' and mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);
	
	$opt_no=explode("|",$opt_no);
	$opt_name=explode("|",$opt_name);
	$opt_price=explode("|",$opt_price);
	$opt_ea=explode("|",$opt_ea);
	$opt_order=explode("|",$opt_order);
	$opt_code=explode("|",$opt_code);
	for($i=0;$i<sizeof($opt_no)-1;$i++){
		if($opt_no[$i]){
			if($opt_name[$i]){
				//업데이트 하기
				$sql="update $OptionTable set opt_name='$opt_name[$i]',opt_price='$opt_price[$i]',opt_ea='$opt_ea[$i]',opt_order='$opt_order[$i]',opt_code='$opt_code[$i]' where opt_no='$opt_no[$i]'";
			}else{
				//삭제하기
				$sql="delete from $OptionTable where opt_no='$opt_no[$i]'";
			}
		}else{
			if($opt_name[$i]){
				//인서트하기
				$sql="insert into $OptionTable(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name[$i]','$opt_price[$i]','$opt_ea[$i]','$opt_order[$i]','$opt_code[$i]')";
			}else{
				$sql="delete from $OptionTable set opt_no='$opt_no[$i]'";
			}
		}
		
		$result=mysql_query($sql);
	}





	$opt_no2=explode("|",$opt_no2);
	$opt_name2=explode("|",$opt_name2);
	$opt_price2=explode("|",$opt_price2);
	$opt_ea2=explode("|",$opt_ea2);
	$opt_order2=explode("|",$opt_order2);
	$opt_code2=explode("|",$opt_code2);
	for($i=0;$i<sizeof($opt_no2)-1;$i++){
		if($opt_no2[$i]){
			if($opt_name2[$i]){
				//업데이트 하기
				$sql="update $OptionTable2 set opt_name='$opt_name2[$i]',opt_price='$opt_price2[$i]',opt_ea='$opt_ea2[$i]',opt_order='$opt_order2[$i]',opt_code='$opt_code2[$i]' where opt_no='$opt_no2[$i]'";
			}else{
				//삭제하기
				$sql="delete from $OptionTable2 where opt_no='$opt_no2[$i]'";
			}
		}else{
			if($opt_name2[$i]){
				//인서트하기
				$sql="insert into $OptionTable2(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name2[$i]','$opt_price2[$i]','$opt_ea2[$i]','$opt_order2[$i]','$opt_code2[$i]')";
			}else{
				$sql="delete from $OptionTable2 set opt_no='$opt_no2[$i]'";
			}
		}
		$result=mysql_query($sql);
	}

	$opt_no3=explode("|",$opt_no3);
	$opt_name3=explode("|",$opt_name3);
	$opt_price3=explode("|",$opt_price3);
	$opt_ea3=explode("|",$opt_ea3);
	$opt_order3=explode("|",$opt_order3);
	$opt_code3=explode("|",$opt_code3);
	for($i=0;$i<sizeof($opt_no3)-1;$i++){
		if($opt_no3[$i]){
			if($opt_name3[$i]){
				//업데이트 하기
				$sql="update $OptionTable3 set opt_name='$opt_name3[$i]',opt_price='$opt_price3[$i]',opt_ea='$opt_ea3[$i]',opt_order='$opt_order3[$i]',opt_code='$opt_code3[$i]' where opt_no='$opt_no3[$i]'";
			}else{
				//삭제하기
				$sql="delete from $OptionTable3 where opt_no='$opt_no3[$i]'";
			}
		}else{
			if($opt_name3[$i]){
				//인서트하기
				$sql="insert into $OptionTable3(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name3[$i]','$opt_price3[$i]','$opt_ea3[$i]','$opt_order3[$i]','$opt_code3[$i]')";
			}else{
				$sql="delete from $OptionTable3 set opt_no='$opt_no3[$i]'";
			}
		}
		$result=mysql_query($sql);
	}

	$opt_no4=explode("|",$opt_no4);
	$opt_name4=explode("|",$opt_name4);
	$opt_price4=explode("|",$opt_price4);
	$opt_ea4=explode("|",$opt_ea4);
	$opt_order4=explode("|",$opt_order4);
	$opt_code4=explode("|",$opt_code4);
	
	for($i=0;$i<sizeof($opt_no4)-1;$i++){
		if($opt_no4[$i]){
			if($opt_name4[$i]){
				//업데이트 하기
				$sql="update $OptionTable4 set opt_name='$opt_name4[$i]',opt_price='$opt_price4[$i]',opt_ea='$opt_ea4[$i]',opt_order='$opt_order4[$i]',opt_code='$opt_code4[$i]' where opt_no='$opt_no4[$i]'";
			}else{
				//삭제하기
				$sql="delete from $OptionTable4 where opt_no='$opt_no4[$i]'";
			}
		}else{
			if($opt_name4[$i]){
				//인서트하기
				$sql="insert into $OptionTable4(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name4[$i]','$opt_price4[$i]','$opt_ea4[$i]','$opt_order4[$i]','$opt_code4[$i]')";
			}else{
				$sql="delete from $OptionTable4 set opt_no='$opt_no4[$i]'";
			}
		}
		$result=mysql_query($sql);
	}

	$opt_no5=explode("|",$opt_no5);
	$opt_name5=explode("|",$opt_name5);
	$opt_price5=explode("|",$opt_price5);
	$opt_ea5=explode("|",$opt_ea5);
	$opt_order5=explode("|",$opt_order5);
	$opt_code5=explode("|",$opt_code5);
	
	for($i=0;$i<sizeof($opt_no5)-1;$i++){
		if($opt_no5[$i]){
			if($opt_name5[$i]){
				//업데이트 하기
				$sql="update $OptionTable5 set opt_name='$opt_name5[$i]',opt_price='$opt_price5[$i]',opt_ea='$opt_ea5[$i]',opt_order='$opt_order5[$i]',opt_code='$opt_code5[$i]' where opt_no='$opt_no5[$i]'";
			}else{
				//삭제하기
				$sql="delete from $OptionTable5 where opt_no='$opt_no5[$i]'";
			}
		}else{
			if($opt_name5[$i]){
				//인서트하기
				$sql="insert into $OptionTable5(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name5[$i]','$opt_price5[$i]','$opt_ea5[$i]','$opt_order5[$i]','$opt_code5[$i]')";
			}else{
				$sql="delete from $OptionTable5 set opt_no='$opt_no5[$i]'";
			}
		}
		$result=mysql_query($sql);
	}

	$opt_no6=explode("|",$opt_no6);
	$opt_name6=explode("|",$opt_name6);
	$opt_price6=explode("|",$opt_price6);
	$opt_ea6=explode("|",$opt_ea6);
	$opt_order6=explode("|",$opt_order6);
	$opt_code6=explode("|",$opt_code6);
	
	for($i=0;$i<sizeof($opt_no6)-1;$i++){
		if($opt_no6[$i]){
			if($opt_name6[$i]){
				//업데이트 하기
				$sql="update $OptionTable6 set opt_name='$opt_name6[$i]',opt_price='$opt_price6[$i]',opt_ea='$opt_ea6[$i]',opt_order='$opt_order6[$i]',opt_code='$opt_code6[$i]' where opt_no='$opt_no6[$i]'";
			}else{
				//삭제하기
				$sql="delete from $OptionTable6 where opt_no='$opt_no6[$i]'";
			}
		}else{
			if($opt_name6[$i]){
				//인서트하기
				$sql="insert into $OptionTable6(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name6[$i]','$opt_price6[$i]','$opt_ea6[$i]','$opt_order6[$i]','$opt_code6[$i]')";
			}else{
				$sql="delete from $OptionTable6 set opt_no='$opt_no6[$i]'";
			}
		}
		$result=mysql_query($sql);
	}
	if( $dbresult ){
		echo "<meta http-equiv='refresh' content='0; URL=item_edit.php?item_no=$item_no&category_num=$category_num&page=$page&searchword=$searchword&pu=$pu'>";
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
//========================================================================================
?>
<?
mysql_close($dbconn);
?>
