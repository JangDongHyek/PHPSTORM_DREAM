<?
// 라이브러리 함수 파일 인크루드
	include "lib.php";

// DB 연결
	if(!$connect) $connect=dbConn();

// 멤버정보 구하기
	$member=member_info();

	if(!$member[no]) Error("로그인된 회원만이 사용할수 있습니다","window.close");

// 그룹데이타 읽어오기;;
	$group_data=mysql_fetch_array(mysql_query("select * from $group_table where no='$member[group_no]'"));

// 새쪽지 왔습니다;; 알람 없애기
	mysql_query("update $member_table set new_memo='0' where no='$member[no]'");

// 일주일 넘은 글 삭제;;
	mysql_query("delete from $get_memo_table where (".time()." - reg_date) >= ".$_zbDefaultSetup[memo_limit_time]) or error(mysql_error());

// 선택된 메모 삭제;;;
	if($exec=="del_all") {
		for($i=0;$i<count($del);$i++) {
			mysql_query("delete from $get_memo_table where no='$del[$i]'");
		}
		mysql_close($connect);
		movepage("$PHP_SELF?page=$page");
	}

// 메모삭제
	if($exec=="del") {
		mysql_query("delete from $get_memo_table where no='$no' and member_no='$member[no]'");
		mysql_close($connect);
		movepage("$PHP_SELF?page=$page");
	}

