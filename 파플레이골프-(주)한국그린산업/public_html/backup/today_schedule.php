<?
$__CONTENTS_MAX = "";
?>
<script>
function top_round(w,c) {
var top_html;
top_html="<table cellpadding=0 cellspacing=0 border=0 width="+w+">";
top_html+="<tr height=1><td rowspan=4 width=1></td><td rowspan=3 width=1></td>";
top_html+="<td rowspan=2 width=1></td><td width=2></td><td bgcolor="+c+"></td>";
top_html+="<td width=2></td><td rowspan=2 width=1></td><td rowspan=3 width=1></td>";
top_html+="<td rowspan=4 width=1></td></tr><tr height=1><td bgcolor="+c+"></td>";
top_html+="<td bgcolor="+c+"></td><td bgcolor="+c+"></td></tr>";
top_html+="<tr height=1><td bgcolor="+c+"></td><td colspan=3 bgcolor="+c+"></td>";
top_html+="<td bgcolor="+c+"></td></tr><tr height=2><td bgcolor="+c+"></td>";
top_html+="<td colspan=5 bgcolor="+c+"></td><td bgcolor="+c+"></td></tr></table>";
document.write(top_html);
}

function bottom_round(w,c) {
var bottom_html;
bottom_html="<table cellpadding=0 cellspacing=0 border=0 width="+w+">";
bottom_html+="<tr height=2><td rowspan=4 width=1></td><td width=1 bgcolor="+c+"></td><td width=1 bgcolor="+c+"></td>";
bottom_html+="<td width=2 bgcolor="+c+"></td><td bgcolor="+c+"></td><td width=2 bgcolor="+c+"></td>";
bottom_html+="<td width=1 bgcolor="+c+"></td><td width=1 bgcolor="+c+"></td><td rowspan=4 width=1></td></tr>";
bottom_html+="<tr height=1><td rowspan=3></td><td bgcolor="+c+"></td><td colspan=3 bgcolor="+c+"></td>";
bottom_html+="<td bgcolor="+c+"></td><td rowspan=3></td>  </tr><tr height=1><td rowspan=2></td>";
bottom_html+="<td bgcolor="+c+"></td><td bgcolor="+c+"></td><td bgcolor="+c+"></td><td rowspan=2></td></tr>";
bottom_html+="<tr height=1><td></td><td bgcolor="+c+"></td><td></td></tr></table>";
document.write(bottom_html);
}
</script>
<!--
<script>top_round("100%","C3E288");</script>-->
<TABLE width=100% cellspacing=0 cellpadding=0 border=0  bgcolor=#43822f>
	<tr>
		<td height=42 align="center" style="background-repeat:no-repeat;font-weight:bold; font-size:11px; color:FFFFFF;">오늘(<?=$thisyear?>. <?=$thismonth?>월 <?=$today?>일)의 예약
		</TD>
</TR>
<tr>
		<td align=center valign="top">
		<!--<script>top_round("96%","ffffff");</script>-->
		<TABLE width=96% height=75 cellspacing=0 cellpadding=0 border=0  bgcolor=FFFFFF align=center style="table-layout:fixed">
	<tr>
		<td style='padding:5 5 0 5;word-break:break-all;color:#333333' valign=top>
<?
//디비 연결
$view_date=mktime(0,0,0,$thismonth,$today,$thisyear);
$query="select * from ".$_table_name."_body where rg_ext5='$view_date'";
$result = mysql_query($query, $connect);
$todate = mysql_affected_rows();
if(!$todate) {
	echo "<img src={$skin_board_url}images/today_title.gif border=0 align=absmiddle> 예약된 회원이 없습니다.";
} else {
// 오늘에 자료가 있을 경우 표시
while($data=mysql_fetch_array($result)) {
	$doc_num2=$data[rg_doc_num];
	$rg_title=$data[rg_title];
	$rg_name=$data[rg_name];
	$rg_content=$data[rg_content];
	$sql="select * from rg_".$bbs_id."_category where cat_num='$data[rg_cat_num]'";
	$result2=mysql_query($sql);
	$rs2=mysql_fetch_array($result2);
	$rg_time=$rs2[cat_name];
	$rg_content=strip_tags($rg_content);//미니에디터적용으로 수정
echo "<img src={$skin_board_url}images/today_title.gif border=0 align=absmiddle> <A HREF='./view.php?bbs_id=$bbs_id&doc_num=$doc_num2&year=$year&month=$month'  title=\"$rg_content\">$rg_name [$rg_time]</a>" ;
echo "<br>&nbsp;&nbsp;&nbsp;<span style=\"color:999999\" title=\"$rg_content\">";
	$rg_title = $rg_title;

    if(strpos($rg_title, '-') && strlen($rg_title) == 13
        || !strpos($rg_title, '-') && strlen($rg_title) == 11){
        // 010-2806-**** || 0109321****
        $rg_title = substr_replace($rg_title, '****', -4);
    }

    echo "$rg_title</span><br>";
}
}
?>
		</TD>
</TR>

</TABLE>
<!--
<script>bottom_round("96%","ffffff");</script>-->
		</TD>
</TR>
<TR>
	<TD height="10"></TD>
</TR>
</TABLE>
<!--
<script>bottom_round("100%","C3E288");</script>-->