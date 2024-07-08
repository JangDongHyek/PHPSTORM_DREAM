<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE> New Document </TITLE>
  <META NAME="Generator" CONTENT="EditPlus">
  <META NAME="Author" CONTENT="">
  <META NAME="Keywords" CONTENT="">
  <META NAME="Description" CONTENT="">
  <script>
function autoResize(i){
    var iframeHeight= i.contentWindow.document.body.scrollHeight;
    i.height=iframeHeight+20;
}
</script>
<script>
 function resizeHeight(fr) {
  fr = typeof fr == 'string' ? document.getElementById(fr) : fr;
  fr.setExpression('height',newmain.document.body.scrollHeight);  }
</script>
 </HEAD>

 <BODY>
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<div align=center>
  <iframe name="newmain" border=0 marginwidth=0 marginheight=0 src="../list.php?bbs_id=yeyak_list" frameborder=0 width=1400px scrolling=no onload="autoResize(this)"></iframe>
 </div>
<? include("admin.footer.php"); ?>
 </BODY>
</HTML>
