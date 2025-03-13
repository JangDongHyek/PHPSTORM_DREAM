<!-- 내역관리 > 단가목록표 -->
</div>

<section class="price-list">
    <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#unit-list" aria-controls="unit-list" role="tab" data-toggle="tab" aria-expanded="true">일위대가 <strong class="txt-red">3</strong></a>
            </li>
            <li role="presentation" class="">
                <a href="#vehicle-list" aria-controls="vehicle-list" role="tab" data-toggle="tab" aria-expanded="false">중기단가 <strong class="txt-red">1</strong></a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="unit-list">
                <?php include_once APPPATH."Views/app/price/unit_list.php";  ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="vehicle-list">
                <?php include_once APPPATH."Views/app/price/vehicle_list.php";  ?>
            </div>
        </div>
    </div>
</section>


