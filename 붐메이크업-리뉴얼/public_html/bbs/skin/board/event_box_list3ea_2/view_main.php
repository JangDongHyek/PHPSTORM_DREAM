<script language="javascript">
	window.onload=function(){
		var contents=document.getElementById("contents");
		var img=contents.getElementsByTagName("img");

		for(var i=0;i<img.length;i++){
			img[i].style.width="100%";
			
		}
	}
</script>
<style>
.title{ font-size:18px; color:#c92b2b}
</style>
<br />
<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>" border=0>
<TR> 
	<TD>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="240"><table width="" cellpadding="0" cellspacing="0">
		<tr>
			<td width="120" height="40" align="center" style="border-left:1px solid #c92b2b;border-top:1px solid #c92b2b"><font color="c92b2b"><b>체험상품</b></font></td>
			<td style="border-left:1px solid #c92b2b;border-top:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:1px solid #c92b2b; background:#f6f6f6" width="120" align="center"><a href="./view2.php?bbs_id=<?=$bbs_id?>&doc_num=<?=$rg_doc_num?>&page=<?=$page?>">신청하기</a></td>
		</tr>
	</table></td>
          <td style="border-bottom:1px solid #c92b2b">&nbsp;</td>
        </tr>
    </table></TD>
</TR>
<TR>
	<TD></TD>
</TR>

<TR>
	<TD >
	
	

  
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 style="table-layout:fixed">
  <TR bgcolor=#FFFFFF height=21> 
   
    <TD colspan="4" style='padding-left:10;' height="30"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="40" align="center" class="title"><b><?=$rg_title?></b></td>
         
        </tr>
      </table>
    </TD>
  </TR>
  <TR bgcolor=#e7e7e7> 
    <TD height="1" colspan="4"></TD>
  </TR>
  
  <TR bgcolor=#FFFFFF> <TD colspan=4 style='padding:15;' class="bbs" style='word-break:break-all' id="contents">
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
    <p align='center'><img src="<?=$rg_file1_url?>" border="0" onerror="this.src='<?=$skin_board_url?>blank_.gif'" id=img_file1></p>
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
	<p align="center"><img src="<?=$rg_file2_url?>" border="0" onerror="this.src='<?=$skin_board_url?>blank_.gif'" id=img_file2></p> 
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
	<div id="contents">
    <?=$rg_content?>
	</div>
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
