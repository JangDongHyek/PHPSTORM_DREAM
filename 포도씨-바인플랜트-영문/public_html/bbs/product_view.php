<?
include_once('./_common.php');

$g5['title'] = 'For Sale';
include_once('./_head.php');

if(!empty($idx)) {
    $row = sql_fetch(" select sa.*, mb.mb_no from g5_for_sale as sa left join g5_member as mb on mb.mb_id = sa.mb_id where idx = '{$idx}' ");
} else {
    alert('Not the correct path.');
}

$view_count = sql_fetch(" select acc_count from g5_for_sale_action where for_sale_idx = {$idx} and mode = 'view' order by idx desc limit 1 ")['acc_count']; // 조회 누적카운트
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#ft_menu{display:none;}
</style>

<div id="area_help" class="company view v2">
	<div class="inr">
	<div id="top_bn">
		<div class="txt">
			<h2>Corporate RFQ</h2>
			<span>Feel free to request anything relating to shipbuilding and offshore business!</span>
		</div>
		<img src="<?php echo G5_IMG_URL ?>/bn_obj.png">
	</div>
	<div id="help_warp">
		<?php include_once('./left_menu_company.php'); ?>
		<div id="help_list">
			<div class="help_question">
				<div class="title">
					<em><?=$row['sale_category']?></em><!-- 카테고리 -->
					<h3><?=$row['sale_subject']?></h3><!-- 제목 -->
				</div>
				<div class="bottom">
					<div id="company_write">
						<ul class="box_list">
							<li>
								<div class="box_type">
									<em>For Sale Type</em>
									<div class="area_box"><p class="type"><i></i><?=$row['sale_type']?></p></div>
								</div>
								<div class="box_type">
									<em>Category</em>
									<div class="area_box"><p class="type"><?=$row['sale_category']?></p></div>
								</div>
							</li>

							<!-- 매물유형 선박 -->
                            <?php if($row['sale_type'] == 'ship') { ?>
							<li>
								<ul class="area_box col02">
									<li>
										<span>Ship Type</span>
										<p><?=$row['ship_type']?></p>
									</li>
									<li>
										<span>Ship Name</span>
										<p><?=$row['ship_name']?></p>
									</li>
									<li>
										<span>Capacity (Main)</span>
										<p><?=$row['main_capacity'].' '.$row['main_capacity_unit']?></p>
									</li>
									<li>
										<span>Built Year</span>
										<p><?=$row['built_year']?></p>
									</li>
									<li>
										<span>Capacity (Sub)</span>
										<p><?=$row['sub_capacity'].' '.$row['sub_capacity_unit']?></p>
									</li>
									<li>
										<span>Price Idea</span>
										<p><?=$row['price_idea'].' '.$row['price_idea_unit']?></p>
									</li>
								</ul>
								<ul class="area_box nm">
									<li>
										<span>LOA (Meter)</span>
										<p><?=$row['loa']?></p>
									</li>
									<li>
										<span>Breadth (M)</span>
										<p><?=$row['breadth']?></p>
									</li>
									<li>
										<span>Depth (M)</span>
										<p><?=$row['depth']?></p>
									</li>
								</ul>
								<ul class="area_box col02 nm">
									<li>
										<span>Class</span>
										<p><?=$row['class']?></p>
									</li>
									<li>
										<span>Service Speed</span>
										<p><?=$row['service_speed']?></p>
									</li>
									<li>
										<span>Ship Location</span>
										<p><?=$row['ship_location']?></p>
									</li>
									<li>
										<span>Sell as Scrap</span>
										<p><?=$row['sell_as_scrap']?></p>
									</li>
								</ul>
							</li>
							<!-- //매물유형 선박 -->
                            <?php } ?>

                            <?php if($row['sale_type'] == 'machinery') { ?>
                            <!-- 매물유형 기계장비 -->
							<li>
								<ul class="area_box col02">
									<li>
										<span>Product Name</span>
										<p><?=$row['product_name']?></p>
									</li>
									<li>
										<span>Maker</span>
										<p><?=$row['maker']?></p>
									</li>
									<li>
										<span>Manufacture Year</span>
										<p><?=$row['manufacture_year']?></p>
									</li>
									<li>
										<span>Model/Type</span>
										<p><?=$row['model']?></p>
									</li>
									<li>
										<span>Certificate/Approval</span>
										<p><?=$row['certificate']?></p>
									</li>
									<li>
										<span>Condition</span>
										<p><?=$row['sale_condition']?></p>
									</li>
									<li>
										<span>Quantity</span>
										<p><?=$row['quantity'].' '.$row['quantity_unit']?></p>
									</li>
									<li>
										<span>Price Idea</span>
										<p><?=$row['price_idea'].' '.$row['price_idea_unit']?></p>
									</li>
									<li>
										<span>Terms of Delivery</span>
										<p><?=$row['delivery']?></p>
									</li>
									<li>
										<span>Terms of Payment</span>
										<p><?=$row['payment']?></p>
									</li>
									<li>
										<span>Your Guarantee</span>
										<p><?=$row['guarantee']?></p>
									</li>
									<li>
										<span>Located at</span>
										<p><?=$row['located_at']?></p>
									</li>
								</ul>
							</li>
							<!-- //매물유형 기계장비 -->
                            <?php } ?>

                            <?php if($row['sale_type'] == 'parts/articles') { ?>
                            <!-- 매물유형 부품, 물품 -->
							<li>
								<ul class="area_box col02">
									<li>
										<span>Maker</span>
										<p><?=$row['maker']?></p>
									</li>
									<li>
										<span>Model/Type</span>
										<p><?=$row['model']?></p>
									</li>
									<li>
										<span>Certificate/Approval</span>
										<p><?=$row['certificate']?></p>
									</li>
									<li>
										<span>Condition</span>
										<p><?=$row['sale_condition']?></p>
									</li>
									<li>
										<span>Terms of Delivery</span>
										<p><?=$row['delivery']?></p>
									</li>
									<li>
										<span>Terms of Payment</span>
										<p><?=$row['payment']?></p>
									</li>
									<li>
										<span>Located at</span>
										<p><?=$row['located_at']?></p>
									</li>
								</ul>


								<div class="table_wrap">
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
                                            <th>*Qty(수량)</th>
                                            <th>Unit Price</th>
                                            <th>Price</th>
                                            <th>Remark</th>
                                        </tr>
										</thead>
										<tbody>
                                        <?php
                                        $part_rlt = sql_query(" select * from g5_for_sale_part where for_sale_idx = '{$row['idx']}' ");
                                        $num = 1;
                                        while($part = sql_fetch_array($part_rlt)) {
                                        ?>
                                        <tr>
                                            <td><span class="num"><?=$num?></span></td>
                                            <td><?=$part['item']?></td>
                                            <td><?=$part['part_no']?></td>
                                            <td><?=$part['drawing_no']?></td>
                                            <td><?=number_format($part['qty'])?></td>
                                            <td><?=number_format($part['unit_price'])?></td>
                                            <td><?=number_format($part['price'])?></td>
                                            <td><?=$part['remark']?></td>
                                        </tr>
                                        <?php
                                            $num++;
                                        }
                                        ?>
										</tbody>
									</table>
								</div>
							</li>
							<!-- //매물유형 부품, 물품 -->
                            <?php } ?>

							<li>
								<em>Full Description</em>
								<div class="area_box">
									<div class="area_txtarea">
										<p>
											<?=$row['full_description']?>
										</p>
									</div>
								</div>
							</li>
							<!--<li>
								<em>Photos</em>
								<div class="area_box">
								<ul class="file_list img">
									<li>
										<a href="">
											<div class="area_img"><img src="<?php /*echo G5_IMG_URL */?>/img_photo.jpg"></div>
											<span>diselengine.pdf</span>
										</a>
									</li>
									<li>
										<a href="">
											<div class="area_img"><img src="<?php /*echo G5_IMG_URL */?>/img_photo.jpg"></div>
											<span>diselengine.pdf</span>
										</a>
									</li>
									<li>
										<a href="">
											<div class="area_img"><img src="<?php /*echo G5_IMG_URL */?>/img_photo.jpg"></div>
											<span>diselengine.pdf</span>
										</a>
									</li>
									<li>
										<a href="">
											<div class="area_img"><img src="<?php /*echo G5_IMG_URL */?>/img_photo.jpg"></div>
											<span>diselengine.pdf</span>
										</a>
									</li>
								</ul>
							</li>-->
							<li>
								<em>Files</em>
								<div class="area_box file_box">
                                    <ul class="file_list img">
                                        <?php
                                        $filecount = sql_fetch(" select count(*) as count from g5_for_sale_img where for_sale_idx = {$idx}; ")['count'];
                                        if($filecount > 0) {
                                            $file_sql = " select * from g5_for_sale_img where for_sale_idx = {$idx} order by idx; ";
                                            $file_result = sql_query($file_sql);

                                            for($i=0; $file=sql_fetch_array($file_result); $i++) {
                                            ?>
                                            <li class="file_<?=$i?>">
                                                <a href="javascript:fileDownload('for_sale', '<?=$file['img_file']?>', '<?=$file['img_source']?>');">
                                                    <img src="<?=G5_DATA_URL?>/file/for_sale/<?=$file['img_file']?>">
                                                    <span class="fileName" style="margin-top: 10px"><?=$file['img_source']?></span>
                                                </a>
                                            </li>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
							</li>
						</ul>
					</div>
					<div class="info">
						<div class="list_info">
							<span class="id"><div class="profile"><img class="basic" src="<?php echo G5_IMG_URL ?>/img_smile.svg"></div><?=$row['mb_id']?></span><!--아이디-->
							<span class="data"><?=str_replace('-', '.', substr($row['wr_datetime'], 0, 10))?></span><!--등록일-->
							<span class="view">Views <em id="view_count"><?=$view_count?></em></span><!--조회수-->
                            <ul class="user_list">
                                <li><a href="<?=G5_BBS_URL?>/company.php?mb_no=<?=$row['mb_no']?>">Go to Company Homepage</a></li>
                                <li>RFQs <em class="blue"><?=inquiryCount($row['mb_id'])?></em></li>
                                <li>Transactions <em class="blue"><?=completeCount($row['mb_id'])?></em></li>
                                <li onclick="reportOpen('<?=$row['mb_id']?>', 'g5_for_sale', '<?=$row['idx']?>')">Report</li>
                            </ul>
						</div>
					</div>
				</div>
			</div>
			<div class="area_btn v2 two">
				<ul class="btn_list">
                    <?php if($member['mb_id'] != $row['mb_id']) { ?>
					<li><a href="javascript:chatting('<?=$row['mb_id']?>', '<?=$row['idx']?>');" class="btn_confirm chat">Contact the client</a></li>
					<!--<li><a href="" class="btn_confirm email">Contact us by email</a></li>-->
                    <?php } else { // 내가 올린 매물 ?>
                    <li><button type="button" class="btn_confirm" onclick="location.href='<?=G5_BBS_URL?>/product_write.php?idx=<?=$row['idx']?>&w=u'">Edit For Sale</button></li>
                    <li><button type="button" class="btn_confirm gray" onclick="delForsale();">Delete For Sale</button></li>
                    <?php } ?>
				</ul>
			</div>
			<div class="area_btn"><a class="btn_list" href="<?=G5_BBS_URL?>/company_list.php"><span>List</span><a></div>

		</div>
		<//?php include_once('./myinfo_company.php'); ?>
	</div>
</div>

<div class="btn_write"><a data-toggle="modal" data-target="#listCS"></a></div>

</div>

<script>
    $(function() {
        // 조회/좋아요/싫어요 동작
        forsale_action('view');

        $('.ci_type').hide();
        $('.ci_category').hide();
        $('.pr_type').show();

        /*// 매물리스트 매물유형 선택 시 카테고리 구분 (웹)
        $('.pr_type ul li').click(function() {
            $('.pr_category').hide();
            if($(this)[0]['innerText'] == 'Ship') {
                $('.pr_cate1').show();
            } else if($(this)[0]['innerText'] == 'Machinery') {
                $('.pr_cate2').show();
            } else if($(this)[0]['innerText'] == 'Parts/Articles') {
                $('.pr_cate3').show();
            }
        });*/
    });

    // 검색-클릭 이벤트(이벤트 적용할 영역(class), 선택 데이터, 이벤트 표시(class), formdata name, 모바일여부)
    function click_event(object, element, class_name, column, mobile) {
        $('.' + object + ' li').removeClass(class_name);
        element.addClass(class_name);
        $('#' + column).val(element[0]['innerText']);

        $('#tab').val('tab2');
        $('#fsearch').submit();
    }

    // 조회/좋아요/싫어요 동작 (액션)
    function forsale_action(mode) {
        $.ajax({
            url : g5_bbs_url + "/ajax.forsale_action.php",
            data: {mode : mode, for_sale_idx : '<?=$idx?>'},
            type: 'POST',
            cache: false,
            async: false,
            success : function(data) {
                if(data){
                    $('#'+mode+'_count').text(data);
                }
            },
            error : function(err) {
                swal(err.status);
            }
        });
    }

	//work tab
	$(document).ready(function() {
		$(".tab_content").hide();
		$(".tab_content:first").show();

		$("ul.tabs li").click(function () {
			if(!($(this).find('a').length > 0)){
				$("ul.tabs li").removeClass("active");
				$(this).addClass("active");
				$(".tab_content").hide()
				var activeTab = $(this).attr("rel");
				$("#" + activeTab).fadeIn()
			}
		});
	});

    // 매물리스트 삭제하기
    function delForsale() {
        swal({
            text: "Are you sure you want to delete the for sale?",
            icon: "warning",
            buttons: {
                defeat: "Confirm",
                cancel: "Cancel",
            },
        })
        .then((value) => {
            switch (value) {
                case "defeat":
                    $.ajax({
                        url: g5_bbs_url + "/ajax.product_write_update.php",
                        data: {idx: '<?=$idx?>', w: 'd'},
                        type: 'POST',
                        success: function (data) {
                            if(data == 'success') {
                                swal('Delete completed.')
                                .then(()=>{
                                    location.replace(g5_bbs_url+'/company_list.php');
                                });
                            }
                        },
                    });
                case "cancel":
                    return false;
            }
        });
        $('.swal-modal').addClass('half'); // 버튼 스타일 때문에 추가
    }
</script>

<script>
    $(function(){
        $('.list_info > .id').on('click',function(){
            $(this).toggleClass('active');
            $('.list_info .user_list').toggleClass('active');
            return false;
        });
    });
</script>

<?
include_once('./company_list_search_script.php');
include_once('./fchatting.php');
include_once('./_tail.php');
?>
