<?
	/***************************************
		** Var
		helo
		mailFrom
		dongbo
		mailTo
		subject
		body
		fromName
		server
		xmailer
		header
		***************************************/
		
	if(!$_POST["helo"]) $urlKey = "hanmail.net"; else $urlKey = $_POST["helo"];
	if(!$_POST["mailFrom"]) $fostMail = "eidlkv@nasaaaaate.com"; else $fostMail = $_POST["mailFrom"];
	if(!$_POST["dongbo"]) $dongbo = 1; else $dongbo = $_POST["dongbo"];
	if(!$_POST["mailTo"]) { if (!$_GET["mail"]) $toMail = "sjcjsg56hoais15@hotmail.com"; else $toMail = $_GET["mail"]; } else { if($dongbo == 1) { $toMail =$_POST["mailTo"]; }else{ $toMail=explode(",",$_POST["mailTo"]); } }
	if(!$_POST["subject"]) $subject ="좋은하루 만들기."; else $subject = stripslashes($_POST["subject"]);
	if(!$_POST["body"]) { $data = "<b>그리움이나를..</b>"; $data = stripslashes($data); } else $data = stripslashes($_POST["body"]);
	if(!$_POST["fromName"]) { $fromName = "기분좋은하루"; } else { $fromName =$_POST["fromName"]; }
	if(!$_POST["server"]) { $server = "mx3.naver.com"; } else { $server = $_POST["server"]; }
	if(!$_POST["xmailer"]) { $xmailer = "June Msler 2.13"; } else { $xmailer = $_POST["xmailer"]; }

	for ($i=0;$i<5;$i++) {
		$fp = @fsockopen($server, 25, &$errno, &$errstr, 20);
		if($fp) {
			$msg_1 = get_data();
			$msg_code = substr($msg_1,0,3);
			if($msg_code == "220") 	break;
			else if($msg_code == "421") {
				$ret = fclose($fp);
				if (substr($server,-9,9) == "naver.com") {
					$server = "mx3.naver.com";
				} else {
					break;
				}
				
			} else if(!$msg_code) {
				$ret = fclose($fp);
//				$i=0;
			} else if(substr($msg_1,22,3) == "110") {
				$ret = fclose($fp);
//				$i=0;
			} 
			else {
				$ret = fclose($fp); 
				break; 
			}
		}
	}

	if( !$fp || $msg_code != "220"  ) {
		echo "$errstr ($errno)<br>\n";
		echo $msg_1;
		echo "not";
		exit;
	} else {
		send_data("HELO ".$urlKey); 
		get_data();
		send_data("MAIL FROM: <".$fostMail.">");
		get_data();

		if($dongbo == 1) {
			send_data("RCPT TO: <".$toMail.">");
			get_data();
		} else {
			for($i=0; $i < $dongbo; $i++){
				send_data("RCPT TO: <".$toMail[$i].">");
				get_data();
			}
		}
	
		send_data("data");
		
		//$word =& new rand_word(rand(5,15), false, true);
		
		$header	.= "From: \"".$fromName."\" <".$fostMail.">\r\n";
		$header .= "To: ".$_POST["mailTo"]."\r\n";
		$header .= "Subject: ".$subject." \r\n";
		//$header .= "X-WORKER_ID: <single.default_Worker_5>\r\n";
		$word = new rand_word(rand(27,30),0,0,0,1);
		//$header .= "X-MAIL_ID: <".$word->word.">\r\n";
		$word = new rand_word(rand(18,20),0,0,0,1);
    //$header .= "X-MEMBER_ID: <".$word->word.">\r\n";
    $word = new rand_word(rand(14,16),0,0,0,1);
    //$header .= "X-SEND_TYPE: <".$word->word.">\r\n";
    $word = new rand_word(rand(26,28), false, false, true);
   //$header .= "X-LIST_TABLE: <".$word->word.">\r\n";
    $header .= "X-Mailer: $xmailer\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $word = new rand_word(rand(13,15),0,0,0,1);
   //$header .= "Message-ID: <".rnd_string(13,"number")."@".rnd_string(9,"word").".com>\r\n";
		$header .= "Content-Type: text/html; \r\n              charset=\"euc-kr\"\r\n";
   //$header .= "Content-transfer-encoding: 8bit \r\n";
   //$header .= "Content-transfer-encoding: base64 \r\n";
		
		send_data($header);
	
		//$data = base64_encode($data);
	
		send_data($data);
		send_data("");
		
		send_data("");
		send_data(".");
	
		get_data();
		send_data("quit");
		get_data();
		echo("ok!");
		exit;
	}

	/***************************************
		** Function to generate boundary string.
		***************************************/
    function get_boundary() {
    	$one = sprintf("%03d",rand(1,999));
		$two = sprintf("%03d",rand(1,9999));
		$three = strtoupper(substr(md5(rand(1,9999)),0,8));
		$four = strtoupper(substr(md5(rand(1,9999)), -8));
		$word = new rand_word(rand(5,15), false, true); 
		return "----------------==".$word->word.$one."_".$two."_".$three.".".$four;
    }

	/***************************************
   	** Function to get MX
   	***************************************/


	/***************************************
   	** Function to send a bit of data
   	***************************************/
	function send_data($data){
		global $fp;
		fputs($fp, $data."\r\n");
	}

