<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<!-- Modal -->
<div id="basic_modal">
    <!--일반회원-->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="secret_userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">회원가입비 안내</h4>
                </div>
                <div class="modal-body">
                    <div class="area_secret">
                        <ul>
                            <li>
                                <i>01</i>
                                <span>회원가입비 200,000 만원 (<?=number_format($manna_arr['join'])?> 만나 지급)</span>
                            </li>
                            <li>
                                <i>02</i>
                                <span>회원가입 <?=number_format($manna_arr['join'])?> 만나 모두 소진전에 회원탈퇴시 만나 사용한 만큼 현금화하여 탈퇴비용 적용됩니다.</span>
                            </li>
                            <li>
                                <i>03</i>
                                <span>사진 <?=number_format($manna_arr['photo'])?>만나, 나의정보 <?=number_format($manna_arr['myprofile'])?>만나, 메세지 <?=number_format($manna_arr['message'])?>만나 차감적용됩니다.</span>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="payment();">확인</button>
                </div>
            </div>
        </div>
    </div>
    <!--시크릿회원-->
    <div class="modal fade" id="secret_userModal" tabindex="-1" role="dialog" aria-labelledby="secret_userModalLabel" aria-hidden="hidden">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">시크릿회원 가입비 안내</h4>
                </div>
                <div class="modal-body">
                    <div class="area_secret">
                        <ul>
                            <li>
                                <i>01</i>
                                <span>시크릿존은 본인 정보가 일반회원이나 시크릿존회원끼리도 정보공유가 되지 않습니다.</span>
                            </li>
                            <li>
                                <i>02</i>
                                <span>시크릿존 회원은 일반회원을 볼 수 있으며, 채팅도 가능합니다. 시크릿존 회원이 일반회원에게 채팅시에 일반회원도 채팅에 응할 수 있습니다.</span>
                            </li>
                            <li>
                                <i>03</i>
                                <span>시크릿존 회원은 1차적으로 일반회원을 요청시 자유롭게 채팅이 가능하며 시크릿 회원의 채팅을 원할경우는 추가비용이 발생합니다.</span>
                            </li>
                            <li>
                                <i>04</i>
                                <span>시크릿존의 비용안내 : 회원가입비 500,000원 적용됩니다.</span>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"  onclick="payment();">확인</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--알람설정 시작-->
