<?php
$sub_menu = "910100";

include_once('./_common.php');
include_once("function.lib.php");

$g5['title'] = "rgboard 게시판 이전";

for ($i=0; $i<count($_POST['chk']); $i++) {
	$k = $_POST['chk'][$i];
	$result = sql_query(" select * from rg_".$_POST['rg_table_id'][$k]."_body as r left join rg_".$_POST['rg_table_id'][$k]."_category as c on r.rg_cat_num = c.cat_num left join rg_member as m on r.rg_mb_num = m.mb_num order by rg_next_num asc");
	
	$prevTable=$_POST['rg_table_id'][$k];
	for($j=0; $j<$row=sql_fetch_array($result); $j++) {

		$write_table = "g5_write_".$_POST['bo_table'][$k];

		// 답변 시작
		if($row['rg_parent_num']!= 0){
			$sql = "select * from $write_table where wr_10 = '{$row['rg_doc_num']}' order by wr_id desc";
			echo $sql;
			$wr = sql_fetch($sql);
			
			
			// 게시글 배열 참조
			$reply_array = &$wr;

			// 최대 답변은 테이블에 잡아놓은 wr_reply 사이즈만큼만 가능합니다.
			/*if (strlen($reply_array['wr_reply']) == 10) {
				alert("더 이상 답변하실 수 없습니다.\\n답변은 10단계 까지만 가능합니다.");
			}*/

			$reply_len = strlen($reply_array['wr_reply']) + 1;
			$sql = "select bo_reply_order from g5_board where bo_table = '".$_POST['bo_table'][$k]."'";
			$board = sql_fetch($sql);
			//depth
			//wr_reply
			if ($board['bo_reply_order']) {
				$begin_reply_char = 'A';
				$end_reply_char = 'Z';
				$reply_number = +1;
				$sql = " select MAX(SUBSTRING(wr_reply, $reply_len, 1)) as reply from {$write_table} where wr_num = '{$reply_array['wr_num']}' and SUBSTRING(wr_reply, {$reply_len}, 1) <> '' ";
			} else {
				$begin_reply_char = 'Z';
				$end_reply_char = 'A';
				$reply_number = -1;
				$sql = " select MIN(SUBSTRING(wr_reply, {$reply_len}, 1)) as reply from {$write_table} where wr_num = '{$reply_array['wr_num']}' and SUBSTRING(wr_reply, {$reply_len}, 1) <> '' ";
			}

			if ($reply_array['wr_reply']) $sql .= " and wr_reply like '{$reply_array['wr_reply']}%' ";
			$rpl_row = sql_fetch($sql);

			if (!$rpl_row['reply']) {
				$reply_char = $begin_reply_char;
			} /*else if ($rpl_row['reply'] == $end_reply_char) { // A~Z은 26 입니다.
				alert("더 이상 답변하실 수 없습니다.\\n답변은 26개 까지만 가능합니다.");
			} */else {
				$reply_char = chr(ord($rpl_row['reply']) + $reply_number);
			}

			$reply = $reply_array['wr_reply'] . $reply_char;


			 // 답변의 원글이 비밀글이라면 비밀번호는 원글과 동일하게 넣는다.
			if ($secret)
				$wr_password = $wr['wr_password'];
			

			$wr_id = $wr_id . $reply;
			$wr_num = $write['wr_num'];
			$wr_reply = $reply;
			
			echo $wr_num."==".$wr_reply."<br>";
			$w = "r";

		}else{
			$w = "";
			$wr_reply = "";
		}
		// 답변 종료

		//파일 시작
		for($l=1; $l<=$rg_table_file[$k]; $l++){
			if($row['rg_file'.$l.'_name']){
				if(file_exists(G5_PATH."/rg_data/{$prevTable}/".$row['rg_doc_num']."\$".$l."\$th2\$".$row['rg_file'.$l.'_name'])){
					$file_name[$l] = $row['rg_doc_num']."\$".$l."\$th2\$".$row['rg_file'.$l.'_name'];
				}else{
					$file_name[$l] = $row['rg_doc_num']."\$".$l."\$".$row['rg_file'.$l.'_name'];
				}
				$file_size[$l] = $row['rg_file'.$l.'_size'];
			}else{
				$file_name[$l]="";
				$file_size[$l]=0;
			}
		}
		
		//파일 종료

		if($row['rg_html_use'])		$html = "html2";
		else						$html = "";

		if($row['rg_secret'])		$secret = "secret";
		else						$secret = "";
		
		if($row['mb_id'])			$mb_id = $row['mb_id'];
		else						$mb_id = "admin";
		
		board_write($row['rg_doc_num'], $row['rg_name'], $row['rg_name'], $w, $wr_num, $write_table, $_POST['bo_table'][$k], $wr_reply, $row['cat_num'], $html, $secret, $row['rg_title'], addslashes(stripslashes($row['rg_content'])), $row['rg_link1_url'], $row['rg_link2_url'], $row['mb_id'], $row['rg_email'], $row['rg_home_url'], date("Y-m-d H:i:s", $row['rg_reg_date']), $row['rg_reg_ip'], $file_name, $file_size )."<br>";
	}

}
//alert('디비를 이전하였습니다.', './convert.php?'.$qstr);

?>

