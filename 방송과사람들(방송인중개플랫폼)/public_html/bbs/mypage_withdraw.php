<?
include_once('./_common.php');
$name = "cmypage";
$g5['title'] = '캐쉬관리';
include_once('./_head.php');


?>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

    <div id="area_mypage" class="withdraw">
		<div class="inr">

			<?php include_once('./mypage_info.php'); ?> 
			
			<div id="mypage_wrap">	
				<div class="mypage_cont">
					<div class="mypage_cont_wrap">
					<div class="box">
						<h3>출금하기</h3>
						
						 <div class="withdraw_info">
							<ul>
								<li class="col2">
									<div class="title"><span>예금주</span></div>
									<div class="cont"><input type="text" id="account_holder" value="<?=$data['account_holder']?>" name="account_holder" required class="required" <?=$readonly?>></div>
								</li>
								<li class="col2">
									<div class="title"><span>은행명</span></div>
									<div class="cont">
										<select id="bank" name="bank" required class="required" <?=$disabled?>>
											<option value="">은행 선택</option>
											<?php foreach ($bank_list as $code=>$name) { echo $code; ?>
											<option value="<?=$code?>" <?php echo $data['bank'] == $code ? 'selected' : ''; ?>><?=$name?></option>
											<? } ?>
										</select>
									</div>
								</li>
								<li>
									<div class="title"><span>계좌번호 (숫자만 입력)</span></div>
									<div class="cont"><input type="text" id="account_number" value="<?=$data['account_number']?>" name="account_number" required class="required" onkeyup="only_number(this);" <?=$readonly?>></em></div>
								</li>
								<li class="secret_num">
									<div class="title"><span>주민번호</span></div>
									<div class="cont">
										<input type="text" id="reg_number1" value="<?=$registration_number[0]?>" name="reg_number1" required class="required" maxlength="6" onkeyup="only_number(this);" <?=$readonly?>>
										<i>-</i>
										<input type="password" id="reg_number2" value="<?=$registration_number[1]?>" name="reg_number2" required class="required" maxlength="7" onkeyup="only_number(this);" <?=$readonly?>>
									</div>
									<div class="info">
										<em>* 주민번호는 입금받으실 예금주의 주민번호여야 합니다.</em>
										<em>* 회원정보와 예금주 정보가 다를 경우 등록이 거절될 수 있습니다.</em>
									</div>
								</li>
							</ul>
						</div>
						<div class="withdraw_info v2">
							<a class="btn_withdraw" href="">출금신청하기</a>
						</div>

					</div>
				</div>

               
	
                </div>

				<?php include_once('./mypage_menu.php'); ?> 	
			</div>
		</div>
	</div>




<?
include_once('./_tail.php');
?>

