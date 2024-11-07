<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$img_w = 260; // 이미지($img) 가로 크기
$img_h = 260; // 이미지($img) 세로 크기
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

.picBox{overflow:hidden;zoom:1;margin:25px auto 0 auto;width:100%;}
.picL{overflow:hidden;zoom:1;margin-left:0px;}
.picL li{overflow:hidden;position:relative;float:left; display:inline; width:256px;height:auto;margin:0px; zoom:1; transition:all 0.5s; border-top:1px solid #e8e7eb; border-left:1px solid #e8e7eb; border-bottom:1px solid #e8e7eb; text-align:center}
.picL li:nth-child(5n){ border-right:1px solid #e8e7eb; }
.picL li:last-child{ border-right:1px solid #e8e7eb; }
.picL li .text{/*opacity: 0.8;position:absolute;height:300px;top:300px;left:0;*/background:#fff;width:100%; padding:20px}
.picL li .text b{background:#1134a8;padding:5px 20px;color:#ffcc00;font-size:14px;display:none;*display:inline;zoom:1;font-weight:200;}
.picL li .text p{font-size:1.2em;line-height:1.7em; font-weight:bold; text-align:center;}
.picL li .text a{color:#333;font-weight:500;display: block;/*height:100px;*/}
.picL li .text p.code{color:#777; line-height:1.6em; font-size:.9em; font-weight:400}
.picL li .text p.spec{color:#2a5dc5; line-height:1.6em; font-size:1.20em}

@media screen and (max-width:1280px) {
.picL li{width:31.333%!important; margin:1%; transition:all 0.5s; border:1px solid #e8e7eb;}
.picL li:nth-child(5n){width:31.333%!important; margin:1%;}
}

@media screen and (max-width:767px){
.picL li{width:48%!important; margin:1%; transition:all 0.5s; text-align:center}
.picL li:nth-child(5n){width:48%!important; margin:1%;}
.picL li img{ height:200px}
.picL li .text p.spec{color:#2a5dc5; line-height:1.6em; font-size:1.00em}
}

@media screen and (max-width:500px){
.picL li img{ height:120px}
.picL li .text{ min-height:160px}
.picL li .text p{font-size:13px;line-height:16px; font-weight:200; text-align:center;}
.picL li .text a{padding:20px 20px 0 20px;}
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
				   <?php echo mb_strimwidth($list[$i]['wr_1'], '0', '25', '', 'utf-8');?>
                </a>
                </p>
                <p class="code"><?php echo mb_strimwidth($list[$i]['wr_2'], '0', '25', '', 'utf-8');?></p>
                <p class="spec"><?php echo mb_strimwidth($list[$i]['subject'], '0', '25', '', 'utf-8');?></p>
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
		//$(this).find('.text:not(:animated)').animate({top:"0px"}, {easing:"easeInOutExpo"}, 50, function(){});
	},function () {
		//$(this).find('.text').animate({top:"300px"}, {easing:"easeInOutExpo"}, 50, function(){});
	});
});
</script>