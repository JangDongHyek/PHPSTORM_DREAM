<?
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
	
	if($act) {
		while(list($key,$value)=each($HTTP_POST_VARS))
			if(is_string($value))
				$GLOBALS[$key]=trim($value);
		$vt_regdate = $now;
		$vt_end=strtotime($vt_end);
		$vt_start=strtotime($vt_start);
		
		if($mode=='edit') {
		 	// 테이블에 투표 데이타 수정 
			$dbqry="
				UPDATE `{$db_table_vote}_cfg` SET
					`vt_start` = '$vt_start',
					`vt_end` = '$vt_end',
					`vt_skin` = '$vt_skin', 
					`vt_question` = '$vt_question', 
					`vt_header_file` = '$vt_header_file', 
					`vt_header_tag` = '$vt_header_tag', 
					`vt_footer_file` = '$vt_footer_file', 
					`vt_footer_tag` = '$vt_footer_tag', 
					`vt_cfg_repeat` = '$vt_cfg_repeat', 
					`vt_cfg_comment` = '$vt_cfg_comment', 
					`vt_cfg_auth` = '$vt_cfg_auth',
					`vt_cfg_show` = '$vt_cfg_show'
				WHERE vt_num='$vt_num'
			";
			query($dbqry,$dbcon);
		} else {
			// 테이블에 투표 데이타 추가
			$dbqry="
				INSERT INTO `{$db_table_vote}_cfg` 
					( `vt_start` , `vt_end` ,
					  `vt_regdate` , `vt_skin` , `vt_question` ,
						`vt_header_file` , `vt_header_tag` , `vt_footer_file` ,
						`vt_footer_tag` , `vt_cfg_repeat` , `vt_cfg_comment` ,
						`vt_cfg_auth`,`vt_cfg_show` ) 
				VALUES 
					( '$vt_start', '$vt_end',
						'$vt_regdate', '$vt_skin', '$vt_question',
						'$vt_header_file', '$vt_header_tag', '$vt_footer_file',
						'$vt_footer_tag', '$vt_cfg_repeat', '$vt_cfg_comment',
						'$vt_cfg_auth','$vt_cfg_show')
			";
			query($dbqry,$dbcon);
			$vt_num=mysql_insert_id();
			for($i=0;$i<count($vit_item);$i++){
				$qry="
					INSERT INTO `{$db_table_vote}_item`
					VALUES
					('','$vt_num',".($i+1).",'{$vit_item[$i]}', 0)
				";
				$rs=query($qry,$dbcon);
			}
		}
		rg_href("vote_list.php?$p_str&page=$page");
	}
	if($mode=='edit') {
		$R=rg_get_vote_cfg($vt_num);
		$R[vt_start]=rg_date($R[vt_start],'%Y-%m-%d');
		$R[vt_end]=rg_date($R[vt_end],'%Y-%m-%d');
	} else {
		$R[vt_cfg_repeat]='1';
		$R[vt_start]=date("Y-m-d");
		$R[vt_end]=date("Y-m-d",strtotime ("+7 day"));
		$R[vt_cfg_comment]='A';
		$R[vt_cfg_auth]='A';
	}
?>
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<script src="calendar.js"></script><br>
<table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
    <tr>
        
    <td width="796" height="30" align="center" bgcolor="#F7F7F7"> <font color="#404040">투표설정</font></td>
    </tr>
</table>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center"><form action="" method="post" enctype="multipart/form-data" name="vote_edit" id="vote_edit">
<input name="act" type="hidden" value="ok">
<input name="mode" type="hidden" value="<?=$mode?>">
<input name="vt_num" type="hidden" value="<?=$vt_num?>">
<input name="page" type="hidden" value="<?=$page?>">
        <table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >스킨&nbsp;:&nbsp;</td>
            <td ><select name="vt_skin" id="vt_skin">
                <?
$skin_list = rg_get_filelist($skin_path.$skin_vote_dir,'d');
echo rg_html_option($skin_list,'','',$R[vt_skin],true);
?>
              </select></td>
          </tr>
          <tr> 
            <td width="100" align="right" bgcolor="#f7f7f7">기간&nbsp;:&nbsp;</td>
            <td> <table border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td> <input name="vt_start" type="text" id="vt_start" value="<?=$R[vt_start]?>" size="11" maxlength="10"> 
                    <input name="button" type=button onClick="changeCal2(document.vote_edit.vt_start.value);ret_name = document.vote_edit.vt_start;showXY(document.all.vt_start);" value=''> 
                  </td>
                  <td>&nbsp;~&nbsp;</td>
                  <td> <input name="vt_end" type="text" id="vt_end" value="<?=$R[vt_end]?>" size="11" maxlength="10"> 
                    <input name="button" type=button onClick="changeCal2(document.vote_edit.vt_end.value);ret_name = document.vote_edit.vt_end;showXY(document.all.vt_end);" value=''> 
                  </td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >질문&nbsp;:&nbsp;</td>
            <td ><input name="vt_question" type="text" id="vt_question" value="<?=$R[vt_question]?>" size="50"></td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >상단삽입파일&nbsp;:&nbsp;</td>
            <td ><input name="vt_header_file" type="text" id="vt_header_file" value="<?=$R[vt_header_file]?>" size="50"></td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >상단태그&nbsp;:&nbsp;</td>
            <td ><textarea name="vt_header_tag" cols="50" rows="8" id="vt_header_tag"><?=$R[vt_header_tag]?></textarea></td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >하단삽입파일&nbsp;:&nbsp;</td>
            <td ><input name="vt_footer_file" type="text" id="vt_footer_file" value="<?=$R[vt_footer_file]?>" size="50"></td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >하단태그&nbsp;:&nbsp;</td>
            <td ><textarea name="vt_footer_tag" cols="50" rows="8" id="vt_footer_tag"><?=$R[vt_footer_tag]?></textarea></td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >중복체크&nbsp;:&nbsp;</td>
            <td > 
              <?
