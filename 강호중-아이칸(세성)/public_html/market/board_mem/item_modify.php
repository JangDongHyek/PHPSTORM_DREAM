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
	$short_explain = str_replace( "\n", "<br>", $short_explain );

	$SQL = "insert into $ItemTable (mart_id, firstno, prevno, category_num, item_name, price, address2, g_margin, zip, bonus, use_bonus, jaego, img, img_big, img_big2, img_big3, img_big4, img_big5, opt, doctype, item_explain, short_explain, reg_date, item_code, read_num, mobile, email, use_opt1, use_opt23, item_order, jaego_use, if_strike, if_provide_item, provider_id, provide_price, img_sml, flash_big_width, flash_big_height, img_high, if_cash, fee) values ('$mart_id', '$prevno2', '$prevno', '$category_num', '$item_name', '$price', '$address2', '$g_margin', '$zip', '$bonus', '$use_bonus','$jaego','$img_new','$img_big_new','$img_big2_new','$img_big3_new','$img_big4_new','$img_big5_new','$opt','$doctype','$item_explain', '$short_explain', '$reg_date','$item_code', 0, '$mobile', '$email','$use_opt1','$use_opt23','100','$jaego_use','$if_strike','$if_provide_item', '$provider_id', '$provide_price', '$img_sml_new','$flash_big_width','$flash_big_height', '$img_high_new', '$if_cash', '$fee')";

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
#######################################################################################
	//$opt = $op1."=".$op2."=".$op3;
	$opt=$op_name1;



	if((isset($img_big_name)&&($img_big_name != "")) || $del_big == "y"){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_big_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if($img_big_old !=""){ // ���� ȭ�� �ִ°�?
				if(file_exists("$Co_img_UP$mart_id/$img_big_old")){ // ȭ�� ������...
					unlink("$Co_img_UP$mart_id/$img_big_old"); // ����...
				}
			}
		}
			
	}
	
					
	
		//================== ���ε� ������ �ҷ��� ================================================
		include "../../upload.php";
		$upload = "$Co_img_UP"."$mart_id/";
		//================== ÷�� ������ ���ε��� ================================================