<div id="mypage">
    <div id="point">
        <div class="point_state" style="padding:0;">

            <form action="">
                <ul>
                    <li class="tit">
                        <span class="lev_name">종류</span>
                        <span class="man">지급혜택</span>
                        <span class="won">결제금액</span>
                    </li>

                    <!-- 프로필 신청넣고 비승인일때 결제창 다른거보여지게 wc -->
                    <!-- 23.04.11 메인에서 결제비 그냥그걸로만하게 -->
                    <?php //if($member['mb_approval_request'] == 'Y' && $member['mb_approval'] == 'N'){ ?>
                    <?php if(0){ ?>

                        <!-- 시크릿회원일때는 50만원짜리 -->
                        <?php if($member['secret_member'] == 'Y'){ ?>
                        <li>
                            <div class="rdo_ico">
                                <input type="radio" name="level_charge" id="lev01" value="500000" class="hidden" checked>
                                <label for="lev01">
                                    <span class="lev_name"><b>시크릿가입비</b></span>
                                    <span class="man"><b>회원권</b></span>
                                    <span class="won">500,000<b>원</b></span>
                                </label>
                            </div>
                        </li>
                        <script>
                            //회원권 관련 모달 띄워줄지 말지 get으로 받아서 결정하는 부분
                            <?php if($_GET['modal_show'] == 'true'){  ?>
                            window.onload=function() {
                                $('#secret_userModal').modal('show');
                            }
                            <?php } ?>
                        </script>

                        <!-- 일반회원은 10만원짜리 -->
                    <?php }else{ ?>

                        <li>
                            <div class="rdo_ico">
                                <input type="radio" name="level_charge" id="lev01" value="200000" class="hidden" checked>
                                <label for="lev01">
                                    <span class="lev_name"><b>회원가입비</b></span>
                                    <span class="man">2000<b>만나</b></span>
                                    <span class="won">200,000<b>원</b></span>
                                </label>
                            </div>
                        </li>
                        <script>
                            //회원권 관련 모달 띄워줄지 말지 get으로 받아서 결정하는 부분
                            <?php if($_GET['modal_show'] == 'true'){  ?>
                            window.onload=function() {
                                $('#userModal').modal('show');
                            }
                            <?php } ?>
                        </script>

                    <?php } ?>

                    <?php }else{ ?>


                        <li>
                            <div class="rdo_ico">
                                <input type="radio" name="level_charge" id="lev01" value="9900" class="hidden" checked>
                                <label for="lev01">
                                    <span class="lev_name"><b>노멀</b></span>
                                    <span class="man">100<b>만나</b></span>
                                    <span class="won">9,900<b>원</b></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="rdo_ico">
                                <input type="radio" name="level_charge" id="lev02" value="29000" class="hidden">
                                <label for="lev02">
                                    <span class="lev_name"><b>프리미엄</b></span>
                                    <span class="man">350<b>만나</b></span>
                                    <span class="won">29,000<b>원</b></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="rdo_ico">
                                <input type="radio" name="level_charge" id="lev03" value="59000" class="hidden">
                                <label for="lev03">
                                    <span class="lev_name"><b>실버</b></span>
                                    <span class="man">800<b>만나</b></span>
                                    <span class="won">59,000<b>원</b></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="rdo_ico">
                                <input type="radio" name="level_charge" id="lev04" value="99000" class="hidden">
                                <label for="lev04">
                                    <span class="lev_name"><b>골드</b></span>
                                    <span class="man">1,400<b>만나</b></span>
                                    <span class="won">99,000<b>원</b></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="rdo_ico">
                                <input type="radio" name="level_charge" id="lev05" value="149000" class="hidden">
                                <label for="lev05">
                                    <span class="lev_name"><b>시그니처</b></span>
                                    <span class="man">2,100<b>만나</b></span>
                                    <span class="won">149,000<b>원</b></span>
                                </label>
                            </div>
                        </li>
                    <? } ?>

                </ul>
                <div class="btnBox">
                    <button type="button" onclick="payment();">결제하기</button>
                </div>
                
                <div class="add_btn">
                	<button type="button" onclick="payment2(30000)">1회 주선비 <span class="won"><span class="person">1인</span>30,000원</span></button>
                	<button type="button" onclick="payment2(150000)">성혼 성사비 <span class="won"><span class="person">1인</span>150,000원</span></button>
                </div>
            </form>

            <dl class="info_wrap">
                <dt>계좌번호 안내</dt>
                <dd>856901-00-022192 국민은행 문소희</dd>
            </dl>
        </div>
        <!-- /point_state -->
    </div>
</div><!--mypage-->
<!--마이페이지 끝-->

