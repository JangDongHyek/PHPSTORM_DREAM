<?
/****************************************************************************
 접속통계프로그램
 파일명 : counter.lib.php
 최종 수정일 : 2004년 06월 22일 
****************************************************************************/

	if ($_REQUEST[site_path] || $_REQUEST[skin_site_path]) {
		echo "<script>alert(\"불법 접근 금지\");</script>";
		exit;
	}
	if(!$site_path || eregi(":\/\/",$site_path)) $site_path='./';
	
	require_once($site_path.'counter/counter.cfg.php');

	// SELECT문의 결과가 있다면 UPDATE문 아니면 INSERT문 실행
	function sql_select_update_insert($sql_select,$sql_update,$sql_insert) {
		global $dbcon;
		eval("\$sql_select=\"$sql_select\";");		
		$rs=query($sql_select,$dbcon);
		if(mysql_num_rows($rs)>0) {
			if($sql_update != '') {
				$tmp=mysql_fetch_row($rs);
				$key=$tmp[0];
				eval("\$sql_update=\"$sql_update\";");		
				$rs=query($sql_update,$dbcon);
			}
		} else {
			if($sql_insert != '') {
				eval("\$sql_insert=\"$sql_insert\";");		
				query($sql_insert,$dbcon);
				$key=mysql_insert_id();
			}
		}
		return $key;
	}
	

