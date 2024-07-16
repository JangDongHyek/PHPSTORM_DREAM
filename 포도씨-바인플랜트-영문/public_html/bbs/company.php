<?
include_once('./_common.php');

if(!$is_member) alert('Please try again after logging in.', G5_BBS_URL.'/login.php');

$mb = sql_fetch(" select * from g5_member where mb_no = {$mb_no}; "); // 기업 회원 정보
//print_r($mb);

$name = "charge";
$g5['title'] = $mb['mb_company_name'];
include_once('./_head.php');

// 관심기업 확인
$com_rlt = sql_query(" select * from g5_like_company where mb_id = '{$member['mb_id']}'; ");
$com_arr = array();
while($com = sql_fetch_array($com_rlt)) {
    array_push($com_arr, $com['company_mb_id']);
}
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#container{padding:0 0 150px;}
	#ft_menu{display:none;}
	.box_cont{margin:0;}
    .magr70{margin-right: 70px;}
</style>

<!-- 카테고리 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="edit_home" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">Edit Homepage</h4>
                </div>
                <div class="modal-body">
					<ul class="list_edit">
						<li><a href="<?=G5_BBS_URL?>/profile_company_update01.php?company=Y">Company introduction & video and catalog revision</a></li>
						<li><a href="<?=G5_BBS_URL?>/register_company_form.php?w=u&company=Y">Edit Location</a></li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 카테고리 모달팝업 -->

    <div id="area_company">
		<div class="company_top">
			<div class="inr v3">
				<div class="wrap">
					<div class="logo">
                        <?=getProfileImg($mb['mb_id'], $mb['mb_category'])?>
                    </div> <!-- 회사로고 -->
					<div class="cop_info">
						<em class="<?=$mb['mb_grade']?>"><?=$mb['mb_grade']?></em>
						<h3><?=$mb['mb_company_name']?><?php if($mb['podosea_certify'] == 'Y') { ?><span class="certified"><i class="fad fa-badge-check"></i> Certified</span><?php } ?></h3> <!-- 회사명 -->
						<ul class="list_info">
							<li><span><?=$mb['mb_addr2'].' '.$mb['mb_addr1']?></span></li> <!-- 회사주소 -->
                            <?php if(!empty($mb['mb_company_tel'])) { ?>
							<li><span><a href="TEL:<?=$mb['mb_company_tel']?>"><?=$mb['mb_company_tel']?></a></span></li> <!-- 대표전화 -->
                            <?php } ?>
                            <?php if(!empty($mb['mb_company_fax'])) { ?>
							<li><span><a href="TEL:<?=$mb['mb_company_fax']?>"><?=$mb['mb_company_fax']?></a></span></li> <!-- 대표팩스 -->
                            <?php } ?>
						</ul>
						<div class="area_star">
							<span><?=companyScore($mb['mb_id'], 'Y')?> star</span>

							<!-- v1 별점 1 -->
							<!-- v2 별점 2 -->
							<!-- v3 별점 3 -->
							<!-- v4 별점 4 -->
							<!-- v5 별점 5 -->

							<div class="img_star v<?=companyScore($mb['mb_id'])?>">
								<span></span>
								<span></span>
								<span></span>
								<span></span>
								<span></span>
							</div>
							<span class="review">(<?=reviewCount($mb['mb_id'])?> reviews)</span>
						</div>
						<ul class="btn_cs">
                            <?php
                            $com_class = '';
                            $mode = 'add';
                            if(in_array($mb['mb_id'], $com_arr)) { // 관심기업에 있음
                                $com_class = 'on';
                                $mode = 'del';
                            }
                            ?>
							<!-- 관심기업 버튼 클릭했을때 li class="on" 추가 -->
                            <?php if($member['mb_category'] == '기업' && $mb['mb_id'] != $member['mb_id']) { ?>
							<li class="interest <?=$com_class?>" style="cursor: pointer;"><div class="interest_corp" onclick="likeCompany('<?=$mb['mb_id']?>', '<?=$mode?>')"><span>Interest</span></div></li>
                            <?php } ?>
							<!-- //관심기업버튼 -->

                            <?php if(!empty($mb['mb_company_homepage'])) { ?>
							<li class="homepage"><a onclick="site_link(this, '<?=$mb['mb_company_homepage']?>')" target="_blank" style="cursor: pointer;"><span>Website</span></a></li> <!-- 회사홈페이지링크 -->
                            <?php } ?>
                            <?php if($mb_no != $member['mb_no']) { ?>
							<li class="inquiry"><a href="javascript:memberCheck('<?=$member['mb_category']?>', '<?=$mb['mb_no']?>');"><span>Direct RFQ</span></a></li>
                            <?php } ?>
                            <?php if($member['mb_level'] > 2) { // 일반회원은 기업회원에게 채팅 불가?>
							<li class="chat"><a href="javascript:chatting('<?=$mb['mb_id']?>');"><span>Chat</span></a></li>
                            <?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="company_cont">

				<div class="area_tab">
					<ul class="tabs">
						<li class="active" rel="tab1"><span>Introduction</span></li>
						<li rel="tab2"><span>Business</span></li>
						<li rel="tab4"><span>Review</span></li>
					</ul>
				</div>
				<div class="inr v3">
					<div class="wrap">

					<div class="tab_container">
						<div id="tab1" class="tab_content">
							<nav class="left_m">
								<ul class="cop_nav">
									<li class="nav01_01">
										<a class="current" href="#section01">
											<div class="icon"></div>
											<span>Company overview</span>
										</a>
									</li>
									<li class="nav01_02"><a href="#section02"><span>Directions to company</span></a></li>
								</ul>
							</nav>
							<div id="section_wrap">
							<section id="section01">
								<div class="box">
									<h1>Company introduction</h1>

									<!-- 국문회사소개 -->
									<p>
										<?=nl2br($mb['mb_company_introduce'])?>
									</p>
									<!-- //국문회사소개 -->

									<!-- 영문회사소개 -->
									<p class="en">
                                        <?=nl2br($mb['mb_company_introduce_eng'])?>
									</p>
									<!-- //영문회사소개 -->
								</div>
								<div class="box">
									<h1>Company information</h1>
									<table>
										<colgroup>
											<col style="width:30%">
											<col style="width:70%">
										</colgroup>
										<tbody>
											<tr>
												<th>Business type</th> <!-- 업종분류 -->
												<td><?=$company_sectors[$mb['mb_company_sector']]?></td>
											</tr>
                                            <tr>
                                                <th>Business details</th>
                                                <td><?=str_replace('|',', ',$mb['mb_company_sector_detail'])?></td>
                                            </tr>
											<tr>
												<th>Date founded</th>
												<td><?=str_replace('-','.',substr($mb['mb_company_establish_date'],0,10))?></td>
											</tr>
											<tr>
												<th>Name of representative</th>
												<td><?=$mb['mb_ceo']?><td>
											</tr>
											<tr>
												<th>Company address</th>
												<td><?=$mb['mb_addr2'].' '.$mb['mb_addr1']?></td>
											</tr>
											<tr>
												<th>Held certifications</th>
												<td>
                                                    <?php
                                                    $mb_patent = '';
                                                    if(!empty($mb['mb_patent'])) {
                                                        $temp = explode('|',$mb['mb_patent']);
                                                        for($i=0; $i<count($temp); $i++) {
                                                            $mb_patent .= '<span style="margin-bottom: 5px">'.$temp[$i].'</span>';
                                                        }
                                                    }
                                                    ?>
                                                    <?=$mb_patent?>
                                                </td>
											</tr>
											<tr>
												<th>Major products and services</th>
												<td>
													<ul class="list_service">
                                                        <?php
                                                        $mb_goods_service = '';
                                                        if(!empty($mb['mb_goods_service'])) {
                                                            $temp = explode('|',$mb['mb_goods_service']);
                                                            for($i=0; $i<count($temp); $i++) {
                                                                $mb_goods_service .= '<li>'.$temp[$i].'</li>';
                                                            }
                                                        }
                                                        ?>
                                                        <?=$mb_goods_service?>
													</ul>
												</td>
											</tr>
											<tr>
												<th>Brands</th>
												<td>
                                                    <ul class="list_service">
                                                    <?php
                                                    $mb_brand = '';
                                                    if(!empty($mb['mb_brand'])) {
                                                        $temp = explode('|',$mb['mb_brand']);
                                                        for($i=0; $i<count($temp); $i++) {
                                                            $mb_brand .= '<li>'.$temp[$i].'</li>';
                                                        }
                                                    }
                                                    ?>
                                                    <?=$mb_brand?>
                                                    </ul>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<!-- 수정버튼
								<div class="area_btn">
									<a href="<?php echo G5_BBS_URL ?>/profile_company_update01.php" class="btn_add">수정하기</a>
								</div>
								<!-- //수정버튼 -->
							</section>
							<section id="section02">
								<div class="box">
									<h1>Directions to company</h1>
									<div class="area_map">
										<div class="daum_map">
                                            <div class="add"><?=$mb['mb_addr1']?></div>
                                            <div id="map" style="width: 100%; height: 300px;"></div>
										</div>

										<ul class="info_list">
											<li>
												<h3>Main phone number</h3>
												<span><a href="javascript:void(0);"><?=$mb['mb_company_tel']?></a></span>
											</li>
											<li>
												<h3>Fax</h3>
												<span><a href="javascript:void(0);"><?=$mb['mb_company_fax']?></a></span>
											</li>
											<li>
												<h3>E-MAIL</h3>
                                                <span><a href="javascript:void(0);"><?=$mb['mb_email']?></a></span>
											</li>
										</ul>
									</div>
									<!-- 수정버튼
										<div class="area_btn">
											<a href="<?php echo G5_BBS_URL ?>/profile_company_update01.php" class="btn_add">수정하기</a>
										</div>
									<!-- //수정버튼 -->

									<!-- 오시는길 수정
									<div class="area_business edit">
										<ul class="business_input">
											<li class="subject">
												<label>회사주소</label>
												<input type="text" placeholder="회사주소를 입력해주세요.">
											</li>
											<li class="cont">
												<label>대표전화</label>
												<input type="text" placeholder="대표전화를 입력해주세요.">
											</li>
											<li class="subject">
												<label>팩스</label>
												<input type="text" placeholder="팩스번호를 입력해주세요.">
											</li>
											<li class="cont">
												<label>E-MAIL</label>
												<input type="text" placeholder="이메일을 입력해주세요.">
											</li>
										</ul>
									</div>
									<div class="area_btn">
										<button type="button" class="btn_add">수정완료</button>
									</div>
									<!-- //오시는길 수정 -->
								</div>
							</section>


							</div>
						</div>
                        <div id="tab2" class="tab_content">
                            <nav class="left_m">
                                <ul class="cop_nav">
                                    <li class="nav02_01">
                                        <a class="current" href="#section02_01">
                                            <div class="icon"></div>
                                            <span>Business introduction</span>
                                        </a>
                                    </li>
                                    <li class="nav02_02"><a href="#section02_02"><span>video</span></a></li> <!-- 프리미엄회원 -->
                                    <li class="nav02_03"><a href="#section02_03"><span>Catalog</span></a></li> <!-- 프리미엄회원 -->
                                </ul>
                            </nav>
                            <div id="section_wrap">
                                <section id="section02_01">
                                    <div class="box">
                                        <h1>Business introduction</h1>
                                        <div class="area_box">

                                            <?php if($mb_no == $member['mb_no']) { ?>
                                                <!-- 사업소개 등록 안되어 있을 때-->
                                                <div class="box_nodata">
                                                    <p>Please enter business introduction.</p>
                                                </div>
                                            <?php } ?>

                                            <div class="area_business">

                                                <?php if($mb_no == $member['mb_no']) { ?>
                                                    <dl class="reference">
                                                        <dt>
                                                            <h2>Business introduction sample</h2>
                                                        </dt>
                                                        <dd>
                                                            <!-- 1차 분류 -->
                                                            <div class="box_business sample">
                                                                <label>1st category</label>
                                                                <div class="title"><h1>Merchant ships/special ships</h1></div>

                                                                <!-- 2차 분류 -->
                                                                <ul class="list_business">
                                                                    <li>
                                                                        <label>2nd category</label>
                                                                        <div class="business_info">
                                                                            <div class="img"><img src="<?php echo G5_IMG_URL ?>/img_busi01.jpg"></div><!-- 사진 -->
                                                                            <div class="txt">
                                                                                <div class="wrap">
                                                                                    <h3>gas ship</h3><!-- 이름 -->
                                                                                    <span>A gas ship boasting the world's best technology</span> <!-- 설명 -->
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="depth">
                                                                            <label>3rd category</label>
                                                                            <!-- 3차 분류 -->
                                                                            <ul class="list_business02">
                                                                                <li>LNG Carrier</li>
                                                                                <li>LNG-FSRU</li>
                                                                                <li>LPG Carrier</li>
                                                                                <li>LPG Carrier</li>
                                                                            </ul>
                                                                            <!-- //3차 분류 -->
                                                                        </div>

                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </dd>
                                                    </dl>
                                                <?php } ?>

                                                <?php if($mb_no == $member['mb_no']) { ?>
                                                    <form id="fbusiness" name="fbusiness">
                                                        <div class="area_business edit">
                                                            <!-- 1차 분류 -->
                                                            <div class="box_business">
                                                                <div class="title">
                                                                    <label>1st category</label>
                                                                    <input type="text" id="bi_name" name="bi_name" placeholder="Enter business name.">
                                                                </div>

                                                                <div class="add_depth">
                                                                    <div class="add_1">
                                                                        <!-- 2차 분류 -->
                                                                        <div class="business_info second_1">
                                                                            <div class="top_title">
                                                                                <label>2nd category</label>
                                                                                <button type="button" class="btn_depth second_add_btn" onclick="add_depth('second');">+ 2nd category</button>
                                                                            </div>

                                                                            <!-- 사진 -->
                                                                            <div class="p_box">
                                                                                <div class="img upload file_1" onclick="file_add('1')"></div>
                                                                                <input type="file" id="file_1" name="file[]" onchange="setImageFromFile(this, 1);" accept="image/*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;">
                                                                            </div>

                                                                            <div class="info">
                                                                                <ul class="business_input">
                                                                                    <li class="subject">
                                                                                        <label>Title</label>
                                                                                        <input type="text" id="title_1_1" name="title[]" placeholder="Enter title.">
                                                                                    </li>
                                                                                    <li class="cont">
                                                                                        <label>Description</label>
                                                                                        <input type="text" id="contents_1_1" name="contents[]" placeholder="Enter description.">
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <!-- //2차 분류 -->

                                                                        <!-- 3차 분류 -->
                                                                        <div class="business_info third_1">
                                                                            <div class="top_title">
                                                                                <label>3rd category</label>
                                                                                <button type="button" class="btn_depth third_add_btn" onclick="add_depth('third', 1);">+ 3rd category</button>
                                                                            </div>
                                                                            <ul class="business_input">
                                                                                <li class="subject">
                                                                                    <input type="text" id="third_depth_1" name="third_depth_1[]" placeholder="Enter 3rd category.">
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        <!-- //3차 분류 -->
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="line"></div>
                                                            <?php if($mb_no == $member['mb_no']) { ?>
                                                                <!--<div class="area_btn">
                                                                    <button type="button" class="btn_add">+사업추가하기</button>
                                                                </div>-->
                                                                <button type="button" class="btn_confirm" onclick="business_register();">+Add business</button>
                                                            <?php } ?>
                                                        </div>
                                                    </form>
                                                    <!-- //사업소개 등록 안되어 있을 때-->
                                                <?php } ?>

                                                <div class="area_business">
                                                    <?php
                                                    $sql = " select * from g5_business_information where mb_no = {$mb_no} and p_idx is null order by idx ";
                                                    $result = sql_query($sql);

                                                    for($i=0; $row=sql_fetch_array($result); $i++) {
                                                        ?>
                                                        <!-- 1차 분류 -->
                                                        <div class="box_business">
                                                            <div class="title">
                                                                <h1><?=$row['bi_name']?></h1>
                                                                <?php if($mb_no == $member['mb_no']) { ?>
                                                                    <button type="button" class="btn_delete" onclick="business_delete('<?=$row['idx']?>');">Delete</button>
                                                                <?php } ?>
                                                            </div>

                                                            <!-- 2차 분류 -->
                                                            <ul class="list_business">
                                                                <?php
                                                                $sql2 = " select * from g5_business_information where mb_no = {$mb_no} and p_idx = {$row['idx']} order by idx ";
                                                                $result2 = sql_query($sql2);

                                                                for($j=0; $row2=sql_fetch_array($result2); $j++) {
                                                                    ?>
                                                                    <li>
                                                                        <div class="business_info">
                                                                            <div class="img"><img src="<?php echo G5_DATA_URL ?>/file/business/<?=$row2['bi_img_file']?>"></div><!-- 사진 -->
                                                                            <div class="txt">
                                                                                <div class="wrap">
                                                                                    <h3><?=$row2['bi_title']?></h3><!-- 이름 -->
                                                                                    <span><?=$row2['bi_contents']?></span> <!-- 설명 -->
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <?php
                                                                        $sql3 = " select * from g5_business_information where mb_no = {$mb_no} and p_idx = {$row2['idx']} order by idx ";
                                                                        $result3 = sql_query($sql3);
                                                                        $result3_count = sql_num_rows($result3);
                                                                        if($result3_count > 0) {
                                                                            ?>
                                                                            <!-- 3차 분류 -->
                                                                            <ul class="list_business02">
                                                                                <?php for($k=0; $row3=sql_fetch_array($result3); $k++) { ?>
                                                                                    <li><?=$row3['bi_third_depth']?></li>
                                                                                <?php } ?>
                                                                            </ul>
                                                                            <!-- //3차 분류 -->
                                                                        <?php } ?>
                                                                    </li>
                                                                <?php
                                                                }
                                                                ?>
                                                            </ul>

                                                        </div>
                                                        <!-- //1차 분류 -->
                                                        <?php
                                                    }
                                                    if($i == 0) {
                                                        ?>
                                                        <div>There's no business introduction.</div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                </section>

                                <!-- 프리미엄회원 -->
                                <section id="section02_02">
                                    <div class="box">
                                        <h1>Company introduction video</h1>
                                        <div class="area_cont">
                                            <?php if(!empty($mb['mb_video_link'])) {
                                                if(strpos($mb['mb_video_link'], 'youtube.com') !== false) { // youtube 링크는 embed가 없으면 iframe에서 재생 불가, youtube 일반링크
                                                    $youtube_id = getVideoID($mb['mb_video_link']);
                                                    $video_link = "https://www.youtube.com/embed/".$youtube_id;
                                                }
                                                else if(strpos($mb['mb_video_link'], 'youtu.be') !== false) { // youbute 공유링크
                                                    $youtube_id = explode('youtu.be/', $mb['mb_video_link'])[1];
                                                    $video_link = "https://www.youtube.com/embed/".$youtube_id;
                                                }
                                                else {
                                                    $video_link = $mb['mb_video_link'];
                                                }
                                            ?>
                                            <iframe src="<?=$video_link?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                            <?php
                                            } else {
                                            ?>
                                            There’s no company introduction video.
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </section> <!-- 베타버전 종료 시 Premium 기업의 자료만 공개 -->

                                <section id="section02_03"> <!-- 베타버전 종료 시 Premium 기업의 자료만 공개 -->
                                    <div class="box">
                                        <h1>Catalog</h1>
                                        <div class="area_cont">
                                            <ul class="catalog_list">
                                                <?php
                                                $file_sql = " select * from g5_member_img where mb_id = '{$mb['mb_id']}' and category = '카달로그' order by idx ";
                                                $file_result = sql_query($file_sql);

                                                for($i=0; $file=sql_fetch_array($file_result); $i++) {
                                                    $cover_img = sql_fetch(" select * from g5_member_img where mb_id = '{$mb['mb_id']}' and category = '카달로그커버' and p_idx = {$file['idx']} ")['img_file'];
                                                    ?>
                                                    <li>
                                                        <a href="javascript:fileDownload('company', '<?=$file['img_file']?>', '<?=$file['img_source']?>')">
                                                            <div class="area_img upload mbox">
                                                                <?php if($cover_img) { ?><img src="<?php echo G5_DATA_URL ?>/file/company/<?=$cover_img?>"><?php } ?>
                                                                <?php if(!$cover_img) { ?><?=getProfileImg($mb['mb_id'], $mb['mb_category'])?><?php } ?>
                                                            </div>
                                                            <div class="area_txt"><span><?=$file['img_source']?></span></div>
                                                            <div class="download"><span>DOWNLOADS</span></div>
                                                        </a>
                                                    </li>
                                                    <?php
                                                }
                                                if($i==0) {
                                                ?>
                                                <li class="nodata">There's no catalog.</li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </section>
                                <!-- //프리미엄회원 -->
                            </div>
                        </div>
						<div id="tab4" class="tab_content">
                            <input type="hidden" id="page" name="page" value="1">
							<div id="area_review">
								<ul class="list_review">
                                    <!--ajax.company_review.php-->
								</ul>
							</div>
                            <div id="paging"></div>
						</div>
					</div>
					<div id="cop_inquiry">
                        <?php if($mb_no == $member['mb_no']) { ?>
						<div class="area_write v2 company_write">
							<a href="" data-toggle="modal" data-target="#edit_home"><span>Edit Homepage</span></a>
						</div>
                        <?php } ?>
                        <?php if($mb_no != $member['mb_no']) { ?>
						<div id="cop_inquiry_wrap">
							<h2>Make inquiry</h2>
							<div class="box">
								<!--<input type="text" id="email" name="email" placeholder="이메일">-->
								<input type="text" id="subject" name="subject" placeholder="Title">
								<textarea id="contents" name="contents" placeholder="Contents"></textarea>
								<a href="javascript:company_question('<?=$mb['mb_no']?>');">Make inquiry</a>
							</div>
						</div>
                        <?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="add_depth_data" style="display: none;">
        <div class="line" style="padding: 15px 0px"></div>
        <!-- 2차 분류 -->
        <div class="business_info">
            <div class="top_title">
                <label>2nd category</label>
                <button type="button" class="btn_depth second_add_btn" onclick="add_depth('second');" style="margin-right: 102px;">+ 2nd category</button>
                <button type="button" class="btn_depth second_minus_btn">- 2nd category</button>
            </div>

            <!-- 사진 -->
            <div class="p_box">
            <div class="img upload"></div>
            </div>

            <div class="info">
                <ul class="business_input">
                    <li class="subject">
                        <label>Title</label>
                        <input type="text" placeholder="Enter Title.">
                    </li>
                    <li class="cont">
                        <label>Description</label>
                        <input type="text" placeholder="Enter description.">
                    </li>
                </ul>
            </div>
        </div>
        <!-- //2차 분류 -->

        <!-- 3차 분류 -->
        <div class="business_info">
            <div class="top_title">
                <label>3rd category</label>
                <button type="button" class="btn_depth third_add_btn">+ 3rd category</button>
                <!--<button type="button" class="btn_depth third_minus_btn">- 3차 분류</button>-->
            </div>
            <ul class="business_input">
                <li class="subject"><input type="text" placeholder="Enter 3rd category."></li>
            </ul>
        </div>
        <!-- //3차 분류 -->

    </div>

<?
include_once('./fchatting.php');
include_once('./_tail.php');
?>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=GOOGLE_MAP_API_KEY?>&language=en&region=kr"</script>
<!--<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=--><?//=$kakao_javascript_key?><!--"></script>-->
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
			$("#" + activeTab).fadeIn();

			if(activeTab == 'tab4') {
                company_review(); // 기업리뷰
            }
		}
    });

    // 구글지도 초기화
    initMap();

    // 카카오지도
    // var mapContainer = document.getElementById('map'), // 지도를 표시할 div
    //     mapOption = {
    //         center: new kakao.maps.LatLng(lat, lng), // 지도의 중심좌표
    //         level: 3 // 지도의 확대 레벨
    //     };
    //
    // // 지도를 표시할 div와 지도 옵션으로 지도를 생성
    // var map = new kakao.maps.Map(mapContainer, mapOption);
    //
    // // 마커 표시
    // var markerPosition = new kakao.maps.LatLng(lat, lng);
    // var marker = new kakao.maps.Marker({
    //     position: markerPosition
    // });
    // marker.setMap(map);
});

