<?
include_once('./_common.php');

$g5['title'] = 'Bunkering Station';
include_once('./_head.php');

loginCheck($member['mb_id'], $member['mb_category']);
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">
<link rel="stylesheet" href="<?=G5_URL?>/css/calendar_style.css?v=<?= G5_CSS_VER ?>">
<link rel="stylesheet" href="<?=G5_URL?>/css/theme.css?v=<?= G5_CSS_VER ?>">
<script src="<?=G5_URL?>/js/calendar.min.js"></script>
<style>
	#container{padding:0 0 140px;}
    .week:not(.start-on-monday) .day:first-child {color: red;}
    .week .day:first-child, .week .day:last-child {color: blue;}
</style>

<!-- 마케팅 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="podoCS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">Marketing product</h4>
                </div>
                <div class="modal-body">
					<div class="txt">
						<h3>"Marketing product in preparation" </h3>
						<span>For banner ads, please contact the administrator.</span>
						<a href="mailto:support@podosea.com">support@podosea.com</a>
					</div>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 마케팅 모달팝업 -->

<div id="area_bunker">
	<div id="sub_bn">
		<div class="txt">
			<h2>Bunkering Station</h2>
			<span>Attend every day and earn bunker points!</span>
			<a href="javascript:javascript:checkAttendance();">Check Attendance</a>
		</div>
		<!--<div class="obj"><img src="<?php echo G5_IMG_URL ?>/obj_coin.png"></div>-->
	</div>
	<div class="bunker_info">
		<div class="inr v3">
			<div class="box">
				<h3>Check Attendance</h3>
				<div class="area_table">
					 <div class="calendar-wrapper" id="calendar-wrapper"></div>
					<div class="btn_check" onclick="checkAttendance();">check attendance</div>
				</div>
			</div>
			<div class="box">
				<h3>Upgrade corporate membership</h3>
				<div id="area_premium">
					<a href="<?=G5_BBS_URL?>/premium.php" >
						<div class="obj"><img src="<?php echo G5_IMG_URL ?>/obj_premium.png"></div>
						<div class="txt">
							<h2><span class="bold">Upgrade to <span class="bold last">Premium membership</span></span></h2>
							<em>Upgrade to Premium membership to enjoy various benefits!</em>
						</div>
					</a>
				</div>
			</div>
			<div class="box">
				<h3>Advertisement Inquiry</h3>
				<div id="area_premium" class="ad" >
					<a href="" data-toggle="modal" data-target="#podoCS">
						<div class="obj"><img src="<?php echo G5_IMG_URL ?>/obj_ad.png"></div>
						<div class="txt">
							<h2><span class="bold last">Korea’s first specialized maritime marketing</span></h2>
							<em>Start marketing with Podosea for not only high visibility, but also for increased sales</em>
						</div>
					</a>
				</div>
			</div>
			<!--
			<div class="box last">
				<h3>등급별 혜택</h3>
				<div class="area_table grade">
					<div class="scrollTable">
					<table class="table v1">
						<colgroup>
							<col style="width:30%">
							<col style="width:10%">
							<col style="width:10%">
							<col style="width:50%">
						</colgroup>
						<thead>
							<tr>
								<th>혜택</th>
								<th>Basic</th>
								<th>Premium</th>
								<th>비고</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>기본 기업 홈페이지</td>
								<td>O</td>
								<td>O</td>
								<td><p>기업회원 프로필 바탕으로 자동 작성됩니다.</p></td>
							</tr>
							<tr>
								<td>고급 기업 홈페이지</td>
								<td>X</td>
								<td>O</td>
								<td>
									<ul>
										<li>카다로그 표시</li>
										<li>기업 홍보영상 표시</li>
									</ul>
								</td>
							</tr>	
							<tr>
								<td>기업 검색시 상위노출</td>
								<td>X</td>
								<td>O</td>
								<td><p>동일조건에서 Premium 회원이 상위노출됩니다.</p></td>
							</tr>	
							<tr>
								<td>검색키워드 개수</td>
								<td>5개</td>
								<td>10개</td>
								<td></td>
							</tr>
							<tr>
								<td>기업의뢰에 대한 견적 회신</td>
								<td>과금</td>
								<td>무료</td>
								<td><p>Basic 회원은 기업 의뢰시 견적금액별 벙커가 소모됩니다.</p></td>
							</tr>
							<tr>
								<td>매물올리기, 채용공고</td>
								<td>과금</td>
								<td>무료</td>
								<td><p>Basic 회원은 매물올리기와 채용공고 등록시 건당 500벙커가 소모됩니다.</p></td>
							</tr>
						</tbody>
					</table>
				</div>
				</div>
			</div>
			-->
		</div>
	</div>
</div>

<?
include_once('./_tail.php');
?>

<script>
    // 날짜 선택 시
	/*function selectDate(date) {
	  $('#calendar-wrapper').updateCalendarOptions({
		    date: date
	  });
	  console.log(calendar.getSelectedDate());
	}*/

    $(function() {
        // 달력 기본 세팅
        var defaultConfig = {
            weekDayLength: 1,
            date: new Date().toLocaleDateString('en-US'),
            //onClickDate: selectDate,
            showYearDropdown: false,
            startOnMonday: false,
            enableMonthChange: false,
        };
        $('#calendar-wrapper').calendar(defaultConfig);
        $('div').removeClass('selected');

        // 출석 체크 한 일자에 표시
        $('.podosea').each(function() {
            if('<?=date('Y-m-d')?>' >= formatDate($(this).attr('data-date'))) {
                var attr = $(this);
                var tmp = formatDate($(this).attr('data-date')).split('-');
                var date = tmp[1]+'/'+tmp[2]+'/'+tmp[0];

                $.ajax({
                    url: g5_bbs_url + '/ajax.attendance_check.php',
                    type: 'post',
                    data: {date: date, mode: 'check'},
                    async: false,
                    success: function (data) { // fail - 출석체크 함, success - 출석체크 안함
                        if(data == 'fail') {
                            attr.addClass('selected')
                        }
                    },
                });
            }
        });
    });

    // 날짜 포맷
    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1) ,
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join('-');
    }

    // 출석 체크
	function checkAttendance() {
	    $.ajax({
            url: g5_bbs_url+'/ajax.attendance_check.php',
            type: 'post',
            data: {date: new Date().toLocaleDateString('en-US'), mode: 'update'},
            success: function(data) {
                if(data == 'fail') {
                    swal("Attendance check has already been completed.");
                } else {
                    swal("Attendance check!\n100 BUNKER payment completed.")
                    .then(()=> {
                        location.reload();
                    });
                }
            }
        });
    }
</script>