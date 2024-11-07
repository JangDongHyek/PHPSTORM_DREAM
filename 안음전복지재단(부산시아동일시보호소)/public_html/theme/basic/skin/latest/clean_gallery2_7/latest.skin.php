<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$imgwidth = 386.6; //표시할 이미지의 가로사이즈
$imgheight = 200; //표시할 이미지의 세로사이즈
?>

<style>
.n2_7_title_wrap {width:980; height:39px;padding-top:0px; border:1px solid #ccc}
.n2_7_title a:link, .n2_7_title a:visited, .n2_7_title a:active, .n2_7_title a:hover {float:left; text-decoration:none; padding-left:0px; white-space:nowrap; font:bold 12px gulim, dotum; color:#222; line-height:27px}
.n2_7_icon {float:left; margin-left:5px; height:19px}
.n2_7_right_wrap {float:right; padding-top:9px; padding-right:7px;}



#border {border-bottom:1px solid #DFDFDF;height:270px;}


#oneshot_2_7 { position:relative;margin:0 0 0 -2px;}
#oneshot_2_7 .la_title{position:absolute; left:0; top:0; z-index:100; background:#000; padding:0px; font-size:1em; color:#fff;margin:0 0 0 5px;filter:alpha(opacity=50);opacity:.5;}
#oneshot_2_7 .img_set{width:<?php echo $imgwidth ?>px; height:<?php echo $imgheight ?>px; border:0px solid #eaeaea; background-color:#f8f8f8;padding:0;}
#oneshot_2_7 .subject_set{width:<?php echo $imgwidth ?>px; height:auto; padding:8px; z-index:1; bottom:0; left:0;}

#oneshot_2_7 .subject_set .sub_title{
text-decoration:none;
overflow:hidden;
}

#oneshot_2_7 .subject_set .sub_title a:link, #oneshot_2_7 .subject_set .sub_title a:visited, #oneshot_2_7 .subject_set .sub_title a:active, #oneshot_2_7 .subject_set .sub_title a:hover{
margin-left:7px;
font-weight:400;
font-size:15px;
color:#222;
}

#oneshot_2_7 .subject_set .sub_content{
margin-top:10px;
margin-left:7px;
overflow:hidden;
font-size:15px;
color:#999; 
line-height:18px;
}


#oneshot_2_7 .subject_set .dotted{
height:5px;
border-bottom:2px dotted #eee;
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
#oneshot_2_7 li {list-style:none;float:left;text-decoration:none;padding:0; margin: 0 20px 0 0; width: calc((100%/3) - 13.34px); overflow: hidden;}
    #oneshot_2_7 li:nth-child(3n){margin-right: 0;}


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
<div id="oneshot_2_7">
	<!--
	<div class="la_title">
		<?php echo $bo_subject ?>
	</div>
	-->
	<ul>
	<?php for ($i=0; $i<count($list); $i++) { ?>	
		<li>



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



				<!--<div class="dotted"></div>-->
			
				<!--<div class="sub_datetime"><?=$list[$i]['wr_name']?>
				<font color="#CFCFCF">|</font>
                <?=$list[$i]['datetime2']?></div>-->
	
	</div>
</div>
				
		</li>
	<?php } ?>
	</ul>
</div>
</div>
		<!--/////////////////이미지에 테두리/////////////-->
<div style="clear:both;"></div>
