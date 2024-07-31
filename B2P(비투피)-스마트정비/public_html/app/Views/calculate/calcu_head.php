<div class="tit_wrap">
    <h6 class="menu01">정산 관리</h6>
    <div class="menu02">
        <a href="<?=base_url('calculate/')?>" <?php if($pid == "calculate_view" || $pid == "") { echo "class='active'"; } ?>>정산 관리</a>
        <a href="<?=base_url('calculate/auction')?>" <?php if($pid == "auction_list" || $pid == "") { echo "class='active'"; } ?>>옥션 판매 진행내역</a>
        <a href="<?=base_url('calculate/gmarket')?>" <?php if($pid == "gmarket_list" || $pid == "") { echo "class='active'"; } ?>>G마켓 판매 진행내역</a>
    </div>
</div>