<table width=100% align=center border=0 cellpadding=3 cellspacing=1>
  <col width=80 align=center></col>
  <col width=''></col>
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
    <td width=80><span class=subject> ���̵�</span></td>
    <td valign=top> 
      <?=$mb_id?>
    </td>
  </tr>
  <?=$show_nick_begin?>
  <tr> 
    <td><span class=subject> 
      <?=($need_nick)?'*':''?>
      �г���</span></td>
    <td>
      <?=$mb_nick?>
    </td>
  </tr>
  <?=$show_nick_end?>
  <?=$show_name_begin?>
  <tr> 
    <td><span class=subject> �̸�</span></td>
    <td>
      <?=$mb_name?>
    </td>
  </tr>
  <?=$show_name_end?>
  <?=$show_email_begin?>
  <tr> 
    <td><span class=subject> e-mail</span></td>
    <td>
      <?=$mb_email?>
    </td>
  </tr>
  <?=$show_email_end?>
  <?=$show_homepage_begin?>
  <tr> 
    <td><span class=subject> Ȩ������</span></td>
    <td>
      <?=$mb_homepage?>
    </td>
  </tr>
  <?=$show_homepage_end?>
  <?=$show_tel_begin?>
  <tr> 
    <td><span class=subject> 
      <?=($need_tel)?'*':''?>
      ��ȭ��ȣ</span></td>
    <td>
      <?=$mb_tel?>
    </td>
  </tr>
  <?=$show_tel_end?>
  <?=$show_mobile_begin?>
  <tr> 
    <td><span class=subject> 
      <?=($need_mobile)?'*':''?>
      �ڵ�����ȣ</span></td>
    <td>
      <?=$mb_mobile?>
    </td>
  </tr>
  <?=$show_mobile_end?>
  <?=$show_address_begin?>
  <tr> 
    <td><span class=subject>�����ȣ</span></td>
    <td>
      <?=$mb_zip?>
    </td>
  </tr>
  <tr> 
    <td><span class=subject> �ּ�</span></td>
    <td>
      <?=$mb_address1?>
      <br> 
      <?=$mb_address2?>
      ���ּ� �Է�</td>
  </tr>
  <?=$show_address_end?>
  <?=$show_birth_begin?>
  <tr> 
    <td><span class=subject> ����</span></td>
    <td>
      <?=$mb_birth?>
      ��) 1972�� 9�� 1���� ��� 19720901</td>
  </tr>
  <?=$show_birth_end?>
  <?=$show_sex_begin?>
  <tr> 
    <td><span class=subject> ����</span></td>
    <td>
      <?=$mb_sex?>
    </td>
  </tr>
  <?=$show_sex_end?>
  <?=$show_job_begin?>
  <tr> 
    <td><span class=subject> ����</span></td>
    <td>
      <?=$mb_job?>
    </td>
  </tr>
  <?=$show_job_end?>
  <?=$show_hobby_begin?>
  <tr> 
    <td><span class=subject> ���</span></td>
    <td>
      <?=$mb_hobby?>
    </td>
  </tr>
  <?=$show_hobby_end?>
  <?=$show_signature_begin?>
  <tr> 
    <td><span class=subject> ����</span></td>
    <td><div id="Layer1" style="width:100%; height:100px; overflow: hidden;word-break:break-all;background-color:#F7F7F7;layer-background-color:#F7F7F7;">
<p style="margin:5;"><?=$mb_signature?></div>
</div></td>
  </tr>
  <?=$show_signature_end?>
  <?=$show_greet_begin?>
  <tr> 
    <td><span class=subject> �ڱ�Ұ�</span></td>
    <td><div id="Layer2" style="width:100%; height:100px; overflow: hidden;word-break:break-all;background-color:#F7F7F7;layer-background-color:#F7F7F7;">
<p style="margin:5;"><?=$mb_greet?></div></td>
  </tr>
  <?=$show_greet_end?>
  <?=$show_photo_begin?>
  <tr> 
    <td><span class=subject>ȸ�� ����</span></td>
    <td> 
      <?=$mb_photo_view?>
    </td>
  </tr>
  <?=$show_photo_end?>
  <?=$show_icon_begin?>
  <tr> 
    <td><span class=subject>ȸ�� ������</span></td>
    <td> 
      <?=$mb_icon_view?>
    </td>
  </tr>
  <?=$show_icon_end?>
  <?=$show_edit_begin?>
  <tr> 
    <td><span class=subject>����Ʈ</span></td>
    <td> 
      <?=$mb_point?>
    </td>
  </tr>
  <tr> 
    <td><span class=subject>���� </span></td>
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
      <?=$mb_ext1?>
    </td>
  </tr>
  <?=$show_ext1_end?>
  <?=$show_ext2_begin?>
  <tr> 
    <td><span class=subject> 
      <?=$show_ext2_title?>
      </span></td>
    <td> 
      <?=$mb_ext2?>
    </td>
  </tr>
  <?=$show_ext2_end?>
  <?=$show_ext3_begin?>
  <tr> 
    <td><span class=subject> 
      <?=$show_ext3_title?>
      </span></td>
    <td> 
      <?=$mb_ext3?>
    </td>
  </tr>
  <?=$show_ext3_end?>
  <?=$show_ext4_begin?>
  <tr> 
    <td><span class=subject> 
      <?=$show_ext4_title?>
      </span></td>
    <td> 
      <?=$mb_ext4?>
    </td>
  </tr>
  <?=$show_ext4_end?>
  <?=$show_ext5_begin?>
  <tr> 
    <td><span class=subject> 
      <?=$show_ext5_title?>
      </span></td>
    <td> 
      <?=$mb_ext5?>
    </td>
  </tr>
  <?=$show_ext5_end?>
  <?=$show_ext6_begin?>
  <tr> 
    <td><span class=subject> 
      <?=$show_ext6_title?>
      </span></td>
    <td> 
      <?=$mb_ext6?>
    </td>
  </tr>
  <?=$show_ext6_end?>
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
  <a href="javascript:self.close()">�ݱ�</a>
</div>
