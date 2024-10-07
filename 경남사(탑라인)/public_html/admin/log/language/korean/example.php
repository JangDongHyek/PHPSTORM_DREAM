<table width=600 cellpadding=3 cellspacing=0 border=0 align=center>
  <tr>
    <td colspan=2>
      <a href="http://navyism.com" target=_blank><img src='nalog_image/logo.gif' border=0></a>
    </td>
  </tr>
  <tr>
    <td>
      <font size=3><b>n@log analyzer <?=$nalog_info[version]?>카운터 예제 : <?=$counter?></b></font>
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
      counter: <b><?=$counter?></b> 카운터를 생성 하셨습니다.<br><br>
    </td>
  </tr>
  <tr>
    <td colspan=2>
      <font size=3><b>1. GD를 이용한 카운터 출력 (GD를 지원할 경우에만 적용가능)</b></font>
    </td>
  </tr>
  <tr><td colspan=2 height=3 bgcolor=#2CBBFF></td></tr>
  <tr><td colspan=2>
    <table border=0 width=100% cellpadding=5 cellspacing=0>
      <tr>
        <td width=1% nowrap valign=top><img src='<?=$test_gd?>'></td>
        <td width=99% valign=top>
          만약 좌측의 검정 이미지에 흰색 원이 보이신다면 GD가 지원되는 서버 입니다.<br>
          GD가 지원되는 서버에서는 다음의 이미지 태그로 간단하게 n@log를 사용 하 실 수 있습니다.
        </td>
      </tr>
    </table>
    <br>
    <span style='font-family:굴림체,GulimChe'>
      &lt;img src="<b>경로</b>/nalogd.php?counter=<b>카운터이름</b>&url=&lt;?=$HTTP_SERVER_VARS[HTTP_REFERER]?&gt;" width=0 height=0>
    </span>
    <br><br>
    만약 현재의 설정대로라면 다음의 이미지 태그를 그대로 복사 하여 사용하세요.<br><br>

<textarea class=input cols=80 rows=2 onclick=select() readonly style='font-family:굴림체,GulimChe'>
&lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/nalogd.php",$HTTP_SERVER_VARS[PHP_SELF]);
?>?counter=<?=$counter?>&url=&lt;?=$HTTP_SERVER_VARS[HTTP_REFERER]?&gt;" width=0 height=0></textarea>

    <br><br>
    위의 태그를 이용하시면 카운팅만 이루어지며 화면출력은 이루어 지지 않습니다.<br>
    화면출력은 다음의 태그를 이용하시면 됩니다.<br><br>

