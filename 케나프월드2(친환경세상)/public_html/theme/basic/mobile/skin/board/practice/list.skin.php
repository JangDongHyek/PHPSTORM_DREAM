<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);

?>
<style>
#room { padding:0 10px ; height:auto; margin:0; }
#room .row { margin:5px 0; padding:5px; background:#FFF; border:1px solid #DCDCDC;    border-radius: 5px;}
#room img { width:100%; height:auto; }
#room a { color:#333; font-size: 1.5em; }
#ft { margin-top:20px; }
#room .row .list_title{margin: 25px 0;}

.add {color:#558da6; font-size: 0.6em;/* 한 줄 자르기 */ width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;}
.st { display: inline-block; padding: 2px 4px; margin: 0 7px 3px 0; font-size: 0.95em; text-align: center; color: #4dbcd0; border-radius: 2px; border: 1px solid #4dbcd0;letter-spacing: -1px; font-weight: normal; }
.hours , .tel a{ color: #337ab7 !important;}
	

.swiper-container {width: 100%; height: 100%;background: #3b5998;}
.swiper-slide {text-align: center;font-size: 18px;background: #3b5998; margin: 0px !important; width: 100px !important;}

      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }
	  .swiper-slide a{color:#FFFFFF; line-height: 80px} 
	  .swiper-slide a.active{color:#FFFFFF; border-bottom: 4px solid #fff; line-height: 35px; padding:20px 0 1px 0; } 
	  

</style>
<!--<h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2> -->

<?php if ($is_category) { ?>
<!--<nav id="bo_cate">
	<h2><?php //echo $board['bo_subject'] ?> 카테고리</h2>
	<ul id="bo_cate_ul">
		<?php //echo $category_option ?>
	</ul>
</nav>-->

<!--카테고리메뉴-->
  <div class="swiper-container">
    <div class="swiper-wrapper">
		<div class="swiper-slide"><a href="#">전체</a></div>
      <div class="swiper-slide"><a href="#">중국집</a></div>
      <div class="swiper-slide"><a href="#">치킨</a></div>
      <div class="swiper-slide"><a href="#">피자</a></div>
      <div class="swiper-slide"><a href="#">족발·보쌈</a></div>
      <div class="swiper-slide"><a href="#">야식</a></div>
      <div class="swiper-slide"><a href="#">분식</a></div>
      <div class="swiper-slide"><a href="#">카페·디저트</a></div>
      <div class="swiper-slide"><a href="#">한식</a></div>
      <div class="swiper-slide"><a href="#">돈가스·일식</a></div>
	  <div class="swiper-slide"><a href="#">분식</a></div>
    </div>
  </div>

<script>
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 5,
      spaceBetween: 300,
      freeMode: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
    });
</script>

	  
<?php } ?>

<?php if($is_admin){ ?>
<div style="padding:10px 0; text-align:right;">
<a href="<?php echo $write_href;?>" class="btn btn-primary">업체등록</a>
</div>
<?php } ?>
<article id="room">
	<?php
	for ($i=0; $i<count($list); $i++) { 
	
		$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);
		if($thumb['src']) {
			$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'">';
		} else {
			$img_content = '<span style="width:'.$board['bo_gallery_width'].'px;height:'.$board['bo_gallery_height'].'px">no image</span>';
		}

	?>
	<a href="<?php echo $list[$i]['href'] ?>">
	<div class="row">
		<dl class="col-xs-4" style="padding: 5px !important;"><?php echo $img_content;?></dl>
		<dl class="col-xs-8"   style=" padding-left: 0 !important;">
	    <div class="list_title">
			<dt><?php echo $list[$i]['wr_subject'];?></dt>
			<dd>
				<div class="add"><?php echo $list[$i]['wr_2'];?></div>
				<div class="add">#냉면 #맛집 #응답하라 #우동</div>
				<div class="tel"><a href="tel:<?php echo $list[$i]['wr_18']; ?>">
					<img src="<?php echo G5_THEME_IMG_URL ?>/mobile/phone.png" style=" width: 50px"></a></div>
			</dd>
			</div>
		</dl>
		
	</div>
	</a>
	<?php } ?>
</article><!--room-->

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages;  ?>

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
