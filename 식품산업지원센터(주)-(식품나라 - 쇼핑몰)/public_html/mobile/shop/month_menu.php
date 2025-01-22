<?php
header("Progma:no-cache");
header("Cache-Control: no-store, no-cache ,must-revalidate");
include_once('./_common.php');


$g5['title'] = "도시락주문";
$setMonth=strtotime($month."-01");
if($setMonth <= strtotime(date("Y-m-01"))) {
	alert(str_replace("-","년",$month)."월에는 도시락 메뉴를 주문하실 수 없습니다.");
}
if(!$month){
	$month=date("Y-m",strtotime(date("Y-m")." +1 month"));
}
/*
if($member[mb_id]==""){
	alert("회원 로그인 후 도시락 주문을 하실 수 있습니다.",G5_BBS_URL."/login.php");
}*/
$sql="select * from month_menu_price";
$row=sql_fetch($sql);
$price=$row[price];

$weekNames = array("1"=>"월","2"=>"화","3"=>"수","4"=>"목","5"=>"금");
include_once(G5_MSHOP_PATH.'/_head.php');
if($a_idx==""){
	$sql="select * from apartment where is_view='Y' order by idx asc";
	$row=sql_fetch($sql);
	$a_idx=$row[idx];
	$apartment_name = $row[apartment_name];
}else{
	$sql="select * from apartment where is_view='Y' and idx='$a_idx' order by idx asc";
	$row=sql_fetch($sql);
	$a_idx=$row[idx];
	$apartment_name = $row[apartment_name];
}
$orderNo=date("YmdHis_").rand(1000,9999);

$sql="select * from month_menu where left(m_date,7)='$month' and a_idx='$a_idx'";
$result=sql_query($sql);
?>

