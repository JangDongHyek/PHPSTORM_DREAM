<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//include_once($member_skin_path.'/mb.head.php');

?>
<style>
body{background: #fff;}
</style>


<!-- 회원가입시작 { -->
<div class="mbskin">
    <form method="post" accept-charset="euc-kr">
    <article class="box-article">
    	<div id="join_info">
                <div class="card_info">
                	<span class="car"><i class="fas fa-credit-card"></i></span> <strong class="title">내 카드 정보</strong>
                    <div class="sc">정기결제를 위해 카드정보 등록이 필요합니다.</div>
                    <dl class="row">
                            <dd class="col-xs-12">
                                <label for="reg_card_no">카드번호</label>
                                <input type="text"  name="cardNum" id="cardNum" class="regist-input" placeholder="카드번호를 입력하세요" value="<?=$my_card['cardNum']?>">
                                <span class="sm_t">카드번호는 -없이 입력하세요</span>
                            </dd>
                    </dl>
                    <dl class="row">
                            <dd class="col-xs-12">
                                <label for="reg_card_val">유효기간</label>
                                <input type="number"  name="cardExpire" id="cardExpire" class="regist-input" placeholder="YYMM(ex:03/25 => 2503)">
                                <span class="sm_t">카드 년도와 월을 숫자로만 입력하세요 (YYMM)</span>
                            </dd>
                    </dl>
                    <dl class="row">
                            <dd class="col-xs-12">
                                <label for="reg_card_pw">비밀번호(앞자리 2자리)</label>
                                <input type="number"  name="cardPwd" id="cardPwd" class="regist-input">
                                <span class="sm_t">카드 비밀번호 앞자리 2자리 수만 입력하세요</span>
                            </dd>
                    </dl>
                    <dl class="row">
                            <dd class="col-xs-12">
                                <label for="auth_num">인증번호</label>
                                <input type="number" name="idNum" id="idNum" class="regist-input">
                                <span class="sm_t">주민등록번호 앞자리 또는 사업자등록번호를 입력하세요.</span>
                            </dd>
                    </dl>
                </div>
                
        </div><!--//join_info-->
		

		<input type="button" class="btn_submit ft_btn" style="margin-top:15px " onclick="return cardRegister()"  value="카드등록" accesskey="s">
	</article>
    </form>
    <form name="frmitem" method="post" action="<?=G5_BBS_URL?>/card_register_update.php">
        <input type="hidden" name="resultCode" value="">
        <input type="hidden" name="resultMsg">
        <input type="hidden" name="arsOrderKey" value="">
        <input type="hidden" name="arsTid">
        <input type="hidden" name="billKey">
        <input type="hidden" name="cardCode">
        <input type="hidden" name="cardNum">
        <input type="hidden" name="moid">
        <input type="hidden" name="payExpDate">


        <input type="hidden" name="userId" value="<?=$member[mb_id]?>">
    </form>

</div>
<script>

    function cardRegister(){
        const data = {mid:"pgcnftp02m",moid:"<?=date("YmdHis")?>_<?=rand(10,99)?>",payMethod:"RAUT",userId:"<?=$member[mb_id]?>",buyerName:"<?=$member[mb_name]?>",cardNum:$("#cardNum").val(),cardExpire:$("#cardExpire").val(),cardPwd:$("#cardPwd").val(),idNum:$("#idNum").val(),buyerHp:"<?=hyphen_hp_number($member[mb_hp])?>",arsUseYn:"N","billKey":"<?=$member['billKey']?>"};
        $.ajax({
            type : "POST",
            url : "https://api.innopay.co.kr/api/regAutoCardBill",
            async : true,
            data : JSON.stringify(data),
            contentType: "application/json; charset=utf-8",
            dataType : "json",
            cache : false,
            success : function(data){
                console.log(data);

                const frmitem = document.frmitem;
                if(data.resultCode=="0000"){
                    frmitem.resultCode.value=data.resultCode;
                    frmitem.resultMsg.value=data.resultMsg;
                    frmitem.arsOrderKey.value=data.arsOrderKey;
                    frmitem.arsTid.value=data.arsTid;
                    frmitem.billKey.value=data.billKey;
                    frmitem.cardCode.value=data.cardCode;
                    frmitem.cardNum.value= $("#cardNum").val();
                    frmitem.moid.value=data.moid;
                    frmitem.payExpDate.value=data.payExpDate;
                    frmitem.submit();
                }else{
                    alert(data.resultMsg+"\n 관리자에게 문의하십시오.");
                }
                console.log(data);

                //saveAutoPay(data,data2);
            },
            error : function(data){
                console.log(data);
                alert("통신에러");
            }
        });
    }

</script>