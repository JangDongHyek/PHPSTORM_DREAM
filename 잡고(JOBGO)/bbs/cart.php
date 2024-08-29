<?php
global $pid;
$pid = "market_cart";
$sub_id = "market_cart";
include_once('./_common.php');

$g5['title'] = '마켓 장바구니';
include_once('./_head.php');

?>
<article id="item_view">

    <!--아이템 뷰-->
    <section id="content_wrap">

        <!--아이템정보 왼쪽-->
        <div class="scroll_content">

            <!--탭-->
            <div class="tabArea">

                <div class="et-main cont">
                    <button type="button" class="btn btn_line">
                        전체 삭제
                    </button>
                    <!--판매 리스트-->
                    <div id="sales_list">
                        <div class="slist">
                            <div class="tbl_left">
                                <table summary="판매정보">
                                    <colgroup>
                                        <col style="width:45%" />
                                        <col style="width:30%" />
                                        <col style="width:*" />
                                        <col style="width:15%" />
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th>상품</th>
                                        <th>수량</th>
                                        <th>금액</th>
                                        <th>삭제</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <p class="t">상품명</p>
                                            <p>옵션</p>
                                        </td>
                                        <td class="tprice">
                                            <div class="choi_quantity"><span class="minus" onclick="minus_count()"></span> <input type="text" name="GoodsCnt" id="GoodsCnt" readonly style="border:none;border-right:0px; border-top:0px; boder-left:0px; boder-bottom:0px; width: 35px; background: #f2f2f2" value="1"><span onclick="plus_count()" class="plus"></span></div>
                                        </td>
                                        <td>0원</td>
                                        <td>
                                            <button type="button" class="btn btn_mini btn_line">
                                                삭제
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tprice clearfix">
                                <div class="text-right" name="total_amt_div">0원</div>
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
                        <h2 class="accordionTitle accordionTitleActive"><span>총 결제금액</span><div name="total_amt_div">0원</div></h2>
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
<?php

include_once('./_tail.php');
?>