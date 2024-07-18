<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

if(!$is_member){
    alert("로그인 후 이용해주세요.");
}

$db_table = "g5_write_".$bo_table;

$sql = "select * from `$db_table` where `wr_id` = '$wr_id'";
$row = sql_fetch($sql);

if(empty($row)){
    alert("잘못된 접근입니다.");
}

if(empty($row['wr_10'])){
    alert("현재 상품은 구매할수 없습니다.");
}

if(empty($row['wr_9'])) {
    $row['wr_9'] = 0;
}

if(empty($row['wr_8'])) {
    $row['wr_8'] = 0;
}

if($row['ca_name'] == "동물/가족인형" || $row['ca_name'] == "치유인형"){
    $PAY_MID = "pgkaft002m";
    $PAY_MerchantKey = "8XzSLpY63mpGcxYViAgXJcCuvRWlj0AXhIaR3203/bA0QYCM8E0BMZrZH1if/iFmM/RrSRIOEHCGYVKfU3xEdw==";
    $CANCEL_PASSWORD = "123456";
}

$sum_cost = $row['wr_10'] + $row['wr_9'] + $row['wr_8'];

$thumb = get_list_thumbnail($bo_table, $row['wr_id'], 850, 850);
?>

<style>
	.tbl_frm01 th{
		min-width: 150px;
	}

@media (max-width:768px){
	.tbl_frm01 tr{
		display: flex;
		flex-direction: column;
	}
	.tbl_frm01 td,
	.tbl_frm01 th{
		min-width: inherit;
		width: 100%;
	}
	.frm_input{
		min-width: 200px;
	}
	.frm_address{
		width: 100%;
	}
}
</style>
<script src="<?php echo G5_URL ?>/js/Innopay.js"></script>
<div class="mbskin">
    <form id="orderf" name="orderf" action="" method="post" autocomplete="off">
        <input type="hidden" name="good_name" value="<?=$row['wr_subject']?>">
        <input type="hidden" id="good_mny" name="good_mny" value="<?=$sum_cost?>">
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
        <input type="hidden" id="item_cost" name="item_cost" value="<?=$row['wr_10']?>">

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>주문상품 정보</caption>
        <tbody>
        <tr>
            <td class="pro_info">
            	<div class="thumb">
            		<img src="<?=$thumb['src']?>" alt="">
				</div>
            	<p class="pro_title"><?=$row['wr_subject']?></p>
            	<div class="etcWrap">
					<button type="button" class="btn_etc minus" onclick="set_item_count('-')">-</button>
					<input type="text" class="etc_input" id="item_count" name="item_count" value="1">
					<button type="button" class="btn_etc plus" onclick="set_item_count('+')">+</button>
            	</div>
            	<div class="price"><strong class="color-green" id="item_cost_str"><?=number_format($row['wr_10'])?></strong>원</div>
            </td>
        </tr>
        <tr>
            <td class="pro_info">
                <p class="pro_title">배송비</p>
                <div class="price"><strong class="color-green" id="ship_cost"><?=number_format($row['wr_9'])?></strong>원</div>
            </td>
        </tr>

        <tr>
            <td class="pro_info">
                <p class="pro_title">추가금</p>
                <div class="price"><strong class="color-green" id="add_cost"><?=number_format($row['wr_8'])?></strong>원</div>
            </td>
        </tr>

        <tr>
            <td class="pro_info">
                <p class="pro_title">합계</p>
                <div class="price"><strong class="color-green" id="sum_cost"><?=number_format($sum_cost)?></strong>원</div>
            </td>
        </tr>

        </tbody>
        </table>
    </div>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>배송지 정보 입력</caption>
        <tbody>
        <tr>
            <th scope="row"><label for="reg_mb_name">이름<strong class="sound_only">필수</strong></label></th>
            <td>
                <input type="text"  id="reg_mb_name" name="mb_name" value="<?php echo get_text($member['mb_name']) ?>" <?php echo $readonly; ?> class="frm_input <?php echo $readonly ?>" minlength="3" maxlength="20">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="reg_mb_hp">휴대폰번호<?php if ($config['cf_req_hp']) { ?><strong class="sound_only">필수</strong><?php } ?></label></th>
            <td>
                <input type="number"  name="mb_hp" value="<?php echo str_replace('-','',$member['mb_hp']) ?>" id="reg_mb_hp" <?php echo ($config['cf_req_hp'])?"":""; ?> class="frm_input " maxlength="20">
                <?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
                <input type="hidden" name="old_mb_hp" value="<?php echo get_text($member['mb_hp']) ?>">
                <?php } ?>
            </td>
        </tr>

        <tr>
            <th scope="row">
                주소
                <?php if ($config['cf_req_addr']) { ?><strong class="sound_only">필수</strong><?php }  ?>
            </th>
            <td>
