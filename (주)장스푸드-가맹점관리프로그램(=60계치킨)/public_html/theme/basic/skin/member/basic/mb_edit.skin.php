<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<div id="index_wrap">
<div id="index_box">

<div class="mbskin">
    <form  name="fregister" id="fregister" action="<?php echo G5_BBS_URL.'/mb_edit_update.php' ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">

    <section id="fregister_term">
        <h2>정보수정</h2>
        
		<table class="me_tbl">
		<tbody>
		<tr>
			<td class="me_box_td x270">
			<?php
			if($member['mb_10'] != ''){
				$mb_icon_path = G5_DATA_PATH.'/member/'.substr($member['mb_id'],0,2).'/'.$member['mb_id'].'.'.$member['mb_10'];
				$mb_icon = G5_DATA_URL.'/member/'.substr($member['mb_id'],0,2).'/'.$member['mb_id'].'.'.$member['mb_10'];

				if(file_exists($mb_icon_path)){
			?>
			<img src="<?php echo $mb_icon ?>" border="0" style="width:100%; max-width:230px;">
			<?php
				}
			}
			?>
			</td>
			<td class="me_box_td">
			
				<table class="me_tbl">
				<tbody>
				<tr>
					<th class="me_th x140">아이디</th>
					<td class="me_td">
						<?php echo $member['mb_id'] ?>
					</td>
				</tr>
				<tr>
					<th class="me_th x140">변경 비밀번호</th>
					<td class="me_td">
						<input type="password" name="mb_password" id="mb_password" value="" class="me_text x150" minlength="4">
					</td>
				</tr>
				<tr>
					<th class="me_th x140">비밀번호 재입력</th>
					<td class="me_td">
						<input type="password" name="mb_password_re" id="mb_password_re" value="" class="me_text x150" minlength="4">
					</td>
				</tr>
				</tbody>
				</table>

				<table class="me_tbl" style="margin-top:20px;">
				<tbody>
				<tr>
					<th class="me_th x140">이름</th>
					<td class="me_td"><?php echo $member['mb_name'] ?></td>
				</tr>
				<?php if($member['mb_2'] != ''){ ?>
				<tr>
					<th class="me_th x140">매장명</th>
					<td class="me_td"><?php echo $member['mb_2'] ?></td>
				</tr>
				<?php } ?>
				<tr>
					<th class="me_th x140">핸드폰 번호</th>
					<td class="me_td">
						<input type="text" name="mb_hp" id="mb_hp" value="<?php echo $member['mb_hp'] ?>" class="me_text x150">
					</td>
				</tr>
				</tbody>
				</table>
			
			</td>
		</tr>
		</tbody>
		</table>

    </section>

    <div class="btn_confirm">
        <input type="submit" class="btn_submit" value="정보수정">
    </div>

    </form>

    <script>
    function fregister_submit(f)
    {
		if(f.mb_password.value != '' || f.mb_password_re.value != ''){
			if(f.mb_password.value != f.mb_password_re.value){
				alert('변경할 비밀번호가 같지않습니다');
				f.mb_password.value = '';
				f.mb_password_re.value = '';
				f.mb_password.focus();
				return false;
			}
		}

		if(f.mb_hp.value == ''){
			alert('핸드폰 번호를 입력해주세요');
			f.mb_hp.focus();
			return false;
		}

        return true;
    }
    </script>
</div>

</div>
</div>