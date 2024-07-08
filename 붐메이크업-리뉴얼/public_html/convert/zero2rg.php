<?
include "dbconn.php" ;
echo ('<pre>
게시판 컨버팅 중입니다. 작업을 마치는데 많은 시간이 걸릴 수도 있습니다.
기다려주세요.
</pre><br>');
flush();

$bbs_table = 'rg_'.$rg_id.'_body' ;
$comment_table = 'rg_'.$rg_id.'_comment';
$category_table = 'rg_'.$rg_id.'_category';

if($delete_flg=1) {
	$dbqry="TRUNCATE TABLE `$bbs_table`";
	mysql_query($dbqry);
	$dbqry="TRUNCATE TABLE  `$comment_table`";
	mysql_query($dbqry);
	$dbqry="TRUNCATE TABLE  `$category_table`";
	mysql_query($dbqry);
}

echo ('<pre> BOARD START</pre><br>');

$q='SELECT * FROM zetyx_board_'.$zero_id.' order by headnum desc,next_no asc,depth desc';
echo $q;
$result=mysql_query($q);
if(!$result){
	echo mysql_error();
}
while($data=mysql_fetch_array($result)) {

	$rg_doc_num = '';
	$rg_top_num = '';
	$rg_parent_num = '';

	$next_no = $data[next_no] ;
	$rg_depth = $data[depth] ;
	$rg_sequence   = $rg_depth + 1 ;

	$rg_cat_num  = $data[category] ;
	$rg_mb_num   = $data[ismember] ;
	$rg_name	 = $data[name] ;
	$rg_password = $data[password];
	$rg_email    = $data[email] ;
	$rg_home_url = $data[homepage];
	$rg_home_hit = 0;
	$rg_link1_url = $data[sitelink1] ;
	$rg_link2_url = $data[sitelink2] ;
	$rg_link1_hit = 0;
	$rg_link2_hit = 0;
    
	$rg_file1_name = $data[file_name1];
	$rg_file2_name = $data[file_name2];
	$rg_file1_size = 0;
	$rg_file2_size = 0;
	$rg_file1_hit = $data[download1];
	$rg_file2_hit = $data[download2];
	$rg_vote_yes = $data[vote];
	$rg_vote_no = 0;
	$rg_doc_hit = $data[hit];
	$rg_cmt_count = $data[total_comment] ;
	$rg_html_use  = 0 ;

	 if ($data[use_html]) {
        if ($data[use_html] == 1) $rg_html_use = 2;
        else $rg_html_use = 1;
     }

	$rg_title = preg_replace("/\'/", "&#039;", $data[subject]);
    $rg_content = preg_replace("/\'/", "&#039;", $data[memo]);
	$rg_reg_date = $data[reg_date];
	$rg_reg_ip =  $data[ip] ;
//		$rg_modi_ip =
//		$rg_deleted =
	$rg_secret  = $data[is_secret] ;
	$rg_vote_ip = $data[ip] ;
	$rg_reply_mail = $data[reply_mail] ;
	$rg_agree = 0;
	$rg_notice = 0 ;
	if ($data[headnum]<=-2000000000) $rg_notice=1 ;

	$dbqry="
		INSERT INTO `$bbs_table`
			( `rg_doc_num` , `rg_top_num` , `rg_parent_num` ,
				`rg_sequence` , `rg_depth` , `rg_next_num` ,
				`rg_cat_num` , `rg_mb_num` , `rg_name` ,
				`rg_password` , `rg_email` , `rg_home_url` ,
				`rg_home_hit` , `rg_link1_url` , `rg_link2_url` ,
				`rg_link1_hit` , `rg_link2_hit` , `rg_file1_name` ,
				`rg_file2_name` , `rg_file1_size` , `rg_file2_size` ,
				`rg_file1_hit` , `rg_file2_hit` , `rg_vote_yes` ,
				`rg_vote_no` , `rg_doc_hit` , `rg_cmt_count` ,
				`rg_title` , `rg_content` , `rg_html_use` ,
				`rg_reg_date` , `rg_modi_date` , `rg_reg_ip` ,
				`rg_modi_ip` , `rg_deleted` , `rg_secret` ,
				`rg_vote_ip` , `rg_notice` , `rg_reply_mail` ,
				`rg_agree` , `rg_ext1` , `rg_ext2` ,
				`rg_ext3` , `rg_ext4` , `rg_ext5` 
			)
		VALUES 
			( '$rg_doc_num', '$rg_top_num', '$rg_parent_num',
				'$rg_sequence', '$rg_depth', '$rg_next_num', 
				'$rg_cat_num', '$rg_mb_num', '$rg_name', 
				'$rg_password', '$rg_email', '$rg_home_url', 
				'$rg_home_hit', '$rg_link1_url', '$rg_link2_url', 
				'$rg_link1_hit', '$rg_link2_hit', '$rg_file1_name', 
				'$rg_file2_name', '$rg_file1_size', '$rg_file2_size', 
				'$rg_file1_hit', '$rg_file2_hit', '$rg_vote_yes', 
				'$rg_vote_no', '$rg_doc_hit', '$rg_cmt_count', 
				'$rg_title', '$rg_content', '$rg_html_use', 
				'$rg_reg_date', '$rg_modi_date', '$rg_reg_ip', 
				'$rg_modi_ip', '$rg_deleted', '$rg_secret', 
				'$rg_vote_ip', '$rg_notice', '$rg_reply_mail', 
				'$rg_agree', '$rg_ext1', '$rg_ext2', 
				'$rg_ext3', '$rg_ext4', '$rg_ext5'
			)
	";
	mysql_query($dbqry) or DB_ERR(__LINE__);

	$rg_doc_num = mysql_insert_id();
   	$rg_next_num   = $rg_doc_num ;

	if($old_next_no == $next_no) {
		$rg_top_num    = $old_top_num ;
		$rg_parent_num = $old_rg_doc_num ;
		$old_rg_doc_num = $rg_doc_num ;
		}
	else {
		$rg_top_num    = $rg_doc_num;
		$rg_parent_num = 0 ;
		$old_rg_doc_num = $rg_doc_num ;
		$old_top_num    = $rg_doc_num;
	}

	$old_next_no = $next_no ;
	if ($data[file_name1] && file_exists("../bbs_zero/$data[file_name1]")) {
		$file1 = $rg_doc_num."$1$".$data[s_file_name1];
        $rg_file1_name = $data[s_file_name1];
		$rg_file1_size = filesize("../bbs_zero/$data[file_name1]");
        copy("../bbs_zero/$data[file_name1]", "../bbs/data/$rg_id/$file1");
        @chmod("../bbs/data/$rg_id/$file1", 0707);
    }

    if ($data[file_name2] && file_exists("../bbs/$data[file_name2]")) {
		$file2 = $rg_doc_num."$2$".$data[s_file_name2];
		$rg_file2_name = $data[s_file_name2];
		$rg_file2_size = filesize("../bbs/$data[file_name2]");
        copy("../bbs_zero/$data[file_name2]", "../bbs/data/$rg_id/$file2");
        @chmod("../bbs/data/$rg_id/$file2", 0707);
    }

	$dbqry="
		UPDATE `$bbs_table` SET
			`rg_top_num` = '$rg_top_num',
			`rg_parent_num` = '$rg_parent_num',
			`rg_next_num`  = '$rg_next_num' , 
			`rg_file1_name` = '$rg_file1_name',
			`rg_file1_size` = '$rg_file1_size',
			`rg_file2_name` = '$rg_file2_name',
			`rg_file2_size` = '$rg_file2_size'
		WHERE rg_doc_num='$rg_doc_num'
	";
	mysql_query($dbqry);

	if($data[total_comment]>0) {
		flush();
		$q_m=mysql_query('SELECT * FROM zetyx_board_comment_'.$zero_id.' WHERE parent ="'.$data[no].'" order by reg_date') or DB_ERR(__LINE__);
		for($i=1;$datac=mysql_fetch_array($q_m);$i++) {
			$dbqry="
				INSERT INTO `$comment_table`
					( `cmt_num` , `cmt_doc_num` , `cmt_mb_num` ,
						`cmt_name` , `cmt_password` , `cmt_email` ,
						`cmt_comment` , `cmt_reg_date` , `cmt_reg_ip`
					) 
				VALUES
					( '', '$rg_doc_num', '$datac[ismember]',
						'$datac[name]', '$datac[password]', '',
						'$datac[memo]', '$datac[reg_date]', '$datac[ip]'
					)
			";
			mysql_query($dbqry);
		}
	}

}

echo ('<pre> BOARD END</pre><br>');
echo ('<pre> CATEGORY START==========></pre><br>');
$q='SELECT * FROM zetyx_board_category_'.$zero_id.' order by no';
$result=mysql_query($q);
while($data=mysql_fetch_array($result)) {
	$dbqry="
		INSERT INTO `$category_table`
			( `cat_num` , `cat_order` , `cat_name` ,`cat_count`) 
		VALUES
			( '$data[no]', '0', '$data[name]','$data[num]')";
	mysql_query($dbqry);

}
echo ('<pre> CATEGORY END==========></pre><br>');
echo ('<pre> FINISH!!!!!!!!</pre><br>');

mysql_close();
?>
<table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr><td align=center>
<a href=javascript:void(history.back()) onfocus=blur()>back</a></td>
</tr>
</table>
