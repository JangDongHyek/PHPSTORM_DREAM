
<script language="javascript">
	function img_view(url){
		document.getElementById("img_file1").src=url;
		var fr=parent.document.getElementById("ifr");
		var frbody=fr.contentWindow.document.body;
		fr.style.height=frbody.scrollHeight+(frbody.offsetHeight-frbody.clientHeight);
	}
	var j=0;

	function popup_img(url,title){
		var x=screen.width/2-330/2; //창을 화면 중앙으로 위치 
		var y=(screen.height-30)/2-400/2;
		
		var popup_Img=window.open(url,"popup",'width=330,height=400,resizeble=0,left='+x+',top='+y);
		if(0<j){
			popup_Img.close();
			popup_Img=window.open(url,"popup",'width=330,height=400,resizeble=0,left='+x+',top='+y);
		}
		
		
		popup_Img.document.write("<html>");
		popup_Img.document.write("<head>");
		popup_Img.document.write("<title>"+title+"</title>");
		popup_Img.document.write("</head>");
		popup_Img.document.write("<body>");
		popup_Img.document.write("<img src="+url+" width=300 onclick='self.close();'/>");
		popup_Img.document.write("</body>");
		popup_Img.document.write("</html>");
		j++;
		
	}
</script>
<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>" border=0>
<? /*?>
<TR> 
	<TD align=right>
    <?=$show_prev_begin?><?=$a_prev?><img src="<?=$skin_board_url?>images/prev.gif" border=0></a><?=$show_prev_end?>
    <?=$show_next_begin?><?=$a_next?><img src="<?=$skin_board_url?>images/next.gif" border=0></a><?=$show_next_end?>
	</TD>
</TR>
<? */?>


<TR>
	<TD bgColor=#CCCCCC>
	
	
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 style="table-layout:fixed">
  <TR bgcolor="#999999"> 
    <TD height=2></TD>
  </TR>
  </TABLE>
  
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 >
  <TR bgcolor=#FFFFFF height=21> 

    <TD colspan="4" style='padding-left:10;padding-top:5px' height="35"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
		   <?
				$col=0;
				$SQL="select * from $bbs_table order by rg_doc_num desc";
				$result=mysql_query($SQL);
				while($rs=mysql_fetch_array($result)){
					if($col%4==0){
						echo "</td></tr><tr>";
					}
					?>
          <td>
			<?
					
					
					if($rs[rg_doc_num]==$doc_num){
						$rg_titles="<span style=font-size:12px;color:#000000><b>".$rs[rg_title]."</b></span>";
					}else{
						$rg_titles="<span style=font-size:12px;color:#000000>".$rs[rg_title]."</span>";
					}
			?>
			   
	           <A href="<?=$PHP_SELF?>?bbs_id=<?=$bbs_id?>&doc_num=<?=$rs[rg_doc_num]?>"><?=$rg_titles?></a>
			  
			   
			
		  </td>
		  <? $col++;}?>
        </tr>
      </table>
    </TD>
  </TR>
  <TR bgcolor=#e7e7e7> 
    <TD height="1" colspan="4"></TD>
  </TR>

  <TR bgcolor=#FFFFFF> 
	<TD colspan=4  class="bbs" style='word-break:break-all;' id="contents" valign="top">
		<TABLE width="100%" cellpadding="0" cellspacing="6">
			<TR>
				<TD width="350" style=padding-top:5px>
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
						
						<p align='center' style="border:1px solid #24273a; padding:5 5 5 5"><img src="<?=$rg_file1_url?>" border="0" onerror="this.src='<?=$skin_board_url?>blank_.gif'" id=img_file1 width=350></p>
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
						
					<? /*?><?=$rg_content?><? */?>
			  </TD>
				<TD valign="top" style="padding-left:12px">
					<table cellpadding="0" cellspacing="2" border="0" style="padding-top:0px" valign="top">
						<tr valign="top">
							<?
								
								$j=0;
								for($i=1;$i<=20;$i++){
									//${rg_file.$i._url};
									if($j%4==0){
										echo "</td></tr><tr>";
									}
									
									if(${rg_file.$i._url}){
										
							?>
							<td style="border:1px solid #24273a;"><img src="<?=${rg_file.$i._url}?>" border="0" onerror="this.src='<?=$skin_board_url?>blank_.gif'" width="70" height="70"onmouseover="img_view('<?=${rg_file.$i._url}?>')" onclick="popup_img('<?=${rg_file.$i._url}?>','<?=$rg_title?>')" style="cursor:hand"></td>
							<?		$j++;}
								}?>
						</tr>
					</table>
				</TD>
			</TR>
		</TABLE>

    
    <br>
	</TD>
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
    <a href=""></a><a href=''></a> </TD></TR>
</TABLE>
	</TD>
</TR>
<TR>
	<TD height=5></TD>
</TR>
