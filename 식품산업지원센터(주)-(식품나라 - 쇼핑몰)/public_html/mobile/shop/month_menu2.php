<?php
header("Progma:no-cache");
header("Cache-Control: no-store, no-cache ,must-revalidate");
include_once('./_common.php');


$g5['title'] = "도시락주문";
if(!$month){
	$month=date("Y-m");
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
</script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.list.js"></script>
<div id="mm">
<div id="sct">
	<form name="form" method="post" action="./month_menu_update.php" onsubmit="return formCheck(this)">
	<input type="hidden" name="order_no" value="<?php echo $orderNo?>">
	<input type="hidden" name="m_price" value="<?php echo $price?>">
	<div class="table table-bordered">
		<div class="month">
			<div>
				<a href="?month=<?php echo date("Y-m",strtotime($month."-01"." -1 month"))?>&a_idx=<?php echo $a_idx?>"><i class="far fa-chevron-left"></i> 이전달</a>
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
            <label for="idx<?php echo $i?>">
            <div class="date">
            <p>
                <input type="checkbox" name="idx[<?php echo $i?>]" id="idx<?php echo $i?>" onclick="menuCheck(<?php echo $i?>)" value="<?php echo $row[idx]?>">

                <input type="hidden" name="m_idx[]" value="<?php echo $i?>">
            </p>
			<p>
                <?php echo substr($row[m_date],-2)?>일 (<?php echo $weekNames[$weekName]?>)
			</p>
            </div>
            <div class="menu">
                <dl><dt>국</dt><dd><?php echo $row[soup]?></dd></dl>
                <dl><dt>주요리</dt><dd><?php echo $row[main]?></dd></dl>
                <dl><dt>가열사이드</dt><dd><?php echo $row[heat]?></dd></dl>
                <dl><dt>절임식품</dt><dd><?php echo $row[pickled]?></dd></dl>
                <dl><dt>비가열 사이드</dt><dd><?php echo $row[unheated]?></dd></dl>
            </div>
            <div class="price">
                <dl>
                    <dt>수량</dt>
                    <dd><input type="text" name="menu_count[<?php echo $i?>]" value="1" disabled class="frm_input" id="count<?php echo $i?>" oninput="countChange('<?php echo $i?>')"></dd>
                </dl>
                <dl>
                    <dt>가격</dt>
                    <dd id="price<?php echo $i?>">0원</dd>
                </dl>
            </div>
            </label>
		</li>
		<?php }}
			if($i==0){
		?>
		<li>
			<p class="empty_table">데이터가 없습니다.</p>
		</li>
		<?php }?>
		<li class="total">
			<p>총수량</p>
			<p id="total-count">0개</p>
			<p>총금액</p>
			<p id="total-price">0원</p>
		</li>
		</ul>
	</div>

	<div id="sod_frm">

	<section id="sod_frm_orderer" >
	<div class="odf_tbl">
		<dl>
			<dt><label for="mb_name">이름<strong class="sound_only"> 필수</strong></label></dt>
			<dd><input type="text" name="mb_name" value="<?php echo get_text($member['mb_name']); ?>" id="od_name" required class="frm_input required" maxlength="20" required></dd>
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
	</div>
	</section>
	</div>
    <div id="bt_btn">
        <button type="submit" class="btn">주문하기</button>
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
			$(`#count${no}`).focus();
		}else{
			totalCount-=parseInt($(`#count${no}`).val());
			$(`#count${no}`).attr("disabled",true);
		}
		 
		$(`#price${no}`).html(money+"원")
		totalPrice=totalCount*price;
		$("#total-count").html(totalCount+"개");
		$("#total-price").html(totalPrice+"원");
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
		$(`#price${no}`).html(money+"원");
		totalPrice = 0 < totalCount*price?totalCount*price:0;
		$("#total-count").html(totalCount+"개");
		$("#total-price").html(totalPrice+"원");
	}

	function formCheck(t){
		if($("#total-price").html()=="0원"){
			alert("먼저 메뉴를 선택하십시오");
			return false;
		}
	}

</script>
<?php
include_once(G5_MSHOP_PATH.'/_tail.php');

echo "\n<!-- {$ca['ca_mobile_skin']} -->\n";
?>
