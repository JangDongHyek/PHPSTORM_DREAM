<table width=600 cellpadding=3 cellspacing=0 border=0 align=center>
  <tr>
    <td colspan=2>
      <a href="http://navyism.com" target=_blank><img src='nalog_image/logo.gif' border=0></a>
    </td>
  </tr>
  <tr>
    <td>
      <font size=3><b>n@log analyzer <?=$nalog_info[version]?>ī���� ���� : <?=$counter?></b></font>
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
      counter: <b><?=$counter?></b> ī���͸� ���� �ϼ̽��ϴ�.<br><br>
    </td>
  </tr>
  <tr>
    <td colspan=2>
      <font size=3><b>1. GD�� �̿��� ī���� ��� (GD�� ������ ��쿡�� ���밡��)</b></font>
    </td>
  </tr>
  <tr><td colspan=2 height=3 bgcolor=#2CBBFF></td></tr>
  <tr><td colspan=2>
    <table border=0 width=100% cellpadding=5 cellspacing=0>
      <tr>
        <td width=1% nowrap valign=top><img src='<?=$test_gd?>'></td>
        <td width=99% valign=top>
          ���� ������ ���� �̹����� ��� ���� ���̽Ŵٸ� GD�� �����Ǵ� ���� �Դϴ�.<br>
          GD�� �����Ǵ� ���������� ������ �̹��� �±׷� �����ϰ� n@log�� ��� �� �� �� �ֽ��ϴ�.
        </td>
      </tr>
    </table>
    <br>
    <span style='font-family:����ü,GulimChe'>
      &lt;img src="<b>���</b>/nalogd.php?counter=<b>ī�����̸�</b>&url=&lt;?=$HTTP_SERVER_VARS[HTTP_REFERER]?&gt;" width=0 height=0>
    </span>
    <br><br>
    ���� ������ ������ζ�� ������ �̹��� �±׸� �״�� ���� �Ͽ� ����ϼ���.<br><br>

<textarea class=input cols=80 rows=2 onclick=select() readonly style='font-family:����ü,GulimChe'>
&lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/nalogd.php",$HTTP_SERVER_VARS[PHP_SELF]);
?>?counter=<?=$counter?>&url=&lt;?=$HTTP_SERVER_VARS[HTTP_REFERER]?&gt;" width=0 height=0></textarea>

    <br><br>
    ���� �±׸� �̿��Ͻø� ī���ø� �̷������ ȭ������� �̷�� ���� �ʽ��ϴ�.<br>
    ȭ������� ������ �±׸� �̿��Ͻø� �˴ϴ�.<br><br>

