<?
	$rg_content = str_replace("</P>", "<br />", $rg_content);
	$rg_content = str_replace("<P>", "", $rg_content);
	$rg_content = str_replace("</p>", "<br />", $rg_content);
	$rg_content = str_replace("<p>", "", $rg_content);

?>

<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>" border=0>
<TR> 
	<TD align=right>
    <?=$show_prev_begin?><?=$a_prev?><img src="<?=$skin_board_url?>images/prev.gif" border=0></a><?=$show_prev_end?>
    <?=$show_next_begin?><?=$a_next?><img src="<?=$skin_board_url?>images/next.gif" border=0></a><?=$show_next_end?>
	</TD>
</TR>


<TR>
	<TD bgColor=#CCCCCC>
	
	
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 style="table-layout:fixed">
  <TR bgcolor="#0D2465"> 
    <TD height=1></TD>
  </TR>
</TABLE>
  
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 style="table-layout:fixed">
  <TR bgcolor=#FFFFFF height=21> 
    <TD width=12% bgcolor=F7F7F7 height="30"> 
      <div align="right"><img src="<?=$skin_board_url?>images/bbs_title02.gif" width="22" height="11" />&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div>
    </TD>
    <TD colspan="3" style='padding-left:10;' height="25"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><font color=#000000><b> 
            <?=$rg_title?>
            </b></font></td>
          <td> 
            <div align="right" style='padding-right:20;'><font color=#000000><font color="#999999">[ 
              <?=$rg_reg_date?>
              ] </font></font></div>
          </td>
        </tr>
      </table>
    </TD>
  </TR>
  <TR bgcolor=#e7e7e7> 
    <TD height="1" colspan="4"></TD>
  </TR>
  <TR bgcolor=#FFFFFF height=21> 
    <TD bgcolor=F7F7F7 height="30"> 
      <div align="right"><img src="<?=$skin_board_url?>images/bbs_title10.gif" width="32" height="11" />&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div>
    </TD>
    <TD colspan="3" style='padding-left:10;' height=21><span onClick="rg_layer('<?=$site_url?>', '<?=$bbs_id?>','<?=$mb_id?>', '<?=$rg_name?>', '<?=$rg_email_enc?>', '<?=$rg_home_url?>', '<?=$mb_open_info?>')" style='cursor:hand;'> 
      </span> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><span onClick="rg_layer('<?=$site_url?>', '<?=$bbs_id?>','<?=$mb_id?>', '<?=$rg_name?>', '<?=$rg_email_enc?>', '<?=$rg_home_url?>', '<?=$mb_open_info?>')" style='cursor:hand;'> 
            <?=$rg_mb_icon?>
            <?=$rg_name?>
            </span></td>
          <td style='padding-right:20;'> 
            <div align="right">조회수: 
              <?=$rg_doc_hit?>
              &nbsp; &nbsp; 
              <?=$show_vote_yes_begin?>
              추천: 
              <?=$rg_vote_yes?>
              <?=$show_vote_yes_end?>
              &nbsp; &nbsp; 
              <?=$show_vote_no_begin?>
              비추천: 
              <?=$rg_vote_no?>
              <?=$show_vote_no_end?>
            </div>
          </td>
        </tr>
      </table>
    </TD>
  </TR>
  <?=$show_home_begin?>
  <TR bgcolor=#FFFFFF height=21> 
    <TD bgcolor=F7F7F7 height=21> 
      <div align="right">홈페이지&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div>
    </TD>
    <TD colspan=3 style='padding-left:10;' height=21> 
      <?=$a_home?>
      <?=$rg_home_url?></a>
      , Hit: 
      <?=$rg_home_hit?>
    </TD>
  </TR>
  <?=$show_home_end?>
  <?=$show_file1_begin?>
  <TR bgcolor=#FFFFFF height=21> 
    <TD bgcolor=F7F7F7 height=21> 
      <div align="right">다운로드 #1&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div>
    </TD>
    <TD colspan=3 style='padding-left:10;' height=21> 
      <?=$a_file1?>
      <?=$rg_file1_name?>
      ( 
      <?=$rg_file1_size?>
      )</a>, Down: 
      <?=$rg_file1_hit?>
    </TD>
  </TR>
  <?=$show_file1_end?>
  <?=$show_file2_begin?>
  <TR bgcolor=#FFFFFF height=21> 
    <TD bgcolor=F7F7F7 height=21> 
      <div align="right">다운로드 #2 &nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div>
    </TD>
    <TD colspan=3 style='padding-left:10;' height=21> 
      <?=$a_file2?>
      <?=$rg_file2_name?>
      ( 
      <?=$rg_file2_size?>
      )</a>, Down: 
      <?=$rg_file2_hit?>
    </TD>
  </TR>
  <?=$show_file2_end?>
  <?=$show_link1_begin?>
  <TR bgcolor=#FFFFFF height=21> 
    <TD bgcolor=F7F7F7 height=21> 
      <div align="right">링크 #1&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div>
    </TD>
    <TD colspan=3 style='padding-left:10;' height=21> 
      <?=$a_link1?>
      <?=$rg_link1_url?></a>
      , Hit: 
      <?=$rg_link1_hit?>
    </TD>
  </TR>
  <?=$show_link1_end?>
  <?=$show_link2_begin?>
  <TR bgcolor=#FFFFFF height=21> 
    <TD bgcolor=F7F7F7 height=21> 
      <div align="right">링크 #2&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div>
    </TD>
    <TD colspan=3 style='padding-left:10;' height=21> 
      <?=$a_link2?>
      <?=$rg_link2_url?></a>
      , Hit: 
      <?=$rg_link2_hit?>
    </TD>
  </TR>
  <?=$show_link2_end?>
      <TR bgcolor=#0D2465> 
    <TD height="1" colspan="4"></TD>
  </TR>
  <TR bgcolor=#FFFFFF><TD colspan=4 style='padding:15;' class="bbs" style='word-break:break-all' id="contents">
    <?=$show_ext1_begin?>
    <?=$show_ext1_title?>
    : 
    <?=$rg_ext1?>
    <br>
    <?=$show_ext1_end?>
    <?=$show_ext2_begin?>
    <?=$show_ext2_title?>
    : 
    <?=$rg_ext2?>
    <br>
    <?=$show_ext2_end?>
    <?=$show_ext3_begin?>
    <?=$show_ext3_title?>
    : 
    <?=$rg_ext3?>
    <br>
    <?=$show_ext3_end?>
    <?=$show_ext4_begin?>
    <?=$show_ext4_title?>
    : 
    <?=$rg_ext4?>
    <br>
    <?=$show_ext4_end?>
    <?=$show_ext5_begin?>
    <?=$show_ext5_title?>
    : 
    <?=$rg_ext5?>
    <br>
    <?=$show_ext5_end?>
     <script language="JavaScript" type="text/JavaScript">
