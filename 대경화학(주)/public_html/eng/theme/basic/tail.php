<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>
            
            </div> <!--#scont-->
        </div> <!--#scont_wrap-->
		 <? if($bo_table){ ?>
        </div> <!--#inner-->
		<?}?>
	<? if(defined('_INDEX_')) {?>
    <!--메인컨테이너 부분-->
    </div><!--#container_index-->
    <? }else if($bo_table == "" || $co_id == ""){ ?>
    <!--서브컨테이너 부분-->
    </div><!--#container-->
	<? } ?> 
</div>

<!-- } 콘텐츠 끝 -->

<hr>

	<div id="footer">       
		<div class="inr">
			<div class="ft_info v2">
                <h1><?php echo $config['cf_title']; ?></h1>
                <address>
					<div>
						<p>Address : </p>
                        <span>33, Dasan-ro 226beon-gil, Saha-gu, Busan</span>
					</div>
					<div>
						<p>Business License No.: </p>
                        <span>606-81-90992</span>
					</div>
					<div>
						<p>CEO: </p>
						<span>Jeong Do-Yeong</span>
					</div>
                    <div>
                        <p>Tel.: </p>
                        <span>+82-51-263-1490</span>
                    </div>
                    <div>
						<p>Fax: </p>
						<span>+82-51-263-9937</span>
					</div>
                    <div>
                        <p>Email: </p>
                        <span>dkc0062@daekyungchem.net</span>
                    </div>
                    <div>
                        <p><?php echo $config['cf_7_subj']; ?></p>
                        <span><?php echo $config['cf_7']; ?></span>
                    </div>
                    <div>
                        <p><?php echo $config['cf_8_subj']; ?></p>
                        <span><?php echo $config['cf_8']; ?></span>
                    </div>
                    <div>
                        <p><?php echo $config['cf_9_subj']; ?></p>
                        <span><?php echo $config['cf_9']; ?></span>
                    </div>
                    <div>
                        <p><?php echo $config['cf_10_subj']; ?></p>
                        <span><?php echo $config['cf_10']; ?></span>
                    </div>
				</address>
                <div class="copy">
                    <p>COPYRIGHT(c) 2023 <strong><?php echo $config['cf_title']; ?>.</strong> ALL RIGHTS RESERVED.&nbsp;&nbsp;&nbsp;
                        <?php if ($is_admin) {  ?>
                            <a href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fa fa-unlock"></i></a>
                        <?php } else {  ?>
                        <a href="<?php echo G5_BBS_URL ?>/login.php"><i class="fa fa-lock"></i></a>
                        <?php }  ?></span></p>
                </div>
			</div>
			<div class="ft_info v3">
				<div class="scrolltop">
					<a href="#hd" class="goHd"><i>SCROLL UP</i></a>
					
				</div>
				<div class="area_cs flex">
                    <div>
                        <h2>Customer Center</h2>
                        <em>Please call the following number for inquiries.</em>
                        <ul class="call">
                            <li><i class="fa-solid fa-phone"></i> +82-51-263-1490</li>
                        </ul>
                    </div>
				</div>
			</div>

			<div class="line">
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
<script src="<?php echo G5_THEME_JS_URL ?>/jquery.bxslider.min.js"></script><!--메인슬라이더에 필요한 js-->

<script src="<?php echo G5_THEME_JS_URL ?>/mainslider.js"></script><!--메인슬라이더에 필요한 js-->

<?php
include_once(G5_PATH."/tail.sub.php");
?>