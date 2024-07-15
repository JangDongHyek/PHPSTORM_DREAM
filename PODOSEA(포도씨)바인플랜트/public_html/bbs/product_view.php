<?
include_once('./_common.php');

$g5['title'] = '헬프미';
include_once('./_head.php');

?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#ft_menu{display:none;}
</style>

<div id="area_help" class="company view v2">
	<div class="inr">
	<div id="top_bn">
		<div class="txt">
			<h2>기업의뢰</h2>
			<span>조선, 해양 관련 어떤 것이든 물어보세요!</span>
		</div>
		<img src="<?php echo G5_IMG_URL ?>/bn_obj.png">
	</div>
	<div id="help_warp">
		<?php include_once('./left_menu_company.php'); ?> 
		<div id="help_list">
			<div class="help_question">
				<div class="title">
					<em>General Cargo</em><!-- 카테고리 -->
					<h3>선박 부품 매물입니다.</h3><!-- 제목 -->
				</div>
				<div class="bottom">
					<div id="company_write">
						<ul class="box_list">
							<li>
								<div class="box_type">
									<em>매물유형</em>
									<div class="area_box"><p class="type"><i></i>선박</p></div>
								</div>
								<div class="box_type">
									<em>카테고리</em>
									<div class="area_box"><p class="type">FD/FC/Work Vessels</p></div>
								</div>
							</li>

							<!-- 매물유형 선박 -->
							<li>
								<ul class="area_box col02">
									<li>
										<span>Ship Type</span>
										<p>General Cargo Ship</p>
									</li> 
									<li>
										<span>Ship Name</span>
										<p>AAL TBN</p>
									</li>
									<li>
										<span>Capacity (Main)</span>
										<p></p>
									</li>
									<li>
										<span>Built Year</span>
										<p>2010</p>
									</li>
									<li>
										<span>Capacity (Sub)</span>
										<p></p>
									</li>
									<li>
										<span>Price Idea</span>
										<p></p>
									</li>
								</ul>
								<ul class="area_box nm">
									<li>
										<span>LOA (Meter)</span>
										<p>AAL TBN</p>
									</li> 
									<li>
										<span>Breadth (M)</span>
										<p>AAL TBN</p>
									</li>
									<li>
										<span>Depth (M)</span>
										<p>AAL TBN</p>
									</li>
								</ul>
								<ul class="area_box col02 nm">
									<li>
										<span>Class</span>
										<p>AAL TBN</p>
									</li> 
									<li>
										<span>Service Speed</span>
										<p>AAL TBN</p>
									</li>
									<li>
										<span>Ship Location</span>
										<p>AAL TBN</p>
									</li>
									<li>
										<span>Sell as Scrap</span>
										<p>YES</p>
									</li>
								</ul>
							</li>
							<!-- //매물유형 선박 -->

							<!-- 매물유형 기계장비
							<li>
								<ul class="area_box col02">
									<li>
										<span>Product Name</span>
										<p>General Cargo Ship</p>
									</li> 
									<li>
										<span>Maker</span>
										<p>AAL TBN</p>
									</li>
									<li>
										<span>Manufacture Year</span>
										<p>2010</p>
									</li>
									<li>
										<span>Model/Type</span>
										<p>AAL TBN</p>
									</li>
									<li>
										<span>Certificate/Approval</span>
										<p></p>
									</li>
									<li>
										<span>Condition</span>
										<p></p>
									</li>
									<li>
										<span>Quantity</span>
										<p></p>
									</li>
									<li>
										<span>Price Idea</span>
										<p></p>
									</li>
									<li>
										<span>Terms of Delivery</span>
										<p></p>
									</li>
									<li>
										<span>Terms of Payment</span>
										<p></p>
									</li>
									<li>
										<span>Your Guarantee</span>
										<p></p>
									</li>
									<li>
										<span>Located at</span>
										<p></p>
									</li>
								</ul>	
							</li>
							<!-- //매물유형 기계장비 -->

							<!-- 매물유형 부품, 물품 
							<li>
								<ul class="area_box col02">
									<li>
										<span>Maker</span>
										<p>AAL TBN</p>
									</li>
									<li>
										<span>Model/Type</span>
										<p>AAL TBN</p>
									</li>
									<li>
										<span>Certificate/Approval</span>
										<p></p>
									</li>
									<li>
										<span>Condition</span>
										<p></p>
									</li>
									<li>
										<span>Terms of Delivery</span>
										<p></p>
									</li>
									<li>
										<span>Terms of Payment</span>
										<p></p>
									</li>
									<li>
										<span>Located at</span>
										<p></p>
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
												<th>Unit Price (단가)</th>
												<th>Price (금액)</th>
												<th>Remark (비고)</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><span class="num">1</span></td>
												<td>O-RING, 30601-12H-2117 POS. 2117</td>
												<td>12</td>
												<td>12</td>
												<td>12</td>
												<td>20,000</td>
												<td>18,000</td>
												<td></td>
											</tr>
											<tr>
												<td><span class="num">2</span></td>
												<td><span>HYUNDAI HEAVY INDUSTIRES CO., LTD</span></td>
												<td><span>21567</span></td>
												<td><span>6L23/30H</span></td>
												<td><span>N/A</span></td>
												<td>20,000</td>
												<td>$500,000 ~ $1million</td>
												<td>비고</td>
											</tr>
											<tr>
												<td><span class="num">3</span></td>
												<td><span>HYUNDAI HEAVY INDUSTIRES CO., LTD</span></td>
												<td><span>21567</span></td>
												<td><span>6L23/30H</span></td>
												<td><span>N/A</span></td>
												<td>20,000</td>
												<td>$500,000 ~ $1million</td>
												<td>비고</td>
											</tr>
										</tbody>
									</table>
								</div>
							
							</li>
							<!-- //매물유형 기계장비 -->

							<li>
								<em>Full Description (상세 설명)</em>
								<div class="area_box">
									<div class="area_txtarea">
										<p>
											선박엔진 부품을 수입하려고 합니다. <br>
											vane wheel 이라는 품목이구요 그냥 쇳덩이예요 한 3kg정도 나가는 <br>
											일단 이 물건을 EXW 조건으로 중국업체랑 컨텍했는데 부장님께서 수입시 들어가는 모든 비용을 뽑아 보라고 하세요 <br>
											전에 짜여진 곳에서만 수입업무를 보았지 신규발굴은 처음이거든요 . <br>
											이조건 이었을때 저희 쪽에서 고려해야 하는 사항이 어떤 것이 있나요 ?
										</p>
									</div>
								</div>
							</li>
							<li>
								<em>Photos</em>
								<div class="area_box">
								<ul class="file_list img">
									<li>										
										<a href="">
											<div class="area_img"><img src="<?php echo G5_IMG_URL ?>/img_photo.jpg"></div>
											<span>diselengine.pdf</span>
										</a>
									</li>
									<li>										
										<a href="">
											<div class="area_img"><img src="<?php echo G5_IMG_URL ?>/img_photo.jpg"></div>
											<span>diselengine.pdf</span>
										</a>
									</li>
									<li>										
										<a href="">
											<div class="area_img"><img src="<?php echo G5_IMG_URL ?>/img_photo.jpg"></div>
											<span>diselengine.pdf</span>
										</a>
									</li>
									<li>										
										<a href="">
											<div class="area_img"><img src="<?php echo G5_IMG_URL ?>/img_photo.jpg"></div>
											<span>diselengine.pdf</span>
										</a>
									</li>
								</ul>
							</li>
							<li>
								<em>Files</em>
								<div class="area_box">
								<ul class="file_list">
									<li><a href=""><span>diselengine.pdf</span></a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="info">
						<div class="list_info">
							<span class="id"><div class="profile"><img class="basic" src="<?php echo G5_IMG_URL ?>/img_smile.svg"></div>dragon123</span><!--아이디-->
							<span class="data">2021.05.21</span><!--등록일-->
							<span class="view">조회수 <em>14</em></span><!--조회수-->
						</div>	
					</div>	
				</div>	
			</div>
			<div class="area_btn v2 two">
				<ul class="btn_list">
					<li><a href="" class="btn_confirm chat">채팅으로 문의</a></li>
					<li><a href="" class="btn_confirm email">이메일로 문의</a></li>
				</ul>
			</div>
			<div class="area_btn"><a class="btn_list" href="<?=G5_BBS_URL?>/company_list.php"><span>목록</span><a></div>
		
		</div>
		<//?php include_once('./myinfo_company.php'); ?> 
	</div>
</div>

<div class="btn_write"><a data-toggle="modal" data-target="#listCS"></a></div>

</div>

<script>


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

</script>
	

<?
include_once('./_tail.php');
?>