<textarea class=input cols=80 rows=6 onclick=select() readonly style='font-family:굴림체,GulimChe'>
오늘방문자 &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_today.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
어제방문자 &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_yester.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
전체방문자 &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_total.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
현재접속자 &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_now.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
최대동시접속자 &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_peak.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
최대방문자 &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_day_peak.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>"></textarea>

    <br><br>
    주의) GD를 이용한 적용을 하시려면 사용 스킨의 이미지 파일 형식이 jpg형태 이어야만 합니다.<br><br>
  </td></tr>
  <tr>
    <td colspan=2>
      <font size=3><b>2. GD를 이용하지 않는 카운터 출력 (모든경우에 적용가능)</b></font>
    </td>
  </tr>
  <tr><td colspan=2 height=3 bgcolor=#2CBBFF></td></tr>
  <tr><td colspan=2>
    카운터를 페이지에 적용하기 위해서는 간단한 코드를 <font color=#045C8A>적용할 페이지의 최상단</font>에 넣어 주어야 합니다.<br><br>
    만약 <font color=#045C8A>아래 소스 이전에 어떠한 출력문(공백포함)이 존재 한다면 n@log는 에러 메세지를 띄우고, 쿠키가 제대로 작동하지 않는 문제</font>를 발생 시킬수 있습니다.<br><br>
    그리고 프레임 속의 문서에서 아래 코드를 적용하시면 방문자의 접속경로가 제대로 체크되지 않는 오류를 발생 시킬수 있습니다.<br><br>
    그렇기 때문에 <font color=#045C8A>프레임 속의 문서에서는 가급적 사용하지 마시고, 프레임셋 문서에 직접 코드를 넣어 주시기 바랍니다.</font><br><br><br>
    예를 들어 적용할 페이지는 <font color=#045C8A>http://navyism.com</font>/index.php 이고,<br>
    n@log가 설치된 경로가 <font color=#045C8A>http://navyism.com/nalog5</font>/nalog.php 라고 한다면, 다음과 같은 소스를 index.php의 최상단에 넣어줍니다.<br>
    <br>
    <span style='font-family:굴림체,GulimChe'>
      &lt;?<br>
      $path = "<font color=#045C8A><b>nalog5</b></font>";<br>
      $counter = "<font color=#045C8A><b><?=$counter?></b></font>";<br>
      include "$path/nalog.php";<br>
      ?&gt;<br>
    </span>
    <br>
    페이지에 소스가 정상적으로 적용 되었다면, 화면에 아무것도 출력되지 않을 것입니다.<br><br>
    그러나 적용한 소스 이전에 어떠한 출력문(공백포함)이 있었다면, 다음과 같은 에러가 발생하며 n@log는 실행을 중지 할 것입니다.<br><br>
    <font color=#045C8A>n@log analyzer error : 적용소스를 페이지의 최상단에 넣어주세요. 소스 이전에 어떠한 출력문(공백포함)이 있어서는 안됩니다.</font><br><br>
    적용된 페이지에 아무것도 출력되지 않고 위와 같은 에러 메세지가 출력되지 않았다면, 아래와 같은 출력 문으로 카운터에 관련된 정보들을 출력 할 수 있습니다.<br><br>
    기본)<br>
    <span style='font-family:굴림체,GulimChe'>&lt;?=$today_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        오늘 방문자 출력 (텍스트) → <font color='#666666'><?=$today_text?></font><br>
    <span style='font-family:굴림체,GulimChe'>&lt;?=$yester_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        어제 방문자 출력 (텍스트) → <font color='#666666'><?=$yester_text?></font><br>
    <span style='font-family:굴림체,GulimChe'>&lt;?=$total_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        총 방문자 출력 (텍스트) → <font color='#666666'><?=$total_text?></font><br>
    <span style='font-family:굴림체,GulimChe'>&lt;?=$now_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        현재 접속자 출력 (텍스트) → <font color='#666666'><?=$now_text?></font><br>
    <span style='font-family:굴림체,GulimChe'>&lt;?=$peak_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        최대 동시 접속자 출력 (텍스트) → <font color='#666666'><?=$peak_text?></font><br>
    <span style='font-family:굴림체,GulimChe'>&lt;?=$day_peak_text?&gt;&nbsp;&nbsp;:</span>
        최대 방문자 출력 (텍스트) → <font color='#666666'><?=$day_peak_text?></font><br>
    <br>
    이미지)<br>
    <span style='font-family:굴림체,GulimChe'>&lt;?=$today_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        오늘 방문자 출력 (이미지) → <?=$today_image?><br>
    <span style='font-family:굴림체,GulimChe'>&lt;?=$yester_image?&gt;&nbsp;&nbsp;&nbsp;:</span>
        어제 방문자 출력 (이미지) → <?=$yester_image?><br>
    <span style='font-family:굴림체,GulimChe'>&lt;?=$total_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        총 방문자 출력 (이미지) → <?=$total_image?><br>
    <span style='font-family:굴림체,GulimChe'>&lt;?=$now_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        현재 접속자 출력 (이미지) → <?=$now_image?><br>
    <span style='font-family:굴림체,GulimChe'>&lt;?=$peak_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        최대 동시 접속자 출력 (이미지) → <?=$peak_image?><br>
    <span style='font-family:굴림체,GulimChe'>&lt;?=$day_peak_image?&gt;&nbsp;:</span>
        최대 방문자 출력 (이미지) → <?=$day_peak_image?><br>
    <br>
    스킨패턴사용)<br>
    <span style='font-family:굴림체,GulimChe'>&lt;?=$nalog_result?&gt;&nbsp;&nbsp;&nbsp;:</span>
        스킨 패턴(skin.php)을 참고하여 이미지 출력 (스킨 패턴 사용 설정시)<br>
    <br>
    <?=$nalog_result?><br><br>
    nalog.php는 방문자의 체크와 동시에 출력 할 값을 가져오는 역할을 수행 합니다.<br><br>
    그러나 방문자를 체크하지 않고, 현재 접속자의 체크와 출력만을 목적으로 하는 페이지라면 nalog_viewer.php라는 파일을 include하면 됩니다.<br>
    <br>
    <span style='font-family:굴림체,GulimChe'>
      &lt;?<br>
      $path = "<font color=#045C8A><b>nalog5</b></font>";<br>
      $counter = "<font color=#045C8A><b><?=$counter?></b></font>";<br>
      include "$path/nalog_viewer.php";<br>
      ?&gt;<br>
    </span>
    <br>
    위와 같이 nalog.php대신에 nalog_viewer.php를 include하였다면, 방문자의 정보저장과 카운팅은 하지 않고, 현재 접속자만을 체크합니다.<br>
    그리고 nalog.php에서와 같은 방법으로 결과를 출력 할 수 있습니다.
  </td></tr>
  <tr><td colspan=2 height=10></td></tr>
  <tr><td colspan=2 height=1 bgcolor=#2CBBFF></td></tr>
</table>

<table width=600 cellpadding=0 cellspacing=0 border=0 align=center>
  <tr>
    <td><font size=1><?=$lang[copy]?></td>
    <td align=right>
      <span style='font-size:6pt'>▶</span>
      <a href="http://navyism.com" target=_blank>질문 및 관련자료</a>
      <span style='font-size:6pt'>▶</span>
      <a href="javascript:window.close()">창닫기</a>
    </td>
  </tr>
</table>
