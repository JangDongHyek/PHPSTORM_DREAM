<table width=600 cellpadding=3 cellspacing=0 border=0 align=center>
  <tr>
    <td colspan=2>
      <a href="http://navyism.com" target=_blank><img src='nalog_image/logo.gif' border=0></a>
    </td>
  </tr>
  <tr>
    <td>
      <span style='font-size:12pt'><b>n@log analyzer <?=$nalog_info[version]?> �p�ƾ��ϥΤ�k�d��</b></span>
    </td>
    <td align=right>
      �奻½Ķ�G<a href="http://kiddiken.net" target=_blank>�媽(kiddiken)</a>
    </td>
  </tr>
  <tr>
    <td colspan=2 height=3 bgcolor=#2CBBFF></td>
  </tr>
</table>

<table width=600 cellpadding=3 cellspacing=0 border=0 align=center>
  <tr>
    <td colspan=2>
      �z�w�g���\�a�إߨñҥΤF�@�ӦW�s <b><?=$counter?></b> ���p�ƾ��C<br>
      �����奻�|�H�o�ӭp�ƾ����]�w�ӦV�z�����p�ƾ����ϥΤ�k�d�ҡC<br><br>
    </td>
  </tr>
  <tr>
    <td colspan=2>
      <span style='font-size:11pt'><b>1. �Q�� GD �Ҳժ��\��۰ʫإ߭p�ƾ�����</b> (�e���O�z���D�������䴩 GD �Ҳե\��)</span>
    </td>
  </tr>
  <tr><td colspan=2 height=3 bgcolor=#2CBBFF></td></tr>
  <tr><td colspan=2>
    <table border=0 width=100% cellpadding=5 cellspacing=0>
      <tr>
        <td width=1% nowrap valign=top><img src='<?=$test_gd?>'></td>
        <td width=99% valign=top>
          �Ьݬݥ��誺���ɡC�p�G�o�ӹ��ɬO�@�Ӷ¦⪺����ΡA�Ӹ̭����@�ӥզ⪺��Ϊ��ܡA���N��ܱz���D���䴩 GD �Ҳե\��C�o�˷�z�ϥ� n@log ����ܭp�ƾ�����²���O���ө��|�I�z�u���b��������H�U�o�� IMG �y�k�A�������J�ɡA�{���K�|�b�z�� n@log ��Ƨ��۰ʫإߩһݪ����ɡC
        </td>
      </tr>
    </table>
    <br>
    <span style='font-family:�ө���,MingLiU'>
      &lt;img src="<b>n@log�{�����|</b>/nalogd.php?counter=<b>�p�ƾ��W��</b>&url=&lt;?=$HTTP_SERVER_VARS[HTTP_REFERER]?&gt;" width=0 height=0>
    </span>
    <br><br>
    �{�b�ڷ|���հ����z�� n@log �]�w�ȡA�M��b�U������r�ظ̱N IMG �y�k�g�X�ӡA���z���ξޤ߻y�k�ӫ��g�C�p�G�z�{���o�ǻy�k�����T�L�~���ܡA�z�K�i�H��߱N�o�ǻy�k�ƻs��K�W�z�������̡C<br><br>

<textarea class=input cols=80 rows=3 onclick=select() readonly style='font-family:�ө���,MingLiU;padding:4px'>
&lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/nalogd.php",$HTTP_SERVER_VARS[PHP_SELF]);
?>?counter=<?=$counter?>&url=&lt;?=$HTTP_SERVER_VARS[HTTP_REFERER]?&gt;" width=0 height=0></textarea>

    <br><br>
    �p�G�z�b�����ϥΤF�o�ӻy�k�A�������J�ɡA�p�ƾ��K�|���`�B�@�A���O�p�ƾ������O���ð_�Ӫ��C<br>
    �z�i�H�ϥΤU�C���y�k����ܱz�Q�n���p�ƾ����ɡG<br><br>

<textarea class=input cols=80 rows=7 onclick=select() readonly style='font-family:�ө���,MingLiU;padding:4px'>
�����s���H�� &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_today.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
�Q���s���H�� &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_yester.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
�`�p�s���H�� &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_total.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
�ثe�u�W�H�� &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_now.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
�P�ɦb�u���p &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_peak.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
���s���H�����p &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_day_peak.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>"></textarea>

    <br><br>
    �`�N�G�Ҧ��Q�� GD �Ҳզ۰ʫإߪ��p�ƾ����ɳ��O JPEG �榡 (���ɦW�� .jpg) ���C<br><br>
  </td></tr>
  <tr>
    <td colspan=2>
      <span style='font-size:11pt'><b>2. �b���ϥ� GD �Ҳժ����p�U�A��X�p�ƾ����G���覡</b> (���A�Ω�Ҧ�����)</span>
    </td>
  </tr>
  <tr><td colspan=2 height=3 bgcolor=#2CBBFF></td></tr>
  <tr><td colspan=2>
    �@��ӻ��A�z�u�n�N�U���@�q²�檺 PHP ��l�X��b<font color=#045C8A>�����ɮת��}�Y</font>�A�o�˷������J�ɡA�K����N�����y�q����ƶǵ� n@log �{���C<br><br>
    �M�ӡA<font color=#045C8A>���p�A�N�o�q��l�X��b�ج[�̭����Y�@���An@log �K�L�k���o�X�Ȫ��ӷ��D���M���}�����n���</font>�C�P�ɷ|�b�@�Ǳ��p�U�A�ɭP n@log �{�����ॿ�`�B�@�C<br><br>
    �ҥH<font color=#045C8A>�кɥi�ण�n�N�o�q��l�X��b�ج[�̭����Y�@��</font>�C�p�G�i�H���ܡA�бN�o�q��l�X��b�]�t FRAMESET (�ج[�]�w) �y�k���P�@���A�ӫD�ج[�̭����l���C<br><br><br>
    �|�һ����A���p�z��������}�O <font color=#045C8A>http://navyism.com</font>/index.php �ӱz�� n@log �D�{�����|�O <font color=#045C8A>http://navyism.com/nalog5</font>/nalog.php�A�z�K�i�H�b�z�� index.php �����ɮת��̶}�Y�A�[�J�H�U�o�q PHP ��l�X�C(�к�O���n�b include ���ԭz�y�ϥε�����|!)<br>
    <br>
    <span style='font-family:�ө���,MingLiU'>
      &lt;?<br>
      $path = "<font color=#045C8A><b>nalog5</b></font>";<br>
      $counter = "<font color=#045C8A><b><?=$counter?></b></font>";<br>
      include "$path/nalog.php";<br>
      ?&gt;<br>
    </span>
    <br>
    �p�G�z�N�o�q PHP ��l�X���T�a��b�������ܡA�������J�ɡA�z���Ӥ��|�Pı����e�����O�A�o�i�O���`���C<br><br>
    �M�ӡA���Y�b�o�q PHP ��l�X���e�����X�{����r�� (�]�A�b�Ϊť�)�A�άO�z�ϥΤF�O�J��� (include) ���覡�b�o���e�O�J��L���ɮסA�o�˳��|�O n@log �p�ƾ�����B�@�A�ӥB�|�u�X���~�T����ĵ�i�����A�i�D�z���ӱN�o�q��l�X��b�����ɮ׳̶}�Y���a��C<br><br>
    �򥻤W�A��ܭp�ƾ����G���覡����ءA���O�O<b>��r�ιϧ�</b>�A�� n@log �p�ƾ��i�H���z��X���اΦ����ƭȡC���~�A�z��i�H��ܧQ��<b>���O�ϼ�</b> (Skin Pattern) ���覡�ӳ]�p�@�Ӿ�X�����p�ƾ����ɮ榡��X�쭶���C<br><br>
    �n�b�����W��ܭp�ƾ��A�z�ݭn�Ψ� PHP �� echo ��� ( &lt;?=$variable?&gt; ) �Ө�U��X�C�H�U�C�X n@log �{�����w���o���ܼƦW�١G<br><br>
    �i�H��r��ܡj<br><br>
    <span style='font-family:�ө���,MingLiU'>&lt;?=$today_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        ����(�I�ܥثe)���s���H�� [��r] �� <font color='#666666'><?=$today_text?></font><br>
    <span style='font-family:�ө���,MingLiU'>&lt;?=$yester_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        �Q�Ѫ��s���H�� [��r] �� <font color='#666666'><?=$yester_text?></font><br>
    <span style='font-family:�ө���,MingLiU'>&lt;?=$total_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        �`�p�s���H�� [��r] �� <font color='#666666'><?=$total_text?></font><br>
    <span style='font-family:�ө���,MingLiU'>&lt;?=$now_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        �ثe�u�W�H�� [��r] �� <font color='#666666'><?=$now_text?></font><br>
    <span style='font-family:�ө���,MingLiU'>&lt;?=$peak_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        �P�ɦb�u���p(�P�ɳs�u���H���p��) [��r] �� <font color='#666666'><?=$peak_text?></font><br>
    <span style='font-family:�ө���,MingLiU'>&lt;?=$day_peak_text?&gt;&nbsp;&nbsp;:</span>
        ���s���H�����p(�b�P�@�ѰO���o�̰��s���H��) [��r] �� <font color='#666666'><?=$day_peak_text?></font><br>
    <br>
    �i�H�ϧ���ܡj<br><br>
    <span style='font-family:�ө���,MingLiU'>&lt;?=$today_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        ����(�I�ܥثe)���s���H�� [�ϧ�] �� <?=$today_image?><br>
    <span style='font-family:�ө���,MingLiU'>&lt;?=$yester_image?&gt;&nbsp;&nbsp;&nbsp;:</span>
        �Q�Ѫ��s���H�� [�ϧ�] �� <?=$yester_image?><br>
    <span style='font-family:�ө���,MingLiU'>&lt;?=$total_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        �`�p�s���H�� [�ϧ�] �� <?=$total_image?><br>
    <span style='font-family:�ө���,MingLiU'>&lt;?=$now_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        �ثe�u�W�H�� [�ϧ�] �� <?=$now_image?><br>
    <span style='font-family:�ө���,MingLiU'>&lt;?=$peak_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        �P�ɦb�u���p(�P�ɳs�u���H���p��) [�ϧ�] �� <?=$peak_image?><br>
    <span style='font-family:�ө���,MingLiU'>&lt;?=$day_peak_image?&gt;&nbsp;:</span>
        ���s���H�����p(�b�P�@�ѰO���o�̰��s���H��) [�ϧ�] �� <?=$day_peak_image?><br>
    <br>
    �i�H���O�ϼ���ܡj<br><br>
    <span style='font-family:�ө���,MingLiU'>&lt;?=$nalog_result?&gt;&nbsp;&nbsp;&nbsp;:</span>
        �Q�ιw���]�p�n�����O�ϼ˨���ܱz�ߥؤ����p�ƾ��榡���ɡC<br>
    <br>
    <?=$nalog_result?><br>(�аѦҭ��O��Ƨ��̭��� skin.php �ɮרӦۭq�z�Q�n���榡)<br><br><br>
    nalog.php �o���ɮת��γ~�O�O�������y�q��ƩM��X���G���C<br><br>
    �M�ӡA���Y�z�ϥ� n@log ���ت��u�O�Ψӭp��ثe�u�W�H�ơA�ӨS���z�|�Ҧ���������y�q�Ψӷ����}������ơA��ĳ�z�ϥ� nalog_viewer.php �ӥN�� nalog.php�A�o�˥i�H��ֺ����귽���l�ӡC<br>
    <br>
    <span style='font-family:�ө���,MingLiU'>
      &lt;?<br>
      $path = "<font color=#045C8A><b>nalog5</b></font>";<br>
      $counter = "<font color=#045C8A><b><?=$counter?></b></font>";<br>
      include "$path/nalog_viewer.php";<br>
      ?&gt;<br>
    </span>
    <br>
    ���p�W�崣��A�p�G�z�ϥγo�q PHP ��l�X�N���e�������@�q�An@log �N���|���R�z�������y�q��ơA�ӥu�O�����ʹ�����W���h�֤H�P�ɦb�u�W���{���C<br>
    <br>
    �ƹ�W�A�z�i�H�b�C�@�ӭ�������l�X�O�J nalog_viewer.php �o���ɮסA�o�˱z�N�i�H�b�������C�@�����i�H��ܭp�ƾ����e�Cnalog_viewer.php �o���ɮת��ت��A�ä��O�n�s�W�X�Ȫ��O���A�ӬO�ΨӷǽT�a��ܥثe���p�ƾ��έp��ơC
  </td></tr>
  <tr><td colspan=2 height=10></td></tr>
  <tr><td colspan=2 height=1 bgcolor=#2CBBFF></td></tr>
</table>

<table width=600 cellpadding=0 cellspacing=0 border=0 align=center>
  <tr>
    <td><font size=1><?=$lang[copy]?></td>
    <td align=right>
      <span style='font-size:6pt'>&#9654;</span>
      ��h��T�Χ޳N�䴩 [ <a href="http://kiddiken.net" target=_blank>�c�餤��</a> |
      <a href="http://navyism.com" target=_blank>����</a> |
      <a href="http://english.navyism.com" target=_blank>�^��</a> ]
      <span style='font-size:6pt'>&#9654;</span>
      <a href="javascript:window.close()">����</a>
    </td>
  </tr>
</table>
