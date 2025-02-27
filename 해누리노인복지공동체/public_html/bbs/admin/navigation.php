<p><span style="font-size:9pt;"><?

if(!empty($page_info[first]))
	echo "<a href=\"?{$p_str}&page={$page_info[first]}\">[처음]</a> ";

if(!empty($page_info[prior_step]))
//	echo "<a href=\"?{$p_str}&p={$page_info[prior_step]}\"><img src=\"../image/089-2.gif\" width=\"12\" height=\"11\" border=\"0\"></a> ";
	echo "<a href=\"?{$p_str}&page={$page_info[prior_step]}\">[이전 $page_info[page_rows] 페이지]</a> ";

//if(!empty($page_info[prior]))
//	echo "<a href=\"?{$p_str}&p={$page_info[prior]}\">[이전페이지]</a> ";

for($i=0;$i<count($page_info[pages]);$i++) {
	if($page_info[pages][$i] == $page)
		echo "<b>[{$page_info[pages][$i]}]</b> ";
	else
		echo "<a href=\"?{$p_str}&page={$page_info[pages][$i]}\">[{$page_info[pages][$i]}]</a> ";
}

//if(!empty($page_info[next]))
//	echo "<a href=\"?{$p_str}&page={$page_info[next]}\">[다음페이지]</a> ";

if(!empty($page_info[next_step]))
//	echo "<a href=\"?{$p_str}&page={$page_info[next_step]}\"><img src=\"../image/089-1.gif\" width=\"12\" height=\"11\" border=\"0\"></a> ";
	echo "<a href=\"?{$p_str}&page={$page_info[next_step]}\">[다음 {$page_info[page_rows]} 페이지]</a> ";

if(!empty($page_info[end]))
 	echo "<a href=\"?{$p_str}&page={$page_info[end]}\">[끝]</a> ";

?></span></p>