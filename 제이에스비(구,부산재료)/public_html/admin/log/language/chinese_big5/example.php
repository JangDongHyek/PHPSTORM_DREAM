<table width=600 cellpadding=3 cellspacing=0 border=0 align=center>
  <tr>
    <td colspan=2>
      <a href="http://navyism.com" target=_blank><img src='nalog_image/logo.gif' border=0></a>
    </td>
  </tr>
  <tr>
    <td>
      <span style='font-size:12pt'><b>n@log analyzer <?=$nalog_info[version]?> 計數器使用方法範例</b></span>
    </td>
    <td align=right>
      文本翻譯：<a href="http://kiddiken.net" target=_blank>驚直(kiddiken)</a>
    </td>
  </tr>
  <tr>
    <td colspan=2 height=3 bgcolor=#2CBBFF></td>
  </tr>
</table>

<table width=600 cellpadding=3 cellspacing=0 border=0 align=center>
  <tr>
    <td colspan=2>
      您已經成功地建立並啟用了一個名叫 <b><?=$counter?></b> 的計數器。<br>
      說明文本會以這個計數器的設定來向您解釋計數器的使用方法範例。<br><br>
    </td>
  </tr>
  <tr>
    <td colspan=2>
      <span style='font-size:11pt'><b>1. 利用 GD 模組的功能自動建立計數器圖檔</b> (前提是您的主機必須支援 GD 模組功能)</span>
    </td>
  </tr>
  <tr><td colspan=2 height=3 bgcolor=#2CBBFF></td></tr>
  <tr><td colspan=2>
    <table border=0 width=100% cellpadding=5 cellspacing=0>
      <tr>
        <td width=1% nowrap valign=top><img src='<?=$test_gd?>'></td>
        <td width=99% valign=top>
          請看看左方的圖檔。如果這個圖檔是一個黑色的正方形，而裡面有一個白色的圓形的話，那就表示您的主機支援 GD 模組功能。這樣當您使用 n@log 來顯示計數器圖檔簡直是輕而易舉！您只須在頁面執行以下這個 IMG 語法，當頁面載入時，程式便會在您的 n@log 資料夾自動建立所需的圖檔。
        </td>
      </tr>
    </table>
    <br>
    <span style='font-family:細明體,MingLiU'>
      &lt;img src="<b>n@log程式路徑</b>/nalogd.php?counter=<b>計數器名稱</b>&url=&lt;?=$HTTP_SERVER_VARS[HTTP_REFERER]?&gt;" width=0 height=0>
    </span>
    <br><br>
    現在我會嘗試偵測您的 n@log 設定值，然後在下面的文字框裡將 IMG 語法寫出來，讓您不用操心語法該怎麼寫。如果您認為這些語法都正確無誤的話，您便可以放心將這些語法複製後貼上您的頁面裡。<br><br>

<textarea class=input cols=80 rows=3 onclick=select() readonly style='font-family:細明體,MingLiU;padding:4px'>
&lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/nalogd.php",$HTTP_SERVER_VARS[PHP_SELF]);
?>?counter=<?=$counter?>&url=&lt;?=$HTTP_SERVER_VARS[HTTP_REFERER]?&gt;" width=0 height=0></textarea>

    <br><br>
    如果您在頁面使用了這個語法，當頁面載入時，計數器便會正常運作，但是計數器本身是隱藏起來的。<br>
    您可以使用下列的語法來顯示您想要的計數器圖檔：<br><br>

