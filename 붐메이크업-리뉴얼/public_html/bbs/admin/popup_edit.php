<?
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
	require_once($site_path."include/schema.inc.php");

	

	if($act) {		
		if($mode=='edit') {
		 	// 테이블에 팝업 데이타 수정
			$dbqry="
				UPDATE `tblpopup` SET
					`visible` = '$visible',
					`subject` = '$subject',
					`width` = '$width',
					`height` = '$height',
					`location_top` = '$top',
					`location_left` = '$left',
					`cookie` = '$cookie',
					`title` = '$title',
					`memo` = '$memo'
				WHERE `idx` = '$idx'
			";
			query($dbqry,$dbcon);
		} else {
			$regdate = strftime("", time());
			// 테이블에 팝업 데이타 추가
			$dbqry="
				INSERT INTO `tblpopup`
					(	`idx`, `visible`,`subject`,
						`width`,`height`,`location_top`,
						`location_left`,`cookie`,`title`,
						`tag`,`memo`,`regdate`				
					) 
				VALUES 
					(	'','$visible','$subject',
						'$width','$height','$top',
						'$left','$cookie','$title',
						'$tag','$memo',now()
					)
			";
			query($dbqry,$dbcon);
			$idx = mysql_insert_id();
		}
		$bbs_data_path  = "../editor/upload/";
		// 파일처리
		for($fi=1;$fi<2;$fi++) {
			if(${"del_file{$fi}"}) {
				@unlink($bbs_data_path.${"rg_file{$fi}_name"});
				${"rg_file{$fi}_name"} = '';
			}
			$file = $HTTP_POST_FILES["rg_file$fi"];
			if($file[size]>0) {
				$temp=explode(".",$file[name]);
				$file[ext]=$temp[count($temp)-1];
				
				$file[server_name] = $idx.'$'.$fi.'$'.$file[name];
				
				if(${"rg_file{$fi}_name"}) {
					if(@unlink($bbs_data_path.${"rg_file{$fi}_name"})) {
						${"rg_file{$fi}_name"} = '';
					}
				}
				
				if(@copy($file[tmp_name], $bbs_data_path.$file[server_name])) {
					${"rg_file{$fi}_name"} = $idx.'$'.$fi.'$'.$file[name];
				} else {
				  // 일부 계정에서 업로드된 파일이 복사 안될경우 시도한다.
					// 2003-10-15
					if(@move_uploaded_file($file[tmp_name], $bbs_data_path.$file[server_name])) {
						${"rg_file{$fi}_name"} = $idx.'$'.$fi.'$'.$file[name];
					} else {
						${"rg_file{$fi}_name"} = '';
					}
				}

				// -- copy END -- 
			}
		}
		if($rg_file1_name){
			$dbqry="
				UPDATE `tblpopup` SET
					`file1` = '$rg_file1_name'
				WHERE idx='$idx'
			";
			query($dbqry,$dbcon);
		}

		rg_href("popup_list.php?$p_str");
	}
	if($mode=='edit') {
		$dbqry = "
				SELECT *
				FROM `tblpopup` where idx = '$idx'
					";

		$rs = query($dbqry, $dbcon);
		$R=mysql_fetch_array($rs);
		mysql_free_result($rs);	
		$idx = $R[idx];
		$rg_file1_name = $R[file1];
		$memo=$R[memo];
	}
	if($mode!='edit') {

	}
?>
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<script language="JavaScript" type="text/JavaScript">
	function all_checked(form_name,checkbox_name,chk)
	{
		eval('var f = document.'+form_name);

		for (var i=0; i<f.length; i++) { 
			if (f.elements[i].name == checkbox_name) { 
				f.elements[i].checked = chk;
			}
		}
	}
	function editor_wr_ok(){
		var  memo = ed.getHtml(); //대체한 textarea에 작성한HTML값 전달
		if(memo=="")
		{
			alert("내용을 적어주세요!");
			ed.focus();
			return false;
		}
	}
</script>
<script src="../../bbs/editor/easyEditor.js"></script>
<br>
<table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
  <tr> 
    <td width="796" height="30" align="center" bgcolor="#F7F7F7"> <font color="#404040">팝업 설정</font></td>
  </tr>
