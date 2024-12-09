<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

$board['bo_gallery_width'] = 122;
$board['bo_gallery_height'] = 80;
if( $bo_table == "m43" ){
$imgtitle = '<img src="'.$latest_skin_url.'/img/photoreviewtitle.gif" alt="">';
}else if( $bo_table == "m51" ){
$imgtitle = '<img src="'.$latest_skin_url.'/img/newstitle.gif" alt="">';
}else{ $imgtitle = $bo_subject; }
?>
<style>

.wzine { /*overflow: hidden;*/ margin-bottom: 30px; }
.wzine .wzine_tit { color: rgb(25, 25, 25); letter-spacing: -1px; font-size: 16px; margin-bottom: 13px; display: block; }
.wzine .wzine_cont { border-top-color: rgb(216, 217, 217); border-bottom-color: rgb(216, 217, 217); border-top-width: 1px; border-bottom-width: 1px; border-top-style: solid; border-bottom-style: solid; position: relative; }
.wzine .wzine_cont .wzine_list li { height: 80px; overflow: hidden; margin-top: 10px; }
.wzine .wzine_cont .wzine_list li:first-child { margin-top: 0px; }
.wzine .wzine_cont .wzine_list li a { display: block; }
.wzine .wzine_cont .wzine_list li .thumb { margin-right: 10px; float: left; position: relative; }
.wzine .wzine_cont .wzine_list li .thumb .icon_player { background: url("../images/common/icon_player02.png") no-repeat 0px 0px; width: 24px; height: 23px; right: 6px; bottom: 6px; color: transparent; font-size: 0px; position: absolute; }
.wzine .wzine_cont .wzine_list li .thumb .icon_pic { background: url("../images/common/icon_pic02.png") no-repeat 0px 0px; width: 21px; height: 17px; right: 6px; bottom: 6px; color: transparent; font-size: 0px; position: absolute; }
	
.wzine .wzine_cont .wzine_list li .r_list { padding: 0px 0px 0px; /*overflow: hidden;*/ }
.wzine .wzine_cont .wzine_list li .r_list span { /*display: block;*/ }
.wzine .wzine_cont .wzine_list li .r_list a { padding: 1px 9px 0px 0px; }
	
.wzine .wzine_cont .wzine_list li .r_list .cont { color: rgb(25, 25, 25); line-height: 120%; letter-spacing: -1px; overflow: hidden; font-size: 16px; /*font-weight: bold;*/ margin-bottom: 5px; white-space: normal; -ms-word-wrap: break-word; -ms-text-overflow: ellipsis; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }
.wzine .wzine_cont .wzine_list li .r_list .cont p { letter-spacing: -1px; font-size: 13px;}
	
/*	
.wzine .wzine_cont .wzine_list li .r_list .category { color: rgb(157, 157, 157); font-size: 12px; }
.wzine .wzine_cont .btn_move { background: url("../images/common/bg_line01.png") no-repeat right 0px; top: 117px; height: 275px; right: 0px; position: absolute; }
.wzine .wzine_cont .btn_move a { background: rgb(255, 255, 255); border-width: 1px 0px 1px 1px; border-style: solid none solid solid; border-color: rgb(223, 223, 223) currentColor rgb(223, 223, 223) rgb(223, 223, 223); margin: 102px 0px 0px; border-image: none; width: 47px; height: 42px; text-align: center; color: rgb(132, 132, 132); line-height: 41px; font-size: 12px; display: block; }
.wzine .wzine_cont .btn_move a em { color: rgb(241, 89, 34); }
.wzine .wzine_cont .btn_move a .icon_arr { background: url("../images/common/icon_arr01.gif") no-repeat 0px 50%; margin: 0px 0px 0px 7px; width: 9px; height: 15px; vertical-align: middle; display: inline-block; }*/
</style>			
<!-- <?php echo $bo_subject; ?> 최신글 시작 { -->


<!-- 웹진형 최신글 -->
<div class="wzine">
<h2 class="wzine_tit"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>">
<?php echo $bo_subject; ?></a></h2>
<div class="wzine_cont">
<ul class="wzine_list">
    <?php for ($i=0; $i<count($list); $i++) {  ?>
        <li>
            <?php
			$content = cut_str(preg_replace("@<.*?>@","", $list[$i]['wr_content']),140); // 내용 자르기
	
			$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);
			if($thumb['src']) {
				$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'">';
			} else {
				$img_content = '<span style="width:'.$board['bo_gallery_width'].'px;height:'.$board['bo_gallery_height'].'px">no image</span>';
			}
			echo "<div class=\"thumb\"><a href=\"".$list[$i]['href']."\">".$img_content."</a></div>";
	
	
            //echo $list[$i]['icon_reply']." ";
			echo "<div class=\"r_list\">";
            echo "<a href=\"".$list[$i]['href']."\">";
			echo "<span class=\"cont\">";
            if ($list[$i]['is_notice'])
                echo "<strong>".$list[$i]['subject']."</strong><p>".$content;
            else
                echo "<strong>".$list[$i]['subject']."</strong><p>".$content;

            if ($list[$i]['comment_cnt'])
                echo $list[$i]['comment_cnt'];
	
            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

            if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
            if (isset($list[$i]['icon_hot'])) echo " " . $list[$i]['icon_hot'];
            if (isset($list[$i]['icon_file'])) echo " " . $list[$i]['icon_file'];
            if (isset($list[$i]['icon_link'])) echo " " . $list[$i]['icon_link'];
            if (isset($list[$i]['icon_secret'])) echo " " . $list[$i]['icon_secret'];
	
			echo "</p></span>";
            echo "</a>";

			echo "</div>";
             ?>   
        </li>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
  <li>
  <div class="thumb"><a href="#"><img alt="" src="<?php echo $latest_skin_url ?>/img/84033788_1_thumb.jpg"></a></div>
  <div class="rightList"><a href="#"><span class="txt">게시물이 없습니다.<br>게시물이 없습니다.</span>
  </a></div></li>
  <?php }  ?>
  </div>
 </div>
