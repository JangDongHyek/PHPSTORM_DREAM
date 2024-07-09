<div id="find" class="member">
	<? include_once VIEWPATH . '_common/navigator.php'; // 상단메뉴 ?>

	<div class="boxline">
		<form autocomplete="off" name="find">
			<div class="find_form">
				<div class="form_wrap">
					<div role="tabpanel">

						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#find_id" aria-controls="find_id" role="tab" data-toggle="tab">아이디 찾기</a></li>
							<li role="presentation"><a href="#find_pw" aria-controls="find_pw" role="tab" data-toggle="tab">비밀번호 찾기</a></li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="find_id">
								<!--아이디찾기-->
								<input type="text" name="name" placeholder="이름">
								<input type="text" name="email" placeholder="가입시 등록 이메일">
								<div class="result"><!--찾기결과--></div>
								<div class="btn_wrap">
									<button type="button" id="btnFindId" class="btn btn_middle btn_greenline">아이디 찾기</button>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="find_pw">
								<!--비밀번호찾기-->
								<input type="text" name="id" placeholder="아이디">
								<input type="text" name="email" placeholder="가입시 등록 이메일">
								<div class="result"><!--찾기결과--></div>
								<div class="btn_wrap">
									<button type="button" id="btnFindPw" class="btn btn_middle btn_greenline">비밀번호 찾기</button>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</form>
	</div>
</div>

<script>
	// 아이디찾기
	document.querySelector('#btnFindId').addEventListener('click', async (e) => {
		e.preventDefault();
		const row = document.querySelector('#find_id');
		const nameElem = row.querySelector('[name=name]');
		const emailElem = row.querySelector('[name=email]');
		const resultWrap = row.querySelector('div.result');

		if (nameElem.value.length < 2) {
			return showAlert('이름을 2자 이상 입력해 주세요.', nameElem.focus());
		}
		if (emailElem.value == '' || !isValidEmail(emailElem.value)) {
			return showAlert('이메일을 올바르게 입력해 주세요.', emailElem.focus());
		}

		const json = {name: nameElem.value, email: emailElem.value,};
		const response = await fetchData(`/api/findId`, json);
		// console.log(response);

		let html = ``;
		if (response.result.length == 0) {
			html = `<div class="txt_green">입력하신 정보와 일치하는 아이디가 없습니다.</div>`;
		} else {
			const list = response.result;
			html = `<strong>아이디 찾기 결과</strong>`;
			html += `<div>가입된 아이디가 총 <strong>${list.length}개</strong> 있습니다.</div>`;

			list.forEach(data => {
				html += `
					<div style="margin: 7px 0;font-size:15px;">
						<strong class="txt_green">${data.mb_id}</strong> (가입일: ${data.reg_date})
					</div>`;
			});
		}
		resultWrap.innerHTML = html;
	});

	// 비밀번호찾기
	document.querySelector('#btnFindPw').addEventListener('click', async (e) => {
		e.preventDefault();

		const row = document.querySelector('#find_pw');
		const idElem = row.querySelector('[name=id]');
		const emailElem = row.querySelector('[name=email]');
		const resultWrap = row.querySelector('div.result');

		if (idElem.value.length == '') {
			return showAlert('아이디를 입력해 주세요.', idElem.focus());
		}
		if (emailElem.value == '' || !isValidEmail(emailElem.value)) {
			return showAlert('이메일을 올바르게 입력해 주세요.', emailElem.focus());
		}

		const json = {id: idElem.value, email: emailElem.value,};
		const response = await fetchData(`/api/findPw`, json);
		console.log(response);
		let html = ``;
		if (response.result) {
			html = `<strong>비밀번호 찾기 결과</strong>`;
			html += `<div>회원님의 <span class="txt_green">이메일로 임시비밀번호를 발송</span>하였습니다.`;
		} else {
			html = `<div class="txt_green">입력하신 정보와 일치하는 회원정보가 없습니다.</div>`;
		}
		resultWrap.innerHTML = html;
	});


</script>
