<?
/******************************************************************
 ★ 파일설명 ★ 
목록상단

 ★ 스킨 제작을 위한 변수 설명 ★ 

<?=$width?> 					테이블의 넓이
<?=$skin_board_url?>	스킨 URL
<?=$site_url?>				사이트 URL
<?=$bbs_id?>					게시판 아이디

<?=$total_doc_count?>	총 게시물수
<?=$page?>						현재페이지
<?=$total_page?>			총 페이지수

<?=$show_category_begin?>카테고리<?=$show_category_end?>
<?=$u_category?>			카테고리 선택 URL
<?=$category_list_option?>	카테고리 option 리스트
<?=$show_chk_begin?>카트사용(체크박스)<?=$show_chk_end?>
<?=$show_vote_yes_begin?>추천수<?=$show_vote_yes_end?>
<?=$show_vote_no_begin?>비추천수<?=$show_vote_no_end?>

******************************************************************/
$l_cols = 0;
?>
<?
$qry="SELECT * FROM rg_goods_category";
$rs=mysql_query($qry);
$tmp = mysql_fetch_array($rs);


$qry="SELECT * FROM rg_goods_category where cat_num='$ss[fc]'";
$rs=query($qry,$dbcon);
$tmp = mysql_fetch_array($rs);


$qry2 = "select * from reservation_com where value11='$tmp[cat_name]'";
$rs2=query($qry2,$dbcon);
$tmp2 = mysql_fetch_array($rs2);

echo "<font size=3><b>$tmp2[value1] 상품리스트</b></font>";
?>
<table width="<?=$width?>" cellpadding=0 cellspacing=0 border=0>
<tr>
<!--
<form name=fcategory>
	<td width=50%> 
    <?=$show_category_begin?>
    <IMG src="<?=$skin_board_url?>images/category.gif" border=0> <select name=ca_id onchange="location='<?=$u_category?>'+this.value;" class=select><option value=''>전체</option><?=$category_list_option?></select>
    <?=$show_category_end?>
    </td>
</form>
-->
	<td width=50% align="right" class="bbs"><?=$page?>/<?=$total_page?>, 총 상품갯수 : <?=$total_doc_count?></td>
</tr>
</table>


<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>" border=0>
<!--<TR>
	<TD bgcolor=#80a8de height=6></TD>
</TR>-->
<TR> 
	<TD>
	<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 style="table-layout:fixed">
	<form name=form_list method='post' action=''>
	<input type=hidden name=bbs_id value='<?=$bbs_id?>'>
	<input type=hidden name=page value='<?=$page?>'>