// 구글지도
const initMap = () => {
    setTimeout(()=>{
        var lat = '<?=$mb['mb_addr1_lat']?>'*1;
        var lng = '<?=$mb['mb_addr1_lng']?>'*1;
        if(lat == '' || lng == '') { // 다음 지도에서 위도/경도 안들어갔을 때
            $.ajax({
                url: g5_bbs_url + '/ajax.lat_lng.php',
                data: {mb_id: '<?=$mb['mb_id']?>'},
                type: 'post',
                async: false,
                dataType: 'json',
                success: function(data) {
                    if(Object.keys(data['results']).length > 0) {
                        const lanlng = data['results'][0]['geometry']['location']
                        lat = lanlng.lat; // 위도
                        lng = lanlng.lng; // 경도
                    }
                },
            })
        }

        const map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: lat, lng: lng },
            zoom: 10,
        });

        new google.maps.Marker({
            position: { lat: lat, lng: lng },
            map: map
        });
    }, 300);
}

var is_post2 = false;
function company_question(mb_no) {
    if(is_post2) {
        return false;
    }
    is_post2 = true;

    if($.trim($('#subject').val()).length == 0) {
        swal('Please enter the subject.');
        is_post2 = false;
        return false;
    }
    if($.trim($('#contents').val()).length == 0) {
        swal('Please enter your details.');
        is_post2 = false;
        return false;
    }

    $.ajax({
        url: g5_bbs_url + '/ajax.company_question.php',
        type: 'POST',
        data: {mb_no: mb_no, email: $('#email').val(), subject: $('#subject').val(), contents: $('#contents').val()},
        success: function(data) {
            if(data) {
                swal('Your inquiry has been completed.')
                .then(()=>{
                   location.reload();
                });
            }
        },
    });
}

