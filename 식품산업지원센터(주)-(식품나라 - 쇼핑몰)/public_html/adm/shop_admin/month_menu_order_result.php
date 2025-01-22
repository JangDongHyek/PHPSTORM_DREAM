<?php
$sub_menu = '400430';
include_once('./_common.php');
$sql="select m_price from lunch_order where order_no='$order_no'";
$row=sql_fetch($sql);
$m_price=$row[m_price];
$weekNames = array("1"=>"월","2"=>"화","3"=>"수","4"=>"목","5"=>"금");


$g5['title'] = "주문 내역 수정";
include_once(G5_ADMIN_PATH.'/admin.head.php');


// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

<section id="anc_sodr_list">
	<div class="tbl_head01 tbl_wrap">
    <h2 class="h2_frm">주문상품 목록</h2>
    <?php echo $pg_anchor; ?>
    <form name="form" method="post" action="./month_menu_update.php" onsubmit="return formCheck(this)">
	<input type="hidden" name="order_no" value="<?php echo $orderNo?>">
	<table class="table table-bordered">
		<thead>
		<tr>
			<th scope="col">일자</th>
			<th scope="col">요일</th>
			<th scope="col">국</a></th>
			<th scope="col">주요리</th>
			<th scope="col">가열사이드</th>
			<th scope="col">절임식품</th>
			<th scope="col">비가열 사이드</th>
			<th scope="col">수량</th>
			<th scope="col">가격</th>
		</tr>
		</thead>
		<tbody>
		<?php
			$sql="select * from lunch_order_menu where order_no='$order_no'";
			$result=sql_query($sql);
			$totalCount=0;
			for($i=0;$row=sql_fetch_array($result);$i++){
				$sql="select * from month_menu where idx='$row[m_idx]'";
				$row2=sql_fetch($sql);
				$weekName = date("w",strtotime($row2[m_date]));
				if($row2[main]){
					$totalCount+=$row[m_count];
		?>
		
		<tr>
			<td scope="col">
				<?php echo substr($row2[m_date],-5)?>
			</td>
			<td scope="col"><?php echo $weekNames[$weekName]?></td>
			<td scope="col"><?php echo $row2[soup]?></td>
			<td scope="col"><?php echo $row2[main]?></td>
			<td scope="col"><?php echo $row2[heat]?></td>
			<td scope="col"><?php echo $row2[pickled]?></td>
			<td scope="col"><?php echo $row2[unheated]?></td>
			<td>
				<?php echo $row[m_count]?>
			</td>
			<td id="price<?php echo $i?>">
				<?php echo number_format($row[m_count]*$m_price);?>원
			</td>
		</tr>
		<?php }}
			if($i==0){
		?>
		<tr>
			<td colspan="9">데이터가 없습니다.</td>
		</tr>
		<?php }
		$sql="select * from lunch_order where order_no='$order_no'";
		$row=sql_fetch($sql);
		$sql="select * from apartment where idx='$row[a_idx]' order by idx asc";
		$arow=sql_fetch($sql);
		
		?>
		<tr>
			<td colspan="6" align="right">총수량</td>
			<td align="right" id="total-count"><?php echo $totalCount?>개</td>
			<td align="right">총금액</td>
			<td align="right" id="total-price"><?php echo number_format($totalCount*$m_price)?>원</td>
		</tr>
		</tbody>
	</table>
	<div id="sod_frm">

	<section id="sod_frm_orderer" >
	<h2 class="h2_frm">주문자 정보</h2>
	<div class="odf_tbl">
	<table>
		<tbody>
		<tr>
			<th scope="row"><label for="mb_name">이름<strong class="sound_only"> 필수</strong></label></th>
			<td><?php echo $row[mb_name]?></td>
		</tr>

		<tr>
			<th scope="row"><label for="mb_tel">전화번호<strong class="sound_only"> 필수</strong></label></th>
			<td><?php echo $row[mb_tel]?></td>
		</tr>
		<tr>
			<th scope="row"><label for="mb_hp">핸드폰</label></th>
			<td><?php echo $row[mb_hp]?></td>
		</tr>
		<tr>
			<th scope="row">아파트단지</th>
			<td>
				<?php echo $arow[apartment_name]?><br/>
				<?php echo $row[addr]?>
			</td>
		</tr>
		
		</tbody>
	</table>
	
	</div>
	</section>
	<?php
		if($row[pay_method]!="무통장"){
	?>
	<section id="sod_frm_orderer" >
	<h2 class="h2_frm">결제 정보</h2>
	<div class="odf_tbl">
	<table>
		<tbody>
		<tr>
			<th scope="row"><label for="mb_name">결제수단<strong class="sound_only"> 필수</strong></label></th>
			<td><?php echo $row[pay_method]=="CARD"?"신용카드":"계좌이체";?></td>
		</tr>
		<tr>
			<th scope="row"><label for="mb_tel">결제일<strong class="sound_only"> 필수</strong></label></th>
			<td><?php echo $row[app_time]?></td>
		</tr>
		<tr>
			<th scope="row"><label for="mb_hp"><?php echo $row[pay_method]=="CARD"?"카드명":"은행명";?></label></th>
			<td><?php echo $row[pay_method]=="CARD"?$row[card_name]:$row[bank_name]?></td>
		</tr>
		<tr>
			<th scope="row"><label for="mb_tel">승인번호<strong class="sound_only"> 필수</strong></label></th>
			<td><?php echo $row[app_no]?></td>
		</tr>
		
		
		</tbody>
	</table>

	</div>
	</section>
	<?php }?>
	<a href="./month_menu_order_list.php">목록보기</a>
	</div>
	</form>
	</div>
