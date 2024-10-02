<?php
/*
$send_list = "h,:01096037588/";
$wr_message="test1";
$wr_reply="01096037588";
$hp_name:
$hp_number:
*/
//$wr_message="testtest";
$wr_reply="01043407617";
if(count($_POST['phone']) != 3)
    win_close_alert('회신 번호를 입력해 주십시오.');
if(!is_array($_POST['data']))
    win_close_alert('잠시 후 이용하여 주시기바랍니다.');
$phone = implode('-',$_POST['phone']);
$wr_message = implode(' / ', $_POST['data']);
$wr_message .= ' / ' . $phone ;

//$send_list = "h,:01043407617/";
$send_list = "h,:01043407617/";

include_once("./_common.php");
include_once("./plugin/sms5/sms5.lib.php");

$g5['title'] = "문자전송중";

$wr_reply   = preg_replace('#[^0-9\-]#', '', trim($wr_reply));
$wr_message = clean_xss_tags(trim($wr_message));

if (!$wr_reply)
    win_close_alert('회신 번호를 숫자, - 로 입력해주세요.');

if(!check_vaild_callback($wr_reply))
    win_close_alert('회신 번호를 올바르게 입력해 주십시오.');

if (!$wr_message)
    win_close_alert('메세지를 입력해주세요.');

if (!trim($send_list))
    win_close_alert('문자 메세지를 받을 휴대폰번호를 입력해주세요.');

$list = array();
$hps = array();

$send_list = explode('/', $send_list);
$wr_overlap = 1; // 중복번호를 체크함
$overlap = 0;
$duplicate_data = array();
$duplicate_data['hp'] = array();
$str_serialize = "";
while ($row = array_shift($send_list))
{
    $item = explode(',', $row);

    for ($i=1, $max = count($item); $i<$max; $i++)
    {
        if (!trim($item[$i])) continue;

        switch ($item[0])
        {
            case 'g': // 그룹전송
                $qry = sql_query("select * from {$g5['sms5_book_table']} where bg_no='$item[1]' and bk_receipt=1");
                while ($row = sql_fetch_array($qry))
                {
                    $row['bk_hp'] = get_hp($row['bk_hp'], 0);

                    if(!$row['bk_hp']) continue;

                    if ($wr_overlap && array_overlap($hps, $row['bk_hp'])) {
                        $overlap++;
                        array_push( $duplicate_data['hp'], $row['bk_hp'] );
                        continue;
                    }

                    array_push($list, $row);
                    array_push($hps, $row['bk_hp']);
                }
                break;

            case 'l':
                $mb_level = $item[$i];

                $qry = sql_query("select mb_id, mb_name, mb_nick, mb_hp from {$g5['member_table']} where mb_level='$mb_level' and mb_sms=1 and not (mb_hp='')");
                while ($row = sql_fetch_array($qry))
                {
                    $name = $row['mb_nick'];
                    $hp = get_hp($row['mb_hp'], 0);
                    $mb_id = $row['mb_id'];

                    if(!$hp) continue;

                    if ($wr_overlap && array_overlap($hps, $hp)) {
                        $overlap++;
                        array_push( $duplicate_data['hp'], $row['bk_hp'] );
                        continue;
                    }

                    $row = sql_fetch("select bg_no, bk_no from {$g5['sms5_book_table']} where mb_id='{$row['mb_id']}'");
                    $bg_no = $row['bg_no'];
                    $bk_no = $row['bk_no'];

                    array_push($list, array('bk_hp' => $hp, 'bk_name' => $name, 'mb_id' => $mb_id, 'bg_no' => $bg_no, 'bk_no' => $bk_no));
                    array_push($hps, $hp);
                }
                break;

            case 'h': // 권한(mb_leve) 선택

                $item[$i] = explode(':', $item[$i]);
                $hp = get_hp($item[$i][1], 0);
                $name = $item[$i][0];

                if(!$hp) continue;

                if ($wr_overlap && array_overlap($hps, $hp)) {
                    $overlap++;
                    array_push( $duplicate_data['hp'], $row['bk_hp'] );
                    continue;
                }

                array_push($list, array('bk_hp' => $hp, 'bk_name' => $name));
                array_push($hps, $hp);
                break;

            case 'p': // 개인 선택

                $row = sql_fetch("select * from {$g5['sms5_book_table']} where bk_no='$item[$i]'");
                $row['bk_hp'] = get_hp($row['bk_hp'], 0);

                if(!$row['bk_hp']) continue;

                if ($wr_overlap && array_overlap($hps, $row['bk_hp'])) {
                    $overlap++;
                    array_push( $duplicate_data['hp'], $row['bk_hp'] );
                    continue;
                }
                array_push($list, $row);
                array_push($hps, $row['bk_hp']);
                break;
        }
    }
}

