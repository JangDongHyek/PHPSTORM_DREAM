<?php
header("Access-Control-Allow-Origin: *");

if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<script type="text/javascript">
    //<![CDATA[
    $(document).ready(function() {
//When page loads...
$(".tab_content").hide(); //Hide all content
$("ul.tabs li:first").addClass("active").show(); //Activate first tab
$(".tab_content:first").show(); //Show first tab content

//On Click Event
$("ul.tabs li").click(function() {
            $("ul.tabs li").removeClass("active"); //Remove any "active" class
            $(this).addClass("active"); //Add "active" class to selected tab
            $(".tab_content").hide(); //Hide all tab content

            var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
            $(activeTab).fadeIn(); //Fade in the active ID content
            return false;
});
    });
//]]>
</script>

<style>

/*지점별 탭메뉴*/
.store_list{width:90%; margin:0 auto;}
.store_list .tabs:after {display:block;visibility:hidden;clear:both;content:""}
.store_list .tabs{padding-left:1px;zoom:1; text-align:center; border-bottom:1px solid #fff;}
.store_list .tabs li{ float:left; text-align:center; margin-left:-1px; margin-bottom:-1px;}
.store_list .tabs li a{display:inline-block;position:relative; padding:15px 20px; width:auto; border:1px solid #1f1b14; border-bottom:0;
						background:#2e2920; color:#fff;text-align:center;letter-spacing:-0.1em;line-height:1.2em; font-size:1.1em; cursor:pointer}
.store_list .tabs li.active a{border-bottom:none; background:none; border:1px solid #fff; border-bottom:1px solid #4E4332;; color:#fff; font-weight:bold; z-index:3; margin:0;}

.store_list .tab_container{clear:both; width:100%; padding-top:30px; box-shadow:none; background:none; z-index:1}
.store_list .tab_container .tab_content{padding:0px; min-height:100px;}

.store_list .list:after{content:""; display:block; clear:both;}
.store_list .list{padding:0px;}
.store_list .list li{float:left; width:calc(33.3333% - 2px); margin:0 3px 3px 0; border:1px solid rgba(255,255,255,0.5); color:#fff; text-align:center;
									   padding:15px 10px; border-radius:3px; box-sizing:border-box;}
.store_list .list li:nth-child(3n+3){margin-right:0;}
/*.store_list dl dd:hover{transition:all 0.5s; border:1px solid #FFCF4D; color:#F9E457;}*/
.store_list .list p{ font-size:1.2em; text-align:left;display:inline-block; width:46%; font-size:1.2em; line-height:34px; }
.store_list .list p a{ color:#fff; display:inline-block; width:calc(100% - 15px); white-space: nowrap;overflow: hidden; text-overflow: ellipsis; vertical-align:middle;}
.store_list .list .btn{background:#2e2920; color:#fff; width:25%; font-size:12px; padding:6px;}
.store_list .list .btn:hover{ background:none; color:#F9E457; border:1px solid #F9E457;}

@media (max-width: 991px) {
.store_list .tabs{border:0;}
.store_list .tabs li{width:33.3333%; padding:1px; margin-bottom:0; margin-left:0;}
.store_list .tabs li a{padding:10px 0; width:100%; font-size:1em; border-bottom:1px solid #1f1b14;}
.store_list .tabs li.active a{border-bottom:1px solid #fff;}

.store_list .list{padding:0;}
.store_list .list li{width:90%; margin:0 5% 3px 5%; padding:10px 15px;}
.store_list .list li p{}
.store_list .list li .btn{font-size:0.85em;}
}

</style>


<div class='store_list'>
    <?
    $category = explode("|", $board['bo_category_list']);
    $cate_count = count($category);
    ?>
    <ul class="tabs">
    <?
    $x = 0;
    foreach ($category as $key) {
        $x++;
        echo "<li><a href='#tab{$x}'>{$key}</a></li>";
    }
    ?>
    </ul>



<div class="tab_container">
    <?
    $x= 0;
	$br=1;
    foreach ($category as $key => $value) {
        $x++;
    ?>

    <div id="tab<?=$x?>" class="tab_content">
        <ul class='list'>
        <?
        for ($i = 0; $i < count($list[$value]); $i++) {
            $li = $list[$value][$i];
			if(!$li['cctv_url']){
				//$li['wr_2'] = "javascript:alert('해당 매장은 [60계치킨 어플]을 다운 받으시면 확인이 가능합니다.');location.href='".G5_BBS_URL."/content.php?co_id=landing';";
				$li['cctv_url'] = "javascript:alert('CCTV 변경 재설치할 예정입니다. 불편드려 죄송합니다.');";
			}
		?>
			<li>
				<dl>
					<dd>
						<p><i class="fa fa-map-marker"></i><a href="<?=$li['href']?>"><?=$li['subject']?></a></p>
						<a href="tel:<?=$li['wr_3']?>" class="btn order"><i class="fa fa-phone"></i> 주문</a>

                        <!--회원일경우만 공개-->
                        <a onclick="checkLoginAndRedirect('<?= $li['cctv_url'] ?>')" class="btn cctv"><i class="fa fa-video-camera"></i> CCTV</a>
                    </dd>
				</dl>
            </li>
		<?
			if($br%3==0){echo "";}
			$br++;
        }

        if ($i==0) { echo "<li>등록된 매장이 없습니다.</li>"; }
        ?>
        </ul>
    </div>
    <? } ?>
    </div>
</div>

<script>
    //FIXME 로그인시에만 CCTV볼수 있게 변경하기위함
    function checkLoginAndRedirect(cctvUrl) {
        var isLoggedIn = <?= $GLOBALS['is_member'] ? 'true' : 'false' ?>;
        var targetUrl = isLoggedIn ? cctvUrl : "<?= G5_URL ?>/bbs/login.php";

        window.location.href = cctvUrl;

/*        if(!isLoggedIn){
            let b = confirm('CCTV를 보기위해선 로그인하셔야합니다. 로그인페이지로 이동하시겠습니까?');
            if(b){
                window.location.href = targetUrl;
            }
        }else{
            window.location.href = targetUrl;
        }*/

    }
</script>