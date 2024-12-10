<table width=100% align=center border=0 cellpadding=1 cellspacing=1 bgcolor="#cccccc">
  <col width=80 align=center></col>
  <col width=''></col>
  <tr bgcolor="#ffffff"> 
    <td colspan=2> <table width=100% cellpadding=1 cellspacing=1 class=tablebg>
        <tr> 
          <td align=center height=30 class=subjectbg><span class=subject> 
            <?=$html_subject?>
            </span></td>
        </tr>
      </table></td>
  </tr>
  <tr bgcolor="#ffffff"> 
    <td width=120><span class=subject> 아이디</span></td>
    <td valign=top> 
      <?=$mb_id?>
    </td>
  </tr>
  <?=$show_nick_begin?>
  <tr bgcolor="#ffffff"> 
    <td><span class=subject> 
      <?=($need_nick)?'*':''?>
      닉네임</span></td>
    <td>
      <?=$mb_nick?>
    </td>
  </tr>
  <?=$show_nick_end?>
  <?=$show_name_begin?>
  <tr bgcolor="#ffffff"> 
    <td><span class=subject> 이름</span></td>
    <td>
      <?=$mb_name?>
    </td>
  </tr>
  <?=$show_name_end?>
  <?=$show_email_begin?>
  <tr bgcolor="#ffffff"> 
    <td><span class=subject> e-mail</span></td>
    <td>
      <?=$mb_email?>
    </td>
  </tr>
  <?=$show_email_end?>
  <?=$show_homepage_begin?>
  <tr bgcolor="#ffffff"> 
    <td><span class=subject> 홈페이지</span></td>
    <td>
      <?=$mb_homepage?>
    </td>
  </tr>
  <?=$show_homepage_end?>
  <?=$show_tel_begin?>
  <tr bgcolor="#ffffff"> 
    <td><span class=subject> 
      <?=($need_tel)?'*':''?>
      전화번호</span></td>
    <td>
      <?=$mb_tel?>
    </td>
  </tr>
  <?=$show_tel_end?>
  <?=$show_mobile_begin?>
  <tr bgcolor="#ffffff"> 
    <td><span class=subject> 
      <?=($need_mobile)?'*':''?>
      핸드폰번호</span></td>
    <td>
      <?=$mb_mobile?>
    </td>
  </tr>
  <?=$show_mobile_end?>
  <?=$show_address_begin?>
  <tr bgcolor="#ffffff"> 
    <td><span class=subject>우편번호</span></td>
    <td>
      <?=$mb_post?>
    </td>
  </tr>
  <tr bgcolor="#ffffff"> 
    <td><span class=subject> 주소</span></td>
    <td>
      <?=$mb_address1?>
      <br> 
      <?=$mb_address2?>
      </td>
  </tr>
  <?=$show_address_end?>
  <?=$show_birth_begin?>
  <tr bgcolor="#ffffff"> 
    <td><span class=subject> 생일</span></td>
    <td>
      <?=$mb_birth?>
      예) 1972년 9월 1일인 경우 19720901</td>
  </tr>
  <?=$show_birth_end?>
  <?=$show_sex_begin?>
  <tr bgcolor="#ffffff"> 
    <td><span class=subject> 성별</span></td>
    <td>
      <?=$mb_sex?>
    </td>
  </tr>
  <?=$show_sex_end?>
  <?=$show_job_begin?>
  <tr bgcolor="#ffffff"> 
    <td><span class=subject> 직업</span></td>
    <td>
      <?=$mb_job?>
    </td>
  </tr>
  <?=$show_job_end?>
  <?=$show_hobby_begin?>
  <tr bgcolor="#ffffff"> 
    <td><span class=subject> 취미</span></td>
    <td>
      <?=$mb_hobby?>
    </td>
  </tr>
  <?=$show_hobby_end?>
  <?=$show_signature_begin?>
  <tr bgcolor="#ffffff"> 
    <td><span class=subject> 서명</span></td>
    <td><div id="Layer1" style="width:100%; height:100px; overflow: hidden;word-break:break-all;background-color:#F7F7F7;layer-background-color:#F7F7F7;">
<p style="margin:5;"><?=$mb_signature?></div>
</div></td>
  </tr>
  <?=$show_signature_end?>
  <?=$show_photo_begin?>
  <tr bgcolor="#ffffff"> 
    <td><span class=subject>회원 사진</span></td>
    <td> 
      <?=$mb_photo_view?>
    </td>
  </tr>
  <?=$show_photo_end?>
  <?=$show_icon_begin?>
  <tr bgcolor="#ffffff"> 
    <td><span class=subject>회원 아이콘</span></td>
    <td> 
      <?=$mb_icon_view?>
    </td>
  </tr>
  <?=$show_icon_end?>
  <tr bgcolor="#ffffff"> 
    <td><span class=subject>회원등급 </span></td>
    <td> 
      <?=$mb_level?>
    </td>
  </tr>
  <tr bgcolor="#ffffff"> 
    <td><span class=subject>회원상태 </span></td>
    <td> 
     <?=$mb_states[$mb_state]?>
    </td>
  </tr>
  <tr bgcolor="#ffffff"> 
    <td><span class=subject> 자기소개</span></td>
    <td><div id="Layer2" style="width:100%; height:100px; overflow: hidden;word-break:break-all;background-color:#F7F7F7;layer-background-color:#F7F7F7;">
<p style="margin:5;"><?=$mb_greet?></div></td>
  </tr>
  <?=$show_ext7_begin?>
  <tr> 
    <td><span class=subject> 
      <?=$show_ext7_title?>
      </span></td>
    <td> 
      <?=$mb_ext7?>
    </td>
  </tr>
  <?=$show_ext7_end?>
  <?=$show_ext8_begin?>
  <tr> 
    <td><span class=subject> 
      <?=$show_ext8_title?>
      </span></td>
    <td> 
      <?=$mb_ext8?>
    </td>
  </tr>
  <?=$show_ext8_end?>
  <?=$show_ext9_begin?>
  <tr> 
    <td><span class=subject> 
      <?=$show_ext9_title?>
      </span></td>
    <td> 
      <?=$mb_ext9?>
    </td>
  </tr>
  <?=$show_ext9_end?>
  <?=$show_ext10_begin?>
  <tr> 
    <td><span class=subject> 
      <?=$show_ext10_title?>
      </span></td>
    <td> 
      <?=$mb_ext10?>
    </td>
  </tr>
  <?=$show_ext10_end?>
</table>
<div align=center>
  <a href="#" onclick="javascript:window.close();">닫기</a>
</div>
<SCRIPT LANGUAGE="JavaScript">
<!--
	window.print();
//-->
</SCRIPT>