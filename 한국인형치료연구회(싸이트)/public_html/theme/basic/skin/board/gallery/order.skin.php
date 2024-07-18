<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<style>
	.tbl_frm01 th{
		min-width: 150px;
	}

@media (max-width:768px){
	.tbl_frm01 tr{
		display: flex;
		flex-direction: column;
	}
	.tbl_frm01 td,
	.tbl_frm01 th{
		min-width: inherit;
		width: 100%;
	}
	.frm_input{
		min-width: 200px;
	}
	.frm_address{
		width: 100%;
	}
}
</style>

<div class="mbskin">
    <form >

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>주문상품 정보</caption>
        <tbody>
        <tr>
            <td class="pro_info">
            	<div class="thumb">

           			<!--예시-->
            		<img src="https://www.figuretherapy.org/data/editor/2012/thumb-thumb-d3b5fbd3a36ad22969deabdeaabe1923_1609382284_9354_800x600_850x850.jpg" alt="">
				</div>
            	<p class="pro_title">곰돌이 인형</p>
            	<div class="etcWrap">
					<button class="btn_etc minus">-</button>
					<input type="text" class="etc_input" value="1">
					<button class="btn_etc plus">+</button>
            	</div>
            	<div class="price"><strong class="color-green">10,000</strong>원</div>
            </td>
        </tr>
        </tbody>
        </table>
    </div>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>배송지 정보 입력</caption>
        <tbody>
        <tr>
            <th scope="row"><label for="reg_mb_name">이름<strong class="sound_only">필수</strong></label></th>
            <td>
                <input type="text" required id="reg_mb_name" name="mb_name" value="<?php echo get_text($member['mb_name']) ?>" <?php echo $required ?> <?php echo $readonly; ?> class="frm_input <?php echo $required ?> <?php echo $readonly ?>" minlength="3" maxlength="20">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="reg_mb_hp">휴대폰번호<?php if ($config['cf_req_hp']) { ?><strong class="sound_only">필수</strong><?php } ?></label></th>
            <td>
                <input type="number" required name="mb_hp" value="<?php echo str_replace('-','',$member['mb_hp']) ?>" id="reg_mb_hp" <?php echo ($config['cf_req_hp'])?"required":""; ?> class="frm_input required" maxlength="20">
                <?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
                <input type="hidden" name="old_mb_hp" value="<?php echo get_text($member['mb_hp']) ?>">
                <?php } ?>
            </td>
        </tr>

        <tr>
            <th scope="row">
                주소
                <?php if ($config['cf_req_addr']) { ?><strong class="sound_only">필수</strong><?php }  ?>
            </th>
            <td>
                <div>
                    <input type="checkbox" name="foreign_chk" id="foreign_chk" value="Y"/>
                    <label for="foreign_chk">해외 거주자</label>
                </div>
                <div id="addr_hide">
                    <label for="reg_mb_zip" class="sound_only">우편번호<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
                    <input type="text" placeholder="우편번호" required name="mb_zip" readonly value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" id="reg_mb_zip" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input <?php echo $config['cf_req_addr']?"required":""; ?>" size="5" maxlength="6">
                    <button type="button" class="btn_frmline" onclick="search_post();">주소 검색</button><br>
                    <input type="text" name="mb_addr1" readonly value="<?php echo get_text($member['mb_addr1']) ?>" id="reg_mb_addr1" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input frm_address <?php echo $config['cf_req_addr']?"required":""; ?>" size="70" maxlength="100" placeholder="주소검색을 해주세요">
                    <input type="text" name="mb_addr2" value="<?php echo get_text($member['mb_addr2']) ?>" id="reg_mb_addr2" class="frm_input frm_address" size="70" maxlength="100" placeholder="상세주소를 입력해주세요">
                </div>
            </td>
        </tr>

		</tbody>
        </table>
    </div>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>결제정보 입력</caption>
        <tbody>
        <tr>
            <th scope="row"><label for="">입금일<strong class="sound_only">필수</strong></label></th>
            <td>
            	<input type="date" class="frm_input">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="">입금액<strong class="sound_only">필수</strong></label></th>
            <td>
            	<input type="text" placeholder="입금액을 기재해주세요" class="frm_input"> 원
            </td>
        </tr>
        </tbody>
        </table>
    </div>
    <div class="btn_confirm">
        <input type="submit" value="주문하기" id="btn_submit" class="btn_submit" accesskey="s" onclick="alert('준비중입니다')">
        <a href="<?php echo G5_URL ?>" class="btn_cancel">취소</a>
    </div>
    </form>


</div>