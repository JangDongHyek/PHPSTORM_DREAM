<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>" border=0>
  <TR> 
	<TD align=right>
<?=$show_prev_begin?><?=$a_prev?><IMG src="<?=$skin_board_url?>images/prev.gif" border=0></a><?=$show_prev_end?> <?=$show_next_begin?><?=$a_next?><IMG src="<?=$skin_board_url?>images/next.gif" border=0></a><?=$show_next_end?>
	</TD>
  </TR>
  <TR>
	<TD bgColor=#CCCCCC>
		<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 style="table-layout:fixed">
		  <TR bgcolor=<?=$v_m_h?>> 
		    <TD height=2></TD>
		  </TR>
		</TABLE>
  
		<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 style="table-layout:fixed">
		  <TR bgcolor=#FFFFFF height="25"> 
		    <TD width=12% align="right">예약일시&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0>
		    </TD>
		    <TD colspan="3" style='padding-left:10;' height="25"> 
		      <table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
				  	<TD> <? $rg_ext5 = date("Y년 n월 j일",$rg_ext5); echo "$rg_ext5"; ?>
					<?
										if($doc_num2 > 380){
											echo "$rg_ext1";
										}else{
											echo "$rg_ext1"."시";
										}
					?></TD>
		        </tr>
		      </table>
		    </TD>
		  </TR>
		  <TR bgcolor=#FFFFFF> 
			<TD colSpan='4' height=1 background='<?=$skin_board_url?>images/under_line.gif'></TD>
		  </TR>
		  <TR bgcolor=#FFFFFF height="25"> 
		    <TD align="right">글쓴이&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></TD>
		    <TD colspan="3" style='padding-left:10;'>
		      <table width="100%" border="0" cellspacing="0" cellpadding="0">
		        <tr> 
		          <td WIDTH=60%><span onClick="rg_layer('<?=$site_url?>', '<?=$bbs_id?>','<?=$mb_id?>', '<?=$rg_name?>', '<?=$rg_email_enc?>', '<?=$rg_home_url?>', '<?=$mb_open_info?>')" style='cursor:hand;'><? if($rg_mb_icon) { ?><?=$rg_mb_icon?><? } else { ?> <?=$rg_name?><? } ?></span></td>
		          <td>조회수&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0>&nbsp;&nbsp;<?=$rg_doc_hit?>&nbsp; &nbsp;<?=$show_vote_yes_begin?>추천&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0>&nbsp;&nbsp;<?=$rg_vote_yes?><?=$show_vote_yes_end?>&nbsp; &nbsp;<?=$show_vote_no_begin?>비추천&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0>&nbsp;&nbsp;<?=$rg_vote_no?><?=$show_vote_no_end?></td>
		      </tr>
		    </table></TD>
		  </TR>
		  <TR bgcolor=#FFFFFF> 
			<TD colSpan='4' height=1 background='<?=$skin_board_url?>images/under_line.gif'></TD>
		  </TR>
		  <?=$show_home_begin?>
		  <TR bgcolor=#FFFFFF height="25"> 
			<TD><div align="right">홈페이지&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div></TD>
			<TD colspan=3 style='padding-left:10;'><?=$a_home?><?=$rg_home_url?></a>( Hit: <?=$rg_home_hit?> )</TD>
		  </TR>
		  <?=$show_home_end?>
		  <?=$show_file1_begin?>
		  <TR bgcolor=#FFFFFF height="25"> 
			<TD> 
			  <div align="right">첨부파일&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div>
			</TD>
			<TD colspan=3 style='padding-left:10;'> 
			  <?=$a_file1?>
			  <img src=<?=$site_url?>img/file/<?=$img1?>.gif onerror=this.src='<?=$site_url?>img/file/file.gif' border=0 align=absmiddle>
			<?=$rg_file1_name?>(<?=$rg_file1_size?>)</a>, Down : <?=$rg_file1_hit?>
			</TD>
		  </TR>
		<? if(!$rg_file2_name) {?>
		  <TR bgcolor=#FFFFFF> 
			<TD colSpan='4' height=1 background='<?=$skin_board_url?>images/under_line.gif'></TD>
		  </TR>
		<?}?>
		  <?=$show_file1_end?>
		  <?=$show_file2_begin?>
		  <TR bgcolor=#FFFFFF height="25"> 
			<TD><div align="right">첨부파일2&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div></TD>
			<TD colspan=3 style='padding-left:10;'><?=$a_file2?><img src=<?=$site_url?>img/file/<?=$img2?>.gif onerror=this.src='<?=$site_url?>img/file/file.gif' border=0 align=absmiddle><?=$rg_file2_name?>(<?=$rg_file2_size?>)</a>, Down : <?=$rg_file2_hit?></TD>
		  </TR>
		  <TR bgcolor=#FFFFFF> 
			<TD colSpan='4' height=1 background='<?=$skin_board_url?>images/under_line.gif'></TD>
		  </TR>
		  <?=$show_file2_end?>
		  <?=$show_link1_begin?>
		  <TR bgcolor=#FFFFFF height="25"> 
			<TD><div align="right">링크&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div></TD>
			<TD colspan=3 style='padding-left:10;'> <?=$a_link1?><SPAN TITLE='링크 URL : <?=$rg_link1_url?> '> <?=rg_cut_string($rg_link1_url,30,'...'); ?> </SPAN></a>(Hit : <?=$rg_link1_hit?>)</TD>
		  </TR>
		<? if(!$rg_link2_url) {?>
		  <TR bgcolor=#FFFFFF> 
			<TD colSpan='4' height=1 background='<?=$skin_board_url?>images/under_line.gif'></TD>
		  </TR>
		<?}?>
		<?=$show_link1_end?>
		<?=$show_link2_begin?>
		  <TR  bgcolor=#FFFFFF height="25"> 
			<TD><div align="right">링크2&nbsp;&nbsp;<img src="<?=$skin_board_url?>images/head_img09.gif" border=0></div></TD>
			<TD colspan=3 style='padding-left:10;'> <?=$a_link2?><SPAN TITLE='링크 URL : <?=$rg_link2_url?> '> <?=rg_cut_string($rg_link2_url,30,'...'); ?>  </SPAN></a>(Hit : <?=$rg_link2_hit?>)</TD>
		  </TR>
		  <TR bgcolor=#FFFFFF> 
			<TD colSpan='4' height=1 background='<?=$skin_board_url?>images/under_line.gif'></TD>
		  </TR>
		<?=$show_link2_end?>
		  <TR bgcolor=#FFFFFF>
			<TD colspan=4 style='padding:15;' class="bbs" style='word-break:break-all' id="contents">
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
		  <div id=ct class=contents><span id="content">
			<?=$show_ext3_begin?>연 락 처 &nbsp;: <?=$rg_ext3?><br><?=$show_ext3_end?>
			<?=$show_ext4_begin?><?=$show_ext4_title?> : <?=$rg_ext4?><br><?=$show_ext4_end?>
			<?=$show_ext5_begin?><?=$show_ext5_title?> : <?=$rg_ext5?><br><?=$show_ext5_end?>
			<?=$show_file1_view_begin?>
		   <div align=center><? $url = $rg_file1_url; //한글, 띠어쓰기 파일 보이기
		if(eregi ("(([^/a-zA-Z]){1,})(\.jpg|\.jpeg|\.bmp|\.png|\.gif)", $url ,$regs))
		{ 
			$url = str_replace ($regs[1], rawurlencode($regs[1]),$url); 
		}else{
			$url = $rg_file1_url;
		} 
		?> 
			<img src="<?=$url?>" border="0" onerror="this.src='<?=$skin_board_url?>blank_.gif'" onclick="img_new_window('<?=rawurlencode($url)?>','<?=urlencode($rg_title)?>')" style="cursor:hand;" id=img_file1 alt='원래 크기의 이미지를 볼려면 클릭!!'></div>

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
			<div align=center><? $url2 = $rg_file2_url; //한글, 띠어쓰기 파일 보이기
		if(eregi ("(([^/a-zA-Z]){1,})(\.jpg|\.jpeg|\.bmp|\.png|\.gif)", $url2 ,$regs))
		{ 
		   $url2 = str_replace ($regs[1], rawurlencode($regs[1]),$url2); 
		} else {
			$url2 = $rg_file2_url;
		} 
		?> 
			<img src="<?=$url2?>" border="0" onerror="this.src='<?=$skin_board_url?>blank_.gif'" onclick="img_new_window('<?=rawurlencode($url2)?>','<?=urlencode($rg_title)?>')" style="cursor:hand;" id=img_file2 alt='원래 크기의 이미지를 볼려면 클릭!!'></div>
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
			<BR> <?=$rg_content?></span></div>
			<br>
			<div align="right" style='padding-right:0;'>
			<font style='font-family:tahoma;font-size:7pt;'>Posted at <b><?=$rg_reg_date?></b></font>
		<?
		if ($rg_modi_date!=" ") {
		?><br><font style='font-family:tahoma;font-size:7pt;'>Edited at <b><?=$rg_modi_date?></b></font><? 
		}
		?>
			</div></TD>
		  </TR>
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
			<a href=""></a><a href=''></a></TD></TR>
		</TABLE>