</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td style="padding-top:15px;padding-left:20px;padding-right:20px;padding-bottom:20px;">
                  <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr> 
                      <td height="8" background="/admin/images/linebg.gif"></td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
					<form name=form_write action="" method="post" enctype="multipart/form-data" onSubmit="return editor_wr_ok();">
					<input type="hidden" name="mode" value="<?=$mode?>">
					<input type="hidden" name="act" value="ok">
                    <tr> 
                      <td> 
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td> 
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td height="2" colspan="4" bgcolor="dcdcdc"></td>
                                  </tr>
                                  <tr> 
                                    <td width="20%" height="28" bgcolor="eeeeee" align="center"> 
                                      <strong>제 목</strong></td>
                                    <td colspan="3" height="28" bgcolor="#FFFFFF" style=padding-left:10px;> 
                                      <input type="text" size=40 name=title class=b maxlength="50" value="<?=$R[title]?>">
                                      &nbsp;(※50자이내,팝업창 구분위한 입력값)</td>
                                  </tr>
                                  <tr> 
                                    <td height="1" colspan="4" bgcolor="dcdcdc"></td>
                                  </tr>
                                  <tr> 
                                    <td width="20%" height="28" bgcolor="eeeeee" align="center"> 
                                      <strong>띄우기</strong></td>
                                    <td colspan="3" height="28" bgcolor="#FFFFFF" style=padding-left:10px;> 
                                      <input type="radio" name="visible" value="1" style="border:0" <? echo $R[visible] ? "checked" : "";?>>
                                      띄우기&nbsp;&nbsp; 
                                      <input type="radio" name="visible" value="0" style="border:0" <? echo !$R[visible] ? "checked" : "";?>>
                                      띄우지않음 &nbsp;&nbsp;<font class=small04><font color=red>※ 
                                      팝업창을 띄울것인지 체크</font><br>
                                      ("띄우지않음"으로 등록하시고, 내용확인 후 "띄우기"로 수정하시는게 좋습니다. 
                                      )</font> </td>
                                  </tr>
                                  <tr> 
                                    <td height="1" colspan="4" bgcolor="dcdcdc"></td>
                                  </tr>
                                  <tr> 
                                    <td width="20%" height="28" bgcolor="eeeeee" align="center"> 
                                      <strong>팝업창 타이틀</strong></td>
                                    <td colspan="3" height="28" bgcolor="#FFFFFF" style=padding-left:10px;> 
                                      <input type="text" size=40 name=subject maxlength="70" value="<?=$R[subject]?>">
                                      &nbsp;(※팝업창의 제목바에 나타납니다.)</td>
                                  </tr>
                                  <tr> 
                                    <td height="1" colspan="4" bgcolor="dcdcdc"></td>
                                  </tr>
                                  <tr> 
                                    <td width="20%" height="28" bgcolor="eeeeee" align="center"> 
                                      <strong>팝업</strong><strong>창 크기</strong></td>
                                    <td colspan="3" height="28" bgcolor="#FFFFFF" style=padding-left:10px;> 
                                      넓이 : 
                                      <input type="text" name=width size=3 maxlength=3 class=b value="<?=$R[width]?>">
                                      &nbsp;px&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;높이 
                                      : 
                                      <input type="text" name=height size=3 maxlength=3 class=b value="<?=$R[height]?>">
                                      &nbsp;px &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(※숫자만 
                                      입력) </td>
                                  </tr>
                                  <tr> 
                                    <td height="1" colspan="4" bgcolor="dcdcdc"></td>
                                  </tr>
                                  <tr> 
                                    <td width="20%" height="28" bgcolor="eeeeee" align="center"> 
                                      <strong>팝업창 위치</strong></td>
                                    <td colspan="3" height="28" bgcolor="#FFFFFF" style=padding-left:10px;> 
                                      상단에서 : 
                                      <input type="text" name="top" size=3 maxlength=3 class=b value="<?=$R[location_top]?>">
                                      &nbsp;px&nbsp;&nbsp;&nbsp;&nbsp;왼쪽에서 : 
                                      <input type="text" name="left" size=3 maxlength=3 class=b value="<?=$R[location_left]?>">
                                      &nbsp;px &nbsp;&nbsp;(※숫자만 입력) </td>
                                  </tr>
                                  <tr> 
                                    <td height="1" colspan="4" bgcolor="dcdcdc"></td>
                                  </tr>
                                  <tr> 
                                    <td width="20%" height="28" bgcolor="eeeeee" align="center"> 
                                      <strong>쿠키허용 여부</strong></td>
                                    <td colspan="3" height="28" bgcolor="#FFFFFF" style=padding-left:10px;> 
                                      <input type="radio" name="cookie" value="1" style="border:0" <? echo $R[cookie] ? "checked" : "";?>>
                                      예&nbsp;&nbsp; 
                                      <input type="radio" name="cookie" value="0" style="border:0" <? echo !$R[cookie] ? "checked" : "";?>>
                                      아니요&nbsp;(※오늘 하루 팝업창 열지 않음 표시 여부) </td>
                                  </tr>
                                  <tr> 
                                    <td height="1" colspan="4" bgcolor="dcdcdc"></td>
                                  </tr>
                                </table>
                                <br>
								※ 배경이미지 - 팝업창의 백그라운드 이미지<BR>
								&nbsp;&nbsp;&nbsp;&nbsp;첨부이미지 - HTML작성시, 팝업창에 이미지나 파일을 올릴 때 FTP프로그램없이 바로 등록하는 기능
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td height="1" colspan="4" bgcolor="dcdcdc"></td>
                                  </tr>
                                  <tr> 
                                    <td width="20%" height="28" bgcolor="eeeeee" align="center"> 
                                      <strong>배경 이미지</strong></td>
                                    <td colspan="3" height="28" bgcolor="#FFFFFF" style=padding-left:10px;> 
                                      <input type="file" name="rg_file1" size="55">
                                      <br>
                                      (※TEXT형식으로 구성하실때 백그라운드이미지로 사용할 수 있습니다.)
