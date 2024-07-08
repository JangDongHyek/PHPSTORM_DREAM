<?
	
	$thisyear  = date('Y');  
	$thismonth = date('n');  
	$today     = date('j');  
	if (!$year) { $year = $thisyear;}
	if (!$month) { $month = $thismonth;}
	$datelike=date('Y-m-',mktime(0,0,0,$month,1,$year));
	$start_where=mktime(0,0,0,$month,1,$year);
	$end_where=mktime(0,0,0,$month,31,$year);
	$_SQL="select * from ".$_table_name."_body where rg_ext5>=$start_where and rg_ext5<=$end_where";
	if (!get_magic_quotes_gpc()) {
		$ss[kw] = addslashes($ss[kw]);
	}
	if (!get_magic_quotes_gpc()) {
		$ss[kw] = addslashes($ss[kw]);
	}

	if(!empty($ss[kw]) && count($ss) > 0 ){
		$find=array();
		reset($ss);
		while (list ($ss_key, $ss_val) = each ($ss)) {
			if($ss_val=='1') {
				switch($ss_key) {
					case 'sn' : 
						$find[]=" (rg_name Like '%{$ss[kw]}%') ";
						break;
					case 'st' : 
						$find[]=" (rg_title Like '%{$ss[kw]}%') ";
						break;
					case 'sc' :
						$find[]=" (rg_content Like '%{$ss[kw]}%') ";
						break;
				}
			}
		}		
		if(count($find) > 0) {
			if($ss[sf] == 'and') {
				$where_str.=" AND (".implode("AND",$find).")";
			} else {
				$where_str.=" AND (".implode("OR",$find).")";
			}
		}
		unset($find);
		unset($key);
		unset($val);
	}
	
	if($ss[fc]) $where_str.=" AND (rg_cat_num = '{$ss[fc]}') ";

	$_SQL .= $where_str;

	$sql=mysql_query($_SQL);
	for($n=0;$seong_data[$n]=mysql_fetch_array($sql);$n++);

	$maxdate = date(t, mktime(0, 0, 0, $month, 1, $year));

	//전월, 차월 이동링크
	$pmonth = $month;
	$prevmonth = $month - 1;
	$nextmonth = $month + 1;
	$prevyear = $year ;
	$nextyear = $year ;
	$prevyeary = $year - 1;
	$nextyeary = $year + 1;
	if ($month == 1) {
	  $prevmonth = 12;
	  $prevyear = $year -1;
	} 
	elseif ($month == 12) {
	  $nextmonth = 1;
	  $nextyear = $year +1;
	}

	//1일의 요일
	$fors = date('w',mktime(0,0,0,$month,1,$year));
	$fore = date('w',mktime(0,0,0,$month,$maxdate,$year));?>
	<div class="cal_title">
		<span><a href="mobile_list.php?bbs_id=<?=$bbs_id?>&year=<?=$prevyear?>&month=<?=$prevmonth?>">◀</a></span>
		<span><?=$year?>-<?=$month?></span>
		<span><a href="mobile_list.php?bbs_id=<?=$bbs_id?>&year=<?=$nextyear?>&month=<?=$nextmonth?>">▶</a></span>
	</div>
<?
	for($day=1;$day <= $maxdate;$day++) {
?>
<div class="bbs_cal_list">
	<ul>
		<li class="bbs_cal_day"><?=$day?></li>
		<li>
		<span class="bbs_cal_title">
		<?
			for($s=0;$s<sizeof($seong_data);$s++)	{
				
				if($seong_data[$s][rg_ext5]==$book)	{
					$doc_num2=$seong_data[$s][rg_doc_num];
					$cmt_count=$seong_data[$s][rg_cmt_count];
					$rg_title=$seong_data[$s][rg_title];
					$rg_name=$seong_data[$s][rg_name];
					$rg_content= $seong_data[$s][rg_content];
					$rg_content=strip_tags($rg_content);//미니에디터적용으로 수정
					$rg_content= rg_cut_string($rg_content, 50, $suffix="...");
					$rg_notice=$seong_data[$s][rg_notice];
					$rg_ext1=$seong_data[$s][rg_ext1];
					//$rg_ext2=$seong_data[$s][rg_ext2];
					$complete=$seong_data[$s][complete];
					if($complete == "y") {
					$img="";
					$rg_name="<font color=blue><b>".$rg_name."</b>";
					} else {
					$img="";
					}
					if($rg_ext1){
					echo("<a href='mobile_view.php?$p_str&bbs_id=$bbs_id&doc_num=$doc_num2&year=$year&month=$month&day=$day&' title='$rg_content'>{$img}");
					
						echo("".$rg_ext1."시&nbsp;".$rg_name."</a> ");
					}
					
				}
			}
			?>
			</span>
		</li>
	</ul>
</div>
</a>
<? }?>