// 선택된 메모가 있을시 데이타 뽑아오기;;
	if($no) {
		$now_data=mysql_fetch_array(mysql_query("select a.subject as subject, a.reg_date as reg_date, a.readed as readed, b.name as name, a.member_from as member_from, a.memo as memo from
		$get_memo_table a, $member_table b where a.member_from=b.no and a.no='$no' and a.member_no='$member[no]'"));
		if($now_data[readed]==1) {
			mysql_query("update $get_memo_table set readed='0' where no='$no' and member_no='$member[no]'");
			$check=mysql_fetch_array(mysql_query("select count(*) from $get_memo_table where readed='1' and member_no='$member[no]'")); 
			mysql_query("update $send_memo_table set readed='0' where reg_date='$now_data[reg_date]' and member_to='$member[no]'");
			if(!$check[0]) mysql_query("update $member_table set new_memo='0' where no='$member[no]'");
		}
	}

// 읽지 않은 쪽지의 갯수 구하기
	$temp1=mysql_fetch_array(mysql_query("select count(*) from $get_memo_table where readed='1' and member_no='$member[no]'"));

	$new_total=$temp1[0];

// 전체 쪽지의 갯수
	$temp2=mysql_fetch_array(mysql_query("select count(*) from $get_memo_table  where member_no='$member[no]'"));

	$total=$temp2[0];

// 페이지 계산
	if(!$page) $page=1;
	$page_num=13;
	$start_num=($page-1)*$page_num; // 페이지 수에 따른 출력시 첫번째가 될 글의 번호 구함

	$total_page=(int)(($total-1)/$page_num)+1; // 전체 페이지 구함

	if($page>$total_page) $page=$total_page; // 페이지가 전체 페이지보다 크면 페이지 번호 바꿈

// 데이타 뽑아오는 부분... 
	$que="select a.no as no, a.subject as subject, a.reg_date as reg_date, a.readed as readed, b.name as name, a.member_from as member_from from $get_memo_table a ,$member_table b where a.member_no='$member[no]' and a.member_from=b.no  order by a.no desc limit $start_num,$page_num";
	$result=mysql_query($que) or Error(mysql_error());

// MySQL 닫기 
	if($connect) mysql_close($connect);
	$query_time=getmicrotime();

// 페이지 계산  $print_page 라는 변수에 저장 
	$print_page="";
	$show_page_num=10;
	$start_page=(int)(($page-1)/$show_page_num)*$show_page_num;
	$i=1;

	if($page>$show_page_num) {
		$prev_page=$start_page;
		$print_page="<a href=$PHP_SELF?id=$id&page=$prev_page&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&page_num=$page_num>[Prev]</a> ";
		$print_page.="<a href=$PHP_SELF?id=$id&page=1&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&page_num=$page_num>[1]</a>..";
	}

	while($i+$start_page<=$total_page&&$i<=$show_page_num) {
		$move_page=$i+$start_page;
		if($page==$move_page) $print_page.=" <b>$move_page</b> ";
		else $print_page.="<a href=$PHP_SELF?id=$id&page=$move_page&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&page_num=$page_num>[$move_page]</a>";
		$i++;
	}

	if($total_page>$move_page) {
		$next_page=$move_page+1;
		$print_page.="..<a href=$PHP_SELF?id=$id&page=$total_page&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&page_num=$page_num>[$total_page]</a>";
		$print_page=" <a href=$PHP_SELF?id=$id&page=$next_page&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&page_num=$page_num>[Next]</a>";
	}
   
	head("bgcolor=white");
?>

<script>
  function reverse() {
   var i, chked=0;
   for(i=0;i<document.list.length;i++)
   {
    if(document.list[i].type=='checkbox')
    {
     if(document.list[i].checked) { document.list[i].checked=false; }
     else { document.list[i].checked=true; }
    }
   }
  }
</script>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="15"><img src="images/memo_topleft.gif" width="15" height="50"></td>
    <td background="images/memo_topbg.gif">
      <img src="images/t.gif" width="10" height="2"><br>
      <font style=font-size:11pt;font-weight:bold>&nbsp;받은쪽지함</font></td>
    <td width="15"><img src="images/memo_topright.gif" width="156" height="50"></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td>&nbsp;&nbsp;&nbsp;<a href=member_memo.php><img src=images/vi_B_inbox.gif border=0></a> <a href=member_memo2.php><img src=images/vi_B_sent.gif border=0></a> <a href=member_memo3.php><img src=images/vi_B_write.gif border=0></a></td>
    <td align=right><img src="images/t.gif" width="10" height="10"><font color="#666666">전체 :
      <b><?=$total?></b> , 새 쪽지 : <b><?=$new_total?></b></font>&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>

<!-- 선택된 메모가 있을때;; -->
<?
	if($now_data[name]) {

		$temp_name = get_private_icon($now_data[member_from], "2");
		if($temp_name) $now_data[name]="<img src='$temp_name' border=0 align=absmiddle>";
		$temp_name = get_private_icon($now_data[member_from], "1");
		if($temp_name) $now_data[name]="<img src='$temp_name' border=0 align=absmiddle>&nbsp;".$now_data[name];
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="15"><img src="images/memo_listtopleft.gif" width="17" height="17"></td>
    <td background="images/memo_listtop.gif"><img src="images/t.gif" width="10" height="5"></td>
    <td width="15"><img src="images/memo_listtopright.gif" width="17" height="17"></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="17" background="images/memo_listleftbg.gif"><img src="images/t.gif" width="17" height="10"></td>
    <td> 
      <table width="100%" border="0" cellspacing="0" cellpadding="3">
        <tr> 
          <td width="50" align="right"><img src="images/memo_from.gif" width="24" height="15"></td>
          <td><img src="images/t.gif" width="10" height="3"><br>
            <a href=javascript:void(window.open('view_info.php?member_no=<?=$now_data[member_from]?>','view_info','width=400,height=500,toolbar=no,scrollbars=yes'))><?=stripslashes($now_data[name])?></a></td>
        </tr>
        <tr> 
          <td colspan="2" bgcolor="#EBD9D9" align="center" style=padding:0px;><img src="images/t.gif" width="10" height="1"></td>
        </tr>
        <tr> 
          <td width="50" align="right"><img src="images/memo_subject.gif" width="35" height="15"></td>
          <td><img src="images/t.gif" width="10" height="3"><br>
            <?=stripslashes($now_data[subject])?></td>
        </tr>
        <tr> 
          <td colspan="2" bgcolor="#EBD9D9" align="center" style=padding:0px;><img src="images/t.gif" width="10" height="1"></td>
        </tr>
        <tr> 
          <td width="50" align="right"><img src="images/memo_date.gif" width="23" height="15"></td>
          <td><img src="images/t.gif" width="10" height="3"><br>
            <?=date("Y년 m월 d일 H시 i분",$now_data[reg_date])?></td>
        </tr>
        <tr> 
          <td colspan="2" bgcolor="#EBD9D9" align="center" style=padding:0px;><img src="images/t.gif" width="10" height="1"></td>
        </tr>
        <tr> 
          <td align="right" valign="top"><img src="images/memo_memo.gif" width="31" height="15"></td>
          <td style='word-break:break-all;'><img src="images/t.gif" width="10" height="3"><br>
            <?=autolink(nl2br(stripslashes(del_html($now_data[memo]))))?><br>
            <br>
          </td>
        </tr>
        <tr>
          <td align="right" valign="top">&nbsp;</td>
          <td><a href=javascript:void(window.open('view_info.php?member_no=<?=$now_data[member_from]?>','view_info','width=400,height=500,toolbar=no,scrollbars=yes'))><img src="images/memo_reply.gif" width="28" height="15" border=0></a> <a href=<?=$PHP_SELF?>?exec=del&no=<?=$no?>&page=<?=$page?> onclick="return confirm('삭제하시겠습니까?')"><img src="images/memo_delete2.gif" width="31" height="15" border=0></a> <a href=<?=$PHP_SELF?>><img src="images/memo_list.gif" width="18" height="15" border=0></a> </td>
        </tr>
      </table>
    </td>
    <td width="17" background="images/memo_listrightbg.gif"><img src="images/t.gif" width="17" height="10"></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="15"><img src="images/memo_listbottomleft.gif" width="17" height="17"></td>
    <td background="images/memo_listbottom.gif"><img src="images/t.gif" width="10" height="5"></td>
    <td width="15"><img src="images/memo_listbottomright.gif" width="17" height="17"></td>
  </tr>
</table>

<?
	}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="15"><img src="images/memo_listtopleft.gif" width="17" height="17"></td>
    <td background="images/memo_listtop.gif"><img src="images/t.gif" width="10" height="5"></td>
    <td width="15"><img src="images/memo_listtopright.gif" width="17" height="17"></td>
  </tr>
</table>
<table border=0 width=100% cellpadding=0 cellspacing=0>
<tr>
<form method=post name=list action=<?=$PHP_SELF?> onsubmit="return confirm('삭제하시겠습니까?')">
<input type=hidden name=exec value=del_all>
<input type=hidden name=page value=<?=$page?>>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="17" background="images/memo_listleftbg.gif"><img src="images/t.gif" width="17" height="10"></td>
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="20" align="center"><a href=javascript:reverse()><img src=images/memo_c.gif border=0></a></td>
          <td width="20" align="center">&nbsp;</td>
          <td><img src="images/memo_subject.gif" width="35" height="15"></td>
          <td width="80" align="center"><img src="images/memo_from.gif" width="24" height="15"></td>
          <td width="60" align="center"><img src="images/memo_date.gif" width="23" height="15"></td>
        </tr>
<?
	// 출력
	$loop_number=$total-($page-1)*$page_num;
	while($data=mysql_fetch_array($result)) {
		$data[name]=stripslashes($data[name]);

		$temp_name = get_private_icon($data[member_from], "2");
		if($temp_name) $data[name]="<img src='$temp_name' border=0 align=absmiddle>";
		$temp_name = get_private_icon($data[member_from], "1");
		if($temp_name) $data[name]="<img src='$temp_name' border=0 align=absmiddle>&nbsp;".$data[name];
		
		$data[subject]=stripslashes($data[subject]);
		$reg_date=date("Y/m/d H:i",$data[reg_date]);
		if($data[readed]==0) $readed="<img src=images/memo_readed.gif>"; else $readed="<img src=images/memo_unread.gif>"
?>
        <tr> 
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>
        <tr onMouseOver=this.style.backgroundColor="#FFF5F5" onMouseOut=this.style.backgroundColor=""> 
          <td width="20" align="center" height="23"> 
            <input type=checkbox name=del[] value=<?=$data[no]?>>
          </td>
          <td width="20" align="center"><?=$readed?></td>
          <td style='word-break:break-all;' style=cursor:hand; onclick=location.href="<?="$PHP_SELF?exec=view&no=$data[no]&page=$page"?>"><img src="images/t.gif" width="10" height="3"><br>
            <a href=<?="$PHP_SELF?exec=view&no=$data[no]&page=$page"?>><?=$data[subject]?></a></td>
          <td width="80" align="center"><img src="images/t.gif" width="10" height="3"><br>
            <a href=javascript:void(window.open('view_info.php?member_no=<?=$data[member_from]?>','view_info','width=400,height=510,toolbar=no,scrollbars=yes'))><?=$data[name]?></a></td>
          <td width="60" align="center"><font style=font-family:Tahoma;font-size:8pt;><span title='<?=$reg_date?>'><? echo"".date("m/d",$data[reg_date])."" ?></span></font></td>
        </tr>
<?
 		$loop_number--;
	}
?>
      </table>
    </td>
    <td width="17" background="images/memo_listrightbg.gif"><img src="images/t.gif" width="17" height="10"></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="15"><img src="images/memo_listbottomleft.gif" width="17" height="17"></td>
    <td background="images/memo_listbottom.gif"><img src="images/t.gif" width="10" height="5"></td>
    <td width="15"><img src="images/memo_listbottomright.gif" width="17" height="17"></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td>&nbsp;&nbsp;&nbsp;<font style=font-family:Tahoma;font-size:7pt;color:#cc0000><?=$print_page?></font></td>
    <td align="right"><input type=image src="images/memo_delete.gif" width="69" height="25" border="0"> 
      <a href=JavaScript:window.close()><img src="images/memo_close.gif" width="69" height="25" border="0"></a> </td>
  </tr>
</table></td>
</form>
</tr>
</table>

<?
	foot();
?>
