<style><!-- 

A:link { color: #404040; text-decoration:none; } 
A:visited { color: #404040; text-decoration:none; } 
A:active { color: #404040; text-decoration:none; } 
A:hover { color: #FF0000; text-decoration:none; } 
--></style>
<? 

mysql_connect("localhost","heerak","ffpcm080"); 
mysql_select_db("heerak"); 

$result=mysql_query("select * from zetyx_board_notice order by date_free desc limit 5");
while($data=mysql_fetch_array($result)) 
{ 
$data[subject] = stripslashes($data[subject]);   
  $max = 50;
  $count = strlen($data[subject]); 
  if($count >= $max) { 
  for ($pos=$max;$pos>0 && ord($new[subject][$pos-1])>=127;$pos--); 
  if (($max-$pos)%2 == 0) 
  $data[subject] = substr($data[subject], 0, $max) . "....."; 
  else 
  $data[subject] = substr($data[msubject], 0, $max+1) . "....."; 
  } 
  else { 
  $data[subject] = "$data[subject]"; 
  }   
echo " <tr><td height=25><img src='images/icon.gif' align='absmiddle'>&nbsp;<span style='font-size:9pt;'>[$data[date_free]] <a href=./bbs/view.php?id=notice&no=$data[no]>".nl2br($data[subject])."</a></span></td></tr>";
} 
mysql_close(); 
?>
