function flash(c,d,e) {
 var flash_tag = "";
 flash_tag = '<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" ';
 flash_tag +='codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" ';
 flash_tag +='WIDTH="'+c+'" HEIGHT="'+d+'" >';
 flash_tag +='<param name="wmode" value="transparent">'; 
 flash_tag +='<param name="movie" value="'+e+'">';
 flash_tag +='<param name="quality" value="high">';
 flash_tag +='<embed src="'+e+'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" ';
 flash_tag +='type="application/x-shockwave-flash"  WIDTH="'+c+'" HEIGHT="'+d+'"></embed></object>'
 document.write(flash_tag);
}