<TABLE cellSpacing=0 cellPadding=5 width="100%" border=0 bgcolor=#ffffff>
  <TR> 
    <TD class="bbs" align=right><br>
        <?=$a_list?><IMG src="<?=$skin_board_url?>images/list.gif" border=0></a>

		<a href="#" onclick="javascript:window.open('./print.html?bbs_id=<?=$bbs_id?>&doc_num=<?=$doc_num?>','','width=600,height=670,scrollbars=yes,top=10,left=30');"><IMG src="<?=$skin_board_url?>images/print.gif" border=0></a>


        <?=$show_edit_begin?><a href="edit.php?bbs_id=<?=$bbs_id?>&doc_num=<?=$doc_num?>&book=<?=$book?>&year=<?=$year?>&month=<?=$month?>"><IMG src="<?=$skin_board_url?>images/modify.gif" border=0></a><?=$show_edit_end?>
        <?=$show_delete_begin?><?=$a_delete?><IMG src="<?=$skin_board_url?>images/delete.gif" border=0></a><?=$show_delete_end?>

		<?=$show_vote_yes_begin?><?=$a_vote_yes?><IMG src="<?=$skin_board_url?>images/vote.gif" border=0></a><?=$show_vote_yes_end?>
		<?=$show_vote_no_begin?><?=$a_vote_no?><IMG src="<?=$skin_board_url?>images/novote.gif" border=0></a><?=$show_vote_no_end?>

        <?=$show_admin_begin?>
        <a href="javascript:view_manager(<?=$rg_doc_num?>)"><IMG src="<?=$skin_board_url?>images/admin.gif" border=0></a>

		<script language="JavaScript" type="text/JavaScript">
		function view_manager(doc_num){
			window.open('<?=$u_board_manager?>?bbs_id=<?=$bbs_id?>&chk_rg_num[]='+doc_num, "board_manager", 'scrollbars=no,width=355,height=200');
		}
		</script>

        <?=$show_admin_end?>
		</TD>
  </TR>
</TABLE>


</TD>
  </TR>
  <TR>
	<TD height=5></TD>
  </TR>
