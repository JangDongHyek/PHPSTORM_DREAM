<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$share_url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

$fileImage['file'] = get_file("business", $wr_id);
$metaImg = ($fileImage['file'][0])? $fileImage['file'][0]['path'] . "/" . $fileImage['file'][0]['file'] : G5_URL."/img/kakao_new.jpg";

// add_meta('메타태그 구문', 출력순서); //숫자가 작을 수록 먼저 출력됨
$metaTag = "";
$metaTag .= "<meta property='og:title' content='[위캐시] ".$view["wr_subject"]."'>";
$metaTag .= "<meta property='og:description' content='".$view["wr_content"]."'>";
$metaTag .= "<meta property='og:image' content='{$metaImg}'>";
$metaTag .= "<meta property='og:url' content='".G5_BBS_URL."/board.php?bo_table={$bo_table}&wr_id={$wr_id}'>";
add_meta($metaTag, 10);
?>

<!--<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?php echo $config['cf_kakao_js_apikey']; ?>&libraries=services"></script>-->

<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<div id="bo_v_table"><?php echo ($board['bo_mobile_subject'] ? $board['bo_mobile_subject'] : $board['bo_subject']); ?></div>
<article id="bo_v" style="">
    <div id="bo_v_top" style="margin-bottom:0; padding-bottom:0;">
		<div style="float:right; padding:5px;"><img src="<?php echo G5_THEME_IMG_URL ?>/qrcode.jpg" alt="" width="55px"></div>
        <ul class="bo_v_com">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
            <li><a href="<?php echo $list_href ?>" class="btn_b02">목록</a></li>
			<li>	
				<a data-toggle="modal" data-target="#wecash_dialog" class="btn_b01">W결제</a>
				<div id="wecash_dialog" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<dl class="modal-dialog modal-lg">
						<dd class="modal-content modal-point">
							<p>※ 결제하실 위캐시 입력 후 결제버튼을 눌러주세요. </p>
							<p class="row wc-price">
								<span class="col-xs-6">보유중인 위캐시</span>
								<span class="col-xs-6 text-right"><strong><?php echo number_format($member['mb_point']);?></strong></span>
							</p>
							<input type="number" name="wecash_pay" id="wecash_pay" value="" class="frm-input">
							<input type="button" value="결제" class="btn btn-danger" onclick="setPay()">
						</dd>
					</dl>
				</div>
			</li>
			<li>
				<a data-toggle="modal" data-target="#share_dialog" class="btn_b03">SNS</a>
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
							<!--
							<a href="javascript:toSNS('telegram')" title="텔레그램으로 가져가기">
								<img src="<?php echo G5_THEME_IMG_URL;?>/mobile/sns/sns05.png">
							</a>
							-->
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
			</li>
        </ul>
    </div>

    <header>
        <h1 id="bo_v_title">
            <?php
            if ($category_name) echo ($category_name ? '[ '.$view['ca_name'].' ] ' : ''); // 분류 출력 끝
			?>
			<span>
			<?php echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력 ?>
			</span>
		</h1>
    </header>

    <section id="bo_v_info">
        <h2>페이지 정보</h2>
		<div class="row">
			<dl class="col-xs-8 text-left">
				작성자 <?php echo $view['name'] ?><?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?>
			</dl>
			<dl class="col-xs-4 text-right" style="color:#888">
				<span class="sound_only">작성일</span><?php echo date("y-m-d H:i", strtotime($view['wr_datetime'])) ?>
			</dl>
		</div>
		<div class="row">
			<dd class="col-xs-9 text-left">
				<?php if($view['wr_5']){ ?>
				<p>블로그 : <a href="<?php echo $view['wr_5']?>" target="_blank" style="color:#595959;"><?php echo $view['wr_5']?></a></p>
				<?php } ?>
				<?php if($view['wr_6']){ ?>
				<p>홈페이지 : <a href="<?php echo $view['wr_6']?>" target="_blank" style="color:#595959;"><?php echo $view['wr_6']?></a></p>
				<?php } ?>
				<?php if($view['wr_7']){ ?>
				<p>유튜브 : <a href="<?php echo $view['wr_7']?>" target="_blank" style="color:#595959;"><?php echo $view['wr_7']?></a></p>
				<?php } ?>
				<?php if($view['wr_8']){ ?>
				<p>아프리카 TV : <a href="<?php echo $view['wr_8']?>" target="_blank" style="color:#595959;"><?php echo $view['wr_8']?></a></p>
				<?php } ?>
			</dd>
			<dd class="col-xs-3 text-right">
				<i class="fa fa-eye" aria-hidden="true"></i> <?php echo number_format($view['wr_hit']) ?>
				<i class="fa fa-comment" aria-hidden="true" style="color:#333;"></i> <?php echo number_format($view['comment_cnt']); ?>
			</dd>
		</div>
    </section>

    <?php
    if ($view['file']['count']) {
        $cnt = 0;
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
                $cnt++;
        }
    }
     ?>

    <?php if($cnt) { ?>
    <section id="bo_v_file">
        <h2>첨부파일</h2>
        <ul>
        <?php
        // 가변 파일
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
         ?>
            <li>
                <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
                    <img src="<?php echo $board_skin_url ?>/img/icon_file.gif" alt="첨부">
                    <strong><?php echo $view['file'][$i]['source'] ?></strong>
                    <?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
                </a>
                <span class="bo_v_file_cnt"><?php echo $view['file'][$i]['download'] ?>회 다운로드</span>
                <span>DATE : <?php echo $view['file'][$i]['datetime'] ?></span>
            </li>
        <?php
            }
        }
         ?>
        </ul>
    </section>
    <?php } ?>

    <?php
    if ($view['link']) {
    ?>
    <section id="bo_v_link">
        <h2>관련링크</h2>
        <ul>
        <?php
        // 링크
        $cnt = 0;
        for ($i=1; $i<=count($view['link']); $i++) {
            if ($view['link'][$i]) {
                $cnt++;
                $link = cut_str($view['link'][$i], 70);
         ?>
            <li>
                <a href="<?php echo $view['link_href'][$i] ?>" target="_blank">
                    <img src="<?php echo $board_skin_url ?>/img/icon_link.gif" alt="관련링크">
                    <strong><?php echo $link ?></strong>
                </a>
                <span class="bo_v_link_cnt"><?php echo $view['link_hit'][$i] ?>회 연결</span>
            </li>
        <?php
            }
        }
         ?>
        </ul>
    </section>
    <?php } ?>

    <section id="bo_v_atc">
        <h2 id="bo_v_atc_title">본문</h2>

        <?php
        // 파일 출력
        $v_img_count = count($view['file']);
        if($v_img_count) {
            echo "<div id=\"bo_v_img\">\n";

            for ($i=0; $i<=count($view['file']); $i++) {
                if ($view['file'][$i]['view']) {
                    //echo $view['file'][$i]['view'];
                    echo get_view_thumbnail($view['file'][$i]['view']);
                }
            }

            echo "</div>\n";
        }
         ?>
		<?php if($view['wr_2'] && $view['wr_3']){ ?>
		<div id="daum_map" style="width:100%; height:250px;"></div>
		<?php } ?>
        <div id="bo_v_con"><?php echo get_view_thumbnail($view['content']); ?></div>
		
		<?php if($view['wr_10']){ ?>
		<a href="tel:<?php echo $view['wr_10']?>" style="color:#595959;">전화하기 : <?php echo $view['wr_10']?></a></p>
		<?php } ?>

        <?php//echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>

        <?php if ($is_signature) { ?><p><?php echo $signature ?></p><?php } ?>
        <?php if ($scrap_href || $good_href || $nogood_href) { ?>
        <div id="bo_v_act" style="paddind-bottom:5px;">
            <?php if ($good_href) { ?>
            <span class="bo_v_act_gng">
                <a href="<?php echo $good_href.'&amp;'.$qstr ?>" id="good_button" class="btn_b01">좋아요 <strong><?php echo number_format($view['wr_good']) ?></strong></a>
                <b id="bo_v_act_good">이 글을 좋아요하셨습니다</b>
            </span>
            <?php } ?>
            <?php if ($nogood_href) { ?>
            <span class="bo_v_act_gng">
                <a href="<?php echo $nogood_href.'&amp;'.$qstr ?>" id="nogood_button" class="btn_b01">비추천  <strong><?php echo number_format($view['wr_nogood']) ?></strong></a>
                <b id="bo_v_act_nogood"></b>
            </span>
            <?php } ?>
        </div>
        <?php } else {
            if($board['bo_use_good'] || $board['bo_use_nogood']) {
        ?>
        <div id="bo_v_act">
            <?php if($board['bo_use_good']) { ?><span>추천 <strong><?php echo number_format($view['wr_good']) ?></strong></span><?php } ?>
            <?php if($board['bo_use_nogood']) { ?><span>비추천 <strong><?php echo number_format($view['wr_nogood']) ?></strong></span><?php } ?>
        </div>
        <?php
            }
        }
        ?>
        <?php
        include(G5_SNS_PATH."/view.sns.skin.php");
        ?>
    </section>

    <?php
    // 코멘트 입출력
	if($bo_table != "recommend" && $bo_table != "news" && $bo_table != "facebook")
    include_once(G5_BBS_PATH.'/view_comment.php');
     ?>

