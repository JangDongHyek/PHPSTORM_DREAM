<?
include_once('./_common.php');
$name = "cmypage";
$g5['title'] = '캐쉬관리';
include_once('./_head.php');


?>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

    <div id="area_mypage" class="bunker">
		<div class="inr">
            <?php include('./mypage_banner.php'); ?>

			<?php include_once('./mypage_info.php'); ?> 
			
			<div id="mypage_wrap">	
				<div class="mypage_cont">
					<div class="mypage_cont_wrap">
					<div class="box">
						<h3>캐쉬관리</h3>
						<a class="btn_withdraw01" href="<?php echo G5_BBS_URL ?>/mypage_withdraw.php"><span>출금하기</span></a>
						<div class="bunker_type">
							<ul class="bunker_list">
								<li class="total">
									<span>보유캐쉬</span>
									<h3 class="number">500</h3>
								</li>
							</ul>
						</div>							

						<div class="box_cont">
							<div class="box_top">
								<ul class="tabs">
									<li class="active" rel="tab1"><span>적립내역</span></li>
									<li rel="tab2"><span>출금내역</span></li>
                             
								</ul>
								<div class="filter">
									<select class="year" id="year" name="year" onchange="mypage_bunker();">
										<option value="1">2022년</option>
									</select>
									<select class="month" id="month" name="month" onchange="mypage_bunker();">
                                        <?php for($i=1; $i<=12; $i++) { ?>
                                        <option value="<?=$i?>" <?php echo date('m') == $i ? 'selected' : ''; ?>><?=$i?>월</option>
                                        <?php } ?>
									</select>
								</div>
							</div>
							<div class="tab_container">
								<div id="tab1" class="tab_content" style="display: block;">
									<div class="box_cont">
										<div class="table_wrap">
											<ul class="tbl_hd tbl">
												<li class="data w2">날짜</li>
												<li class="cont w6">내용</li>
												<li class="price w2">금액</li>
											</ul>
                                            <!--ajax.mypage_bunker.php-->
											<ul class="tbl_cont_wrap bunker_in">
												<li class="tbl_cont">
													<ul class="tbl_list tbl">
														<li class="data w2">2022.02.03</li>
														<li class="cont w6">재능 판매 금액 적립</li>
														<li class="price w2">250</li>
													</ul>
												</li>
												<li class="tbl_cont">
													<ul class="tbl_list tbl">
														<li class="data w2">2022.02.03</li>
														<li class="cont w6">재능 판매 금액 적립2</li>
														<li class="price w2">250</li>
													</ul>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div id="tab2" class="tab_content" style="display: block;">
									<div class="box_cont">
										<div class="table_wrap">
											<ul class="tbl_hd tbl">
												<li class="data w2">날짜</li>
												<li class="cont w4">내용</li>
												<li class="price w2">금액</li>
												<li class="type w2">종류</li>
											</ul>
                                            <!--ajax.mypage_bunker.php-->
											<ul class="tbl_cont_wrap bunker_in">
												<li class="tbl_cont">
													<ul class="tbl_list tbl">
														<li class="nodata" style="text-align: center;">등록된 내용이 없습니다.</li>
													</ul>
												</li>
												<li class="tbl_cont">
													<ul class="tbl_list tbl">
														<li class="data w2">2022.02.03</li>
														<li class="cont w4">10,000캐쉬가 출금되었습니다.</li>
														<li class="price w2">10,000원</li>
														<li class="type w2"><i>대기</i></li>
													</ul>
													<ul class="tbl_list tbl">
														<li class="data w2">2022.02.03</li>
														<li class="cont w4">10,000캐쉬가 출금되었습니다.</li>
														<li class="price w2">10,000원</li>
														<li class="type w2"><i class="v2">완료</i></li>
													</ul>
												</li>
											</ul>
										</div>
									</div>
								</div>
                               
                                <div id="paging"></div>
							</div>
						</div>
					</div>
				</div>

               
	
                </div>

				<?php include_once('./mypage_menu.php'); ?> 	
			</div>
		</div>
	</div>



<script>

	$(function(){
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
</script>


<?
include_once('./_tail.php');
?>