<!--                <div>
                    <input type="checkbox" name="foreign_chk" id="foreign_chk" value="Y"/>
                    <label for="foreign_chk">해외 거주자</label>
                </div>-->
                <div id="addr_hide">
                    <label for="mb_zip" class="sound_only">우편번호<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
                    <input type="text" placeholder="우편번호"  name="mb_zip" readonly value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" id="mb_zip" <?php echo $config['cf_req_addr']?"":""; ?> class="frm_input <?php echo $config['cf_req_addr']?"":""; ?>" size="5" maxlength="6">
                    <button type="button" class="btn_frmline" onclick="win_zip('orderf','mb_zip','mb_addr1','mb_addr2','mb_addr3','mb_addr4' );">주소 검색</button><br>
                    <input type="text" name="mb_addr1" readonly value="<?php echo get_text($member['mb_addr1']) ?>" id="mb_addr1" <?php echo $config['cf_req_addr']?"":""; ?> class="frm_input frm_address <?php echo $config['cf_req_addr']?"":""; ?>" size="70" maxlength="100" placeholder="주소검색을 해주세요">
                    <input type="text" name="mb_addr2" value="<?php echo get_text($member['mb_addr2']) ?>" id="mb_addr2" class="frm_input frm_address" size="70" maxlength="100" placeholder="상세주소를 입력해주세요">
                    <input type="hidden" id="mb_addr3" name="mb_addr3">
                    <input type="hidden" id="mb_addr4" name="mb_addr4">
                </div>
            </td>
        </tr>

		</tbody>
        </table>
    </div>

<!--    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>결제정보 입력</caption>
        <tbody>
        <tr>
            <th scope="row"><label for="">입금일<strong class="sound_only">필수</strong></label></th>
            <td>
            	<input type="date" class="frm_input">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="">입금액<strong class="sound_only">필수</strong></label></th>
            <td>
            	<input type="text" placeholder="입금액을 기재해주세요" class="frm_input"> 원
            </td>
        </tr>
        </tbody>
        </table>
    </div>-->
    <div class="btn_confirm">
        <input type="button" value="주문하기" id="btn_submit" class="btn_submit" accesskey="s" onclick="buy(this.form)">
        <a href="<?php echo G5_URL ?>" class="btn_cancel">취소</a>
    </div>
    </form>


</div>

<script>

    let item_cost = "<?=$row['wr_10']?>";
    let ship_cost = "<?=$row['wr_9']?>";
    let add_cost = "<?=$row['wr_8']?>";
    let item_count = 1;
    let bo_table = "<?=$bo_table?>";
    let wr_id = "<?=$wr_id?>";

    function set_item_count(type) {
        if(type == "+"){
            item_count++;
        } else if(type == "-"){
            item_count--;
            if(item_count <= 0){
                item_count = 1;
            }
        }

        let sum_cost = (Number(item_cost)*Number(item_count)) + Number(ship_cost) + Number(add_cost);

        $("#item_cost").val(sum_cost);
        $("#sum_cost").html((sum_cost).toLocaleString());

        $("#item_count").val(item_count);
    }

    function buy(f) {

        if(f.mb_name.value == "" || f.mb_name.value.length == 0){
            alert("이름을 입력해주세요.");
            return false;
        }
        
        if(f.mb_hp.value == "" || f.mb_hp.value.length == 0){
            alert("전화번호를 입력해주세요.");
            return false;
        }

        if(f.mb_zip.value == "" || f.mb_zip.value.length == 0){
            alert("주소를 입력해주세요.");
            return false;
        }
        
        f.BuyerName.value = f.mb_name.value; //이름
        //f.BuyerEmail.value = f.reg_mb_email.value; //이메일
        f.BuyerTel.value = f.mb_hp.value; //연락처
        f.BuyerPostNo.value = f.mb_zip.value;
        f.BuyerAddr.value = f.mb_addr1.value;
        f.BuyerAuthNum.value = f.mb_addr2.value;
        f.GoodsName.value = f.good_name.value; //상품명

        $.post("<?=G5_URL?>/ajax/chk_buy.php",{"bo_table":bo_table,"wr_id":wr_id,"item_count":item_count, "data": $(f).serialize()},function (data) {
            if(data.code == "200"){
                f.Amt.value = data.cost; // 가격
                f.Moid.value = data.buy_no; // 구매번호
                goPay(f);
            }
        },"json");
    }

</script>