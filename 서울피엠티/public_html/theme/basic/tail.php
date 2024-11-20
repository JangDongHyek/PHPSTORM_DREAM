<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>

            </div> <!--#scont-->
        </div> <!--#scont_wrap-->
    </div>
</div>

<!-- } 콘텐츠 끝 -->

<hr>



<!-- 하단 시작 { -->
 <div id="ft" class="clearfix">
  <div class="ft_area">
    <div class="flogo col-md-2"><img src="<?php echo G5_THEME_IMG_URL ?>/common/f_logo.png" /></div>
	<div id="ft_copy" class="col-md-10">
        <!--상호-->
        <p class="ct"><?php echo $config['cf_title']; ?></p>
        <!--상호-->
        <!--기본정보-->
        <strong><?php echo $config['cf_1_subj']; ?></strong> <?php echo $config['cf_1']; ?><br />
        <strong><?php echo $config['cf_2_subj']; ?></strong> <?php echo $config['cf_2']; ?>&nbsp;&nbsp;
        <strong><?php echo $config['cf_3_subj']; ?></strong> <?php echo $config['cf_3']; ?>&nbsp;&nbsp;
        <strong><?php echo $config['cf_4_subj']; ?></strong> <?php echo $config['cf_4']; ?>&nbsp;&nbsp;
        <strong><?php echo $config['cf_5_subj']; ?></strong> <?php echo $config['cf_5']; ?><br>
        <strong><?php echo $config['cf_6_subj']; ?></strong> <?php echo $config['cf_6']; ?>&nbsp;&nbsp;
        <strong><?php echo $config['cf_7_subj']; ?></strong> <?php echo $config['cf_7']; ?>&nbsp;&nbsp;
        <strong><?php echo $config['cf_8_subj']; ?></strong> <?php echo $config['cf_8']; ?>&nbsp;&nbsp;
        <strong><?php echo $config['cf_9_subj']; ?></strong> <?php echo $config['cf_9']; ?>&nbsp;&nbsp;
        <strong><?php echo $config['cf_10_subj']; ?></strong> <?php echo $config['cf_10']; ?>&nbsp;&nbsp;
        <!--기본정보-->
    </div>
    
  </div>
</div><!--footer--> 
<div class="copy">COPYRIGHT(C) 2017 Seoul PMT ALL RIGHT RESERVED </div>
<div class="hidden-lg hidden-md t_margin50"></div>

<!--하단고정카테고리-->
<div id="bottom_fix" class="hidden-lg hidden-md wow fadeInUp" data-wow-delay="0.5">
		<div class="bottom_cate">
			<ul>
				<li>
					<a href="<?php echo G5_URL ?>">
						<img src="<?php echo G5_THEME_IMG_URL ?>/common/bottom_cate01.png" alt="HOME" />
					</a>
				</li><!--
			 --><li>
					<a href="tel:<?php echo $config['cf_3']; ?>">
						<img src="<?php echo G5_THEME_IMG_URL ?>/common/bottom_cate02.png" alt="전화걸기" />
					</a>
				</li><!--
		     --><li>
					<a href="sms:<?php echo $config['cf_5']; ?>">
						<img src="<?php echo G5_THEME_IMG_URL ?>/common/bottom_cate03.png" alt="SMS" />
					</a>
				 </li><!--
		     --><!--<li>
					<a href="javascript:alert('카톡공유 준비중입니다.')">
						<img src="<?php echo G5_THEME_IMG_URL ?>/common/bottom_cate04.png" alt="카톡공유"/>
					</a>
				</li>-->
			</ul>
		</div>  
	</div>
    
    
<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	<a href="#hd" class="goHd"><span></span>브라우저 최상단으로 이동합니다</a>
	<a href="#footer" class="goFt"><span></span>브라우저 최하단으로 이동합니다</a>
</div>


<!--//애니메이션 js-->
<script src="<?php echo G5_THEME_JS_URL; ?>/wow.min.js"></script>
<script>
  
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});

/* IE8 이하 브라우저는 애니메이션 스크립트 실행 막아야함 */
var IE = -1;
if (navigator.appName == 'Microsoft Internet Explorer') {
    var ua = navigator.userAgent;
    var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
    if (re.exec(ua) != null) {
        IE = parseFloat(RegExp.$1);
    }
}
if(IE > 9 || IE == -1) new WOW().init();
</script>
<!--//애니메이션 js-->

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>


<script type="text/javascript">
	(function($) {
	  $.fn.semisticky = function(options) {
		return this.each(function() {
		  new SemiSticky($(this), options);
		});
	  };
	}(jQuery));

	var SemiSticky = function(element, options) {
	  var _this = this;
	  
	  options = $.extend({
		offsetLimit: element.outerHeight(),
		scrollThreshold: 50,
		onScroll: function() {}
	  }, options);
	  
	  this.element = element;
	  this.state = 'fixed';
	  this.currentOffsetAmount = 0;
	  
	  this.init = function() {
		var oldScrollTop = $(document).scrollTop();
		var thresholdCounter = 0;
		
		$(window).on('scroll.semisticky', function() {
		  var newScrollTop = $(document).scrollTop();
		  var delta = oldScrollTop - newScrollTop;
		  thresholdCounter = Math.min(Math.max(thresholdCounter + delta, -options.scrollThreshold), options.scrollThreshold);
		  var newOffset;

		  if (Math.abs(thresholdCounter) >= options.scrollThreshold || _this.state == 'scrolling') {
			if (delta < 0 && _this.state !== 'hidden') {
			  
			  if (_this.currentOffsetAmount > -options.offsetLimit) {
				_this.currentOffsetAmount = Math.max(_this.currentOffsetAmount + delta, -options.offsetLimit);
				_this.element.css('top', _this.currentOffsetAmount);
				_this.state = 'scrolling';
			  } else {
				_this.state = 'hidden';
				thresholdCounter = 0;
			  }
			  
			} else if (delta > 0 && _this.state !== 'fixed') {
			  
			  if (_this.currentOffsetAmount < 0) {
				_this.currentOffsetAmount = Math.min(_this.currentOffsetAmount + delta, 0);
				_this.element.css('top', _this.currentOffsetAmount);
				_this.state = 'scrolling';
			  } else {
				_this.state = 'fixed';
				thresholdCounter = 0;
			  }
			  
			}
		  }
		  
		  options.onScroll.call(_this, delta);
		  
		  oldScrollTop = newScrollTop;
		});
	  };
	  
	  this.die = function() {
		$(window).off('scroll.semisticky');
	  };
	  
	  this.init();
	};
	
	</script>
    
    <script>
      $('#hd').semisticky({
        offsetLimit: $('#topm').outerHeight(),
      })
    </script>


<?php
include_once(G5_PATH."/tail.sub.php");
?>