// 분류 추가
var count = 2; // 2차 분류 사용
var count2 = 2; // 3차 분류 사용
function add_depth(depth, index) {
    if(depth == 'second') { // 2차 분류 추가
        // 2차 분류 설정
        $('.add_depth').append("<div class='add_"+count+"'>"+$('.add_depth_data').html()+"</div>");
        $('.add_'+count+' .business_info:first').addClass('second_'+count); // 2차 분류 class 설정
        $('.second_'+count+' .business_input li input:first').attr('id', 'title_'+count); // 2차 분류 각 id, name 설정
        $('.second_'+count+' .business_input li input:first').attr('name', 'title[]'); // 2차 분류 각 id, name 설정
        $('.second_'+count+' .business_input li input:last').attr('id', 'contents_'+count); // 2차 분류 각 id, name 설정
        $('.second_'+count+' .business_input li input:last').attr('name', 'contents[]'); // 2차 분류 각 id, name 설정
        $('.add_'+count+' .second_minus_btn').attr("onclick", "minus_depth('second', "+count+")"); // 분류 삭제 이벤트 설정
        $('.add_'+count+' .img.upload').addClass('file_'+count); // 파일 추가 class 및 이벤트 설정
        $('.add_'+count+' .img.upload').attr("onclick", "file_add("+count+")"); // 파일 추가 class 및 이벤트 설정
        $('.add_'+count+' .img.upload').after('<input type="file" id="file_'+count+'" name="file[]"  onchange="setImageFromFile(this, '+count+');" accept="image/*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;">'); // 파일 폼 추가
        // 3차 분류 설정
        $('.add_'+count+' .business_info:last').addClass('third_'+count); // 3차 분류 class 설정
        $('.add_'+count+' .third_add_btn').attr("onclick", "add_depth('third', "+count+")"); // 분류 추가 이벤트 설정
        $('.third_'+count+' .business_input').html('<li class="subject"><input type="text" id="third_depth_'+count+'" name="third_depth_'+count+'[]" placeholder="Enter the 3rd category."></li>'); // 입력 폼 추가

        count++;
    }
    else { // 3차 분류 추가
        // 입력 폼 추가 및 이벤트 설정
        $('.third_'+index+' .business_input').append('<li class="subject third_depth_'+count2+'"><button type="button" class="btn_close" onclick="minus_depth(\'third\', \''+count2+'\')"></button><input type="text" id="third_depth_'+count2+'" name="third_depth_'+index+'[]" placeholder="Enter the 3rd category."></li>');

        count2++;
    }
}

