<?
	include "../lib/myfunc.php";

	// 편법검사
	wrest();

	$to = "heroyeo@lets080.com";
//	$to = "letskt080@paran.com";
	$toName = "관리자";
	$_site_url = "http://www.multiall.co.kr/market/";
	$subject = "업무제휴 문의입니다.";
	$from = $subject32;
	$fromName = $subject3;

	$new_name = time();

	$arr_files = multiFileUpload("subject5", "../../up/multiall/", $new_name);
	$file_src = $arr_files[0]['name'];

	print_r($arr_files);

	if($file_src)
		$file_href_src = "<a href='{$_site_url}../../up/multiall/$file_src'>[첨부파일]</a>";
	else
		$file_href_src = "파일없음";

	$textarea2 = nl2br($textarea2);

$comment = "
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<HTML>
<HEAD>
<TITLE> $subject </TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=euc-kr\">
<meta http-equiv=\"imagetoolbar\" content=\"no\">
<link href=\"{$_site_url}css/style.css\" rel=\"stylesheet\" type=\"text/css\">
</HEAD>
<BODY>
<!-- 신청서 시작 --><br>
																	<table width=\"500\" border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">
                                    <tr>
                                      <td width=\"120\" height=\"25\"><img src=\"{$_site_url}img/company6_s1.gif\" width=\"120\" height=\"25\"></td>
                                      <td>$select</td>
                                    </tr>
                                    <tr>
                                      <td height=\"1\" colspan=\"2\" bgcolor=\"#CCCCCC\"></td>
                                      </tr>
                                    <tr>
                                      <td height=\"25\"><div align=\"left\"><img src=\"{$_site_url}img/company6_s2.gif\" width=\"120\" height=\"25\"></div></td>
                                      <td>$company</td>
                                    </tr>
                                    <tr>
                                      <td height=\"1\" colspan=\"2\" bgcolor=\"#CCCCCC\"></td>
                                      </tr>
                                    <tr>
                                      <td height=\"25\"><div align=\"left\"><img src=\"{$_site_url}img/company6_s3.gif\" width=\"120\" height=\"25\"></div></td>
                                      <td>$subject2</td>
                                    </tr>
                                    <tr>
                                      <td height=\"1\" colspan=\"2\" bgcolor=\"#CCCCCC\"></td>
                                      </tr>
                                    <tr>
                                      <td height=\"25\"><div align=\"left\"><img src=\"{$_site_url}img/company6_s4.gif\" width=\"120\" height=\"25\"></div></td>
                                      <td>$subject3</td>
                                    </tr>
                                    <tr>
                                      <td height=\"1\" colspan=\"2\" bgcolor=\"#CCCCCC\"></td>
                                      </tr>
                                    <tr>
                                      <td height=\"25\"><div align=\"left\"><img src=\"{$_site_url}img/company6_s5.gif\" width=\"120\" height=\"25\"></div></td>
                                      <td>$subject32</td>
                                    </tr>
                                    <tr>
                                      <td height=\"1\" colspan=\"2\" bgcolor=\"#CCCCCC\"></td>
                                      </tr>
                                    <tr>
                                      <td height=\"25\"><div align=\"left\"><img src=\"{$_site_url}img/company6_s6.gif\" width=\"120\" height=\"25\"></div></td>
                                      <td>$subject4 - $subject42 - $subject43</td>
                                    </tr>
                                    <tr>
                                      <td height=\"1\" colspan=\"2\" bgcolor=\"#CCCCCC\"></td>
                                      </tr>
                                    <tr>
                                      <td height=\"25\"><div align=\"left\"><img src=\"{$_site_url}img/company6_s7.gif\" width=\"120\" height=\"25\"></div></td>
                                      <td>$file_href_src</td>
                                    </tr>
                                    <tr>
                                      <td height=\"1\" colspan=\"2\" bgcolor=\"#CCCCCC\"></td>
                                      </tr>
                                    <tr>
                                      <td height=\"25\" valign=\"top\"><img src=\"{$_site_url}img/company6_s8.gif\" width=\"120\" height=\"25\"></td>
                                      <td>$textarea2</td>
                                    </tr>
                                  </table>
<!-- 신청서 끝 -->
</body>
</html>";

	echo $comment."<br>";

//	$return = sendMail("1", $to, $toName, $from, $fromName, $subject, $comment);
	echo "Return : ".$return;

//	alertRedirect("신청되었습니다.", "../index.htm");	
?>