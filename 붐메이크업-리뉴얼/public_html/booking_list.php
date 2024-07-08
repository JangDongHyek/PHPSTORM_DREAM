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
	echo $_SERVER['QUERY_STRING'];
	$getUrl_arr=explode("&",$_SERVER['QUERY_STRING']);
	$getUrl="";
	for($a=1;$a<count($getUrl_arr);$a++){
		if($getUrl_arr[$a]){
			$getUrl.=$getUrl_arr[$a]."&";
		}
	}
?>

<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>무제 문서</title>
<meta http-equiv="imagetoolbar" content="no">
<link href="../style.css" rel="stylesheet" type="text/css">
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
        document.frmPassChk.action = "./booking_move.php";
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

</head>
<script language='JavaScript' src='../printEmbed.js'></script>
<body topmargin="0" leftmargin="0" >
  		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><TABLE class=board cellSpacing=0 cellPadding=0 width="95%" border=0 align="center">
              <TR bgColor=#0D2465>
                <TD colSpan=4 height=2></TD>
              </TR>
              <TR class=bg_board01>
                <TD width=50 height=27 bgcolor="F7F7F7"><p align="center">번호 </TD>
                <TD bgcolor="F7F7F7"><p align="center">제목</TD>
                <TD width=65 bgcolor="F7F7F7"><p align="center">작성자 </TD>
                <TD width=65 bgcolor="F7F7F7"><p align="center">등록일</TD>
              </TR>
              <TR bgColor=#0D2465>
                <TD colSpan=4 height=1></TD>
              </TR>
              <?
    if($total_page <= 0) {
?>
              <TR bgColor=#f7f7f7>
                <TD height=25 colSpan=4><p align="center">◈등록된 게시물이 없습니다◈</TD>
              </TR>
              <!--리스트시작-->
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
              <TR bgColor=#F5EEDF>
                <TD height=25 bgcolor="#FFFFFF"><p align="center">
                  <?=$Num?>
                </TD>
                <TD align=left bgcolor="#FFFFFF"><p style="margin-left:3pt;">
 				<?
				if($row[notice_orderby] > 1){
				echo"<font color=blue><b>[공지]</b></font>";
				}	
				?>				
                 <?=$lspace?>
                  <a href="javascript:passChk('<?=$row[NO]?>','<?=$search?>','<?=$keyword?>');">
                    <?=rg_cut_string(stripslashes($row[SUBJECT]),40)?>
                </a></TD>
                <TD bgcolor="#FFFFFF"><p align="center">
                  <?=$row[WRITER]?>
                </TD>
                <TD bgcolor="#FFFFFF"><p align="center">
                  <?=$wdate?>
                </TD>
              </TR>
              <?
			if($i != 5 || $nowrecord != 0) {
?>
              <!--수평선시작-->
              <TR bgColor=#e7e7e7>
                <TD colSpan=4 height=1></TD>
              </TR>
              <?
			}
            $i++;
            $cnt++;
			$Num--;
        }
    }
?>
              <!--리스트종료-->
              <TR bgColor=#f6f1f9>
                <TD colSpan=4 height=2></TD>
              </TR>
            </TABLE></td>
          </tr>
          <tr>
            <td><TABLE cellSpacing=0 cellPadding=0 width="95%" border=0 align="center">
              <TR>
                <TD colSpan=3 height=10></TD>
              </TR>
              <TR>
                <TD width=100></TD>
                <TD class=search align=middle>
					<?
			$total_block = ceil($total_page/$page_per_block);
			$block = ceil($page/$page_per_block);

			$first_page = ($block-1)*$page_per_block;
			$last_page = $block*$page_per_block;

			if($total_block <= $block) {
				$last_page = $total_page;
			}

			if($block > 1) {
				$my_page = $first_page;
				echo"<a href=?page=$my_page&$getUrl>◀</a>&nbsp;";
			} else {
				echo"◀&nbsp;";
			}
			
			for($direct_page = $first_page+1;$direct_page<=$last_page;$direct_page++) {

				$getUrl=str_replace($direct_page,"",$getUrl);
				if($page==$direct_page) {
					echo"<b>$direct_page</b>&nbsp;";
				} else {
					echo"<a href=?page=$direct_page&$getUrl>$direct_page</a>&nbsp;";
				}
			}
			if($block < $total_block) {
				$my_page = $last_page+1;
				echo"<a href=?page=$my_page&$getUrl>▶</a>";
			} else {
				echo"▶";
			}
			?>	
				</TD>
                <TD align=right width=100><A href="booking_write.php?search=<?=$search?>&keyword=<?=$keyword?>&page=<?=$page?>&mode=insert"><IMG alt=글쓰기 hspace=5 src="img/btn_write.gif" align=absMiddle border=0></A> </TD>
              </TR>
              <TR>
                <TD colSpan=3 height=10></TD>
              </TR>
              <TR>
                <TD colSpan=3 height=10 align="center">
				<form name=search_form method="get" action=<?=$PHP_SELF?>>
					<select name="search">
					 <option value="writer">작성자</option>
					 <option value="subject">제목</option>
					 <option value="content">내용</option>
					 <option value="bookdate">예약일자</option>
					 <option value="tel">핸드폰끝자리</option>
					</select>
					<input type=text name="keyword"> <input type="submit" value="검색">
				</form>
				※예약일자 검색 예)20080407				</TD>
              </TR>
			  </TABLE></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
</table>

<map name="home"><area shape="rect" coords="77,33,223,131" href="../main/start.htm">
</map>
<map name="banner">
<area shape="rect" coords="52,4,225,64" href="../booking/booking_list.php"><area shape="rect" coords="52,65,225,123" href="../main/company3.htm">
</map>
<iframe name="ifmPass" id="ifmPass" width="0" height="0"></iframe>
</body>
</html>
<? 
   // $newDb->dbClose();
?>
