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
                <!--공유하기버튼--><a class="btn_share"><i class="fa-regular fa-share-nodes"></i></a>
			</div>
			<div class="item_right">
				<div class="item_info">
					<i class="cate"><?=$ctg_name?></i>
					<h3 class="subject"><?=$view['i_title']?></h3>
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
                            <div class="profile_info" onclick="location.href='<?=G5_URL?>/bbs/profile.php?mb_no=<?=$mb['mb_no']?>'">
                                <h3><?=$mb['mb_nick']?></h3>

                                <?
                                $j = 0;
                                for($i=1; $i<7; $i++) {

                                    if($mb['file'.$i] != "") $j++;

                                    ?>


                                <?}?>

                                <!--<span>포트폴리오 <?/*=$j*/?>건</span>-->
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
                            </div>
                        </div>
                        <ul class="list_info">
                            <li>
                                <span>거래건수</span>
                                <h3>10건</h3>
                            </li>
                            <li>
                                <span>만족도</span>
                                <h3>98%</h3>
                            </li>
                            <li>
                                <span>회원구분</span>
                                <h3>
                                    개인
                                </h3>
                            </li>
                            <!--<li>
                                <span>평균응답시간</span>
                                <h3>
                                    <?/* if($mb['re_time'] == "1") echo "30분 이내";
                                    else if($mb['re_time'] == "2") echo "1시간 이내";
                                    else echo "1시간 이상";
                                    */?>
                                </h3>
                            </li>-->
                        </ul>
                        <!--자기소개글-->
                        <p class="pf_produce"><?=$mb['mb_about']?></p>
                        <a href="javascript:chatting('<?=$mb['mb_id']?>',<?=$view['i_idx']?>)" class="btn_cs">전문가에게 문의하기</a>
                    </div>
                    <br>
                    <div class="price_info">
                        <div role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#price1" aria-controls="price1" role="tab" data-toggle="tab" aria-expanded="true">STANDARD</a>
                                </li>
                                <li role="presentation">
                                    <a href="#price2" aria-controls="price2" role="tab" data-toggle="tab" aria-expanded="false">DELUXE</a>
                                </li>
                                <li role="presentation">
                                    <a href="#price3" aria-controls="price3" role="tab" data-toggle="tab" aria-expanded="false">PREMIUM</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="price1">
                                    <div class="price"><?=number_format($view["i_price"])?>원 </div>
                                    <div class="price_detail">
                                        <strong class="title">원데이 촬영</strong><br>
                                        <div class="conts">
                                            사진촬영/영상 촬영 (룩북, 피팅, 영상광고, 화보 등)
                                        </div>
                                        <div class="box_gray">
                                            <dt>작업기간</dt> <dd><?=$view['i_work_date']?>일</dd>
                                            <dt>수정횟수</dt> <dd><?=$view['i_update_cnt']?>회</dd>
                                            <dt>추가옵션</dt> <dd>서울/경기 외 타지 촬영 집결 가능</dd>
                                            <span class="line"></span>
                                            <dt>세금계산서 발행</dt> <dd>가능</dd>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="price2">
                                    <div class="price"><?=number_format($view["i_price"])?>원 </div>
                                    <div class="price_detail">
                                        <div class="conts">
                                            <strong>1박2일 촬영</strong><br>
                                            사진촬영/영상 촬영 (룩북, 피팅, 영상광고, 화보 등)
                                        </div>
                                        <div class="box_gray">
                                            <dt>작업기간</dt> <dd>2일</dd>
                                            <dt>수정횟수</dt> <dd>0회</dd>
                                            <dt>추가옵션</dt> <dd>서울/경기 외 타지 촬영 집결 가능</dd>
                                            <span class="line"></span>
                                            <dt>세금계산서 발행</dt> <dd>가능</dd>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="price3">
                                    <div class="price"><?=number_format($view["i_price"])?>원 </div>
                                    <div class="price_detail">
                                        <div class="conts">
                                            <strong>2박 3일 촬영</strong><br>
                                            사진촬영/영상 촬영 (룩북, 피팅, 영상광고, 화보 등)
                                        </div>
                                        <div class="box_gray">
                                            <dt>작업기간</dt> <dd>3일</dd>
                                            <dt>수정횟수</dt> <dd>0회</dd>
                                            <dt>추가옵션</dt> <dd>서울/경기 외 타지 촬영 집결 가능</dd>
                                            <span class="line"></span>
                                            <dt>세금계산서 발행</dt> <dd>가능</dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
				<div id="area_btn">
                    <!-- 찜하기 눌렀을 때 class="on"추가 -->
                    <div class="icon_jjim  <?php if ($like_cnt > 0) echo "on" ?>" onClick="heart_click(<?=$view['i_idx']?>,this)"></div>
					<a href="javascript:chatting('<?=$mb['mb_id']?>',<?=$view['i_idx']?>)" class="btn_cs">문의하기</a>
					<div class="box_btn"><a href="javascript:order_submit()">구매하기</a></div>
				</div>
			</div>
			<div class="item_left">
				<div class="area_tab">
					<nav class="lnb">
						<div class="inr">
							<ul>
								<li><a class="active" href="#area_service">서비스설명</a></li>
                                <li><a href="#faq">자주찾는 질문</a></li>
								<!--<li><a href="#area_price">가격정보</a></li>-->
								<!--<li><a href="#area_edit">수정·재진행</a></li>-->
								<li><a href="#area_cancel">취소·환불 규정</a></li>
                                <li><a href="#area_info">상품정보고시</a></li>
								<li><a href="#area_review">서비스평가</a></li>
							</ul>
						</div>
					</nav>
					<div class="tab_cont">
						<section id="area_service">
							<h3>서비스설명</h3>
                            <div class="embed-container">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/E3XJMpatHec?si=Y8OWyofAe7v5Fvns" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                                <!-- 여기서 부터 상세이미지-->
                                <div class="area_detail_img">
                                    <?php for ($i = 0; $i < count($sub_img); $i++){ ?>
                                        <div class="img_box"><img src="<?php echo G5_DATA_URL ?>/file/sub_img/<?=$sub_img[$i]['bf_file']?>"></div>
                                    <?php } ?>
                                </div>
                                <br>
                                <!--서비스 추가 옵션-->
                                <dl class="service_option">
                                    <dt>성별</dt>
                                    <dd>남자</dd>
                                    <dt>연령</dt>
                                    <dd>20~30대</dd>
                                    <dt>지역</dt>
                                    <dd>국내 전체</dd>
                                    <dt>주말 작업</dt>
                                    <dd>가능</dd>
                                    <dt>작업 유형</dt>
                                    <dd>피팅, 패션, 주얼리, 광고</dd>
                                </dl>
                                <?=$view['i_content']?>
                                <br>
                                <!--서비스 안내-->
                                <div class="sevice_info">
                                    <strong>[서비스 안내]</strong>
                                    <span>서비스 제공 시간, 참여 역할, 출장비 등의 제반 사항에 따라 서비스 비용이 상이할 수 있으니 구체적으로 상담 후, 구매 부탁드립니다.</span>
                                    <span>모든 거래는 방송과 사람들 규정에 따라 안전 결제 시스템을 이용한 선결제로 진행됩니다.</span>
                                </div>
						</section>
                        <section id="faq">
                            <h3>자주찾는 질문</h3>
                            <div class="box_gray">
                                <dl>
                                    <dt>Q. 1시간 촬영도 가능한가요?</dt>
                                    <dd>A. 네 가능해요!</dd>
                                </dl>
                                <dl>
                                    <dt>Q. 함께 할 다른 모델, 사진 작가 ,헤메 실장, 스튜디오 추천 가능한가요?</dt>
                                    <dd>A. 네 가능해요!</dd>
                                </dl>
                            </div>
                        </section>
						<section id="area_cancel">
							<h3>취소 및 환불 규정</h3>
							<div class="box" style="white-space: pre-wrap;"><?= isset($popup_result['cr_content']) ? $popup_result['cr_content']: "등록안됨";?></div>
                        </section>
                        <section id="area_info">
                            <h3>상품정보고시</h3>
                            <dl class="box_gray">
                                <dt>서비스제공자</dt>
                                <dd>blankxx <a class="btn">상세 정보 보기</a></dd>
                                <dt>취소·환불 조건</dt>
                                <dd>취소 및 환불 규정 참조</dd>
                                <dt>인증·허가사항</dt>
                                <dd>상품 상세 참조</dd>
                                <dt>취소·환불방법</dt>
                                <dd>취소 및 환불 규정 참조</dd>
                                <dt>이용조건</dt>
                                <dd>상품 상세 참조</dd>
                                <dt>소비자 상담전화</dt>
                                <dd>(고객센터)1234-1234</dd>
                            </dl>

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
                                    <dl class="box_gray">
                                        <dt>결과물 만족도</dt>
                                        <dd><strong>5.0</strong></dd>
                                        <dt>친절한 상담</dt>
                                        <dd><strong>4.5</strong></dd>
                                        <dt>신속한 대응</dt>
                                        <dd><strong>3.0</strong></dd>
                                    </dl>
                                    <script>
                                        //상세평가 막대
                                        document.addEventListener("DOMContentLoaded", function() {
                                            const items = document.querySelectorAll("dd strong");

                                            items.forEach(item => {
                                                const rating = parseFloat(item.textContent);
                                                const progressBar = document.createElement("div");
                                                progressBar.className = "progress-bar";
                                                const progressBarInner = document.createElement("div");
                                                progressBarInner.className = "progress-bar-inner";
                                                progressBarInner.style.width = (rating / 5 * 100) + "%";
                                                progressBar.appendChild(progressBarInner);
                                                item.parentNode.insertBefore(progressBar, item);
                                            });
                                        });
                                    </script>
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
                                        <div class="order_info"><span>작업일 : 24시간 이내</span><span>주문금액 : 20 ~ 30만원</span></div>
										<div class="cont" id="content">
                                            저는 최근에 중요한 가족 행사를 맞아 전문가님께 사진 촬영을 의뢰했습니다. 솔직히 말해서, 결과물에 대해 기대가 컸는데, 그 기대를 훨씬 뛰어넘는 경험이었습니다.

                                            우선, 촬영 당일 전문가님께서는 촬영 장소에 일찍 도착하여 모든 장비를 세팅하고 준비해 주셨습니다. 이는 그분의 철저한 준비성과 전문성을 단적으로 보여주었습니다. 또한, 촬영 내내 편안하고 자연스러운 분위기를 만들어 주셔서 저희 가족 모두가 긴장하지 않고 즐겁게 촬영에 임할 수 있었습니다.
										</div>
                                        <div class="button" id="toggleButton" onclick="toggleContent()">더보기</div>
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
                                        <div class="order_info"><span>작업일 : 24시간 이내</span><span>주문금액 : 20 ~ 30만원</span></div>
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
                                        <div class="order_info"><span>작업일 : 24시간 이내</span><span>주문금액 : 20 ~ 30만원</span></div>
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
                                        <div class="order_info"><span>작업일 : 24시간 이내</span><span>주문금액 : 20 ~ 30만원</span></div>
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
                                        <div class="order_info"><span>작업일 : 24시간 이내</span><span>주문금액 : 20 ~ 30만원</span></div>
										<div class="cont">
										꼼꼼히 확인하시고 좋은 결과물 만들어주십니다~
										</div>
									</li>
								</ul>
								<div class="btn_more"><span>더보기</span></div>
							</div>
						</section>
                        <script>
                            //리뷰 문장더보기
                            function toggleContent() {
                                var content = document.getElementById("content");
                                var button = document.getElementById("toggleButton");

                                if (content.classList.contains("expanded")) {
                                    content.classList.remove("expanded");
                                    button.textContent = "더보기";
                                } else {
                                    content.classList.add("expanded");
                                    button.textContent = "접기";
                                }
                            }
                        </script>


                        <!--<section id="area_price">
                            <h3>가격정보</h3>
                            <div class="box">
                                <h4 class="title"><?/*=$view['i_price_title']*/?></h4> 
                                <p><?/*=$view['i_price_content']*/?></p> 
                            </div>
                            <ul class="list_chk">
                                <?php /*for ($i = 0; $i < count($view_option_arr); $i++){ */?>
                                    <li><?/*=$option_arr[$view['i_ctg']][$view_option_arr[$i]]*/?></li>
                                <?php /*} */?>
                            </ul>
                            <ul class="list_box">
                                <li>작업일 <?/*=$view['i_work_date']*/?>일</li>
                                <li>수정 횟수 <?/*=$view['i_update_cnt']*/?>일</li>
                            </ul>
                        </section>
                        <section id="area_edit">
                            <h3>수정·재진행</h3>
                            <div class="box">
                                <?/*=$view['i_update_content']*/?>
                            </div>
                        </section>-->
                    </div>

                    <div class="area_ft_list">
                    <!--포트폴리오-->
                        <div>
                            <h3>포트폴리오</h3>
                            <div class="swiper ftSwiper">
                                <ul id="product_list" class="swiper-wrapper">
                                    <li class="swiper-slide">
                                    <i class="heart " onclick="heart_click(15,this)"></i>
                                    <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">

                                            <span></span><!-- 업체명 -->
                                            <h3>영상제작</h3> <!-- 제목 -->
                                            <div class="price">50,000원 </div> <!-- 가격 -->
                                            <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                        </div>

                                    </a>
                                    </li>
                                    <li class="swiper-slide">
                                        <i class="heart " onclick="heart_click(15,this)"></i>
                                        <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                            <div class="area_img">
                                                <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                            </div>
                                            <div class="area_txt">

                                                <span></span><!-- 업체명 -->
                                                <h3>영상제작</h3> <!-- 제목 -->
                                                <div class="price">50,000원 </div> <!-- 가격 -->
                                                <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                            </div>

                                        </a>
                                    </li>
                                    <li class="swiper-slide">
                                        <i class="heart " onclick="heart_click(15,this)"></i>
                                        <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                            <div class="area_img">
                                                <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                            </div>
                                            <div class="area_txt">

                                                <span></span><!-- 업체명 -->
                                                <h3>영상제작</h3> <!-- 제목 -->
                                                <div class="price">50,000원 </div> <!-- 가격 -->
                                                <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                            </div>

                                        </a>
                                    </li>
                                    <li class="swiper-slide">
                                        <i class="heart " onclick="heart_click(15,this)"></i>
                                        <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                            <div class="area_img">
                                                <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                            </div>
                                            <div class="area_txt">

                                                <span></span><!-- 업체명 -->
                                                <h3>영상제작</h3> <!-- 제목 -->
                                                <div class="price">50,000원 </div> <!-- 가격 -->
                                                <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                            </div>

                                        </a>
                                    </li>
                                    <li class="swiper-slide">
                                        <i class="heart " onclick="heart_click(15,this)"></i>
                                        <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                            <div class="area_img">
                                                <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                            </div>
                                            <div class="area_txt">

                                                <span></span><!-- 업체명 -->
                                                <h3>영상제작</h3> <!-- 제목 -->
                                                <div class="price">50,000원 </div> <!-- 가격 -->
                                                <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                            </div>

                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <!--관련 인기 상품-->
                        <div>
                            <h3>관련 인기 상품</h3>
                            <div class="swiper ftSwiper">
                                <ul id="product_list" class="swiper-wrapper">
                                    <li class="swiper-slide">
                                        <i class="heart " onclick="heart_click(15,this)"></i>
                                        <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                            <div class="area_img">
                                                <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                            </div>
                                            <div class="area_txt">

                                                <span></span><!-- 업체명 -->
                                                <h3>영상제작</h3> <!-- 제목 -->
                                                <div class="price">50,000원 </div> <!-- 가격 -->
                                                <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                            </div>

                                        </a>
                                    </li>
                                    <li class="swiper-slide">
                                        <i class="heart " onclick="heart_click(15,this)"></i>
                                        <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                            <div class="area_img">
                                                <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                            </div>
                                            <div class="area_txt">

                                                <span></span><!-- 업체명 -->
                                                <h3>영상제작</h3> <!-- 제목 -->
                                                <div class="price">50,000원 </div> <!-- 가격 -->
                                                <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                            </div>

                                        </a>
                                    </li>
                                    <li class="swiper-slide">
                                        <i class="heart " onclick="heart_click(15,this)"></i>
                                        <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                            <div class="area_img">
                                                <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                            </div>
                                            <div class="area_txt">

                                                <span></span><!-- 업체명 -->
                                                <h3>영상제작</h3> <!-- 제목 -->
                                                <div class="price">50,000원 </div> <!-- 가격 -->
                                                <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                            </div>

                                        </a>
                                    </li>
                                    <li class="swiper-slide">
                                        <i class="heart " onclick="heart_click(15,this)"></i>
                                        <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                            <div class="area_img">
                                                <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                            </div>
                                            <div class="area_txt">

                                                <span></span><!-- 업체명 -->
                                                <h3>영상제작</h3> <!-- 제목 -->
                                                <div class="price">50,000원 </div> <!-- 가격 -->
                                                <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                            </div>

                                        </a>
                                    </li>
                                    <li class="swiper-slide">
                                        <i class="heart " onclick="heart_click(15,this)"></i>
                                        <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                            <div class="area_img">
                                                <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                            </div>
                                            <div class="area_txt">

                                                <span></span><!-- 업체명 -->
                                                <h3>영상제작</h3> <!-- 제목 -->
                                                <div class="price">50,000원 </div> <!-- 가격 -->
                                                <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                            </div>

                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--최근 본 서비스-->
                        <div>
                            <h3>최근 본 서비스</h3>
                            <div class="swiper ftSwiper">
                                <ul id="product_list" class="swiper-wrapper">
                                    <li class="swiper-slide">
                                        <i class="heart " onclick="heart_click(15,this)"></i>
                                        <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                            <div class="area_img">
                                                <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                            </div>
                                            <div class="area_txt">

                                                <span></span><!-- 업체명 -->
                                                <h3>영상제작</h3> <!-- 제목 -->
                                                <div class="price">50,000원 </div> <!-- 가격 -->
                                                <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                            </div>

                                        </a>
                                    </li>
                                    <li class="swiper-slide">
                                        <i class="heart " onclick="heart_click(15,this)"></i>
                                        <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                            <div class="area_img">
                                                <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                            </div>
                                            <div class="area_txt">

                                                <span></span><!-- 업체명 -->
                                                <h3>영상제작</h3> <!-- 제목 -->
                                                <div class="price">50,000원 </div> <!-- 가격 -->
                                                <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                            </div>

                                        </a>
                                    </li>
                                    <li class="swiper-slide">
                                        <i class="heart " onclick="heart_click(15,this)"></i>
                                        <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                            <div class="area_img">
                                                <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                            </div>
                                            <div class="area_txt">

                                                <span></span><!-- 업체명 -->
                                                <h3>영상제작</h3> <!-- 제목 -->
                                                <div class="price">50,000원 </div> <!-- 가격 -->
                                                <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                            </div>

                                        </a>
                                    </li>
                                    <li class="swiper-slide">
                                        <i class="heart " onclick="heart_click(15,this)"></i>
                                        <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                            <div class="area_img">
                                                <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                            </div>
                                            <div class="area_txt">

                                                <span></span><!-- 업체명 -->
                                                <h3>영상제작</h3> <!-- 제목 -->
                                                <div class="price">50,000원 </div> <!-- 가격 -->
                                                <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                            </div>

                                        </a>
                                    </li>
                                    <li class="swiper-slide">
                                        <i class="heart " onclick="heart_click(15,this)"></i>
                                        <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                            <div class="area_img">
                                                <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                            </div>
                                            <div class="area_txt">

                                                <span></span><!-- 업체명 -->
                                                <h3>영상제작</h3> <!-- 제목 -->
                                                <div class="price">50,000원 </div> <!-- 가격 -->
                                                <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                            </div>

                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <script>
                        var swiper = new Swiper(".ftSwiper", {
                            slidesPerView: 2.5,
                            spaceBetween: 10,
                            grabCursor: true,
                            pagination: {
                                el: ".swiper-pagination",
                                clickable: true,
                            },
                            breakpoints: {
                                // 화면 너비가 1200px 이상일 때
                                1200: {
                                    slidesPerView: 3.5,
                                    spaceBetween: 20
                                },
                                // 화면 너비가 992px 이상일 때
                                950: {
                                    slidesPerView: 3.5,
                                    spaceBetween: 20
                                },
                                // 화면 너비가 768px 이상일 때
                                768: {
                                    slidesPerView: 2.5,
                                    spaceBetween: 15
                                },
                            }
                        });
                    </script>
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
