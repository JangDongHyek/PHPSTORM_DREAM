<!--관리자 주문배송관리-->
<section class="order1">
    <form name="searchFrm" autocomplete="off" method="get">
        <div class="panel">
            <p>총 <span class="green"><?=number_format($paging['totalCount'])?></span>개 </p>
            <div>
                <input type="date" name="sdt" value="<?=$_GET['sdt']?>" >
                <p>~</p>
                <input type="date" name="edt" value="<?=$_GET['edt']?>" onchange="changeInputDate(this.value)">
            </div>
            <div>
                <span class="select">
                     <?
                     $dateRange = ['0'=>'전체', '1'=>'오늘', '2'=>'이번주', '3'=>'이번달', '4'=>'지난달'];
                     foreach ($dateRange AS $key=>$val) {
                     $checked = ($_GET['dtRange'] == $key) || (!$_GET['dtRange'] && $key == 0)? "checked" : "";
                     $id = "dtr{$key}";
                     ?>
                     <input type="radio" id="<?=$id?>" name="dtRange" class="green" value="<?=$key?>" <?=$checked?> onclick="changeDateRange(this.value)"/><label for="<?=$id?>"><?=$val?></label>
                     <?}?>
                </span>
            </div>
            <div>
                <select name="sfl">
                    <?
                    //$sflList = ['oName' => '주문자명', 'ordNo'=>'주문번호', 'rId'=> '주문자아이디', 'rName'=>'받는사람명', 'cName' => '한의원명', 'item'=>'상품명'];
                    $sflList = ['oName' => '주문자명', 'ordNo'=>'주문번호', 'rId'=> '주문자아이디', 'rName'=>'받는사람명', 'item'=>'상품명'];
                    foreach ($sflList AS $key=>$val) {
                    ?>
                    <option value="<?=$key?>" <?=$_GET['sfl']==$key?'selected':''?>><?=$val?></option>
                    <?}?>
                </select>
                <input class="search-bar" name="stx" type="search" value="<?=$_GET['stx']?>" placeholder="검색어를 입력하세요" />
                <button type="submit" class="btn_search"><i class="fa-light fa-magnifying-glass"></i></button>
            </div>
            <span>
                <button type="button" class="btn btn_grayw2 " onclick="commonExcelDownload('orderProductTracking');">주문내역 다운</button>

                <!--
                <button type="button" class="btn btn_black" onclick="commonExcelDownload('orderProductTracking')">택배 송장</button>
                <button type="button" class="btn btn_orange" onclick="location.href='<?=PROJECT_URL?>/file/download?path=/file/invoice_form.xlsx'">송장 업로드 양식 다운로드</button>
                <button type="button" class="btn btn_green " onclick="document.querySelector('input[name=file]').click()">송장 업로드</button>
                -->
            </span>
            <div class="hide">
                <input type="file" name="file" onchange="commonExcelUpload(this, 'trackingNo')">
            </div>
        </div>
        <div class="box">
            <div class="tagbox">
                <div style="display: none">
                    <p><strong>그룹</strong></p>
                </div>
                <div class="group" style="display: none">
                    <input type="hidden" name="groupIdxList" value="<?=$_GET['groupIdxList']?>">
                    <?php
                    $checkGroupIdx = explode(",", $_GET['groupIdxList']);

                    foreach ($groupList as $key=>$val) {
                        $checked = in_array((String)$key, $checkGroupIdx)? "checked" : "";
                    ?>
                    <span>
                        <input type="checkbox" name="group" id="g<?=$key?>" value="<?=$key?>" <?=$checked?>/>
                        <label for="g<?=$key?>"><?=$val?></label>
                    </span>
                    <?php } ?>
                </div>
                <dl class="search">
                    <dt>주문상태</dt>
                    <dd>
                        <select name="status">
                            <option value="" <?=getParamMatches('status', '', 'selected')?>>전체</option>
                            <?foreach (ORDER_RECIPE_STATUS AS $key=>$val) {?>
                            <option value="<?=$key?>" <?=getParamMatches('status', $key, 'selected')?>><?=$val?></option>
                            <?}?>
                        </select>
                    </dd>
                    <dt>결제수단</dt>
                    <dd>
                        <select name="method">
                            <option value="" <?=getParamMatches('method', '', 'selected')?>>전체</option>
                            <?foreach (PAYMENT_METHODS AS $key=>$val) {?>
                            <option value="<?=$key?>" <?=getParamMatches('method', $key, 'selected')?>><?=$val?></option>
                            <?}?>
                        </select>
                    </dd>
                    <!--<dt>카테고리</dt>
                    <dd>
                        <select name="cate">
                            <option value="" selected="">전체</option>
                            <option value="CA02">한방약재</option>
                            <option value="CA03">기획전</option>
                            <option value="CA04">할인상품</option>
                        </select>
                    </dd>-->
                </dl>
                &nbsp;
                <button type="button" class="btn btn_gray btn_h40" onclick="location.href='<?=PROJECT_URL.$_SERVER['REDIRECT_QUERY_STRING']?>'">초기화</button>
            </div>
        </div>
    </form>

    <!--<div class="boxline caption">
        <dl>
            <dt>※ 주문상태</dt>
            <dd>주문상태가 주문접수/배송준비중 일 때, 택배사 변경시 <span>배송중</span>으로 변경됨</dd>
            <dd>주문접수 후 1주일이 경과하면 <span>배송완료</span>로 변경됨 (주문취소 제외)</dd>
        </dl>
    </div>-->

    <div class="boxline">
        <div class="flex">
            <span class="tooltip-container">
                <button type="button" class="btn btn_gray" id="modifyList">일괄 수정</button>
                <span class="tooltip right">버튼을 클릭하면 체크된 항목의<br>주문상태 / 배송정보를 일괄 수정합니다.</span>
            </span>
        </div>
        <div class="table adm">
            <table class="order">
                <colgroup>
                    <col style="width: auto">
                    <col style="width: auto">
                    <col style="width: auto">
                    <!--
                    <col style="width: 12%">한의원명-->
                    <col style="width: 8%"><!--주문상태-->
                    <col style="width: 15%"><!--주문번호-->
                    <col style="width: auto"><!--주문자정보-->
                    <col style="width: 8%"><!--결제수단-->
                    <col style="width: 8%"><!--주문금액-->
                    <col style="width: auto"><!--복용법-->
                    <col style="width: auto">
                </colgroup>
                <thead>
                <tr>
                    <th rowspan="2"><input type="checkbox" onclick="selectAllCheckbox(this, 'checkIdx')"></th>
                    <th rowspan="2">번호</th>
                    <th rowspan="2">주문일</th>
                    <!--
                    <th rowspan="2">한의원명<br>(원장)</th>
                    -->
                    <th>주문상태</th>
                    <th>주문번호</th>
                    <th>주문자정보</th>
                    <th rowspan="2">결제수단</th>
                    <th rowspan="2">주문금액</th>
                    <th rowspan="2">관리</th>
                </tr>
                <tr>
                    <th>주문취소요청</th>
                    <th>상품명</th>
                    <th>배송정보</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($listData as $list) {
                    // 상품명
                    $prodName = getOrderProductName($list['prod_name']);

                    $idx = $list['idx'];
                ?>
                <tr>
                    <td rowspan="2">
                        <input type="checkbox" name="checkIdx" value="<?=$idx?>">
                    </td>
                    <td rowspan="2"><?=$paging['listNo']?></td>
                    <td rowspan="2" class="txt_bold"><?=replaceDateFormat($list['reg_date'])?></td>
                    <!--
                    <td rowspan="2"><?=$list['clinicName']?><br>(<?=$list['clinicDoctorName']?>)</td>
                    -->
                    <td>
                        <?//주문상태?>
                        <select name="status[<?=$idx?>]" onchange="selectRowCheckbox(<?=$idx?>)">
                            <?foreach (ORDER_RECIPE_STATUS AS $key=>$val) { ?>
                            <option value="<?=$key?>" <?=$key==$list['ord_status']? "selected":"";?>><?=$val?></option>
                            <?}?>
                        </select>
                    </td>
                    <td>
                        <?//주문번호?>
                        <span class="txt_orange txt_under txt_bold"><a href="<?=PROJECT_URL?>/adm/order/<?=$list['idx']?>"><?=$list['ord_no']?></a></span>
                    </td>
                    <td>
                        <dl class="order_info">
                            <dd><strong>주문자</strong> <?=$list['ord_name']?></dd>
                            <dd><strong>아이디</strong> <?=$list['mb_id']? $list['mb_id' ]: '[비회원]' ?></dd>
                            <dd><strong>연락처</strong> <?=$list['ord_tel']?></dd>
                            <dd><strong>수령인</strong> <?=$list['rec_name']?></dd>
                        </dl>
                    </td>
                    <td rowspan="2">
                        <?//결제수단?>
                        <div style="margin-bottom: 5px;"><?=PAYMENT_METHODS[$list['pay_method']]?></div>
                    </td>
                    <td rowspan="2">
                        <?// 주문금액 ?>
                        <?=number_format($list['total_price'])?>원
                    </td>
                    <td rowspan="2">
                        <button type="button" class="btn btn_black" onclick="location.href='<?=PROJECT_URL?>/adm/order/<?=$list['idx']?>'">수정</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?//주문취소요청?>
                        <?if ($list['ord_cancel_yn'] == 'Y') {?>
                        <strong class="txt_orange">취소요청(<?=replaceDateFormat($list['ord_cancel_date'],5,5)?>)</strong>
                        <?}?>
                    </td>
                    <td><?//상품명?><?=$prodName?></td>
                    <td>
                        <?//배송정보?>
                        <div>
                            <select name="courier[<?=$idx?>]" onchange="selectRowCheckbox(<?=$idx?>)">
                                <option value="">택배사</option>
                                <?foreach (COURIER_CODE AS $code=>$name) {?>
                                <option value="<?=$code?>" <?=$code==$list['courier']?"selected":""?>><?=$name?></option>
                                <?}?>
                            </select>
                        </div>
                        <div><input type="text" name="tno[<?=$idx?>]" placeholder="운송장번호 입력" value="<?=$list['tracking_no']?>" maxlength="50"></div>

                        <!--<div class="track_btn_area text_left"></div>-->
                    </td>
                </tr>
                <?
                    $paging['listNo']--;
                }
                if ($paging['totalCount'] == 0) {
                ?>
                <tr><td colspan="30" class="noDataAlign">등록된 주문이 없습니다.</td></tr>
                <? } ?>
                </tbody>
            </table>
        </div>

        <? include_once VIEWPATH. 'component/pagination.php'; // 페이징?>
    </div>
