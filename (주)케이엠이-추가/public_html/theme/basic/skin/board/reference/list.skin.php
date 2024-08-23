<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
include_once(G5_PATH."/jl/JlConfig.php");

$model = new JlModel(array(
    "table" => "g5_board_file",
    "primary" => "wr_id",
    "autoincrement" => true,
    "empty" => false
));

$imgmaxwidth = 349;
$imgmaxheight = 175;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<!-- 게시판 목록 시작 { -->
<div id="bo_gall" style="width:<?php echo $width; ?>">

    <div class="sub-title-font pt-0 pt-lg-4" style="text-transform:uppercase;"><?php echo $board['bo_subject'] ?></div>

    <div class="d-lg-flex">
        <!-- 게시판 카테고리 시작 { -->
        <?php if ($is_category) { ?>
            <div class="fs-3 mb-2 mb-lg-0 me-0 me-lg-4 w-100" id="bo_cate">
                <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
                <select class="form-select py-3" id="bo_cate_select" onchange="location.href=this.value;">
                    <?php echo $category_option ?>
                </select>
            </div>
        <?php } ?>
        <!-- } 게시판 카테고리 끝 -->

        <!-- 게시판 검색 시작 { -->
        <fieldset id="bo_sch" class="input-group w-100">
            <legend>게시물 검색</legend>
            <form name="fsearch" method="get" class="input-group w-100">
                <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                <input type="hidden" name="sca" value="<?php echo $sca ?>">
                <input type="hidden" name="sop" value="and">
                <input type="hidden" name="sfl" value="wr_subject||wr_content||mb_id,1"> <!-- This line has been changed -->

                <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="form-control py-3" size="15" maxlength="20" placeholder="Please enter a word.">
                <button type="submit" value="검색" class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
            </form>
        </fieldset>

        <!-- } 게시판 검색 끝 -->
    </div>

    <!--카테고리 타이틀 시작 {-->
    <div class="contents_txt_line"></div>
    <div class="d-flex fs-3 fw-bold lh-1">
        <div>
            <?php
            if ($sca) {
                echo $sca; // 선택된 카테고리명만 출력
            } else {
                echo 'View All'; // 카테고리 선택이 없을 때 표시할 텍스트
            }
            ?>
        </div>
    </div>

    <!-- } 카테고리 타이틀 끝 -->

    <div class="bo_fx">
        <?php if ($rss_href || $write_href) { ?>
            <ul class="btn_bo_user">
                <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
                <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">Admin</a></li><?php } ?>
                <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">Write</a></li><?php } ?>
            </ul>
        <?php } ?>
    </div>

    <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="sw" value="">

        <?php if ($is_checkbox) { ?>
            <div id="gall_allchk">
                <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
                <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
            </div>
        <?php } ?>

        <ul id="gall_ul">
            <?php for ($i=0; $i<count($list); $i++) { ?>
                <li class="gall_li <?php if ($wr_id == $list[$i]['wr_id']) { ?>gall_now<?php } ?>">
                    <?php if ($is_checkbox) { ?>
                        <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
                        <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
                    <?php } ?>
                    <span class="sound_only">
                <?php
                if ($wr_id == $list[$i]['wr_id'])
                    echo "<span class=\"bo_current\">열람중</span>";
                else
                    echo $list[$i]['num'];
                ?>
            </span>
                    <ul class="gall_con product-list-border">
                        <li class="gall_href">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#performance_<?php echo $list[$i]['wr_id'] ?>"
                               style="display:inline-block; height:<?php echo $imgmaxheight; ?>px;">
                                <?php
                                if ($list[$i]['is_notice']) { // 공지사항
                                    ?>
                                    <strong style="width:<?php echo $board['bo_gallery_width'] ?>px;height:<?php echo $board['bo_gallery_height'] ?>px">공지</strong>
                                    <?php
                                } else {
                                    $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $imgmaxwidth, $imgmaxheight);

                                    if ($thumb['src']) {
                                        ?>
                                        <img src="<?php echo $thumb['ori']; ?>" alt="<?php echo $thumb['alt']; ?>" class="img">
                                        <?php
                                    } else {
                                        ?>
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/noimg.jpg" alt="No Image" class="img">
                                        <?php
                                    }
                                }
                                ?>
                            </a>
                        </li>
                        <li class="gall_text_href">
                            <div class="p-3">
                                <?php if ($is_admin) { // 관리자인지 확인 ?>
                                <a href="<?php echo $list[$i]['href'] ?>" class="text-break-1 mb-2">
                                    <?php } else { ?>
                                    <a class="text-break-1 mb-2" style="pointer-events: none; cursor: default; text-decoration:none;">
                                        <?php } ?>
                                        <strong><?php echo $list[$i]['subject'] ?></strong>
                                        <?php if ($list[$i]['comment_cnt']) { ?>
                                            <span class="sound_only">댓글</span><?php echo $list[$i]['comment_cnt']; ?><span class="sound_only">개</span>
                                        <?php } ?>
                                    </a>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-gear me-1"></i>
                                        <div class="text-secondary fs-6_5 text-break-1"><?=$list[$i]['wr_2']?></div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-calendar-check me-1"></i>
                                        <div class="text-secondary fs-6_5 text-break-1"><?=$list[$i]['wr_5']?></div>
                                    </div>
                            </div>
                            <hr class="bg-secondary my-0">
                            <div class="d-flex text-kme fs-6_5 pe-3 py-1">
                                <a class="ms-auto" href="<?php echo $list[$i]['ca_name_href'] ?>">
                                    <?php echo $list[$i]['ca_name'] ?>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            <?php } ?>
            <?php if (count($list) == 0) { echo "<li class=\"empty_list\">게시물이 없습니다.</li>"; } ?>
        </ul>

        <?php if ($list_href || $is_checkbox || $write_href) { ?>
            <div class="bo_fx">
                <?php if ($is_checkbox) { ?>
                    <ul class="btn_bo_adm">
                        <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
                        <!--<li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
                        <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>-->
                    </ul>
                <?php } ?>

                <?php if ($list_href || $write_href) { ?>
                    <ul class="btn_bo_user">
                        <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">List</a></li><?php } ?>
                        <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">Write</a></li><?php } ?>
                    </ul>
                <?php } ?>
            </div>
        <?php } ?>

    </form>

    <div id="bo_paginate" class="d-flex justify-content-center pt-2 pt-lg-4">
        <?php echo $write_pages ?>
    </div>

