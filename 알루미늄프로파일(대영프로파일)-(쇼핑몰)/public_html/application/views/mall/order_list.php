<div id="order">
    <? include_once VIEWPATH . '_common/navigator.php'; // 상단메뉴 ?>

	<div class="order_wrap">
		<form name="searchFrm" autocomplete="off" method="get">
            <?php if ($memberData) {?>
			<div class="panel box">
				<p>총 <span class="green"><?=$paging['totalCount']?></span>개 </p>
				<div>
					<input type="date" name="sdt" value="<?=$_GET['sdt']?>" onchange="changeInputDate(this.value)">
					<p>~</p>
					<input type="date" name="edt" value="<?=$_GET['edt']?>" onchange="changeInputDate(this.value)">
				</div>
				<div>
                	<span class="select">
						<?
						$dateRange = ['0'=>'전체', '1'=>'오늘', '2'=>'이번주', '3'=>'이번달', 4=>'지난달'];
						foreach ($dateRange AS $key=>$val) {
							$checked = ($_GET['dtRange'] == $key) || (!$_GET['dtRange'] && $key == 0)? "checked" : "";
							$id = "dtr{$key}";
						?>
						<input type="radio" id="<?=$id?>" name="dtRange" class="green" value="<?=$key?>" <?=$checked?> onclick="changeDateRange(this.value)"><!--
                    	--><label for="<?=$id?>"><?=$val?></label>
						<?}?>
					</span>
				</div>
			</div>
            <?php }else{ ?>
                <div class="panel box">
                    <div id="no_user_filter">
                       <div>
                       <p>주문자 이름</p>
                        <input type="text" name="ord_name" value="<?=$_GET['ord_name']?>" placeholder="주문자 이름 입력">
                        </div>
                        <div>
                        <p>주문자 번호</p>
                        <input type="number" name="ord_tel" value="<?=$_GET['ord_tel']?>" placeholder="뒷자리 4개 입력" oninput="maxLengthCheck(this);" maxlength="4" >
                        </div>
                        <button type="submit">검색 <i class="fa-regular fa-magnifying-glass"></i></button>
                    </div>
                </div>
            <?php } ?>
		</form>

		<div class="order_list">
            <ul>
				<?php
				foreach($listData as $list) {
					$names = explode('|', $list['prod_name']);
					$prodName = $names[0];
					$nameCnt = count($names);
					if ($nameCnt > 1) $prodName .= '<em> 외 ' . ($nameCnt -1) . '개</em>';

					$viewLink = PROJECT_URL . "/order/" . $list['idx'];
				?>
                <li>
                    <div class="number_order">
                        <span class="state"><?=ORDER_RECIPE_STATUS[$list['ord_status']]?></span>
                        <span class="txt_orange txt_under txt_bold" onclick="location.href='<?=$viewLink?>'" style="cursor: pointer"><?=$list['ord_no']?></span>
                    </div>
                    <div class="flex js">
                        <div class="div_pro">
                            <div class="thumb_img"><img src="<?=ASSETS_URL?>/<?=$list['thumbNail']?>"></div>
                            <div class="div_name">
                                <p class="p_date">주문일 <?=replaceDateFormat($list['reg_date'])?></p>
                                <strong><?=$prodName?></strong>
                                <p class="p_price2"><span class="icon line"><?=PAYMENT_METHODS[$list['pay_method']]?></span> <?=number_format($list['total_price'])?>원</p>
                            </div>
                        </div>
                        <div class="btn_wrap">
                            <!--
                            <a class="btn btn_green" onclick="showAlert('준비중입니다.')">배송조회</a>
                            -->
                            <a class="btn btn_gray" href="<?=$viewLink?>">주문상세</a>
                        </div>
                    </div>
                </li>
				<?
					$paging['listNo']--;
				}
				if ($paging['totalCount'] == 0) {
				?>
				<li>
					<strong>주문 내역이 없습니다.</strong>
				</li>
				<?}?>
            </ul>
		</div>

		<? include_once VIEWPATH. 'component/pagination.php'; // 페이징?>

	</div>
</div>

<script>
	const searchFrm = document.searchFrm; // 검색 폼

	// 검색
	searchFrm.addEventListener('submit', async (e) => {
		e.preventDefault();
		const f = e.target;

		// 검색어 2글자 이상
		// if (f.stx.value.length === 1) return showAlert("검색어를 2글자 이상 입력해 주세요.");

		let elements = f.querySelectorAll("input, select");
		elements.forEach(element => {
			if (element.type === 'radio') {
				if (!element.checked) element.disabled = true;
			} else {
				if (!element.value) element.disabled = true;
			}
		});

		searchFrm.submit();
	});

</script>