<!--
  <li>
  <div class="thumb"><a href="#"><img alt="" src="<?php echo $latest_skin_url ?>/img/84033788_1_thumb.jpg"></a></div>
  
  <div class="rightList"><a href="#"><span class="txt">첫번째 제목입니다.
  <br>내용자르기 부제목 자리</span><span class="category"></span></a></div>
  </li>
  <li>
  <div class="thumb"><a href="#"><img alt="" src="<?php echo $latest_skin_url ?>/img/84033788_1_thumb.jpg"></a></div>
  <div class="rightList"><a href="#"><span 
  class="txt">첫번째 제목입니다.<br>내용자르기 부제목 자리</span><span 
  class="category"></span></a></div></li>
  <li>
  <div class="thumb"><a href="#"><img alt="" src="<?php echo $latest_skin_url ?>/img/84033788_1_thumb.jpg"></a></div>
  <div class="rightList"><a href="#"><span 
  class="txt">첫번째 제목입니다.<br>내용자르기 부제목 자리</span><span class="category"></span></a></div></li>
  <li>
  <div class="thumb"><a href="#"><img alt="" src="<?php echo $latest_skin_url ?>/img/84033788_1_thumb.jpg"></a></div>
  <div class="rightList"><a href="#"><span 
  class="txt">첫번째 제목입니다.<br>내용자르기 부제목 자리</span><span 
  class="category"></span></a></div></li>
  <li>
  <div class="thumb"><a href="#"><img alt="" src="<?php echo $latest_skin_url ?>/img/84033788_1_thumb.jpg"></a></div>
  <div class="rightList"><a href="#"><span 
  class="txt">첫번째 제목입니다.<br>내용자르기 부제목 자리</span><span 
  class="category"></span></a></div></li></ul>
  
<!--
<ul class="news_list" style="display: none;">
  <li>
  <div class="thumb"><a href="#"><img alt="" src="<?php echo $latest_skin_url ?>/img/84033788_1_thumb.jpg"></a></div>
  <div class="rightList"><a href="#"><span 
  class="txt">첫번째 제목입니다.<br>내용자르기 부제목 자리</span><span 
  class="category"></span></a></div></li>
  <li>
  <div class="thumb"><a href="#"><img alt="" src="<?php echo $latest_skin_url ?>/img/84033788_1_thumb.jpg"></a></div>
  <div class="rightList"><a href="#"><span 
  class="txt">첫번째 제목입니다.<br>내용자르기 부제목 자리</span><span 
  class="category"></span></a></div></li>
  <li>
  <div class="thumb"><a href="#"><img alt="" src="<?php echo $latest_skin_url ?>/img/84033788_1_thumb.jpg"></a></div>
  <div class="rightList"><a href="#"><span 
  class="txt">첫번째 제목입니다.<br>내용자르기 부제목 자리</span><span 
  class="category"></span></a></div></li>
  <li>
  <div class="thumb"><a href="#"><img alt="" src="<?php echo $latest_skin_url ?>/img/84033788_1_thumb.jpg"></a></div>
  <div class="rightList"><a href="#"><span 
  class="txt">첫번째 제목입니다.<br>내용자르기 부제목 자리</span><span 
  class="category"></span></a></div></li>
  <li>
  <div class="thumb"><a href="#"><img alt="" src="<?php echo $latest_skin_url ?>/img/84033788_1_thumb.jpg"></a></div>
  <div class="rightList"><a href="#"><span 
  class="txt">첫번째 제목입니다.<br>내용자르기 부제목 자리</span><span 
  class="category"></span></a></div></li></ul>
  
<div class="btn_move"><a onclick="javascript:onlyNewsView(this);return false;" href="#">
<span class="page"><em id="onlyNewsPos">1</em>/2</span><span class="icon_arr"></span></a>
</div></div></div>

<script>
                        function onlyNewsView(obj)
                        {
                            var onlyNewsList = $(obj).parent().parent().find('ul') ;
                            $( onlyNewsList ).each(function(index, item) {
                                if ( $( this ).css('display') == 'none' )
                                {
                                    $( this ).css('display', 'block') ;
                                    $('#onlyNewsPos').html(index+1);
                                }
                                else $( this ).css('display', 'none') ;
                            });
                        }
                        </script>
-->
<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->