<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
//include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
/**
 * Get Video ID
 * 유투브 주소에서 Video ID를 추출합니다. http://blog.grotesq.com/post/426
 *
 * @access  public
 * @param   string
 * @return  string
 */
if ( ! function_exists( 'get_video_id' ) )
{
    function get_video_id( $str )
    {
        if( substr( $str, 0, 4 ) == 'http' )
        {
            if( strpos( $str, 'youtu.be' ) )
            {
                return array_pop( explode( '/', $str ) );
            }
            else if( strpos( $str, '/embed/' ) )
            {
                return array_pop( explode( '/', $str ) );
            }
            else if( strpos( $str, '/v/' ) )
            {
                return array_pop( explode( '/', $str ) );
            }
            else
            {
                $params = explode( '&', array_shift( explode( '#', array_pop( explode( '?', $str ) ) ) ) );
                foreach( $params as $data )
                {
                    $arr = explode( '=', $data );
                    if( $arr[ 0 ] == 'v' )
                    {
                        return $arr[ 1 ];
                    }
                }
            }
        }
        else
        {
            return $str;
        }
 
        return '';
    }
}
 
/**
 * Get Thumbnail URL
 * 썸네일 주소를 가져옵니다. 기본값은 default 입니다.
 *
 * @param $url_or_id
 * @param $type
 * @return string
 */
if ( ! function_exists( 'get_yt_thumb' ) )
{
    function get_yt_thumb( $url_or_id, $type )
    {
        switch( $type )
        {
            case '0' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/0.jpg';
                break;
            case '1' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/1.jpg';
                break;
            case '2' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/2.jpg';
                break;
            case '3' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/3.jpg';
                break;
            case 'hq' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/hqdefault.jpg';
                break;
            case 'mq' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/mqdefault.jpg';
                break;
            case 'sd' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/sddefault.jpg';
                break;
            case 'maxres' :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/maxresdefault.jpg';
                break;
            default :
                return '//img.youtube.com/vi/'.get_video_id( $url_or_id ).'/default.jpg';
        }
    }
}
?>

<!--<h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>-->

