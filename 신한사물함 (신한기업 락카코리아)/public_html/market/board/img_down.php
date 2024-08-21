<?
$dnfile = $target;  //서버실제파일(경로포함)
$dnfilen = $target;  //사용자에게 다운받아질 파일명

if (is_file($dnfile)) {

 Header("Content-type: file/unknown");
 Header("Content-Length: ".(string)(filesize($dnfile)));
 Header("Content-Disposition: attachment; filename=".$dnfilen."");
 Header("Content-Transfer-incoding: utf-8"); 
 Header("Content-Transfer-Encoding: binary");  
 Header("Pragma: no-cache");
 Header("Expires: 0");


 $fp = fopen($dnfile, "rb");

 if (!fpassthru($fp)) {
     fclose($fp);

 }
  echo "<script>window.close();</script>";
} else {
  echo "<script>alert('해당 파일이 존재하지 않습니다.');history.back();</script>";
}
?>
