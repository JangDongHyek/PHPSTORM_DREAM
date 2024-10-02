<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
?>



<!-- 서브 -->
        <div *id="content" class="sub" style="margin-top:-80px">
            <div class="customer_wrap">
                <!--div class="contains">
                 
                    <div class="main_title_box" >
                        <d
                        <p class="title"><?php echo $board['bo_subject'] ?><span class="line" ></span></p>
  
                    </div>
                    <div-->
                      <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>
</div>
                    <table class="bbs_list">
                        <caption><?php echo $board['bo_subject'] ?></caption>
                        <colgroup>
                            <col style="width:10%">
                            <col style="width:20%">
                            <col style="width:50%">
                            <col style="width:10%">
                            <col style="width:10%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th scope="col">번호</th>
                                <th scope="col">리얼사진</th>
                                <th scope="col">제목</th>
                                <th scope="col">등록일</th>
                                <th scope="col">조회수</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php
						for ($i=0; $i<count($list); $i++) {
						 ?>
                            <tr>
                                <td  class="no"><?php
								if ($list[$i]['is_notice']) // 공지사항
									echo '<strong>공지</strong>'; 
								else
									echo $list[$i]['num'];
								 ?></td>
								<td>
								<a href="<?php echo $list[$i]['href'] ?>" class="link">
								<?
                                $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height'], false, true);
                               /*$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], '');
                                $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], '800', '');*/

                                    if($thumb['src']) {
                                        $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" class="img_box bg_cover">';
                                    } else {
                                        $img_content = '<img src="'.G5_THEME_URL.'/img/community/list_thumb.png" class="img_box bg_cover">';
                                    }

                                    echo $img_content;
                                ?> 
                                </a>

								</td>

                                <td class="l"><?php
									echo $list[$i]['icon_reply'];
									if ($is_category && $list[$i]['ca_name']) {
									 ?>
									<a href="<?php echo $list[$i]['ca_name_href'] ?>" class="link" style="color:#999999">[<?php echo $list[$i]['ca_name'] ?>]</a>
									<?php } ?>

									<a href="<?php echo $list[$i]['href'] ?>" class="link">
										<?php echo $list[$i]['subject'] ?>

                                    <?php
                                    /*
                                    if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];
                                    if (isset($list[$i]['icon_hot'])) echo $list[$i]['icon_hot'];
                                    if (isset($list[$i]['icon_file'])) echo $list[$i]['icon_file'];
                                    if (isset($list[$i]['icon_link'])) echo $list[$i]['icon_link'];
                                    if (isset($list[$i]['icon_secret'])) echo $list[$i]['icon_secret'];
                                    */
                                    ?>
									   <?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><?php echo $list[$i]['comment_cnt']; ?><span class="sound_only">개</span><?php } ?>
									</a>

                                    </td>
                                <td class="date"><?php echo $list[$i]['datetime2'] ?></td>
                                <td class="view"><?php echo $list[$i]['wr_hit'] ?></td>
                            </tr>   
							<?php } ?>
							<?php if (count($list) == 0) { echo '<tr><td colspan="4" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
                        </tbody>
                    </table>
					
					<?php if ($rss_href || $write_href) { ?>
                    <div class="page_btn">
                    	<div class="btn_right">
							<?php if ($admin_href) { ?><a href="<?php echo $admin_href ?>" class="btns">관리자</a><?php } ?>

                    		<?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="btns">글쓰기</a><?php } ?>
                    	</div>
                    </div>
					<?php } ?>

                    <!-- 페이지 -->
                    <?php echo $write_pages;  ?> 

                </div>
            </div> 

        </div> 
 
