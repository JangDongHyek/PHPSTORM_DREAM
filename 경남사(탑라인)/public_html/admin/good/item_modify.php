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
############################# �̹��� �뷮 �� ������ ���� ##############################
	if (isset($img_big_name)&&($img_big_name != "")){
		$size_big = filesize($img_big);
		$size_width_big = getimagesize($img_big);
	/*
		if($size_width_big[0] > 2100 || $size_width_big[1] > 2100){		
			echo ("
		<script language='javascript'>
			alert(\"1�� �̹����� ���� �Ǵ� ���� �ȼ��� 2100�ȼ� �̻��̸� ���ε尡 �ȵ˴ϴ�.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
*/
		if($size_big > 5120000){
			echo ("
		<script language='javascript'>
			alert(\"1�� �̹����� ũ��� 5Mbyte�� ���� �� �����ϴ�.\");
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
	/*
		if($size_width_big2[0] > 2100 || $size_width_big2[1] > 2100){		
			echo ("
		<script language='javascript'>
			alert(\"2�� �̹����� ���� �Ǵ� ���� �ȼ��� 2100�ȼ� �̻��̸� ���ε尡 �ȵ˴ϴ�.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
	*/
		if($size_big2 > 5120000){
			echo ("
		<script language='javascript'>
			alert(\"2�� �̹����� ũ��� 5Mbyte�� ���� �� �����ϴ�.\");
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
	/*
		if($size_width_big3[0] > 2100 || $size_width_big3[1] > 2100){		
			echo ("
		<script language='javascript'>
			alert(\"3�� �̹����� ���� �Ǵ� ���� �ȼ��� 2100�ȼ� �̻��̸� ���ε尡 �ȵ˴ϴ�.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
	*/	
		if($size_big3 > 5120000){
			echo ("
		<script language='javascript'>
			alert(\"3�� �̹����� ũ��� 5Mbyte�� ���� �� �����ϴ�.\");
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
	/*
		if($size_width_big4[0] > 2100 || $size_width_big4[1] > 2100){		
			echo ("
		<script language='javascript'>
			alert(\"4�� �̹����� ���� �Ǵ� ���� �ȼ��� 2100�ȼ� �̻��̸� ���ε尡 �ȵ˴ϴ�.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
	*/
		if($size_big4 > 5120000){
			echo ("
		<script language='javascript'>
			alert(\"4�� �̹����� ũ��� 5Mbyte�� ���� �� �����ϴ�.\");
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
	/*
		if($size_width_big5[0] > 2100 || $size_width_big5[1] > 2100){		
			echo ("
		<script language='javascript'>
			alert(\"5�� �̹����� ���� �Ǵ� ���� �ȼ��� 2100�ȼ� �̻��̸� ���ε尡 �ȵ˴ϴ�.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
	*/	
		if($size_big5 > 5120000){
			echo ("
		<script language='javascript'>
			alert(\"5�� �̹����� ũ��� 5Mbyte�� ���� �� �����ϴ�.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
	}
#######################################################################################
	$opt = $op1."=".$op2."=".$op3;
	


	if((isset($img_big_name)&&($img_big_name != "")) || $del_big == "y"){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_sml_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if($img_sml_old !=""){ // ���� ȭ�� �ִ°�?
				if(file_exists("$Co_img_UP$mart_id/$img_sml_old")){ // ȭ�� ������...
					unlink("$Co_img_UP$mart_id/$img_sml_old"); // ����...
				}
			}
		}
		if($img_updateflag=="ok"){
			
			if($img_old !=""){ // ���� ȭ�� �ִ°�?
				if(file_exists("$Co_img_UP$mart_id/$img_old")){ // ȭ�� ������...
					unlink("$Co_img_UP$mart_id/$img_old"); // ����...
				}
			}
		}
		if($img_big_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if($img_big_old !=""){ // ���� ȭ�� �ִ°�?
				if(file_exists("$Co_img_UP$mart_id/$img_big_old")){ // ȭ�� ������...
					unlink("$Co_img_UP$mart_id/$img_big_old"); // ����...
				}
			}
		}	
	}
	
	if((isset($img_big2_name)&&($img_big2_name != "")) || $del_big2 == "y"){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_big2_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if($img_big2_old !=""){ // ���� ȭ�� �ִ°�?
				if(file_exists("$Co_img_UP$mart_id/$img_big2_old")){ // ȭ�� ������...
					unlink("$Co_img_UP$mart_id/$img_big2_old"); // ����...
				}
			}
		}
			
	}
	
	if((isset($img_big3_name)&&($img_big3_name != "")) || $del_big3 == "y"){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_big3_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if($img_big3_old !=""){ // ���� ȭ�� �ִ°�?
				if(file_exists("$Co_img_UP$mart_id/$img_big3_old")){ // ȭ�� ������...
					unlink("$Co_img_UP$mart_id/$img_big3_old"); // ����...
				}
			}
		}
			
	}
	
	if((isset($img_big4_name)&&($img_big4_name != "")) || $del_big4 == "y"){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_big4_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if($img_big4_old !=""){ // ���� ȭ�� �ִ°�?
				if(file_exists("$Co_img_UP$mart_id/$img_big4_old")){ // ȭ�� ������...
					unlink("$Co_img_UP$mart_id/$img_big4_old"); // ����...
				}
			}
		}	
	}
	
	if((isset($img_big5_name)&&($img_big5_name != "")) || $del_big5 == "y"){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_big5_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if($img_big5_old !=""){ // ���� ȭ�� �ִ°�?
				if(file_exists("$Co_img_UP$mart_id/$img_big5_old")){ // ȭ�� ������...
					unlink("$Co_img_UP$mart_id/$img_big5_old"); // ����...
				}
			}
		}	
	}
					
	
		//================== ���ε� ������ �ҷ��� ================================================
		include "../../upload.php";
		$upload = "$Co_img_UP"."$mart_id/";
		//================== ÷�� ������ ���ε��� ================================================
##################################img_big###############################################
	
	if (isset($img_big_name)&&($img_big_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}


		
		if( $img_big_name ){


			$file = FileUploadName( "", "$upload", $img_big, $img_big_name );//������ ���ε� ��

			if( !$file ){
				echo("
					<script>
					window.alert('���� ���ε忡 �����߽��ϴ�.');
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


			$file = FileUploadName( "", "$upload", $img_big2, $img_big2_name );//������ ���ε� ��

			if( !$file ){
				echo("
					<script>
					window.alert('���� ���ε忡 �����߽��ϴ�.');
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


			$file = FileUploadName( "", "$upload", $img_big3, $img_big3_name );//������ ���ε� ��

			if( !$file ){
				echo("
					<script>
					window.alert('���� ���ε忡 �����߽��ϴ�.');
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


			$file = FileUploadName( "", "$upload", $img_big4, $img_big4_name );//������ ���ε� ��

			if( !$file ){
				echo("
					<script>
					window.alert('���� ���ε忡 �����߽��ϴ�.');
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


			$file = FileUploadName( "", "$upload", $img_big5, $img_big5_name );//������ ���ε� ��

			if( !$file ){
				echo("
					<script>
					window.alert('���� ���ε忡 �����߽��ϴ�.');
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





	if($img_big_updateflag=="ok" && $img_big_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big_name"))
		copy ("$Co_img_UP$mart_id/$img_big_name","$Co_img_UP$mart_id/$img_big_new" );	//���ε� ���� ����
	}
	if($img_big2_updateflag=="ok" && $img_big2_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big2_name"))
			copy ("$Co_img_UP$mart_id/$img_big2_name","$Co_img_UP$mart_id/$img_big2_new" );	//���ε� ���� ����
	}
	if($img_big3_updateflag=="ok" && $img_big3_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big3_name"))
			copy ("$Co_img_UP$mart_id/$img_big3_name","$Co_img_UP$mart_id/$img_big3_new" );	//���ε� ���� ����
	}
	if($img_big4_updateflag=="ok" && $img_big4_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big4_name"))
			copy ("$Co_img_UP$mart_id/$img_big4_name","$Co_img_UP$mart_id/$img_big4_new" );	//���ε� ���� ����
	}
	if($img_big5_updateflag=="ok" && $img_big5_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big5_name"))
			copy ("$Co_img_UP$mart_id/$img_big5_name","$Co_img_UP$mart_id/$img_big5_new" );	//���ε� ���� ����
	}


	//�ӽ�ȭ�� ����
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



	
	
	
	
	
################################ �̹��� ���� ##################################33
$rg_file1_path = "$Co_img_UP$mart_id/$img_big_new";
$rg_file2_path = "$Co_img_UP$mart_id/$img_big2_new";
$rg_file3_path = "$Co_img_UP$mart_id/$img_big3_new";
$rg_file4_path = "$Co_img_UP$mart_id/$img_big4_new";
$rg_file5_path = "$Co_img_UP$mart_id/$img_big5_new";

/*
$FileName : ���ϸ�
$ori_path : �������ϰ��
$maxItem_no_1 : �����ֱٱ۹�ȣ + 1�Ѱ�
$mart_id : ���� ���̵�
�Ǹ��������� : ���ϼ��� �α�����

����� ����� home2�� �ֽż����� �ű�� home�� ����
*/
function MakeThum1($FileName,$ori_path,$maxItem_no_1,$mart_id,$unique) 
{
        $ThumFileName130 = $maxItem_no_1."_".$unique."_".$FileName."130.gif";
		$ThumFileName300 = $maxItem_no_1."_".$unique."_".$FileName."300.gif";
		$ThumFileName600 = $maxItem_no_1."_".$unique."_".$FileName."600.gif";
        
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
		$ThumFileName600 = $maxItem_no_1."_".$unique."_".$FileName . "600.gif";
        
        $FileName = $ori_path;
		$ThumFileName600 = "/home/".$mart_id."/public_html/co_img/".$mart_id."/" . $ThumFileName600;
        
		exec ("convert -geometry 600x $FileName $ThumFileName600");




		if(file_exists("$ori_path")){ 
			unlink ("$ori_path");	
		}



}
################################ �̹��� ���� ##################################33
	
	
	
	
	
	
	
	if(isset($img_big_name)&&($img_big_name != "")){ // ȭ�� �Է³��� �����ƴϰ�

		
		MakeThum1($img_big_name,$rg_file1_path,$item_no,$mart_id,1); 

		
		
		$img_new = $item_no."_1_".$img_big_name."300.gif";
		$img_sml_new = $item_no."_1_".$img_big_name."130.gif";
		$img_big_new_th =  $item_no."_1_".$img_big_name."600.gif";

		
		
		
		$img_query = ", img='$img_new'";
		$img_sml_query = ", img_sml='$img_sml_new'";
		$img_big_query = ", img_big='$img_big_new_th'";
	}
	if(isset($img_big2_name)&&($img_big2_name != "")){ // ȭ�� �Է³��� �����ƴϰ�

		MakeThum2($img_big2_name,$rg_file2_path,$item_no,$mart_id,2);
		
		$img_big2_new_th =  $item_no."_2_".$img_big2_name."600.gif";

		$img_big2_query = ", img_big2='$img_big2_new_th'";
	}
	if(isset($img_big3_name)&&($img_big3_name != "")){ // ȭ�� �Է³��� �����ƴϰ�

		MakeThum2($img_big3_name,$rg_file3_path,$item_no,$mart_id,3); 

		$img_big3_new_th =  $item_no."_3_".$img_big3_name."600.gif";

		$img_big3_query = ", img_big3='$img_big3_new_th'";
	}
	if(isset($img_big4_name)&&($img_big4_name != "")){ // ȭ�� �Է³��� �����ƴϰ�

		MakeThum2($img_big4_name,$rg_file4_path,$item_no,$mart_id,4); 
		
		$img_big4_new_th =  $item_no."_4_".$img_big4_name."600.gif";
		
		$img_big4_query = ", img_big4='$img_big4_new_th'";
	}
	if(isset($img_big5_name)&&($img_big5_name != "")){ // ȭ�� �Է³��� �����ƴϰ�

		MakeThum2($img_big5_name,$rg_file5_path,$item_no,$mart_id,5); 
		
		$img_big5_new_th =  $item_no."_5_".$img_big5_name."600.gif";
		
		$img_big5_query = ", img_big5='$img_big5_new_th'";
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
	$SQL = "update $ItemTable set item_name='$item_name', price='$price', z_price='$z_price', g_margin='$g_margin', member_price='$member_price', bonus='$bonus', use_bonus='$use_bonus', jaego='$jaego' $img_query $img_big_query $img_big2_query $img_big3_query $img_big4_query $img_big5_query, opt='$opt', doctype='$doctype', item_explain='$item_explain', short_explain='$short_explain', reg_date='$reg_date', item_company ='$item_company', item_code='$item_code', icon_no='$icon_no', use_opt1='$use_opt1', use_opt23='$use_opt23', jaego_use='$jaego_use', if_strike='$if_strike', if_provide_item='$if_provide_item', provider_id='$provider_id', provide_price='$provide_price' $img_sml_query , flash_big_width='$flash_big_width', flash_big_height='$flash_big_height', if_hide='$if_hide', img_high='$img_high_new', if_cash='$if_cash', fee='$fee' where item_no='$item_no' and mart_id='$mart_id'";

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