var img1_width = 0;
var img2_width = 0;
var img1_exist = false;
var img2_exist = false;

function set_img_init() {
	if(img1_exist) setInterval(set_img1, 100);
	if(img2_exist) setInterval(set_img2, 100);
	if(old_onload) old_onload();
}

function set_img(name,org_width,view_width) {
  var img = eval((navigator.appName == 'Netscape') ? nsdoc+'.'+name : 'document.all.'+name);
  if (img) {
	  if(org_width>view_width) {
			img.width=view_width;
		} else if(org_width < view_width) {
			img.width=org_width;
		}
	}
}

if(onload)
	var old_onload=onload;
onload=set_img_init;
</script>
    <?=$show_file1_view_begin?>
    <img src="<?=$rg_file1_url?>" border="0" onerror="this.src='<?=$skin_board_url?>images/blank_.gif'" onclick="img_new_window('<?=urlencode($rg_file1_url)?>','<?=urlencode($rg_title)?>')" style="cursor:hand;" id=img_file1> 
    <script language="JavaScript" type="text/JavaScript">
img1_exist = true;
function set_img1() {
	if(img1_width==0) {
		img1_width = img_file1.width;
	}
	set_img('img_file1',img1_width,contents.offsetWidth)
}
</script>
    <br>
    <?=$show_file1_view_end?>
    <?=$show_file2_view_begin?>
    <img src="<?=$rg_file2_url?>" border="0" onerror="this.src='<?=$skin_board_url?>images/blank_.gif'" onclick="img_new_window('<?=urlencode($rg_file2_url)?>','<?=urlencode($rg_title)?>')" style="cursor:hand;" id=img_file2> 
    <script language="JavaScript" type="text/JavaScript">
img2_exist = true;
function set_img2() {
	if(img2_width==0) {
		img2_width = img_file2.width;
	}
	set_img('img_file2',img2_width,contents.offsetWidth)
}
</script>
    <br>
    <?=$show_file2_view_end?>
    <?=$rg_content?>
    <br>
  <TR bgcolor=#e7e7e7> 
    <TD height="1" colspan="4"></TD>
  </TR>
    <?=$show_signature_begin?>
    <div id="Layer1" style="width:100%; height:100px; overflow: hidden;word-break:break-all;background-color:#F7F7F7;layer-background-color:#F7F7F7;"> 
      <p style="margin:5;"> 
        <?=$mb_signature?>
    </div></div>
    <?=$show_signature_end?>
    <!-- 테러 태그 방지용 --></xml></xmp>
    <a href=""></a><a href=''></a> </TD></TR>
</TABLE>
	</TD>
</TR>
<TR>
	<TD height=5></TD>
</TR>