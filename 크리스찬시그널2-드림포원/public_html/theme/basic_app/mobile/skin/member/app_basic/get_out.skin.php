<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);


?>
<style>
	#serviceout .modal-dialog {
		position: absolute;
		width: 90%;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%) !important;
	}
	#serviceout .modal-body{
		min-height: 80px;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	#serviceout .modal-footer button {
		width: 100%;
		height: 50px;
		line-height: 50px;
		background: #fe8ea6;
		border: none;
		color: #fff;
		font-size: 1.3em;
		letter-spacing: -1px;
	}

</style>
<div id="basic_modal">
	<div class="modal fade" id="serviceout" tabindex="-1" role="dialog" aria-labelledby="secret_serviceoutLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
					<h4 class="modal-title" id="myModalLabel">탈퇴 신청완료</h4>
				</div>
				<div class="modal-body">
					<p>관리자에게 안내됩니다.</p>
				</div>

				<div class="modal-footer">
					<button type="button" data-dismiss="modal" id="" onclick="location.href='./logout.php'" >확인</button>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="mbskin " id="get_out">
	<h2 class="title_top">탈퇴안내</h2>
	<div class="regi_info">
		<p class="">탈퇴시 유료열람에 대한 <br>현금화적용후 탈퇴됩니다<br>[10만나에 1,000원적용]</p>
	</div>
	
	<textarea placeholder="탈퇴사유를 적어주세요" id="del_comment"></textarea>


<!--   240523 추가-->
    <div class="widthdraw_agr_wrap">
        <p class="txt-gray">회원 탈퇴 진행시 계정 복구가 불가능하며, 모든 데이터가 삭제되는 부분 동의하시나요?</p>
        <input type="checkbox" id="widthdraw_agr">
        <label for="widthdraw_agr"><i class="fa-solid fa-circle-check"></i>동의합니다</label>
    </div>
<!--   240523 추가-->


	<div class="btnBox">
        <!--
		<button class="btn_submit ft_btn"  data-toggle="modal" data-target="#serviceout" onclick="del_request()">탈퇴하기</button>
		-->
        <button class="btn_submit ft_btn"  onclick="del_request()">탈퇴하기</button>
	</div>
</div>
<script>
    function del_request(){
        var mb_id = '<?=$member['mb_id']?>';
        var del_comment = $('#del_comment').val();

        if(!del_comment){
            swal('탈퇴사유를 입력해주세요.');
            $('#del_comment').focus();
            return false;
        }

        if($('#widthdraw_agr').is(":checked")){
            $.ajax({
                url: g5_bbs_url + "/ajax.mb_del_request.php",
                type: "POST",
                data: {
                    "del_comment": del_comment,
                    "mb_id": mb_id,
                },
                success: function(data) {
                    console.log(data);
                    if (data) {
                        $('#serviceout').modal('show');
                    }else{
                        swal('알수없는 오류로 다시시도해주세요.');
                    }
                }
            });
        }else{
            swal('탈퇴에 동의해주세요.');
            $('#widthdraw_agr').focus();
            return false;
        }


    }
</script>
