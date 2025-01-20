<!--관리자 정보수정 모달-->
<?php
$CI =& get_instance();
$member = $CI->session->userdata('member');
?>
<div class="modal fade" id="adminfo01" tabindex="-1" aria-labelledby="adminfo01Label" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="adminfo01Label">관리자 정보수정</h5>
			</div>
			<form name="infoFrm" method="post" autocomplete="off">
				<input type="hidden" name="idx" value="<?=$member['idx']?>">
				<div class="modal-body">
					<label>아이디</label>
					<input type="text" value="<?=$member['mb_id']?>" readonly disabled>
					<label>이름</label>
					<input type="text" name="name" value="<?=$member['mb_name']?>" required>
					<label>비밀번호</label>
					<input type="password" name="password" placeholder="새 비밀번호 입력">
					<label>비밀번호 확인</label>
					<input type="password" name="passwordChk" placeholder="새 비밀번호 확인">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn" data-dismiss="modal">취소</button>
					<button type="button" class="btn btn_green" onclick="modifyInfo(document.infoFrm)"><span class="labelMsg">정보수정</span></button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	document.infoFrm.addEventListener('submit', (e) => {
		e.preventDefault();
		return false;
	})

	// 등록/수정
	const modifyInfo = async (form) => {

		// 필수필드 검사
		form.name.value = removeWhitespace(form.name.value);
		if (form.name.value.length < 2) {
			return showAlert('이름을 입력해 주세요.', form.name.focus());
		}

		if (form.password.value != '' || form.passwordChk.value != '') {
			if (form.password.value.length < 4) {
				return showAlert('비밀번호 변경시 4자 이상 입력해 주세요.', form.password.focus());

			} else {
				if (form.password.value != form.passwordChk.value) {
					return showAlert('비밀번호와 비밀번호확인이 맞지 않습니다.', form.password.focus());
				}
			}
		}

		const formData = new FormData(form);
		const response = await fetchData(`/apiAdmin/updateAdmInfo`, formData);
		if (response.result) {
			form.password.value = '';
			form.passwordChk.value = '';
			showAlert('변경되었습니다.', () => $('#adminfo01').modal('hide'));
		} else {
			showAlert('정보수정에 실패했습니다.<br>잠시 후 다시 시도해 주세요.');
		}
	};

</script>
