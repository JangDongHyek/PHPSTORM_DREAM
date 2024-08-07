<?php
include_once('./_common.php');

$mb_password = "!A2s^F&g(PL)J-+-+-+-+";
$mb = get_member($mb_id);

if (!$mb['mb_id'] || !check_password($mb_password, $mb['mb_password'])) {
	$mb_name = "kakao_".$mb_id;

	$sql = " insert into {$g5['member_table']}
                set mb_id = '{$mb_id}',
                     mb_password = '".get_encrypt_string($mb_password)."',
                     mb_name = '{$mb_name}',
                     mb_nick = '{$mb_nick}',
                     mb_nick_date = '".G5_TIME_YMD."',
                     mb_email = '{$mb_email}',
                     mb_homepage = '{$mb_homepage}',
                     mb_tel = '{$mb_tel}',
                     mb_zip1 = '{$mb_zip1}',
                     mb_zip2 = '{$mb_zip2}',
                     mb_addr1 = '{$mb_addr1}',
                     mb_addr2 = '{$mb_addr2}',
                     mb_addr3 = '{$mb_addr3}',
                     mb_addr_jibeon = '{$mb_addr_jibeon}',
                     mb_signature = '{$mb_signature}',
                     mb_profile = '{$mb_profile}',
					 mb_thumb_profile = '{$mb_thumb_profile}',
                     mb_today_login = '".G5_TIME_YMDHIS."',
                     mb_datetime = '".G5_TIME_YMDHIS."',
                     mb_ip = '{$_SERVER['REMOTE_ADDR']}',
                     mb_level = '{$config['cf_register_level']}',
                     mb_recommend = '{$mb_recommend}',
                     mb_login_ip = '{$_SERVER['REMOTE_ADDR']}',
                     mb_mailling = '{$mb_mailling}',
                     mb_sms = '{$mb_sms}',
                     mb_open = '{$mb_open}',
                     mb_open_date = '".G5_TIME_YMD."',
                     mb_1 = '{$mb_1}',
                     mb_2 = '{$mb_2}',
                     mb_3 = '{$mb_3}',
                     mb_4 = '{$mb_4}',
                     mb_5 = '{$mb_5}',
                     mb_6 = '{$mb_6}',
                     mb_7 = '{$mb_7}',
                     mb_8 = '{$mb_8}',
                     mb_9 = '{$mb_9}',
                     mb_10 = '{$mb_10}'
                     {$sql_certify} ";

    // �̸��� ������ ������� �ʴ´ٸ� �̸��� �����ð��� �ٷ� �ִ´�
    if (!$config['cf_use_email_certify'])
        $sql .= " , mb_email_certify = '".G5_TIME_YMDHIS."' ";
    sql_query($sql);

    // ȸ������ ����Ʈ �ο�
    insert_point($mb_id, $config['cf_register_point'], 'ȸ������ ����', '@member', $mb_id, 'ȸ������');

    // ��õ�ο��� ����Ʈ �ο�
    if ($config['cf_use_recommend'] && $mb_recommend)
        insert_point($mb_recommend, $config['cf_recommend_point'], $mb_id.'�� ��õ��', '@member', $mb_recommend, $mb_id.' ��õ');

    // ȸ���Բ� ���� �߼�
    if ($config['cf_email_mb_member']) {
        $subject = '['.$config['cf_title'].'] ȸ�������� ���ϵ帳�ϴ�.';

        // ��� ȸ�������� ���Ե��� ���� ��ȸ�� ������ �����Ͽ� ������ ���
        if ($config['cf_use_email_certify']) {
            $mb_md5 = md5(pack('V*', rand(), rand(), rand(), rand()));
            sql_query(" update {$g5['member_table']} set mb_email_certify2 = '$mb_md5' where mb_id = '$mb_id' ");
            $certify_href = G5_BBS_URL.'/email_certify.php?mb_id='.$mb_id.'&amp;mb_md5='.$mb_md5;
        }

        ob_start();
        include_once ('./register_form_update_mail1.php');
        $content = ob_get_contents();
        ob_end_clean();

        mailer($config['cf_admin_email_name'], $config['cf_admin_email'], $mb_email, $subject, $content, 1);

        // ���������� ����ϴ� ��� ���Ը��Ͽ� ���� url�� �����Ƿ� ���������� �ٽ� �߼۵��� �ʵ��� ��
        if($config['cf_use_email_certify'])
            $old_email = $mb_email;
    }

    // �ְ�����ڴԲ� ���� �߼�
    if ($config['cf_email_mb_super_admin']) {
        $subject = '['.$config['cf_title'].'] '.$mb_nick .' �Բ��� ȸ������ �����ϼ̽��ϴ�.';

        ob_start();
        include_once ('./register_form_update_mail2.php');
        $content = ob_get_contents();
        ob_end_clean();

        mailer($mb_nick, $mb_email, $config['cf_admin_email'], $subject, $content, 1);
    }

    // �������� ������� �ʴ� ��쿡�� �α���
    if (!$config['cf_use_email_certify'])
        set_session('ss_mb_id', $mb_id);

    set_session('ss_mb_reg', $mb_id);
	set_cookie_app('mb_id', $mb_id, 86400);

	$link = G5_URL."/bbs/member_input.php";
} else {

	if ($mb['mb_intercept_date'] && $mb['mb_intercept_date'] <= date("Ymd", G5_SERVER_TIME)) {
		$date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1�� \\2�� \\3��", $mb['mb_intercept_date']);
		alert('ȸ������ ���̵�� ������ �����Ǿ� �ֽ��ϴ�.\nó���� : '.$date);
	}

	// Ż���� ���̵��ΰ�?
	if ($mb['mb_leave_date'] && $mb['mb_leave_date'] <= date("Ymd", G5_SERVER_TIME)) {
		$date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1�� \\2�� \\3��", $mb['mb_leave_date']);
		alert('Ż���� ���̵��̹Ƿ� �����Ͻ� �� �����ϴ�.\nŻ���� : '.$date);
	}

	if ($config['cf_use_email_certify'] && !preg_match("/[1-9]/", $mb['mb_email_certify'])) {
		$ckey = md5($mb['mb_ip'].$mb['mb_datetime']);
		confirm("{$mb['mb_email']} ���Ϸ� ���������� �����ž� �α��� �����մϴ�. �ٸ� �����ּҷ� �����Ͽ� �����Ͻ÷��� ��Ҹ� Ŭ���Ͻñ� �ٶ��ϴ�.", G5_URL, G5_BBS_URL.'/register_email.php?mb_id='.$mb_id.'&ckey='.$ckey);
	}

	@include_once($member_skin_path.'/login_check.skin.php');

	// ȸ�����̵� ���� ����
	set_session('ss_mb_id', $mb['mb_id']);
	// FLASH XSS ���ݿ� �����ϱ� ���Ͽ� ȸ���� ����Ű�� ������ ���´�. �����ڿ��� �˻��� - 110106
	set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

	// ����Ʈ üũ
	if($config['cf_use_point']) {
		$sum_point = get_point_sum($mb['mb_id']);

		$sql= " update {$g5['member_table']} set mb_point = '$sum_point' where mb_id = '{$mb['mb_id']}' ";
		sql_query($sql);
	}

	$sql = " update {$g5['member_table']} set mb_nick = '{$mb_nick}', mb_profile = '{$mb_profile}', mb_thumb_profile = '{$mb_thumb_profile}' where mb_id = '{$mb['mb_id']}'";
	sql_query($sql);
	$key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
	set_cookie('ck_mb_id', $mb['mb_id'], 86400 * 31);
	set_cookie('ck_auto', $key, 86400 * 31);
	set_cookie_app('mb_id', $mb['mb_id'], 86400 * 31 * 9999);
	
	$link = G5_URL;
	
	//$link = G5_URL."/bbs/member_input.php";
}


goto_url($link);

?>