// 분류 삭제
function minus_depth(depth, index) {
    if(depth == 'second') {
        $('.add_'+index).remove();
    } else {
        $('.third_depth_'+index).remove();
    }
}

// 2차 분류 이미지 등록
function file_add(index) {
    $("#file_"+index).click();
}

// 2차 분류 이미지 삭제
function file_del(index) {
    $('.img_'+index).remove(); // 이미지 삭제
    $('.del_btn_'+index).remove(); // 삭제 버튼 삭제
    $('#file_'+index).val('');
    $('.file_'+index).attr('onclick','file_add('+index+')'); // 클릭이벤트 추가

    filesTempArr.splice(index, 1, '');
}

// 이미지 미리보기
var filesTempArr = [];
function setImageFromFile(input, index) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function c(e) {
            var img = document.createElement('img'); // 이미지 추가
            img.setAttribute('class', 'img_'+index);
            img.setAttribute('src', e.target.result);

            var btn = document.createElement('button'); // 삭제 버튼 추가
            btn.setAttribute("type", "button");
            btn.setAttribute("class", "btn del_btn_"+index);
            btn.setAttribute('onclick', 'file_del("'+index+'")');
            btn.innerHTML = "Delete";

            $('.file_'+index).append(img); // div에 img태그 추가
            $('.file_'+index).attr('onclick',''); // 클릭이벤트 제거
            $('.file_'+index).after(btn); // btn태그 추가
        }
        reader.readAsDataURL(input.files[0]);

        filesTempArr.splice(index, 1, input.files[0]);
    }
}