//---------------------------- 기존 프로그램 -------------------------//
	$today_date = date("Y-m-d");
	$conn_count=rg_get_connect_count();
	$ip=$HTTP_SERVER_VARS['REMOTE_ADDR'];
	$sql_update_teg=false; // 정보의 변화가 있었는지 체크
	$pure_hit=0; // 24시간 이내 접속한 사람인지 체크한다.(순수카운터를 위해사용)
	
	// 통계정보를 읽어온다 
	$dbqry = "
		SELECT * 
		FROM `{$db_table_prefix}count_stat`
	";
	$rs=query($dbqry,$dbcon);

	// 레코드가 없다면(최소한1개의 레코드가 있어야 함) 
	if(mysql_num_rows($rs)==0) {
		$dbqry = "
			INSERT `{$db_table_prefix}count_stat` SET
				`today_count`='1',
				`yesterday_count`='0',
				`total_count`='1',
				`max_conn_count`='$conn_count',
				`max_count`='1',
				`today_date`='$today_date',
				`ip`='$ip'
		";
		query($dbqry,$dbcon);		
		$dbqry = "
			SELECT * 
			FROM `{$db_table_prefix}count_stat`
		";
		$rs=query($dbqry,$dbcon);
	}
	$count_stat=mysql_fetch_array($rs);

	// 날자가 다르다면 
	if($today_date!=$count_stat['today_date']) {
		$count_stat['yesterday_count']=$count_stat['today_count'];
		$count_stat['today_count']=0;
		$sql_update_teg=true;
	}

	if(($_SESSION['check_count_stat'] != '1') && 
		 ($count_stat['ip'] != $REMOTE_ADDR)) { // 세션,아이피 체크

		// 24시간 이상된 아이피 삭제
		$dbqry = "
			DELETE FROM `{$db_table_prefix}count_ip`
			WHERE count_date < DATE_SUB(now(), INTERVAL 1 DAY)
		";
		$rs=query($dbqry,$dbcon);
		
		// 아이피가 있는지 체크
		$dbqry = "
			SELECT *
			FROM `{$db_table_prefix}count_ip`
			WHERE ip = '$ip'
		";
		$rs=query($dbqry,$dbcon);

		// 아이피가 없다면
		if(mysql_num_rows($rs)==0) {
			// 현재 접속 아이피를 삽입
			$dbqry = "
				INSERT `{$db_table_prefix}count_ip` SET
					`ip` = '$ip',
					`count_date` = now()
			";
			$rs=query($dbqry,$dbcon);
			
			// 오늘,전체 카운터 증가
			$count_stat['today_count']++;
			$count_stat['total_count']++;

			// 일간 최대방문자체크
			if($count_stat['today_count'] > $count_stat['max_count']) {
				$count_stat['max_count'] = $count_stat['today_count'];
			}
			// 최대접속자 체크 	
			if($conn_count > $count_stat['max_conn_count']) {
				$count_stat['max_conn_count'] = $conn_count;
			}		 

			$sql_update_teg=true;
			$pure_hit=1;
			$_SESSION['check_count_stat']=1;
		}
	}	
	if($sql_update_teg == true) {
		$dbqry = "
			UPDATE `{$db_table_prefix}count_stat` SET
				total_count='$count_stat[total_count]',
				today_count='$count_stat[today_count]',
				yesterday_count='$count_stat[yesterday_count]',
				max_count='$count_stat[max_count]',
				max_conn_count='$count_stat[max_conn_count]',
				ip = '$REMOTE_ADDR',
				today_date = '$today_date'
		";
		query($dbqry,$dbcon);		
	}
	
	if($pure_hit==1 && $use_rgboard_counter) { // 순수방문일경우, 통계기능 이용시
		//----------------- 아이피를 업데이트한다. ----------------- //
		$ip_ip=$HTTP_SERVER_VARS['REMOTE_ADDR'];
		$sql_select='SELECT ip_num FROM `rg_counter_ip` WHERE ip_ip=\''.$ip_ip.'\'';
		$sql_update='UPDATE `rg_counter_ip` SET ip_hit=ip_hit+1,ip_pure_hit=ip_pure_hit+'.$pure_hit.' WHERE ip_num=\'$key\'';
		$sql_insert='INSERT `rg_counter_ip` SET ip_hit=1,ip_pure_hit='.$pure_hit.',ip_ip=\''.$ip_ip.'\'';
		$counter_ip_num=sql_select_update_insert($sql_select,$sql_update,$sql_insert);
	
		//----------------- 페이지를 업데이트한다. ----------------- //
		$page_url=$HTTP_SERVER_VARS['REQUEST_URI'];
		$sql_select='SELECT page_num FROM `rg_counter_page` WHERE page_url=\''.$page_url.'\'';
		$sql_update='UPDATE `rg_counter_page` SET page_hit=page_hit+1,page_pure_hit=page_pure_hit+'.$pure_hit.' WHERE page_num=\'$key\'';
		$sql_insert='INSERT `rg_counter_page` SET page_hit=1,page_pure_hit='.$pure_hit.', page_url=\''.$page_url.'\'';
		$counter_page_num=sql_select_update_insert($sql_select,$sql_update,$sql_insert);
	
		//----------------- 레퍼럴을 업데이트한다. ----------------- //
		$ref_url=$HTTP_SERVER_VARS['HTTP_REFERER'];
		$sql_select='SELECT ref_num FROM `rg_counter_ref` WHERE ref_url=\''.$ref_url.'\'';
		$sql_update='UPDATE `rg_counter_ref` SET ref_hit=ref_hit+1,ref_pure_hit=ref_pure_hit+'.$pure_hit.' WHERE ref_num=\'$key\'';
		$sql_insert='INSERT `rg_counter_ref` SET ref_hit=1,ref_pure_hit='.$pure_hit.', ref_url=\''.$ref_url.'\'';
		$counter_ref_num=sql_select_update_insert($sql_select,$sql_update,$sql_insert);
		
		//----------------- 에이전트를 업데이트한다. ----------------- //
		$browser=$HTTP_SERVER_VARS['HTTP_USER_AGENT'];
		$sql_select='SELECT bro_num FROM `rg_counter_browser` WHERE bro_agent=\''.$browser.'\'';
		$sql_update='UPDATE `rg_counter_browser` SET bro_hit=bro_hit+1,bro_pure_hit=bro_pure_hit+'.$pure_hit.' WHERE bro_num=\'$key\'';
		$sql_insert='INSERT `rg_counter_browser` SET bro_hit=1,bro_pure_hit='.$pure_hit.',bro_agent=\''.$browser.'\'';
		$counter_browser_num=sql_select_update_insert($sql_select,$sql_update,$sql_insert);
	
		//----------------- 카운터로그를 삽입한다. ----------------- //
		$now=time();
		$yyyy=date('Y');
		$mm=date('n');
		$dd=date('j');
		$hh=date('H');
		$nn=date('i');
		$ww=date('w');
		// 로그
//				pure='$pure_hit',
		$dbqry = "
			INSERT `rg_counter_log` SET
				yyyy='$yyyy',
				mm='$mm',
				dd='$dd',
				hh='$hh',
				nn='$nn',
				ww='$ww',
				counter_date='$now',
				counter_ref='$counter_ref_num',
				counter_page='$counter_page_num',
				counter_ip='$counter_ip_num',
				counter_browser='$counter_browser_num'
		";
		query($dbqry,$dbcon);
	}
?>