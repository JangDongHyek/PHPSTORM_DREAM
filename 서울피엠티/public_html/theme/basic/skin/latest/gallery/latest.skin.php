<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$imgwidth = 350; //표시할 이미지의 가로사이즈
$imgheight = 200; //표시할 이미지의 세로사이즈
?>

<style>
/* 새글 스킨 (latest) */
.gall_lt{width:100%; height:auto; margin-top:5px;}
.gall_lt .lt_title {font-size:1.5em; margin-bottom:10px; color:#333;}
.gall_lt .lt_more {position:absolute;top:10px;right:0px; color:#eee;}

.n2_7_title_wrap {width:850; height:39px;padding-top:0px; border:1px solid #ccc}
.n2_7_title a:link, .n2_7_title a:visited, .n2_7_title a:active, .n2_7_title a:hover {float:left; text-decoration:none; padding-left:0px; white-space:nowrap; font:bold 12px; color:#222; line-height:27px}
.n2_7_icon {float:left; margin-left:5px; height:19px}
.n2_7_right_wrap {float:right; padding-top:9px; padding-right:7px;}



#border {width:<?php echo $imgwidth + 2 ?>px;}

#oneshot_2_7 {position:relative;margin:0 0 0 -2px;}
#oneshot_2_7 ul:after{content:""; display:block; clear:both;}
#oneshot_2_7 .la_title{position:absolute; left:0; top:0; z-index:100; background:#000; padding:0px; font-size:1em; color:#fff;margin:0 0 0 5px;filter:alpha(opacity=50);opacity:.5;}
#oneshot_2_7 .img_set{width:<?php echo $imgwidth ?>px; height:<?php echo $imgheight ?>px;}
#oneshot_2_7 .subject_set{width:<?php echo $imgwidth ?>px; padding:10px; z-index:1; bottom:0; left:0; background:#777C85; text-align:center;}
#oneshot_2_7 li:first-child .img_set{margin-left:0px;}
#oneshot_2_7 li:last-child .img_set{margin-right:0;}

/*@media (max-width: 991px) {
}
@media (max-width: 797px) {
#oneshot_2_7{width:100%;}
#oneshot_2_7 li{width:50%;}
#oneshot_2_7 .img_set{width:100%;}
#oneshot_2_7 .img_set .img_left{width:100%;}
#border{width:95%; margin:5px 2.5%;}
}*/

#oneshot_2_7 .subject_set .sub_title{
text-decoration:none;
/*height:17px;*/
padding-top:3px;
/*line-height:30px;*/
width:100%;

}
.sub_title a{display:inline-block; width:100%; white-space: nowrap;overflow: hidden; text-overflow: ellipsis; vertical-align:middle; color:#fff !important; font-size:1.1em !important;}

#oneshot_2_7 .subject_set .sub_title a:link, #oneshot_2_7 .subject_set .sub_title a:visited, #oneshot_2_7 .subject_set .sub_title a:active, #oneshot_2_7 .subject_set .sub_title a:hover{
margin-left:7px;
font-weight:normal;
font-size:12px;
color:#222;
letter-spacing:-1px;
}

#oneshot_2_7 .subject_set .sub_content{
margin-top:10px;
margin-left:7px;
padding-top:7px;
height:58px;
overflow:hidden;
font-size:12px;
color:#666; 
line-height:18px;

border-top:2px dotted #eee;
}


#oneshot_2_7 .subject_set .dotted{
height:5px;
border-bottom:2px dotted #eee;
}

#oneshot_2_7 .subject_set .sub_datetime{
margin-top:3px;
font-size:11px;
color:#999; 
line-height:18px;
width:100%;
color:rgba(255,255,255,0.5);
display:none;
}
#oneshot_2_7 .subject_set .sub_datetime .line{
	display:inline-block;
	background:rgba(255,255,255,0.2);
	width:1px; height:10px;
	margin:0 3px;
	vertical-align:middle;
}

#oneshot_2_7 ul {list-style:none;clear:both;margin:0;padding:0;}
/*이미지 좌우간격*/
#oneshot_2_7 li {list-style:none;float:left;text-decoration:none;padding:0; margin:0 2% 2% 0;}
#oneshot_2_7 li:nth-child(3n+3){margin:0 0 2% 0}


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

<div class="gall_lt">
    <!--<strong class="lt_title"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><?php echo $bo_subject; ?></a></strong>
    <div class="lt_more"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><span class="sound_only"><?php echo $bo_subject ?></span>더보기</a></div> -->
<div id="oneshot_2_7">
	<!--
	<div class="la_title">
		<?php echo $bo_subject ?>
	</div>
	-->
	<ul>
	<?php for ($i=0; $i<count($list); $i++) { ?>	
		<li>



            <div style="position:relative">

  <div id="quick" style="position: absolute; z-index: 2; top: -5px; left: 5px; width: 50px; ">
    <?php
                if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
             ?>
  </div>

</div>



		<!--/////////////////이미지에 테두리/////////////-->
<div id="border">
			<div class="img_set">
				<a href="<?php echo $list[$i]['href'] ?>">
					<?php                
					$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $imgwidth, $imgheight);    					            
					if($thumb['src']) {
					$img_content = '<img class="img_left" src="'.$thumb['src'].'" alt="'.$list[$i]['subject'].'" width="'.$imgwidth.'" height="'.$imgheight.'">';
					} else {
					$img_content = 'NO IMAGE';
					}                
					echo $img_content;												               
					?>
				</a>
			</div>
		

			<div class="subject_set">
				<div class="sub_title">			
				<a href="<?php echo $list[$i]['href'] ?>"><?php echo cut_str($list[$i]['subject'], 36, "..") ?></a></div>


				<!--<div class="dotted"></div> -->
			
				<div class="sub_datetime"><?=$list[$i]['wr_name']?>
				<span class="line"></span>
                <?=$list[$i]['datetime2']?></div>
	
	</div>
</div>
				
		</li>
	<?php } ?>
	</ul>
</div>
		<!--/////////////////이미지에 테두리/////////////-->
<div style="clear:both;"></div>
</div>
