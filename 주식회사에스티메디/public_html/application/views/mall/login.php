<div id="login" class="member">
	<? include_once VIEWPATH . '_common/navigator.php'; // 위치 ?>

	<div class="boxline">
		<div class="login_form">
			<form name="signin" method="post" autocomplete="off">
				<div class="form_wrap">
					<input type="text" name="id" placeholder="아이디">
					<input type="password" name="password" placeholder="비밀번호">
					<button type="submit" class="btn btn_middle btn_blue">로그인</button>
				</div>

				<div class="btn_wrap">
					<a href="<?=PROJECT_URL?>/findAccount" class="btn btn_gray">아이디 비밀번호 찾기</a>
					<a href="<?=PROJECT_URL?>/signUp" class="btn btn_gray">회원 가입</a>
				</div>
			</form>
		</div>
	</div>
	<br>
	<p class="text-center">※ 회원가입 후 서비스 이용 가능합니다.</p>
</div>

<script>
	const form = document.signin;

	form.addEventListener('submit', async (e) => {
		e.preventDefault();
		const id = form.id.value;
		const password = form.password.value;

		if (id.length == 0) {
			showAlert('아이디를 입력하세요', form.id.focus());
			return false;
		}
		if (password.length < 4) {
			showAlert('비밀번호를 4자이상 입력하세요.', form.password.focus());
			return false;
		}

		const response = await fetchData('/api/signIn', {id, password});
		console.log(response);
		if (response.result) {
            if(response.mb_level == '10'){
                location.href = baseUrl + 'adm/member';
            }else if(response.mb_level == '7') {
                location.href = baseUrl + 'agency/list'
            }else if(response.recent_totalCount * 1 > 0) {
                location.href = baseUrl + 'medicinal/'
            }else{
                location.href = baseUrl;
            }

        } else {
			const message = response.message ? response.message : `로그인에 실패했습니다.`;
			showAlert(message);
		}
	});
</script>