<!-- 게시판 목록 시작 { -->
<div id="bo_gall" style="width:<?php echo $width; ?>">

    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>

    <div class="bo_fx">
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
            <?php if ($_SESSION['ss_mb_id']=="lets080") { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
            <?php /*?><?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?><?php */?>
        </ul>
        <?php } ?>
    </div>

    <form name="fboardlist"  id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <?php if ($is_checkbox) { ?>
    <div id="gall_allchk">
        <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
        <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
    </div>
    <?php } ?>

    <ul id="gall_ul">
        <?php for ($i=0; $i<count($list); $i++) {
            if($i>0 && ($i % $bo_gallery_cols == 0))
                $style = 'clear:both;';
            else
                $style = '';
            if ($i == 0) $k = 0;
            $k += 1;
            if ($k % $bo_gallery_cols == 0) $style .= "";
         ?>
        <li class="gall_li <?php if ($wr_id == $list[$i]['wr_id']) { ?>gall_now<?php } ?>" style="<?php echo $style ?>width:<?php echo $board['bo_gallery_width'] ?>px">
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
            <ul class="gall_con">
                <li class="gall_href">
                    <a href="<?php echo $list[$i]['href'] ?>">
                    <?php
                    if ($list[$i]['is_notice']) { // 공지사항  ?>
                        <strong style="width:<?php echo $board['bo_gallery_width'] ?>px;height:<?php echo $board['bo_gallery_height'] ?>px">공지</strong>
                    <?php } else {
	// 동영상
	// 링크 : https://www.youtube.com/watch?v=Xc1KaePfc6Q
	$v = "";
	$daumpot_limit = "";
	$mov_link = "";
	$img_content = "";
	$mov_link = $list[$i]['wr_10'];
	$youtube_url = parse_url($mov_link);
	parse_str($youtube_url['query']);
	// 다음팟 http://tvpot.daum.net/v/vf1f9xx6oCXBCGGx8GJRC8t
	$daum_find = "daum";
	if(strpos($mov_link, $daum_find)){
		$daumpot_limit = parse_url($daumpot_url, PHP_URL_PATH);
		$daumpot_limit = str_replace("/v/", "", $daumpot_limit);
	}
	if($v){
		$img_content = '<img src="'.get_yt_thumb( 'http://youtu.be/'.$v, 'mq' ).'" alt="" style="width:'.$board['bo_gallery_width'].'px;height:'.$board['bo_gallery_height'].'px" />';
	} elseif($daumpot_limit) {
		// 다음팟은 아직 불완전 http://1sam.kr/xe_tips/52304
		$img_content = '<img src="http://i1.daumcdn.net/svc/image/U03/tvpot_thumb/'.$daumpot_limit.'/thumb.png" alt="" style="width:'.$board['bo_gallery_width'].'px;height:'.$board['bo_gallery_height'].'px" />';
	}
						if(!$img_content) {
							$img_content = '<span style="width:'.$board['bo_gallery_width'].'px;height:'.$board['bo_gallery_height'].'px">no image</span>';
						}
						echo $img_content;
					}
					 ?>
                    </a>
                </li>
                <li class="gall_text_href" style="width:<?php echo $board['bo_gallery_width'] ?>px">
                    <?php
                    // echo $list[$i]['icon_reply']; 갤러리는 reply 를 사용 안 할 것 같습니다. - 지운아빠 2013-03-04
                    if ($is_category && $list[$i]['ca_name']) {
                     ?>
                    <a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['ca_name'] ?></a>
                    <?php } ?>
                    <a href="<?php echo $list[$i]['href'] ?>">
                        <?php echo $list[$i]['subject'] ?>
                        <?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><?php echo $list[$i]['comment_cnt']; ?><span class="sound_only">개</span><?php } ?>
                    </a>
                    <?php
                    // if ($list[$i]['link']['count']) { echo '['.$list[$i]['link']['count']}.']'; }
                    // if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }

                    if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];
                    if (isset($list[$i]['icon_hot'])) echo $list[$i]['icon_hot'];
                    //if (isset($list[$i]['icon_file'])) echo $list[$i]['icon_file'];
                    //if (isset($list[$i]['icon_link'])) echo $list[$i]['icon_link'];
                    //if (isset($list[$i]['icon_secret'])) echo $list[$i]['icon_secret'];
                     ?>
                </li>
                <li style="font-size:0.8em"><?=cut_str(strip_tags($list[$i]['wr_content']), 100, '...');?> </li>
                <!--<li><span class="gall_subject">작성자 </span><?php echo $list[$i]['name'] ?></li>
                <li><span class="gall_subject">작성일 </span><?php echo $list[$i]['datetime2'] ?></li>
                <li><span class="gall_subject">조회 </span><?php echo $list[$i]['wr_hit'] ?></li>-->
                <?php if ($is_good) { ?><li><span class="gall_subject">추천</span><strong><?php echo $list[$i]['wr_good'] ?></strong></li><?php } ?>
                <?php if ($is_nogood) { ?><li><span class="gall_subject">비추천</span><strong><?php echo $list[$i]['wr_nogood'] ?></strong></li><?php } ?>
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
            <li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>
        </ul>
        <?php } ?>

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <?php } ?>
    </form>
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages;  ?>

<!-- 게시물 검색 시작 { -->
<fieldset id="bo_sch">
    <legend>게시물 검색</legend>

    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
        <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
        <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
        <option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
        <option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
        <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
        <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input required" size="15" maxlength="20">
    <input type="submit" value="검색" class="btn_submit">
    </form>
</fieldset>
<!-- } 게시물 검색 끝 -->

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == 'copy')
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
