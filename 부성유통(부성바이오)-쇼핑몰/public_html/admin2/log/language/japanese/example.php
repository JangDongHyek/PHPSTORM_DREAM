<table width=600 cellpadding=3 cellspacing=0 border=0 align=center>
  <tr>
    <td colspan=2>
      <a href="http://navyism.com" target=_blank><img src='nalog_image/logo.gif' border=0></a>
    </td>
  </tr>
  <tr>
    <td>
      <font size=3><b>n@log analyzer <?=$nalog_info[version]?>カウンタ　サンプル : <?=$counter?></b></font>
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
      counter: <b><?=$counter?></b> カウンタを作成しました。<br><br>
    </td>
  </tr>
  <tr>
    <td colspan=2>
      <font size=3><b>1. GDを利用したカウンタ出力 (GDが利用出来る環境のみ)</b></font>
    </td>
  </tr>
  <tr><td colspan=2 height=3 bgcolor=#2CBBFF></td></tr>
  <tr><td colspan=2>
    <table border=0 width=100% cellpadding=5 cellspacing=0>
      <tr>
        <td width=1% nowrap valign=top><img src='<?=$test_gd?>'></td>
        <td width=99% valign=top>
          もし、左に黒いイメージに白い丸が見えたらGDが利用出来るサーバーです。<br>
          GDが利用出来るサーバーでは、次のイメージタグで簡単に n@logを使えます。
        </td>
      </tr>
    </table>
    <br>
    <span style='font-family:MS PGothic,MS Pゴシック'>
      &lt;img src="<b>経路</b>/nalogd.php?counter=<b>カウンタ名</b>&url=&lt;?=$HTTP_SERVER_VARS[HTTP_REFERER]?&gt;" width=0 height=0>
    </span>
    <br><br>
    もし、現在の設定でよければ、次のイメージタグをそのままコピーして使って下さい。<br><br>

<textarea class=input cols=80 rows=2 onclick=select() readonly style='font-family:MS PGothic,MS Pゴシック'>
&lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/nalogd.php",$HTTP_SERVER_VARS[PHP_SELF]);
?>?counter=<?=$counter?>&url=&lt;?=$HTTP_SERVER_VARS[HTTP_REFERER]?&gt;" width=0 height=0></textarea>

    <br><br>
    上記のタグを使うと、カウンタのみ作動し、画面上には出力しません。<br>
    画面上に表記させるには、次のタグを使って下さい。<br><br>

