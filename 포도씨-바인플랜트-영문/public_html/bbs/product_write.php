<?
include_once('./_common.php');

$g5['title'] = 'For Sale';
include_once('./_head.php');

loginCheck($member['mb_id'], $member['mb_category']);

// 매물 정보
$row = sql_fetch(" select * from g5_for_sale where idx = {$idx} ");

$msg = 'Register';
if($w == 'u') {
    if($row['mb_id'] != $member['mb_id']) { // 본인이 쓴 글이 아닌데 경로타고 들어올 경우 막음
        alert('Not the correct path.');
    }
    $msg = 'Edit';
}
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">
<?php include_once('./category_modal.php'); ?>

<style>
	#ft_menu{display:none;}
    .num{text-align: center;}
</style>
<!-- 카테고리 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade v2 long sch" id="cateModal02" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">Ship Type</h4>
                </div>
                <div class="modal-body">
					<!--<div class="box_sch">
						<form name="fsearchbox">
						  <input type="text" placeholder="검색하기" name="search">
						  <button type="submit"></button>
						</form>
					</div>-->
					<ul id="sort_list" class="cate_list modal_ship_type">
						<!-- 카테고리에서 General Cargo 선택했을 때 나오는 리스트 -->
                        <div class="filter_category_1 noshow">
                            <li>General Cargo Ship</li>
                            <li><span>Container</span></li>
                            <li><span>MPP</span></li>
                            <li><span>Ro-Ro Ship</span></li>
                            <li><span>Cement Carrier</span></li>
                            <li><span>Sand Carrier</span></li>
                            <li><span>Reefer Cargo Vessel</span></li>
                        </div>

						<!-- 카테고리에서 Bulk Carriers 선택했을 때 나오는 리스트 -->
                        <div class="filter_category_2 noshow">
                            <li>Bulk Carrier</li>
                            <li><span>VLBC/VLOC</span></li>
                        </div>
						
						<!-- 카테고리에서 Oil/Gas Carriers 선택했을 때 나오는 리스트 -->
                        <div class="filter_category_3 noshow">
                            <li>Product Tanker</li>
                            <li><span>Chemical Tanker</span></li>
                            <li><span>LPG Carrier</span></li>
                            <li><span>LNG Carrier</span></li>
                            <li><span>Bitumen Tanker</span></li>
                            <li><span>Waste Carrier</span></li>
                            <li><span>VLCC/ULCC</span></li>
                            <li><span>Non-Propelled Tanker Barge</span></li>
                        </div>

						<!-- 카테고리에서 Tugs/Barges 선택했을 때 나오는 리스트 -->
                        <div class="filter_category_4 noshow">
                            <li>Tug boat</li>
                            <li><span>Deck/Flat Barge</span></li>
                            <li><span>Hold Barge</span></li>
                            <li><span>Pusher + Barge</span></li>
                            <li><span>Self Propelled Barge</span></li>
                            <li><span>Accommodation Barge</span></li>
                        </div>

                        <!-- 카테고리에서 FD/FC/Work Vessels 선택했을 때 나오는 리스트 -->
                        <div class="filter_category_5 noshow">
                            <li>Floating Dock</li>
                            <li><span>Floating Crane</span></li>
                            <li><span>Dredger</span></li>
                            <li><span>Jackup Barge</span></li>
                            <li><span>Cable/Pipe Layer</span></li>
                            <li><span>Other Work Vessel</span></li>
                        </div>

                        <!-- 카테고리에서 Special/Offshore 선택했을 때 나오는 리스트 -->
                        <div class="filter_category_6 noshow">
                            <li>Plant/Offshore Carrier</li>
                            <li><span>Drilling Ship/Rig</span></li>
                            <li><span>FPSO/FSO</span></li>
                            <li><span>OSV/PSV/DSV</span></li>
                            <li><span>AHTS</span></li>
                            <li><span>Ice Breaker</span></li>
                            <li><span>Research Ship</span></li>
                            <li><span>Other Special Ship/Unit</span></li>
                        </div>

						<!-- 카테고리에서 Passenger Ships 선택했을 때 나오는 리스트 -->
                        <div class="filter_category_7 noshow">
                            <li>Ferry</li>
                            <li><span>Ro-Pax</span></li>
                            <li><span>Landing Craft</span></li>
                            <li><span>Cruise Ship</span></li>
                            <li><span>Floating Hotel</span></li>
                            <li><span>Other Passenger Ship</span></li>
                        </div>

						<!-- 카테고리에서 Fishing Vessels 선택했을 때 나오는 리스트 -->
                        <div class="filter_category_8 noshow">
                            <li>Trawler</li>
                            <li><span>Long Liner</span></li>
                            <li><span>Purse Seiner</span></li>
                            <li><span>Fish Carrier</span></li>
                            <li><span>Gill Netter</span></li>
                            <li><span>Catcher Boat</span></li>
                            <li><span>Factory Ship</span></li>
                            <li><span>Other Fishing Vessel</span></li>
                        </div>

						<!-- 카테고리에서 Yachat/Boat 선택했을 때 나오는 리스트 -->
                        <div class="filter_category_9 noshow">
                            <li>Yachat</li>
                            <li><span>Fishing Boat</span></li>
                            <li><span>Pleasure Boat</span></li>
                        </div>

					</ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 카테고리 모달팝업 -->

