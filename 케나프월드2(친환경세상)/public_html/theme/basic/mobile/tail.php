<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
    </div>
</div>

<hr>
<!--<div id="cusbox">
	<?php /*?><p><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/ico_call.png" alt="고객센터"/></p>
    <h3><?php echo $config['cf_title']; ?> 고객센터</h3>
    <h2 class="call">02-123-1234</h2>
    <div class="con">평일 09:00 ~ 18:00 / 토요일 09:00 ~ 13:00<br />일요일.공휴일 휴무입니다.</div><?php */?>
    <div class="container">
        <div class="gogo row">
            <div class="col-xs-4"><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=request">악보제작 의뢰</a></div>
            <div class="col-xs-4"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=info">공연정보/콩쿠르</a></div>
            <div class="col-xs-4"><a href="<?php echo G5_URL ?>/bbs/write.php?bo_table=report">허위정보 신고하기</a></div>
        </div>
    </div>
</div>-->
<!--cusbox-->
<?php 
/*
if(!$bo_table){ 

// 하단 공유하기용
$shareTitle = "[케나프월드] ";
$shareDesc = "케나프월드";
$shareUrl = "http://canadaw2.itforone.co.kr/";//"https://play.google.com/store/apps/details?id=kr.foryou.wecash";

// add_meta('메타태그 구문', 출력순서);
$metaTag = "";
$metaTag .= "<meta property='og:title' content='{$shareTitle}'>";
$metaTag .= "<meta property='og:description' content='{$shareDesc}'>";
$metaTag .= "<meta property='og:image' content='".G5_URL."/img/logo-y.jpg'>";
$metaTag .= "<meta property='og:url' content='{$shareUrl}'>";
add_meta($metaTag, 10);

?>
<div id="ft">
    <div id="ft_copy" class="container">Copyright &copy;<b><?php echo $config['cf_title']; ?></b> All rights reserved.</div>
    <!--<a data-toggle="modal" data-target="#share_dialog" class="ft_share"><i class="fas fa-share-square"></i></a>-->
    <div id="share_dialog" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <dl class="modal-dialog modal-lg">
            <dd class="modal-content modal-point">
                <a href="javascript:toSNS('blog')" title="네이버블로그로 가져가기">
                    <img src="<?php echo G5_THEME_IMG_URL;?>/mobile/sns/sns07.png">
                </a>
                <a href="javascript:toSNS('line')" title="라인으로 가져가기">
                    <img src="<?php echo G5_THEME_IMG_URL;?>/mobile/sns/sns03.png">
                </a>
                <a href="javascript:shareStory();" title="카카오스토리로 가져가기">
                    <img src="<?php echo G5_THEME_IMG_URL;?>/mobile/sns/sns04.png">
                </a>
                <a href="javascript:toSNS('facebook')" title="페이스북으로 가져가기">
                    <img src="<?php echo G5_THEME_IMG_URL;?>/mobile/sns/sns06.png">
                </a>
                <a href="javascript:toSNS('band')" title="네이버 밴드로 가져가기">
                    <img src="<?php echo G5_THEME_IMG_URL;?>/mobile/sns/sns02.png">
                </a>
                <a href="javascript:sendKakaoTalk();" title="카카오톡으로 가져가기">
                    <img src="<?php echo G5_THEME_IMG_URL;?>/mobile/sns/sns08.png">
                </a>
                <!--<a href="" title="인스타그램 가져가기">
                    <img src="<?php echo G5_THEME_IMG_URL;?>/mobile/sns/sns01.png">
                </a> -->
            </dd>
        </dl>
    </div>
</div>

<script>
var strTitle = '<?=$shareTitle?>',
	strContent = '<?=$shareDesc?>',
	strURL = '<?=$shareUrl?>';
	strImg = g5_url + '/img/kakao2.jpg';

// 사용할 앱의 JavaScript 키를 설정해 주세요. 
// Kakao.init('<?php echo $config['cf_kakao_js_apikey']; ?>'); 

// 카카오톡 공유하기 
function sendKakaoTalk() { 
	Kakao.Link.sendDefault({ 
      objectType: 'feed',
        content: {
          title: strTitle,
          description: strContent,
		  imageUrl: strImg,
          link: {
            mobileWebUrl: strURL,
            webUrl: strURL
          }
        },
        buttons: [
          {
            title: '앱으로 보기',
            link: {
              mobileWebUrl: strURL,
              webUrl: strURL
            }
          }
        ]
	}); 
} 


// 카카오스토리 공유하기 
function shareStory() { 
	Kakao.Story.share({ 
		url: strURL, 
		text: strTitle
	}); 
} 

// send to SNS 
function toSNS(sns) { 

	var snsArray = new Array(); 
	var strMsg = strTitle + " " + strURL; 
	var image = "<?=$metaImg?>"; 

	snsArray['twitter'] = "http://twitter.com/home?status=" + encodeURIComponent(strTitle) + ' ' + encodeURIComponent(strURL); 
	snsArray['facebook'] = "http://www.facebook.com/share.php?u=" + encodeURIComponent(strURL); 
	snsArray['pinterest'] = "http://www.pinterest.com/pin/create/button/?url=" + encodeURIComponent(strURL) + "&media=" + image + "&description=" + encodeURIComponent(strTitle); 
	snsArray['band'] = "http://band.us/plugin/share?body=" + encodeURIComponent(strTitle) + "  " + encodeURIComponent(strURL) + "&route=" + encodeURIComponent(strURL); 
	snsArray['blog'] = "http://blog.naver.com/openapi/share?url=" + encodeURIComponent(strURL) + "&title=" + encodeURIComponent(strTitle); 
	snsArray['line'] = "http://line.me/R/msg/text/?" + encodeURIComponent(strTitle) + " " + encodeURIComponent(strURL); 
	snsArray['pholar'] = "http://www.pholar.co/spi/rephol?url=" + encodeURIComponent(strURL) + "&title=" + encodeURIComponent(strTitle); 
	snsArray['google'] = "https://plus.google.com/share?url=" + encodeURIComponent(strURL) + "&t=" + encodeURIComponent(strTitle); 
	snsArray['telegram'] = "https://telegram.me/share/url?url="+encodeURIComponent(strURL)+"&text="+encodeURIComponent(strTitle); 
	location.href = snsArray[sns];
} 
</script>


<?php } */?>

<!--<div class="ap_bottom"> 
	<ul class="row">
    	<li class="col-xs-3"><a href="#"><i class="fa fa-home fa-2x"></i><p>홈</p></a></li>
        <li class="col-xs-3"><a href="#"><i class="fa fa-phone fa-2x"></i><p>문의</p></a></li>
        <li class="col-xs-3"><a href="#"><i class="fa fa-cog fa-2x"></i><p>설정</p></a></li>
        <li class="col-xs-3"><a href="#"><i class="fa fa-podcast fa-2x"></i><p>종료</p></a></li>
    </ul>
</div>-->
<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	<a href="#hd" class="goHd"><span></span>브라우저 최상단으로 이동합니다</a>
	<a href="#ft" class="goFt"><span></span>브라우저 최하단으로 이동합니다</a>
</div>

<?php
if(G5_DEVICE_BUTTON_DISPLAY && G5_IS_MOBILE) { ?>
<!--<a href="<?php echo get_device_change_url(); ?>" id="device_change">PC 버전으로 보기</a> -->
<?php
}

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>