<?php


$url  = "https://www.hostmeca.com/user_mail_relay.php";

$post = array();

$post['uid']       = "lets080"; // ȸ�� ���̵� (�ʼ��Է�)
$post['from']      = "$from"; // ������ ��� �����ּ� (�ʼ��Է�)
$post['from_name'] = "$from_name"; // ������ ��� �̸�
$post['to']        = "$to"; // �޴� ��� ���� �ּ� (�ʼ��Է�)
$post['to_name']   = "$to_name"; // �޴� ��� �̸�
$post['subject']   = "$subject"; // ���� ���� (�ʼ��Է�)
$post['content']   = "$content"; // ���� ���� (�ʼ��Է�)
$post['html']      = "Y"; // html ���� ����.(Y : html ����, N : text ����)


/*
echo $from;
echo $from_name;
echo $to;
echo $to_name;
echo $subject;
echo $content;


exit;

*/

$post = funcEuckrToUtf8($post);


$curl = curl_init(); 

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
curl_setopt($curl, CURLOPT_POST, 1); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($curl, CURLOPT_POSTFIELDS, $post);

$output = curl_exec($curl);

curl_close($curl);

//$data = json_decode($output, true);

//echo "<pre>";
//var_dump($data);
//echo "<pre>";

/*
$data �迭��
$data['rslt'] // ����� (true, false)
$data['code'] // ��� �ڵ尪
$data['msg']  // ��� �޼���
*/

echo mb_convert_encoding($data['msg'], "EUC-KR", "UTF-8");

echo "<script>alert('������ ���۵Ǿ����ϴ�.');location.href='./member_list.php';</script>";



/*
// ��� �ڵ尪
S00 - ����
E01 - ���Ե� ȸ���� �ƴ�
E02 - �����̿� ������ ȸ���� �ƴ�
E03 - ���� ������ ������ �ƴ�
E04 - ������ ��� �����ּ� ����
E05 - ������ ��� �����ּ� ���Ŀ���
E06 - �޴� ��� �����ּ� ����
E07 - �޴� ��� �����ּ� ���Ŀ���
E08 - ���� ���� ����
E09 - ���� ���� ����
E10 - ���� �߼۽� ����
*/







/******************************************************************************
 - �Լ��� : funcEuckrToUtf8($str)
 - ��  �� : EUC-KR ���ڸ� UTF-8 ���ڷ� ��ȯ�ϴ� �Լ�.
 - �Ӽ��� : $str - EUC-KR ����
 - ����� : UTF-8�� ��ȯ�� ���� ��ȯ
******************************************************************************/

function funcEuckrToUtf8($str) {
   $str = (!is_array($str)) ? mb_convert_encoding($str, "UTF-8", "EUC-KR") : array_map("funcEuckrToUtf8", $str);

   return $str;
}

?>