<!-- 카테고리 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade v2 long sch" id="cateModal_sale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">CATEGORY</h4>
                </div>
                <div class="modal-body">
					<!--<div class="box_sch">
						<form name="fsearchbox">
						  <input type="text" placeholder="검색하기" name="search">
						  <button type="submit"></button>
						</form>
					</div>-->
					<ul id="sort_list" class="cate_list modal_category"> <!-- Category-->
						<li>General Cargo</li>
						<li>Bulk Carriers</li>
						<li>Oil/Gas Carriers</li>
						<li>Tugs/Barges</li>
						<li>FD/FC/Work Vessels</li>
						<li>Special/Offshore</li>
						<li>Passenger Ships</li>
						<li>Fishing Vessels</li>
						<li>Yachat/Boat</li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 카테고리 모달팝업 -->

<!-- 카테고리 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade v2 long sch" id="cateModal_sale02" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">CATEGORY</h4>
                </div>
                <div class="modal-body">
					<!--<div class="box_sch">
						<form name="fsearchbox">
						  <input type="text" placeholder="검색하기" name="search">
						  <button type="submit"></button>
						</form>
					</div>-->
					<ul id="sort_list" class="cate_list modal_category">
						<li>Engine</li>
						<li>Generator</li>
						<li>Crane</li>
						<li>Heavy equipment</li>
						<li>Transpoter</li>
						<li>Machines</li>
						<li>Tools</li>
						<li>Others</li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 카테고리 모달팝업 -->

<!-- 카테고리 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade v2 long sch" id="cateModal_sale03" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">CATEGORY</h4>
                </div>
                <div class="modal-body">
					<!--<div class="box_sch">
						<form name="fsearchbox">
						  <input type="text" placeholder="검색하기" name="search">
						  <button type="submit"></button>
						</form>
					</div>-->
					<ul id="sort_list" class="cate_list modal_category">
						<li>Engine</li>
						<li>Auxiliary Machinery</li>
						<li>Valve, Filter/Strainer, Pipe Fittings</li>
						<li>Propulsion System And Rudder System</li>
						<li>HVAC, Refrigeration System</li>
						<li>Electrical Equipment and Automation</li>
						<li>Communication and Navigation Equipment</li>
						<li>Deck Machinery & Cargo Hold Hatch Cover</li>
						<li>Deck/Accommodation Outfitting</li>
						<li>Fire Fighting/Life-Saving and Personal Safety</li>
						<li>Measuring Meter/Instrument/Special Tool</li>
						<li>Galley Equipment/Laundry Equipment/Sanitory</li>
						<li>Ship Chandler</li>
						<li>Non-Marine Product</li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 카테고리 모달팝업 -->

