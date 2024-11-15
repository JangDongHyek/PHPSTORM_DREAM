<link href="<?=$skin_site_url?>css/style.css" rel="stylesheet" type="text/css">
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
<form name=mb_form method=post action='' onsubmit='return formcheck()' enctype='multipart/form-data' autocomplete=off>
<input type=hidden name=act value='ok'>
<input type=hidden name=url value='<?=$url?>'>
  <tr> 
    <td height="50"><img src="<?=$skin_site_url?>images/title_join.gif" width="275" height="25"></td>
  </tr>
  <tr> 
    <td><table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td><img src="<?=$skin_site_url?>images/bar_01.gif" width="500" height="10"></td>
        </tr>
        <tr> 
          <td background="<?=$skin_site_url?>images/bar_02.gif"><table width=430 align=center border=0 cellpadding=5 cellspacing=0>
              <input type=hidden name=act value='ok'>
              <input type=hidden name=url value='<?=$url?>'>
              <tr> 
                <td colspan=2> <table width=100% cellpadding=3 cellspacing=1 class=tablebg>
                    <tr> 
                      <td align=center height=30 class=subjectbg><span class=subject> 
                        <?=$html_subject?>
                        </span></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td width="100"><span class=subject> 
                  <?=($need_id)?'*':''?>
                  아이디</span></td>
                <td valign=top> 
                  <?=$show_join_begin?>
                  <input type=text class=input_01 name='mb_id' size=20 maxlength=20 minlength=2 itemname='아이디' value='' required> 
                  <img src="<?=$skin_site_url?>images/btn_check.gif" width="64" height="16" onclick="popup_id('mb_form', './', 'mb_id', mb_form.mb_id)" style="cursor:hand;"> 
                  <?=$show_join_end?>
                  <?=$show_edit_begin?>
                  <?=$mb_id?>
                  <?=$show_edit_end?>
                </td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <tr> 
                <td><span class=subject> 
                  <?=($need_password)?'*':''?>
                  암호</span></td>
                <td> 
                  <?=$show_insert_begin?>
                  <input name='mb_password' type=password class=input_01 id="mb_password" size=20 maxlength=20 <?=($need_password)?'required':''?> itemname='암호'> 
                  <?=$show_insert_end?><br>
                  
                  <input type=password class=input_01 name='mb_passwd' size=20 maxlength=20 <?=($need_password)?'required':''?> itemname='암호'> 
                </td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <?=$show_nick_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=($need_nick)?'*':''?>
                  닉네임</span></td>
                <td><input name='mb_nick' type=text class=input_01 id="mb_nick" value='<?=$mb_nick?>' size=20 maxlength=20 minlength=2 <?=($need_nick)?'required':''?> itemname='닉네임'> 
                  <img src="<?=$skin_site_url?>images/btn_check.gif" width="64" height="16" onclick="popup_nick('mb_form', './', 'mb_nick', mb_form.mb_nick)" style="cursor:hand;"> </td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <?=$show_nick_end?>
              <?=$show_name_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=($need_name)?'*':''?>
                  이름</span></td>
                <td><input type=text class=input_01 name='mb_name' size=20 maxlength=20 minlength=2  <?=($need_name)?'required':''?> itemname='이름' value='<?=$mb_name?>'> 
                </td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <?=$show_name_end?>
              <?=$show_tel_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=($need_tel)?'*':''?>
                  전화번호</span></td>
                <td> <select name="mb_tel[0]" <?=($need_tel)?'required':''?> itemname='전화번호'>
                    <option value=''>선택 
                    <?=rg_html_option($mb_tel_list,'','',$mb_tel[0])?>
                  </select>
                  - 
                  <input type=text class=input_01 name='mb_tel[1]' size=5 maxlength=4 <?=($need_tel)?'required':''?> itemname='전화번호' value='<?=$mb_tel[1]?>'>
                  - 
                  <input type=text class=input_01 name='mb_tel[2]' size=5 maxlength=4 <?=($need_tel)?'required':''?> itemname='전화번호' value='<?=$mb_tel[2]?>'> 
                </td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <?=$show_tel_end?>
              <?=$show_mobile_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=($need_mobile)?'*':''?>
                  핸드폰번호</span></td>
                <td> <select name="mb_mobile[0]" <?=($need_mobile)?'required':''?> itemname='핸드폰번호'>
                    <option value=''>선택 
                    <?=rg_html_option($mb_mobile_list,'','',$mb_mobile[0])?>
                  </select>
                  - 
                  <input name='mb_mobile[1]' type=text class=input_01 value='<?=$mb_mobile[1]?>' size=5 maxlength=4 <?=($need_mobile)?'required':''?> itemname='핸드폰번호'>
                  - 
                  <input name='mb_mobile[2]' type=text class=input_01 value='<?=$mb_mobile[2]?>' size=5 maxlength=4 <?=($need_mobile)?'required':''?> itemname='핸드폰번호'> 
                </td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <?=$show_mobile_end?>
              <?=$show_email_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=($need_email)?'*':''?>
                  e-mail</span></td>
                <td><input type=text class=input_01 name='mb_email' size=40 maxlength=100 email <?=($need_email)?'required':''?> itemname='e-mail' value='<?=$mb_email?>'></td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <?=$show_email_end?>
              <?=$show_homepage_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=($need_homepage)?'*':''?>
                  홈페이지</span></td>
                <td><input type=text class=input_01 name='mb_homepage' size=40 maxlength=255 <?=($need_homepage)?'required':''?> itemname='홈페이지' value='<?=$mb_homepage?>'> 
                </td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <?=$show_homepage_end?>
              <?=$show_jumin_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=($need_jumin)?'*':''?>
                  주민등록번호</span></td>
                <td><input type=text class=input_01 name='mb_jumin1' size=7 maxlength=6 minlength=6 <?=($need_jumin)?'required':''?> itemname='주민등록번호 앞자리' onkeyup='if (this.value.length >= 6) this.form.mb_jumin2.focus();'>
                  - 
                  <input type=password class=input_01 name='mb_jumin2' size=8 maxlength=7 minlength=7 <?=($need_jumin)?'required':''?> itemname='주민등록번호 뒷자리'> 
                  <br>
                  <span class="small_txt"><font color="1D8FD1">암호화하여 저장되므로 자료 
                  유출시 안심할 수 있습니다.</font></span></td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <?=$show_jumin_end?>
              <?=$show_address_begin?>
 <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script>
    function daumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var fullAddr = ''; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수

                // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    fullAddr = data.roadAddress;

                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    fullAddr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
                if(data.userSelectedType === 'R'){
                    //법정동명이 있을 경우 추가한다.
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있을 경우 추가한다.
                    if(data.buildingName !== ''){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById("mb_post").value = data.postcode1 + "-" + data.postcode2;
                document.getElementById("mb_address1").value = fullAddr;

                // 커서를 상세주소 필드로 이동한다.
                document.getElementById("mb_address2").focus();
            }
        }).open();
    }
