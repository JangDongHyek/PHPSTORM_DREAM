<?
include_once('./_common.php');

$g5['title'] = '매물올리기';
include_once('./_head.php');

?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">
<?php include_once('./category_modal.php'); ?>

<style>
	#ft_menu{display:none;}
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
					<div class="box_sch">
						<form name="fsearchbox">
						  <input type="text" placeholder="검색하기" name="search">
						  <button type="submit"></button>
						</form>
					</div>
					<ul id="sort_list" class="cate_list">
						<!-- 카테고리에서 General Cargo 선택했을 때 나오는 리스트 -->	
						<li class="active">General Cargo Ship</li>
						<li><span>Container</span></li>
						<li><span>MPP</span></li>
						<li><span>Ro-Ro Ship</span></li>
						<li><span>Cement Carrier</span></li>
						<li><span>Sand Carrier</span></li>
						<li><span>Reefer Cargo Vessel</span></li>

						<!-- 카테고리에서 Bulk Carriers 선택했을 때 나오는 리스트 -->	
						<li class="active">Bulk Carrier</li>
						<li><span>VLBC/VLOC</span></li>
						
						<!-- 카테고리에서 Oil/Gas Carriers 선택했을 때 나오는 리스트 -->	
						<li class="active">Product Tanker</li>
						<li><span>Chemical Tanker</span></li>
						<li><span>LPG Carrier</span></li>
						<li><span>LNG Carrier</span></li>
						<li><span>Bitumen Tanker</span></li>
						<li><span>Waste Carrier</span></li>
						<li><span>VLCC/ULCC</span></li>
						<li><span>Non-Propelled Tanker Barge</span></li>

						<!-- 카테고리에서 Tugs/Barges 선택했을 때 나오는 리스트 -->	
						<li class="active">Tug boat</li>
						<li><span>Deck/Flat Barge</span></li>
						<li><span>Hold Barge</span></li>
						<li><span>Pusher + Barge</span></li>
						<li><span>Self Propelled Barge</span></li>
						<li><span>Accommodation Barge</span></li>

						<!-- 카테고리에서 Special/Offshore 선택했을 때 나오는 리스트 -->	
						<li class="active">Plant/Offshore Carrier</li>
						<li><span>Drilling Ship/Rig</span></li>
						<li><span>FPSO/FSO</span></li>
						<li><span>OSV/PSV/DSV</span></li>
						<li><span>AHTS</span></li>
						<li><span>Ice Breaker</span></li>
						<li><span>Research Ship</span></li>
						<li><span>Other Special Ship/Unit</span></li>

						<!-- 카테고리에서 Passenger Ships 선택했을 때 나오는 리스트 -->	
						<li class="active">Ferry</li>
						<li><span>Ro-Pax</span></li>
						<li><span>Landing Craft</span></li>
						<li><span>Cruise Ship</span></li>
						<li><span>Floating Hotel</span></li>
						<li><span>Other Passenger Ship</span></li>

						<!-- 카테고리에서 Fishing Vessels 선택했을 때 나오는 리스트 -->	
						<li class="active">Trawler</li>
						<li><span>Long Liner</span></li>
						<li><span>Purse Seiner</span></li>
						<li><span>Fish Carrier</span></li>
						<li><span>Gill Netter</span></li>
						<li><span>Catcher Boat</span></li>
						<li><span>Factory Ship</span></li>
						<li><span>Other Fishing Vessel</span></li>

						<!-- 카테고리에서 Yachat/Boat 선택했을 때 나오는 리스트 -->	
						<li class="active">Yachat</li>
						<li><span>Fishing Boat</span></li>
						<li><span>Pleasure Boat</span></li>
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
					<div class="box_sch">
						<form name="fsearchbox">
						  <input type="text" placeholder="검색하기" name="search">
						  <button type="submit"></button>
						</form>
					</div>
					<ul id="sort_list" class="cate_list">
						<li class="active">General Cargo</li>
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
					<div class="box_sch">
						<form name="fsearchbox">
						  <input type="text" placeholder="검색하기" name="search">
						  <button type="submit"></button>
						</form>
					</div>
					<ul id="sort_list" class="cate_list">
						<li class="active">Engine</li>
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
					<div class="box_sch">
						<form name="fsearchbox">
						  <input type="text" placeholder="검색하기" name="search">
						  <button type="submit"></button>
						</form>
					</div>
					<ul id="sort_list" class="cate_list">
						<li class="active">Engine</li>
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
	<div class="inr v3">
		<h2 class="title">매물올리기</h2>	
		<div id="company_write">
			<ul class="box_list">
				<li>
					<em>매물유형</em>
					<ul class="area_filter">
						<li>
							<input type="checkbox" id="open" <?php echo $w == '' ? 'checked' : '' ?> name="he_open" value="open" <?php echo $help['he_open'] == 'open' ? 'checked' : ''; ?> onclick="checkOnlyOne(this);">
							<label for="open">
								<span></span>
								<em>선박</em>
							</label>
						</li>
						<li>
							<input type="checkbox" id="private" name="he_open" value="private" <?php echo $help['he_open'] == 'private' ? 'checked' : ''; ?> onclick="checkOnlyOne(this);">
							<label for="private">
								<span></span>
								<em>기계장비</em>
							</label>
						</li>
						 <li>
							<input type="checkbox" id="open" name="he_open" value="open" <?php echo $help['he_open'] == 'open' ? 'checked' : ''; ?> onclick="checkOnlyOne(this);">
							<label for="open">
								<span></span>
								<em>부품/물품</em>
							</label>
						</li>
                      </ul>
				</li>
				<li>
					<em>카테고리</em>
					<div class="area_box">
					
					<!-- 선박카테고리-->
					<div class="mbox_cate filter"> 
					<!--<div class="mbox_cate select"> 필터 체크 했을대 select클래스 추가-->
						<span data-toggle="modal" data-target="#cateModal_sale"><i></i>CATEGORY</span>
					</div>

					<!-- 기계장비 카테고리
					<div class="mbox_cate filter"> 
						<span data-toggle="modal" data-target="#cateModal_sale02"><i></i>CATEGORY</span>
					</div>
					<!-- 기계장비 카테고리-->

					<!-- 부품/물품 카테고리
					<div class="mbox_cate filter"> 
						<span data-toggle="modal" data-target="#cateModal_sale03"><i></i>CATEGORY</span>
					</div>
					<!-- 부품/물품 카테고리-->

					</div>
				</li>
				<li>
					<em>제목</em>
					<div class="area_box">
						<input type="text" class="input_subject">	
					</div>
				</li>

				<!-- 매물유형 선박 -->
				<li>
					<ul class="area_box col02">
						<li>
							<span>Ship Type</span>
							<!-- 기업의뢰 필터-->
							<div class="mbox_cate filter"> 
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
							<input type="text">	
						</li>
						<li class="double">
							<span>Capacity (Main)</span>
							<div class="input_wrap">
								<input type="text">
								<select>
									<option value="1">DWT</option>
									<option value="1">GRT</option>
									<option value="1">TEU</option>
									<option value="1">PAX</option>
									<option value="1">BHP</option>
								</select>
							</div>
						</li>
						<li>
							<span>Built Year</span>
							<input type="text">	
						</li>
						<li class="double">
							<span>Capacity (Sub)</span>
							<div class="input_wrap">
								<input type="text">
								<select>
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
								<input type="text">	
								<select>
									<option value="1">million$</option>
									<option value="1">억원</option>
								</select>
							</div>
						</li>
					</ul>
					<ul class="area_box col03">
						<li>
							<span>LOA (Meter)</span>
							<input type="text">	
						</li>
						<li>
							<span>Breadth (M)</span>
							<input type="text">	
						</li>
						<li>
							<span>Depth (M)</span>
							<input type="text">	
						</li>
					</ul> 
					<ul class="area_box col02 last">
						<li>
							<span>Class</span>
							<input type="text">	
						</li>
						<li>
							<span>Service Speed</span>
							<input type="text">	
						</li>
						<li>
							<span>Ship Location</span>
							<input type="text">	
						</li>
						<li>
							<span>Sell as Scrap</span>
							<div class="input type">
								<label class="selector">
									<input type="radio" id="mb_sex" name="mb_sex" value="YES" checked>
									<span>YES</span>
								</label>
									<label class="selector">
									<input type="radio" id="mb_sex" name="mb_sex" value="NO" >
									<span>NO</span>
								</label>
							</div>
						</li>
					</ul>
				</li>					
				<!-- 매물유형 선박 -->


				<!-- 매물유형 기계장비 
				<li>
					<ul class="area_box col02">
						<li>
							<span>Product Name</span>
							<input type="text">	
						</li>
						<li>
							<span>Maker</span>
							<input type="text">	
						</li>
						<li>
							<span>Manufacture Year</span>
							<input type="text">	
						</li>
						<li>
							<span>Model/Type</span>
							<input type="text">	
						</li>
						<li>
							<span>Certificate/Approval</span>
							<input type="text">	
						</li>
						<li>
							<span>Condition</span>
							<input type="text">	
						</li>
						<li class="double">
							<span>Quantity</span>
							<div class="input_wrap">
								<input type="text">
								<select>
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
								<input type="text">	
								<select>
									<option value="1">$</option>
									<option value="1">천원</option>
								</select>
							</div>
						</li>
						<li>
							<span>Terms of Delivery</span>
							<input type="text">	
						</li>
						<li>
							<span>Terms of Payment</span>
							<input type="text">	
						</li>
						<li>
							<span>Your Guarantee</span>
							<input type="text">	
						</li>
						<li>
							<span>Located at</span>
							<input type="text">	
						</li>
					</ul>
									
				</li>					
				<!-- 매물유형 기계 장비 -->


				<!-- 매물유형 부품, 물품 
				<li>
					<ul class="area_box col02">
						<li>
							<span>Maker</span>
							<input type="text">	
						</li>
						<li>
							<span>Model/Type</span>
							<input type="text">	
						</li>
						<li>
							<span>Certificate/Approval</span>
							<input type="text">	
						</li>
						<li>
							<span>Condition</span>
							<input type="text">	
						</li>
						<li>
							<span>Terms of Delivery</span>
							<input type="text">	
						</li>
						<li>
							<span>Terms of Payment</span>
							<input type="text">	
						</li>
						<li>
							<span>Located at</span>
							<input type="text">	
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
									<th colspan="2">Remark (비고)</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><span class="num">1</span></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"><button type="button" class="btn_close"></button></td>
								</tr>
								<tr>
									<td><span class="num">2</span></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"><button type="button" class="btn_close"></button></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="box_btn"><a href="" class="btn_add">부품추가하기</a></div>
				</li>					
				<!-- 매물유형 부품, 물품 -->
		



				<li>
					<em>Full Description (상세 설명)</em>
					<div class="area_box">
						<textarea></textarea>
					</div>
				</li>
				<li>
					<em>Photos</em>
					<div class="area_box">
						<div class="img_wrap">
						
						</div>
					</div>
				</li>
				<li>
					<em>Files</em>
					<div class="area_box">
						<div class="img_wrap">
						
						</div>
					</div>
				</li>
			</ul>
		</div>

		<div class="w_filter">
			<h3>공개 범위</h3>
			<ul class="area_filter">
				<li>
					<input type="checkbox" id="open" <?php echo $w == '' ? 'checked' : '' ?> name="he_open" value="open" <?php echo $help['he_open'] == 'open' ? 'checked' : ''; ?> onclick="checkOnlyOne(this);">
					<label for="open">
						<span></span>
						<em>국내</em>
					</label>
				</li>
				<li>
					<input type="checkbox" id="private" name="he_open" value="private" <?php echo $help['he_open'] == 'private' ? 'checked' : ''; ?> onclick="checkOnlyOne(this);">
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
		</div>

		<div class="area_btn two">
			<ul class="btn_list">
			<li><button type="button" class="btn_cancle">취소하기</button></li>
			<li><button type="button" class="btn_confirm">매물올리기</button></li>
		</ul>
		</div>
	</div>
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

$(function(){
	$('.area_filter > li label em i').on('click',function(){
		$(this).toggleClass('active');
		$('.area_filter .area_info').toggleClass('active');
		return false;
	});
});


</script>

<?
include_once('./_tail.php');
?>