if( count($duplicate_data['hp']) ){ //중복된 번호가 있다면
    $duplicate_data['total'] = $overlap;
    $str_serialize = serialize($duplicate_data);
}

$wr_total = count($list);

// 예약전송
if ($wr_by && $wr_bm && $wr_bd && $wr_bh && $wr_bi) {
    $wr_booking = "$wr_by-$wr_bm-$wr_bd $wr_bh:$wr_bi";
    $booking = $wr_by.$wr_bm.$wr_bd.$wr_bh.$wr_bi;
} else {
    $wr_booking = '';
    $booking = '';
}


$reply = str_replace('-', '', trim($wr_reply));
$wr_message = conv_unescape_nl($wr_message);

$SMS = new SMS5;

if($config['cf_sms_type'] == 'LMS') {
    $port_setting = get_icode_port_type($config['cf_icode_id'], $config['cf_icode_pw']);

    if($port_setting !== false) {
        $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $port_setting);

        $wr_success = 0;
        $wr_failure = 0;
        $count      = 0;

        $row2 = sql_fetch("select max(wr_no) as wr_no from {$g5['sms5_write_table']}");
        if ($row2)
            $wr_no = $row2['wr_no'] + 1;
        else
            $wr_no = 1;

        for($i=0; $i<$wr_total; $i++) {
            $strDest = array();
            $strDest[]   = $list[$i]['bk_hp'];
            $strCallBack = $reply;
            $strCaller   = $config['cf_title'];
            $strSubject  = '';
            $strURL      = '';
            $strData     = $wr_message;
            if( !empty($list[$i]['bk_name']) ){
                $strData    = str_replace("{이름}", $list[$i]['bk_name'], $strData);
            }
            $strDate = $booking;
            $nCount = 1;

            $result = $SMS->Add($strDest, $strCallBack, $strCaller, $strSubject, $strURL, $strData, $strDate, $nCount);

            if($result) {
                $result = $SMS->Send();

                if ($result) //SMS 서버에 접속했습니다.
                {
                    foreach ($SMS->Result as $result)
                    {
                        list($phone, $code) = explode(":", $result);

                        if (substr($code,0,5) == "Error")
                        {
                            $hs_code = substr($code,6,2);

                            switch ($hs_code) {
                                case '02':	 // "02:형식오류"
                                    $hs_memo = "형식이 잘못되어 전송이 실패하였습니다.";
                                    break;
                                case '23':	 // "23:인증실패,데이터오류,전송날짜오류"
                                    $hs_memo = "데이터를 다시 확인해 주시기바랍니다.";
                                    break;
                                case '97':	 // "97:잔여코인부족"
                                    $hs_memo = "잔여코인이 부족합니다.";
                                    break;
                                case '98':	 // "98:사용기간만료"
                                    $hs_memo = "사용기간이 만료되었습니다.";
                                    break;
                                case '99':	 // "99:인증실패"
                                    $hs_memo = "인증 받지 못하였습니다. 계정을 다시 확인해 주세요.";
                                    break;
                                default:	 // "미 확인 오류"
                                    $hs_memo = "알 수 없는 오류로 전송이 실패하였습니다.";
                                    break;
                            }
                            $wr_failure++;
                            $hs_flag = 0;
                        }
                        else
                        {
                            $hs_code = $code;
                            $hs_memo = get_hp($phone, 1)."로 전송했습니다.";
                            $wr_success++;
                            $hs_flag = 1;
                        }

                        $row = $list[$i];
                        $row['bk_hp'] = get_hp($row['bk_hp'], 1);

                        $log = array_shift($SMS->Log);
                        $log = @iconv('euc-kr', 'utf-8', $log);

                        sql_query("insert into {$g5['sms5_history_table']} set wr_no='$wr_no', wr_renum=0, bg_no='{$row['bg_no']}', mb_id='{$row['mb_id']}', bk_no='{$row['bk_no']}', hs_name='".addslashes($row['bk_name'])."', hs_hp='{$row['bk_hp']}', hs_datetime='".G5_TIME_YMDHIS."', hs_flag='$hs_flag', hs_code='$hs_code', hs_memo='".addslashes($hs_memo)."', hs_log='".addslashes($log)."'", false);
                    }

                    $SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
                }
            }
        }

        sql_query("insert into {$g5['sms5_write_table']} set wr_no='$wr_no', wr_renum=0, wr_reply='$wr_reply', wr_message='$wr_message', wr_success='$wr_success', wr_failure='$wr_failure', wr_memo='$str_serialize', wr_booking='$wr_booking', wr_total='$wr_total', wr_datetime='".G5_TIME_YMDHIS."', wr_device='$wr_device'");
    }
} else {
    $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $config['cf_icode_server_port']);
    $result = $SMS->Add2($list, $reply, '', '', $wr_message, $booking, $wr_total);

    if ($result)
    {
        $result = $SMS->Send();

        if ($result) //SMS 서버에 접속했습니다.
        {
            $row = sql_fetch("select max(wr_no) as wr_no from {$g5['sms5_write_table']}");
            if ($row)
                $wr_no = $row['wr_no'] + 1;
            else
                $wr_no = 1;

            //sql_query("insert into {$g5['sms5_write_table']} set wr_no='$wr_no', wr_renum=0, wr_reply='$wr_reply', wr_message='$wr_message', wr_booking='$wr_booking', wr_total='$wr_total', wr_datetime='".G5_TIME_YMDHIS."'");

            $wr_success = 0;
            $wr_failure = 0;
            $count      = 0;

            foreach ($SMS->Result as $result)
            {
                list($phone, $code) = explode(":", $result);

                if (substr($code,0,5) == "Error")
                {
                    $hs_code = substr($code,6,2);

                    switch ($hs_code) {
                        case '02':	 // "02:형식오류"
                            $hs_memo = "형식이 잘못되어 전송이 실패하였습니다.";
                            break;
                        case '23':	 // "23:인증실패,데이터오류,전송날짜오류"
                            $hs_memo = "데이터를 다시 확인해 주시기바랍니다.";
                            break;
                        case '97':	 // "97:잔여코인부족"
                            $hs_memo = "잔여코인이 부족합니다.";
                            break;
                        case '98':	 // "98:사용기간만료"
                            $hs_memo = "사용기간이 만료되었습니다.";
                            break;
                        case '99':	 // "99:인증실패"
                            $hs_memo = "인증 받지 못하였습니다. 계정을 다시 확인해 주세요.";
                            break;
                        default:	 // "미 확인 오류"
                            $hs_memo = "알 수 없는 오류로 전송이 실패하였습니다.";
                            break;
                    }
                    $wr_failure++;
                    $hs_flag = 0;
                }
                else
                {
                    $hs_code = $code;
                    $hs_memo = get_hp($phone, 1)."로 전송했습니다.";
                    $wr_success++;
                    $hs_flag = 1;
                }

                $row = array_shift($list);
                $row['bk_hp'] = get_hp($row['bk_hp'], 1);

                $log = array_shift($SMS->Log);
                $log = @iconv('euc-kr', 'utf-8', $log);

                sql_query("insert into {$g5['sms5_history_table']} set wr_no='$wr_no', wr_renum=0, bg_no='{$row['bg_no']}', mb_id='{$row['mb_id']}', bk_no='{$row['bk_no']}', hs_name='".addslashes($row['bk_name'])."', hs_hp='{$row['bk_hp']}', hs_datetime='".G5_TIME_YMDHIS."', hs_flag='$hs_flag', hs_code='$hs_code', hs_memo='".addslashes($hs_memo)."', hs_log='".addslashes($log)."'", false);
            }
            $SMS->Init(); // 보관하고 있던 결과값을 지웁니다.

            sql_query("update {$g5['sms5_write_table']} set wr_success='$wr_success', wr_failure='$wr_failure', wr_memo='$str_serialize' where wr_no='$wr_no' and wr_renum=0");
        }
        else win_close_alert("에러: SMS 서버와 통신이 불안정합니다.");
    }
    else win_close_alert("에러: SMS 데이터 입력도중 에러가 발생하였습니다.");
}

