<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
 
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="../bbs/skin/board/blue/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript"> 
try {
	top.document.title='::::::::::붐메이크업입니다::::::::::'
} catch (Exception) {
}
</script>
<link rel="stylesheet" href="../css/board.css"/>
<div align="center">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
<title>모바일 홈페이지</title>
<link rel="stylesheet" type="text/css" href="../css/board.css"/>
<?
 

  /*
	$_zb_path = "/home2/boom/public_html/bbs/"; // 뒤에 슬러시 ( / ) 는 반드시 붙입니다..

	include $_zb_path."lib.php";

  
  
  

    

*/
	    $site_path = "/home/pusanmakeup/public_html/bbs/";
   $site_url = "./bbs/";
   require_once($site_path."include/lib.inc.php");
    //$newDb = new MysqlConnect;

   /* if(!$page) {
        $page = 1;                      //현재 페이지
    }
    if(!$pagesize) {
        $pagesize = 20;     //한페이지에 뿌려질 리스트 갯수
    }*/
	if($search == "tel") {
		$where .= " WHERE $search LIKE '%$keyword'";
    }else if($search == "writer" || $search == "subject" || $search == "content" || $search == "bookdate"){
		if($keyword){
		$where .= " WHERE $search LIKE '%$keyword%'";
		}
	}
	
	$sql="select no from TB_BOOKING ".$where;
	$result1=mysql_query($sql);
	$total_record=mysql_num_rows($result1);
	$num_per_page = 20;
	$page_per_block = 10;
	$total_page = ceil($total_record/$num_per_page);
	if(!$page) {
		$page = 1;
	}
	if($total_record == 0) {
		$first = 1;
		$last = 0;
	} else {
		$first = $num_per_page*($page-1);
		$last = $num_per_page*$page;
	}
    /* 게시판 목록을 불러온다. */
    $sql = "SELECT NO,WRITER,SUBJECT,STATUS,LEVELNO,WDATE,notice_orderby FROM TB_BOOKING ".$where;

    
    $sql .= " ORDER BY notice_orderby desc, SORTNO DESC LIMIT $first,$num_per_page";
	//echo $sql;
    $result = mysql_query($sql);
   /* $pagecount = ceil($totalrecord / $pagesize);*/
	
	$getUrl_arr=explode("&",$_SERVER['QUERY_STRING']);
	$getUrl="";
	for($a=1;$a<count($getUrl_arr);$a++){
		if($getUrl_arr[$a]){
			$getUrl.=$getUrl_arr[$a]."&";
		}
	}