<script type="text/javascript" src="https://pg.innopay.co.kr/pay/js/Innopay.js"></script><!-- InnoPay 결제연동 스크립트(필수) -->
<!--<script type="text/javascript" src="<?/*=G5_JS_URL*/?>/Innopay.js"></script>--><!-- InnoPay 결제연동 스크립트(필수) -->
<form id="payfrm" name="payfrm" method="post">
    <!-- 이노페이 필수 -->
    <input type="hidden" name="PayMethod" value="CARD">
    <input type="hidden" name="GoodsCnt" value="1">
    <input type="hidden" name="GoodsName" id="GoodsName" value="">
    <input type="hidden" name="Amt" id="Amt" value="">
    <input type="hidden" name="Moid" id="Moid" value="<?=$Moid?>">
    <input type="hidden" name="MID" value="pgcsignalm"> <!-- 테스트 : testpay01m -->
    <input type="hidden" name="MerchantKey" value="5xX2sDs2cMv6g/tvLaFRlBHH2iDs9YJMf5p33Zu702qSy4Fj7DTrUSF2Q8X9OPWVWITJW3Sr3GuXWmaWK//cwg=="> <!-- 테스트 : Ma29gyAFhvv/+e4/AHpV6pISQIvSKziLIbrNoXPbRS5nfTx2DOs8OJve+NzwyoaQ8p9Uy1AN4S1I0Um5v7oNUg== -->
    <!--    --><?php //} ?>
    <input type="hidden" name="ReturnURL" value="<?=G5_BBS_URL?>/payment_result_level.php">
    <input type="hidden" name="RetryURL" value="<?=G5_BBS_URL?>/payment_result_level.php">
    <input type="hidden" name="ResultYN" value="N">

    <input type="hidden" name="mallUserID" value="<?=$member['mb_id']?>">
    <input type="hidden" name="BuyerName" value="<?=$member['mb_name']?>">
    <input type="hidden" name="BuyerTel" value="<?=str_replace ("-","",$member["mb_hp"])?>">
    <input type="hidden" name="BuyerEmail" value="">
    <input type="hidden" name="EncodingType" id="EncodingType" value="utf-8">
    <input type="hidden" name="FORWARD" value="N"><!-- 팝업유무 Y,N -->

    <input type="hidden" name="ediDate" value=""><!-- 결제요청일시 제공된 js 내 setEdiDate 함수를 사용하거나 가맹점에서 설정 yyyyMMddHHmmss-->
    <input type="hidden" name="EncryptData" value=""><!-- 암호화데이터 -->
    <input type="hidden" name="MallIP" value="127.0.0.1"/>
    <input type="hidden" name="UserIP" value="127.0.0.1">
    <input type="hidden" name="MallResultFWD" value="N"><!-- Y 인 경우 PG결제결과창을 보이지 않음 -->
    <input type="hidden" name="device" value=""><!-- 자동셋팅 -->
</form>

<script>
    // 결제하기
    function payment() {
        var chk = $("input[name='level_charge']:checked").val();
        var manna = 0;
        var member_type = '';
        if (chk == 9900){
            manna = 100;
        }else if (chk == 29000){
            manna = 350;
        }else if (chk == 59000){
            manna = 800;
        }else if (chk == 99000){
            manna = 1400;
        }else if (chk == 200000){
            manna = 2000;
            member_type = ' 일반회원권';
        }else if (chk == 149000){
            manna = 2100;
        }else if (chk == 500000){
            manna = 0;
            member_type = ' 시크릿회원권';
        }

        $('#GoodsName').val('크리스찬시그널' + member_type +'_' + manna);
        $('#Amt').val($("input[name='level_charge']:checked").val());

        <?php if($private || $member["mb_id"] == "test2" || $member["mb_id"] == "test" || $member["mb_id"] == "test3" || $member["mb_id"] == "test5" || $member["mb_id"] == "test7") { ?>
        $('#Amt').val('10');
        // $('#Moid').val($("#Moid").val()+"-"+manna);
        <?php } ?>
        // $('#Amt').val('10');

        goPay(document.payfrm);
    }

    // 결제하기
    function payment2(chk_val) {
        var chk = chk_val;
        var manna = 0;
        var member_type = '';
        if (chk == 9900){
            manna = 100;
        }else if (chk == 29000){
            manna = 350;
        }else if (chk == 30000){
            manna = 0;
            member_type = ' 1회 주선비';
        }else if (chk == 59000){
            manna = 800;
        }else if (chk == 99000){
            manna = 1400;
        }else if (chk == 200000){
            manna = 2000;
            member_type = ' 일반회원권';
        }else if (chk == 149000){
            manna = 2100;
        }else if (chk == 150000){
            manna = 0;
            member_type = '성혼 성사비';
        }else if (chk == 500000){
            manna = 0;
            member_type = ' 시크릿회원권';
        }

        $('#GoodsName').val('크리스찬시그널' + member_type +'_' + manna);
        $('#Amt').val(chk_val);

        <?php if($private || $member["mb_id"] == "test2" || $member["mb_id"] == "test" || $member["mb_id"] == "test3" || $member["mb_id"] == "test11") { ?>
        $('#Amt').val('10');
        // $('#Moid').val($("#Moid").val()+"-"+manna);
        <?php } ?>
        // $('#Amt').val('10');

        goPay(document.payfrm);
    }


</script>