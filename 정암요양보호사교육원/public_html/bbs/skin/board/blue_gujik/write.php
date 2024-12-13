<?
/******************************************************************
 ★ 파일설명 ★ 
목록하단

 ★ 스킨 제작을 위한 변수 설명 ★ 

<?=$width?> 					테이블의 넓이
<?=$skin_board_url?>	스킨 URL
<?=$site_url?>				사이트 URL
<?=$bbs_id?>					게시판 아이디

<?=$u_action?>				글쓰기 URL
<?=$old_password?>		수정시 기존 암호
<?=$a_list?>					글목록 링크

<?=$show_notice_begin?>공지사항체크<?=$show_notice_end?>
<?=$checked_notice?>	공지사항체크여부

<?=$show_secret_begin?>비밀글체크<?=$show_secret_end?>
<?=$checked_secret?>	비밀글체크여부

<?=$show_reply_mail_begin?>응답글메일로받기여부<?=$show_reply_mail_end?>
<?=$checked_reply_mail?>	응답글체크여부

<?=$show_name_begin?>이름입력<?=$show_name_end?>
<?=$rg_name?>					이름

<?=$show_password_begin?>암호입력<?=$show_password_end?>
<?=(!$mode_edit)?'required':''?>	글수정모드가 아니라면 필수입력

<?=$show_email_begin?>메일입력<?=$show_email_end?>
<?=$rg_email?>				메일

<?=$show_home_url_begin?>홈페이지입력<?=$show_home_url_end?>
<?=$rg_home_url?>			홈체이지

<?=$show_category_begin?>카테고리선택<?=$show_category_end?>
<?=$category_list_option?>	카테고리목록

<?=$show_html_begin?>	html 형태선택<?=$show_html_end?>
<?=$checked_html_use0?>	일반글체크
<?=$checked_html_use1?>	html체크
<?=$checked_html_use2?>	html+<br>체크

<?=$rg_title?>				제목
<?=$rg_content?>			내용
<?=$show_link_begin?>	링크입력폼<?=$show_link_end?>
<?=$rg_link1_url?>		링크#1
<?=$rg_link2_url?>		링크#2

<?=$show_upload_begin?>업로드폼<?=$show_upload_end?>

<?=$show_file1_delete_begin?>파일삭제<?=$show_file1_delete_end?>
<?=$rg_file1_name?>		파일명
(1~2)

<?=$show_file1_size_begin?>최대업로드용량<?=$show_file1_size_end?>
<?=$upload_file1_size?>	최대업로드용량

<?=$show_file1_ext_begin?>업로드확장자<?=$show_file1_ext_end?>
<?=$upload_file1_ext?>	업로드확장자
<?=($upload_file1_able)?'가능':'불가능'?>	업로드 가능여부

<?=$show_ext1_begin?>추가항목1<?=$show_ext1_end?>
<?=$show_ext1_title?>	추가항목명
<?=$show_ext1_input?>	추가항목입력폼
(1~5)

******************************************************************/
?>
<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>"  border=0>
<form name=form_write method=post action='<?=$u_action?>' enctype='multipart/form-data'>
<input type=hidden name=act value='ok'>
<input type=hidden name=old_password value='<?=$old_password?>'>

          <tr>
            <td width="50">&nbsp;</td>
            <td align="center">
			<!--////////////////////// 구직신청폼시작 //////////////////////////////////-->
			<table width="100%" border="0" cellspacing="0" cellpadding="0">


              <tr>
                <td height="40"><table width="100%" border="0" cellpadding="6" cellspacing="1" bgcolor="#D3CEC0">
                    <tr>
                      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="40"><strong><font color="#CC0000">※등록한 신청서는 다른 사람에게는 공개되지 않으며 관리자만 볼 수 있습니다.</font></strong></td>
                        </tr>
                      </table>
                        <table width="100%" border="1" cellpadding="5" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#B5B4A6">
                          <tr>
                            <td width="20%" align="center" bgcolor="#EDECE9"><font color="#5B5A55">이름</font></td>
                            <td width="80%" colspan="2" bgcolor="#FFFFFF"><input name="rg_name" type="text" class="bbs" size="30" value="<?=$rg_name?>" required itemname="이름"></td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">성별</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><input name="rg_ext1" type="radio" value="남" <? if($rg_ext1=="남"){echo "checked";}else if(!$rg_ext1){echo "checked";}?>>
                              남
                                <input name="rg_ext1" type="radio" value="여"  <? if($rg_ext1=="여"){echo "checked";}?>>
                                여</td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">나이</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><input name="rg_ext2" type="text" class="bbs" size="4" value="<?=$rg_ext2?>"></td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">주소</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><input name="rg_ext3" type="text" class="bbs" size="75" value="<?=$rg_ext3?>" required itemname="주소"></td>
                            </tr>

                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">보유자격증</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><input name="rg_title" type="radio" value="요양보호사" <? if($rg_title=="요양보호사"){echo "checked";}else if(!$rg_title){echo "checked";}?>>
                              요양보호사
                              <input name="rg_title" type="radio" value="사회복지사" <? if($rg_title=="사회복지사"){echo "checked";}?>>
                              사회복지사
                              <input name="rg_title" type="radio" value="간호사" <? if($rg_title=="간호사"){echo "checked";}?>>
                              간호사
                              <input name="rg_title" type="radio" value="간호조무사" <? if($rg_title=="간호조무사"){echo "checked";}?>>
                              간호조무사
                              <input name="rg_title" type="radio" value="물리치료사" <? if($rg_title=="물리치료사"){echo "checked";}?>>
                              물리치료사 </td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">희망근무지역</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><input name="rg_ext4" type="text" class="bbs" value="<?=$rg_ext4?>" size="15">구
							<input name="rg_ext5" type="text" class="bbs" value="<?=$rg_ext5?>" size="15">동

                              <input name="rg_ext6" type="checkbox" value="지역상관없음" <? if($rg_ext6){echo "checked";}?>>지역상관 없음</td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">희망근무직종</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><input name="rg_ext7" type="radio" value="요양보호사" <? if($rg_ext7=="요양보호사"){echo "checked";}else if(!$rg_ext7){echo "checked";}?>>
                              요양보호사       
                                <input name="rg_ext7" type="radio" value="사회복지사" <? if($rg_ext7=="사회복지사"){echo "checked";}?>>
                                사회복지사        
                                <input name="rg_ext7" type="radio" value="간호사" <? if($rg_ext7=="간호사"){echo "checked";}?>>
                                간호사  
                                <br>
                                <input name="rg_ext7" type="radio" value="간호조무사" <? if($rg_ext7=="간호조무사"){echo "checked";}?>>
                                간호조무사       
                                <input name="rg_ext7" type="radio" value="물리치료사" <? if($rg_ext7=="물리치료사"){echo "checked";}?>>
                                물리치료사        
                                <input name="rg_ext7" type="radio" value="직종상관 없음" <? if($rg_ext7=="직종상관 없음"){echo "checked";}?>>
                                직종상관 없음</td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">희망근무처</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><input name="rg_ext8" type="radio" value="요양시설(요양원)" <? if($rg_ext8=="요양시설(요양원)"){echo "checked";}else if(!$rg_ext8){echo "checked";}?>>
                              요양시설(요양원)  
                                <input name="rg_ext8" type="radio" value="노인요양병원" <? if($rg_ext8=="노인요양병원"){echo "checked";}?>>
                                노인요양병원       
                                <input name="rg_ext8" type="radio" value="방문요양" <? if($rg_ext8=="방문요양"){echo "checked";}?>>
                                방문요양<br>
                                <input name="rg_ext8" type="radio" value="주야간보호" <? if($rg_ext8=="주야간보호"){echo "checked";}?>>
                                주야간보호        
                                <input name="rg_ext8" type="radio" value="아무 곳이나 괜찮다" <? if($rg_ext8=="아무 곳이나 괜찮다"){echo "checked";}?>>
                                아무 곳이나 괜찮다</td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">경력</font></td>
                            <td bgcolor="#FFFFFF"><input name="rg_ext9" type="radio" value="없음" <? if($rg_ext9=="없음"){echo "checked";}else if(!$rg_ext9){echo "checked";}?>>
                              없음              
                                <input name="rg_ext9" type="radio" value="radiobutton"  <? if($rg_ext9=="있음"){echo "checked";}?>>
                                있음【근무처(              
                                <input name="rg_ext10" type="text" class="bbs" size="15" value="<?=$rg_ext10?>">
                                ),      
                                <input name="rg_ext11" type="text" class="bbs" size="4" value="<?=$rg_ext11?>">
                                년   
                                <input name="rg_ext12" type="text" class="bbs" size="4" value="<?=$rg_ext12?>">
                                개월】</td>
                            </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">근무가능시기 </font></td>
                            <td colspan="2" bgcolor="#FFFFFF">
							<input name="rg_ext13" type="text" class="bbs" size="4" value="<?=$rg_ext13?>">년  
							<input name="rg_ext14" type="text" class="bbs" size="4" value="<?=$rg_ext14?>">월  
							<input name="rg_ext15" type="text" class="bbs" size="4" value="<?=$rg_ext15?>">일 부터 가능함</td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">최종학력 </font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><input name="rg_ext16" type="text" class="bbs" size="15" value="<?=$rg_ext16?>"></td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">전공</font></td>
                            <td colspan="2" bgcolor="#FFFFFF"><input name="rg_ext17" type="text" class="bbs" size="30" value="<?=$rg_ext17?>"></td>
                          </tr>
                          <tr>
                            <td align="center" bgcolor="#EDECE9"><font color="#5B5A55">연락처</font></td>
                            <td colspan="2" bgcolor="#FFFFFF">일반전화
                              <input name="rg_ext18" type="text" class="bbs" size="20" value="<?=$rg_ext18?>"> 
                              휴대폰
                              <input name="rg_ext19" type="text" class="bbs" size="20" value="<?=$rg_ext19?>"></td>
                          </tr>
                          

                          <tr>
                            <td height="36" align="center" bgcolor="#EDECE9"><font color="#5B5A55">남기고 싶은 말이나 간단한 본인 소개</font></td>
							<?
								if(!$rg_content){
									$rg_content="본인 소개를 입력하십시오";
								}
							?>
                            <td colspan="2" bgcolor="#FFFFFF"><textarea name="rg_content" cols="70" rows="8" onfocus="if(this.value=='본인 소개를 입력하십시오'){this.value='';}" onblur="if(!this.value){this.value='본인 소개를 입력하십시오';}"><?=$rg_content?></textarea></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="67" align="center">
							<?
								if($_SESSION[ss_mb_id]=="admin"){
							?>
								<a href="./list.php?bbs_id=<?=$bbs_id?>">
								<img src="<?=$skin_board_url?>images/list2.gif" alt="목록 보기">
								</a>
							<? }?>
							<input name="image" type="image" src="../images/btn_ok.gif" width="95" height="44">
                              &nbsp;<img src="../images/btn_ce.gif" width="95" height="44" onClick="javascript:reset();" style="cursor:hand;"></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    <p> <BR>
                  </p></td>
              </tr>


            </table>
			<!--///////////////////// 구직신청 폼 끝 ///////////////////////////////////-->
			
			</td>
            <td width="20">&nbsp;</td>
          </tr>
		  </form>

        </table>


