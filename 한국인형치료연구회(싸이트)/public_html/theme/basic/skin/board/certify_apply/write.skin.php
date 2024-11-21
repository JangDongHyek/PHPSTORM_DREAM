<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);

$submit_title = "접수하기";

$certifyid = $eduid;

$sql ="select * from g5_write_apply02 where wr_4='{$certifyid}' and mb_id = '{$member['mb_id']}'";
$cnt_apply = sql_fetch($sql);

$is_write = "F";
$is_order = "F";
$readonly = "";


if(!empty($cnt_apply)){
    $is_write = "T";
    $submit_title = "결제하기";
    $readonly = "disabled";

    $sql = "select * from `g5_order_list` where `bo_table` = 'certify' and `wr_id` = '$certifyid' and `write_id` = '$cnt_apply[wr_id]'";
    $oder_row = sql_fetch($sql);

    if(!empty($oder_row)){
        $is_order = "T";
        $submit_title = "접수완료";
    }

}



$sql ="select * from g5_write_certify where wr_id = {$certifyid}";
$info_wr = sql_fetch($sql);

?>

<section id="bo_w">
    <!--<h2 id="container_title"><?php echo $g5['title'] ?></h2> -->

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" method="post"  autocomplete="off" style="width:<?php echo $width; ?>">
        <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="ca_name" value="<?php echo $cate ?>">
        <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="wr_4" value="<?php echo $certifyid ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="good_name" value="<?=$info_wr['wr_subject']?>">
        <input type="hidden" id="good_mny" name="good_mny" value="<?=$info_wr['wr_5']?>">
        <input type="hidden" name="PayMethod" id="PayMethod" value="CARD">
        <input type="hidden" name="GoodsCnt" value="1" placeholder="">
        <input type="hidden" name="GoodsName" value="" placeholder="상품">
        <input type="hidden" name="Amt" value="" placeholder="" onKeyUp="javascript:numOnly(this,document.frm,false);">
        <input type="hidden" name="Moid" value="" placeholder="">
        <input type="hidden" name="MID" value="<?=$PAY_MID?>" placeholder="">
        <input type="hidden" name="ReturnURL" value="<?=G5_URL?>/innopay.return.php" placeholder="">
        <input type="hidden" name="ResultYN" value="N">
        <input type="hidden" name="mallUserID" value="admin" maxlength="30" placeholder="">
        <input type="hidden" name="BuyerName" value="" placeholder="">
        <input type="hidden" name="BuyerTel" value="" placeholder="">
        <input type="hidden" name="BuyerEmail" value="" placeholder="">
        <!--hidden 데이타 필수-->
        <input type="hidden" name="ediDate" value=""> <!-- 결제요청일시 제공된 js 내 setEdiDate 함수를 사용하거나 가맹점에서 설정 yyyyMMddHHmmss-->
        <input type="hidden" name="MerchantKey" value="<?=$PAY_MerchantKey?>"> <!-- 발급된 가맹점키 -->
        <input type="hidden" name="EncryptData" value=""> <!-- 암호화데이터 -->
        <input type="hidden" name="MallIP" value="127.0.0.1" /> <!-- 가맹점서버 IP 가맹점에서 설정-->
        <input type="hidden" name="UserIP" value="127.0.0.1"> <!-- 구매자 IP 가맹점에서 설정-->
        <input type="hidden" name="FORWARD" value="Y" id="forward">
        <!--Y:팝업연동 N:페이지전환 -->
        <input type="hidden" name="MallResultFWD" value="N"> <!-- Y 인 경우 PG결제결과창을 보이지 않음 -->
        <input type="hidden" name="device" value=""> <!-- 자동셋팅 -->
        <!--hidden 데이타 옵션-->
        <input type="hidden" name="BrowserType" value="">
        <input type="hidden" name="MallReserved" value="">
        <!-- 현재는 사용안함 -->
        <input type="hidden" name="SUB_ID" value=""> <!-- 서브몰 ID -->
        <input type="hidden" name="BuyerPostNo" value=""> <!-- 배송지 우편번호 -->
        <input type="hidden" name="BuyerAddr" value=""> <!-- 배송지주소 -->
        <input type="hidden" name="BuyerAuthNum">
        <input type="hidden" name="ParentEmail">
        <input type="hidden" id="item_cost" name="item_cost" value="<?=$info_wr['wr_5']?>">
        <?php
        $option = '';
        $option_hidden = '';
        if ($is_notice || $is_html || $is_secret || $is_mail) {
            $option = '';
            if ($is_notice) {
                $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
            }

            if ($is_html) {
                if ($is_dhtml_editor) {
                    $option_hidden .= '<input type="hidden" value="html1" name="html">';
                } else {
                    $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">html</label>';
                }
            }

            if ($is_secret) {
                if ($is_admin || $is_secret==1) {
                    $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
                } else {
                    $option_hidden .= '<input type="hidden" name="secret" value="secret">';
                }
            }

            if ($is_mail) {
                $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
            }
        }

        echo $option_hidden;
        ?>

        <div class="bo_edu wr">
            <!-- 교육명 -->
            <h3><?=$info_wr['wr_subject']?></h3>

            <table>
                <colgroup>
                    <col style="width:20%" />
                    <col style="width:auto" />
                </colgroup>
                <tbody>
                <?php if ($is_name) { ?>
                    <tr>
                        <th scope="row"><label for="wr_name">이름<strong class="sound_only">필수</strong></label></th>
                        <td><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" size="10" maxlength="20" <?=$readonly?>></td>
                    </tr>
                <?php } ?>

                <?php if ($is_password) { ?>
                    <tr>
                        <th scope="row"><label for="wr_password">비밀번호<strong class="sound_only">필수</strong></label></th>
                        <td><input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" maxlength="20" <?=$readonly?>></td>
                    </tr>
                <?php } ?>

                <?php if ($is_email) { ?>
                    <tr>
                        <th scope="row"><label for="wr_email">이메일</label></th>
                        <td><input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input email"  maxlength="100" <?=$readonly?>></td>
                    </tr>
                <?php } ?>

                <?php if ($is_homepage) { ?>
                    <tr>
                        <th scope="row"><label for="wr_homepage">홈페이지</label></th>
                        <td><input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input" <?=$readonly?>></td>
                    </tr>
                <?php } ?>


                <tr>
                    <th scope="row"><label for="wr_subject">이름<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="wr_subject" value="<?php echo $member['mb_name']?>" id="wr_subject" required class="frm_input required" <?=$readonly?>></td>
                </tr>

                <tr>
                    <th scope="row"><label for="wr_content">생년월일<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="wr_content"  <? if($cnt_apply['wr_content']){?>value="<?php echo $cnt_apply['wr_content'] ?>"<?}?> id="wr_content" required class="frm_input hasdate required" readonly <?=$readonly?>></td>
                </tr>

                <tr>
                    <th scope="row"><label for="wr_email">이메일<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="wr_email" value="<?php echo $member['mb_email'] ?>" id="wr_email" class="frm_input email" <?=$readonly?>></td>
                </tr>

                <tr>
                    <th scope="row"><label for="wr_8">연락처<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="wr_8" value="<?php if($cnt_apply['wr_8']) echo $cnt_apply['wr_8']; else echo  $member['mb_hp'] ?>" required id="wr_8" class="frm_input required" <?=$readonly?>></td>
                </tr>

                <tr>
                    <th scope="row"><label>결제방법<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <input type="radio" name="paymentMethod" id="bankTransfer" onclick="toggleFields(true)">
                        <label for="bankTransfer">무통장입금</label>
                        <input type="radio" name="paymentMethod" id="cardPayment" onclick="toggleFields(false)" checked>
                        <label for="cardPayment">카드결제</label>
                    </td>
                </tr>

                <tr id="depositDateRow" style="display: none;">
                    <th scope="row"><label for="wr_1">입금날짜<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="wr_1" id="wr_1" required class="frm_input hasdate required" readonly></td>
                </tr>

                <tr id="depositorNameRow" style="display: none;">
                    <th scope="row"><label for="wr_2">입금자명<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="wr_2" id="wr_2" required class="frm_input required"></td>
                </tr>

                <?php if ($is_guest) { //자동등록방지  ?>
                    <tr>
                        <th scope="row">자동등록방지</th>
                        <td>
                            <?php echo $captcha_html ?>
                        </td>
                    </tr>
                <?php } ?>

                <?php if ($is_orderby) { ?>
                    <tr>
                        <th scope="row"><label for="wr_orderby">우선순위</label></th>
                        <td><input type="text" name="wr_orderby" value="<?php echo $wr_orderby ?>" id="wr_orderby" class="frm_input" size="4"></td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>

        <div class="btn_confirm">
            <? if($submit_title != "접수완료") { ?>
                <input type="button" value="<?=$submit_title?>" id="btn_submit" accesskey="s" class="btn_submit" onclick="fwrite_submit(this.form)">
            <?}?>
            <a href="javascript:history.back();" class="btn_cancel">뒤로가기</a>
        </div>
        <!-- NAVER SCRIPT -->
        <script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
        <script type="text/javascript">
            var _nasa={};
            _nasa["cnv"] = wcs.cnv("5","1");
        </script>
        <!-- NAVER SCRIPT END-->
    </form>

    <!-- 		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">	 -->
    <script src="<?php echo G5_URL ?>/js/Innopay.js"></script>
    <script>
        $(function() {
            $('#wr_content').datepicker();
            $('#wr_1').datepicker();
        });
    </script>

    <script>

        let bo_table = "certify";
        let wr_id = "<?=$info_wr['wr_id']?>";
        let item_count = 1;
        let write_id = "<?=$cnt_apply['wr_id']?>";
        let is_write = "<?=$is_write?>";
        let is_order = "<?=$is_order?>";


        function fwrite_submit(f) {
            let wr_content = $("#wr_content").val();
            let wr_8 = $("#wr_8").val();
            if(wr_content == "" || wr_content.length == 0){
                alert("생년월일을 입력해주세요.");
                return false;
            }

            if(wr_8 == "" || wr_8.length == 0){
                alert("연락처를 입력해주세요.");
                return false;
            }

            if(is_write == "F"){
                let formData = $(f).serialize(); // form 데이터를 직렬화합니다.
                $.ajax({
                    type: 'POST',
                    url: '<?=G5_URL?>/bbs/write_update2.php', // 데이터를 처리할 서버 측 스크립트의 URL
                    data: formData,
                    success: function(response) {
                        if(response == ""){
                            alert("에러가 발생하였습니다.");
                            return false;
                        }
                        write_id = response;
                        is_write = "T";

                        let checkedRadioButton = $('input[name="paymentMethod"]:checked').attr('id');
                        if(checkedRadioButton == "bankTransfer"){
                            alert("신청이 완료되었습니다.");
                            location.href = "<?=G5_URL?>/bbs/mypage.php";
                        } else {
                            chk_order(f);
                        }
                    },
                    error: function(xhr, status, error) {
                    }
                });
            } else {
                chk_order(f);
            }

        }

        function toggleFields(show) {
            document.getElementById("depositDateRow").style.display = show ? "" : "none";
            document.getElementById("depositorNameRow").style.display = show ? "" : "none";
        }

        function chk_order(f) {

            if(is_order == "F"){
                f.BuyerName.value = f.wr_subject.value; //이름
                f.BuyerEmail.value = f.wr_email.value; //이메일
                f.BuyerTel.value = f.wr_8.value; //연락처
                f.GoodsName.value = f.good_name.value; //상품명

                $.post("<?=G5_URL?>/ajax/chk_buy.php",{"write_id":write_id,"bo_table":bo_table,"wr_id":wr_id,"item_count":item_count, "data": $(f).serialize()},function (data) {
                    console.log(data);
                    if(data.code == "200"){
                        f.Amt.value = data.cost; // 가격
                        f.Moid.value = data.buy_no; // 구매번호
                        goPay(f);
                    }
                },"json");
            }
        }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->