<? if($R[file1]) {?>
									  <br>
									  <input type="checkbox" name="del_file1" value="1"> 삭제 (<?=$R[file1]?>)
<? } ?>
                                    </td>
                                  </tr>
								  
                                  <tr> 
                                    <td height="1" colspan="4" bgcolor="dcdcdc"></td>
                                  </tr>
                                  <tr> 
                                    <td width="20%" height="28" bgcolor="eeeeee" align="center"> 
                                      <strong>내 용</strong></td>
                                    <td colspan="3" height="28" bgcolor="#FFFFFF" style=padding-left:10px;> 
<? if($mode == "edit"){ ?>
										<table border="0" cellspacing="0" cellpadding="0">
										  <tr> 
											<td background="../editor/upload/<?=$R[file1]?>" align="center" valign="top"> 
											  <table height="<?=$R[height]?>" width="<?=$R[width]?>"  border="0" cellspacing="0" cellpadding="0">
												<tr> 
												  <td valign="top"><?=$R[memo]?></td>
												</tr>
											  </table>
											</td>
										  </tr>
										  <tr> 
											<td height="30" bgcolor="ECECEC"> 
											  <table width="100%" border="0" cellpadding="0" cellspacing="0">
												<tr> 
												  <td align="right"> 
													<?if ($R[cookie] == 1) {?>
													<span class="unnamed1"> 오늘은 그만열기</span> 
													<input type="checkbox" name="checkbox" value="checkbox" style="border:0">
													<?}?>
													&nbsp;&nbsp;&nbsp;</td>
												</tr>
											  </table>
											</td>
										  </tr>
										</table>
<? } ?>
                                     <textarea name="memo" class="input_01" id="memo"><?=$memo?></textarea>
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="1" colspan="4" bgcolor="dcdcdc"></td>
                                  </tr>
                                </table>
                              </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td align="center"><input type="submit" name="Submit2" value=" 확     인 " style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"><!--  
						<input type="image" src="/admin/images/bt_004.gif" align="absbottom" style="border:0"> 
                        &nbsp;<img src="/admin/images/bt_003.gif" align="absbottom" onClick="document.regfrm.reset();document.regfrm.title.focus()" style="cursor:hand" name="Submit2">
						&nbsp;<img src="/admin/images/bt_012.gif" border="0" align="absbottom" style="cursor:hand" onClick="javascript:location.href='list.asp';" name="backbutton"> -->
                      </td>
                    </tr>
					</form>
                  </table>
                </td>
              </tr>
            </table>
			<script>
		var ed = new easyEditor("memo"); //초기화 id속성값
		ed.init(); //웹에디터 삽입
</script>
<? include("admin.footer.php"); ?>
