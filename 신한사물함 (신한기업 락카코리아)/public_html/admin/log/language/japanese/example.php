<table width=600 cellpadding=3 cellspacing=0 border=0 align=center>
  <tr>
    <td colspan=2>
      <a href="http://navyism.com" target=_blank><img src='nalog_image/logo.gif' border=0></a>
    </td>
  </tr>
  <tr>
    <td>
      <font size=3><b>n@log analyzer <?=$nalog_info[version]?>�J�E���^�@�T���v�� : <?=$counter?></b></font>
    </td>
    <td align=right>
      written by <a href="http://navyism.com" target=_blank>navyism</a>
    </td>
  </tr>
  <tr>
    <td colspan=2 height=3 bgcolor=#2CBBFF></td>
  </tr>
</table>

<table width=600 cellpadding=3 cellspacing=0 border=0 align=center>
  <tr>
    <td colspan=2>
      counter: <b><?=$counter?></b> �J�E���^���쐬���܂����B<br><br>
    </td>
  </tr>
  <tr>
    <td colspan=2>
      <font size=3><b>1. GD�𗘗p�����J�E���^�o�� (GD�����p�o������̂�)</b></font>
    </td>
  </tr>
  <tr><td colspan=2 height=3 bgcolor=#2CBBFF></td></tr>
  <tr><td colspan=2>
    <table border=0 width=100% cellpadding=5 cellspacing=0>
      <tr>
        <td width=1% nowrap valign=top><img src='<?=$test_gd?>'></td>
        <td width=99% valign=top>
          �����A���ɍ����C���[�W�ɔ����ۂ���������GD�����p�o����T�[�o�[�ł��B<br>
          GD�����p�o����T�[�o�[�ł́A���̃C���[�W�^�O�ŊȒP�� n@log���g���܂��B
        </td>
      </tr>
    </table>
    <br>
    <span style='font-family:MS PGothic,MS P�S�V�b�N'>
      &lt;img src="<b>�o�H</b>/nalogd.php?counter=<b>�J�E���^��</b>&url=&lt;?=$HTTP_SERVER_VARS[HTTP_REFERER]?&gt;" width=0 height=0>
    </span>
    <br><br>
    �����A���݂̐ݒ�ł悯��΁A���̃C���[�W�^�O�����̂܂܃R�s�[���Ďg���ĉ������B<br><br>

<textarea class=input cols=80 rows=2 onclick=select() readonly style='font-family:MS PGothic,MS P�S�V�b�N'>
&lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/nalogd.php",$HTTP_SERVER_VARS[PHP_SELF]);
?>?counter=<?=$counter?>&url=&lt;?=$HTTP_SERVER_VARS[HTTP_REFERER]?&gt;" width=0 height=0></textarea>

    <br><br>
    ��L�̃^�O���g���ƁA�J�E���^�̂ݍ쓮���A��ʏ�ɂ͏o�͂��܂���B<br>
    ��ʏ�ɕ\�L������ɂ́A���̃^�O���g���ĉ������B<br><br>

<textarea class=input cols=80 rows=6 onclick=select() readonly style='font-family:MS PGothic,MS P�S�V�b�N'>
�����̖K��� &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_today.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
����̖K��� &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_yester.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
���v�K��� &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_total.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
���ݐڑ��� &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_now.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
�ő哯���ڑ��� &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_peak.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
�ő�K��� &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_day_peak.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>"></textarea>

    <br><br>
    ����) GD�𗘗p�����C���[�W��K�p����ɂ́Askin�̃C���[�W�t�@�C���`����jpg�łȂ��Ƃ����܂���B<br><br>
  </td></tr>
  <tr>
    <td colspan=2>
      <font size=3><b>2. GD�𗘗p���Ȃ��J�E���^�o�� (���ׂēK�p��)</b></font>
    </td>
  </tr>
  <tr><td colspan=2 height=3 bgcolor=#2CBBFF></td></tr>
  <tr><td colspan=2>
    �J�E���^���y�[�W�ɓK�p����ɂ́A�ȒP�ȃR�[�h�� <font color=#045C8A>�K�p����y�[�W�ŏ�i</font>�ɓ���܂��B<br><br>
    ���� <font color=#045C8A>���L�̃R�[�h�̑O�ɉ������̕\�L(�󔒂��܂�)������� n@log�̓G���[���b�Z�[�W���o��
    <br>�N�b�L�[������ɍ쓮���Ȃ����</font>���o��ꍇ������܂��B<br><br>
    �܂��A�t���[���ō���������ɉ��L�̃R�[�h������΁A�K��҂̐ڑ����[�g������ɔc���o���Ȃ��ꍇ������܂��B<br><br>
    ���̂��� <font color=#045C8A>�o���邾���t���[���̕����ɂ́A���̃R�[�h���ꂸ�A�t���[���Z�b�g�����ɒ��ړ���邱�Ƃ������߂��܂��B</font><br><br><br>
    �Ⴆ�΁A�K�p����y�[�W�� <font color=#045C8A>http://navyism.com</font>/index.php �ŁA<br>
    n@log���ݒu����Ă��郋�[�g�� <font color=#045C8A>http://navyism.com/nalog5</font>/nalog.php ���Ƃ����
    <br>���̃R�[�h��index.php�̍ŏ�i�ɒǉ����܂��B<br>
    <br>
    <span style='font-family:MS PGothic,MS P�S�V�b�N'>
      &lt;?<br>
      $path = "<font color=#045C8A><b>nalog5</b></font>";<br>
      $counter = "<font color=#045C8A><b><?=$counter?></b></font>";<br>
      include "$path/nalog.php";<br>
      ?&gt;<br>
    </span>
    <br>
    �y�[�W�ɃR�[�h������ɓK�p���ꂽ�̂ł���΁A��ʏ�ɂ͉����\������܂���B<br><br>
    �������A���̃R�[�h�̑O�ɕ�����L��(�󔒂��܂�)���������ꍇ�A���̂悤�ȃG���[���o�āA n@log�͋N�����~�ɂȂ�܂��B<br><br>
    <font color=#045C8A>n@log analyzer error : �}���R�[�h���y�[�W�ŏ�i�ɓ���ĉ������B
    <br>�R�[�h�̑O�ɂ͂����Ȃ镶����L��(�󔒂��܂�)�������Ă͂����܂���B</font><br><br>
    �K�p�����y�[�W�ɉ����o�͂����A�G���[���b�Z�[�W���o�Ȃ���΁A���̂悤�ȃR�[�h�ŃJ�E���^�����o�͏o���܂��B<br><br>
    ��{)<br>
    <span style='font-family:MS PGothic,MS P�S�V�b�N'>&lt;?=$today_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        �����̖K��ҏo�� (�e�L�X�g) �� <font color='#666666'><?=$today_text?></font><br>
    <span style='font-family:MS PGothic,MS P�S�V�b�N'>&lt;?=$yester_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        ����̖K��ҏo�� (�e�L�X�g) �� <font color='#666666'><?=$yester_text?></font><br>
    <span style='font-family:MS PGothic,MS P�S�V�b�N'>&lt;?=$total_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        ���v�K��ҏo�� (�e�L�X�g) �� <font color='#666666'><?=$total_text?></font><br>
    <span style='font-family:MS PGothic,MS P�S�V�b�N'>&lt;?=$now_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        ���ݐڑ��ҏo�� (�e�L�X�g) �� <font color='#666666'><?=$now_text?></font><br>
    <span style='font-family:MS PGothic,MS P�S�V�b�N'>&lt;?=$peak_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        �ő哯���ڑ��ҏo�� (�e�L�X�g) �� <font color='#666666'><?=$peak_text?></font><br>
    <span style='font-family:MS PGothic,MS P�S�V�b�N'>&lt;?=$day_peak_text?&gt;&nbsp;&nbsp;:</span>
        �ő�K��ҏo�� (�e�L�X�g) �� <font color='#666666'><?=$day_peak_text?></font><br>
    <br>
    �ʍk��)<br>
    <span style='font-family:MS PGothic,MS P�S�V�b�N'>&lt;?=$today_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        �����̖K��ҏo�� (�C���[�W) �� <?=$today_image?><br>
    <span style='font-family:MS PGothic,MS P�S�V�b�N'>&lt;?=$yester_image?&gt;&nbsp;&nbsp;&nbsp;:</span>
        ����̖K��ҏo�� (�C���[�W) �� <?=$yester_image?><br>
    <span style='font-family:MS PGothic,MS P�S�V�b�N'>&lt;?=$total_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        ���v�K��ҏo�� (�C���[�W) �� <?=$total_image?><br>
    <span style='font-family:MS PGothic,MS P�S�V�b�N'>&lt;?=$now_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        ���ݐڑ��ҏo�� (�C���[�W) �� <?=$now_image?><br>
    <span style='font-family:MS PGothic,MS P�S�V�b�N'>&lt;?=$peak_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        �ő哯���ڑ��ҏo�� (�C���[�W) �� <?=$peak_image?><br>
    <span style='font-family:MS PGothic,MS P�S�V�b�N'>&lt;?=$day_peak_image?&gt;&nbsp;:</span>
        �ő�K��ҏo�� (�C���[�W) �� <?=$day_peak_image?><br>
    <br>
    skin�p�^�[���g�p)<br>
    <span style='font-family:MS PGothic,MS P�S�V�b�N'>&lt;?=$nalog_result?&gt;&nbsp;&nbsp;&nbsp;:</span>
        �X�L���p�^�[��(skin.php)���Q�l���A�C���[�W�o�� (�X�L���p�^�[���K�p��)<br>
    <br>
    <?=$nalog_result?><br><br>
    nalog.php�͖K��҂̃`�F�b�N�Ɠ����ɁA�o�͒l��\�L������������Ă��܂��B<br><br>
    �������A�K��҃`�F�b�N�͂����A���ݐڑ��҂̃`�F�b�N�Əo�͂̂ݎg���y�[�W�ł����<br>
    nalog_viewer.php�Ƃ����t�@�C���� include���ĉ������B<br>
    <br>
    <span style='font-family:MS PGothic,MS P�S�V�b�N'>
      &lt;?<br>
      $path = "<font color=#045C8A><b>nalog5</b></font>";<br>
      $counter = "<font color=#045C8A><b><?=$counter?></b></font>";<br>
      include "$path/nalog_viewer.php";<br>
      ?&gt;<br>
    </span>
    <br>
    ��L�̂悤�Ɂ@nalog.php�̑���� nalog_viewer.php�� include�����ꍇ��<br>
    �K��҂̏��ۑ��ƃJ�E���^�͂����A���ݐڑ��҂̂݃`�F�b�N���܂��B<br>
    �����āA nalog.php�Ɠ��������Ō��ʂ��o�͏o���܂��B
  </td></tr>
  <tr><td colspan=2 height=10></td></tr>
  <tr><td colspan=2 height=1 bgcolor=#2CBBFF></td></tr>
</table>

<table width=600 cellpadding=0 cellspacing=0 border=0 align=center>
  <tr>
    <td><font size=1><?=$lang[copy]?></td>
    <td align=right>
      <span style='font-size:6pt'>&nbsp;&nbsp;</span>
      <a href="http://navyism.com" target=_blank>���� �y�� �֘A����</a>
      <span style='font-size:6pt'>&nbsp;&nbsp;</span>
      <a href="javascript:window.close()">����</a>
    </td>
  </tr>
</table>
