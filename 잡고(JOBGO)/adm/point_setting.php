<?php
$sub_menu = "370100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

if ($is_admin != 'super')
    alert('최고관리자만 접근 가능합니다.');

$g5['title'] = '포인트설정';
include_once ('./admin.head.php');


$frm_submit = '<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">
    <a href="'.G5_URL.'/">메인으로</a>
</div>';

if (!$config['cf_icode_server_ip'])   $config['cf_icode_server_ip'] = '211.172.232.124';
if (!$config['cf_icode_server_port']) $config['cf_icode_server_port'] = '7295';

if ($config['cf_sms_use'] && $config['cf_icode_id'] && $config['cf_icode_pw']) {
    $userinfo = get_icode_userinfo($config['cf_icode_id'], $config['cf_icode_pw']);
}
?>

<form name="fconfigform" id="fconfigform" method="post" onsubmit="return fconfigform_submit(this);">
    <input type="hidden" name="token" value="" id="token">
    <input type="hidden" name="cf_admin" value="<?= $config['cf_admin'] ?>">
    <input type="hidden" name="sub_config" value="Y" id="sub_config">


    <section id="anc_cf_basic">

        <div class="tbl_frm01 tbl_wrap">
            <table>
                <colgroup>
                    <col class="grid_4">
                    <col>
                    <col class="grid_4">
                    <col>
                </colgroup>
                <tbody>

                <tr>
                    <th scope="row"><label for="cf_possible_ip">회원가입 포인트</label></th>
                    <td>
                        회원 가입 시 포인트 <input type="number" name="" class="frm_input"> 점 적립
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="cf_intercept_ip">구매 포인트</label></th>
                    <td>
                        구매 시 포인트 <input type="number" name="" class="frm_input" style="width: 50px"> % 적립
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </section>

    <?php echo $frm_submit; ?>


</form>

<script>
    $(function(){
        <?php
        if(!$config['cf_cert_use'])
            echo '$(".cf_cert_service").addClass("cf_cert_hide");';
        ?>
        $("#cf_cert_use").change(function(){
            switch($(this).val()) {
                case "0":
                    $(".cf_cert_service").addClass("cf_cert_hide");
                    break;
                default:
                    $(".cf_cert_service").removeClass("cf_cert_hide");
                    break;
            }
        });

        $(".get_theme_confc").on("click", function() {
            var type = $(this).data("type");
            var msg = "기본환경 스킨 설정";
            if(type == "conf_member")
                msg = "기본환경 회원스킨 설정";

            if(!confirm("현재 테마의 "+msg+"을 적용하시겠습니까?"))
                return false;

            $.ajax({
                type: "POST",
                url: "./theme_config_load.php",
                cache: false,
                async: false,
                data: { type: type },
                dataType: "json",
                success: function(data) {
                    if(data.error) {
                        alert(data.error);
                        return false;
                    }

                    var field = Array('cf_member_skin', 'cf_mobile_member_skin', 'cf_new_skin', 'cf_mobile_new_skin', 'cf_search_skin', 'cf_mobile_search_skin', 'cf_connect_skin', 'cf_mobile_connect_skin', 'cf_faq_skin', 'cf_mobile_faq_skin');
                    var count = field.length;
                    var key;

                    for(i=0; i<count; i++) {
                        key = field[i];

                        if(data[key] != undefined && data[key] != "")
                            $("select[name="+key+"]").val(data[key]);
                    }
                }
            });
        });
    });

    function fconfigform_submit(f)
    {
        f.action = "./config_form_update.php";
        return true;
    }
</script>

<?php
// 본인확인 모듈 실행권한 체크
if($config['cf_cert_use']) {
    // kcb일 때
    if($config['cf_cert_ipin'] == 'kcb' || $config['cf_cert_hp'] == 'kcb') {
        // 실행모듈
        if(strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            if(PHP_INT_MAX == 2147483647) // 32-bit
                $exe = G5_OKNAME_PATH.'/bin/okname';
            else
                $exe = G5_OKNAME_PATH.'/bin/okname_x64';
        } else {
            if(PHP_INT_MAX == 2147483647) // 32-bit
                $exe = G5_OKNAME_PATH.'/bin/okname.exe';
            else
                $exe = G5_OKNAME_PATH.'/bin/oknamex64.exe';
        }

        echo module_exec_check($exe, 'okname');
    }

    // kcp일 때
    if($config['cf_cert_hp'] == 'kcp') {
        if(PHP_INT_MAX == 2147483647) // 32-bit
            $exe = G5_KCPCERT_PATH . '/bin/ct_cli';
        else
            $exe = G5_KCPCERT_PATH . '/bin/ct_cli_x64';

        echo module_exec_check($exe, 'ct_cli');
    }

    // LG의 경우 log 디렉토리 체크
    if($config['cf_cert_hp'] == 'lg') {
        $log_path = G5_LGXPAY_PATH.'/lgdacom/log';

        if(!is_dir($log_path)) {
            echo '<script>'.PHP_EOL;
            echo 'alert("'.str_replace(G5_PATH.'/', '', G5_LGXPAY_PATH).'/lgdacom 폴더 안에 log 폴더를 생성하신 후 쓰기권한을 부여해 주십시오.\n> mkdir log\n> chmod 707 log");'.PHP_EOL;
            echo '</script>'.PHP_EOL;
        } else {
            if(!is_writable($log_path)) {
                echo '<script>'.PHP_EOL;
                echo 'alert("'.str_replace(G5_PATH.'/', '',$log_path).' 폴더에 쓰기권한을 부여해 주십시오.\n> chmod 707 log");'.PHP_EOL;
                echo '</script>'.PHP_EOL;
            }
        }
    }
}

include_once ('./admin.tail.php');
?>