</article>

<script>

var view_on = function (){
	<?php if ($board['bo_download_point'] < 0) { ?>
	$(function() {
		$("a.view_file_download").click(function() {
			if(!g5_is_member) {
				alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
				return false;
			}

			var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

			if(confirm(msg)) {
				var href = $(this).attr("href")+"&js=on";
				$(this).attr("href", href);

				return true;
			} else {
				return false;
			}
		});
	});
	<?php } ?>

	function board_move(href)
	{
		window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
	}
	$(function() {
		$("a.view_image").click(function() {
			window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
			return false;
		});

		// 추천, 비추천
		$("#good_button, #nogood_button").click(function() {
			var $tx;
			if(this.id == "good_button")
				$tx = $("#bo_v_act_good");
			else
				$tx = $("#bo_v_act_nogood");

			excute_good(this.href, $(this), $tx);
			return false;
		});

	});

	function excute_good(href, $el, $tx)
	{
		$.post(
			href,
			{ js: "on" },
			function(data) {
				if(data.error) {
					alert(data.error);
					return false;
				}

				if(data.count) {
					$el.find("strong").text(number_format(String(data.count)));
					if($tx.attr("id").search("nogood") > -1) {
						$tx.text("이 글을 비추천하셨습니다.");
						$tx.fadeIn(200).delay(2500).fadeOut(200);
					} else {
						$tx.text("이 글을 좋아요 하셨습니다.");
						$tx.fadeIn(200).delay(2500).fadeOut(200);
					}
				}
			}, "json"
		);
	}
}

