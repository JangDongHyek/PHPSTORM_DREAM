<?

//에러를 출력한다.
function error($oops)
{
	echo"<script language=\"javascript\">
	<!--
		alert('$oops');
		history.back();
	//-->
	</script>";
}


function db_error($QA,$oops)
{
	if(!$QA){
	   error($oops);
	   exit;
	}
}


//text cut을 한다.
function text_cut($str,$length,$suffix= "...") { //---------------------- 지정한 갯수만큼 문자열 출력
     if ($length >= strlen($str)) return $str;

     $klen= $length - 1;

     while(ord($str[$klen]) & 0x80) $klen--;

     return substr($str,0,$length-(($length+$klen+1) % 2)).$suffix;
}


//글이 입력 되었는지 검사한다.
function test_text($text,$oops)
{
	if(!ereg("([^[:space:]]+)",$text)) {
		error($oops."입력되지 않았습니다.");
		exit;
	}
}

//메일이 입력,타당성을 검사한다.
function test_email($email)
{
	if(ereg("([^[:space:]]+)",$email) && (!ereg("(^[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*@[0-9a-zA-Z-]+(\.[0-9a-zA-Z-]+)*$)",$email))){
		error("메일이 입력되지 않았거나, 올바른 형식이 아닙니다.");
		exit;
	}
}

//홈페이지의 입력,타당성을 검사한다.
function test_homepage($homepage)
{
	if(ereg("([^[:space:]]+)",$homepage) && (!ereg("http://([0-9a-zA-Z./@~?&=_]+)",$homepage))){
		error("홈페이지 입력이 잘못 되었습니다.");
		exit;
	}
}


//비밀번호의 입력,타당성을 검사한다.
function test_passwd($passwd)
{
	if(!ereg("(^[0-9a-zA-Z]{4,}$)", $passwd)) {
		error("비밀번호가 입력 되지않았거나, 잘못된 형식입니다.\\비밀번호는 4자리이상으로 영문,숫자로 입력 해주세요");
		exit;
	}
}




//where절을 생성 시킨다.
function search_create($data,$word)
{

	for($i=0; $i < count($data);$i++){
		if($i==0){
			$where="where ".$data[$i]." like '%".$word."%'";	
		}else{
			$where .=" or ".$data[$i]." like '%".$word."%'";
		}
	}
	
	return $where;
}

//code값이 있는 where절을 생성 시킨다.2
function search_create2($data,$word,$code,$code_value)
{

	for($i=0; $i < count($data);$i++){
		if($i==0){
			$where="where ".$code."='".$code_value."' and ".$data[$i]." like '%".$word."%'";	
		}else{
			$where .=" or ".$data[$i]." like '%".$word."%'";
		}
	}
	
	return $where;
}



//검색된 문자의 색을 바꾼다
function change_fontcolor($search_word,$text)
{
	$text =eregi_replace("($search_word)","<font color=blue>\\1</font>",$text);
	return $text;
}



//html이 아닐 경우에 "br"을 만들어 준다.
function Create_br($body)
{
	$body = nl2br($body); 

        $body_pre=explode("<br>",$body); 

        for($i=0;$i<count($body_pre);$i++) 
        { 
           $body_pre[$i]=chop($body_pre[$i])."<br>"; 
        } 
        $body_ok=implode("<br>",$body_pre); 

        $body=eregi_replace("><br>",">",$body_ok); 

        if(ereg("</table>","$body")) 
           { 
                $body=eregi_replace("><br>",">",$body); 
           } 

	//if(!eregi("^<(.*)>(.*)<(\/.*)>$",$data)) $data = nl2br($data);
	return $body;
}



?>
