<?php 
    echo view('common/header_adm');
    $pid = "infoSale";
    $header_name = "판매정보 입력";
?>

<div id="register">
    <div class="box">
        <div class="hd_tit">스마트정비마켓 판매회원 가입</div>
        <div class="tit_wrap">
            <h1>판매사원 여부를 확인해주세요</h1>
        </div>

        <form class="form_wrap agr_form_wrap" id="sale_form" name="sale_form">
            <!--
            <p class="tit">미니샵/스토어 이름</p>
            <input type="text" class="border_gray" placeholder="띄어쓰기 없이 한글만 3-10자 또는 영문, 숫자만 6-20자" value=''>
-->
            <!--            <p class="msg-text">msg</p>-->

            <!--          셀러확인절차 추가-->

            <p>해당 온라인 마켓 판매사원(셀러)에 모두 체크해주세요</p>
            <div class="btn_wrap seller_wrap">
                <input type="checkbox" id="seller_gmarket" name="seller_gmarket" value="gmarket" <?= get_checked($seller_gmarket,"T")?>>
                <label class="btn" for="seller_gmarket">G마켓</label>
                <input type="checkbox" id="seller_action" name="seller_action" value="action" <?= get_checked($seller_action,"T")?>>
                <label class="btn" for="seller_action">옥션</label>
            </div>
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>
            <p class="guide-text">상기 경우에 해당이 안되실 경우 스마트정비 마켓 판매사원 등록이 불가합니다.</p>

            <?
                $div_store_url_hidden = "display:none;";
                if(!empty($store_url)){
                    $div_store_url_hidden = "display:block;";
                }
            ?>

            <div class="input_shopurl" id="div_store_url" style="<?=$div_store_url_hidden?>">
                <p class="tit">해당 온라인 마켓 미니샵/스토어 URL을 입력하세요</p>
                <div>
                    <div class="input_url">
                        <input type="text" class="border_gray" placeholder="기존 G마켓/옥션 미니샵/스토어 URL 입력하세요" id="store_url" name="store_url" value="<?=$store_url?>">
                        <button type="button" class="btn btn-lg btn-white text-sm" onclick="chk_url()">연결확인</button>
                    </div>
                    <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>
                    <p class="guide-text">G마켓 또는 옥션 중 하나의 미니샵(스토어) URL 입력</p>
                </div>
<!--                <div id="div_action_url" hidden>
                    <input type="text" class="border_gray" placeholder="기존 옥션 미니샵/스토어 URL 입력하세요">
                </div>-->

            </div>



            <!--
            <p class="tit">미니샵/스토어 주소 (URL)</p>
            <input type="text" class="border_gray" placeholder="띄어쓰기 없이 영문, 숫자 6-20자" value=''>
            <p class="guide-text">https://minishop.gmarket.co.kr/
                https://stores.auction.co.kr/
                뒤에 사용하실 미니샵/스토어 주소(URL)입니다.</p>

            <p class="tit">미니샵/스토어 소개글</p>
            <textarea class="border_gray" placeholder="5자 이상 90자 이내로 입력"></textarea>
            <p class="guide-text">타 쇼핑몰 및 개인 사이트 등 외부 URL 정보 또는 욕설, 비속어 입력 시 임의 삭제될 수 있습니다.</p>
-->


