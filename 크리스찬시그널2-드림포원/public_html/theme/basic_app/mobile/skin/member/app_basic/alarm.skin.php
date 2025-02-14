<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<!--알람설정 시작-->
<div id="mypage">
	<ul class="area_alarm">
		<li>
			<input type="radio" id="alarm01" name="alarm" value="ON" checked>
			<label for="alarm01">
				<span></span>
				<em>ON</em>
			</label>
		</li>
		<li>
			<input type="radio" id="alarm02" name="alarm" value="OFF">
			<label for="alarm02">
				<span></span>
				<em>OFF</em>
			</label>
		</li>
	</ul>	
</div><!--mypage-->
<!--마이페이지 끝-->

<script>
    $(function() {
        var alarm = '<?=$mb['alarm']?>';
        $("input:radio[name='alarm']:radio[value='"+alarm+"']").prop('checked', true);
    });

    $("input:radio[name='alarm']").on("click", function () {
        var alarm = this.value;
        $.ajax({
            type: 'POST',
            url: g5_bbs_url + "/ajax.alarm_setting.php",
            data: {alarm : alarm},
            success: function (data) {
                if(data == 'success') {
                    swal('알림이 ' + alarm + '되었습니다.')
                    .then(() => {
                        $("input:radio[name='alarm']:radio[value='"+alarm+"']").prop('checked', true);
                    });
                }
            }
        });
    });
</script>