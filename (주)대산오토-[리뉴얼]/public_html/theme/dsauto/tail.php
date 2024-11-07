<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>

            </div> <!--#scont-->
        </div> <!--#scont_wrap-->
	<? if(defined('_INDEX_')) {?>
    <!--메인컨테이너 부분-->
    </article><!--#container_index-->
    <? }else if($bo_table == "" || $co_id == ""){ ?>
    <!--서브컨테이너 부분-->
    </article><!--#container-->
	<? } ?> 
</div>

<!-- } 콘텐츠 끝 -->

<hr>

	<div id="footer">       
		<div class="inr">			
			<div class="ft_info v1">
				<ul class="ft_menu">
					<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=introduce01">Company Introduce</a></li> 
					<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=g_part01">Main Parts</a></li>  
					<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=g_part_sale">Sale Parts</a></li>  
					<li><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=b_online">Online Request</a></li>  
					<li><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=b_request">Order Parts</a></li> 
                    <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=b_intranet01"><i class="fas fa-address-card"></i> Daesan Intranet</a></li> 
				</ul>
				<div class="copy">
					<p>COPYRIGHT(c) 2020 <strong><?php echo $config['cf_title']; ?>.</strong> <br>ALL RIGHTS RESERVED.&nbsp;&nbsp;&nbsp;
        <?php if ($member[mb_level]==10) {  ?>
        <a href="<?php echo G5_BBS_URL ?>/logout.php" style="color:#fff"><i class="fa fa-unlock"></i></a>
		<a href="<?php echo G5_BBS_URL?>/board.php?bo_table=b_search_like" style="color:#fff">연관검색어</a>
        <?php } else {  ?>
        <a href="<?php echo G5_BBS_URL ?>/login.php" style="color:#fff"><i class="fa fa-lock"></i></a>
        <?php }  ?></p>
				</div>
			</div>
			<div class="ft_info v2">
				<address>
					<h1><?php echo $config['cf_title']; ?></h1> 
					<div>
						<p><?php echo $config['cf_2_subj']; ?></p> 
						<span><?php echo $config['cf_2']; ?></span>
					</div>
					<div>
						<p><?php echo $config['cf_3_subj']; ?></p> 
						<span><?php echo $config['cf_3']; ?></span>
					</div>
					<div>
						<p><?php echo $config['cf_4_subj']; ?></p> 
						<span><?php echo $config['cf_4']; ?></span>
					</div>
					<div>
						<p><?php echo $config['cf_5_subj']; ?></p> 
						<span><?php echo $config['cf_5']; ?></span>
					</div>
					<div>
						<p><?php echo $config['cf_6_subj']; ?></p> 
						<span><?php echo $config['cf_6']; ?></span>
					</div>
					<div>
						<p><?php echo $config['cf_7_subj']; ?></p> 
						<span><?php echo $config['cf_7']; ?></span>
					</div>
				</address>
			
			</div>
			<div class="ft_info v3">
				<div class="scrolltop">
					<a href="#hd" class="goHd"><i>SCROLL UP</i></a>
					
				</div>
				<div class="area_cs">
					<em>CS CENTER</em>	
					<h2>고객센터</h2>
					<ul class="call">
						<li><a href=""><span><?php echo $config['cf_4_subj']; ?></span><?php echo $config['cf_4']; ?></a></li>
						<li><a href=""><span><?php echo $config['cf_5_subj']; ?></span><?php echo $config['cf_5']; ?></a></li>
					</ul>
				</div>
			</div>

			<div class="line">
				<i></i>
				<i></i>
				<i></i>
			</div>
		</div>	
	</div><!--#footer--> 

    

    




<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>