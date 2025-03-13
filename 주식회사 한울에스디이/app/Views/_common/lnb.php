<div class="lnb">
    <?php if($pid == "record" || $pid == "invoice" || $pid == "price_list" || $pid == "price_all") { ?>
    <ul>
        <li><a <?php if($pid == "price_list") echo 'class="active"'; ?> href="./priceList">기초단가</a></li>
        <li><a <?php if($pid == "record") echo 'class="active"'; ?> href="./record">수량단가</a></li>
        <li><a <?php if($pid == "invoice") echo 'class="active"'; ?> href="./invoice">구역별내역서</a></li>
        <!--li><a <?php if($pid == "price_all") echo 'class="active"'; ?> href="./priceAll">단가설정</a></li-->
    </ul>
    <?php } ?>
    <?php if($pid == "schedule" || $pid == "schedule_weekly" || $pid == "week_task") { ?>
        <ul>
            <li><a <?php if($pid == "schedule") echo 'class="active"'; ?> href="./schedule">계획공정표</a></li>
            <li><a <?php if($pid == "week_task") echo 'class="active"'; ?> href="./weekTask">금주작업</a></li>
            <li><a <?php if($pid == "schedule_weekly") echo 'class="active"'; ?> href="./scheduleWeekly">작업공정표</a></li>
        </ul>
    <?php } ?>
</div>
