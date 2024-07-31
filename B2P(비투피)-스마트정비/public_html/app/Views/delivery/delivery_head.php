<div class="tit_wrap">
    <h6 class="menu01">배송정보 관리</h6>
    <div class="menu02">
        <a href="<?=base_url('delivery/addressList')?>" <?php if($pid == "address_book_list" || $pid == "address_book_form") { echo "class='active'"; } ?>>주소록 관리</a>
        <a href="<?=base_url('delivery/placesList')?>" <?php if($pid == "address_delivery_list" || $pid == "address_delivery_form") { echo "class='active'"; } ?>>출고지 관리</a>
        <a href="<?=base_url('delivery/bundlePolicy')?>" <?php if($pid == "delivery_charge_list" || $pid == "delivery_charge_form") { echo "class='active'"; } ?>>배송비 관리</a>
        <a href="<?=base_url('delivery/dispatchPolicy')?>" <?php if($pid == "shipping_policy_list" || $pid == "shipping_policy_form") { echo "class='active'"; } ?>>발송정책 관리</a>
        <a href="<?=base_url('delivery/deliveryCode')?>" <?php if($pid == "delivery_code_list") { echo "class='active'"; } ?>>택배사코드 관리</a>
    </div>
</div>