// 사업추가
var is_post = false;
function business_register() {
    if(is_post) {
        return false;
    }
    // is_post = true;

    // 1차 분류 입력 체크
    if($('#bi_name').val() == '') {
        swal('Enter the 1st category.');
        is_post = false;
        return false;
    }
    // 2차 분류 입력 체크
    var valid = false;
    $("input[name='file[]']").each(function(){
        if($(this).val() == ""){
            console.log(1);
            swal('Register a 2nd category image.');
            valid = true;
            return false;
        }
    });
    if(valid) { return false; }
    $("input[name='title[]']").each(function(){
        if($.trim($(this).val()) == ""){
            console.log(2);
            swal('Enter 2nd category title.');
            valid = true;
            return false;
        }
    });
    if(valid) { return false; }
    $("input[name='contents[]']").each(function(){
        if($.trim($(this).val()) == ""){
            console.log(3);
            swal('#nter 2nd category description.');
            valid = true;
            return false;
        }
    });
    if(valid) { return false; }

    var form = $('form')[0];
    var formData = new FormData(form);
    formData.append("file[]", filesTempArr);

    $.ajax({
        url : g5_bbs_url + "/ajax.business_register.php",
        processData: false,
        contentType: false,
        data: formData,
        type: 'POST',
        success : function(data) {
            if(data == 'success') {
                location.reload();
            }
        },
        err : function(err) {
            swal(err.status);
        }
    });
}

