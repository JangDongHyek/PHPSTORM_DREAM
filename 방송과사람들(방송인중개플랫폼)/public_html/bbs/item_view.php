<?
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");
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


<div id="viewapp">
    <product-view primary="<?=$_GET['idx']?>" member_idx="<?=$member['mb_no']?>"></product-view>
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
$jl->vueLoad("viewapp");
include_once($jl->ROOT."/component/product/product-view.php");
include_once($jl->ROOT."/component/product/product-view-right.php");
$jl->componentLoad("part");

include_once('./_tail.php');
?>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".testSwiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 4,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 5,
                spaceBetween: 50,
            },
        },
    });
</script>

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

    //상품서비스 상세 포트폴리오
    $(document).ready(function() {
        $('button[name="btnToggle"]').click(function() {
            var $portConts = $(this).siblings('.port_conts');

            // 포트폴리오 내용을 확장/축소
            $portConts.toggleClass('expanded');

            // 버튼 텍스트와 아이콘 변경
            if ($portConts.hasClass('expanded')) {
                $(this).text('접기'); // 'html' 대신 'text'를 사용하는 것이 좋습니다.
            } else {
                $(this).text('더보기'); // 'html' 대신 'text'를 사용하는 것이 좋습니다.
            }
        });
    });



</script>
