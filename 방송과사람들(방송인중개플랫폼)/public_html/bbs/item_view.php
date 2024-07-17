<?
include_once('./_common.php');
$g5['title'] = '상세뷰';
include_once('./_head.php');
$name = "item_view";

$idx = $_REQUEST['idx'];
$sql = "select * from new_item where i_idx = '{$idx}' ";
$view = sql_fetch($sql);
$mb = get_member_no($view["mb_no"]);
//이미지
$sql = "select * from g5_board_file where wr_id = '{$idx}' and (bo_table = 'main_img' or bo_table = 'sub_img') order by bf_idx desc";
$img_result = sql_query($sql);
$sub_img = [];
$main_img = [];
for ($i = 0;$img = sql_fetch_array($img_result);$i++){
    if ($img['bo_table'] == "sub_img") {
        $sub_img[] = $img;
    }else{
        $main_img[] = $img;
    }
}

//옵션
$view_option_arr = explode(',',$view['i_option_arr']);

//카테고리
$ctg_key = array_search($view['i_ctg'], array_column($main_ctg, 'code'))+1;
$ctg_name = $main_ctg[$ctg_key]['name'];

//취소및환불규정
$sql = "select * from new_cancel_rule where cr_category1 = '{$view["i_ctg"]}' ";
$popup_result = sql_fetch($sql);

//좋아요
$sql = "select count(*) cnt from new_heart where h_p_idx = {$view["i_idx"]} and mb_no = '{$member['mb_no']}' ";
$like_cnt = sql_fetch($sql)['cnt'];
?>
<style>
    @media screen and (max-width:1024px) {
        #nav_area{display: none;}
    }
