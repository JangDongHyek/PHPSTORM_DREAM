<section id="anc_bo_basic">
    <h2 class="h2_frm"><?=$title?> 폼</h2>
    <?php echo $pg_anchor ?>
		<form name="formJson" method="post" action="./json/query.php" target="jsonFrame">
    <div class=" ">
			<table width="100%">
				<tr>
					<td style="width:50%" valign="top">
						<table>
						<caption><?=$title?> 폼</caption>
					 
						<tbody>
						<tr>
							<th width="30%">필드</th>
							<th width="30%">설명</th>
							<th>전송폼</th>
						</tr>
						<tr>
								<td>division</td>
								<td align="center">구분</td>
								<td align="center">
									<input type="text" name="division" value="member_join" id="division" class="frm_input" maxlength="20">
								</td>
						</tr>
						<tr>
							<td>mb_id</td>
							<td align="center">* 회원아이디</td>
							<td align="center">
								<input type="text" name="mb_id" value="test01" id="mb_id" class="frm_input">
							</td>
						</tr>
						<tr>
							<td>mb_password</td>
							<td align="center">* 비밀번호</td>
							<td align="center">
								<input type="password" name="mb_password" value="1234" id="mb_password" class="frm_input">
							</td>
						</tr>
						<tr>
							<td>mb_password_re</td>
							<td align="center">* 비밀번호확인</td>
							<td align="center">
								<input type="password" name="mb_password_re" value="1234" id="mb_password_re" class="frm_input">
							</td>
						</tr>
						<tr>
							<td>mb_name</td>
							<td align="center">* 이름</td>
							<td align="center">
								<input type="text" name="mb_name" value="이름" id="mb_name" class="frm_input">
							</td>
						</tr>
						<tr>
							<td>mb_nick</td>
							<td align="center">* 닉네임</td>
							<td align="center">
								<input type="text" name="mb_nick" value="닉네임" id="mb_nick" class="frm_input">
							</td>
						</tr>
						<tr>
							<td>mb_email</td>
							<td align="center">E-mail</td>
							<td align="center">
								<input type="email" name="mb_email" value="email@email.com" id="mb_email" class="frm_input">
							</td>
						</tr>
						<tr>
							<td>성공</td>
							<td colspan="2">
								success : true <br>
								message : 축하드립니다. 회원가입이 되었습니다.
							</td>
						</tr>
						<tr>
							<td>실패</td>
							<td colspan="2">
								success : false<br>
								message : [아이디가 중복되었습니다.],[지금 쓰고 있는 닉네임은 사용중에 있습니다.],[E-mail이 중복되었습니다.]
							</td>
						</tr>
						<tr>
							<td colspan="3">
								<button type="submit" class="">확인</button>
							</td>
						</tr>
						</tbody>
						</table>
					</td>
					<td valign="top">
						<table>
							<tr>
								<td align="center">json문서</td>
							</tr>
							<tr>
								<td>
								<iframe src=""  name="jsonFrame" style="width:100%;height:100%;" scrolling="yes" frameborder="0"></iframe>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			</form>
    </div>
</section>

