<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
?>
<?
//================== ��ǰ�� ����� =======================================================
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
	if ($dbresult == false) echo "���� ���� ����!";
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
			copy ("$Co_img_UP$mart_id/$img_sml","$Co_img_UP$mart_id/$img_sml_new" );	//���ε� ���� ����
	}
	if($img_updateflag=="ok" && $img != ""){
		//echo "img_new = $img_new";
		if(file_exists("$Co_img_UP$mart_id/$img"))
			copy ("$Co_img_UP$mart_id/$img","$Co_img_UP$mart_id/$img_new" );	//���ε� ���� ����
	}
	if($img_big_updateflag=="ok" && $img_big != ""){
		//echo "img_new = $img_new";
		if(file_exists("$Co_img_UP$mart_id/$img_big"))
			copy ("$Co_img_UP$mart_id/$img_big","$Co_img_UP$mart_id/$img_big_new" );	//���ε� ���� ����
	}
	if($img_big2_updateflag=="ok" && $img_big2 != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big2"))
			copy ("$Co_img_UP$mart_id/$img_big2","$Co_img_UP$mart_id/$img_big2_new" );	//���ε� ���� ����
	}
	if($img_big3_updateflag=="ok" && $img_big3 != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big3"))
			copy ("$Co_img_UP$mart_id/$img_big3","$Co_img_UP$mart_id/$img_big3_new" );	//���ε� ���� ����
	}
	if($img_big4_updateflag=="ok" && $img_big4 != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big4"))
			copy ("$Co_img_UP$mart_id/$img_big4","$Co_img_UP$mart_id/$img_big4_new" );	//���ε� ���� ����
	}
	if($img_big5_updateflag=="ok" && $img_big5 != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big5"))
			copy ("$Co_img_UP$mart_id/$img_big5","$Co_img_UP$mart_id/$img_big5_new" );	//���ε� ���� ����
	}
		
	if($img_high_updateflag=="ok" && $img_high != ""){
		//echo "img_new = $img_new";
		if(file_exists("$Co_img_UP$mart_id/$img_high"))
			copy ("$Co_img_UP$mart_id/$img_high","$Co_img_UP$mart_id/$img_high_new" );	//���ε� ���� ����
	}
	
	//�ӽ�ȭ�� ����
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
//================== ��ǰ�� ������ =======================================================
if($flag == "update"){
	$opt = $op1."=".$op2."=".$op3;
	
	if(isset($img_sml)&&($img_sml != "")){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_sml_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if($img_sml_old !=""){ // ���� ȭ�� �ִ°�?
				if(file_exists("$Co_img_UP$mart_id/$img_sml_old")){ // ȭ�� ������...
					unlink("$Co_img_UP$mart_id/$img_sml_old"); // ����...
				}
			}
			
			$img_sml_new = "item_sml_".$item_no."_".$img_sml; // ȭ�� �̸� ���� �����
			if(file_exists("$Co_img_UP$mart_id/$img_sml"))  // ȭ�� �ִ��� Ȯ���ϰ�
				copy ("$Co_img_UP$mart_id/$img_sml","$Co_img_UP$mart_id/$img_sml_new" );	//�� ���� ����
		}
		else{
			$img_sml_new = $img_sml;
		}
		
	}else{ // �һ����� �̹��� ��ĭ..
		// ���� �һ����� �̹��� ������ ����.
		if($img_sml_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_sml_old")){
				unlink("$Co_img_UP$mart_id/$img_sml_old");
			}
		}
	}
	
	if(isset($img_big)&&($img_big != "")){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_big_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if($img_big_old !=""){ // ���� ȭ�� �ִ°�?
				if(file_exists("$Co_img_UP$mart_id/$img_big_old")){ // ȭ�� ������...
					unlink("$Co_img_UP$mart_id/$img_big_old"); // ����...
				}
			}
			
			$img_big_new = "item_big_".$item_no."_".$img_big; // ȭ�� �̸� ���� �����
			if(file_exists("$Co_img_UP$mart_id/$img_big"))  // ȭ�� �ִ��� Ȯ���ϰ�
				copy ("$Co_img_UP$mart_id/$img_big","$Co_img_UP$mart_id/$img_big_new" );	//�� ���� ����

				$watermark_path ="$Co_img_UP$mart_id/logo.png"; //���͸�ũ���
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_big_new, $watermark_path, 50, 100); //���͸�ũó��

		}else{
			$img_big_new = $img_big;
		}
		
	}else{ // ������� �̹��� ��ĭ..
		// ���� ������� �̹��� ������ ����.
		if($img_big_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_big_old")){
				unlink("$Co_img_UP$mart_id/$img_big_old");
			}
		}
	}
	
	if(isset($img_big2)&&($img_big2 != "")){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_big2_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if($img_big2_old !=""){ // ���� ȭ�� �ִ°�?
				if(file_exists("$Co_img_UP$mart_id/$img_big2_old")){ // ȭ�� ������...
					unlink("$Co_img_UP$mart_id/$img_big2_old"); // ����...
				}
			}
			
			$img_big2_new = "item_big2_".$item_no."_".$img_big2; // ȭ�� �̸� ���� �����
			if(file_exists("$Co_img_UP$mart_id/$img_big2"))  // ȭ�� �ִ��� Ȯ���ϰ�
				copy ("$Co_img_UP$mart_id/$img_big2","$Co_img_UP$mart_id/$img_big2_new" );	//�� ���� ����
				$watermark_path ="$Co_img_UP$mart_id/logo.png"; //���͸�ũ���
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_big2_new, $watermark_path, 50, 100); //���͸�ũó��
		}else{
			$img_big2_new = $img_big2;
		}
	}else{ // ������� �̹��� ��ĭ..
		// ���� ������� �̹��� ������ ����.
		if($img_big2_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_big2_old")){
				unlink("$Co_img_UP$mart_id/$img_big2_old");
			}
		}
	}
	
	if(isset($img_big3)&&($img_big3 != "")){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_big3_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if($img_big3_old !=""){ // ���� ȭ�� �ִ°�?
				if(file_exists("$Co_img_UP$mart_id/$img_big3_old")){ // ȭ�� ������...
					unlink("$Co_img_UP$mart_id/$img_big3_old"); // ����...
				}
			}
			
			$img_big3_new = "item_big3_".$item_no."_".$img_big3; // ȭ�� �̸� ���� �����
			if(file_exists("$Co_img_UP$mart_id/$img_big3"))  // ȭ�� �ִ��� Ȯ���ϰ�
				copy ("$Co_img_UP$mart_id/$img_big3","$Co_img_UP$mart_id/$img_big3_new" );	//�� ���� ����
				$watermark_path ="$Co_img_UP$mart_id/logo.png"; //���͸�ũ���
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_big3_new, $watermark_path, 50, 100); //���͸�ũó��
		}else{
			$img_big3_new = $img_big3;
		}
	}else{ // ������� �̹��� ��ĭ..
		// ���� ������� �̹��� ������ ����.
		if($img_big3_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_big3_old")){
				unlink("$Co_img_UP$mart_id/$img_big3_old");
			}
		}
	}
	
	if(isset($img_big4)&&($img_big4 != "")){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_big4_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if($img_big4_old !=""){ // ���� ȭ�� �ִ°�?
				if(file_exists("$Co_img_UP$mart_id/$img_big4_old")){ // ȭ�� ������...
					unlink("$Co_img_UP$mart_id/$img_big4_old"); // ����...
				}
			}
			
			$img_big4_new = "item_big4_".$item_no."_".$img_big4; // ȭ�� �̸� ���� �����
			if(file_exists("$Co_img_UP$mart_id/$img_big4"))  // ȭ�� �ִ��� Ȯ���ϰ�
				copy ("$Co_img_UP$mart_id/$img_big4","$Co_img_UP$mart_id/$img_big4_new" );	//�� ���� ����
				$watermark_path ="$Co_img_UP$mart_id/logo.png"; //���͸�ũ���
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_big4_new, $watermark_path, 50, 100); //���͸�ũó��
		}else{
			$img_big4_new = $img_big4;
		}
	}else{ // ������� �̹��� ��ĭ..
		// ���� ������� �̹��� ������ ����.
		if($img_big4_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_big4_old")){
				unlink("$Co_img_UP$mart_id/$img_big4_old");
			}
		}
	}
	
	if(isset($img_big5)&&($img_big5 != "")){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_big5_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if($img_big5_old !=""){ // ���� ȭ�� �ִ°�?
				if(file_exists("$Co_img_UP$mart_id/$img_big5_old")){ // ȭ�� ������...
					unlink("$Co_img_UP$mart_id/$img_big5_old"); // ����...
				}
			}
			
			$img_big5_new = "item_big5_".$item_no."_".$img_big5; // ȭ�� �̸� ���� �����
			if(file_exists("$Co_img_UP$mart_id/$img_big5"))  // ȭ�� �ִ��� Ȯ���ϰ�
				copy ("$Co_img_UP$mart_id/$img_big5","$Co_img_UP$mart_id/$img_big5_new" );	//�� ���� ����
				$watermark_path ="$Co_img_UP$mart_id/logo.png"; //���͸�ũ���
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_big5_new, $watermark_path, 50, 100); //���͸�ũó��
		}else{
			$img_big5_new = $img_big5;
		}
	}else{ // ������� �̹��� ��ĭ..
		// ���� ������� �̹��� ������ ����.
		if($img_big5_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_big5_old")){
				unlink("$Co_img_UP$mart_id/$img_big5_old");
			}
		}
	}
					
	if(isset($img)&&($img != "")){
		if($img_updateflag=="ok"){
			
			if($img_old !=""){ // ���� ȭ�� �ִ°�?
				if(file_exists("$Co_img_UP$mart_id/$img_old")){ // ȭ�� ������...
					unlink("$Co_img_UP$mart_id/$img_old"); // ����...
				}
			}
			
			$img_new = "item_".$item_no."_".$img;
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img"))
				copy ("$Co_img_UP$mart_id/$img","$Co_img_UP$mart_id/$img_new" );	//�� ���� ����
				$watermark_path ="$Co_img_UP$mart_id/logo.png"; //���͸�ũ���
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_new, $watermark_path, 50, 100); //���͸�ũó��
		}else{
			$img_new = $img;
		}
	}else{ // �߻����� �̹��� ��ĭ..
		// ���� �߻����� �̹��� ������ ����.
		if($img_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_old")){
				unlink("$Co_img_UP$mart_id/$img_old");
			}
		}
	}
	
	if(isset($img_high)&&($img_high != "")){
		if($img_high_updateflag=="ok"){
			
			if($img_high_old !=""){ // ���� ȭ�� �ִ°�?
				if(file_exists("$Co_img_UP$mart_id/$img_high_old")){ // ȭ�� ������...
					unlink("$Co_img_UP$mart_id/$img_high_old"); // ����...
				}
			}
			
			$img_high_new = "item_high_".$item_no."_".$img_high;
			if(file_exists("$Co_img_UP$mart_id/$img_high"))
				copy ("$Co_img_UP$mart_id/$img_high","$Co_img_UP$mart_id/$img_high_new" );	//�� ���� ����
				$watermark_path ="$Co_img_UP$mart_id/logo.png"; //���͸�ũ���
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_high_new, $watermark_path, 50, 100); //���͸�ũó��
		}else{
			$img_high_new = $img_high;
		}
	}else{ // �߻����� �̹��� ��ĭ..
		// ���� �߻����� �̹��� ������ ����.
		if($img_high_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_high_old")){
				unlink("$Co_img_UP$mart_id/$img_high_old");
			}
		}
	}
	
	if(isset($img_sml)&&($img_sml != "")){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_sml_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if(file_exists("$Co_img_UP$mart_id/$img_sml"))  // ȭ�� �ִ��� Ȯ���ϰ�
				unlink ("$Co_img_UP$mart_id/$img_sml");	//�ӽ� ���� ����
		}
	}
	if(isset($img_big)&&($img_big != "")){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_big_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if(file_exists("$Co_img_UP$mart_id/$img_big"))  // ȭ�� �ִ��� Ȯ���ϰ�
				unlink ("$Co_img_UP$mart_id/$img_big");	//�ӽ� ���� ����
		}
	}
	if(isset($img_big2)&&($img_big2 != "")){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_big2_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if(file_exists("$Co_img_UP$mart_id/$img_big2"))  // ȭ�� �ִ��� Ȯ���ϰ�
				unlink ("$Co_img_UP$mart_id/$img_big2");	//�ӽ� ���� ����
		}
	}
	if(isset($img_big3)&&($img_big3 != "")){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_big3_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if(file_exists("$Co_img_UP$mart_id/$img_big3"))  // ȭ�� �ִ��� Ȯ���ϰ�
				unlink ("$Co_img_UP$mart_id/$img_big3");	//�ӽ� ���� ����
		}
	}
	if(isset($img_big4)&&($img_big4 != "")){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_big4_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if(file_exists("$Co_img_UP$mart_id/$img_big4"))  // ȭ�� �ִ��� Ȯ���ϰ�
				unlink ("$Co_img_UP$mart_id/$img_big4");	//�ӽ� ���� ����
		}
	}
	if(isset($img_big5)&&($img_big5 != "")){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_big5_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if(file_exists("$Co_img_UP$mart_id/$img_big5"))  // ȭ�� �ִ��� Ȯ���ϰ�
				unlink ("$Co_img_UP$mart_id/$img_big5");	//�ӽ� ���� ����
		}
	}

	if(isset($img)&&($img != "")){
		if($img_updateflag=="ok"){
			if(file_exists("$Co_img_UP$mart_id/$img"))
				unlink ("$Co_img_UP$mart_id/$img");	//�ӽ� ���� ����
		}
	}
	if(isset($img_high)&&($img_high != "")){
		if($img_high_updateflag=="ok"){
			if(file_exists("$Co_img_UP$mart_id/$img_high"))
				unlink ("$Co_img_UP$mart_id/$img_high");	//�ӽ� ���� ����
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
				alert('��ǰ ������ �����߽��ϴ�');
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