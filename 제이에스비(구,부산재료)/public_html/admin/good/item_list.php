<?
include "../lib/Mall_Admin_Session.php";
?>
<?
//카테고리 현재 위치
$cur_category_name = category_navi($category_num);
$tmp_category_num = $category_num;

$SQL = "select service_name from $MartInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows>0) {
    $service_name = mysql_result($dbresult,0,0);
}

//==================  카테고리를 삭제함 ==================================================
if($delflag=="del_category"){
    $SQL = "select count(*) from $CategoryTable where prevno='$category_num' and mart_id='$mart_id'";
    $dbresult = mysql_query($SQL, $dbconn);
    if (mysql_result($dbresult,0,0) > 0) {
        echo ("
			<script language=\"javascript\">
				alert(\"하위카테고리가 있어 삭제할수 없습니다\");
			</script>
		");
        echo "<meta http-equiv='refresh' content='0; URL=eachcategory.php?category_num=$category_num&pu=$pu'>";
        exit;
    }
    $SQL = "select count(*) from $ItemTable where category_num='$category_num' and mart_id='$mart_id'";
    $dbresult = mysql_query($SQL, $dbconn);
    if (mysql_result($dbresult,0,0) > 0) {
        echo ("
			<script language=\"javascript\">
				alert(\"하위상품이 있어 삭제할수 없습니다\");
			</script>
		");
        echo "<meta http-equiv='refresh' content='0; URL=eachcategory.php?category_num=$category_num'>";
        exit;
    }
    $SQL = "delete from $CategoryTable where category_num = $category_num and mart_id='$mart_id'";
    $dbresult = mysql_query($SQL, $dbconn);
}
//========================================================================================
//==================  상품을 삭제함 ======================================================
if($delflag=="del_item"){
//	if($mart_id == $mart_id){ // 내상품이면
    //파일을 삭제함
    $SQL = "select img,img_big,img_sml from $ItemTable where item_no = $item_no and mart_id='$mart_id'";
    $dbresult = mysql_query($SQL, $dbconn);
    $numRows = mysql_num_rows($dbresult);
    if($numRows>0) {
        $img = mysql_result($dbresult,0,0);
        $img_big = mysql_result($dbresult,0,1);
        $img_sml = mysql_result($dbresult,0,2);

        if($img_sml != ""&&file_exists("$Co_img_UP$mart_id/$img_sml")){
            unlink ("$Co_img_UP$mart_id/$img_sml");
        }
        if($img_big != ""&&file_exists("$Co_img_UP$mart_id/$img_big")){
            unlink ("$Co_img_UP$mart_id/$img_big");
        }
        if($img != ""&&file_exists("$Co_img_UP$mart_id/$img")){
            unlink ("$Co_img_UP$mart_id/$img");
        }
    }

    //상품자체를 삭제
    $SQL = "delete from $ItemTable where item_no='$item_no' and mart_id='$mart_id'";
    $dbresult = mysql_query($SQL, $dbconn);

    //다른 상점들 gnt_item 테이블에서 삭제
    $SQL = "delete from $Gnt_ItemTable where item_no='$item_no'";
    $dbresult = mysql_query($SQL, $dbconn);

    //내상점과 다른 상점들 신상품, 인기상품, 추천상품, 선물 에서 삭제
    //신상품에서 삭제
    $SQL = "delete from $New_ItemTable where item_no = $item_no";
    $dbresult = mysql_query($SQL, $dbconn);
    //인기상품에서 삭제
    $SQL = "delete from $Fav_ItemTable where item_no = $item_no";
    $dbresult = mysql_query($SQL, $dbconn);
    //추천상품에서 삭제
    $SQL = "delete from $Rec_ItemTable where item_no = $item_no";
    $dbresult = mysql_query($SQL, $dbconn);
    //선물상품에서 삭제
    $SQL = "delete from $Gift_ItemTable where item_no = $item_no";
    $dbresult = mysql_query($SQL, $dbconn);
    // wishlist 상품에서 삭제
    $SQL = "delete from $Pre_SelectTable where item_no = $item_no";
    $dbresult = mysql_query($SQL, $dbconn);
    // 상품문의에서 삭제
    $SQL = "delete from $New_BoardTable where area = $item_no";
    $dbresult = mysql_query($SQL, $dbconn);
    //옵션 삭제
    $SQL = "delete from $OptionTable where item_no='$item_no'";
    $dbresult=mysql_query($SQL,$dbconn);
    $SQL = "delete from $OptionTable2 where item_no='$item_no'";
    $dbresult=mysql_query($SQL,$dbconn);
    $SQL = "delete from $OptionTable3 where item_no='$item_no'";
    $dbresult=mysql_query($SQL,$dbconn);
    $SQL = "delete from $OptionTable4 where item_no='$item_no'";
    $dbresult=mysql_query($SQL,$dbconn);
    /*	}else { //gnt로 가져온 상품이면
            //gnt_item 테이블에서 삭제
            $SQL = "delete from $Gnt_ItemTable where seller_id = '$mart_id' and item_no = $item_no";
            $dbresult = mysql_query($SQL, $dbconn);

            //내상점의 신상품, 인기상품, 추천상품, 선물 에서 삭제

            //신상품에서 삭제
            $SQL = "delete from $New_ItemTable where item_no = $item_no and mart_id='$mart_id'";
            $dbresult = mysql_query($SQL, $dbconn);
            //인기상품에서 삭제
            $SQL = "delete from $Fav_ItemTable where item_no = $item_no and mart_id='$mart_id'";
            $dbresult = mysql_query($SQL, $dbconn);
            //추천상품에서 삭제
            $SQL = "delete from $Rec_ItemTable where item_no = $item_no and mart_id='$mart_id'";
            $dbresult = mysql_query($SQL, $dbconn);
            //선물상품에서 삭제
            $SQL = "delete from $Gift_ItemTable where item_no = $item_no and mart_id='$mart_id'";
            $dbresult = mysql_query($SQL, $dbconn);
        }*/
}
//================== 상품을 삭제함 =======================================================
if($flag=="del_item1"){
    for($i=0; $i<count($checkSel); $i++) {
        $checkSels = explode("!", $checkSel[$i]);
        $item_no = $checkSels[0];
        $mart_id = $checkSels[1];

//		if($Mall_Admin_ID == $mart_id){ // 내상품이면
        $SQL = "select img,img_big,img_sml from $ItemTable where item_no = $item_no and mart_id='$mart_id'";
        $dbresult = mysql_query($SQL, $dbconn);
        $numRows = mysql_num_rows($dbresult);
        if($numRows>0) {
            $img = mysql_result($dbresult,0,0);
            $img_big = mysql_result($dbresult,0,1);
            $img_sml = mysql_result($dbresult,0,2);

            if($img_sml != ""&&file_exists("$Co_img_UP$mart_id/$img_sml")){
                unlink ("$Co_img_UP$mart_id/$img_sml");
            }
            if($img_big != ""&&file_exists("$Co_img_UP$mart_id/$img_big")){
                unlink ("$Co_img_UP$mart_id/$img_big");
            }
            if($img != ""&&file_exists("$Co_img_UP$mart_id/$img")){
                unlink ("$Co_img_UP$mart_id/$img");
            }
        }

        //상품자체를 삭제
        $SQL = "delete from $ItemTable where item_no = $item_no and mart_id='$mart_id'";
        $dbresult = mysql_query($SQL, $dbconn);

        //다른 상점들 gnt_item 테이블에서 삭제
        $SQL = "delete from $Gnt_ItemTable where item_no = $item_no";
        $dbresult = mysql_query($SQL, $dbconn);

        //내상점과 다른 상점들 신상품, 인기상품, 추천상품, 선물 에서 삭제
        //베스트상품에서 삭제
        $SQL = "delete from $Best_ItemTable where item_no = $item_no";
        $dbresult = mysql_query($SQL, $dbconn);
        //특가상품에서 삭제
        $SQL = "delete from $Spe_ItemTable where item_no = $item_no";
        $dbresult = mysql_query($SQL, $dbconn);
        //신상품에서 삭제
        $SQL = "delete from $New_ItemTable where item_no = $item_no";
        $dbresult = mysql_query($SQL, $dbconn);
        //인기상품에서 삭제
        $SQL = "delete from $Fav_ItemTable where item_no = $item_no";
        $dbresult = mysql_query($SQL, $dbconn);
        //추천상품에서 삭제
        $SQL = "delete from $Rec_ItemTable where item_no = $item_no";
        $dbresult = mysql_query($SQL, $dbconn);
        //선물상품에서 삭제
        $SQL = "delete from $Gift_ItemTable where item_no = $item_no";
        $dbresult = mysql_query($SQL, $dbconn);
        // wishlist 상품에서 삭제
        $SQL = "delete from $Pre_SelectTable where item_no = $item_no";
        $dbresult = mysql_query($SQL, $dbconn);
        // 상품문의에서 삭제
        $SQL = "delete from $New_BoardTable where area = $item_no";
        $dbresult = mysql_query($SQL, $dbconn);
        //옵션 삭제
        $SQL = "delete from $OptionTable where item_no='$item_no'";
        $dbresult=mysql_query($SQL,$dbconn);
        $SQL = "delete from $OptionTable2 where item_no='$item_no'";
        $dbresult=mysql_query($SQL,$dbconn);
        $SQL = "delete from $OptionTable3 where item_no='$item_no'";
        $dbresult=mysql_query($SQL,$dbconn);
        $SQL = "delete from $OptionTable4 where item_no='$item_no'";
        $dbresult=mysql_query($SQL,$dbconn);
        /*}
        else { //gnt로 가져온 상품이면
            //gnt_item 테이블에서 삭제
            $SQL = "delete from $Gnt_ItemTable where seller_id = '$Mall_Admin_ID' and item_no = $item_no";
            $dbresult = mysql_query($SQL, $dbconn);

            //내상점의 신상품, 인기상품, 추천상품, 선물 에서 삭제
            //베스트상품에서 삭제
            $SQL = "delete from $Best_ItemTable where item_no = $item_no and mart_id='$mart_id'";
            $dbresult = mysql_query($SQL, $dbconn);
            //특가상품에서 삭제
            $SQL = "delete from $Spe_ItemTable where item_no = $item_no and mart_id='$mart_id'";
            $dbresult = mysql_query($SQL, $dbconn);
            //신상품에서 삭제
            $SQL = "delete from $New_ItemTable where item_no = $item_no and mart_id='$mart_id'";
            $dbresult = mysql_query($SQL, $dbconn);
            //인기상품에서 삭제
            $SQL = "delete from $Fav_ItemTable where item_no = $item_no and mart_id='$mart_id'";
            $dbresult = mysql_query($SQL, $dbconn);
            //추천상품에서 삭제
            $SQL = "delete from $Rec_ItemTable where item_no = $item_no and mart_id='$mart_id'";
            $dbresult = mysql_query($SQL, $dbconn);
            //선물상품에서 삭제
            $SQL = "delete from $Gift_ItemTable where item_no = $item_no and mart_id='$mart_id'";
            $dbresult = mysql_query($SQL, $dbconn);
        }*/
    }
    echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================
if (isset($flag) == false) {
    if (isset($prevno) == false) $prevno = 0;
    ?>
    <html>
    <head>
        <title><?=$admin_title?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
        <script language="javascript" src="../js/common.js"></script>
        <link href="../css/style.css" rel="stylesheet" type="text/css">
        <SCRIPT LANGUAGE='JavaScript1.1'>
<!--
function goto_byselect(sel, targetstr){
  var index = sel.selectedIndex;
  if (sel.options[index].value != '') {
	  if (targetstr == 'blank') {
		 window.open(sel.options[index].value, 'win1');
	  } else {
		 var frameobj;
		 if ((frameobj = eval(targetstr)) != null)
			frameobj.location = "item_list.php?pu=<?=$pu?>&category_num=" + sel.options[index].value;
	  }
  }
}

function checkform(f){
  	if (f.category_name.value=="") {
		alert("카테고리 명을 입력해주세요.");
		f.category_name.focus();
		return false;
	}
	return true;
}
function checkform1(f){
  	if (f.target_category.value=="") {
		alert("카테고리를 선택하세요.");
		f.target_category.focus();
		return false;
	}
	return true;
}
function really2(item_no, tmp_category_num, mart_id){
	if (confirm("현재상품을 삭제하시겠습니까?")){
		document.location.href='item_list.php?pu=<?=$pu?>&delflag=del_item&item_no='+item_no+'&category_num='+tmp_category_num+'&mart_id='+mart_id;
	}
}

function del_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 상품을 삭제하시겠습니까?")){
		f.flag.value='del_item1';
		f.submit();
	}
	return true;
}

function to_item(f){
  if (confirm("선택한 상품의 순서를 변경하시겠습니까?")){
		f.flag.value='to_item';
		f.submit();
	}
	return true;
}

function hide_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 상품을 숨기시겠습니까?")){
		f.flag.value='hide_item';
		f.submit();
	}
	return true;
}

function see_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 상품을 출력하시겠습니까?")){
		f.flag.value='see_item';
		f.submit();
	}
	return true;
}