<script>
window.onload=function(){
	let checkbox = $("input[type='checkbox']");
	for(let i = 0;i < checkbox.length;i++){
		checkbox.eq(i).prop("checked",false);
	}

}
var g5_shop_url = "<?php echo G5_SHOP_URL; ?>";
function 
</script>
<script type="text/javascript" src="<?=G5_SHOP_URL?>/js/Innopay.js"></script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.list.js"></script>
<div id="mm">
<div id="sct">
	<form name="form" method="post" action="./month_menu_update.php">
	<input type="hidden" name="order_no" value="<?php echo $orderNo?>">
	<input type="hidden" name="m_price" value="<?php echo $price?>">
	<div class="table table-bordered">
		<div class="month">
			<div>
				<?php
					$prevMonth=strtotime(date($month."-01"));
					$currentMonth=strtotime(date("Y-m-01")." +1 month");
					if($currentMonth < $prevMonth){
				?>
				<a href="?month=<?php echo date("Y-m",strtotime($month."-01"." -1 month"))?>&a_idx=<?php echo $a_idx?>"><i class="far fa-chevron-left"></i> 이전달</a>
				<?php }?>
                <p><?php echo str_replace("-","년",$month)."월";?></p>
				<a href="?month=<?php echo date("Y-m",strtotime($month."-01"." +1 month"))?>&a_idx=<?php echo $a_idx?>">다음달 <i class="far fa-chevron-right"></i></a>
			</div>
		</div>
		<ul>
		<?php
			for($i=0;$row=sql_fetch_array($result);$i++){
				$weekName = date("w",strtotime($row[m_date]));
				if($row[main]){
		?>
        <li>
            <input type="hidden" name="m_idx[]" value="<?php echo $i?>">
            <input type="checkbox" name="idx[<?php echo $i?>]" id="idx<?php echo $i?>" onclick="menuCheck(<?php echo $i?>)" value="<?php echo $row[idx]?>">
            <label for="idx<?php echo $i?>">
                <div class="ico"></div>
                <div class="box">
                    <div class="date">
                        <?php echo substr($row[m_date],-2)?>일 (<?php echo $weekNames[$weekName]?>)
                    </div>
                    <div class="menu">
                        <dl><dt>국</dt><dd><?php echo $row[soup]?></dd></dl>
                        <dl><dt>주요리</dt><dd><?php echo $row[main]?></dd></dl>
                        <dl><dt>부요리1</dt><dd><?php echo $row[heat]?></dd></dl>
                        <dl><dt>부요리2</dt><dd><?php echo $row[pickled]?></dd></dl>
                        <dl><dt>비가열 사이드</dt><dd><?php echo $row[unheated]?></dd></dl>
						<dl><dt>공급처</dt><dd><?php echo $row[supplier]?></dd></dl>
                    </div>
                    <div class="price">
                        <dl>
                            <dt>수량</dt>
                            <dd>
								<button class="btn btn-primary count-btn<?php echo $i?>" onclick="countBtnChange(-1,'<?php echo $i?>')" type="button" disabled>-</button>
								<input type="text" name="menu_count[<?php echo $i?>]" value="1" disabled class="frm_input" id="count<?php echo $i?>" oninput="countChange('<?php echo $i?>')" size="3">
								<button class="btn btn-primary count-btn<?php echo $i?>" onclick="countBtnChange(1,'<?php echo $i?>')" type="button" disabled>+</button>
							</dd>
                        </dl>
                        <dl>
                            <dt>가격</dt>
                            <dd id="price<?php echo $i?>"><strong>0</strong>원</dd>
                        </dl>
                    </div>
                </div>
            </label>
        </li>
		<?php }}
			if($i==0){
		?>
		<li>
            <div class="box">
			<p class="empty_table">데이터가 없습니다.</p>
            </div>
		</li>
		<?php }?>
		<li class="total">
            <div class="box">
                <dl>
                    <dt>총수량</dt>
                    <dd id="total-count"><strong>0</strong>개</dd>
                </dl>
                <dl>
                    <dt>총금액</dt>
                    <dd id="total-price"><strong>0</strong>원</dd>
                </dl>
            </div>
		</li>
		</ul>
	</div>

	<div id="sod_frm">

	<section id="sod_frm_orderer" >
	<div class="odf_tbl">
		<dl>
			<dt><label for="mb_name">이름<strong class="sound_only"> 필수</strong></label></dt>
			<dd><input type="text" name="mb_name" value="<?php echo get_text($member['mb_name']); ?>" id="mb_name" required class="frm_input required" maxlength="20" required></dd>
		</dl>

		<dl>
			<dt><label for="mb_tel">전화번호<strong class="sound_only"> 필수</strong></label></dt>
			<dd><input type="text" name="mb_tel" value="<?php echo get_text($member['mb_tel']); ?>" id="mb_tel" required class="frm_input required" maxlength="20" required></dd>
		</dl>
		<dl>
			<dt><label for="mb_hp">핸드폰</label></dt>
			<dd><input type="text" name="mb_hp" value="<?php echo get_text($member['mb_hp']); ?>" id="mb_hp" class="frm_input" maxlength="20" required></dd>
		</dl>
		<dl>
			<dt>아파트단지</dt>
			<dd>
				<p><?php echo $apartment_name?></p>
				<input type="text" name="addr" value="" id="addr" class="frm_input" maxlength="20" placeholder="동/호수를 입력하세요" required>
			</dd>
		</dl>
		<dl>
			<dt>결제수단</dt>
			<dd>
				<div>
				<input type="radio" name="PayMethod" value="CARD" id="pay_method1"> <label for="pay_method1">신용카드</label>
				<input type="radio" name="PayMethod" value="BANK" id="pay_method2"> <label for="pay_method2">계좌이체</label>
				</div>
				
				<input type="hidden" id="GoodsCnt" name="GoodsCnt" value="1" placeholder="">
				<input type="hidden" name="GoodsName" value="<?php echo $order_no?>도시락주문" placeholder="">
				<input type="hidden" id="Amt" name="Amt" value="1000" placeholder="" onKeyUp="javascript:numOnly(this,document.frm,false);">
				<input type="hidden" name="Moid" value="<?php echo $order_no?>" placeholder="">
				<input type="hidden" name="MID" value="pgfisc001m" placeholder="">
				<input type="hidden" name="ReturnURL" value="<?=G5_SHOP_URL?>/innopay.return2.php" placeholder="">
				<input type="hidden" name="ResultYN" value="N" >
				<input type="hidden" name="mallUserID" value="<?php echo $member[mb_id]?>" maxlength="30" placeholder="">
				<input type="hidden" name="BuyerName" value="<?php echo $member[mb_name]?>" placeholder="">
				<input type="hidden" name="BuyerTel" value="<?php echo $member[mb_tel]?>" placeholder="">
				<input type="hidden" name="BuyerEmail" value="<?php echo $member[mb_email]?>" placeholder="">
				<input type="hidden" name="EncodingType" value="utf-8" placeholder="">
				<input type="hidden" name="FORWARD" id="FORWARD" value="Y" placeholder="">
				<!--hidden 데이타 필수-->
				<input type="hidden" name="ediDate" value=""> <!-- 결제요청일시 제공된 js 내 setEdiDate 함수를 사용하거나 가맹점에서 설정 yyyyMMddHHmmss-->
				<input type="hidden" name="MerchantKey" value="HlyBKwT/v/NvQQU1LS41LhIMzP/w1LOA1OOvIqBTZfsMCvPt18kuWZ1mdo6Xkg7BC2XzKGfOWLCLLFXAJhDkTA=="> <!-- 발급된 가맹점키 -->
				<input type="hidden" name="EncryptData" value=""> <!-- 암호화데이터 -->
				<input type="hidden" name="MallIP" value="127.0.0.1"/> <!-- 가맹점서버 IP 가맹점에서 설정-->
				<input type="hidden" name="UserIP" value="127.0.0.1"> <!-- 구매자 IP 가맹점에서 설정-->
				<!-- <input type="hidden" name="FORWARD" value="Y"> Y:팝업연동 N:페이지전환 -->
				<input type="hidden" name="MallResultFWD"   value="N"> <!-- Y 인 경우 PG결제결과창을 보이지 않음 -->
				<input type="hidden" name="device" value=""> <!-- 자동셋팅 -->
				<!--hidden 데이타 옵션-->
				<input type="hidden" name="BrowserType" value="">
				<input type="hidden" name="MallReserved" value="">
				<!-- 현재는 사용안함 -->
				<input type="hidden" name="SUB_ID" value=""> <!-- 서브몰 ID -->
				<input type="hidden" name="BuyerPostNo" value="" > <!-- 배송지 우편번호 -->
				<input type="hidden" name="BuyerAddr" value=""> <!-- 배송지주소 -->
				<input type="hidden" name="BuyerAuthNum">
				<input type="hidden" name="ParentEmail">
				<input type="hidden" name="t_no"/>
				<input type="hidden" name="app_time"/>
				<input type="hidden" name="card_name"/>
				<input type="hidden" name="bank_name"/>
				<input type="hidden" name="app_no"/>
			</dd>
		</dl>
	</div>
	</section>
	</div>
    <div id="bt_btn">
        <button type="button" class="btn" onclick="formCheck(this.form)">주문하기</button>
    </div>
	</form>