</script>


              <tr> 
                <td><span class=subject>우편번호</span></td>
                <td><input type=text class=input_01 name='mb_post' id="mb_post" size=8 maxlength=7 readonly <?=($need_address)?'required':''?> itemname='우편번호' value='<?=$mb_post?>'> 
                  <img src="<?=$skin_site_url?>images/btn_search.gif" width="75" height="16" onClick="daumPostcode();" style="cursor:hand;"> </td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <tr> 
                <td><span class=subject> 
                  <?=($need_address)?'*':''?>
                  주소</span></td>
                <td><input name='mb_address1'  type=text class=input_01 id="mb_address1" style='width:99%' value='<?=$mb_address1?>' readonly <?=($need_address)?'required':''?>> 
                  <br> <input name='mb_address2' type=text class=input_01 id="mb_address2" value='<?=$mb_address2?>' size=35 <?=($need_address)?'required':''?> itemname='상세주소'>
                  <span class="small_txt"><font color="1D8FD1">상세주소 입력</font></span></td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <?=$show_address_end?>
              <?=$show_birth_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=($need_birth)?'*':''?>
                  생일</span></td>
                <td><input type=text class=input_01 name=mb_birth size=9 maxlength=8 value='<?=$mb_birth?>' <?=($need_birth)?'required':''?> itemname='생일'>
                  <span class="small_txt"><font color="1D8FD1">예) 1972년 9월 1일인 
                  경우 19720901</font></span></td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <?=$show_birth_end?>
              <?=$show_sex_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=($need_sex)?'*':''?>
                  성별</span></td>
                <td><select name='mb_sex' <?=($need_sex)?'required':''?> itemname='성별'>
                    <option value=''>선택하세요 
                    <?=rg_html_option($mb_sex_list,'','',"$mb_sex")?>
                  </select> </td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <?=$show_sex_end?>
              <?=$show_job_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=($need_job)?'*':''?>
                  직업</span></td>
                <td><input name='mb_job' type=text class=input_01 id="mb_job" value='<?=$mb_job?>' size=21 maxlength=20 <?=($need_job)?'required':''?> itemname='직업'> 
                </td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <?=$show_job_end?>
              <?=$show_hobby_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=($need_hobby)?'*':''?>
                  취미</span></td>
                <td> <input name='mb_hobby' type=text class=input_01 id="mb_hobby" value='<?=$mb_hobby?>' size=21 maxlength=20 <?=($need_hobby)?'required':''?> itemname='취미'> 
                </td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <?=$show_hobby_end?>
              <?=$show_signature_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=($need_signature)?'*':''?>
                  서명</span></td>
                <td><textarea name=mb_signature class=textarea style="width:100%" rows=5 <?=($need_signature)?'required':''?> itemname='서명'><?=$mb_signature?></textarea></td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <?=$show_signature_end?>
              <?=$show_greet_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=($need_greet)?'*':''?>
                  자기소개</span></td>
                <td><textarea name=mb_greet style="width:100%" rows=5 class=textarea id="mb_greet" <?=($need_greet)?'required':''?> itemname='자기소개'><?=$mb_greet?></textarea></td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <?=$show_greet_end?>
              <?=$show_photo_begin?>
              <tr> 
                <td><span class=subject>회원 사진</span></td>
                <td> <input name='mb_photo' type=file class=input_01 id="mb_photo" size=40> 
                  <?=$show_del_photo_begin?>
                  <br>
                  <img src="<?=$skin_site_url?>images/btn_bro.gif" width="64" height="16">
