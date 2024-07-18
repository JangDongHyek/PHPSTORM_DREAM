<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$imgwidth = 200; //표시할 이미지의 가로사이즈
$imgheight = 200; //표시할 이미지의 세로사이즈
?>

<link href="<?php echo G5_URL ?>/css/swiper.css" rel="stylesheet" type="text/css"><!--Swiper-->
<script src="<?php echo G5_URL ?>/js/swiper.jquery.js"></script><!--Swiper-->

<style>
.n2_7_title_wrap {width:850; height:39px;padding-top:0px; border:1px solid #ccc}
.n2_7_title a:link, .n2_7_title a:visited, .n2_7_title a:active, .n2_7_title a:hover {float:left; text-decoration:none; padding-left:0px; white-space:nowrap; font:bold 12px gulim, dotum; color:#222; line-height:27px}
.n2_7_icon {float:left; margin-left:5px; height:19px}
.n2_7_right_wrap {float:right; padding-top:9px; padding-right:7px;}



#border {}
.mask{width:<?php echo $imgwidth ?>px; height:<?php echo $imgheight ?>px; position: absolute; background-color:rgba(25,45,50,0); cursor:pointer; 
	-webkit-transition: all 0.3s ease-out 0.1s;
	-moz-transition: all 0.3s ease-out 0.1s;
	-ms-transition: all 0.3s ease-out 0.1s;
	-o-transition: all 0.3s ease-out 0.1s;
	transition: all 0.3s ease-out 0.1s;}
.mask:hover{background-color:rgba(0,0,0,0.5);}


#oneshot_2_7 { position:relative;margin:0 0 0 0;}
#oneshot_2_7 .la_title{position:absolute; left:0; top:0; z-index:100; background:#000; padding:0px; font-size:1em; color:#fff;margin:0 0 0 5px;filter:alpha(opacity=50);opacity:.5;}
#oneshot_2_7 .img_set{width:<?php echo $imgwidth ?>px; height:<?php echo $imgheight ?>px; margin-right:22px; margin-bottom:20px;}
#oneshot_2_7 .subject_set{width:<?php echo $imgwidth - 12 ?>px; padding:2px/*제목높이간격*/ 10px 5px 1px/*왼쪽간격*/; z-index:1; bottom:0; left:0;}

#oneshot_2_7 .subject_set .sub_title{
text-decoration:none;
overflow:hidden;
/*height:17px;*/
padding-top:3px;
/*line-height:30px;*/
text-align: center;
}

#oneshot_2_7 .subject_set .sub_title a:link, #oneshot_2_7 .subject_set .sub_title a:visited, #oneshot_2_7 .subject_set .sub_title a:active, #oneshot_2_7 .subject_set .sub_title a:hover{
margin-left:7px;
font-weight:normal;
font-size:15px;
color:#222;
line-height:2em;
letter-spacing:-1px;
}

#oneshot_2_7 .subject_set .sub_content{
margin-top:10px;
margin-left:7px;
padding-top:7px;
height:58px;
overflow:hidden;
font-size:12px;
font-family:Dotum,Verdana,Arial;
color:#666; 
line-height:18px;

border-top:2px dotted #eee;
}


#oneshot_2_7 .subject_set .dotted{
height:5px;
border-bottom:2px dotted #e3e3e3;
}

#oneshot_2_7 .subject_set .sub_datetime{
margin-left:7px;
padding-top:3px;
font-size:12px;
font-family:Dotum,Verdana,Arial;
color:#999; 
line-height:28px
}

#oneshot_2_7 ul {list-style:none;clear:both;margin:0;padding:0;}
/*이미지 좌우간격*/
#oneshot_2_7 li {list-style:none;float:left;text-decoration:none;padding:0;}


.bubble_b {
padding: 6px;
background:#E9E9E9;
border:1px solid #DFDFDF;
border-top-left-radius: 4px;
border-top-right-radius: 4px;
border-bottom-right-radius: 4px;
border-bottom-left-radius: 4px;'
}

.bubble 
{

position: relative;
/*width: 265px;
height: 120px;
padding: 0px;
background: #FFFFFF;
-webkit-border-radius: 0px;
-moz-border-radius: 0px;
border-radius: 0px;
border: #7F7F7F solid 1px;*/

}


.bubble:after 
{
content: '';
position: absolute;
border-style: solid;
/*화살표크기*/
border-width: 0 5px 8px;
/*배경칼라*/
border-color: #E9E9E9 transparent;
display: block;
width: 0;
z-index: 1;
/*화살표 배경크기(화살표크기보다 높이를 1픽색 아래로 내려줌), 위치*/
top: -10px;
left: 20px;
}

.bubble:before 
{
content: '';
position: absolute;
border-style: solid;
/*화살표크기*/
border-width: 0 5px 8px;
/*라인칼라///박스칼라보다 더 강해야 비슷하게 보임*/
border-color: #CECECE transparent;
display: block;
width: 0;
z-index: 0;
/*화살표 라인크기(화살표크기보다 높이를 1픽색 아래로 내려줌), 위치*/
top: -11px;
left: 20px;
}



/* 폰트불러오기 */
@font-face {font-family:'NanumBarunGothic';src: url('<?php echo $latest_skin_url ?>/NanumBarunGothic.eot');}
@font-face {font-family:'NanumGothic';src: url('<?php echo $latest_skin_url ?>/NanumGothic.eot');}

</style>

<!-- Demo styles -->
<style>
.swiper-container {
	width: 100%;
	height: 200px;
	margin: 20px auto;
}
.swiper-slide {
	text-align: center;
	font-size: 18px;
	
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
</style>

<!-- Swiper -->
<div class="swiper-container">
	<div class="swiper-wrapper">
	<?php for ($i=0; $i<count($list); $i++) { ?>
		<div class="swiper-slide">
			<a href="<?php echo $list[$i]['href'] ?>">
			<?php                
			$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $imgwidth, $imgheight);    					            
			if($thumb['src']) {
			$img_content = '<img class="img_left" src="'.$thumb['src'].'" alt="'.$list[$i]['subject'].'">';
			} else {
			$img_content = 'NO IMAGE';
			}                
			echo $img_content;												               
			?>
			</a>
		</div>
	<?php } ?>
	</div>
	<!-- Add Pagination -->
	<div class="swiper-pagination" style="display:none;"></div>
</div>

<!-- Swiper JS -->
<script src="../dist/js/swiper.min.js"></script>

<!-- Initialize Swiper -->
<script>
var swiper = new Swiper('.swiper-container', {
	pagination: '.swiper-pagination',
	slidesPerView: 5,
	paginationClickable: true,
	spaceBetween: 25,
	autoplay: 2500,
    autoplayDisableOnInteraction: false,
	loop: true
});
</script>

<div style="clear:both;"></div>