?>
<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	left:0px;
	top:134px;
	width:285px;
	height:350px;
	z-index:1;
	visibility: visible;
}
#Layer2 {
	position:absolute;
	left:660px;
	top:134px;
	width:278px;
	height:191px;
	z-index:2;`
	visibility: visible;
}
-->
</style>

<script language="javascript">
<!--
    function allblur() {
         for (i = 0; i < document.links.length; i++)
              document.links[i].onfocus = document.links[i].blur;
    }

    function passChk(no,searchv,keywordv) {
        document.frmPassChk.page.value = "<?=$page?>";
        document.frmPassChk.no.value = no;
		document.frmPassChk.search.value = searchv;
		document.frmPassChk.keyword.value = keywordv;
        document.frmPassChk.target = "ifmPass";
        document.frmPassChk.action = "./mobile_booking_move.php";
        document.frmPassChk.submit();  
    }

//-->
</script>

<script language="JavaScript">
<!--
function na_open_window(name, url, left, top, width, height, toolbar, menubar, statusbar, scrollbar, resizable)
{
  toolbar_str = toolbar ? 'yes' : 'no';
  menubar_str = menubar ? 'yes' : 'no';
  statusbar_str = statusbar ? 'yes' : 'no';
  scrollbar_str = scrollbar ? 'yes' : 'no';
  resizable_str = resizable ? 'yes' : 'no';

  cookie_str = document.cookie;
  cookie_str.toString();

  pos_start  = cookie_str.indexOf(name);
  pos_end    = cookie_str.indexOf('=', pos_start);

  cookie_name = cookie_str.substring(pos_start, pos_end);

  pos_start  = cookie_str.indexOf(name);
  pos_start  = cookie_str.indexOf('=', pos_start);
  pos_end    = cookie_str.indexOf(';', pos_start);
  
  if (pos_end <= 0) pos_end = cookie_str.length;
  cookie_val = cookie_str.substring(pos_start + 1, pos_end);
  if (cookie_name == name && cookie_val  == "done")
    return;

  window.open(url, name, 'left='+left+',top='+top+',width='+width+',height='+height+',toolbar='+toolbar_str+',menubar='+menubar_str+',status='+statusbar_str+',scrollbars='+scrollbar_str+',resizable='+resizable_str);
}

// --></script>
<form name="frmPassChk" method="post">
  <input type="hidden" name="no">
  <input type="hidden" name="page">
  <input type="hidden" name="search">
  <input type="hidden" name="keyword">
</form>

</head>
 
<body>
 
<!-- 탑메뉴 시작-->
<div class="top" style="">
<div id="ht">
        <div class="mb">
          <div class="ml"><img src="../mobile/images/top.jpg" width="300" height="83" border="0" usemap="#Map2" /></div>
	      <div class="ml"><img src="../mobile/images/logo_main.jpg" width="300" height="36" border="0" usemap="#Map_tmenu"/></div>
        </div> 
</div>
<map name="Map2" id="Map2">
  <area shape="rect" coords="1,0,125,79" href="../mobile/index.htm" />
</map>
<map name="Map_tmenu" id="Map_tmenu">
	          <area shape="rect" coords="64,5,127,34" href="../bbs/mobile_list.php?bbs_id=pro_style1" />
              <area shape="rect" coords="127,5,169,34" href="../bbs/mobile_list.php?bbs_id=pro_gallery03" />
  <area shape="rect" coords="-1,5,65,34" href="../mobile/s1.htm" />
              <area shape="rect" coords="168,5,227,34" href="../bbs/mobile_list.php?bbs_id=noticee" />
			  <area shape="rect" coords="227,5,297,34" href="../mobile/s5.htm" />
</map></div>
<div class="body">
	<div id="dt5"><div>
	<div style="width:100%;background-color:#000000;float:left;text-align:center;">
<table align="center">
	<tr>
		<td>
<a href="../booking/mobile_booking_write.php?mode=insert" class="style1"  style="color:#ffffff">
<span style="height:30px;margin-left:10px;float:left;color:#fff;background-color:#000">일반예약하기</span></a>
<a href="../bbs/mobile_list.php?bbs_id=yeyak" class="style1" style="color:#ffffff">
<span style="height:30px;margin-left:10px;float:left;color:#fff;background-color:#000">승무원공채예약</span></a>
<a href="../bbs/mobile_list.php?bbs_id=confirm" class="style1" style="color:#ffffff">
<span style="height:30px;margin-left:10px;float:left;color:#fff;background-color:#000">예약(입금)확인</span></a>
</tr>
</table>
</div>
	</div></div>
	<!--게시판 리스트 시작-->
	<div class="board_list">
<link rel=stylesheet href='../bbs/skin/board/blue/style.css'>
 
<SCRIPT LANGUAGE="JavaScript"> 
<!--
function img_new_window(name,title) {
	if(name=='')
		return;
	var x=screen.width/2-150/2; //창을 화면 중앙으로 위치 
	var y=(screen.height-30)/2-150/2;
	window.open('../bbs/skin/board/blue/img_view.php?image='+name+'&title='+title,'','width=150,height=150,scrollbars=1,resizable=1,top='+y+',left='+x)
}
//-->
</SCRIPT>
<div class="board_login">
	<span>
				<a href=../bbs/mb_logout.php?url=%2Fbbs%2Fmobile_list.php%3Fbbs_id%3Dconfirm ><IMG src="../bbs/skin/board/blue/images/head_img06.gif" border=0></a>
			</span>
</div><br>
<map name="Map" id="Map">
<area shape="rect" coords="3,6,66,36" href="../mobile/s1.htm" />
<area shape="rect" coords="63,6,128,36" href="../bbs/mobile_list.php?bbs_id=pro_style1" />
<area shape="rect" coords="125,6,168,36" href="../bbs/mobile_list.php?bbs_id=pro_gallery01" />
<area shape="rect" coords="167,6,230,36" href="../bbs/mobile_list.php?bbs_id=noticee" />
<area shape="rect" coords="227,6,298,36" href="../mobile/s5.htm" />
</map>
<map name="Map2" id="Map2"><area shape="rect" coords="5,5,124,79" href="../mobile/index.htm" />
</map>
<?
    if($total_page <= 0) {
?>
	<div class="bbs_list">

              <ul>
		<li class="bbs_list_title">등록된 게시물이 없습니다.</li>
		<li></li>
	</ul>
    </div>      <!--리스트시작-->
              <?
    } else {
        $i=0;
        $bgcolor="";
		$Num = $total_record - $num_per_page*($page-1);
        while($row=mysql_fetch_array($result)) {
            //$nowrecord = $totalrecord - ($i + ($page-1) * $pagesize);
            $newDoc = "";
            $lspace = "";
            for($j=1;$j<=$row[LEVELNO];$j++) {
                $lspace .= "&nbsp;&nbsp;";
            }
            if($lspace) {
                 $lspace .= "<IMG src='img/icon_re.gif' align=absMiddle border=0 width='24' height='10'>";
            }
            $wdate = substr($row[WDATE],0,4) . "/" . substr($row[WDATE],5,2) . "/" . substr($row[WDATE],8,2)
?>
 <a href="javascript:passChk('<?=$row[NO]?>','<?=$search?>','<?=$keyword?>');">
<div class="bbs_list">
	<ul>
		<li class="bbs_list_title">

		<?
				if($row[notice_orderby] > 1){
				echo"<font color=blue><b>[공지]</b></font>";
				}	
				?>				
                 <?=$lspace?>
		<?=rg_cut_string(stripslashes($row[SUBJECT]),40)?>~</li>
		<li><span class="bbs_list_date"><?=$wdate?></span><span class="bbs_list_name"><?=$row[WRITER]?></span></li>
	</ul>
</div>
	</a>

<? }}?>

 <!-- 페이징 및 검색 기능 -->
<div class="bbs_page">
	<span style="width:48%;text-align:right;">
	<?
			$total_block = ceil($total_page/$page_per_block);
			$block = ceil($page/$page_per_block);

			$first_page = ($block-1)*$page_per_block;
			$last_page = $block*$page_per_block;

			if($total_block <= $block) {
				$last_page = $total_page;
			}
			if($keyword){
				$getUrl="&search=$search&keyword=$keyword";
			}
			if($block > 1) {
				$my_page = $first_page;
				echo"<a href=?page=$my_page$getUrl style=font-size:13px>◀</a>&nbsp;";
			} else {
				echo"◀&nbsp;";
			}
			
			for($direct_page = $first_page+1;$direct_page<=$last_page;$direct_page++) {
				$getUrl=str_replace($direct_page,"",$getUrl);
				if($page==$direct_page) {
					echo"<b style=font-size:13px>$direct_page</b>&nbsp;";
				} else {
					echo"<a href=?page=$direct_page$getUrl style=font-size:13px>$direct_page</a>&nbsp;";
				}
			}
			if($block < $total_block) {
				$my_page = $last_page+1;
				echo"<a href=?page=$my_page$getUrl style=font-size:13px>▶</a>";
			} else {
				echo"▶";
			}
			?>	
	</span>
	<span style="width:48%;text-align:right">
	      <a href="mobile_write.php?bbs_id=confirm" class=bbs><img src="../bbs/skin/board/blue/images/write.gif" border=0 align="absmiddle"></a>
		</span>
</div>
	
<div id="foot">
	   <div class="mbottom"><img src="../mobile/images/bottom.jpg" width="300" height="159" border="0" usemap="#copy"/></div>
</div>
 <map name="copy" id="copy">
           <area shape="rect" coords="102,10,198,54" href="tel:0518059996" />
           <area shape="rect" coords="5,10,98,54" href="../booking/mobile_booking_write.php?mode=insert" />
           <area shape="rect" coords="200,10,294,54" href="../main/index.htm" />
</map></div>
</body>
</html>
<script src="../bbs/skin/board/blue/script.js"></script>