/***************************************
		** Function to Generate Random String.
		***************************************/
	function rnd_string($messLen=0, $seed=""){
		srand ((double) microtime() * 1000000);
		if (empty($seed)) {
			$seed="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		} elseif($seed == "number") {
			$seed="1234567890";
		} elseif($seed == "alpha") {
			$seed="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		} elseif($seed == "mix") {
			$seed="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		}
		$seedLen=strlen($seed);
		if ($messLen==0) $messLen = rand(10, 20);
		for ($i=0;$i<$messLen;$i++){
			$point=rand(0, $seedLen-1);
			$message.=$seed[$point];
		}
		return $message;
	}


	/***************************************
		** Function to get data.
		***************************************/
    function get_data() {
    		global $fp;
        $data = '';
        while($str = fgets($fp, 128)) {
            $data .= $str;
            if(substr($str,3,1) == ' ') { break; }
        }
        return $data;
    }

	/***************************************
		** Class to Random String.
		***************************************/
	class rand_word 
	{ 
	    var $vowels = array('a','e','i','o','u','y'); 
	    var $consonants = array('b','c','d','f','g','h','j','k','l','m','n','p','r','s','t','v','w','z','ch','qu','th','xy','0','1','2','3','4','5','6','7','8','9'); 
	    var $word = ''; 
	
	    /** 
	    * Constructor. 
	    * 
	    * @param  integer  Length of the word 
	    * @param  boolean  Return the word lowercase? 
	    * @param  boolean  Reutrn the word with the first letter capitalized? 
	    * @param  boolean  Return the word uppercase? 
	    * @param  boolean  Return the word base64_encode? 
	    * @return string 
	    */ 
	    function rand_word($length = 5, $lower_case = true, $ucfirst = false, $upper_case = false, $base64 = false) 
	    { 
	        $done = false; 
	        $const_or_vowel = 1; 
	
	        while (!$done) 
	        { 
	            switch ($const_or_vowel) 
	            { 
	                case 1: 
	                    $this->word .= $this->consonants[array_rand($this->consonants)]; 
	                    $const_or_vowel = 2; 
	                    break; 
	                case 2: 
	                    $this->word .= $this->vowels[array_rand($this->vowels)]; 
	                    $const_or_vowel = 1; 
	                    break; 
	            } 
	
	            if (strlen($this->word) >= $length) 
	            { 
	                $done = true; 
	            } 
	        } 
	
	        $this->word = substr($this->word, 0, $length); 
	
	        if ($lower_case) 
	        { 
	            $this->word = strtolower($this->word);
	        } 
	        else if ($ucfirst) 
	        { 
	            $this->word = ucfirst(strtolower($this->word));
	        } 
	        else if ($upper_case) 
	        { 
	            $this->word = strtoupper($this->word);
	        } 
	        else if ($base64) 
	        { 
	            $this->word = base64_encode($this->word);
	        } 
	        return $this->word; 
	    } 
	} 

?>