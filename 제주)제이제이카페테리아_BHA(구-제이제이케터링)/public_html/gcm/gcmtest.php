<?

		$postNo = "1";
		$post_title = iconv("euc-kr","utf-8","123");
		$post_content = iconv("euc-kr","utf-8","456");
		$url = "http://www.naver.com";
		$gcmtest = true;
		include("../gcm/sendGcm.php");