<textarea class=input cols=80 rows=7 onclick=select() readonly style='font-family:細明體,MingLiU;padding:4px'>
今天瀏覽人次 &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_today.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
昨天瀏覽人次 &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_yester.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
總計瀏覽人次 &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_total.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
目前線上人數 &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_now.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
同時在線高峰 &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_peak.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>">
日瀏覽人次高峰 &lt;img src="http://<?
echo $HTTP_SERVER_VARS[HTTP_HOST].eregi_replace("/example.php$","/".$counter."_day_peak.jpg",$HTTP_SERVER_VARS[PHP_SELF]);
?>"></textarea>

    <br><br>
    注意：所有利用 GD 模組自動建立的計數器圖檔都是 JPEG 格式 (副檔名為 .jpg) 的。<br><br>
  </td></tr>
  <tr>
    <td colspan=2>
      <span style='font-size:11pt'><b>2. 在不使用 GD 模組的情況下，輸出計數器結果的方式</b> (應適用於所有環境)</span>
    </td>
  </tr>
  <tr><td colspan=2 height=3 bgcolor=#2CBBFF></td></tr>
  <tr><td colspan=2>
    一般來說，您只要將下面一段簡單的 PHP 原始碼放在<font color=#045C8A>頁面檔案的開頭</font>，這樣當頁面載入時，便能夠將網站流量的資料傳給 n@log 程式。<br><br>
    然而，<font color=#045C8A>假如你將這段原始碼放在框架裡面的某一頁，n@log 便無法取得訪客的來源主機和網址等重要資料</font>。同時會在一些情況下，導致 n@log 程式不能正常運作。<br><br>
    所以<font color=#045C8A>請盡可能不要將這段原始碼放在框架裡面的某一頁</font>。如果可以的話，請將這段原始碼放在包含 FRAMESET (框架設定) 語法的同一頁，而非框架裡面的子頁。<br><br><br>
    舉例說明，假如您的首頁位址是 <font color=#045C8A>http://navyism.com</font>/index.php 而您的 n@log 主程式路徑是 <font color=#045C8A>http://navyism.com/nalog5</font>/nalog.php，您便可以在您的 index.php 頁面檔案的最開頭，加入以下這段 PHP 原始碼。(請緊記不要在 include 的敘述句使用絕對路徑!)<br>
    <br>
    <span style='font-family:細明體,MingLiU'>
      &lt;?<br>
      $path = "<font color=#045C8A><b>nalog5</b></font>";<br>
      $counter = "<font color=#045C8A><b><?=$counter?></b></font>";<br>
      include "$path/nalog.php";<br>
      ?&gt;<br>
    </span>
    <br>
    如果您將這段 PHP 原始碼正確地放在頁面的話，當頁面載入時，您應該不會感覺跟先前有分別，這可是正常的。<br><br>
    然而，假若在這段 PHP 原始碼的前面有出現任何字元 (包括半形空白)，或是您使用了嵌入文件 (include) 的方式在這之前嵌入其他的檔案，這樣都會令 n@log 計數器停止運作，而且會彈出錯誤訊息的警告視窗，告訴您應該將這段原始碼放在頁面檔案最開頭的地方。<br><br>
    基本上，顯示計數器結果的方式有兩種，分別是<b>文字及圖形</b>，而 n@log 計數器可以為您算出五種形式的數值。此外，您亦可以選擇利用<b>面板圖樣</b> (Skin Pattern) 的方式來設計一個整合式的計數器圖檔格式輸出到頁面。<br><br>
    要在頁面上顯示計數器，您需要用到 PHP 的 echo 函數 ( &lt;?=$variable?&gt; ) 來協助輸出。以下列出 n@log 程式指定的這些變數名稱：<br><br>
    【以文字顯示】<br><br>
    <span style='font-family:細明體,MingLiU'>&lt;?=$today_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        今天(截至目前)的瀏覽人次 [文字] → <font color='#666666'><?=$today_text?></font><br>
    <span style='font-family:細明體,MingLiU'>&lt;?=$yester_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        昨天的瀏覽人次 [文字] → <font color='#666666'><?=$yester_text?></font><br>
    <span style='font-family:細明體,MingLiU'>&lt;?=$total_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        總計瀏覽人次 [文字] → <font color='#666666'><?=$total_text?></font><br>
    <span style='font-family:細明體,MingLiU'>&lt;?=$now_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        目前線上人數 [文字] → <font color='#666666'><?=$now_text?></font><br>
    <span style='font-family:細明體,MingLiU'>&lt;?=$peak_text?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        同時在線高峰(同時連線的人次峰值) [文字] → <font color='#666666'><?=$peak_text?></font><br>
    <span style='font-family:細明體,MingLiU'>&lt;?=$day_peak_text?&gt;&nbsp;&nbsp;:</span>
        日瀏覽人次高峰(在同一天記錄得最高瀏覽人次) [文字] → <font color='#666666'><?=$day_peak_text?></font><br>
    <br>
    【以圖形顯示】<br><br>
    <span style='font-family:細明體,MingLiU'>&lt;?=$today_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        今天(截至目前)的瀏覽人次 [圖形] → <?=$today_image?><br>
    <span style='font-family:細明體,MingLiU'>&lt;?=$yester_image?&gt;&nbsp;&nbsp;&nbsp;:</span>
        昨天的瀏覽人次 [圖形] → <?=$yester_image?><br>
    <span style='font-family:細明體,MingLiU'>&lt;?=$total_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        總計瀏覽人次 [圖形] → <?=$total_image?><br>
    <span style='font-family:細明體,MingLiU'>&lt;?=$now_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        目前線上人數 [圖形] → <?=$now_image?><br>
    <span style='font-family:細明體,MingLiU'>&lt;?=$peak_image?&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
        同時在線高峰(同時連線的人次峰值) [圖形] → <?=$peak_image?><br>
    <span style='font-family:細明體,MingLiU'>&lt;?=$day_peak_image?&gt;&nbsp;:</span>
        日瀏覽人次高峰(在同一天記錄得最高瀏覽人次) [圖形] → <?=$day_peak_image?><br>
    <br>
    【以面板圖樣顯示】<br><br>
    <span style='font-family:細明體,MingLiU'>&lt;?=$nalog_result?&gt;&nbsp;&nbsp;&nbsp;:</span>
        利用預先設計好的面板圖樣來顯示您心目中的計數器格式圖檔。<br>
    <br>
    <?=$nalog_result?><br>(請參考面板資料夾裡面的 skin.php 檔案來自訂您想要的格式)<br><br><br>
    nalog.php 這個檔案的用途是記錄網站流量資料和輸出結果的。<br><br>
    然而，假若您使用 n@log 的目的只是用來計算目前線上人數，而沒有理會所有關於網站流量或來源網址等的資料，建議您使用 nalog_viewer.php 來代替 nalog.php，這樣可以減少網路資源的損耗。<br>
    <br>
    <span style='font-family:細明體,MingLiU'>
      &lt;?<br>
      $path = "<font color=#045C8A><b>nalog5</b></font>";<br>
      $counter = "<font color=#045C8A><b><?=$counter?></b></font>";<br>
      include "$path/nalog_viewer.php";<br>
      ?&gt;<br>
    </span>
    <br>
    正如上文提到，如果您使用這段 PHP 原始碼代替前面的那一段，n@log 將不會分析您的網站流量資料，而只是做為監察網站上有多少人同時在線上的程式。<br>
    <br>
    事實上，您可以在每一個頁面的原始碼嵌入 nalog_viewer.php 這個檔案，這樣您就可以在網站的每一頁都可以顯示計數器內容。nalog_viewer.php 這個檔案的目的，並不是要新增訪客的記錄，而是用來準確地顯示目前的計數器統計資料。
  </td></tr>
  <tr><td colspan=2 height=10></td></tr>
  <tr><td colspan=2 height=1 bgcolor=#2CBBFF></td></tr>
</table>

<table width=600 cellpadding=0 cellspacing=0 border=0 align=center>
  <tr>
    <td><font size=1><?=$lang[copy]?></td>
    <td align=right>
      <span style='font-size:6pt'>&#9654;</span>
      更多資訊或技術支援 [ <a href="http://kiddiken.net" target=_blank>繁體中文</a> |
      <a href="http://navyism.com" target=_blank>韓文</a> |
      <a href="http://english.navyism.com" target=_blank>英文</a> ]
      <span style='font-size:6pt'>&#9654;</span>
      <a href="javascript:window.close()">關閉</a>
    </td>
  </tr>
</table>
