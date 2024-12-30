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
									<input type="text" name="division" value="menu" id="menu" class="frm_input" maxlength="20">
								</td>
						</tr>
						<tr>
							<td>성공</td>
							<td colspan="2">
								success : true <br>
								message : 
							</td>
						</tr>
						<tr>
							<td>실패</td>
							<td colspan="2">
								success : false<br>
								message : [메뉴불러오기에 실패하였습니다.]
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

