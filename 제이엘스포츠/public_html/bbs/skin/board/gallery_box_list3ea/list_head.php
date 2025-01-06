<script> 
var qTipTag = "a"; 
var qTipX = 0; 
var qTipY = 15; 
 
tooltip = {
  name : "qTip",
  offsetX : qTipX,
  offsetY : qTipY,
  tip : null
}
 
tooltip.init = function () {
    var tipNameSpaceURI = "http://www.w3.org/1999/xhtml";
    if(!tipContainerID){ var tipContainerID = "qTip";}
    var tipContainer = document.getElementById(tipContainerID);
 
    if(!tipContainer) {
      tipContainer = document.createElementNS ? document.createElementNS(tipNameSpaceURI, "div") : document.createElement("div");
        tipContainer.setAttribute("id", tipContainerID);
      document.getElementsByTagName("body").item(0).appendChild(tipContainer);
    }
 
    if (!document.getElementById) return;
    this.tip = document.getElementById (this.name);
    if (this.tip) document.onmousemove = function (evt) {tooltip.move (evt)};
 
    var a, sTitle, elements;
    
    var elementList = qTipTag.split(",");
    for(var j = 0; j < elementList.length; j++)
    {    
        elements = document.getElementsByTagName(elementList[j]);
        if(elements)
        {
            for (var i = 0; i < elements.length; i ++)
            {
                a = elements[i];
                sTitle = a.getAttribute("title");                
                if(sTitle)
                {
                    a.setAttribute("tiptitle", sTitle);
                    a.removeAttribute("title");
                    a.removeAttribute("alt");
                    a.onmouseover = function() {tooltip.show(this.getAttribute('tiptitle'))};
                    a.onmouseout = function() {tooltip.hide()};
                }
            }
        }
    }
}
 
tooltip.move = function (evt) {
    var x=0, y=0;
    if (document.all) {//IE
        x = (document.documentElement && document.documentElement.scrollLeft) ? document.documentElement.scrollLeft : document.body.scrollLeft;
        y = (document.documentElement && document.documentElement.scrollTop) ? document.documentElement.scrollTop : document.body.scrollTop;
        x += window.event.clientX;
        y += window.event.clientY;
        
    } else {//Good Browsers
        x = evt.pageX;
        y = evt.pageY;
    }
    this.tip.style.left = (x + this.offsetX) + "px";
    this.tip.style.top = (y + this.offsetY) + "px";
}
 
tooltip.show = function (text) {
    if (!this.tip) return;
    this.tip.innerHTML = text;
    this.tip.style.display = "block";
}
 
tooltip.hide = function () {
    if (!this.tip) return;
    this.tip.innerHTML = "";
    this.tip.style.display = "none";
}
 
function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = func;
  } else {
    window.onload = function() {
      if (oldonload) {
        oldonload();
      }
      func();
    }
  }
}
 
addLoadEvent(function() {
  tooltip.init ();
});
 
</script>
 
<style> 
#qTip {
padding: 3px;
border: 1px solid #666;
display: none;
background: #fff;
color: #000;
font: bold 11px Verdana, Arial, Helvetica, sans-serif;
text-align: left;
position: absolute;
z-index: 1000;
}
 
i {
  font-style: normal;
  text-decoration: underline;
 
}
</style>

<?
$l_cols = 0;
?>
<table width="<?=$width?>" cellpadding=0 cellspacing=0 border=0>
<tr>
	<td width=50% align="right" class="bbs"><!--<?=$page?>/<?=$total_page?>, ÃÑ °Ô½Ã¹° : <?=$total_doc_count?>--></td>
</tr>
</table>


<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>" border=0>
<!--<TR>
	<TD bgcolor=#80a8de height=6></TD>
</TR>-->
<TR> 
	<TD>
	<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 style="table-layout:fixed">
	<form name=form_list method='post' action=''>
	<input type=hidden name=bbs_id value='<?=$bbs_id?>'>
	<input type=hidden name=page value='<?=$page?>'>
