<?
/****************************************************************************
 ����������α׷�
 ���ϸ� : counter.lib.php
 ���� ������ : 2004�� 06�� 22�� 
****************************************************************************/

	if ($_REQUEST[site_path] || $_REQUEST[skin_site_path]) {
		echo "<script>alert(\"�ҹ� ���� ����\");</script>";
		exit;
	}
	if(!$site_path || eregi(":\/\/",$site_path)) $site_path='./';
	
	require_once($site_path.'counter/counter.cfg.php');

	// SELECT���� ����� �ִٸ� UPDATE�� �ƴϸ� INSERT�� ����
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
	

//---------------------------- ���� ���α׷� -------------------------//
	$today_date = date("Y-m-d");
	$conn_count=rg_get_connect_count();
	$ip=$HTTP_SERVER_VARS['REMOTE_ADDR'];
	$sql_update_teg=false; // ������ ��ȭ�� �־����� üũ
	$pure_hit=0; // 24�ð� �̳� ������ ������� üũ�Ѵ�.(����ī���͸� ���ػ��)
	
	// ��������� �о�´� 
	$dbqry = "
		SELECT * 
		FROM `{$db_table_prefix}count_stat`
	";
	$rs=query($dbqry,$dbcon);

	// ���ڵ尡 ���ٸ�(�ּ���1���� ���ڵ尡 �־�� ��) 
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

	// ���ڰ� �ٸ��ٸ� 
	if($today_date!=$count_stat['today_date']) {
		$count_stat['yesterday_count']=$count_stat['today_count'];
		$count_stat['today_count']=0;
		$sql_update_teg=true;
	}

	if(($_SESSION['check_count_stat'] != '1') && 
		 ($count_stat['ip'] != $REMOTE_ADDR)) { // ����,������ üũ

		// 24�ð� �̻�� ������ ����
		$dbqry = "
			DELETE FROM `{$db_table_prefix}count_ip`
			WHERE count_date < DATE_SUB(now(), INTERVAL 1 DAY)
		";
		$rs=query($dbqry,$dbcon);
		
		// �����ǰ� �ִ��� üũ
		$dbqry = "
			SELECT *
			FROM `{$db_table_prefix}count_ip`
			WHERE ip = '$ip'
		";
		$rs=query($dbqry,$dbcon);

		// �����ǰ� ���ٸ�
		if(mysql_num_rows($rs)==0) {
			// ���� ���� �����Ǹ� ����
			$dbqry = "
				INSERT `{$db_table_prefix}count_ip` SET
					`ip` = '$ip',
					`count_date` = now()
			";
			$rs=query($dbqry,$dbcon);
			
			// ����,��ü ī���� ����
			$count_stat['today_count']++;
			$count_stat['total_count']++;

			// �ϰ� �ִ�湮��üũ
			if($count_stat['today_count'] > $count_stat['max_count']) {
				$count_stat['max_count'] = $count_stat['today_count'];
			}
			// �ִ������� üũ 	
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
	
	if($pure_hit==1 && $use_rgboard_counter) { // �����湮�ϰ��, ����� �̿��
		//----------------- �����Ǹ� ������Ʈ�Ѵ�. ----------------- //
		$ip_ip=$HTTP_SERVER_VARS['REMOTE_ADDR'];
		$sql_select='SELECT ip_num FROM `rg_counter_ip` WHERE ip_ip=\''.$ip_ip.'\'';
		$sql_update='UPDATE `rg_counter_ip` SET ip_hit=ip_hit+1,ip_pure_hit=ip_pure_hit+'.$pure_hit.' WHERE ip_num=\'$key\'';
		$sql_insert='INSERT `rg_counter_ip` SET ip_hit=1,ip_pure_hit='.$pure_hit.',ip_ip=\''.$ip_ip.'\'';
		$counter_ip_num=sql_select_update_insert($sql_select,$sql_update,$sql_insert);
	
		//----------------- �������� ������Ʈ�Ѵ�. ----------------- //
		$page_url=$HTTP_SERVER_VARS['REQUEST_URI'];
		$sql_select='SELECT page_num FROM `rg_counter_page` WHERE page_url=\''.$page_url.'\'';
		$sql_update='UPDATE `rg_counter_page` SET page_hit=page_hit+1,page_pure_hit=page_pure_hit+'.$pure_hit.' WHERE page_num=\'$key\'';
		$sql_insert='INSERT `rg_counter_page` SET page_hit=1,page_pure_hit='.$pure_hit.', page_url=\''.$page_url.'\'';
		$counter_page_num=sql_select_update_insert($sql_select,$sql_update,$sql_insert);
	
		//----------------- ���۷��� ������Ʈ�Ѵ�. ----------------- //
		$ref_url=$HTTP_SERVER_VARS['HTTP_REFERER'];
		$sql_select='SELECT ref_num FROM `rg_counter_ref` WHERE ref_url=\''.$ref_url.'\'';
		$sql_update='UPDATE `rg_counter_ref` SET ref_hit=ref_hit+1,ref_pure_hit=ref_pure_hit+'.$pure_hit.' WHERE ref_num=\'$key\'';
		$sql_insert='INSERT `rg_counter_ref` SET ref_hit=1,ref_pure_hit='.$pure_hit.', ref_url=\''.$ref_url.'\'';
		$counter_ref_num=sql_select_update_insert($sql_select,$sql_update,$sql_insert);
		
		//----------------- ������Ʈ�� ������Ʈ�Ѵ�. ----------------- //
		$browser=$HTTP_SERVER_VARS['HTTP_USER_AGENT'];
		$sql_select='SELECT bro_num FROM `rg_counter_browser` WHERE bro_agent=\''.$browser.'\'';
		$sql_update='UPDATE `rg_counter_browser` SET bro_hit=bro_hit+1,bro_pure_hit=bro_pure_hit+'.$pure_hit.' WHERE bro_num=\'$key\'';
		$sql_insert='INSERT `rg_counter_browser` SET bro_hit=1,bro_pure_hit='.$pure_hit.',bro_agent=\''.$browser.'\'';
		$counter_browser_num=sql_select_update_insert($sql_select,$sql_update,$sql_insert);
	
		//----------------- ī���ͷα׸� �����Ѵ�. ----------------- //
		$now=time();
		$yyyy=date('Y');
		$mm=date('n');
		$dd=date('j');
		$hh=date('H');
		$nn=date('i');
		$ww=date('w');
		// �α�
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