<!--            <div class="agr_wrap wh-box">
                <div class="agr_all">
                    <input type="checkbox" id="allAgr">
                    <label for="allAgr">
                        <div class="label_tit color-blue">
                            전체동의
                        </div>
                        <i class="fa-duotone fa-square-check"></i>
                    </label>
                </div>

                <input type="checkbox" id="un_essAgr01" <?/*= get_checked($market_discount_agreement, "T")*/?>>
                <label for="un_essAgr01">
                    <div class="label_tit">
                        <span class="color-blue">(권장)</span>
                        마켓할인 지원 프로그램 서비스 동의
                    </div>
                    <i class="fa-duotone fa-square-check"></i>
                </label>

                <input type="checkbox" id="un_essAgr02" <?/*= get_checked($credit_card_promotion_agreement, "T")*/?>>
                <label for="un_essAgr02">
                    <div class="label_tit">
                        <span class="color-blue">(권장)</span>
                        신용카드사 제휴채널 프로모션 서비스 동의
                    </div>
                    <i class="fa-duotone fa-square-check"></i>
                </label>
                <div class="box__section section-termsbox">
                    <div class="box__service-info js-expanded-active">
                        <button type="button" class="button__terms-more sprite__signup-seller--after" aria-expanded="true" aria-haspopup="true">
                            스마트정비 마켓서비스 안내
                        </button>
                        <div class="box__terms-cont box__expanded-cont" aria-hidden="false">
                            <dl class="list__service-info">
                                <dt class="list-title">할인 지원 프로그램</dt>
                                <dd class="list-cont">
                                    <ul class="list__default">
                                        <li class="list-item">안녕하세요. 주식회사 지마켓입니다. (이하 (주)지마켓(지마켓, 옥션))<br>(주)지마켓(지마켓, 옥션)은 2011년 1월부터 ((주)지마켓(지마켓, 옥션)이 할인을 부담하는 할인 지원 프로그램을 시행해오고 있으며 본 프로그램에 동의하신 판매자 상품에 한하여 (주)지마켓(지마켓, 옥션)에서 제공하는 할인 혜택이 적용됩니다.</li>
                                        <li class="list-item">(주)지마켓(지마켓, 옥션) 지원 할인 프로그램에 참여하시면 등록하신 모든 상품은 지마켓, 옥션 사이트 및 가격비교 사이트에서 (주)지마켓(지마켓, 옥션) 지원 할인 프로그램 적용 대상이 됩니다. 그러나, 동의하지 않으실 경우 등록하신 모든 상품은 (주)지마켓(지마켓, 옥션) 지원 할인 프로그램 적용 대상에서 제외되며 판매자가 등록하신 판매가격 또는 판매자가 부담하시는 할인만 적용되어 판매가 됩니다.</li>
                                        <li class="list-item">(주)지마켓(지마켓, 옥션) 지원 할인 프로그램이란, 상품의 정상 판매가격에 구매자에게 제공하는 상품 할인액에 따라 카테고리별 서비스이용료 범위 내의 서비스이용료 할인을 적용하여 판매자의 서비스이용료 부담을 낮추는 동시에 구매자에게는 더욱 저렴한 가격의 상품을 판매하도록 하는 거래 활성화 프로그램입니다. 판매자가 (주)지마켓(지마켓, 옥션)이 시행하는 (주)지마켓(지마켓, 옥션) 지원 할인 프로그램에 참여하여 구매자에게 판매 상품에 대한 할인을 제공하시는 경우 판매자가 (주)지마켓(지마켓, 옥션)에 지급하는 서비스이용료가 변경될 수 있습니다.</li>
                                        <li class="list-item">판매자가 (주)지마켓(지마켓, 옥션) 지원 할인프로그램 참여 여부를 결정하시더라도 본 프로그램이 적용되는 시점부터 언제든지 원하실 경우 참여 여부를 변경하실 수 있습니다. 즉 판매자는 탈퇴 및 (재)참여의 선택에 의해 (주)지마켓(지마켓, 옥션) 지원 할인 프로그램의 적용 여부 및 적용 기간을 변경할 수 있습니다. 참여 여부를 변경하시기 전까지는 기존 선택이 지속 적용됩니다. 단, 참여 여부 변경시 그 반영은 변경 시점부터 즉시 이루어집니다. 사업자 판매자께서 복수 ID를 사용하고 있으면 참여 및 변경의 효력은 판매자가 보유한 모든 ID에 미치게 됩니다. 개인 판매자께서 사업자 판매자로 변경하시는 경우, (주)지마켓(지마켓, 옥션) 지원 할인프로그램의 동의 여부는 기존 개인 판매자 ID의 설정과 동일하게 승계됩니다.</li>
                                        <li class="list-item">판매자 ID별 동의여부 설정 및 변경은 [ESM+ 계정(ID) 관리 &gt; G마켓 판매자 계정(ID) 관리 &gt; 판매자 정보 관리], [ESM+ 계정(ID) 관리 &gt; 옥션 판매자 계정(ID) 관리 &gt; 회원정보 수정]에서 가능합니다.</li>
                                    </ul>
                                </dd>
                                <dt class="list-title">제휴채널 프로모션 대행서비스</dt>
                                <dd class="list-cont">
                                    <ul class="list__default">
                                        <li class="list-item">안녕하세요. 주식회사 지마켓입니다. (이하 (주)지마켓(지마켓, 옥션))<br>제휴채널(네이버, 에누리, 다나와 등 가격비교 서비스) 할인쿠폰 적용에 동의한 판매자의 상품을 제휴채널을 통해 (주)지마켓(지마켓, 옥션)이 자동으로 할인/쿠폰 등의 지원을 제공하는 서비스를 제공중입니다.</li>
                                        <li class="list-item">2016년 6월 29일까지 판매자분께서 동의여부를 결정하지 않을 경우, 2016년 6월 30일부터 "제휴 채널 프로모션 대행 서비스”에 동의하는 것으로 일괄 적용됩니다. 단, 2016년 6월 30일 이후 신규 가입 판매자분께서는 제휴 채널 프로모션 대행 서비스 및 사이트 부담 지원 할인에 “동의”하셔야 지원받으실 수 있습니다.</li>
                                        <li class="list-item">'제휴채널 프로모션 대행서비스'에 '동의 안 함'으로 설정하면, 제휴채널에서 판매자 발행 쿠폰만 적용된 가격으로 노출됩니다. ((주)지마켓(지마켓, 옥션) 정책에 따라 일부 CM 발행 추가할인이 적용될 수 있습니다.)</li>
                                        <li class="list-item">'제휴채널 프로모션 대행서비스'에 '동의함'으로 설정하면, 제휴채널에서 할인/쿠폰이 지원됩니다. (단, 전체 상품에 반드시 적용되는 것은 아니며, 할인/쿠폰 적용 여부 및 금액은 이용자 경험 향상, 소비자 후생 증대 등을 모두 고려한 (주)지마켓(지마켓, 옥션) 내부 기준을 따릅니다. 제휴채널 프로모션 대행서비스에 동의하고, 상품등록 시, 포털 가격 비교 사이트에 노출 동의한 경우, 가격비교 사이트를 통한 주문 발생 시 판매가의 2%가 서비스이용료로 부과됩니다.)</li>
                                        <li class="list-item">'제휴채널 프로모션 대행서비스'에 포함되는 제휴채널 및 노출 공간은 별도의 공지 없이 추가, 변경, 삭제될 수 있습니다.</li>
                                    </ul>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>-->
        </form>

        <button type="button" onclick="chk_miniShop()" class="btn btn-blue btn-comp">다음단계로</button>
    </div>
</div>



<script>

    let isAjaxIng = false;
    function chk_miniShop(){
        if(isAjaxIng) {
            return false;
        }
        isAjaxIng = true;

        //삭제해야함
        if("<?=$pass?>" == "T"){
            location.href = "<?=base_url('signup/selfCerti')?>";
        }

        let gmarket_checked = $("#seller_gmarket").is(':checked');
        let have_gmarket = 'F';
        if(gmarket_checked) {
            have_gmarket = 'T';
        }
        let action_checked = $("#seller_action").is(':checked');
        let have_action = 'F';
        if(action_checked) {
            have_action = 'T';
        }



        $('.msg-text').hide();

        let formData = new FormData($('#sale_form')[0]);
        formData.append("seller_gmarket",have_gmarket);
        formData.append("seller_action",have_action);


        $.ajax({
            url: '<?= base_url("signup/chkMiniShop")?>',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if(data.code == 200){
                    location.href = "<?=base_url('signup/selfCerti')?>";
                } else {
                    err_msg(data.err_id, data.msg);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
            },
            complete: function(jqXHR, textStatus) {
                isAjaxIng = false;
            }
        });
    }

    $('#allAgr').change(function() {
        var isChecked = $(this).is(':checked');
        $('#un_essAgr01, #un_essAgr02').prop('checked', isChecked);
    });

    $(document).ready(function() {
        $('.seller_wrap > label').click(function(){
            $('.input_shopurl').css("display","grid");
        });
        $('.button__terms-more').click(function() {
            $(this).next('.box__terms-cont').toggleClass('active');
        });
    });
    
    $("#seller_gmarket, #seller_action").on('change', function() {
        let gmarket_checked = $("#seller_gmarket").is(':checked');
        let action_checked = $("#seller_action").is(':checked');

        if(gmarket_checked || action_checked){
            $("#div_store_url").show();
        } else {
            $("#div_store_url").hide();
        }
    });


    function chk_url() {
        let url = $("#store_url").val().trim();
        if (url) {
            window.open(url, '_blank');
        }
    }



</script>
<?php echo view('common/footer'); ?>
