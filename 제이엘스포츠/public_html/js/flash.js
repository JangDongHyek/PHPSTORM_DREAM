// src   : source url
// fid   : flash id
// width : source width
// height: source height
// mode  : wmode ("" for none, transparent, opaque ...)
function flash(src,fid,width,height,mode){
  document.write("<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\" width=" + width + " height=" + height + " id=" + fid + "><param name=wmode value=" + mode + " /><param name=movie value=" + src + " /><param name=quality value=high /><param name=salign value=L><param name=scale value=noscale><embed src=" + src + " quality=high wmode=" + mode + " type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?p1_prod_version=shockwaveflash\" width=" + width + " height=" + height + "></embed></object>");
}

// write document contents
function print(src){
  //document.write(src);
}