<div id="area_help" class="company_write v2">
    <form id="fforsale" name="fforsale" method="post">
        <input type="hidden" id="w" name="w" value="<?=$w?>">
        <input type="hidden" id="idx" name="idx" value="<?=$idx?>">
        <input type="hidden" id="sale_category" name="sale_category" value="<?=$row['sale_category']?>">
        <input type="hidden" id="ship_type" name="ship_type" value="<?=$row['ship_type']?>">
        <input type="hidden" id="del_file_idx" name="del_file_idx">
        <div class="inr v3">
            <h2 class="title">For Sale</h2>
            <div id="company_write">
                <ul class="box_list">
                    <li>
                        <em>For Sale Type</em>
                        <ul class="area_filter">
                            <li>
                                <input type="checkbox" id="ship" name="sale_type" value="ship" <?php echo $w == 'u' ? 'disabled' : ''; ?> <?php echo $w == '' || $row['sale_type'] == 'ship' ? 'checked' : ''; ?> onclick="checkOnlyOne(this);typeCheck(this);">
                                <label for="ship">
                                    <span></span>
                                    <em>Ship</em> <!--선박-->
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="machinery" name="sale_type" value="machinery" <?php echo $w == 'u' ? 'disabled' : ''; ?> <?php echo $row['sale_type'] == 'machinery' ? 'checked' : ''; ?> onclick="checkOnlyOne(this);typeCheck(this);">
                                <label for="machinery">
                                    <span></span>
                                    <em>Machinery</em> <!--기계장비-->
                                </label>
                            </li>
                             <li>
                                <input type="checkbox" id="parts" name="sale_type" value="parts/articles" <?php echo $w == 'u' ? 'disabled' : ''; ?> <?php echo $row['sale_type'] == 'parts/articles' ? 'checked' : ''; ?> onclick="checkOnlyOne(this);typeCheck(this);">
                                <label for="parts">
                                    <span></span>
                                    <em>Parts/Articles</em> <!--부품/물품-->
                                </label>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <em>Category</em>
                        <div class="area_box">
                            <!-- 선박카테고리-->
                            <div class="mbox_cate filter filter_category init type1">
                            <!--<div class="mbox_cate select"> 필터 체크 했을대 select클래스 추가-->
                                <span data-toggle="modal" data-target="#cateModal_sale"><i></i>CATEGORY</span>
                            </div>

                            <!-- 기계장비 카테고리-->
                            <div class="mbox_cate filter filter_category init type2" style="display: none;">
                                <span data-toggle="modal" data-target="#cateModal_sale02"><i></i>CATEGORY</span>
                            </div>
                            <!-- 기계장비 카테고리-->

                            <!-- 부품/물품 카테고리-->
                            <div class="mbox_cate filter filter_category init type3" style="display: none;">
                                <span data-toggle="modal" data-target="#cateModal_sale03"><i></i>CATEGORY</span>
                            </div>
                            <!-- 부품/물품 카테고리-->
                        </div>
                    </li>
                    <li>
                        <em>Subject</em>
                        <div class="area_box">
                            <input type="text" class="input_subject" id="sale_subject" name="sale_subject" value="<?=$row['sale_subject']?>">
                        </div>
                    </li>

                    <!-- 매물유형 선박 -->
                    <li class="init type1_con">
                        <ul class="area_box col02">
                            <li>
                                <span>Ship Type</span>
                                <!-- 기업의뢰 필터-->
                                <div class="mbox_cate filter filter_ship_type">
                                <!--<div class="mbox_cate select"> 필터 체크 했을대 select클래스 추가-->
                                    <span data-toggle="modal" data-target="#cateModal02"><i></i>Ship Type</span>
                                </div>

                                <!--
                                <ul class="filter_list">
                                    <li>
                                        <div class="box">
                                            <i>category</i>
                                            <span>Oil/Gas Carriers</span>
                                        </div>
                                        <div class="box">
                                            <i>Ship/Boat Type</i>
                                            <span>Non-Propelled Tanker Barge</span>
                                        </div>
                                        <button type="button" class="btn_close" onclick="del_data('+num+');"></button>
                                    </li>
                                </ul>
                                -->
                            </li>
                            <li>
                                <span>Ship Name</span>
                                <input type="text" id="ship_name" name="ship_name" value="<?=$row['ship_name']?>">
                            </li>
                            <li class="double">
                                <span>Capacity (Main)</span>
                                <div class="input_wrap">
                                    <input type="text" id="main_capacity" name="main_capacity" value="<?=$row['main_capacity']?>">
                                    <select id="main_capacity_unit" name="main_capacity_unit">
                                        <option value="DWT" <?php echo $row['main_capacity_unit'] == 'DWT' ? 'selected' : ''; ?>>DWT</option>
                                        <option value="GRT" <?php echo $row['main_capacity_unit'] == 'GRT' ? 'selected' : ''; ?>>GRT</option>
                                        <option value="TEU" <?php echo $row['main_capacity_unit'] == 'TEU' ? 'selected' : ''; ?>>TEU</option>
                                        <option value="PAX" <?php echo $row['main_capacity_unit'] == 'PAX' ? 'selected' : ''; ?>>PAX</option>
                                        <option value="BHP" <?php echo $row['main_capacity_unit'] == 'BHP' ? 'selected' : ''; ?>>BHP</option>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <span>Built Year</span>
                                <input type="text" id="built_year" name="built_year" value="<?=$row['built_year']?>">
                            </li>
                            <li class="double">
                                <span>Capacity (Sub)</span>
                                <div class="input_wrap">
                                    <input type="text" id="sub_capacity" name="sub_capacity" value="<?=$row['sub_capacity']?>">
                                    <select id="sub_capacity_unit" name="sub_capacity_unit">
                                        <option value="DWT" <?php echo $row['sub_capacity_unit'] == 'DWT' ? 'selected' : ''; ?>>DWT</option>
                                        <option value="GRT" <?php echo $row['sub_capacity_unit'] == 'GRT' ? 'selected' : ''; ?>>GRT</option>
                                        <option value="TEU" <?php echo $row['sub_capacity_unit'] == 'TEU' ? 'selected' : ''; ?>>TEU</option>
                                        <option value="PAX" <?php echo $row['sub_capacity_unit'] == 'PAX' ? 'selected' : ''; ?>>PAX</option>
                                        <option value="BHP" <?php echo $row['sub_capacity_unit'] == 'BHP' ? 'selected' : ''; ?>>BHP</option>
                                    </select>
                                </div>
                            </li>
                            <li class="double">
                                <span>Price Idea</span>
                                <div class="input_wrap">
                                    <input type="text" id="price_idea" name="price_idea" value="<?=$row['price_idea']?>">
                                    <select id="price_idea_unit" name="price_idea_unit">
                                        <option value="million$" <?php echo $row['price_idea_unit'] == 'million$' ? 'selected' : ''; ?>>million$</option>
                                        <!--<option value="1">억원</option>-->
                                    </select>
                                </div>
                            </li>
                        </ul>
                        <ul class="area_box col03">
                            <li>
                                <span>LOA (Meter)</span>
                                <input type="text" id="loa" name="loa" value="<?=$row['loa']?>">
                            </li>
                            <li>
                                <span>Breadth (M)</span>
                                <input type="text" id="breadth" name="breadth" value="<?=$row['breadth']?>">
                            </li>
                            <li>
                                <span>Depth (M)</span>
                                <input type="text" id="depth" name="depth" value="<?=$row['depth']?>">
                            </li>
                        </ul>
                        <ul class="area_box col02 last">
                            <li>
                                <span>Class</span>
                                <input type="text" id="class" name="class" value="<?=$row['class']?>">
                            </li>
                            <li>
                                <span>Service Speed</span>
                                <input type="text" id="service_speed" name="service_speed" value="<?=$row['service_speed']?>">
                            </li>
                            <li>
                                <span>Ship Location</span>
                                <input type="text" id="ship_location" name="ship_location" value="<?=$row['ship_location']?>">
                            </li>
                            <li>
                                <span>Sell as Scrap</span>
                                <div class="input type">
                                    <label class="selector">
                                        <input type="radio" id="yes" name="scrap" value="YES" checked>
                                        <span>YES</span>
                                    </label>
                                        <label class="selector">
                                        <input type="radio" id="no" name="scrap" value="NO" >
                                        <span>NO</span>
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- 매물유형 선박 -->


                    <!-- 매물유형 기계장비 -->
                    <li class="init type2_con" style="display: none;">
                        <ul class="area_box col02">
                            <li>
                                <span>Product Name</span>
                                <input type="text" id="product_name" name="product_name" value="<?=$row['product_name']?>">
                            </li>
                            <li>
                                <span>Maker</span>
                                <input type="text" id="maker" name="maker" value="<?=$row['maker']?>">
                            </li>
                            <li>
                                <span>Manufacture Year</span>
                                <input type="text" id="manufacture_year" name="manufacture_year" value="<?=$row['manufacture_year']?>">
                            </li>
                            <li>
                                <span>Model/Type</span>
                                <input type="text" id="model" name="model" value="<?=$row['model']?>">
                            </li>
                            <li>
                                <span>Certificate/Approval</span>
                                <input type="text" id="certificate" name="certificate" value="<?=$row['certificate']?>">
                            </li>
                            <li>
                                <span>Condition</span>
                                <input type="text" id="condition" name="condition" value="<?=$row['sale_condition']?>">
                            </li>
                            <li class="double">
                                <span>Quantity</span>
                                <div class="input_wrap">
                                    <input type="text" id="quantity" name="quantity" value="<?=$row['quantity']?>">
                                    <select id="quantity_unit" name="quantity_unit">
                                        <option value="1">DWT</option>
                                        <option value="1">GRT</option>
                                        <option value="1">TEU</option>
                                        <option value="1">PAX</option>
                                        <option value="1">BHP</option>
                                    </select>
                                </div>
                            </li>
                            <li class="double">
                                <span>Price Idea</span>
                                <div class="input_wrap">
                                    <input type="text" id="price_idea" name="price_idea">
                                    <select id="price_idea_unit" name="price_idea_unit">
                                        <option value="$">$</option>
                                        <!--<option value="1">천원</option>-->
                                    </select>
                                </div>
                            </li>
                            <li>
                                <span>Terms of Delivery</span>
                                <input type="text" id="delivery" name="delivery" value="<?=$row['delivery']?>">
                            </li>
                            <li>
                                <span>Terms of Payment</span>
                                <input type="text" id="payment" name="payment" value="<?=$row['payment']?>">
                            </li>
                            <li>
                                <span>Your Guarantee</span>
                                <input type="text" id="guarantee" name="guarantee" value="<?=$row['guarantee']?>">
                            </li>
                            <li>
                                <span>Located at</span>
                                <input type="text" id="located_at" name="located_at" value="<?=$row['located_at']?>">
                            </li>
                        </ul>
                    </li>
                    <!-- 매물유형 기계 장비 -->


                    <!-- 매물유형 부품, 물품 -->
                    <li class="init type3_con" style="display: none;">
                        <ul class="area_box col02">
                            <li>
                                <span>Maker</span>
                                <input type="text" id="maker" name="maker" value="<?=$row['maker']?>">
                            </li>
                            <li>
                                <span>Model/Type</span>
                                <input type="text" id="model" name="model" value="<?=$row['model']?>">
                            </li>
                            <li>
                                <span>Certificate/Approval</span>
                                <input type="text" id="certificate" name="certificate" value="<?=$row['certificate']?>">
                            </li>
                            <li>
                                <span>Condition</span>
                                <input type="text" id="condition" name="condition" value="<?=$row['sale_condition']?>">
                            </li>
                            <li>
                                <span>Terms of Delivery</span>
                                <input type="text" id="delivery" name="delivery" value="<?=$row['delivery']?>">
                            </li>
                            <li>
                                <span>Terms of Payment</span>
                                <input type="text" id="payment" name="payment" value="<?=$row['payment']?>">
                            </li>
                            <li>
                                <span>Located at</span>
                                <input type="text" id="located_at" name="located_at" value="<?=$row['located_at']?>">
                            </li>
                        </ul>
                        <div class="table_wrap">
							<div class="box_btn sm"><a href="javascript:addPart();" class="btn_add">Add Parts</a></div>
                            <table class="table v2 scroll">
                                <caption>부품/물품</caption>
                                <colgroup>
                                    <col style="width:3%"/>
                                    <col style="width:17%"/>
                                    <col style="width:14%"/>
                                    <col style="width:14%"/>
                                    <col style="width:10%"/>
                                    <col style="width:14%"/>
                                    <col style="width:14%"/>
                                    <col style="width:14%"/>
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th colspan="2">*Item</th>
                                        <th>Part No.</th>
                                        <th>Drawing No.</th>
                                        <th>*Qty</th>
                                        <th>Unit Price</th>
                                        <th>Price</th>
                                        <th colspan="2">Remark</th>
                                    </tr>
                                </thead>
                                <tbody class="add_part">
                                <?php
                                $partcount = sql_fetch(" select count(*) as count from g5_for_sale_part where for_sale_idx = '{$row['idx']}' ")['count'];
                                $part_rlt = sql_query(" select * from g5_for_sale_part where for_sale_idx = '{$row['idx']}' ");
                                $num = 0;
                                while($part = sql_fetch_array($part_rlt)) {
                                ?>
                                <tr class="part_<?=$num?>">
                                    <td><span class="num"><?=$num+1?></span></td>
                                    <td><input type="text" id="item_<?=$num?>" name="item[]" value="<?=$part['item']?>"></td>
                                    <td><input type="text" id="part_no_<?=$num?>" name="part_no[]" value="<?=$part['part_no']?>"></td>
                                    <td><input type="text" id="drawing_no_<?=$num?>" name="drawing_no[]" value="<?=$part['drawing_no']?>"></td>
                                    <td><input type="text" id="qty_<?=$num?>" name="qty[]" value="<?=!empty($part['qty']) ? number_format($part['qty']) : ''; ?>"></td>
                                    <td><input type="text" id="unit_price_<?=$num?>" name="unit_price[]" value="<?=!empty($part['qty']) ? number_format($part['unit_price']) : ''; ?>"></td>
                                    <td><input type="text" id="price_<?=$num?>" name="price[]" value="<?=!empty($part['qty']) ? number_format($part['price']) : ''; ?>"></td>
                                    <td><input type="text" id="remark_<?=$num?>" name="remark[]" value="<?=$part['remark']?>"></td>
                                    <td><button type="button" class="btn_close" onclick="delPart('<?=$num?>')"></button></td>
                                </tr>
                                <?php
                                    $num++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                       <!-- <div class="box_btn"><a href="javascript:addPart();" class="btn_add">Add Parts</a></div>-->
                    </li>
                    <!-- 매물유형 부품, 물품 -->

                    <li>
                        <em>Full Description</em>
                        <div class="area_box">
                            <textarea id="full_description" name="full_description"><?=$row['full_description']?></textarea>
                        </div>
                    </li>
                    <li>
                        <em>Photos/Files</em>
                        <div class="area_box">
                            <div class="img_wrap">
                                <!-- 첨부파일 영역-->
                                <ul id="file_list" class="file_list">
                                <?php
                                $filecount = sql_fetch(" select count(*) as count from g5_company_estimate_img where company_estimate_idx = {$ce_idx}; ")['count'];
                                if($filecount > 0) {
                                    $file_sql = " select * from g5_company_estimate_img where company_estimate_idx = {$ce_idx} order by idx; ";
                                    $file_result = sql_query($file_sql);

                                    for($i=0; $row=sql_fetch_array($file_result); $i++) {
                                        ?>
                                        <li class="file_<?=$i?>">
                                            <span class="fileName"><a href="<?=G5_DATA_URL?>/file/company_estimate/<?=$row['img_file']?>" target="_blank"><?=$row['img_source']?></a></span><button type="button" class="btn_delete" onclick="file_delete(<?=$i?>);"></button>
                                            <input type="hidden" id="file_idx_<?=$i?>" name="file_idx_<?=$i?>" value="<?=$row['idx']?>">
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                                </ul>
                                <div id="fileDrag" class="img_wrap btn_upload">
                                    <input type="file" name="file" id="file" onchange="file_select(this);" multiple accept="*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;">

                                    <div class="area_txt" onclick="file_add();">
                                        <div class="area_img"><img src="<?php echo G5_IMG_URL ?>/icon_upload.svg"></div>
                                        <span>Add files by dragging with the mouse.</span>
                                    </div>
                                </div>
                                <em>※ upload limit 10mb</em>
                            </div>
                        </div>
                    </li>
                    <!--<li>
                        <em>Files</em>
                        <div class="area_box">
                            <div class="img_wrap">

                            </div>
                        </div>
                    </li>-->
                </ul>
            </div>

            <!--<div class="w_filter">
                <h3>공개 범위</h3>
                <ul class="area_filter">
                    <li>
                        <input type="checkbox" id="open" <?php /*echo $w == '' ? 'checked' : '' */?> name="he_open" value="open" <?php /*echo $help['he_open'] == 'open' ? 'checked' : ''; */?> onclick="checkOnlyOne(this);">
                        <label for="open">
                            <span></span>
                            <em>국내</em>
                        </label>
                    </li>
                    <li>
                        <input type="checkbox" id="private" name="he_open" value="private" <?php /*echo $help['he_open'] == 'private' ? 'checked' : ''; */?> onclick="checkOnlyOne(this);">
                        <label for="private">
                            <span></span>
                            <em>해외<i>!</i>
                                <div class="area_info">
                                    <p>포도씨의 해외네트워크에 매물이 공개됩니다. 해외도 함께 공개시에는 가급적 영문으로 작성해 주실 것을 권고 드립니다.</p>
                                </div>
                            </em>
                        </label>
                    </li>
                </ul>
            </div>-->

            <div class="area_btn two">
                <ul class="btn_list">
                <li><button type="button" class="btn_cancle" onclick="history.back();">Cancel</button></li>
                <li><button type="button" class="btn_confirm" onclick="productWriteUpdate();"><?=$w=='u'?'Modify':'For Sale';?></button></li>
            </ul>
            </div>
        </div>
    </form>
</div>

<script>
$(function(){
    var gnbArea = $(".list > li");
    var gnbLink =  gnbArea.children("a");
    $('#cateModal02 .list li').off('mouseenter mouseleave');
    $('#cateModal02 .list li').each(function(){
        var gnbLink = $(this).children('a');
        if($(this).children('ul').length > 0){
            gnbLink.on('click',function(e){
                e.preventDefault();
                $('#cateModal02 .list li a').removeClass('active');
                gnbArea.children('ul').stop().slideUp();
                $(this).addClass('active');
                $(this).siblings('a').addClass('active');
                $(this).parent().children('ul').stop().slideDown();
                return false;
            });
        }
    });
});
</script>
<script>
var fileList = []; // 파일 정보를 담아둘 배열
var file_count = '<?=$filecount?>' == 0 ? 0 : '<?=$filecount?>';
$(function() {
    if($('#w').val() == 'u') { // 수정 시
        var type = $("input:checkbox[name='sale_type']:checked").val();

        /**
         * type1 - ship 카테고리
         * type2 - machinery 카테고리
         * type3 - parts/articles 카테고리
         * type1_con - ship 등록폼
         * type2_con - machinery 등록폼
         * type3_con - parts/articles 등록폼
         */
        $('.init').hide();
        if(type == 'ship') {
            $('.type1').show();
            $('.type1_con').show();
            $('.type2_con').remove();
            $('.type3_con').remove();
        } else if(type == 'machinery') {
            $('.type1_con').remove();
            $('.type2').show();
            $('.type2_con').show();
            $('.type3_con').remove();
        } else if(type == 'parts/articles') {
            $('.type1_con').remove();
            $('.type2_con').remove();
            $('.type3').show();
            $('.type3_con').show();
        }

        // 카테고리
        $('.filter_category span').html('<?=$row['sale_category']?>');
        $('.filter_category').addClass('select');
    }
    
    $('.area_filter > li label em i').on('click', function () {
        $(this).toggleClass('active');
        $('.area_filter .area_info').toggleClass('active');
        return false;
    });

    // 파일 드래그 앤 드롭
    $("#fileDrag").on("dragenter", function(e){
        e.preventDefault();
        e.stopPropagation();
    }).on("dragover", function(e){
        e.preventDefault();
        e.stopPropagation();
        $(this).css("background-color", "#FFD8D8");
    }).on("dragleave", function(e){
        e.preventDefault();
        e.stopPropagation();
        $(this).css("background-color", "#FFF");
    }).on("drop", function(e){
        e.preventDefault();

        var files = e.originalEvent.dataTransfer.files;
        if(files != null && files != undefined){
            var tag = "";
            for(var i=0; i<files.length; i++){
                var f = files[i];

                var fileName = f.name;
                /*var reg_ext = /(.*?)\.(pdf|jpg|doc|docx|JPG|)$/;
                if (!reg_ext.test(fileName)) {
                    swal("Please check the extension.\n available extensions : PDF/JPG/DOC/DOCX");
                    $(this).css("background-color", "#FFF");
                    return false;
                }*/

                var fileSize = f.size;
                var maxSize = 10 * 1024 * 1024; // 최대 10MB
                if(fileSize > maxSize) {
                    swal('The file exceeds the maximum capacity of 10 MB.');
                    $(this).css("background-color", "#FFF");
                    return false;
                }

                fileList.push(f);

                tag += '<li class="file_'+file_count+'">' +
                    '<span class="fileName"><a href="javascript:void(0);">'+fileName+'</a></span><button type="button" class="btn_delete" onclick="file_delete('+file_count+');"></button>' +
                    '</li>';

                // 파일 새창 미리보기
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.file_'+(file_count-1)+' a').attr('onclick', 'file_show(\''+e.target.result+'\')');
                }
                reader.readAsDataURL(f);

                file_count++;
            }
            // $(this).append(tag);
            $('#file_list').append(tag);
        }

        $(this).css("background-color", "#FFF");
    });

    // Category
    $(".modal_category li").click(function () {
        click_event('filter_category', $(this), 'active', 'sale_category');

        var add_text = '';
        if ($(this)[0]['innerText'] == 'CATEGORY') {
            add_text += '<i></i>';
        }
        $('.filter_category span').html(add_text + $(this)[0]['innerText'])
        $('#cateModal_sale').modal('hide');
        $('#cateModal_sale02').modal('hide');
        $('#cateModal_sale03').modal('hide');

        if ($('#sale_category').val() != '') {
            $('.filter_category').addClass('select');

            $('#modal_ship_type li').hide();
            if ($(this)[0]['innerText'] == 'General Cargo') {
                $('.filter_category_1').removeClass('noshow');
            } else if ($(this)[0]['innerText'] == 'Bulk Carriers') {
                $('.filter_category_2').removeClass('noshow');
            } else if ($(this)[0]['innerText'] == 'Oil/Gas Carriers') {
                $('.filter_category_3').removeClass('noshow');
            } else if ($(this)[0]['innerText'] == 'Tugs/Barges') {
                $('.filter_category_4').removeClass('noshow');
            } else if ($(this)[0]['innerText'] == 'FD/FC/Work Vessels') {
                $('.filter_category_5').removeClass('noshow');
            } else if ($(this)[0]['innerText'] == 'Special/Offshore') {
                $('.filter_category_6').removeClass('noshow');
            } else if ($(this)[0]['innerText'] == 'Passenger Ships') {
                $('.filter_category_7').removeClass('noshow');
            } else if ($(this)[0]['innerText'] == 'Fishing Vessels') {
                $('.filter_category_8').removeClass('noshow');
            } else if ($(this)[0]['innerText'] == 'Yachat/Boat') {
                $('.filter_category_9').removeClass('noshow');
            }
        } else {
            $('.filter_category').removeClass('select');
        }
    });

    // Ship Type
    $('.filter_ship_type').click(function() {
        if ($('#sale_category').val() != '' && $('#sale_category').val() != undefined) {}
        else {
            swal('Please select a category');
            return false;
        }
    });
    $(".modal_ship_type li").click(function () {
        click_event('filter_category', $(this), 'active', 'ship_type');

        var add_text = '';
        if ($(this)[0]['innerText'] == 'CATEGORY') {
            add_text += '<i></i>';
        }
        $('.filter_ship_type span').html(add_text + $(this)[0]['innerText']);
        $('#cateModal02').modal('hide');

        if ($('#ship_type').val() != '') {
            $('.filter_ship_type').addClass('select');
        }
    });
});

// 선택한 타입에 따라 카테고리 달라짐
function typeCheck(el) {
    var type = el.value;

    // 카테고리 및 등록폼 초기화
    $('.init').hide();
    $('.filter_category span').html('<i></i>CATEGORY');
    $('.filter_category').removeClass('select');

    // 타입별 카테고리 변경
    if(type == 'ship') {
        $('.type1').show();
        $('.type1_con').show();
    } else if(type == 'machinery') {
        $('.type2').show();
        $('.type2_con').show();
    } else if(type == 'parts/articles') {
        $('.type3').show();
        $('.type3_con').show();
    }
}

// 부품 추가하기
var cnt = '<?=$partcount?>' == 0 ? 0 : '<?=$partcount?>';
function addPart() {
    var html = '<tr class="part_'+cnt+'">';
    html += '<td><span class="num">'+(Number(cnt)+1)+'</span></td>';
    html += '<td><input type="text" id="item_'+cnt+'" name="item[]"></td>';
    html += '<td><input type="text" id="part_no_'+cnt+'" name="part_no[]"></td>';
    html += '<td><input type="text" id="drawing_no_'+cnt+'" name="drawing_no[]"></td>';
    html += '<td><input type="text" id="qty_'+cnt+'" name="qty[]"></td>';
    html += '<td><input type="text" id="unit_price_'+cnt+'" name="unit_price[]"></td>';
    html += '<td><input type="text" id="price_'+cnt+'" name="price[]"></td>';
    html += '<td><input type="text" id="remark_'+cnt+'" name="remark[]"></td>';
    html += '<td><button type="button" class="btn_close" onclick="delPart('+cnt+');"></button></td>';
    html += '</tr>';
    $('.add_part').append(html);
    cnt++;
}

// 부품 삭제하기
function delPart(num) {
    $('.part_'+num).remove();
}

// 클릭 이벤트(이벤트 적용할 영역(class), 선택 데이터, 이벤트 표시(class), formdata name)
function click_event(object, element, class_name, column) {
    $('.' + object + ' li').removeClass(class_name);
    element.addClass(class_name);
    $('#' + column).val(element[0]['innerText']);
}

// 파일 삭제
var delFileIdx = '';
function file_delete(num) {
    delFileIdx += $('#file_idx_'+num).val() + ',';
    $('.file_'+num).remove();
}

// 파일 업로드
function file_add() {
    $("#file").click();
}

// 파일 선택
function file_select(input) {
    if (input.files && input.files[0]) {
        var files = input.files;
        var files_arr = Array.prototype.slice.call(files);

        var tag = "";
        for (var i = 0; i<input.files.length; i++) {
            var f = files_arr[i];

            var fileName = f.name;
            /*var reg_ext = /(.*?)\.(pdf|jpg|doc|docx|JPG|)$/;
            if (!reg_ext.test(fileName)) {
                swal("Please check the extension.\n Available extensions : PDF/JPG/DOC/DOCX");
                $(this).css("background-color", "#FFF");
                return false;
            }*/

            var fileSize = f.size;
            var maxSize = 10 * 1024 * 1024; // 최대 10MB
            if(fileSize > maxSize) {
                swal('The file exceeds the maximum capacity of 10 MB.');
                $(this).css("background-color", "#FFF");
                return false;
            }

            fileList.push(f);

            tag += '<li class="file_'+file_count+'">' +
                '<span class="fileName"><a href="javascript:void(0);">'+fileName+'</a></span><button type="button" class="btn_delete" onclick="file_delete('+file_count+');"></button>' +
                '</li>';


            // 파일 새창 미리보기
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.file_'+(file_count-1)+' a').attr('onclick', 'file_show(\''+e.target.result+'\')');
            }
            reader.readAsDataURL(f);

            file_count++;
        }

        $('#file_list').append(tag);
    }
}

// 파일 새창 미리보기 (등록 시 사용)
function file_show(src) {
    var win = window.open('','');
    win.document.write('<body style="margin: 0px !important;"><iframe width="100%;" height="100%" style="border: none !important;" src="'+src+'"></body>');
}

// 매물올리기 등록/수정
var is_post = false; // 중복 submit 체크
function productWriteUpdate() {
    // if(is_post) {
    //     return false;
    // }
    // is_post = true;

    $("input:checkbox[name='sale_type']").attr('disabled', false);
    var type = $("input:checkbox[name='sale_type']:checked").val();

    /*if($('#sale_category').val() == '') {
        swal('Please select a category.');
        is_post = false;
        return false;
    }*/
    if(type == 'ship') {
        /*if($('#sale_subject').val() == '') {
            swal('Please enter the subject.');
            is_post = false;
            return false;
        }
        if($('#ship_type').val() == '') {
            swal('Please select a ship type.');
            is_post = false;
            return false;
        }
        if($('#ship_name').val() == '') {
            swal('Please enter the ship name.');
            is_post = false;
            return false;
        }*/

        $('.type2_con').remove();
        $('.type3_con').remove();
    }
    else if(type == 'machinery') {
        $('.type1_con').remove();
        $('.type3_con').remove();
    }
    else if(type == 'parts/articles') {
        $('.type1_con').remove();
        $('.type2_con').remove();
    }

    $('#del_file_idx').val(delFileIdx.slice(0,-1)); // 의뢰 상세 자료 삭제 (파일 삭제)

    var form = $('#fforsale')[0];
    var formData = new FormData(form);
    if(fileList.length > 0){ // 의뢰 상세 자료 업르도 (파일 업로드)
        fileList.forEach(function(f){
            formData.append("files[]", f);
        });
    }

    $.ajax({
        url : g5_bbs_url + "/ajax.product_write_update.php",
        processData: false,
        contentType: false,
        data: formData,
        type: 'POST',
        success : function(data) {
            if(data == 'success') {
                if($('#w').val() == '') {
                    swal('Registration completed.')
                    .then(()=>{
                        if($('#podosea').val() == 'Y') {
                            $('#podoCS').modal('show');
                        } else {
                            location.replace(g5_bbs_url+'/company_list.php');
                        }
                    });
                }
                else {
                    swal('Modification completed.')
                    .then(()=>{
                        location.replace(g5_bbs_url+'/product_view.php?idx=<?=$idx?>');
                    });
                }
            }
        },
        err : function(err) {
            swal(err.status);
        }
    });
}
</script>

<?
include_once('./_tail.php');
?>