<textarea class=input cols=80 rows=6 onclick=select() readonly style='font-family:����ü,GulimChe'>
���ù湮�� &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_today.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
�����湮�� &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_yester.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
��ü�湮�� &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_total.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
���������� &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_now.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
�ִ뵿�������� &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_peak.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
�ִ�湮�� &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_day_peak.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>"></textarea>

    <br><br>
    ����) GD�� �̿��� ������ �Ͻ÷��� ��� ��Ų�� �̹��� ���� ������ jpg���� �̾�߸� �մϴ�.<br><br>
  </td></tr>
  <tr>
    <td colspan=2>
      <font size=3><b>2. GD�� �̿����� �ʴ� ī���� ��� (����쿡 ���밡��)</b></font>
    </td>
  </tr>
  <tr><td colspan=2 height=3 bgcolor=#2CBBFF></td></tr>
  <tr><td colspan=2>
    ī���͸� �������� �����ϱ� ���ؼ��� ������ �ڵ带 <font color=#045C8A>������ �������� �ֻ��</font>�� �־� �־�� �մϴ�.<br><br>
    ���� <font color=#045C8A>�Ʒ� �ҽ� ������ ��� ��¹�(��������)�� ���� �Ѵٸ� n@log�� ���� �޼����� ����, ��Ű�� ����� �۵����� �ʴ� ����</font>�� �߻� ��ų�� �ֽ��ϴ�.<br><br>
    �׸��� ������ ���� �������� �Ʒ� �ڵ带 �����Ͻø� �湮���� ���Ӱ�ΰ� ����� üũ���� �ʴ� ������ �߻� ��ų�� �ֽ��ϴ�.<br><br>
    �׷��� ������ <font color=#045C8A>������ ���� ���������� ������ ������� ���ð�, �����Ӽ� ������ ���� �ڵ带 �־� �ֽñ� �ٶ��ϴ�.</font><br><br><br>
    ���� ��� ������ �������� <font color=#045C8A>http://navyism.com</font>/index.php �̰�,<br>
    n@log�� ��ġ�� ��ΰ� <font color=#045C8A>http://navyism.com/nalog5</font>/nalog.php ��� �Ѵٸ�, ������ ���� �ҽ��� index.php�� �ֻ�ܿ� �־��ݴϴ�.<br>
    <br>
    <span style='font-family:����ü,GulimChe'>
      &lt;?<br>
      $path = "<font color=#045C8A><b>nalog5</b></font>";<br>
      $counter = "<font color=#045C8A><b><?=$counter?></b></font>";<br>
      include "$path/nalog.php";<br>
      ?&gt;<br>
    </span>
    <br>
    �������� �ҽ��� ���������� ���� �Ǿ��ٸ�, ȭ�鿡 �ƹ��͵� ��µ��� ���� ���Դϴ�.<br><br>
    �׷��� ������ �ҽ� ������ ��� ��¹�(��������)�� �־��ٸ�, ������ ���� ������ �߻��ϸ� n@log�� ������ ���� �� ���Դϴ�.<br><br>
    <font color=#045C8A>n@log analyzer error : ����ҽ��� �������� �ֻ�ܿ� �־��ּ���. �ҽ� ������ ��� ��¹�(��������)�� �־�� �ȵ˴ϴ�.</font><br><br>
    ����� �������� �ƹ��͵� ��µ��� �ʰ� ���� ���� ���� �޼����� ��µ��� �ʾҴٸ�, �Ʒ��� ���� ��� ������ ī���Ϳ� ���õ� �������� ��� �� �� �ֽ��ϴ�.<br><br>
    �⺻)<br>
    <span style='font-family:����ü,GulimChe'>&lt;?=$today_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        ���� �湮�� ��� (�ؽ�Ʈ) �� <font color='#666666'><?=$today_text?></font><br>
    <span style='font-family:����ü,GulimChe'>&lt;?=$yester_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        ���� �湮�� ��� (�ؽ�Ʈ) �� <font color='#666666'><?=$yester_text?></font><br>
    <span style='font-family:����ü,GulimChe'>&lt;?=$total_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        �� �湮�� ��� (�ؽ�Ʈ) �� <font color='#666666'><?=$total_text?></font><br>
    <span style='font-family:����ü,GulimChe'>&lt;?=$now_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        ���� ������ ��� (�ؽ�Ʈ) �� <font color='#666666'><?=$now_text?></font><br>
    <span style='font-family:����ü,GulimChe'>&lt;?=$peak_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        �ִ� ���� ������ ��� (�ؽ�Ʈ) �� <font color='#666666'><?=$peak_text?></font><br>
    <span style='font-family:����ü,GulimChe'>&lt;?=$day_peak_text?&gt;&nbsp;&nbsp;:</span>
        �ִ� �湮�� ��� (�ؽ�Ʈ) �� <font color='#666666'><?=$day_peak_text?></font><br>
    <br>
    �̹���)<br>
    <span style='font-family:����ü,GulimChe'>&lt;?=$today_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        ���� �湮�� ��� (�̹���) �� <?=$today_image?><br>
    <span style='font-family:����ü,GulimChe'>&lt;?=$yester_image?&gt;&nbsp;&nbsp;&nbsp;:</span>
        ���� �湮�� ��� (�̹���) �� <?=$yester_image?><br>
    <span style='font-family:����ü,GulimChe'>&lt;?=$total_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        �� �湮�� ��� (�̹���) �� <?=$total_image?><br>
    <span style='font-family:����ü,GulimChe'>&lt;?=$now_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        ���� ������ ��� (�̹���) �� <?=$now_image?><br>
    <span style='font-family:����ü,GulimChe'>&lt;?=$peak_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        �ִ� ���� ������ ��� (�̹���) �� <?=$peak_image?><br>
    <span style='font-family:����ü,GulimChe'>&lt;?=$day_peak_image?&gt;&nbsp;:</span>
        �ִ� �湮�� ��� (�̹���) �� <?=$day_peak_image?><br>
    <br>
    ��Ų���ϻ��)<br>
    <span style='font-family:����ü,GulimChe'>&lt;?=$nalog_result?&gt;&nbsp;&nbsp;&nbsp;:</span>
        ��Ų ����(skin.php)�� �����Ͽ� �̹��� ��� (��Ų ���� ��� ������)<br>
    <br>
    <?=$nalog_result?><br><br>
    nalog.php�� �湮���� üũ�� ���ÿ� ��� �� ���� �������� ������ ���� �մϴ�.<br><br>
    �׷��� �湮�ڸ� üũ���� �ʰ�, ���� �������� üũ�� ��¸��� �������� �ϴ� ��������� nalog_viewer.php��� ������ include�ϸ� �˴ϴ�.<br>
    <br>
    <span style='font-family:����ü,GulimChe'>
      &lt;?<br>
      $path = "<font color=#045C8A><b>nalog5</b></font>";<br>
      $counter = "<font color=#045C8A><b><?=$counter?></b></font>";<br>
      include "$path/nalog_viewer.php";<br>
      ?&gt;<br>
    </span>
    <br>
    ���� ���� nalog.php��ſ� nalog_viewer.php�� include�Ͽ��ٸ�, �湮���� ��������� ī������ ���� �ʰ�, ���� �����ڸ��� üũ�մϴ�.<br>
    �׸��� nalog.php������ ���� ������� ����� ��� �� �� �ֽ��ϴ�.
  </td></tr>
  <tr><td colspan=2 height=10></td></tr>
  <tr><td colspan=2 height=1 bgcolor=#2CBBFF></td></tr>
</table>

<table width=600 cellpadding=0 cellspacing=0 border=0 align=center>
  <tr>
    <td><font size=1><?=$lang[copy]?></td>
    <td align=right>
      <span style='font-size:6pt'>��</span>
      <a href="http://navyism.com" target=_blank>���� �� �����ڷ�</a>
      <span style='font-size:6pt'>��</span>
      <a href="javascript:window.close()">â�ݱ�</a>
    </td>
  </tr>
</table>
