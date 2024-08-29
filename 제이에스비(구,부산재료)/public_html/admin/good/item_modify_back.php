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
	
	if(isset($op1)&&$op1!=""){
		$opt = $op1;
		if(isset($op2)&&$op2!=""){
			$opt = $opt."=".$op2;
			if(isset($op3)&&$op3!=""){
				$opt = $opt."=".$op3;
			}
		}
	}
	else $opt = "";
	
	$opt = $op1."=".$op2."=".$op3;
	
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
	if($img_big3_updateflag=="ok" && $img_bi3g != ""){
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
	$member_price = str_replace( ",", "", $member_price );
	$short_explain = str_replace( "\n", "<br>", $short_explain );

	$SQL = "insert into $ItemTable (mart_id, firstno, prevno, category_num, item_name, price, z_price, g_margin, member_price, bonus, use_bonus, jaego, img, img_big, img_big2, img_big3, img_big4, img_big5, opt, doctype, item_explain, short_explain, reg_date, item_company, read_num, item_code, icon_no, use_opt1, use_opt23, item_order, jaego_use, if_strike, if_provide_item, provider_id, provide_price, img_sml, flash_big_width, flash_big_height, if_hide, img_high, if_cash, fee) values ('$mart_id', '$prevno2', '$prevno', '$category_num', '$item_name', '$price', '$z_price', '$g_margin', '$member_price', '$bonus', '$use_bonus','$jaego','$img_new','$img_big_new','$img_big2_new','$img_big3_new','$img_big4_new','$img_big5_new','$opt','$doctype','$item_explain', '$short_explain', '$reg_date','$item_company', 0, '$item_code', '$icon_no','$use_opt1','$use_opt23','100','$jaego_use','$if_strike','$if_provide_item', '$provider_id', '$provide_price', '$img_sml_new','$flash_big_width','$flash_big_height','$if_hide', '$img_high_new', '$if_cash', '$fee')";

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
	$opt = $op1."=".$op2."=".$op3;
	
	if(isset($img_sml)&&($img_sml != "")){ // 화일 입력난이 공란아니고
		if($img_sml_updateflag=="ok"){ // 화일 업데이트 되었고..
			if($img_sml_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_sml_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_sml_old"); // 삭제...
				}
			}
			
			$img_sml_new = "item_sml_".$item_no."_".$img_sml; // 화일 이름 새로 만들고
			if(file_exists("$Co_img_UP$mart_id/$img_sml"))  // 화일 있는지 확인하고
				copy ("$Co_img_UP$mart_id/$img_sml","$Co_img_UP$mart_id/$img_sml_new" );	//새 파일 저장
		}
		else{
			$img_sml_new = $img_sml;
		}
		
	}else{ // 소사이즈 이미지 빈칸..
		// 이전 소사이즈 이미지 있으면 삭제.
		if($img_sml_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_sml_old")){
				unlink("$Co_img_UP$mart_id/$img_sml_old");
			}
		}
	}
	
	if(isset($img_big)&&($img_big != "")){ // 화일 입력난이 공란아니고
		if($img_big_updateflag=="ok"){ // 화일 업데이트 되었고..
			if($img_big_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_big_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_big_old"); // 삭제...
				}
			}
			
			$img_big_new = "item_big_".$item_no."_".$img_big; // 화일 이름 새로 만들고
			if(file_exists("$Co_img_UP$mart_id/$img_big"))  // 화일 있는지 확인하고
				copy ("$Co_img_UP$mart_id/$img_big","$Co_img_UP$mart_id/$img_big_new" );	//새 파일 저장

				$watermark_path ="$Co_img_UP$mart_id/logo.png"; //워터마크경로
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_big_new, $watermark_path, 50, 100); //워터마크처리

		}else{
			$img_big_new = $img_big;
		}
		
	}else{ // 대사이즈 이미지 빈칸..
		// 이전 대사이즈 이미지 있으면 삭제.
		if($img_big_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_big_old")){
				unlink("$Co_img_UP$mart_id/$img_big_old");
			}
		}
	}
	
	if(isset($img_big2)&&($img_big2 != "")){ // 화일 입력난이 공란아니고
		if($img_big2_updateflag=="ok"){ // 화일 업데이트 되었고..
			if($img_big2_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_big2_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_big2_old"); // 삭제...
				}
			}
			
			$img_big2_new = "item_big2_".$item_no."_".$img_big2; // 화일 이름 새로 만들고
			if(file_exists("$Co_img_UP$mart_id/$img_big2"))  // 화일 있는지 확인하고
				copy ("$Co_img_UP$mart_id/$img_big2","$Co_img_UP$mart_id/$img_big2_new" );	//새 파일 저장
				$watermark_path ="$Co_img_UP$mart_id/logo.png"; //워터마크경로
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_big2_new, $watermark_path, 50, 100); //워터마크처리
		}else{
			$img_big2_new = $img_big2;
		}
	}else{ // 대사이즈 이미지 빈칸..
		// 이전 대사이즈 이미지 있으면 삭제.
		if($img_big2_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_big2_old")){
				unlink("$Co_img_UP$mart_id/$img_big2_old");
			}
		}
	}
	
	if(isset($img_big3)&&($img_big3 != "")){ // 화일 입력난이 공란아니고
		if($img_big3_updateflag=="ok"){ // 화일 업데이트 되었고..
			if($img_big3_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_big3_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_big3_old"); // 삭제...
				}
			}
			
			$img_big3_new = "item_big3_".$item_no."_".$img_big3; // 화일 이름 새로 만들고
			if(file_exists("$Co_img_UP$mart_id/$img_big3"))  // 화일 있는지 확인하고
				copy ("$Co_img_UP$mart_id/$img_big3","$Co_img_UP$mart_id/$img_big3_new" );	//새 파일 저장
				$watermark_path ="$Co_img_UP$mart_id/logo.png"; //워터마크경로
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_big3_new, $watermark_path, 50, 100); //워터마크처리
		}else{
			$img_big3_new = $img_big3;
		}
	}else{ // 대사이즈 이미지 빈칸..
		// 이전 대사이즈 이미지 있으면 삭제.
		if($img_big3_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_big3_old")){
				unlink("$Co_img_UP$mart_id/$img_big3_old");
			}
		}
	}
	
	if(isset($img_big4)&&($img_big4 != "")){ // 화일 입력난이 공란아니고
		if($img_big4_updateflag=="ok"){ // 화일 업데이트 되었고..
			if($img_big4_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_big4_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_big4_old"); // 삭제...
				}
			}
			
			$img_big4_new = "item_big4_".$item_no."_".$img_big4; // 화일 이름 새로 만들고
			if(file_exists("$Co_img_UP$mart_id/$img_big4"))  // 화일 있는지 확인하고
				copy ("$Co_img_UP$mart_id/$img_big4","$Co_img_UP$mart_id/$img_big4_new" );	//새 파일 저장
				$watermark_path ="$Co_img_UP$mart_id/logo.png"; //워터마크경로
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_big4_new, $watermark_path, 50, 100); //워터마크처리
		}else{
			$img_big4_new = $img_big4;
		}
	}else{ // 대사이즈 이미지 빈칸..
		// 이전 대사이즈 이미지 있으면 삭제.
		if($img_big4_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_big4_old")){
				unlink("$Co_img_UP$mart_id/$img_big4_old");
			}
		}
	}
	
	if(isset($img_big5)&&($img_big5 != "")){ // 화일 입력난이 공란아니고
		if($img_big5_updateflag=="ok"){ // 화일 업데이트 되었고..
			if($img_big5_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_big5_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_big5_old"); // 삭제...
				}
			}
			
			$img_big5_new = "item_big5_".$item_no."_".$img_big5; // 화일 이름 새로 만들고
			if(file_exists("$Co_img_UP$mart_id/$img_big5"))  // 화일 있는지 확인하고
				copy ("$Co_img_UP$mart_id/$img_big5","$Co_img_UP$mart_id/$img_big5_new" );	//새 파일 저장
				$watermark_path ="$Co_img_UP$mart_id/logo.png"; //워터마크경로
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_big5_new, $watermark_path, 50, 100); //워터마크처리
		}else{
			$img_big5_new = $img_big5;
		}
	}else{ // 대사이즈 이미지 빈칸..
		// 이전 대사이즈 이미지 있으면 삭제.
		if($img_big5_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_big5_old")){
				unlink("$Co_img_UP$mart_id/$img_big5_old");
			}
		}
	}
					
	if(isset($img)&&($img != "")){
		if($img_updateflag=="ok"){
			
			if($img_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_old"); // 삭제...
				}
			}
			
			$img_new = "item_".$item_no."_".$img;
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img"))
				copy ("$Co_img_UP$mart_id/$img","$Co_img_UP$mart_id/$img_new" );	//새 파일 저장
				$watermark_path ="$Co_img_UP$mart_id/logo.png"; //워터마크경로
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_new, $watermark_path, 50, 100); //워터마크처리
		}else{
			$img_new = $img;
		}
	}else{ // 중사이즈 이미지 빈칸..
		// 이전 중사이즈 이미지 있으면 삭제.
		if($img_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_old")){
				unlink("$Co_img_UP$mart_id/$img_old");
			}
		}
	}
	
	if(isset($img_high)&&($img_high != "")){
		if($img_high_updateflag=="ok"){
			
			if($img_high_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_high_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_high_old"); // 삭제...
				}
			}
			
			$img_high_new = "item_high_".$item_no."_".$img_high;
			if(file_exists("$Co_img_UP$mart_id/$img_high"))
				copy ("$Co_img_UP$mart_id/$img_high","$Co_img_UP$mart_id/$img_high_new" );	//새 파일 저장
				$watermark_path ="$Co_img_UP$mart_id/logo.png"; //워터마크경로
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_high_new, $watermark_path, 50, 100); //워터마크처리
		}else{
			$img_high_new = $img_high;
		}
	}else{ // 중사이즈 이미지 빈칸..
		// 이전 중사이즈 이미지 있으면 삭제.
		if($img_high_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_high_old")){
				unlink("$Co_img_UP$mart_id/$img_high_old");
			}
		}
	}
	
	if(isset($img_sml)&&($img_sml != "")){ // 화일 입력난이 공란아니고
		if($img_sml_updateflag=="ok"){ // 화일 업데이트 되었고..
			if(file_exists("$Co_img_UP$mart_id/$img_sml"))  // 화일 있는지 확인하고
				unlink ("$Co_img_UP$mart_id/$img_sml");	//임시 파일 삭제
		}
	}
	if(isset($img_big)&&($img_big != "")){ // 화일 입력난이 공란아니고
		if($img_big_updateflag=="ok"){ // 화일 업데이트 되었고..
			if(file_exists("$Co_img_UP$mart_id/$img_big"))  // 화일 있는지 확인하고
				unlink ("$Co_img_UP$mart_id/$img_big");	//임시 파일 삭제
		}
	}
	if(isset($img_big2)&&($img_big2 != "")){ // 화일 입력난이 공란아니고
		if($img_big2_updateflag=="ok"){ // 화일 업데이트 되었고..
			if(file_exists("$Co_img_UP$mart_id/$img_big2"))  // 화일 있는지 확인하고
				unlink ("$Co_img_UP$mart_id/$img_big2");	//임시 파일 삭제
		}
	}
	if(isset($img_big3)&&($img_big3 != "")){ // 화일 입력난이 공란아니고
		if($img_big3_updateflag=="ok"){ // 화일 업데이트 되었고..
			if(file_exists("$Co_img_UP$mart_id/$img_big3"))  // 화일 있는지 확인하고
				unlink ("$Co_img_UP$mart_id/$img_big3");	//임시 파일 삭제
		}
	}
	if(isset($img_big4)&&($img_big4 != "")){ // 화일 입력난이 공란아니고
		if($img_big4_updateflag=="ok"){ // 화일 업데이트 되었고..
			if(file_exists("$Co_img_UP$mart_id/$img_big4"))  // 화일 있는지 확인하고
				unlink ("$Co_img_UP$mart_id/$img_big4");	//임시 파일 삭제
		}
	}
	if(isset($img_big5)&&($img_big5 != "")){ // 화일 입력난이 공란아니고
		if($img_big5_updateflag=="ok"){ // 화일 업데이트 되었고..
			if(file_exists("$Co_img_UP$mart_id/$img_big5"))  // 화일 있는지 확인하고
				unlink ("$Co_img_UP$mart_id/$img_big5");	//임시 파일 삭제
		}
	}

	if(isset($img)&&($img != "")){
		if($img_updateflag=="ok"){
			if(file_exists("$Co_img_UP$mart_id/$img"))
				unlink ("$Co_img_UP$mart_id/$img");	//임시 파일 삭제
		}
	}
	if(isset($img_high)&&($img_high != "")){
		if($img_high_updateflag=="ok"){
			if(file_exists("$Co_img_UP$mart_id/$img_high"))
				unlink ("$Co_img_UP$mart_id/$img_high");	//임시 파일 삭제
		}
	}

	$jaego = str_replace( ",", "", $jaego );
	$price = str_replace( ",", "", $price );
	$z_price = str_replace( ",", "", $z_price );
	$member_price = str_replace( ",", "", $member_price );
	$short_explain = str_replace( "\n", "<br>", $short_explain );

	if( $use_opt1_chk ){
		$use_opt1 = "t";
	}
	if( $use_opt23_chk ){
		$use_opt23 = "t";
	}
	$SQL = "update $ItemTable set item_name='$item_name', price='$price', z_price='$z_price', g_margin='$g_margin', member_price='$member_price', bonus='$bonus', use_bonus='$use_bonus', jaego='$jaego', img ='$img_new', img_big='$img_big_new', img_big2='$img_big2_new', img_big3='$img_big3_new', img_big4='$img_big4_new', img_big5='$img_big5_new', opt='$opt', doctype='$doctype', item_explain='$item_explain', short_explain='$short_explain', reg_date='$reg_date', item_company ='$item_company', item_code='$item_code', icon_no='$icon_no', use_opt1='$use_opt1', use_opt23='$use_opt23', jaego_use='$jaego_use', if_strike='$if_strike', if_provide_item='$if_provide_item', provider_id='$provider_id', provide_price='$provide_price',	img_sml='$img_sml_new', flash_big_width='$flash_big_width', flash_big_height='$flash_big_height', if_hide='$if_hide', img_high='$img_high_new', if_cash='$if_cash', fee='$fee',item_kyukyuk='$item_kyukyuk',min_buy='$min_buy' where item_no='$item_no' and mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);

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