echo rg_html_radio($bbs_func,'vt_cfg_repeat','','',$R[vt_cfg_repeat])
?>
            </td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >코멘트&nbsp;:&nbsp;</td>
            <td > <select name="vt_cfg_comment">
                <?=rg_html_option($vote_auths,'','',"$R[vt_cfg_comment]")?>
              </select> </td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >투표권한&nbsp;:&nbsp;</td>
            <td > <select name="vt_cfg_auth">
                <?=rg_html_option($vote_auths,'','',"$R[vt_cfg_auth]")?>
              </select></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >투표권한(보기)&nbsp;:&nbsp;</td>
            <td > <select name="vt_cfg_show">
                <?=rg_html_option($vote_auths,'','',"$R[vt_cfg_auth]")?>
              </select></td>
          </tr>
          <?=($mode=='edit')?'':'<!--'?>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >등록일&nbsp;:&nbsp;</td>
            <td > 
              <?=rg_date($R[vt_regdate])?>
            </td>
          </tr>
          <?=($mode=='edit')?'':'-->'?>
        </table>
        <? if($mode=='edit') { ?>
<script language="JavaScript" type="text/JavaScript">

	function Resize_vFrame(name)
	{
		try
			{       
			var oBody 	= document.frames(name).document.body;
			var oFrame 	= document.all(name);
	
//			oFrame.style.width = "582px"
//					= oBody.scrollWidth + (oBody.offsetWidth-oBody.clientWidth);
			oFrame.style.height 
					= oBody.scrollHeight + (oBody.offsetHeight-oBody.clientHeight);
	
			if (oFrame.style.height == "0px" || oFrame.style.width == "0px")
				{
//				oFrame.style.width = "582px";
				oFrame.style.height = "300px"; 
				window.status = 'iframe resizing fail.';
				}
			else
				{
				window.status = '';
				}
			}
		catch(e)
			{
			window.status = 'Error: ' + e.number + '; ' + e.description;
			}
	}
	
</script>

<iframe src="vote_item.php?vt_num=<?=$vt_num?>" width="100%" frameborder="0" style="height:100px" name=if_vote id=id_vote scrolling=no></iframe><br>
        <? } else { ?>
				<table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >항목갯수&nbsp;:&nbsp;</td>
            <td >
<select name="item_count" id="item_count" onChange="chk_item(this.value);">
<option value="2" selected>2개</option>
<script language="JavaScript" type="text/JavaScript">
for(i=3;i<31;i++) {
	document.write("<option value="+i+">"+i+"개</option>");
}
</script>
</select>
						</td>
          </tr>
          <tr> 
            <td width="100" align="right" bgcolor="#f7f7f7" >항목&nbsp;:&nbsp;</td>
            <td >
						 <div id="chk_item">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="60" align="right">1 번째 :&nbsp;</td>
                    <td><input type="text" name="vit_item[]" size="45"> </td>
                  </tr>
                  <tr>
                    <td align="right">2 번째 :&nbsp;</td>
                    <td><input type="text" name="vit_item[]" size="45"> </td>
                  </tr>
                </table>
						 </div>
            </td>
          </tr>
        </table>
        <? } ?><br>
        <input name="Submit" type="submit" class="button1" value="  확  인  ">
        <br>
        <br>
        <a href="vote_list.php?<?="$p_str&page=$page"?>"><img src="images/list_mb.gif" width="66" height="25" border="0"></a> 
      </form></td>
  </tr>
</table>
<? include("admin.footer.php"); ?>
<script language=javascript>
function chk_item(num)
{
	var SubMenuDoc=document.getElementById('chk_item')
	SubMenuDoc.innerHTML='';
	var HTML='';
	if(num==0)
		SubMenuDoc.style.display='none';
	else
	{
		HTML+='<table width="100%" border="0" cellpadding="0" cellspacing="0">';
		for(i=0;i<num;i++)
		{
			HTML+='<tr><td width="60" align="right">'+(i+1)+' 번째 :&nbsp;</td><td><input type="text" name="vit_item[]" size="45"> </td></tr>';
		}
		HTML+='</table>';
		SubMenuDoc.innerHTML=HTML;
		SubMenuDoc.style.display='';
	}
}

	createLayer('Calendar');
//	changeCal(<?=$c_month?>,<?=$c_year?>)	
	hide();
</script>