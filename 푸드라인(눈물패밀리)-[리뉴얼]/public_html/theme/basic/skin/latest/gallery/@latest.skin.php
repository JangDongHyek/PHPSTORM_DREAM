<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$img_w = 280; // 이미지($img) 가로 크기
$img_h = 300; // 이미지($img) 세로 크기
?>

<style type="text/css">

img{-webkit-backface-visibility: hidden;-webkit-transition: opacity 0.3s ease-out;-moz-transition: opacity 0.3s ease-out;-o-transition: opacity 0.3s ease-out;transition: opacity 0.3s ease-out;}
img:hover{opacity:0.8}
p{word-wrap:break-word}  
.cf:after{content:"";display:table;clear:both}  
.cf{*zoom:1}
.fl,.layout .fl,.chief{float:left;display:inline}
.fr,.layout .fr,.extra{float:right;display:inline}
h1,h2,h3,dt{font-weight:100;font-size:15px;}

.picBox{overflow:hidden;zoom:1;margin:40px auto 0 auto;width:100%;}
.picL{overflow:hidden;zoom:1;margin-left:-1px;}
.picL li{overflow:hidden;position:relative;float:left; display:inline; width:280px;height:auto;margin:5px 26px 20px 0px; zoom:1; transition:all 0.5s;}
.picL li:nth-child(4n){ margin:5px 0px 20px 0px}
.picL li .text{opacity: 0.8;  background:#191919;position:absolute;width:100%;height:300px;top:300px;left:0;}
.picL li .text b{background:#1134a8;padding:5px 20px;color:#ffcc00;font-size:14px;display:inline-block;*display:inline;zoom:1;font-weight:200;}
.picL li .text p{font-size:17px;line-height:300px; font-weight:200; text-align:center;}
.picL li .text a{color: #fff;font-weight:200;display: block;height: 100px;padding:0px 20px 0 20px;}

@media screen and (max-width:1199px) {
.picL li{width:31.333%!important; margin:1%; transition:all 0.5s;}
.picL li:nth-child(4n){width:31.333%!important; margin:1%;}
}

@media screen and (max-width:767px){
.picL li{width:48%!important; margin:1%; transition:all 0.5s; text-align:center}
.picL li:nth-child(4n){width:48%!important; margin:1%;}
}

@media screen and (max-width:500px){
.picL li img{ height:120px}
.picL li .text p{font-size:13px;line-height:16px; font-weight:200; text-align:center;}
.picL li .text a{padding:30px 20px 0 20px;}
}
</style>

<div class="picBox">
	<ul class="picL" id="picLsy" >
		<?php
			for($i=0; $i<count($list); $i++){
				$thumbs = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $img_w, $img_h, false, true);
			if($thumbs['src']) {
				$img = $thumbs['src'];
			}?>	
		<li>
			<a title="<?php echo $list[$i]['subject']?>" href="<?php echo $list[$i]['href'].'&amp;sca='.urlencode($list[$i]['ca_name']); ?>" target="_self"><img src="<?php echo $img?>" alt="<?php echo $list[$i]['subject']?>" /></a>
			<div class="text">
				<b><?php echo $list[$i]['ca_name']?></b>
				<p>
                <a title="<?php echo $list[$i]['subject']?>" href="<?php echo $list[$i]['href'].'&amp;sca='.urlencode($list[$i]['ca_name']); ?>">
				   <?php echo mb_strimwidth($list[$i]['subject'], '0', '25', '', 'utf-8');?>
                </a></p>
			</div>
		</li>
		<? } ?>
        <?php if (count($list) == 0) { //게시물이 없을 때  ?>
        <div class="text-center b_margin20"><span style="font-size:1.30em">게시물이 없습니다.</span></div>
        <?php }  ?>
	</ul>
</div>

<script type="text/javascript" src="<?=$latest_skin_url?>/js/jquery.easing.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#picLsy li").hover(function(){
		$(this).find('.text:not(:animated)').animate({top:"0px"}, {easing:"easeInOutExpo"}, 50, function(){});
	},function () {
		$(this).find('.text').animate({top:"300px"}, {easing:"easeInOutExpo"}, 50, function(){});
	});
});
</script>