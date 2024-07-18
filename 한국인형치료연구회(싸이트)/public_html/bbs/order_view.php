<?
include_once('./_common.php');

$g5['title'] = '주문 상세내역';
include_once('./_head.php');

add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/board/gallery_store/style.css">', 0);

if(!$is_member){
    alert("로그인 후 이용해주세요.",G5_URL."/bbs/login.php");
}

$sql = "select * from `g5_order_list` where `idx` = '$idx' and `mb_id` = '$member[mb_id]'";
$row = sql_fetch($sql);

if(empty($row)){
    alert("구매이력이 없습니다.",G5_URL);
}

$state = "";
if($row['state'] <= 2){
    $state = "결제완료";
} else if($row['state'] == 3){
    $state = "배송완료";
} else if($row['state'] == 4){
    $state = "결제취소";
}

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
	.area_apply .area_table tbody tr{
		padding: 15px 0;
	}
}
</style>

    <div class="area_apply">
        <div class="area_table">
            <table>
                <thead>
                <tr>
                    <th scope="col">구매번호</th>
                    <th scope="col">상품명</th>
                    <th scope="col">가격</th>
                    <th scope="col">구매수량</th>
                    <th scope="col">배송비</th>
                    <th scope="col">추가금액</th>
                    <th scope="col">합계</th>
                    <th scope="col">배송여부</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="td_number"><?=$row['buy_no']?></td>
                        <td class="td_data01"><a><?=$row['item_title']?></a></td>
						<td class="td_price"><span class="m_data">가격</span><?=number_format($row['item_cost']);?>원</td>
                        <td class="td_price"><span class="m_data">구매수량</span><?=number_format($row['item_count']);?>개</td>
                        <td class="td_price"><span class="m_data">가격</span><?=number_format($row['ship_cost']);?>원</td>
                        <td class="td_price"><span class="m_data">가격</span><?=number_format($row['add_cost']);?>원</td>
                        <td class="td_price"><?=number_format($row['sum_cost']);?>원</td>
                        <td class="td_status"><?=$state?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
<div class="mbskin">

	<div class="tbl_frm01 tbl_wrap">
		<table>
			<caption>배송지 정보</caption>
			<tbody>
				<tr>
					<th scope="row"><label for="reg_mb_name">이름<strong class="sound_only">필수</strong></label></th>
					<td>
						<input type="text" id="reg_mb_name" name="mb_name" value="<?=$row['od_name']?>" <?php echo $readonly; ?> class="frm_input <?php echo $readonly ?>" minlength="3" maxlength="20" disabled>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="reg_mb_hp">휴대폰번호</label></th>
					<td>
						<input type="number" name="mb_hp" value="<?=$row['od_hp']?>" id="reg_mb_hp" class="frm_input " maxlength="20" disabled>
					</td>
				</tr>

				<tr>
					<th scope="row">
						주소
					</th>
					<td>
						<div id="addr_hide">
							<label for="mb_zip" class="sound_only">우편번호</label>
							<input type="text" placeholder="우편번호" name="mb_zip" readonly value="<?=$row['od_zip']?>" id="mb_zip"  class="frm_input" size="5" maxlength="6" disabled>
                            <br>
							<input type="text" name="mb_addr1" readonly value="<?=$row['od_addr1']?>" id="mb_addr1"  class="frm_input frm_address " size="70" maxlength="100" placeholder="주소검색을 해주세요" disabled>
							<input type="text" name="mb_addr2" value="<?php echo get_text($row['od_addr2']) ?>" id="mb_addr2" class="frm_input frm_address" size="70" maxlength="100" placeholder="상세주소를 입력해주세요" disabled>
						</div>
					</td>
				</tr>

			</tbody>
		</table>
	</div>
	
    <div class="btn_confirm">
        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=order_list" class="btn_cancel">목록</a>
    </div>
</div>
<?
include_once('./_tail.php');
?>