</style>
<? if($name=="item_view") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="item_view">
<?}?>


	<div id="item_view" class="view">
		<div class="inr">
			<ul id="area_history">
				<li><a href="<?=G5_BBS_URL.'/item_list.php'?>">홈</a></li>
				<li><a href="<?=G5_BBS_URL.'/item_list.php?ctg='.$view['i_ctg']?>" class="current"><?=$ctg_name?></a></li>
			</ul>
			<div class="item_left">
				<div class="swiper-container gallery_top">
					<div class="swiper-wrapper">
                        <?php for ($i = 0; $i < count($main_img); $i++){ ?>
						<div class="swiper-slide"><img src="<?php echo G5_DATA_URL ?>/file/main_img/<?=$main_img[$i]['bf_file']?>"></div>
			            <?php } ?>
					</div>
					<div class="swiper-pagination"></div>
				</div>


				<div class="swiper-container gallery_thumbs">
					<div class="swiper-wrapper">
                        <?php for ($i = 0; $i < count($main_img); $i++){ ?>
                            <div class="swiper-slide"><img src="<?php echo G5_DATA_URL ?>/file/main_img/<?=$main_img[$i]['bf_file']?>"></div>
                        <?php } ?>
					</div>
				</div>
			</div>
			<div class="item_right">
				<div class="item_info">
					<i class="cate"><?=$ctg_name?></i>
					<h3 class="subject"><?=$view['i_title']?></h3>
					<div class="area_star">
						<div class="img_star v45">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
							<span></span>
						</div>
						<em>5.0</em>
						<span class="review">(0개 리뷰)</span>
					</div>
					<div class="price"><?=number_format($view["i_price"])?>원 </div>
				</div>
				<div class="company_info">
					<div class="profile_box">
						<div class="profile"><?php
                            $icon_file = G5_DATA_PATH.'/file/member/'.$mb['mb_no'].'.jpg';
                            if (file_exists($icon_file)) {
                                $icon_url = G5_URL.'/data/file/member/'.$mb['mb_no'].'.jpg';
                                echo '<img src="'.$icon_url.'" alt="">';
                            }else{
                                echo '<img src="'.G5_IMG_URL .'/img_smile.jpg">';
                            }
                            ?></div>
						<div class="profile_info" onclick="location.href='<?=G5_URL?>/bbs/profile_company.php?mb_no=<?=$mb['mb_no']?>'">
                            <h3><?=$mb['mb_nick']?></h3>

                            <?
                                $j = 0;
                                for($i=1; $i<7; $i++) {

                                if($mb['file'.$i] != "") $j++;

                                ?>


                            <?}?>

							<span>포트폴리오 <?=$j?>건</span>
						</div>
					</div>
					<ul class="list_info">
						<li>
							<span>총작업수</span>
							<h3>10건</h3>
						</li>
						<li>
							<span>만족도</span>
							<h3>98%</h3>
						</li>
						<li>
							<span>평균응답시간</span>
							<h3>
                                <? if($mb['re_time'] == "1") echo "30분 이내";
                                    else if($mb['re_time'] == "2") echo "1시간 이내";
                                    else echo "1시간 이상";
                                ?>
							</h3>
						</li>
					</ul>
                    <!--자기소개글-->
                    <p class="pf_produce"><?=$mb['mb_about']?></p>
					<a href="javascript:chatting('<?=$mb['mb_id']?>',<?=$view['i_idx']?>)" class="btn_cs">전문가에게 문의하기</a>
				</div>
				<div id="area_btn">
					<a href="javascript:chatting('<?=$mb['mb_id']?>',<?=$view['i_idx']?>)" class="btn_cs">문의</a>
					<div class="box_btn"><a href="javascript:order_submit()">구매하기</a></div>
					<!-- 찜하기 눌렀을 때 class="on"추가 -->
					<div class="icon_jjim  <?php if ($like_cnt > 0) echo "on" ?>" onClick="heart_click(<?=$view['i_idx']?>,this)"></div>
				</div>
			</div>
			<div class="item_left">
				<div class="area_tab">
					<nav class="lnb">
						<div class="inr">
							<ul>
								<li><a class="active" href="#area_service">서비스설명</a></li>
								<li><a href="#area_price">가격정보</a></li>
								<li><a href="#area_edit">수정·재진행</a></li>
								<li><a href="#area_cancel">취소·환불 규정</a></li>
								<li><a href="#area_review">서비스평가</a></li>
							</ul>
						</div>
					</nav>
					<div class="tab_cont">
						<section id="area_service">
							<h3>서비스설명</h3>
                                <?=$view['i_content']?>
						</section>
						<section id="area_price">
							<h3>가격정보</h3>
							<div class="box">
								<h4 class="title"><?=$view['i_price_title']?></h4> <!-- 상품제목 -->
								<p><?=$view['i_price_content']?></p> <!-- 상품설명 -->
							</div>
							<ul class="list_chk">
                                <?php for ($i = 0; $i < count($view_option_arr); $i++){ ?>
								    <li><?=$option_arr[$view['i_ctg']][$view_option_arr[$i]]?></li>
                                <?php } ?>
							</ul>
							<ul class="list_box">
								<li>작업일 <?=$view['i_work_date']?>일</li>
								<li>수정 횟수 <?=$view['i_update_cnt']?>일</li>
							</ul>
						</section>
						<section id="area_edit">
							<h3>수정·재진행</h3>
							<div class="box">
                                <?=$view['i_update_content']?>
							</div>
						</section>
						<section id="area_cancel">
							<h3>취소 및 환불 규정</h3>
							<div class="box" style="white-space: pre-wrap;"><?= isset($popup_result['cr_content']) ? $popup_result['cr_content']: "등록안됨";?></div>

                            <!-- 여기서 부터 상세이미지-->
                            <div class="area_detail_img">
                                <?php for ($i = 0; $i < count($sub_img); $i++){ ?>
                                <div class="img_box"><img src="<?php echo G5_DATA_URL ?>/file/sub_img/<?=$sub_img[$i]['bf_file']?>"></div>
                                <?php } ?>
                            </div>

                        </section>
						<section id="area_review">
							<h3>서비스 평가</h3>
							<div class="box">
								<div class="review_total">
									<h3>5.0</h3>
									<div class="area_star">
										<div class="img_star v45">
											<span></span>
											<span></span>
											<span></span>
											<span></span>
											<span></span>
										</div>
									<span class="review">3개 리뷰</span>
									</div>
								</div>
								<ul class="review_list">
									<li>
										<div class="title">
											<div class="profile"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_user01.jpg"></div>										
											<div class="profile_info">
												<h4>김**</h4><!-- 이름 -->	
												<div class="area_star">
													<div class="img_star v45">
														<span></span>
														<span></span>
														<span></span>
														<span></span>
														<span></span>
													</div>
													<em>5.0</em>
													<span class="data">21.09.15</span>
												</div>
											</div>
										</div>
										<div class="cont">
										항상 믿고 쓰는 전문가님 항상 감사드립니다	
										</div>
									</li>
									<li>
										<div class="title">
											<div class="profile"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_user03.jpg"></div>										
											<div class="profile_info">
												<h4>k**</h4><!-- 이름 -->	
												<div class="area_star">
													<div class="img_star v45">
														<span></span>
														<span></span>
														<span></span>
														<span></span>
														<span></span>
													</div>
													<em>5.0</em>
													<span class="data">21.09.15</span>
												</div>
											</div>
										</div>
										<div class="cont">
										꼼꼼히 확인하시고 좋은 결과물 만들어주십니다~
										</div>
									</li>
									<li>
										<div class="title">
											<div class="profile"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_user02.jpg"></div>										
											<div class="profile_info">
												<h4>k**</h4><!-- 이름 -->	
												<div class="area_star">
													<div class="img_star v45">
														<span></span>
														<span></span>
														<span></span>
														<span></span>
														<span></span>
													</div>
													<em>5.0</em>
													<span class="data">21.09.15</span>
												</div>
											</div>
										</div>
										<div class="cont">
										항상 믿고 쓰는 전문가님 항상 감사드립니다
										</div>
									</li>
									<li>
										<div class="title">
											<div class="profile"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_user01.jpg"></div>										
											<div class="profile_info">
												<h4>김**</h4><!-- 이름 -->	
												<div class="area_star">
													<div class="img_star v45">
														<span></span>
														<span></span>
														<span></span>
														<span></span>
														<span></span>
													</div>
													<em>5.0</em>
													<span class="data">21.09.15</span>
												</div>
											</div>
										</div>
										<div class="cont">
										항상 믿고 쓰는 전문가님 항상 감사드립니다	
										</div>
									</li>
									<li>
										<div class="title">
											<div class="profile"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_user03.jpg"></div>										
											<div class="profile_info">
												<h4>k**</h4><!-- 이름 -->	
												<div class="area_star">
													<div class="img_star v45">
														<span></span>
														<span></span>
														<span></span>
														<span></span>
														<span></span>
													</div>
													<em>5.0</em>
													<span class="data">21.09.15</span>
												</div>
											</div>
										</div>
										<div class="cont">
										꼼꼼히 확인하시고 좋은 결과물 만들어주십니다~
										</div>
									</li>
								</ul>
								<div class="btn_more"><span>더보기</span></div>
							</div>
						</section>
					</div>
				</div>
			</div>
			
		</div>
	</div>

    <form style="display: none" method="post" action="./order.php" id="orderfrm">
        <input type="hidden" name="i_idx" value="<?=$idx?>">
    </form>
<!--채팅-->
<form id="fchatting" name="fchatting" method="post" action="./chat.php">
    <input type="hidden" name="inquiry_idx" id="inquiry_idx" value="<?=$idx?>">
    <input type="hidden" name="you_mb_id" id="you_mb_id" value="">
</form>


<?php
include_once('./_tail.php');
?>


<script>


 var swiper = new Swiper(".gallery_thumbs", {
	spaceBetween: 10,
	slidesPerView: 4,
	freeMode: true,
	watchSlidesProgress: true,
  });
  var swiper2 = new Swiper(".gallery_top", {
	loop:true,
	autoplay: {
	  delay: 6000,
	  disableOnInteraction: false,
	},
	pagination: {
	  el: ".swiper-pagination",
	  type: "fraction",
	},
	thumbs: {
	  swiper: swiper,
	},

  });
  
  function order_submit() {
      $('#orderfrm').submit();
  }

 function chatting(you_mb_id, idx) {
     if(you_mb_id != '' && you_mb_id != undefined) {
         $('#you_mb_id').val(you_mb_id);
     }
     if(idx != '' && idx != undefined) { // 기업의뢰 채팅 시
         $('#inquiry_idx').val(idx);
     }
     $('#fchatting').submit();
 }


</script>