<input name='del_mb_photo' type=checkbox id="del_mb_photo" value='1'>
                  삭제 
                  <?=$show_del_photo_end?>
                  <br> 
                  <?=$mb_photo_view?>
                </td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <?=$show_photo_end?>
              <?=$show_icon_begin?>
              <tr> 
                <td><span class=subject>회원 아이콘</span></td>
                <td> <input type=file name='mb_icon' size=40 class=input_01> <br>
                  <span class="small_txt"><font color="1D8FD1">이미지 크기는 16x16으로 
                  해주세요. 
                  <?=$show_del_icon_begin?>
                  </font></span><br> <input type=checkbox name='del_mb_icon' value='1'>
                  삭제<br> 
                  <?=$mb_icon_view?>
                  <?=$show_del_icon_end?>
                </td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <?=$show_icon_end?>
              <?=$show_edit_begin?>
              <tr> 
                <td><span class=subject>포인트</span></td>
                <td> 
                  <?=$mb_point?>
                </td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <tr> 
                <td><span class=subject>레벨 </span></td>
                <td> 
                  <?=$mb_level?>
                </td>
              </tr>
              <?=$show_edit_end?>
              <?=$show_ext1_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=$show_ext1_title?>
                  </span></td>
                <td> 
                  <?=$show_ext1_input?>
                </td>
              </tr>
              <?=$show_ext1_end?>
              <?=$show_ext2_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=$show_ext2_title?>
                  </span></td>
                <td> 
                  <?=$show_ext2_input?>
                </td>
              </tr>
              <?=$show_ext2_end?>
              <?=$show_ext3_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=$show_ext3_title?>
                  </span></td>
                <td> 
                  <?=$show_ext3_input?>
                </td>
              </tr>
              <?=$show_ext3_end?>
              <?=$show_ext4_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=$show_ext4_title?>
                  </span></td>
                <td> 
                  <?=$show_ext4_input?>
                </td>
              </tr>
              <?=$show_ext4_end?>
              <?=$show_ext5_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=$show_ext5_title?>
                  </span></td>
                <td> 
                  <?=$show_ext5_input?>
                </td>
              </tr>
              <?=$show_ext5_end?>
              <?=$show_ext6_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=$show_ext6_title?>
                  </span></td>
                <td> 
                  <?=$show_ext6_input?>
                </td>
              </tr>
              <?=$show_ext6_end?>
              <?=$show_ext7_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=$show_ext7_title?>
                  </span></td>
                <td> 
                  <?=$show_ext7_input?>
                </td>
              </tr>
              <?=$show_ext7_end?>
              <?=$show_ext8_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=$show_ext8_title?>
                  </span></td>
                <td> 
                  <?=$show_ext8_input?>
                </td>
              </tr>
              <?=$show_ext8_end?>
              <?=$show_ext9_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=$show_ext9_title?>
                  </span></td>
                <td> 
                  <?=$show_ext9_input?>
                </td>
              </tr>
              <?=$show_ext9_end?>
              <?=$show_ext10_begin?>
              <tr> 
                <td><span class=subject> 
                  <?=$show_ext10_title?>
                  </span></td>
                <td> 
                  <?=$show_ext10_input?>
                </td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
              <?=$show_ext10_end?>
              <tr> 
                <td>&nbsp;</td>
                <td> <input name="mb_mailing" type="checkbox" id="mb_mailing" value="1"<?=$checked_mb_mailing?>>
                  메일수신&nbsp; <input name="mb_open_info" type="checkbox" id="mb_open_info" value="1" <?=$checked_mb_open_info?>>
                  정보공개</td>
              </tr>
              <tr bgcolor="eeeeee"> 
                <td height="1" colspan="2"></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td><img src="<?=$skin_site_url?>images/bar_03.gif" width="500" height="10"></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td><input type="image" src="<?=$skin_site_url?>images/btn_join.gif" width="61" height="24" style="border:0px;"></td>
          <td width="10">&nbsp;</td>
          <td><img src="<?=$skin_site_url?>images/btn_cancel.gif" width="61" height="24" onClick="mb_form.reset();mb_form.mb_id.focus();" style="cursor:hand;"></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
</form>
</table>
<script language='Javascript'>
    var f = document.mb_form;
		
		if(typeof(f.mb_id) != 'undefined')
	    f.mb_id.focus();

    // submit 최종 폼체크
    function formcheck() 
    {
        if (typeof(f.mb_jumin1) != 'undefined') {
            var is_jumin = jumin_check(f.mb_jumin1, f.mb_jumin2);
            if (!is_jumin) {
                alert("주민등록번호가 올바르지 않습니다.");
                f.mb_jumin1.focus();
                return false;
            }
        }
				
        if (typeof(f.mb_password) != 'undefined') {
					if (f.mb_password.value != f.mb_passwd.value) {
						alert("암호를 확인하시기 바랍니다.");
						f.mb_passwd.focus();
						return false;
					}
				}

        return true;
    }

    // 회원아이디 검사
    function mb_id_check()
    {
        if (f.mb_id.value == "") {
            alert('회원 아이디를 입력하세요.');
            f.mb_id.focus();
            return false;
        }

        window.open('<?=$abs_uri?>mbidcheck.php?mb_id='+f.mb_id.value, 'mbidcheck', 'left=0,top=10000,width=1,height=1');
    }
</script>
