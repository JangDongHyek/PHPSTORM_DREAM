<?
// get 변수를 설정
$_get_str = $p_str;	

//================== 현재 카테고리 정보를 불러옴 ==========================================
$sql = "select * from $CategoryTable where category_num='$category_num' and if_hide='0' and mart_id='$mart_id'";
$res = mysql_query($sql, $dbconn);
$row = mysql_fetch_array( $res );
$category_prevno = $row[prevno];
$category_name = $row[category_name];
$category_degree = $row[category_degree]+1;
$category_left = $row["category_left"];

$arr_upperclass = make_upperclass($category_num, $category_degree);
$arr_d_subclass = make_d_subclass($category_num);
//if(!count($arr_d_subclass))
	//$arr_d_subclass = make_d_subclass($category_prevno);

$_field = array(1=>"firstno", "prevno", "thirdno", "category_num");

// query 설정
if($category_num){
	$qstr .= "AND `{$_field[$category_degree]}`='$category_num' ";
}
$dbqry="
	SELECT count(item_no) as row_count 
	FROM `$ItemTable`
	WHERE if_hide='0' and mart_id='$mart_id' $qstr
	$ostr
";

$rs = mysql_query($dbqry,$dbconn);
fetch($rs, array("row_count"));
$page_info=rg_navigation($page,$row_count,32,10);
?>
<?
if(!$category_num)
	$category_name = "전체";
?>
<style>
.cate_cg a{color:#895a41; font-size:13px;}
.cate_cg a:hover{color:#000}
</style>
<div style="height:20px"></div>
<div style="border:1px solid #e4e4e4; border-radius:6px; background:#fff; padding:18px;">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
			<td width="50%"><img src="../images/product_info_title_icon.gif" align="absmiddle" /> <span class="category_title"><?=$category_name?></span>(총 <?=$page_info[total_rows]?>건)</td>
			<td width="50%" align="right">
				<img src="../images/home_icon.gif" width="10" height="10" align="absmiddle">
				<span class="navi">
				<!--------------- 카테고리 네비게이션----------------->
				<?=make_upperclass_str($arr_upperclass);?>
				<!--------------- 카테고리 네비게이션----------------->
				</span>
			</td>
		  </tr>
          <tr>
            <td>&nbsp;</td></tr>
		  <tr>
			<td bgcolor="#FFFFFF" style="padding-left:5px;padding-right:5px; border-top:1px solid #ebebeb; padding-top:10px;" colspan="2">
			<!-------------- 서브카테고리 리스트 --------------->
			<div class="cate_cg"><? 
				for($i=0, $d_subclass_count = count($arr_d_subclass); $i<$d_subclass_count; $i++)
				{
					// 2017-04-12 category_num1 값 추가
					echo "<a href='product_list.html?$_get_str&category_num={$arr_d_subclass[$i]['category_num']}&category_num1={$arr_d_subclass[$i]['category_num']}'>{$arr_d_subclass[$i]['category_name']} ({$arr_d_subclass[$i]['item_count']})</a>";
					if($i<$d_subclass_count-1)
						echo " | ";
				}
			?></div>
			<!-------------- 서브카테고리 리스트 --------------->                    
			</td>
		  </tr>
	  </table>
</div>