// 사업삭제
function business_delete(idx) {
    $.ajax({
        url : g5_bbs_url + "/ajax.business_delete.php",
        data: {idx: idx},
        type: 'POST',
        success : function(data) {
            if(data == 'success') {
                swal('It is been deleted..')
                .then(()=>{
                   location.reload();
                });
            }
        },
        err : function(err) {
            swal(err.status);
        }
    });
}

// 기업리뷰 (ajax)
function company_review(page) {
    if(page == undefined) { page = 1; }
    $('#page').val(page);

    $.ajax({
       url: g5_bbs_url + '/ajax.company_review.php',
       type: 'POST',
       data: {mb_no: '<?=$mb_no?>', page: page},
       dataType: 'html',
       success: function(data) {
            $('.list_review').html(data);

           // 페이징 처리 -- 하단에 페이지 표시
           ajaxGetPaging();
       },
    });
}

// 페이징 처리 -- 페이지 클릭 시 동작 이벤트
function get_page(page) {
    company_review(page);
}
</script>

<script>
let mainNavLinks = document.querySelectorAll("nav ul.cop_nav li a");
let mainSections = document.querySelectorAll(".tab_container section");

let lastId;
let cur = [];

// This should probably be throttled.
// Especially because it triggers during smooth scrolling.
// https://lodash.com/docs/4.17.10#throttle
// You could do like...
// window.addEventListener("scroll", () => {
//    _.throttle(doThatStuff, 100);
// });
// Only not doing it here to keep this Pen dependency-free.