</section>



<script>
$(function() {
    // 전체 옵션선택
    $("#sit_select_all").click(function() {
        if($(this).is(":checked")) {
            $("input[name='it_sel[]']").attr("checked", true);
            $("input[name^=ct_chk]").attr("checked", true);
        } else {
            $("input[name='it_sel[]']").attr("checked", false);
            $("input[name^=ct_chk]").attr("checked", false);
        }
    });

    // 상품의 옵션선택
    $("input[name='it_sel[]']").click(function() {
        var cls = $(this).attr("id").replace("sit_", "sct_");
        var $chk = $("input[name^=ct_chk]."+cls);
        if($(this).is(":checked"))
            $chk.attr("checked", true);
        else
            $chk.attr("checked", false);
    });

    // 개인결제추가
    $("#personalpay_add").on("click", function() {
        var href = this.href;
        window.open(href, "personalpaywin", "left=100, top=100, width=700, height=560, scrollbars=yes");
        return false;
    });

    // 부분취소창
    $("#orderpartcancel").on("click", function() {
        var href = this.href;
        window.open(href, "partcancelwin", "left=100, top=100, width=600, height=350, scrollbars=yes");
        return false;
    });
});

function form_submit(f)
{
    var check = false;
    var status = document.pressed;

    for (i=0; i<f.chk_cnt.value; i++) {
        if (document.getElementById('ct_chk_'+i).checked == true)
            check = true;
    }

    if (check == false) {
        alert("처리할 자료를 하나 이상 선택해 주십시오.");
        return false;
    }

    var msg = "";

    <?php if($od['od_settle_case'] == '신용카드' || $od['od_settle_case'] == 'KAKAOPAY' || $od['od_settle_case'] == '간편결제' || ($od['od_pg'] == 'inicis' && is_inicis_order_pay($od['od_settle_case']) )) { ?>
    if(status == "취소" || status == "반품" || status == "품절") {
        var $ct_chk = $("input[name^=ct_chk]");
        var chk_cnt = $ct_chk.size();
        var chked_cnt = $ct_chk.filter(":checked").size();
        <?php if($od['od_pg'] == 'KAKAOPAY') { ?>
        var cancel_pg = "카카오페이";
        <?php } else { ?>
        var cancel_pg = "PG사의 <?php echo $od['od_settle_case']; ?>";
        <?php } ?>

        if(chk_cnt == chked_cnt) {
            if(confirm(cancel_pg+" 결제를 함께 취소하시겠습니까?\n\n한번 취소한 결제는 다시 복구할 수 없습니다.")) {
                f.pg_cancel.value = 1;
                msg = cancel_pg+" 결제 취소와 함께 ";
            } else {
                f.pg_cancel.value = 0;
                msg = "";
            }
        }
    }
    <?php } ?>

    if (confirm(msg+"\'" + status + "\' 상태를 선택하셨습니다.\n\n선택하신대로 처리하시겠습니까?")) {
        return true;
    } else {
        return false;
    }
}

function del_confirm()
{
    if(confirm("주문서를 삭제하시겠습니까?")) {
        return true;
    } else {
        return false;
    }
}

// 기본 배송회사로 설정
function chk_delivery_company()
{
    var chk = document.getElementById("od_delivery_chk");
    var company = document.getElementById("od_delivery_company");
    company.value = chk.checked ? chk.value : company.defaultValue;
}

// 현재 시간으로 배송일시 설정
function chk_invoice_time()
{
    var chk = document.getElementById("od_invoice_chk");
    var time = document.getElementById("od_invoice_time");
    time.value = chk.checked ? chk.value : time.defaultValue;
}

// 결제금액 수동 설정
function chk_receipt_price()
{
    var chk = document.getElementById("od_receipt_chk");
    var price = document.getElementById("od_receipt_price");
    price.value = chk.checked ? (parseInt(chk.value) + parseInt(price.defaultValue)) : price.defaultValue;
}
</script>

<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');
?>