</div>
<!-- } 게시판 목록 끝 -->

<!-- Bootstrap 모달 구조 추가 -->
<?php for ($i=0; $i<count($list); $i++) {
    $model->where("bo_table","reference");
    $model->where("wr_id",$list[$i]['wr_id']);
    try {
        $files = $model->get();
        var_dump($files);
    }catch (Exception $e) {
        $msg= $e;
    }
    echo 1;
    ?>
    <div class="modal fade" id="performance_<?php echo $list[$i]['wr_id'] ?>" data-bs-keyboard="false" tabindex="-1" aria-labelledby="performance_<?php echo $list[$i]['wr_id'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title lh-sm fs-6" id="performance_<?php echo $list[$i]['wr_id'] ?>Label"><?php echo $list[$i]['subject'] ?></div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-lg-flex border-top border-bottom">
                        <div class="bg-light ps-3 py-4 performance-modal-width">· SHIPYARD</div>
                        <div class="ps-4 ps-lg-3 py-4 fw-bold"><?php echo $list[$i]['wr_1'] ?></div>
                    </div>
                    <div class="d-lg-flex border-bottom">
                        <div class="bg-light ps-3 py-4 performance-modal-width">· SHIP TYPE</div>
                        <div class="ps-4 ps-lg-3 py-4 fw-bold"><?php echo $list[$i]['wr_2'] ?></div>
                    </div>
                    <div class="d-lg-flex border-bottom">
                        <div class="bg-light ps-3 py-4 performance-modal-width">· PROJ.NO.</div>
                        <div class="ps-4 ps-lg-3 py-4 fw-bold"><?php echo $list[$i]['wr_3'] ?></div>
                    </div>
                    <div class="d-lg-flex border-bottom">
                        <div class="bg-light ps-3 py-4 performance-modal-width">· APPLICATION ITEM</div>
                        <div class="ps-4 ps-lg-3 py-4 fw-bold"><?php echo $list[$i]['wr_4'] ?></div>
                    </div>
                    <div class="d-lg-flex border-bottom">
                        <div class="bg-light ps-3 py-4 performance-modal-width">· DELIVERY</div>
                        <div class="ps-4 ps-lg-3 py-4 fw-bold"><?php echo $list[$i]['wr_5'] ?></div>
                    </div>
                    <div class="d-lg-flex pt-3">
                        <?foreach ($files['data'] as $data) {
                            ?>
                            <div class="w-100 border border-dark mb-3 mb-lg-0 me-0 me-lg-3">
                                <img src="<?=G5_URL."/data/file/reference/".$data['bf_file']?>" class="img-fluid w-100" alt="">
                            </div>
                        <?}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

