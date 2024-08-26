<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
header("Content-Type: text/html; charset=utf-8");
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style_pro.css">', 0);
?>

<style>
#item_review .rev{ margin:0; border:1px solid #d7d7dd; padding:20px}
#item_review .in{ padding:0}
#sales_list{ margin:0}
.accordionTitle{ text-align:right; position:relative}
.accordionTitle span{ font-size:.8em; font-weight:400; opacity:.8; position:absolute; left:20px; letter-spacing:-.050em}
#sales_list .tprice .col-md-6,#sales_list .tprice .col-sm-6{ padding:0}
#sales_list .tprice span.plus{ width:25px; height:25px; border-radius:50%; text-align:center; line-height:25px; display:inline-block; background: #7d75dc; vertical-align: middle; margin:0 5px}
#sales_list .tprice span.minus{ width:25px; height:25px; border-radius:50%; text-align:center; line-height:25px; display:inline-block; background: #7d75dc; vertical-align: middle; margin:0 5px}
#sales_list .tprice span.plus:after{font-family: "Font Awesome 5 Pro"; content: "\f067"; color: #fff; font-weight: 400; font-size: .5em; position: relative; bottom: 2px; opacity: .8;}
#sales_list .tprice span.minus:after{font-family: "Font Awesome 5 Pro"; content: "\f068"; color: #fff; font-weight: 400; font-size: .5em; position: relative; bottom: 2px; opacity: .8;}
.choi_quantity{ font-size:.90em}
.choi_quantity svg{ margin:0 5px; font-size:1.5em; vertical-align:middle; opacity:.4}
.checks{ font-size:1.0em; opacity:.7}
.box_price .btn_submit{ margin:10px 0 0}
.howorder{ border:1px solid #d7d7dd; padding:20px}
.howorder h3{ font-size:1.20em !important; font-weight:500 !important; margin:0 0 15px !important}
.howorder h3:after{ display:none !important}
.howorder label span{ margin:0 0 0 15px; opacity:.7}
.scroll_content .cont hr{margin:30px 0;}
@media (max-width: 767px){
.fix_info {
    width: 100%;
    transition: all 0.5s;
    float: none;
    margin: 20px 0 0;
}
#item_review{ padding:20px 0}
#sales_list .tprice .col-md-6{ padding:0; text-align:center}
.scroll_content{ float:none !important}
.checks{ font-size:.85em; opacity:.7}
}
</style>


<script type="text/javascript" src="https://pg.innopay.co.kr/pay/js/Innopay.js"></script><!-- InnoPay 결제연동 스크립트(필수) -->
<form id="payfrm" name="payfrm" method="post">
    <!-- 이노페이 필수 -->
    <input type="hidden" name="Amt" id="Amt" value="">
<!--    <input type="hidden" name="GoodsCnt" value="--><?//=$result_cnt?><!--">-->
    <input type="hidden" name="GoodsName" value="JOBGO">
    <!--<input type="hidden" name="Amt" value="--><?//=$total?><!--">-->
    <input type="hidden" name="Moid" id="Moid" value="<?=$Moid?>">
    <input type="hidden" name="MID" value="pgjobgo02m"> <!-- 테스트 : testpay01m -->
    <input type="hidden" name="MerchantKey" value="caDx7wMGGxhsGE5ryFLl9jfXFmP/Fnuatc246Ant4tp0QGElAzqbW5laOQy2wquABsAzNrQ6VOhsVYDr0M/yMA=="> <!-- 테스트 : Ma29gyAFhvv/+e4/AHpV6pISQIvSKziLIbrNoXPbRS5nfTx2DOs8OJve+NzwyoaQ8p9Uy1AN4S1I0Um5v7oNUg== -->
    <input type="hidden" name="ReturnURL" value="<?=G5_BBS_URL?>/pay_result.php">
    <input type="hidden" name="RetryURL" value="<?=G5_BBS_URL?>/pay_result.php">
    <input type="hidden" name="ResultYN" value="N">

    <input type="hidden" name="mallUserID" value="<?=$member['mb_id']?>">
    <input type="hidden" name="BuyerName" value="<?=urldecode($member['mb_name'])?>">
    <input type="hidden" name="BuyerTel" value="<?=str_replace ('-','',$member['mb_hp'])?>">
    <input type="hidden" name="BuyerEmail" value="<?=$member['mb_email']?>">
    <input type="hidden" name="EncodingType" id="EncodingType" value="utf-8">
    <input type="hidden" name="FORWARD" id="FORWARD" value="Y"><!-- 팝업유무 Y,N -->

    <input type="hidden" name="ediDate" value=""><!-- 결제요청일시 제공된 js 내 setEdiDate 함수를 사용하거나 가맹점에서 설정 yyyyMMddHHmmss-->
    <input type="hidden" name="EncryptData" value=""><!-- 암호화데이터 -->
    <input type="hidden" name="MallIP" value="127.0.0.1"/>
    <input type="hidden" name="UserIP" value="127.0.0.1">
    <input type="hidden" name="MallResultFWD" value="N"><!-- Y 인 경우 PG결제결과창을 보이지 않음 -->
    <input type="hidden" name="device" value=""><!-- 자동셋팅 -->


<article id="item_view">

    <!--아이템 뷰-->
    <section id="content_wrap">

        <!--아이템정보 왼쪽-->
        <div class="scroll_content">

            <!--탭-->
            <div class="tabArea">

                <div class="et-main cont">
                
                      <div id="item_review">
                            <div class="in">
                                <div class="rev cf">
                                    <div class="list cf">
                                        <a onclick="toggle_sales('sales_list');">
                                            <div class="mg">
                                                <?php
                                                if($file_row['wr_id']) { ?>
                                                    <img src="<?php echo G5_DATA_URL ?>/file/talent/<?=$file_row['bf_file']?>">
                                                <?php } else { ?>
                                                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/thm29.jpg">
                                                <?php } ?>
                                            </div><!--서비스 썸네일 추출-->
                                            <div class="info">
                                                <div class="tit"><?=$ta['ta_title']?></div>
                                                <div id="lecture_writer_list">
                                                            <div class="mb">
                                                                    <div class="photo"><img class="p_img" src='<?=G5_THEME_IMG_URL?>/sub/01.png'></div>
                                                                <div class="mb_info">
                                                                    <p><?= $mb['mb_nick'] ?>&nbsp;&nbsp;<span><i class="fas fa-star"></i>&nbsp;4.5</span></p>
                                                                </div>
                                                            </div>
                                                </div>
                                                <div class="date"><?=date('Y.m.d H:i', strtotime($ta['wr_datetime']))?>
                                                    <div class="pay"><?= number_format($pta['pta_pay'])?>원</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                               </div>
                           </div>
                       </div>
                       
                       <!--판매 리스트-->
                       <div id="sales_list">
                                <div class="slist">
                                       <div class="tbl_left">
                                            <table summary="판매정보">
                                                  <colgroup>
                                                      <col style="width:70%" />
                                                      <col style="width:13%" />
                                                      <col style="width:*" />
                                                  </colgroup>
                                                  <thead>
                                                      <tr>
                                                           <th>기본항목</th>
                                                           <th>작업일</th>
                                                           <th>금액</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <tr>
                                                           <td>
                                                               <p class="t"><?= $pta_info ?>. <?=$pta['pta_title']?></p>
                                                               <p><?=$pta['pta_content']?></p>
                                                           </td>
                                                           <td><?= ($_REQUEST["pta_idx"] != "pta_write_price") ? $pta['pta_select1']."일" : ""?></td>
                                                           <td><?= number_format($pta['pta_pay'])?>원</td>
                                                      </tr>
                                                  </tbody>
                                            </table>
                                       </div>
                                       <div class="tprice clearfix">
                                            <div class="col-md-6 col-sm-6 choi_quantity">수량선택 <span class="minus" onclick="minus_count()"></span> <input type="text" name="GoodsCnt" id="GoodsCnt" readonly style="border:none;border-right:0px; border-top:0px; boder-left:0px; boder-bottom:0px; width: 18px; background: #f2f2f2" value="1"><span onclick="plus_count()" class="plus"></span></div>
                                            <div class="col-md-6 col-sm-6 text-right" name="total_amt_div"></div>
                                       </div>
                                </div>
                        </div>
                        
                        <hr />
                        
                        <!--결제방법-->
                        <div class="howorder">
                             <h3>결제방법</h3>
                             <div>
<!--                                  <input type="radio" id="check_order"> -->
<!--                                  <label for="check_order">잡고캐쉬<span>보유 잡고캐시 : 25,000원</span></label>-->
                                 <input type="radio" id="pm1" name="PayMethod" value="CARD" checked>
                                 <label for="pm1">카드결제</label>&nbsp;&nbsp;
                                 <input type="radio" id="pm2" name="PayMethod" value="BANK">
                                 <label for="pm2">계좌이체</label>&nbsp;&nbsp;
                                 <input type="radio" id="pm3" name="PayMethod" value="EPAY">
                                 <label for="pm3">간편결제</label>
                             </div>
                        </div>
                        <!--결제방법-->
                        
                        
                </div>

            </div><!--//tabArea-->

        </div>


        <!--가격/재능 정보 오른쪽-->
        <div class="fix_info">
            <!--가격정보-->
            <section class="box_price">
                <ul class="accordion">
                    <li class="item">
                        <h2 class="accordionTitle accordionTitleActive"><span>총 결제금액</span><div name = "total_amt_div"></div></h2>
                        <div class="text show">
                            <div class="box">
                                <div class="checks small">
                                  <input type="checkbox" id="check_order" value="Y">
                                  <label for="check_order">주문 내용을 확인하였으며, 결제에 동의합니다. [필수]</label> 
                                </div>
                                <input type="submit" value="결제하기" id = 'pay_submit' class="btn_submit">
                            </div>
                        </div>
                    </li>
                </ul>
            </section>

            
        </div>
        <!--//가격/재능 정보 오른쪽 모바일 사라짐-->
        
    </section>
    <!--아이템 뷰-->
    
</article>
</form>
<script>
    $(document).ready(function () {
        total_amt();
    })

    function plus_count(){
        $('#GoodsCnt').val(($('#GoodsCnt').val()*1) + 1);
        total_amt();
    }

    function minus_count(){
        var cnt_val = $('#GoodsCnt').val()*1;
        //1이하로 -처리 안되게끔
        if (cnt_val > 1) {
            $('#GoodsCnt').val(cnt_val - 1);
        }
        total_amt();
    }

    function total_amt(){
        var cnt_val = $('#GoodsCnt').val(),
            basic_amt = '<?=$pta["pta_pay"]?>';

        var total_amt = cnt_val * basic_amt;
        console.log(total_amt);
        $("#Amt").val(total_amt);

        $("[name = total_amt_div]").html(numberComma(total_amt)+" 원");
    }

    function numberComma(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }


    //이노페이 금액 보내기
    $("#pay_submit").on("click", function() {
        if($('input[id="check_order"]:checked').val() != 'Y'){
            swal('결제동의 부분을 체크 하지 않으면 결제가 불가능 합니다.');
            return false;
        }
        // console.log(document.payfrm);
        $('#Moid').val("<?=$Moid?>" + "=" + $('#GoodsCnt').val());

        //pc화면이면 팝업
        if (!mobilecheck()){
            $('#FORWARD').val('Y');
        }else{
            $('#FORWARD').val('N');
        }

        goPay(document.payfrm);

    });
</script>