</section>

<script>
    const searchFrm = document.searchFrm; // 검색 폼

    // 검색 select 변경시
    const selectElements = searchFrm.querySelectorAll('select');
    selectElements.forEach(select => {
        if (select.name == 'sfl') return;
        select.addEventListener('change', () => {
            searchFrm.dispatchEvent(new Event('submit'));
        });
    });
    // 그룹 선택
    const groupElements = document.querySelectorAll('input[name="group"]');
    groupElements.forEach(input => {
        input.addEventListener('click', () => {
            searchFrm.dispatchEvent(new Event('submit'));
        });
    });

    // 검색
    searchFrm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const f = e.target;

        // 검색어 2글자 이상
        if (f.stx.value.length === 1) return showAlert("검색어를 2글자 이상 입력해 주세요.");

        let checkGroupIdx = []; // 그룹선택시
        let elements = f.querySelectorAll("input, select");
        elements.forEach(element => {
            if (element.type === 'radio') {
                if (!element.checked) element.disabled = true;
            } else if (element.name === 'group') {
                if (element.checked) checkGroupIdx.push(element.value);
            } else {
                if (!element.value) element.disabled = true;
            }
        });

        // 선택된 그룹값 추가
        f.querySelector('[name=groupIdxList]').value = checkGroupIdx.join(",");
        f.querySelector('[name=groupIdxList]').disabled = (checkGroupIdx.length == 0) ? true : false;
        let checkboxes = document.querySelectorAll('input[name=group]');
        checkboxes.forEach((checkbox) => {
            checkbox.disabled = true; // 그룹체크 disabled
        });

        searchFrm.submit();
    });

    // 목록 - select 변경시 체크박스 자동선택
    const selectRowCheckbox = (idx) => {
        if (!idx) return;
        const checkboxes = document.querySelectorAll('input[name=checkIdx]');
        checkboxes.forEach(checkbox => {
            if (checkbox.value == `${idx}`) checkbox.checked = true;
        });
    }

    // 목록 - 운송장번호 입력시 공백제거
    const tNoElements = document.querySelectorAll('input[name^="tno["][name$="]"]');
    tNoElements.forEach(input => {
        input.addEventListener('keyup', () => {
            input.value = removeWhitespace(input.value);
        });
    });

    // 목록 - 일괄수정
    document.querySelector('button#modifyList').addEventListener('click', async (e) => {
        e.preventDefault();

        const confirmResult = await showConfirm('목록 데이터를 일괄수정 하시겠습니까?');
        if (confirmResult.isConfirmed !== true) return false;

        // 선택항목만 수정
        const ids = document.querySelectorAll('input[name="checkIdx"]:checked');
        if (ids.length == 0) {
            return showAlert('선택된 주문이 없습니다.');
        }

        let orderCancelCount = 0;
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            const orderStatus = document.querySelector(`[name="status[${idx}]"]`).value;
            if (orderStatus == 'C') orderCancelCount++;

            listData.push({
                idx: idx,
                ordStatus: orderStatus, // 주문상태
                courier: document.querySelector(`[name="courier[${idx}]"]`).value, // 택배사
                trackingNo: document.querySelector(`[name="tno[${idx}]"]`).value, // 운송장번호
            });
        });

        // 주문취소 존재시 확인 알림창 실행
        if (orderCancelCount > 0) {
            const confirmResult = await showConfirm('<strong class="txt_red">`주문취소`</strong>상태가 존재하여,<br>카드취소 여부 확인 바랍니다.<br>수정완료 하시겠습니까?');
            if (confirmResult.isConfirmed !== true) return false;
        }

        const response = await fetchData(`/apiAdmin/updateOrderList`, {listData});
        if (response.result) {
            location.reload();
        } else {
            showAlert(`일괄변경에 실패했습니다.`);
        }
    });
</script>