window.addEventListener("scroll", event => {
  let fromTop = window.scrollY;

  mainNavLinks.forEach(link => {
    let section = document.querySelector(link.hash);

    if (
      section.offsetTop <= fromTop &&
      section.offsetTop + section.offsetHeight > fromTop
    ) {
      link.classList.add("current");
    } else {
      link.classList.remove("current");
    }
  });
});

$(window).scroll(function() {
	// console.log('스크롤 Y 값 보기', $(window).scrollTop());
});

$(document).ready(function() {
	 var fixedBG = 410;

	  $(window).scroll(function() {
		var scrollY = $(this).scrollTop();
		var body = $('body');

		if (scrollY >= fixedBG ) {
			$("#area_company nav").addClass('fixed');
			$("#cop_inquiry").addClass('fixed');
		} else {
			$("#area_company nav").removeClass('fixed');
			$("#cop_inquiry").removeClass('fixed');
		}
	  });
});

$(document).ready(function(){
	//accordion tab
	(function($) {
		$('.area_business > dl.reference > dt').addClass('active').next().slideDown();
		$('.area_business > dl.reference > dt').click(function(j) {
			var dropDown = $(this).closest('dl').find('dd');
			$(this).closest('.reference').find('dd').not(dropDown).slideUp();

			if ($(this).hasClass('active')) {
				$(this).removeClass('active');
			} else {
				$(this).closest('.area_business').find('dt.active').removeClass('active');
				$(this).addClass('active');
			}

			dropDown.stop(false, true).slideToggle();
			j.preventDefault();
		});
	})(jQuery);
});
</script>