function sold_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 상품을 품절로 하시겠습니까?")){
		f.flag.value='sold_item';
		f.submit();
	}
	return true;
}

function sale_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 상품의 품절을 해제하시겠습니까? \n재고량은 기본 100개로 설정됩니다.")){
		f.flag.value='sale_item';
		f.submit();
	}
	return true;
}

function free_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 상품을 무료배송으로 하시겠습니까?")){
		f.flag.value='free_item';
		f.submit();
	}
	return true;
}

function fee_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 상품을 착불배송으로 하시겠습니까?")){
		f.flag.value='fee_item';
		f.submit();
	}
	return true;
}

function prefee_item(f){
  if(!checkitems())
  {
	return false;
  }
  if (confirm("선택한 상품을 선불배송으로 하시겠습니까?")){
		f.flag.value='prefee_item';
		f.submit();
	}
	return true;
}

function checkitems(){
	var i;
	a_checkbox  = document.getElementsByName("checkSel[]");
	for(i=0; i<a_checkbox.length; i++)
	{
		if(a_checkbox[i].checked == true)
			break;
	}
	if(i==a_checkbox.length)
	{
		alert("상품을 선택하세요.");
		return false;
	}
	return true;
}
function copy_item(f){
	if(!checkitems())
	{
		return false;
	}
  if (f.target_category.value=="") {
		alert("카테고리를 선택하세요.");
		f.target_category.focus();
		return false;
	}
	f.flag.value='copy_item';
	f.submit();
	return true;
}

function move_item(f){
	if(!checkitems())
	{
		return false;
	}
  if (f.target_category.value=="") {
		alert("카테고리를 선택하세요.");
		f.target_category.focus();
		return false;
	}
	f.flag.value='move_item';
	f.submit();
	return true;
}

function toggle(val) {
	dl = document.list;

    for (i = 0; i < dl.elements.length; i++) {
      if (dl.elements[i].name == 'checkSel[]')
        dl.elements[i].checked = val;
    }
}

function no_search(){
	document.search_form.searchword.value='';
	document.search_form.submit();
}

function check_ver(first_no,second_no,thirdno,category_num){
	window.location.href="./item_add.php?pu=<?=$pu?>&first_no=" + first_no + "&second_no=" + second_no + "&thirdno=" + thirdno + "&category_num=" + category_num;
}

