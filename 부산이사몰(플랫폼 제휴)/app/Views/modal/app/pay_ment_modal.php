<?php
?>

<!-- 결제등록 -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="PaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form name="cardNum" autocomplete="off">
            <input type="hidden" name="orderPrice" value="<?=HP_PRICE['price']?><?=HP_PRICE['price']?>">
            <input type="hidden" name="division" value="hp">
            <input type="hidden" name="eidx" id="eidx" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                    <h5 class="modal-title" id="PaymentModalLabel">결제 등록</h5>
                </div>
                <div class="modal-body">
                    <div class="payment">
                        <div class="select">
                            <input type="radio" name="payment" id="card" onclick="showForm('cardForm')" checked>
                            <label for="card">카드결제</label>
                            <input type="radio" name="payment" id="cms" onclick="showForm('cmsForm')" disabled> <!--disabled-->
                            <label for="cms">CMS결제</label>
                        </div>
                        <div class="box_line">
                            <!-- 카드결제 -->
                            <dl class="form_wrap" id="cardForm">
                                <dt><label for="">카드번호 입력</label></dt>
                                <dd class="flex gap5">
                                    <input type="text" name="cardNum00" id="cardNum00" maxlength="4" value="" placeholder="4자리"/>
                                    <input type="text" name="cardNum01" id="cardNum01" maxlength="4" value="" placeholder="4자리"/>
                                    <input type="text" name="cardNum02" id="cardNum02" maxlength="4" value="" placeholder="4자리"/>
                                    <input type="password" name="cardNum03" id="cardNum03" maxlength="4" value="" placeholder="4자리"/>
                                </dd>
                                <dt><label for="cardMm">유효기간</label></dt>
                                <dd class="flex gap5"><input type="text" maxlength="2" name="cardMm" id="cardMm" value="" placeholder="MM"/>
                                    <input type="text" name="cardYy" id="cardYy"maxlength="2"  value="" placeholder="YY"/></dd>
                                <dt><label for="cardPwd">카드 비밀번호 앞 2자리</label></dt>
                                <dd class="flex gap5">
                                    <input type="password" name="cardPwd" id="cardPwd" value="" maxlength="2" placeholder="카드 비밀번호 앞 2자리"/>
                                </dd>
                                <dt><label for="idNum">카드인증번호</label></dt>
                                <dd><input type="text" name="idNum" id="idNum" value="" maxlength="12"  placeholder="개인: 주민번호 앞6자리 / 법인: 사업자번호 10자리"/></dd>
                            </dl>

                            <!-- CMS결제 -->
                            <dl class="form_wrap" id="cmsForm" style="display: none;">
                                <dt><label for="">은행명</label></dt>
                                <dd>
                                    <select>
                                        <option>국민은행</option>
                                    </select>
                                </dd>
                                <dt><label for="accountInfo">계좌정보 입력</label></dt>
                                <dd><input type="text" name="accountInfo" id="accountInfo" value="" placeholder="계좌정보"/></dd>
                                <dt><label for="accountHolder">예금주</label></dt>
                                <dd><input type="text" name="accountHolder" id="accountHolder" value="" placeholder="예금주"/></dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>-->
                    <button type="submit" class="btn btn-primary">등록 완료</button>
                </div>
            </div>
        </form>
    </div>
</div>