function win_close_alert($msg) {

    $html = "<script>
    act = window.open('sms_ing.php', 'act', 'width=300, height=200');
    act.close();
    alert('$msg');
    history.back();</script>";

    echo $html;
    exit;
}
?>


<!-- WIDERPLANET PURCHASE SCRIPT START 2018.1.18 -->
<div id="wp_tg_cts" style="display:none;"></div>
<script type="text/javascript">
var wptg_tagscript_vars = wptg_tagscript_vars || [];
wptg_tagscript_vars.push(
(function() {
         return {
                 wp_hcuid:"<?php echo $member['mb_id']?>",                   /*고객넘버 등 Unique ID (ex. 로그인  ID, 고객넘버 등 )를 암호화하여 대입.
                                                  *주의 : 로그인 하지 않은 사용자는 어떠한 값도 대입하지 않습니다.*/
                 ti:"39020",                    /*광고주 코드 */
                 ty:"PurchaseComplete",       /*트래킹태그 타입 */
                 device:"web",                /*디바이스 종류  (web 또는  mobile)*/
                 items:[{i:"고객상담 ",         /*전환 식별 코드  (한글 , 영어 , 번호 , 공백 허용 )*/
                          t:"고객상담 ",         /*전환명  (한글 , 영어 , 번호 , 공백 허용 )*/
                          p:"1",                /*전환가격  (전환 가격이 없을경우 1로 설정 )*/
                          q:"1"                 /*전환수량  (전환 수량이 고정적으로 1개 이하일 경우 1로 설정 )*/
                 }]
         };
}));
</script>
<script type="text/javascript" src="//cdn-aitg.widerplanet.com/js/wp_astg_4.0.js"></script>
<!-- // WIDERPLANET PURCHASE SCRIPT END 2018.1.18 -->

<!-- 전환페이지 설정 2018.1.19 -->
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script> 
<script type="text/javascript"> 
var _nasa={};
_nasa["cnv"] = wcs.cnv("5","10"); // 전환유형, 전환가치 설정해야함. 설치매뉴얼 참고
</script> 

<!-- 공통 적용 스크립트 , 모든 페이지에 노출되도록 설치. 단 전환페이지 설정값보다 항상 하단에 위치해야함 2018.01.19--> 
<script type="text/javascript"> 
if (!wcs_add) var wcs_add={};
wcs_add["wa"] = "s_40b647dd5cea";
if (!_nasa) var _nasa={};
wcs.inflow();
wcs_do(_nasa);
</script>


<script>
alert('성공적으로 접수 되었습니다.');
<?php if(!$returl){?>
	location.href = 'http://thewclinic.co.kr/landing.php';
<?php }else{?>
	location.href = 'http://thewclinic.co.kr<?php echo $returl?>';
<?php }?>
</script>

<?php
?>