<section class="ad">

    <h4>결제 내역</h4>
    <div class="list_table">
        <div id="search_form">
            <form name="searchFrm" autocomplete="off">
                <div class="panel flex ai-c jc-sb">
                    <div class="flex ai-c">
                        <div class="flex ai-c jc-sb">
                            <p class="total">총 <strong class="txt_color"><?= $paging['totalCount'] ?? 0 ?></strong> 건
                            </p>
                            <select name="type">
                                <option value="">전체</option>
                                <option value="ad" <?= ($param['type'] ?? '') === 'ad' ? 'selected' : '' ?>>광고</option>
                                <option value="tel" <?= ($param['type'] ?? '') === 'tel' ? 'selected' : '' ?>>전화
                                </option>
                            </select>
                        </div>
                        <div class="panel_box">
                        <span class="select">
                            <?php
                            $dateRange = ['0' => '전체', '1' => '오늘', '2' => '이번주', '3' => '이번달'];
                            foreach ($dateRange as $key => $val):
                                $checked = ($_REQUEST['dtRange'] == $key) || (!$_REQUEST['dtRange'] && $key == 0) ? "checked" : "";
                                $id = "dtr{$key}";
                                ?>
                                <input type="radio" id="<?= $id ?>" name="dtRange" class="red"
                                       value="<?= $key ?>" <?= $checked ?>/><!--
                                    --><label for="<?= $id ?>"><?= $val ?></label>
                            <?php endforeach; ?>
                        </span>
                            <div class="flex">
                                <input type="date" name="sdt" value="<?= $param['sdt'] ?>">
                                <p>~</p>
                                <input type="date" name="edt" value="<?= $param['edt'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="btn_wrap">
                        <!--<button type="button" class="btn btn_colorline" >선택 승인</button>
                        <button type="button" class="btn btn_gray" >선택 승인 취소</button>
                        <button type="button" class="btn btn_color" onclick="location.href='./memberForm'">회원 등록</button>-->
                    </div>
                </div>
            </form>
        </div>
        <div class="table">
            <table>
                <colgroup>
                    <col width="40px">
                    <col width="10%">
                    <col width="10%">
                    <col width="14%">
                    <col width="auto">
                    <col width="auto">
                    <col width="14%">
                </colgroup>
                <thead>
                <tr>
                    <th></th>
                    <th>결제일자</th>
                    <th>구분</th>
                    <th>상태</th>
                    <th>결제내역</th>
                    <th>결제금액</th>
                    <th>결제정보</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($listData)): ?>
                    <tr>
                        <td colspan="7" class="text-center empty">내역이 없습니다.</td>
                    </tr>
                <?php else:
                    foreach ($listData as $list):
                        //기본 상품 갯수
                        $areaGuArray = explode(',', $list['area_gu']);
                        $areaGuCount = count($areaGuArray);

                        //프리미엄 갯수
                        $preArray = explode(',', $list['pre_area']);
                        $preCount = count($preArray);
                        // 카드 번호 뒤 4자리
                        $lastFourDigits = substr($list['card_num'], -4);
                        $payStatus = '';
                        switch ($list['pay_status']) {
                            case 'Y':
                                $payStatus = '정상';
                                break;
                            case 'F':
                                $payStatus = '실패';
                                break;
                            case 'C':
                                $payStatus = '취소';
                                break;
                        }
                        ?>
                        <tr>
                            <td><?= $paging['listNo']-- ?? 0 ?></td>
                            <td><?= replaceDateFormat($list['created_at'], 2, 14) ?></td>
                            <?php if ($list['area_gu'] !== '전화 연결'): ?>
                                <td>광고</td>
                            <?php else: ?>
                                <td>전화<!--광고--></td>
                            <?php endif; ?>
                            <td>
                                <p class="txt_lh">
                                    <?= $payStatus ?><br>
                                    <? if ($payStatus === '취소'): ?>
                                        (<?= replaceDateFormat($list['updated_at'], 2, 14) ?>)
                                    <?php endif; ?>
                                </p>
                            </td>
                            <td>
                                <?php if ($list['area_gu'] !== '전화 연결'): ?>
                                    <p>기본 상품(<?= $list['area_gu'] ?>
                                        )<? if ($areaGuCount > '3'): ?>(+추가 <?= $areaGuCount - 3 ?>개)<? endif; ?></p>
                                    <?php if ($list['main_yn'] === 'Y' && ($list['main_top'] === 'Y' || $list['main_bottom'] === 'Y')): ?>
                                        <p>메인 노출 상품(
                                            <?php
                                            $topText = $list['main_top'] === 'Y' ? '메인 상단 리스트 노출' : '';
                                            $bottomText = $list['main_bottom'] === 'Y' ? '메인 하단 리스트 노출' : '';

                                            // 텍스트가 있는 경우에만 출력
                                            if ($topText && $bottomText) {
                                                echo $topText . ' , ' . $bottomText;
                                            } elseif ($topText) {
                                                echo $topText;
                                            } elseif ($bottomText) {
                                                echo $bottomText;
                                            }
                                            ?>
                                            )</p>
                                    <?php endif; ?>
                                    <?php if ($list['pre_yn'] === 'Y'): ?>
                                        <p>프리미엄 상품(<?= $list['pre_area'] ?>)</p>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?= $list['area_gu'] ?>
                                <?php endif; ?>
                            </td>
                            <td><?= number_format($list['order_price']) ?>원</td>
                            <td><?= $list['acqu_card_name'] ?>(<?= $lastFourDigits ?>)</td>
                        </tr>
                    <?php endforeach;
                endif; ?>
                </tbody>
            </table>
        </div>

        <?php include_once APPPATH . "Views/component/pagination.php" // 페이징 ?>
    </div>
</section>
<script src="<?= base_url() ?>js/app/ad.js?<?= JS_VER ?>"></script>