<textarea class=input cols=80 rows=6 onclick=select() readonly style='font-family:MS PGothic,MS Pゴシック'>
今日の訪問者 &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_today.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
昨日の訪問者 &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_yester.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
合計訪問者 &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_total.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
現在接続者 &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_now.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
最大同時接続者 &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_peak.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
最大訪問者 &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_day_peak.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>"></textarea>

    <br><br>
    注意) GDを利用したイメージを適用するには、skinのイメージファイル形式がjpgでないといけません。<br><br>
  </td></tr>
  <tr>
    <td colspan=2>
      <font size=3><b>2. GDを利用しないカウンタ出力 (すべて適用可)</b></font>
    </td>
  </tr>
  <tr><td colspan=2 height=3 bgcolor=#2CBBFF></td></tr>
  <tr><td colspan=2>
    カウンタをページに適用するには、簡単なコードを <font color=#045C8A>適用するページ最上段</font>に入れます。<br><br>
    もし <font color=#045C8A>下記のコードの前に何だかの表記(空白を含み)があれば n@logはエラーメッセージを出し
    <br>クッキーが正常に作動しない問題</font>が出る場合があります。<br><br>
    また、フレームで作った文書に下記のコードを入れれば、訪問者の接続ルートが正常に把握出来ない場合があります。<br><br>
    そのため <font color=#045C8A>出来るだけフレームの文書には、このコードいれず、フレームセット文書に直接入れることをお勧めします。</font><br><br><br>
    例えば、適用するページが <font color=#045C8A>http://navyism.com</font>/index.php で、<br>
    n@logが設置されているルートが <font color=#045C8A>http://navyism.com/nalog5</font>/nalog.php だとすれば
    <br>次のコードをindex.phpの最上段に追加します。<br>
    <br>
    <span style='font-family:MS PGothic,MS Pゴシック'>
      &lt;?<br>
      $path = "<font color=#045C8A><b>nalog5</b></font>";<br>
      $counter = "<font color=#045C8A><b><?=$counter?></b></font>";<br>
      include "$path/nalog.php";<br>
      ?&gt;<br>
    </span>
    <br>
    ページにコードが正常に適用されたのであれば、画面上には何も表示されません。<br><br>
    しかし、このコードの前に文字や記号(空白を含み)があった場合、次のようなエラーが出て、 n@logは起動中止になります。<br><br>
    <font color=#045C8A>n@log analyzer error : 挿入コードをページ最上段に入れて下さい。
    <br>コードの前にはいかなる文字や記号(空白を含み)があってはいけません。</font><br><br>
    適用したページに何も出力せず、エラーメッセージも出なければ、次のようなコードでカウンタ情報を出力出来ます。<br><br>
    基本)<br>
    <span style='font-family:MS PGothic,MS Pゴシック'>&lt;?=$today_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        今日の訪問者出力 (テキスト) → <font color='#666666'><?=$today_text?></font><br>
    <span style='font-family:MS PGothic,MS Pゴシック'>&lt;?=$yester_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        昨日の訪問者出力 (テキスト) → <font color='#666666'><?=$yester_text?></font><br>
    <span style='font-family:MS PGothic,MS Pゴシック'>&lt;?=$total_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        合計訪問者出力 (テキスト) → <font color='#666666'><?=$total_text?></font><br>
    <span style='font-family:MS PGothic,MS Pゴシック'>&lt;?=$now_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        現在接続者出力 (テキスト) → <font color='#666666'><?=$now_text?></font><br>
    <span style='font-family:MS PGothic,MS Pゴシック'>&lt;?=$peak_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        最大同時接続者出力 (テキスト) → <font color='#666666'><?=$peak_text?></font><br>
    <span style='font-family:MS PGothic,MS Pゴシック'>&lt;?=$day_peak_text?&gt;&nbsp;&nbsp;:</span>
        最大訪問者出力 (テキスト) → <font color='#666666'><?=$day_peak_text?></font><br>
    <br>
    戚耕走)<br>
    <span style='font-family:MS PGothic,MS Pゴシック'>&lt;?=$today_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        今日の訪問者出力 (イメージ) → <?=$today_image?><br>
    <span style='font-family:MS PGothic,MS Pゴシック'>&lt;?=$yester_image?&gt;&nbsp;&nbsp;&nbsp;:</span>
        昨日の訪問者出力 (イメージ) → <?=$yester_image?><br>
    <span style='font-family:MS PGothic,MS Pゴシック'>&lt;?=$total_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        合計訪問者出力 (イメージ) → <?=$total_image?><br>
    <span style='font-family:MS PGothic,MS Pゴシック'>&lt;?=$now_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        現在接続者出力 (イメージ) → <?=$now_image?><br>
    <span style='font-family:MS PGothic,MS Pゴシック'>&lt;?=$peak_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        最大同時接続者出力 (イメージ) → <?=$peak_image?><br>
    <span style='font-family:MS PGothic,MS Pゴシック'>&lt;?=$day_peak_image?&gt;&nbsp;:</span>
        最大訪問者出力 (イメージ) → <?=$day_peak_image?><br>
    <br>
    skinパターン使用)<br>
    <span style='font-family:MS PGothic,MS Pゴシック'>&lt;?=$nalog_result?&gt;&nbsp;&nbsp;&nbsp;:</span>
        スキンパターン(skin.php)を参考し、イメージ出力 (スキンパターン適用時)<br>
    <br>
    <?=$nalog_result?><br><br>
    nalog.phpは訪問者のチェックと同時に、出力値を表記する役割をしています。<br><br>
    しかし、訪問者チェックはせず、現在接続者のチェックと出力のみ使うページであれば<br>
    nalog_viewer.phpというファイルを includeして下さい。<br>
    <br>
    <span style='font-family:MS PGothic,MS Pゴシック'>
      &lt;?<br>
      $path = "<font color=#045C8A><b>nalog5</b></font>";<br>
      $counter = "<font color=#045C8A><b><?=$counter?></b></font>";<br>
      include "$path/nalog_viewer.php";<br>
      ?&gt;<br>
    </span>
    <br>
    上記のように　nalog.phpの代わりに nalog_viewer.phpを includeした場合は<br>
    訪問者の情報保存とカウンタはせず、現在接続者のみチェックします。<br>
    そして、 nalog.phpと同じやり方で結果を出力出来ます。
  </td></tr>
  <tr><td colspan=2 height=10></td></tr>
  <tr><td colspan=2 height=1 bgcolor=#2CBBFF></td></tr>
</table>

<table width=600 cellpadding=0 cellspacing=0 border=0 align=center>
  <tr>
    <td><font size=1><?=$lang[copy]?></td>
    <td align=right>
      <span style='font-size:6pt'>&nbsp;&nbsp;</span>
      <a href="http://navyism.com" target=_blank>質問 及び 関連資料</a>
      <span style='font-size:6pt'>&nbsp;&nbsp;</span>
      <a href="javascript:window.close()">閉じる</a>
    </td>
  </tr>
</table>
