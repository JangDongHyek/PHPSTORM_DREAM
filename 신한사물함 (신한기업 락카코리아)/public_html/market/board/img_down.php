<?
$dnfile = $target;  //������������(�������)
$dnfilen = $target;  //����ڿ��� �ٿ�޾��� ���ϸ�

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
  echo "<script>alert('�ش� ������ �������� �ʽ��ϴ�.');history.back();</script>";
}
?>
