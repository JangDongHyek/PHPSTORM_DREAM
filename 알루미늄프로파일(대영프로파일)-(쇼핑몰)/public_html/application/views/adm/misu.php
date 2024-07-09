<section class="misu">
    <form name="searchFrm" autocomplete="off" method="get">
        <div class="panel">
			<p>총 <span class="green"><?=$paging['totalCount']?></span>개 </p>
            <div>
                <select name="sfl">
                    <<?
					$sflList = ['cname' => '한의원명', 'id'=>'아이디', 'name' => '이름'];
					foreach ($sflList AS $key=>$val) {
					?>
					<option value="<?=$key?>" <?=$_GET['sfl']==$key?'selected':''?>><?=$val?></option>
					<?}?>
                </select>
				<input class="search-bar" name="stx" type="search" value="<?=$_GET['stx']?>" placeholder="검색어를 입력하세요" />
				<button type="submit" class="btn_search"><i class="fa-light fa-magnifying-glass"></i></button>
            </div>
        </div>
    </form>
    <div class="boxline">
        <div class="table adm">
            <table class="calculate">
                <colgroup>
                    <col width="5%"><!--No.-->
                    <col width="*%"><!--업체명-->
                    <col width="10%"><!--아이디-->
                    <col width="10%"><!--이름-->
                    <col width="13%">
                    <col width="13%">
                    <col width="13%">
                    <col width="13%">
                </colgroup>
                <thead>
                <tr>
                    <th>No.</th>
                    <th>업체명</th>
                    <th>아이디</th>
                    <th>이름</th>
                    <th>지난달 미수금</th>
                    <th>이번달 현재 입금</th>
                    <th>이번달 현재 외상금</th>
                    <th>미수금 잔액</th>
                </tr>
                </thead>
                <tbody>
				<?php
				foreach ($listData as $list) {
					// 이번달입금
					$monthDepAmt = (int)$list['monthDepAmt'];
					// 이번달외상
					$monthCreditAmt = (int)$list['monthCreditAmt'];

					// 미수금잔액 = 총외상-총입금
					$balance = ($list['creditAmt'] - $list['depAmt']);
					// 지난달미수금 = 미수금잔액-(이번달외상-이번달입금)
					$prevMonthBalance = $balance - ($monthCreditAmt - $monthDepAmt);
				?>
                <tr>
					<td><?=$paging['listNo']?></td>
                    <td><a href="<?=PROJECT_URL?>/adm/misu/<?=$list['idx']?>"><?=$list['cn_name']?></a></td>
					<td><?=$list['mb_id']?></td>
					<td><?=$list['mb_name']?></td>
                    <td class="text_right"><?=number_format($prevMonthBalance)?></td>
                    <td class="text_right txt_orange"><?=($monthDepAmt>0)?'-':''?><?=number_format($monthDepAmt)?></td>
                    <td class="text_right txt_green"><?=number_format($monthCreditAmt)?></td>
                    <td class="text_right"><?=number_format($balance)?></td>
                </tr>
				<?php
					$paging['listNo']--;
				}
				if ($paging['totalCount'] == 0) {
				?>
				<tr><td colspan="30" class="noDataAlign">등록된 업체가 없습니다.</td></tr>
				<?php } ?>
				</tbody>
            </table>
        </div>

        <? include_once VIEWPATH. 'component/pagination.php'; // 페이징?>
    </div>
</section>
