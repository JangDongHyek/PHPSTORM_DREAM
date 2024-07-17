<?
include_once('./_common.php');

$g5['title'] = '주문서';
include_once('./_head.php');

$idx = $_POST['i_idx'];

$sql = "select count(*) cnt from new_item where i_idx = '{$idx}' ";
$cnt = sql_fetch($sql)['cnt'];

if ($cnt == 0){
    alert("올바른 방식으로 접근해주세요.",G5_URL);
}

$sql = "select * from new_item where i_idx = '{$idx}' ";
$view = sql_fetch($sql);

//이미지
$sql = "select * from g5_board_file where wr_id = '{$idx}' and bo_table = 'main_img' order by bf_idx desc limit 1 ";
$img = sql_fetch($sql)['bf_file'];

$Moid = date('YmdHis',strtotime(G5_TIME_YMDHIS)) .'-'.$_REQUEST['i_idx'];


?>
<style>
	#ft_menu{display:none;}
</style>

<div id="item_view" class="order">
	<div class="inr">
		<h3 class="ptitle">결제하기</h3>
		<div class="item_left">          
			<div class="pd_info">
				<a href="javascript:void(0)" style="cursor:default ">
					<div class="img_pd"><img src="<?php echo G5_DATA_URL ?>/file/main_img/<?=$img?>"></div><!--서비스 썸네일 추출-->
					<div class="info">
						
						<div class="tit"><?=$view['i_title']?></div>
						<div id="seller_info">
							<div class="photo"><img class="p_img" src='<?php echo G5_THEME_IMG_URL ?>/app/img_company01.jpg'></div>
							<div class="name"><p>스튜디오오늘</p></div>
						</div>
					</div>
				</a>
				
				<div class="sale_info">
					<ul class="list_top">
						<li class="pinfo">상품정보</li>
						<li class="amount">수량</li>
						<li class="price">금액</li>
					</ul>
					<ul class="list_sale">
						<li class="pinfo">
							<h3><?=$view['i_price_title']?></h3>
							<span>작업일 <i class="point"><?=$view['i_work_date']?>일</i></span>
						</li>
						<li class="amount">
							<button onclick="minus_count()"><span>-</span></button>
							<span class="count" name="GoodsCnt" id="GoodsCnt" >1</span>
							<button onclick="plus_count()"><span>+</span></button>
						</li>
						<li class="price"><span><?=number_format($view["i_price"])?>원</span></li>
					</ul>
				</div>
			</div>
		 
                  
			<!--결제방법-->
			<div class="howorder">
				 <h3 class="ptitle">결제방법</h3>

				 <ul id="area_type">
					<!-- 선택했을때 li active 클래스 추가 -->
					<li name ="login_li" class="active">
						<div class="box_radio">
						<label for="type01">
							<input type="radio" id="type01" value="2" name="join_type" checked>
							<span class="radio_body"></span>
							<em>카드결제</em>
							<i class="select"></i>
						</label>
						</div>
					</li>
					<li name = "login_li">
						<div class="box_radio">
						<label for="type02">
							<input type="radio" id="type02" value="3" name="join_type" >
							<span class="radio_body"></span>
							<em>계좌이체</em>
							<i class="select"></i>
						</label>
						</div>
					</li>
					<li name = "login_li">
						<div class="box_radio">
                        <label for="type03">
							<input type="radio" id="type03" value="3" name="join_type" >
							<span class="radio_body"></span>
							<em>간편결제</em>
							<i class="select"></i>
						</label>
						</div>
					</li>
				</ul>
			</div>
			<!--결제방법-->
        </div>

		
		<div class="item_right">
			<div class="all_price">
				<span>총 결제금액</span>
				<h4 name = "total_amt_div"><?=number_format($view["i_price"])?> 원</h4>
			</div>
			
			<div id="area_btn">
				<div class="checks small">
				  <input type="checkbox" id="check_order" value="Y">
				  <label for="check_order">주문 내용을 확인하였으며, 결제에 동의합니다. [필수]</label> 
				</div>
				<div class="box_btn full"><a href="javascript:pay_submit()">결제하기</a></div>
			</div>
		</div>
	</div>
</div>

<script>
    $(document).ready(function () {
        total_amt();
    })

    function plus_count(){
        $('#GoodsCnt').text(($('#GoodsCnt').text()*1) + 1);
        total_amt();
    }

    function minus_count(){
        var cnt_val = $('#GoodsCnt').text()*1;
        //1이하로 -처리 안되게끔
        if (cnt_val > 1) {
            $('#GoodsCnt').text(cnt_val - 1);
        }
        total_amt();
    }

    function total_amt(){
        var cnt_val = $('#GoodsCnt').text(),
            basic_amt = '<?=$view["i_price"]?>';

        var total_amt = cnt_val * basic_amt;
        $("#Amt").val(total_amt);

        $("[name = total_amt_div]").html(numberComma(total_amt)+" 원");
    }

    function numberComma(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }


    //이노페이 금액 보내기
    function pay_submit() {


        if($('input[id="check_order"]:checked').val() != 'Y'){
            swal('결제동의 부분을 체크 하지 않으면 결제가 불가능 합니다.');
            return false;
        }
        // console.log(document.payfrm);
        $('#Moid').val("<?=$Moid?>" + "=" + $('#GoodsCnt').text());

        //pc화면이면 팝업
        if (!mobilecheck()){
            $('#FORWARD').val('Y');
        }else{
            $('#FORWARD').val('N');
        }

        swal("결제하기 기능을 준비중입니다.");

        // goPay(document.payfrm);

    }
    $("[name=login_li]").on("click", function() {
        console.log(        $($(this).children().find('input')).attr('id'));
        $($(this).children().find('input')).attr('checked',true);

        $("[name=login_li]").removeClass("active");
        $(this).addClass("active");


    });



</script>
<?php
include_once('./_tail.php');
?>