//-->
</SCRIPT>
    </head>

    <body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
    <?
    //$left_menu = "3_1";
    //include "../include/left_menu03_1.php";
    ?>
    <table width="600" height="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr valign="top">
            <td>
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="100%" height="40" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>현재카테고리 : <?=$cur_category_name?></b></td>
                    </tr>
                </table>
                <!--내용 START~~-->
                <table border="0" width="98%" cellspacing="0" cellpadding="0" align='center'>
                    <!-- <tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top" align="right">
					<span class="ee"><b>카테고리 이동</b>&nbsp;&nbsp;
					<select onchange="goto_byselect(this, 'self')" class="aa" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
<?
                    /*
                    $SQL = "select category_num,category_name from $CategoryTable where mart_id='$mart_id' and prevno='0' order by category_num desc";
                    $dbresult = mysql_query($SQL, $dbconn);
                    $tmp_category_num = $category_num;
                    $numRows = mysql_num_rows($dbresult);
                    for($i=0; $i<$numRows; $i++){
                        $category_num = mysql_result($dbresult,$i,0);
                        $category_name = mysql_result($dbresult,$i,1);

                        $SQL2 = "select category_num,category_name from $CategoryTable where mart_id='$mart_id' and prevno='$category_num' order by category_num desc";
                        $dbresult2 = mysql_query($SQL2, $dbconn);
                        $numRows1 = mysql_num_rows($dbresult2);

                        echo ("
                                        <option value='item_list.php?category_num=$category_num'
                        ");
                        if($tmp_category_num == $category_num){
                            echo "selected";
                            $cur_category_name = $category_name;
                        }
                        echo (" style='color:#000000; background-color:#dddddd;'>▷$category_name</option>");

                        for($j=0;$j<$numRows1;$j++){
                            $category_num1 = mysql_result($dbresult2,$j,0);
                            $category_name1 = mysql_result($dbresult2,$j,1);

                            $SQL3 = "select category_num,category_name from $CategoryTable where mart_id='$mart_id' and prevno='$category_num1' order by category_num desc";
                            $dbresult3 = mysql_query($SQL3, $dbconn);
                            $numRows3 = mysql_num_rows($dbresult3);

                            echo ("
                                        <option value='item_list.php?category_num=$category_num1'
                            ");
                            if($tmp_category_num == $category_num1){
                                echo "selected";
                                $cur_category_name = $category_name1;
                            }
                            echo ("	> &nbsp;&nbsp;&nbsp;&nbsp- $category_name1</option>");

                            for($k=0;$k<$numRows3;$k++){
                                $category_num3 = mysql_result($dbresult3,$k,0);
                                $category_name3 = mysql_result($dbresult3,$k,1);

                                echo ("
                                            <option value='item_list.php?category_num=$category_num3'
                                ");
                                if($tmp_category_num == $category_num3){
                                    echo "selected";
                                    $cur_category_name = $category_name3;
                                }
                                echo ("	> &nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp- $category_name3</option>");
                            }
                        }
                    }
                    // 주고 받기 카테고리..

                    $SQL = "select category_num from $GiveNTakeTable where seller_id = '$Mall_Admin_ID' order by gnt_no desc";
                    $dbresult = mysql_query($SQL, $dbconn);
                    $numRows = mysql_num_rows($dbresult);
                    for ($i=0; $i<$numRows; $i++) {
                        $category_num_tmp = mysql_result($dbresult,$i,0);
                        $SQL1 = "select category_num,category_name,provider_id from $CategoryTable where category_num = $category_num_tmp";
                        $dbresult1 = mysql_query($SQL1, $dbconn);
                        $numRows1 = mysql_num_rows($dbresult1);
                        for ($j=0; $j<$numRows1; $j++) {
                            $category_num1 = mysql_result($dbresult1,$j,0);
                            $category_name1 = mysql_result($dbresult1,$j,1);
                            $provider_id1 = mysql_result($dbresult1,$j,2);

                            $SQL2 = "select category_num,category_name from $CategoryTable where prevno=$category_num1 order by cat_order desc";
                            $dbresult2 = mysql_query($SQL2, $dbconn);
                            $numRows2 = mysql_num_rows($dbresult2);
                                                echo ("
                                            <option value='item_list_gnt.php?category_num=$category_num1'
                                                ");
                                                if($tmp_category_num == $category_num1) {
                                                    echo "selected";
                                                    $cur_category_name = $category_name1;
                                                }
                                                echo (" style='color:#000000; background-color:#dddddd;'>▷$category_name1</option>
                                                ");

                                                for($k=0;$k<$numRows2;$k++){
                                                    $category_num2 = mysql_result($dbresult2,$k,0);
                                                    $category_name2 = mysql_result($dbresult2,$k,1);

                                                    echo ("
                                            <option value='item_list_gnt.php?category_num=$category_num2'
                                                    ");
                                                    if($tmp_category_num == $category_num2){
                                                        echo "selected";
                                                        $cur_category_name = $category_name2;
                                                    }
                                                    echo ("	> &nbsp;&nbsp;&nbsp;&nbsp- $category_name2</option>");
                                                }
                                            }
                    }*/
                    ?>

					</select><br>
					<br>
					</span>
				</td>
			</tr> -->
                    <tr>
                        <td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
                            <table border="0" width="100%">
                                <form onsumbit='return checkform(this)'>
                                    <input type='hidden' name='pu' value='<?=$pu?>'>
                                    <!-- <input type='hidden' name='flag' value='addcategory'> -->
                                    <input type='hidden' name='prevno' value='<?=$tmp_category_num?>'>
                                    <input type='hidden' name='page' value='<?=$page?>'>
                                    <input type='hidden' name='searchword' value='<?=$searchword?>'>
                                    <input type='hidden' name='select_key' value='<?=$select_key?>'>
                                    <input type='hidden' name='category_num' value='<?=$tmp_category_num?>'>
                                    <tr height="20">
                                        <td>
                                            <?
                                            //=========================== 해당 상위 카테고리 정보를 불러옴 ============================
                                            $SQL = "select prevno from $CategoryTable where category_num='$tmp_category_num' and mart_id='$mart_id'";
                                            //echo $SQL;
                                            $dbresult = mysql_query($SQL, $dbconn);
                                            $prevno = mysql_result($dbresult,0,0);
                                            if($prevno > 0)
                                            {
                                                //=========================== 해당 상위 카테고리 정보를 불러옴 ============================
                                                $SQL = "select prevno from $CategoryTable where category_num='$prevno' and mart_id='$mart_id'";
                                                $dbresult = mysql_query($SQL, $dbconn);
                                                $prevno2 = mysql_result($dbresult,0,0);
                                                if($prevno2 > 0)
                                                {
                                                    //=========================== 해당 상위 카테고리 정보를 불러옴 ============================
                                                    $SQL = "select prevno from $CategoryTable where category_num='$prevno2' and mart_id='$mart_id'";
                                                    $dbresult = mysql_query($SQL, $dbconn);
                                                    $prevno3 = mysql_result($dbresult,0,0);
                                                }
                                            }
                                            if( $pu == 1 ){ //1차 카테고리 리스트 일때
                                                //$con = "category_num='$tmp_category_num'";
                                                //$con1 = "a.category_num='$tmp_category_num'";
                                                $con = "firstno='$tmp_category_num'";			// 1차 상품등록
                                                $con1 = "a.firstno='$tmp_category_num'";
                                                $first_no = $tmp_category_num;
                                                $second_no = 0;
                                                $thirdno = 0;
                                                $category_num = $tmp_category_num;
                                            }else if( $pu == 2 ){ //2차 카테고리 리스트 일때
                                                //$con = "category_num='$tmp_category_num'";
                                                //$con1 = "a.category_num='$tmp_category_num'";
                                                $con = "prevno='$tmp_category_num'";			// 3차 상품등록
                                                $con1 = "a.prevno='$tmp_category_num'";
                                                $first_no = $prevno;
                                                $second_no = $tmp_category_num;
                                                $thirdno = 0;
                                                $category_num = $tmp_category_num;
                                            }else if($pu == 3){ //3차 카테고리 리스트 일때
                                                $con = "thirdno='$tmp_category_num'";
                                                $con1 = "a.thirdno='$tmp_category_num'";
                                                $first_no = $prevno2;
                                                $second_no = $prevno;
                                                $thirdno = $tmp_category_num;
                                                $category_num = $tmp_category_num;
                                            }else if($pu == 4){ //3차 카테고리 리스트 일때
                                                $con = "category_num='$tmp_category_num'";
                                                $con1 = "a.category_num='$tmp_category_num'";
                                                $first_no = $prevno3;
                                                $second_no = $prevno2;
                                                $thirdno = $prevno;
                                                $category_num = $tmp_category_num;
                                            }


                                            if($searchword !=''){
                                                if($select_key == "provider_id" ){
                                                    $SQL = "SELECT count(item_no) FROM $ItemTable AS a LEFT JOIN $MemberTable AS b ON a.provider_id = b.username WHERE b.mart_id='$mart_id' AND b.name LIKE '%$searchword%' and  $con1";
                                                }else{
                                                    $SQL = "select count(item_no) from $ItemTable where $con and $select_key like '%$searchword%' and $con and mart_id='$mart_id'";
                                                }
                                            }else{
                                                $SQL = "select count(item_no) from $ItemTable where $con and mart_id='$mart_id'";
                                            }

                                            $dbresult = mysql_query($SQL, $dbconn);
                                            $numRows_tmp = mysql_result($dbresult,0,0);

                                            $numRows += $numRows_tmp;
                                            ?>
                                        </td>
                                    </tr>
                                </form>
                            </table>
                            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="100%" bgcolor="#808080" height="1" colspan="2"></td>
                                </tr>
                                <tr height='25'>
                                    <td width="40%" bgcolor="#FFFFFF">
                                        <p style="padding-left:10px">
                                            현재카테고리에 총 <?=$numRows_tmp?>개 상품 등록
                                    </td>
                                    <td width="60%" bgcolor="#FFFFFF" height="0">
                                        <?
                                        $SQL = "select count(category_num) from $CategoryTable where prevno=$tmp_category_num and mart_id='$mart_id'";
                                        $dbresult = mysql_query($SQL, $dbconn);
                                        $numRows = mysql_result($dbresult,0,0);

                                        //if($numRows == 0){
                                        //if( $pu == "2" ){
                                        //}else{
                                        ?>
                                        <input onclick="check_ver('<?=$first_no?>','<?=$second_no?>','<?=$thirdno?>','<?=$category_num?>')" style='background-color: #4CAABE; color: white; height: 18px; border: 1px solid #4CAABE' type='button' value='상 품 등 록'>&nbsp;
                                        <?
                                        //}
                                        ?>
                                        <!-- <input class='aa' onclick=\"window.location.href='item_order.php?category_num=$tmp_category_num'\" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='상품순서조정'>&nbsp; -->
                                        <?
                                        //}else{
                                        ?>
                                        <!-- <span class='aa'>하위 카테고리가 있어 상품을 등록할 수 없습니다.</span> -->
                                        <?
                                        //}
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="100%" bgcolor="#808080" height="1" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td width="100%" bgcolor="#FFFFFF" colspan="2"></td>
                                </tr>
                                <?
                                if ($cnfPagecount == ""){
                                    $cnfPagecount = 50;
                                }
                                if ($page == "") $page = 1;
                                $skipNum = ($page - 1) * $cnfPagecount;

                                $prev_page = $page - 1;
                                $next_page = $page + 1;

                                if($searchword !=''){
                                    if($select_key == "provider_id" ){
                                        $SQL = "SELECT * FROM $ItemTable AS a LEFT JOIN $MemberTable AS b ON a.provider_id = b.username WHERE b.mart_id='$mart_id' AND b.name LIKE '%$searchword%' and  $con1 order by a.item_order asc, a.item_no desc";
                                    }else{
                                        $SQL = "select * from $ItemTable where $con and $select_key like '%$searchword%' and $con and mart_id='$mart_id' order by item_order asc, item_no desc";
                                    }
                                }else{
                                    $SQL = "select * from $ItemTable where $con and mart_id='$mart_id' order by item_order asc, item_no desc ";
                                }
                                //echo $SQL;

                                $dbresult = mysql_query($SQL, $dbconn);
                                $numRows = mysql_num_rows($dbresult);

                                $total_page = ($numRows - 1) / $cnfPagecount;
                                $total_page = intval($total_page)+1;


                                if($page % 10 == 0)
                                    $start_page = $page - 9;
                                else
                                    $start_page = $page - ($page % 10) + 1;

                                $end_page = $start_page + 9;
                                if($end_page >= $total_page)
                                    $end_page = $total_page;
                                $prev_start_page = $start_page - 10;
                                $next_start_page = $start_page + 10;
                                ?>
                                <tr>
                                    <form method='post' name='search_form'>
                                        <input type='hidden' name='pu' value='<?=$pu?>'>
                                        <!-- <input type='hidden' name='flag' value='addcategory'> -->
                                        <input type='hidden' name='prevno' value='<?=$tmp_category_num?>'>
                                        <input type='hidden' name='page' value='<?=$page?>'>
                                        <input type='hidden' name='searchword' value='<?=$searchword?>'>
                                        <input type='hidden' name='select_key' value='<?=$select_key?>'>
                                        <input type='hidden' name='category_num' value='<?=$tmp_category_num?>'>
                                        <td width="50%" bgcolor="#FFFFFF">
                                            <p style="padding-left: 20px">
							<span class="aa">
							<?
                            if($page == 1){
                                echo ("
								처음
								");
                            }
                            else{
                                echo ("
								<a href='item_list.php?category_num=$tmp_category_num&page=1&searchword=$searchword&select_key=$select_key&pu=$pu'>처음</a>
								");
                            }

                            if($start_page > 1){
                                echo ("
								<a href='item_list.php?category_num=$tmp_category_num&page=$prev_start_page&searchword=$searchword&select_key=$select_key&pu=$pu'>
								◁&nbsp;
								</a>
								");
                            }
                            else{
                                echo ("
								◁&nbsp;
								");
                            }
                            for($i=$start_page;$i<=$end_page;$i++){
                                if($i == $page){
                                    echo ("	
									[<b>$i</b>]
									");
                                }
                                else{
                                    echo ("
								<a href='item_list.php?category_num=$tmp_category_num&page=$i&searchword=$searchword&select_key=$select_key&pu=$pu'>$i</a>
									");
                                }
                            }
                            if($end_page < $total_page){
                                echo ("
								<a href='item_list.php?category_num=$tmp_category_num&page=$next_start_page&searchword=$searchword&select_key=$select_key&pu=$pu'>
								&nbsp;▷
								</a>
								");
                            }
                            else{
                                echo ("
								&nbsp;▷
								");
                            }
                            if($page == $total_page){
                                echo ("
								끝
								");
                            }
                            else{
                                echo ("
								<a href='item_list.php?category_num=$tmp_category_num&page=$total_page&searchword=$searchword&select_key=$select_key&pu=$pu'>끝</a>
								");
                            }
                            ?>
							</span>
                                        </td>
                                        <td width="50%" bgcolor="#FFFFFF" height="0" align="center">
                                            <select name="select_key">
                                                <option value="item_name" <?if($select_key == "item_name") echo " selected";?>>상품명</option>
                                                <option value="opt" <?if($select_key == "opt") echo " selected";?>>세부 규격 및 상품코드</option>
                                                <option value="item_code" <?if($select_key == "item_code") echo " selected";?>>대표 상품코드</option>
                                                <option value="item_kyukyuk" <?if($select_key == "item_kyukyuk") echo " selected";?>>대표 상품규격</option>
                                            </select>
                                            <input name="searchword" value='<?=$searchword?>' size="15" style="BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid">
                                            <input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="검색">
                                            <input onclick="location.href='<?=$PHP_SELF?>?pu=<?=$pu?>&category_num=<?=$category_num?>'" class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="해제">
                                        </td>
                                    </form>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <form name='list' action='item_list.php' method='post' onsubmit='return checkform1(this)'>
                        <input type='hidden' name='flag' value='<?=$flag?>'>
                        <input type='hidden' name='pu' value='<?=$pu?>'>
                        <input type='hidden' name='category_num' value='<?=$category_num?>'>
                        <input type='hidden' name='prevno' value='<?=$tmp_category_num?>'>
                        <input type='hidden' name='searchword' value='<?=$searchword?>'>
                        <input type='hidden' name='select_key' value='<?=$select_key?>'>

                        <tr>
                            <td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
                                <table border="0" width="100%">
                                    <tr>
                                        <td width="100%" bgcolor="#999999">
                                            <table border="0" width="100%" cellspacing="1" cellpadding="3">
                                                <tr>
                                                    <td width="100%" bgcolor="#8FBECD" colspan="8">
                                                        <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td width="50%">&nbsp;
                                                                    <b><span class="dd">현재 카테고리에 등록된 상품 리스트</span></b>
                                                                </td>
                                                                <td width="50%"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr bgcolor="#C8DFEC" align="center">
                                                    <td width="8%">선택</td>
                                                    <td width="8%">번호</td>
                                                    <td width="10%">순서</td>
                                                    <td width="48%">상품명</td>
                                                    <!-- <td width="20%">입점몰명</td> -->
                                                    <td width="8%">배 송</td>
                                                    <td width="13%">등록일</td>
                                                    <td width="5%">삭제</td>
                                                </tr>
                                                <?
                                                for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {
                                                    if ($i >= $numRows) break;
                                                    mysql_data_seek($dbresult, $i);
                                                    $row = mysql_fetch_array($dbresult);
                                                    $item_no = $row[item_no];

                                                    $SQL1 = "select * from $ItemTable where item_no='$item_no'";
                                                    $dbresult1 = mysql_query($SQL1, $dbconn);
                                                    $row1 = mysql_fetch_array($dbresult1);

                                                    $category_num_tmp = $row1[category_num];
                                                    $mart_id = $row1[mart_id];
                                                    $item_order_old = $row1[item_order];
                                                    $item_name = $row1[item_name];
                                                    $reg_date = $row1[reg_date];
                                                    $read_num = $row1[read_num];
                                                    $if_hide = $row1[if_hide];
                                                    $provider_id = $row1[provider_id];
                                                    $jaego_use = $row1[jaego_use];
                                                    $jaego = $row1[jaego];

                                                    if( $provider_id ){
                                                        $sql5 = "select * from $MemberTable where username='$provider_id'";
                                                        $res5 = mysql_query( $sql5, $dbconn );
                                                        $row5 = mysql_fetch_array( $res5 );
                                                        $membername = $row5[name];
                                                    }else{
                                                        $membername = '없음';
                                                    }

                                                    //if($Mall_Admin_ID == $mart_id) {
                                                    $gnt_img = "";
                                                    if($if_hide == '1') $hide_str = "<img src='../images/hide.gif'>";
                                                    else $hide_str = "";
                                                    /*}else {
                                                        $gnt_img = "<img src='../images/gnt.gif' height='12' width='25'>";
                                                        $hide_str = "";
                                                    }*/


                                                    if($jaego_use == 1 && $jaego == 0){
                                                        $icon_str = "<img src='../images/soldout_icon_s.gif' width='25' height='12'>";
                                                    }else{
                                                        $icon_str = "";
                                                    }

                                                    $j = $numRows - $i;

//	if( $pu == "2" ){
                                                    //$link_str = "<a onclick=\"window.open('item_edit_old.php?item_no=$item_no', 'mainpage','toolbar=no,width=700,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');\" style='cursor:hand'><b>$item_name</b></a> $icon_str $hide_str";
//	}else{
                                                    $link_str = "<a href='item_edit.php?item_no=$item_no&prevno=$prevno&prevno2=$prevno2&category_num=$category_num_tmp&page=$page&searchword=$searchword&select_key=$select_key&pu=$pu'><b>$item_name</b></a> $icon_str $hide_str";
//	}
                                                    ?>
                                                    <tr bgcolor='#FFFFFF' align='center'>
                                                        <input type='hidden' name='itemno[]' value='<?=$item_no?>'>
                                                        <td><input type='checkbox' name='checkSel[]' value='<?=$item_no?>!<?=$mart_id?>'></td>
                                                        <td><?=$j?></td>
                                                        <td><input type='text' name='item_order[]' value='<?=$item_order_old?>' size='3' style='BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid;'></td>
                                                        <td align='left'><?=$link_str?></td>
                                                        <!-- <td><?=$membername?></td> -->
                                                        <td><?=$row1[fee]?></td>
                                                        <td><?=$reg_date?></td>
                                                        <td>
                                                            <input class='aa' onClick="really2('<?=$item_no?>', '<?=$tmp_category_num?>', '<?=$mart_id?>')" style='BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px' type='button' value='삭제'>
                                                        </td>
                                                    </tr>
                                                    <?
                                                }
                                                ?>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td vAlign="top" width="100%" bgColor="#ffffff" align="center">
                                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="100%" height="10"></td>
                                    </tr>
                                    <tr>
                                        <td width="100%" bgcolor="#7BBEBD">
                                            <table border="0" width="100%" cellspacing="1" cellpadding="3">
                                                <tr>
                                                    <td width="100%" bgcolor="#E9F5F5" height="30">
                                                        <table border="0" width="100%">
                                                            <tr>
                                                                <td>
                                                                    <input onclick="javascript:toggle(1)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="전체선택">
                                                                    <input onclick="javascript:toggle(0)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="선택해제">&nbsp;
                                                                    &nbsp;
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <font color="#3D918A">선택한 상품을 </font>
                                                                    <select name="target_category" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
                                                                        <?=Make_select_category($mart_id, $tmp_category_num)?>
                                                                    </select><br>
                                                                    <input onclick="copy_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="복사">
                                                                    <input onclick="move_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="이동">
                                                                    <input onclick="del_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="삭제">
                                                                    <input  onclick="to_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="순서변경">
                                                                    <input onclick="hide_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="숨김">
                                                                    <input onclick="see_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="출력">
                                                                    <input onclick="sold_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="품절">
                                                                    <input onclick="sale_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="품절해제">
                                                                    <input onclick="free_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="무료배송">
                                                                    <input onclick="fee_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="착불">
                                                                    <input onclick="prefee_item(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="선불"><br>
                                                                    <input onclick="location.href='./item_excel_all.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="전체엑셀다운로드">
                                                                    <input onclick="choiceExcel(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="선택된 엑셀다운로드">
                                                                    <input onclick="excelUpdate()" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="엑셀업데이트"><br>
                                                                    <input onclick="location.href='./option_excel_all.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="전체 옵션 엑셀다운로드">
                                                                    <input onclick="choiceExcel2(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="옵션 엑셀다운로드">
                                                                    <input onclick="excelUpdate2()" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="옵션엑셀업데이트">
                                                                    <script language="javascript">
                                                                        function excelUpdate(){
                                                                            window.open("./item_excel_update.php","excel","width=800,height=600,scrollbars=no");
                                                                        }
                                                                        function excelUpdate2(){
                                                                            window.open("./option_excel_update.php","excel","width=800,height=600,scrollbars=no");
                                                                        }
                                                                        function choiceExcel(f){
                                                                            if(!checkitems())
                                                                            {
                                                                                return false;
                                                                            }

                                                                            f.action="./item_excel.php";
                                                                            f.submit();
                                                                            return true;
                                                                        }
                                                                    </script>
                                                                    <script language="javascript">
                                                                        function excelUpdate(){
                                                                            window.open("./item_excel_update.php","excel","width=800,height=600,scrollbars=no");
                                                                        }

                                                                        function choiceExcel2(f){
                                                                            if(!checkitems())
                                                                            {
                                                                                return false;
                                                                            }

                                                                            f.action="./option_excel.php";
                                                                            f.submit();
                                                                            return true;
                                                                        }
                                                                    </script>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </form>


                    <tr align="center">
                        <td width="100%" bgcolor="#FFFFFF" valign="top"></td>
                    </tr>
                </table>
                <br>
                <!--내용 END~~-->
            </td>
        </tr>
    </table>
    </body>
    </html>
    <?
}
//========================================================================================
//================== 카테고리를 추가함 ===================================================
if($flag == "addcategory"){
    $SQL = "select max(category_num), count(*) from $CategoryTable";
    $dbresult = mysql_query($SQL, $dbconn);
    if ($dbresult == false) echo "쿼리 실행 실패!";
    if (mysql_result($dbresult,0,1) > 0)
        $maxCategory_num = mysql_result($dbresult, 0, 0);
    else
        $maxCategory_num = 0;

    $SQL = "select max(cat_order), count(*) from $CategoryTable where mart_id='$mart_id'";
    $dbresult = mysql_query($SQL, $dbconn);
    if ($dbresult == false) echo "쿼리 실행 실패!";
    if (mysql_result($dbresult,0,1) > 0)
        $maxOrder = mysql_result($dbresult, 0, 0);
    else
        $maxOrder = 0;

    $category_date = date("Y-m-d H:i:s");

    if (isset($prevno) == false) $prevno = 0;

    $SQL = "insert into $CategoryTable " .
        "(mart_id, category_num, prevno, category_name, category_date, category_desc, cat_order) values " .
        "('$mart_id', $maxCategory_num+1, $prevno, '$category_name', '$category_date', '$category_desc', $maxOrder+1)";

    $dbresult = mysql_query($SQL, $dbconn);

    echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================
//================== 상품 순서를 변경함 ==================================================
if($flag == "to_item"){
    for($i=0; $i<count($itemno); $i++) {
        $item_no = $itemno[$i];
        //$item_order = "$item_order[$i]";

        $SQL = "update $ItemTable set item_order='$item_order[$i]' where item_no = '$item_no' and mart_id='$mart_id'";;
        $dbresult = mysql_query($SQL, $dbconn);
    }
    echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================
//================== 상품을 숨김 =========================================================
if($flag == "hide_item"){
    for($i=0; $i<count($checkSel); $i++) {
        $checkSels = explode("!", $checkSel[$i]);
        $item_no = $checkSels[0];
        $mart_id = $checkSels[1];

        $SQL = "update $ItemTable set if_hide = '1' where item_no = '$item_no' and mart_id='$mart_id'";
        $dbresult = mysql_query($SQL, $dbconn);
    }
    echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================
//================== 상품을 출력 =========================================================
if($flag == "see_item"){
    for($i=0; $i<count($checkSel); $i++) {
        $checkSels = explode("!", $checkSel[$i]);
        $item_no = $checkSels[0];
        $mart_id = $checkSels[1];

        $SQL = "update $ItemTable set if_hide = '0' where item_no = '$item_no' and mart_id='$mart_id'";
        $dbresult = mysql_query($SQL, $dbconn);
    }
    echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================
//================== 상품 품절 ===========================================================
if($flag == "sold_item"){
    for($i=0; $i<count($checkSel); $i++) {
        $checkSels = explode("!", $checkSel[$i]);
        $item_no = $checkSels[0];
        $mart_id = $checkSels[1];

        $SQL = "update $ItemTable set jaego_use='1', jaego='0' where item_no = '$item_no' and mart_id='$mart_id'";
        $dbresult = mysql_query($SQL, $dbconn);
    }
    echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================
//================== 상품 품절 해제 ======================================================
if($flag == "sale_item"){
    for($i=0; $i<count($checkSel); $i++) {
        $checkSels = explode("!", $checkSel[$i]);
        $item_no = $checkSels[0];
        $mart_id = $checkSels[1];

        $SQL = "update $ItemTable set jaego_use='1', jaego='100' where item_no = '$item_no' and mart_id='$mart_id'";
        $dbresult = mysql_query($SQL, $dbconn);
    }
    echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================
//================== 무료 배송 ===========================================================
if($flag == "free_item"){
    for($i=0; $i<count($checkSel); $i++) {
        $checkSels = explode("!", $checkSel[$i]);
        $item_no = $checkSels[0];
        $mart_id = $checkSels[1];

        $SQL = "update $ItemTable set fee='무료배송' where item_no = '$item_no' and mart_id='$mart_id'";
        $dbresult = mysql_query($SQL, $dbconn);
    }
    echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================
//================== 착불 배송 ===========================================================
if($flag == "fee_item"){
    for($i=0; $i<count($checkSel); $i++) {
        $checkSels = explode("!", $checkSel[$i]);
        $item_no = $checkSels[0];
        $mart_id = $checkSels[1];

        $SQL = "update $ItemTable set fee='착불' where item_no = '$item_no' and mart_id='$mart_id'";
        $dbresult = mysql_query($SQL, $dbconn);
    }
    echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================

//========================================================================================
//================== 선불 배송 ===========================================================
if($flag == "prefee_item"){
    for($i=0; $i<count($checkSel); $i++) {
        $checkSels = explode("!", $checkSel[$i]);
        $item_no = $checkSels[0];
        $mart_id = $checkSels[1];

        $SQL = "update $ItemTable set fee='' where item_no = '$item_no' and mart_id='$mart_id'";
        $dbresult = mysql_query($SQL, $dbconn);
    }
    echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================

//================== 상품 카테고리를 이동함 ==============================================
if($flag == "move_item"){
    $SQL = "select prevno, category_degree from $CategoryTable where category_num='$target_category' and mart_id='$mart_id'";
    $dbresult = mysql_query($SQL, $dbconn);
    $target_prevno = mysql_result($dbresult,0,0);
    $target_degree = mysql_result($dbresult,0,1);

    //echo "$SQL<br>";

    if($target_degree == 3)												// 4차일 때
    {
        $target_thirdno = $target_prevno;					// 3차
        $SQL = "select prevno from $CategoryTable where category_num='$target_thirdno' and mart_id='$mart_id'";
        $dbresult = mysql_query($SQL, $dbconn);
        $target_prevno = mysql_result($dbresult,0,0);		// 2차카테고리
        $SQL = "select prevno from $CategoryTable where category_num='$target_prevno' and mart_id='$mart_id'";
        $dbresult = mysql_query($SQL, $dbconn);
        $target_firstno = mysql_result($dbresult,0,0);	// 1차카테고리
    }
    elseif($target_degree == 2)									// 3차일 때
    {
        $SQL = "select prevno from $CategoryTable where category_num='$target_prevno' and mart_id='$mart_id'";
        $dbresult = mysql_query($SQL, $dbconn);
        $target_firstno = mysql_result($dbresult,0,0);		// 1차카테고리
        $target_thirdno = $target_category;
    }elseif($target_degree == 1)								// 2차일 때
    {
        $target_firstno = $target_prevno;
        $target_prevno = $target_category;
    }else												// 1차일 때
    {
        $target_firstno = $target_category;
    }

    for($i=0; $i<count($checkSel); $i++) {
        $checkSels = explode("!", $checkSel[$i]);
        $item_no = $checkSels[0];
        $mart_id = $checkSels[1];

//		if($Mall_Admin_ID == $mart_id){ //내상품이면
        $SQL = "update $ItemTable set firstno = '$target_firstno' , prevno = '$target_prevno', thirdno='$target_thirdno', category_num = '$target_category' where item_no = '$item_no' and mart_id='$mart_id'";

        //echo "$SQL<br>";
        //exit;

        $dbresult = mysql_query($SQL, $dbconn);

        //============== 관리자일경우 하위몰 상품 이동 ======================//
        /*if($Mall_Admin_ID == $mart_id){
            $SQL1 = "select * from $MemberTable where perms = '2'";  //회원사 목록
            $dbresult1 = mysql_query($SQL1, $dbconn);
            while($ary1 = mysql_fetch_array($dbresult1)){
                $SQL = "select * from $CategoryTable where mart_id='$ary1[username]' and gnt_category_num = $target_category";
                $dbresult = mysql_query($SQL, $dbconn);
                $numRows = mysql_num_rows($dbresult);
                if($numRows >= 0){
                    mysql_data_seek($dbresult, 0);
                    $ary = mysql_fetch_array($dbresult);
                    $firstno_tmp = $ary[firstno];
                    $prevno_tmp = $ary[prevno];
                    $category_num_tmp = $ary[category_num];
                }
                $SQL = "update $Gnt_ItemTable set firstno = '$firstno_tmp' , prevno = '$prevno_tmp' , category_num = '$category_num_tmp' where item_no = '$item_no' and seller_id='$ary1[username]'";

                $dbresult = mysql_query($SQL, $dbconn);
            }
        }*/
        //============== 관리자일경우 하위몰 상품 이동 ======================//
        /*	}else{ //gnt 상품이면
                //$SQL = "update $Gnt_ItemTable set prevno = '$target_prevno' , category_num = '$target_category' where item_no = '$item_no' and seller_id='$Mall_Admin_ID'";
                //act_href("","공급받은 상품은 이동 할수없습니다.","","back",$charset='euc-kr');
                //exit;
            }*/
    }
    echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
//========================================================================================
//================== 카테고리를 복사함 ===================================================
if($flag == "copy_item"){
    for($j=0; $j<count($checkSel); $j++) {
        $checkSels = explode("!", $checkSel[$j]);
        $item_no = $checkSels[0];
        $mart_id = $checkSels[1];

//		if($Mall_Admin_ID == $mart_id){ // 내상품이면

        $SQL = "select * from $ItemTable where item_no='$item_no' and mart_id='$mart_id' order by item_no Desc";
        //상품데이타 가져오기
        $dbresult = mysql_query($SQL, $dbconn);
        if ($dbresult == false) echo "쿼리 실행 실패!";
        $numRows = mysql_num_rows($dbresult);
        for ($i=0; $i < $numRows; $i++) {
            mysql_data_seek($dbresult, $i);
            $ary = mysql_fetch_array($dbresult);
            $firstno = $ary["firstno"];
            $item_no = $ary["item_no"];
            $mart_id = $ary["mart_id"];
            $provider_id = $ary["provider_id"];
            $item_name = $ary["item_name"];
            $price = $ary["price"];
            $z_price = $ary["z_price"];
            $bonus = $ary["bonus"];
            $use_bonus = $ary["use_bonus"];
            $jaego = $ary["jaego"];
            $img = $ary["img"];
            $opt = $ary["opt"];
            $opt2 = $ary["opt2"];
            $opt3 = $ary["opt3"];
            $opt4 = $ary["opt4"];
            $doctype = $ary["doctype"];
            $short_explain = $ary["short_explain"];
            $item_explain = $ary["item_explain"];
            $reg_date = $ary["reg_date"];
            $item_company = $ary["item_company"];
            $read_num = $ary["read_num"];
            $item_code = $ary["item_code"];
            $icon_no = $ary["icon_no"];
            $use_opt1 = $ary["use_opt1"];
            $use_opt23 = $ary["use_opt23"];
            $item_order = $ary["item_order"];
            $img_big = $ary["img_big"];
            $img_big2 = $ary["img_big2"];
            $img_big3 = $ary["img_big3"];
            $img_big4 = $ary["img_big4"];
            $img_big5 = $ary["img_big5"];
            $jaego_use = $ary["jaego_use"];
            $if_strike = $ary["if_strike"];
            $if_provide_item = $ary["if_provide_item"];
            $provide_price = $ary["provide_price"];
            $img_sml = $ary["img_sml"];
            $flash_big_width = $ary["flash_big_width"];
            $flash_big_height = $ary["flash_big_height"];
            $if_hide = $ary["if_hide"];
            $img_high = $ary["img_high"];
            $member_price = $ary["member_price"];
            $fee = $ary["fee"];
            $min_buy = $ary["min_buy"];

            //갤러리에디터의 gm파일들도 복사하기
            preg_match_all("/src=\"([^>]*)\"/is", $item_explain, $output);
            for($k=0;$k<100;$k++){

                $output_1 = str_replace('"',"",$output[0][$k]);
                $output_2 = explode("/",$output_1);
                $output_3 = "../../smarteditor/upload/".$output_2[6];
                $output_3_c = "../../smarteditor/upload/".$output_2[6].".jpg";

                if($output_2[6]){
                    if(file_exists($output_3)){
                        copy ("$output_3","$output_3_c");	//업로드 파일 저장
                        $item_explain = str_replace($output_2[6],$output_2[6].".jpg",$item_explain);
                    }
                }
            }

            $SQL1 = "select max(item_no), count(*) from $ItemTable";
            $dbresult1 = mysql_query($SQL1, $dbconn);
            if ($dbresult1 == false) echo "쿼리 실행 실패!";
            if (mysql_result($dbresult1,0,1) > 0)
                $maxItem_no = mysql_result($dbresult1, 0, 0);
            else
                $maxItem_no = 0;

            $maxItem_no_1 = $maxItem_no+1;
            ####################img_big##########################
            if($img_big != ""){
                if(!file_exists("$Co_img_UP$mart_id")){
                    mkdir ("$Co_img_UP$mart_id", 0755 );
                }
                $img_big_head = "item_big_".$item_no."_";
                $img_big_ori = str_replace($img_big_head,'',$img_big);
                $img_big_new = "item_big_".$maxItem_no_1."_".$img_big_ori;

                if(file_exists("$Co_img_UP$mart_id/$img_big"))
                    copy ("$Co_img_UP$mart_id/$img_big","$Co_img_UP$mart_id/$img_big_new" );	//업로드 파일 저장
            }
            else $img_big_new = '';

            if($img_big2 != ""){
                if(!file_exists("$Co_img_UP$mart_id")){
                    mkdir ("$Co_img_UP$mart_id", 0755 );
                }
                $img_big2_head = "item_big_".$item_no."_";
                $img_big2_ori = str_replace($img_big2_head,'',$img_big2);
                $img_big2_new = "item_big_".$maxItem_no_1."_".$img_big2_ori;

                if(file_exists("$Co_img_UP$mart_id/$img_big2"))
                    copy ("$Co_img_UP$mart_id/$img_big2","$Co_img_UP$mart_id/$img_big2_new" );	//업로드 파일 저장
            }
            else $img_big2_new = '';


            if($img_big3 != ""){
                if(!file_exists("$Co_img_UP$mart_id")){
                    mkdir ("$Co_img_UP$mart_id", 0755 );
                }
                $img_big3_head = "item_big_".$item_no."_";
                $img_big3_ori = str_replace($img_big3_head,'',$img_big3);
                $img_big3_new = "item_big_".$maxItem_no_1."_".$img_big3_ori;

                if(file_exists("$Co_img_UP$mart_id/$img_big3"))
                    copy ("$Co_img_UP$mart_id/$img_big3","$Co_img_UP$mart_id/$img_big3_new" );	//업로드 파일 저장
            }
            else $img_big3_new = '';


            if($img_big4 != ""){
                if(!file_exists("$Co_img_UP$mart_id")){
                    mkdir ("$Co_img_UP$mart_id", 0755 );
                }
                $img_big4_head = "item_big_".$item_no."_";
                $img_big4_ori = str_replace($img_big4_head,'',$img_big4);
                $img_big4_new = "item_big_".$maxItem_no_1."_".$img_big4_ori;

                if(file_exists("$Co_img_UP$mart_id/$img_big4"))
                    copy ("$Co_img_UP$mart_id/$img_big4","$Co_img_UP$mart_id/$img_big4_new" );	//업로드 파일 저장
            }
            else $img_big4_new = '';


            if($img_big5 != ""){
                if(!file_exists("$Co_img_UP$mart_id")){
                    mkdir ("$Co_img_UP$mart_id", 0755 );
                }
                $img_big5_head = "item_big_".$item_no."_";
                $img_big5_ori = str_replace($img_big5_head,'',$img_big5);
                $img_big5_new = "item_big_".$maxItem_no_1."_".$img_big5_ori;

                if(file_exists("$Co_img_UP$mart_id/$img_big5"))
                    copy ("$Co_img_UP$mart_id/$img_big5","$Co_img_UP$mart_id/$img_big5_new" );	//업로드 파일 저장
            }
            else $img_big5_new = '';

            #################img_big_end###########################

            if($img_sml != ""){
                if(!file_exists("$Co_img_UP$mart_id")){
                    mkdir ("$Co_img_UP$mart_id", 0755 );
                }
                $img_sml_head = "item_sml_".$item_no."_";
                $img_sml_ori = str_replace($img_sml_head,'',$img_sml);
                $img_sml_new = "item_sml_".$maxItem_no_1."_".$img_sml_ori;

                if(file_exists("$Co_img_UP$mart_id/$img_sml"))
                    copy ("$Co_img_UP$mart_id/$img_sml","$Co_img_UP$mart_id/$img_sml_new" );	//업로드 파일 저장
            }
            else $img_sml_new = '';


            if($img != ""){
                if(!file_exists("$Co_img_UP$mart_id")){
                    mkdir ("$Co_img_UP$mart_id", 0755 );
                }
                $img_head = "item_".$item_no."_";
                $img_ori = str_replace($img_head,'',$img);
                $img_new = "item_".$maxItem_no_1."_".$img_ori;

                if(file_exists("$Co_img_UP$mart_id/$img"))
                    copy ("$Co_img_UP$mart_id/$img","$Co_img_UP$mart_id/$img_new" );	//업로드 파일 저장
            }
            else $img_new = '';

            if($img_high != ""){
                if(!file_exists("$Co_img_UP$mart_id")){
                    mkdir ("$Co_img_UP$mart_id", 0755 );
                }
                $img_high_head = "item_high_".$item_no."_";
                $img_high_ori = str_replace($img_high_head,'',$img_high);
                $img_high_new = "item_high_".$maxItem_no_1."_".$img_high_ori;

                if(file_exists("$Co_img_UP$mart_id/$img_high"))
                    copy ("$Co_img_UP$mart_id/$img_high","$Co_img_UP$mart_id/$img_high_new" );	//업로드 파일 저장
            }
            else $img_high_new = '';

            $SQL = "select prevno, category_degree from $CategoryTable where category_num='$target_category' and mart_id='$mart_id'";
            $dbresult = mysql_query($SQL, $dbconn);
            $target_prevno = mysql_result($dbresult,0,0);
            $target_degree = mysql_result($dbresult,0,1);


            if($target_degree == 3)												// 4차일 때
            {
                $target_thirdno = $target_prevno;					// 3차
                $SQL = "select prevno from $CategoryTable where category_num='$target_thirdno' and mart_id='$mart_id'";
                $dbresult = mysql_query($SQL, $dbconn);
                $target_prevno = mysql_result($dbresult,0,0);		// 2차카테고리
                $SQL = "select prevno from $CategoryTable where category_num='$target_prevno' and mart_id='$mart_id'";
                $dbresult = mysql_query($SQL, $dbconn);
                $target_firstno = mysql_result($dbresult,0,0);	// 1차카테고리
            }
            elseif($target_degree == 2)									// 3차일 때
            {
                $SQL = "select prevno from $CategoryTable where category_num='$target_prevno' and mart_id='$mart_id'";
                $dbresult = mysql_query($SQL, $dbconn);
                $target_firstno = mysql_result($dbresult,0,0);		// 1차카테고리
                $target_thirdno = $target_category;
            }elseif($target_degree == 1)								// 2차일 때
            {
                $target_firstno = $target_prevno;
                $target_prevno = $target_category;
            }else												// 1차일 때
            {
                $target_firstno = $target_category;
            }


            if($use_opt1 == '') $use_opt1 = 'f';
            if($use_opt23 == '') $use_opt23 = 'f';

            $SQL1 = "insert into $ItemTable (item_no, mart_id, provider_id, firstno, prevno, thirdno, category_num, item_name, price, z_price, bonus, 
				use_bonus, jaego, img, img_big, img_big2, img_big3, img_big4, img_big5, opt,opt2,opt3,opt4, doctype, item_explain, short_explain, reg_date, item_company, read_num, item_code, 
				icon_no, use_opt1, use_opt23, item_order, jaego_use, if_strike, if_provide_item, provide_price, img_sml, 
				flash_big_width, flash_big_height, if_hide, img_high, member_price, fee, min_buy) 
				values ('$maxItem_no_1', '$mart_id', '$provider_id', '$target_firstno', '$target_prevno', '$target_thirdno', '$target_category', '$item_name', '$price', '$z_price', '$bonus', 
				'$use_bonus','$jaego','$img_new','$img_big_new','$img_big2_new','$img_big3_new','$img_big4_new','$img_big5_new','$opt','$opt2','$opt3','$opt4','$doctype','$item_explain','$short_explain','$reg_date', '$item_company', 0, '$item_code',
				'$icon_no','$use_opt1','$use_opt23','9999','$jaego_use','$if_strike','$if_provide_item','$provide_price',
				'$img_sml_new','$flash_big_width','$flash_big_height','$if_hide', '$img_high_new','$member_price', '$fee', '$min_buy')";




            $dbresult1 = mysql_query($SQL1, $dbconn);
            //옵션 복사
            $sql="select * from $OptionTable where item_no='$item_no'";
            $result2=mysql_query($sql);
            while($rs=mysql_fetch_array($result2)){
                $sql="insert into $OptionTable(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$maxItem_no_1','$rs[opt_name]','$rs[opt_price]','$rs[opt_ea]','$rs[opt_order]','$rs[opt_code]')";
                $result=mysql_query($sql);
            }
            $sql="select * from $OptionTable2 where item_no='$item_no'";
            $result3=mysql_query($sql);
            while($rs=mysql_fetch_array($result3)){
                $sql="insert into $OptionTable2(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$maxItem_no_1','$rs[opt_name]','$rs[opt_price]','$rs[opt_ea]','$rs[opt_order]','$rs[opt_code]')";
                $result=mysql_query($sql);
            }
            $sql="select * from $OptionTable3 where item_no='$item_no'";
            $result4=mysql_query($sql);
            while($rs=mysql_fetch_array($result4)){
                $sql="insert into $OptionTable3(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$maxItem_no_1','$rs[opt_name]','$rs[opt_price]','$rs[opt_ea]','$rs[opt_order]','$rs[opt_code]')";
                $result=mysql_query($sql);
            }
            $sql="select * from $OptionTable4 where item_no='$item_no'";
            $result5=mysql_query($sql);
            while($rs=mysql_fetch_array($result5)){
                $sql="insert into $OptionTable4(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$maxItem_no_1','$rs[opt_name]','$rs[opt_price]','$rs[opt_ea]','$rs[opt_order]','$rs[opt_code]')";
                $result=mysql_query($sql);
            }

        }

        /*}
        else { //gnt로 가져온 상품이면
        }*/
    }
    echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$prevno&searchword=$searchword&select_key=$select_key&page=$page&pu=$pu'>";
}
?>
<?
mysql_close($dbconn);
?>