</div>
</div>
<script type="text/javascript">
	let totalCount=0;
	let totalPrice=0;
	const price = <?php echo $price?>;
	function menuCheck(no){
		let money=0;
		if($(`#idx${no}`).prop("checked")){
			totalCount+=parseInt($(`#count${no}`).val());
			money = parseInt($(`#count${no}`).val())*price;
			$(`#count${no}`).attr("disabled",false);
			$(`.count-btn${no}`).attr('disabled',false);
			$(`#count${no}`).focus();
		}else{
			totalCount-=parseInt($(`#count${no}`).val());
			$(`#count${no}`).attr("disabled",true);
			$(`.count-btn${no}`).attr('disabled',true);
		}
		 
		$(`#price${no}`).html("<strong>"+number_format(money)+"</strong>"+"원")
		totalPrice=totalCount*price;
		$("#total-count").html("<strong>"+number_format(totalCount)+"</strong>"+"개");
		$("#total-price").html("<strong>"+number_format(totalPrice)+"</strong>"+"원");
		$("#GoodsCnt").val(totalCount);
		$("#Amt").val(totalPrice);
	}
	function countBtnChange(cnt,no){
		const val = Number($(`#count${no}`).val())+cnt;
		if(val <= 0){
			alert('수량은 0 이하로 내릴 수 없습니다.');
			return;
		}
		$(`#count${no}`).val(val);
		countChange(no);
	}
	function countChange(no){
		let money=0;
		totalCount=0;
		for(let i=0;i < $("input[type='checkbox']").length;i++){
			if($(`#idx${i}`).prop("checked")){
				totalCount+=parseInt($(`#count${i}`).val());
			}
		}
		console.log(totalCount);
		money=0 < parseInt($(`#count${no}`).val())*price?parseInt($(`#count${no}`).val())*price:0;
		$(`#price${no}`).html("<strong>"+number_format(money)+"</strong>"+"원");
		totalPrice = 0 < totalCount*price?totalCount*price:0;
		$("#total-count").html("<strong>"+number_format(totalCount)+"</strong>"+"개");
		$("#total-price").html("<strong>"+number_format(totalPrice)+"</strong>"+"원");
		$("#GoodsCnt").val(totalCount);
		$("#Amt").val(totalPrice);
	}

	function formCheck(f){
		if($("#total-price").html()=="0원"){
			alert("먼저 메뉴를 선택하십시오");
			return false;
		}
		let pay_method1=document.getElementById("pay_method1");
		let pay_method2=document.getElementById("pay_method2");
		
		
		if(pay_method1.checked){
			f.BuyerName.value=$("#mb_name").val();
			f.BuyerTel.value=$("#mb_tel").val();
			return goPay(f);
		}else if(pay_method2.checked){
			return goPay(f);
		}else{
			f.action="./month_menu_update.php";
			f.submit();
		}
	}
	 $(document).ready(function(){
    	$("#PayMethod").change(function(){
            if("VBANK"==$("#payMethod").val()){
            	$("#VbankExpDate").removeAttr("disabled");
            	$("#VbankExpDate").val(ediDate.substring(0, 8));
            }else{
            	$("#VbankExpDate").attr("disabled",true);
            }
        });
				var isMobile=checkMobileDevice();

				if(isMobile){
					$("#FORWARD").val("N");
				}else{
					$("#FORWARD").val("Y");
				}
    });
	function checkMobileDevice() {
        var mobileKeyWords = new Array('Android', 'iPhone', 'iPod', 'BlackBerry', 'Windows CE', 'SAMSUNG', 'LG', 'MOT', 'SonyEricsson');
        for (var info in mobileKeyWords) {
            if (navigator.userAgent.match(mobileKeyWords[info]) != null) {
                return true;
            }
        }
        return false;
    }

</script>
<?php
include_once(G5_MSHOP_PATH.'/_tail.php');

echo "\n<!-- {$ca['ca_mobile_skin']} -->\n";
?>
