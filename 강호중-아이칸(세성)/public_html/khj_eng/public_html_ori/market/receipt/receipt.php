<html>
<head>
<title>¿µ¼öÁõ</title>
<script langauage="Javascript">
<!-- 
  function hidestatus(){ 
  window.status='' 
  return true 
  } 

  if (document.layers) 
  document.captureEvents(Event.MOUSEOVER | Event.MOUSEOUT) 

  document.onmouseover=hidestatus 
  document.onmouseout=hidestatus 
//--> 
</script> 
</head>

<frameset framespacing="0" border="false" frameborder="0" rows="500,*">
<frame name='rec_top' src='receipt_top.php?mart_id=<?=$mart_id?>&order_num=<?=$order_num?>'  marginwidth='0' marginheight='0' scrolling='auto' frameborder='n'o>
<frame name='blank' src='receipt_bottom.php' marginwidth='0' marginheight='0' scrolling='no' frameborder='no'>
  <noframes>
  <body>
  <p>This page uses frames, but your browser doesn't support them.</p>
  </body>
  </noframes>
</frameset>
</html>