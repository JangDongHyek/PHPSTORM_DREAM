<?php
$title['sm_name'] = '렌터카 예약하기';
$g5['title'] = '렌터카 예약하기';

include_once('./_common.php');
$bo_table="reserve";
//if ($is_guest)
//    alert('로그인 한 회원만 접근하실 수 있습니다.', G5_BBS_URL.'/login.php');

include_once('./_head.php');

$url = clean_xss_tags($_GET['url']);

// url 체크
check_url_host($url);

$url = get_text($url);


?>

<div id="subContainer">
    <section class="sstion w1200">
        <div class="titBox">
            <h3>예약확인<p>예약을 확인 하실 수 있습니다.</p>
            </h3>
        </div>
        <div class="contBox reserVer">
            <div class="ssBox">
                <form name="form" method="get" action="<?php echo G5_BBS_URL?>/board.php">
                    <input type="hidden" name="bo_table" value="reserve">
					<div class="resBox">
					<dl>
						<dt><label for="">이름</label></dt>
						<dd><input type="text" name="swr_name" value="" class="form-control" required></dd>
					</dl>
					<dl>
						<dt><label for="">연락처</label></dt>
						<dd><input type="text" name="swr_7" value="" class="form-control" required></dd>
					</dl>
					<button class="btn btn-primary">확인</button>
				</form>
			</div>
			<!-- /ssBox -->

		</div>
		<!-- /contBox -->
    </section>

</div>
<?
include_once('./_tail.php');
?>