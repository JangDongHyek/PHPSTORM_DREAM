<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<!--알람설정 시작-->
<div id="mypage">
	<ul class="area_alarm">
		<li>
			<input type="radio" id="date_alarm01" name="date_alarm" value="ON" checked>
			<label for="date_alarm01">
				<span></span>
				<em>데이트 신청 수락</em>
			</label>
		</li>
		<li>
			<input type="radio" id="date_alarm02" name="date_alarm" value="OFF">
			<label for="date_alarm02">
				<span></span>
				<em>데이트 신청 거절</em>
			</label>
		</li>
	</ul>	
</div><!--mypage-->
<!--마이페이지 끝-->

<script>
    $(function() {
        var alarm = '<?=$mb['propose']?>';
        $("input:radio[name='date_alarm']:radio[value='"+alarm+"']").prop('checked', true);
    });

    $("input:radio[name='date_alarm']").on("click", function () {
        var alarm = this.value;
        $.ajax({
            type: 'POST',
            url: g5_bbs_url + "/ajax.alarm_setting.php",
            data: {alarm : alarm, mode : 'date'},
            success: function (data) {
                if(data == 'success') {
                    swal('설정이 완료되었습니다.')
                    .then(() => {
                        $("input:radio[name='date_alarm']:radio[value='"+alarm+"']").prop('checked', true);
                    });
                }
            }
        });
    });
</script>