$(document).ready(function (e){
	view_on();
});

function setPay(){
	var wr_id = "<?php echo $wr_id;?>";
	var wp = $("#wecash_pay").val();

	if(!wp){
		alert("결제하실 위캐시를 입력해주세요.");
		return false;
	}

	$.get("<?php echo G5_BBS_URL;?>/ajax.wecash_update.php", {bo_table:"<?php echo $bo_table;?>", wr_id:wr_id, wp:wp}, function (e){
		if(e.success)
			location.href = "<?php echo G5_BBS_URL;?>/mywallet.php";
		else
			alert(e.msg);
	}, "json");
}
</script>

<script>
var strTitle = '[위캐시] <?php echo $view['subject'];?>';
var strURL = '<?php echo G5_BBS_URL;?>/board.php?bo_table=business&wr_id=<?php echo $view['wr_id'];?>';
var strContent = "<?php echo $view['wr_search1']?"#".$view['wr_search1']:"";?> <?php echo $view['wr_search2']?"#".$view['wr_search2']:"";?> <?php echo $view['wr_search3']?"#".$view['wr_search3']:"";?> <?php echo $view['wr_search4']?"#".$view['wr_search4']:"";?>";

// 사용할 앱의 JavaScript 키를 설정해 주세요. 
Kakao.init('<?php echo $config['cf_kakao_js_apikey']; ?>'); 

// 카카오톡 공유하기 
function sendKakaoTalk() { 
	Kakao.Link.sendDefault({ 
      objectType: 'feed',
        content: {
          title: strTitle,
          description: strContent,
          //imageUrl: '<?php echo $metaImg ?>',
		  imageUrl: g5_url + '/img/kakao2.jpg',
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

var wr_lat = <?=$view['wr_lat']?$view['wr_lat']:"0"?>;
var wr_lng = <?=$view['wr_lng']?$view['wr_lng']:"0"?>;
var mapContainer = document.getElementById('daum_map'), // 지도를 표시할 div 
	mapOption = { 
		center: new daum.maps.LatLng(wr_lat, wr_lng), // 지도의 중심좌표
		draggable: true, // 지도를 생성할때 지도 이동 및 확대/축소를 막으려면 draggable: false 옵션을 추가하세요
		level: 2, // 지도의 확대 레벨
	};

var map = new daum.maps.Map(mapContainer, mapOption); // 지도를 생성합니다
// 마커가 표시될 위치입니다 
var markerPosition  = new daum.maps.LatLng(wr_lat, wr_lng); 
// 마커를 생성합니다
var marker = new daum.maps.Marker({
	position: markerPosition
});
// 마커가 지도 위에 표시되도록 설정합니다
marker.setMap(map);
</script> 