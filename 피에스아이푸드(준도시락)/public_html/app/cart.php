<?php
$pid = "cart";
include_once("./app_head.php");
?>
<div id="container">
<div id="cart">
    <div class="cart_list">
        <dl>
            <dt>(일반) 불맛두루치기도시락 8,800원<a class="del_btn"><i class="fal fa-times"></i></a></dt>
            <dd class="warm chk">(+) 발열도시락 추가<strong>10,000원</strong><a class="del_btn"><i class="fal fa-times"></i></a></dd>
            <dd class="num frm_input"><button type="button"><i class="fal fa-minus"></i></button><input type="text" placeholder="10" /><button type="button"><i class="fal fa-plus"></i></button></dd>
            <dd class="pay">88,000원</dd>
        </dl>
        <dl>
            <dt>(일반) 불맛두루치기도시락 8,800원<a class="del_btn"><i class="fal fa-times"></i></a></dt>
            <dd class="num frm_input"><button type="button"><i class="fal fa-minus"></i></button><input type="text" placeholder="10" /><button type="button"><i class="fal fa-plus"></i></button></dd>
            <dd class="pay">88,000원</dd>
        </dl>
    </div>
    <div class="total">
        <p>상품금액<strong>319,000원</strong></p> 
        <p>(+) 배송비<strong>10,000원</strong></p>
        <p>총 주문금액<strong>329,000원</strong></p>
    </div>
    <div class="ft_btn">
    	<a href="<?php echo G5_URL ?>/app/order_event.php" class="b03">주문하기</a>
    </div>
</div>
</div>

<?php
include_once ("./app_tail.php");
?>