##################################img_big###############################################
	
	if (isset($img_sml_name)&&($img_sml_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}


		
		if( $img_sml_name ){


			$file = FileUploadName( "", "$upload", $img_sml, $img_sml_name );//������ ���ε� ��

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
	if (isset($img_name)&&($img_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}


		
		if( $img_name ){


			$file = FileUploadName( "", "$upload", $img, $img_name );//������ ���ε� ��

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




	if($img_big_updateflag=="ok" && $img_big_name != ""){
		$img_big_new = "item_big_".$item_no."_".$img_big_name;
	}





	if($img_big_updateflag=="ok" && $img_big_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big_name"))
		copy ("$Co_img_UP$mart_id/$img_big_name","$Co_img_UP$mart_id/$img_big_new" );	//���ε� ���� ����
	}


	//�ӽ�ȭ�� ����
	if($img_big_updateflag=="ok" && $img_big_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big_name"))
			unlink("$Co_img_UP$mart_id/$img_big_name");
	}



	
	
	
	
	################################ �̹��� ���� ##################################33
	$rg_file1_path = "$Co_img_UP$mart_id/$img_big_new";

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
			$ThumFileName120 = $maxItem_no_1."_".$unique."_".$FileName."120.gif";
			
			$FileName = $ori_path;
			$ThumFileName120 = "/home/".$mart_id."/public_html/co_img/".$mart_id."/" . $ThumFileName120;
			
			exec ("convert -geometry 120x $FileName $ThumFileName120");




			if(file_exists("$ori_path")){ 
				unlink ("$ori_path");	
			}



	}

	################################ �̹��� ���� ##################################33
	
	
	if(isset($img_big_name)&&($img_big_name != "")){ // ȭ�� �Է³��� �����ƴϰ�

		
		MakeThum1($img_big_name,$rg_file1_path,$item_no,$mart_id,1); 

		
		
		$img_big_new_th =  $item_no."_1_".$img_big_name."120.gif";

		
		
		
		$img_big_query = ", img_big='$img_big_new_th'";
	}
	
	
	
	
	
	
	
	
	$short_explain = str_replace( "\n", "<br>", $short_explain );
	if($item_pw){
	$item_pw_qry = ", item_pw='$item_pw'";
	}
	$SQL = "update $ItemTable set 
                 co_name='$co_name', 
                 co_num='$co_num', 
                 address2='$address2', 
                 tel='$tel', 
                 g_margin='$g_margin', 
                 zip='$zip',
                 address='$address', 
                 job='$job',
                 hobby='$hobby' 
                 $img_query 
             	 $img_big_query 
             	 $img_big2_query 
             	 $img_big3_query 
             	 $img_big4_query 
             	 $img_big5_query,  
                 doctype='$doctype', 
                 item_explain='$item_explain', 
                 short_explain='$short_explain', 
                 reg_date='$reg_date',  
                 email='$email',
                 com_bank_name='$com_bank_name', 
                 com_bank_account='$com_bank_account', 
                 com_bank_master='$com_bank_master', 
                 my_bank_name='$my_bank_name', 
                 my_bank_account='$my_bank_account', 
                 my_bank_master='$my_bank_master' ,
                 sea_area='$sea_area',
                 sung_area='$sung_area',
                 khan_area='$khan_area',
                 provider_id='$provider_id' $item_pw_qry $img_sml_query , img_high='$img_high_new' where item_no='$item_no' and mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);
	
	$opt_no=explode("/",$opt_no);
	$opt_name=explode("/",$opt_name);
	$opt_price=explode("/",$opt_price);
	$opt_ea=explode("/",$opt_ea);
	$opt_order=explode("/",$opt_order);
	$opt_code=explode("/",$opt_code);
	for($i=0;$i<sizeof($opt_no)-1;$i++){
		if($opt_no[$i]){
			if($opt_name[$i]){
				//������Ʈ �ϱ�
				$sql="update $OptionTable set opt_name='$opt_name[$i]',opt_price='$opt_price[$i]',opt_ea='$opt_ea[$i]',opt_order='$opt_order[$i]',opt_code='$opt_code[$i]' where opt_no='$opt_no[$i]'";
			}else{
				//�����ϱ�
				$sql="delete from $OptionTable where opt_no='$opt_no[$i]'";
			}
		}else{
			if($opt_name[$i]){
				//�μ�Ʈ�ϱ�
				$sql="insert into $OptionTable(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name[$i]','$opt_price[$i]','$opt_ea[$i]','$opt_order[$i]','$opt_code[$i]')";
			}else{
				$sql="delete from $OptionTable set opt_no='$opt_no[$i]'";
			}
		}
		
		$result=mysql_query($sql);
	}
	$opt_no2=explode("/",$opt_no2);
	$opt_name2=explode("/",$opt_name2);
	$opt_price2=explode("/",$opt_price2);
	$opt_ea2=explode("/",$opt_ea2);
	$opt_order2=explode("/",$opt_order2);
	$opt_code2=explode("/",$opt_code2);
	for($i=0;$i<sizeof($opt_no2)-1;$i++){
		if($opt_no2[$i]){
			if($opt_name2[$i]){
				//������Ʈ �ϱ�
				$sql="update $OptionTable2 set opt_name='$opt_name2[$i]',opt_price='$opt_price2[$i]',opt_ea='$opt_ea2[$i]',opt_order='$opt_order2[$i]',opt_code='$opt_code2[$i]' where opt_no='$opt_no2[$i]'";
			}else{
				//�����ϱ�
				$sql="delete from $OptionTable2 where opt_no='$opt_no2[$i]'";
			}
		}else{
			if($opt_name2[$i]){
				//�μ�Ʈ�ϱ�
				$sql="insert into $OptionTable2(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name2[$i]','$opt_price2[$i]','$opt_ea2[$i]','$opt_order2[$i]','$opt_code2[$i]')";
			}else{
				$sql="delete from $OptionTable2 set opt_no='$opt_no2[$i]'";
			}
		}
		$result=mysql_query($sql);
	}

	$opt_no3=explode("/",$opt_no3);
	$opt_name3=explode("/",$opt_name3);
	$opt_price3=explode("/",$opt_price3);
	$opt_ea3=explode("/",$opt_ea3);
	$opt_order3=explode("/",$opt_order3);
	$opt_code3=explode("/",$opt_code3);
	for($i=0;$i<sizeof($opt_no3)-1;$i++){
		if($opt_no3[$i]){
			if($opt_name3[$i]){
				//������Ʈ �ϱ�
				$sql="update $OptionTable3 set opt_name='$opt_name3[$i]',opt_price='$opt_price3[$i]',opt_ea='$opt_ea3[$i]',opt_order='$opt_order3[$i]',opt_code='$opt_code3[$i]' where opt_no='$opt_no3[$i]'";
			}else{
				//�����ϱ�
				$sql="delete from $OptionTable3 where opt_no='$opt_no3[$i]'";
			}
		}else{
			if($opt_name3[$i]){
				//�μ�Ʈ�ϱ�
				$sql="insert into $OptionTable3(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name3[$i]','$opt_price3[$i]','$opt_ea3[$i]','$opt_order3[$i]','$opt_code3[$i]')";
			}else{
				$sql="delete from $OptionTable3 set opt_no='$opt_no3[$i]'";
			}
		}
		$result=mysql_query($sql);
	}

	$opt_no4=explode("/",$opt_no4);
	$opt_name4=explode("/",$opt_name4);
	$opt_price4=explode("/",$opt_price4);
	$opt_ea4=explode("/",$opt_ea4);
	$opt_order4=explode("/",$opt_order4);
	$opt_code4=explode("/",$opt_code4);
	for($i=0;$i<sizeof($opt_no4)-1;$i++){
		if($opt_no4[$i]){
			if($opt_name4[$i]){
				//������Ʈ �ϱ�
				$sql="update $OptionTable4 set opt_name='$opt_name4[$i]',opt_price='$opt_price4[$i]',opt_ea='$opt_ea4[$i]',opt_order='$opt_order4[$i]',opt_code='$opt_code4[$i]' where opt_no='$opt_no4[$i]'";
			}else{
				//�����ϱ�
				$sql="delete from $OptionTable4 where opt_no='$opt_no4[$i]'";
			}
		}else{
			if($opt_name3[$i]){
				//�μ�Ʈ�ϱ�
				$sql="insert into $OptionTable4(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name4[$i]','$opt_price4[$i]','$opt_ea4[$i]','$opt_order4[$i]','$opt_code4[$i]')";
			}else{
				$sql="delete from $OptionTable4 set opt_no='$opt_no4[$i]'";
			}
		}
		$result=mysql_query($sql);
	}
	if( $dbresult ){
		if($request_mode == "ok"){
			echo "<meta http-equiv='refresh' content='0; URL=request_myinfo.html?item_no=$item_no&category_num=$category_num&page=$page&searchword=$searchword&pu=$pu'>";
		}else{
			echo "<meta http-equiv='refresh' content='0; URL=myinfo.html?item_no=$item_no&category_num=$category_num&page=$page&searchword=$searchword&pu=$pu'>";
		}
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
