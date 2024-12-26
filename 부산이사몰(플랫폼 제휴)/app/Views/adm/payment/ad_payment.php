<!--광고 신청 관리-->
<section class="list_table">
    <div id="search_form">
        <div class="panel">
            <form name="searchFrm" autocomplete="off" class="flex ai-c jc-sb">
                <div class="flex ai-c">
                    <div class="flex ai-c jc-sb">
                        <p class="total">총 <strong class="txt_color"><?=$paging['totalCount'] ?? 0?></strong> 건</p>
                        <select name="type">
                            <option value="" >전체</option>
                            <option value="ad" <?= ($param['type'] ?? '')=== 'ad' ? 'selected' : ''?>>광고</option>
                            <option value="tel" <?= ($param['type'] ?? '')=== 'tel' ? 'selected' : ''?>>전화</option>
                        </select>
                    </div>
                    <div class="panel_box">
                        <span class="select">
                            <?php
                            $dateRange = ['0'=>'전체', '1'=>'오늘', '2'=>'이번주', '3'=>'이번달'];
                            foreach ($dateRange as $key=>$val):
                                $checked = ($_REQUEST['dtRange'] == $key) || (!$_REQUEST['dtRange'] && $key == 0)? "checked" : "";
                                $id = "dtr{$key}";
                                ?>
                                <input type="radio" id="<?=$id?>" name="dtRange" class="red" value="<?=$key?>" <?=$checked?>/><!--
                            --><label for="<?=$id?>"><?=$val?></label>
                            <?php endforeach;?>
                        </span>
                        <div class="flex">
                            <input type="date" name="sdt" value="<?=$param['sdt'] ?? ''?>">
                            <p>~</p>
                            <input type="date" name="edt" value="<?=$param['edt'] ?? ''?>">
                        </div>
                    </div>
                </div>
                <div class="search_wrap">
                    <select id="" name="sfl">
                        <option value="mbId" <?=($param['sfl'] ?? '')=== "mbId" ? 'selected' : '' ?>>아이디</option>
                        <option value="companyName" <?=($param['sfl'] ?? '') === "companyName" ? 'selected' : '' ?>>회사명</option>
                    </select>
                    <div class="search">
                        <input type="search" id="search_value2" name="stx" placeholder="검색어 입력" value="<?=$param['stx'] ?? ''?>" keyEvent.enter="onSearch">
                        <button type="button" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table">
        <table>
            <colgroup>
                <col width="auto">
                <col width="auto">
                <col width="auto">
                <col width="auto">
                <col width="auto">
                <col width="auto">
                <col width="auto">
                <col width="auto">
                <col width="auto">
            </colgroup>
            <thead>
            <tr>
                <th>결제일자</th>
                <th>구분</th>
                <th>상태</th>
                <th>회사명(아이디)</th>
                <th>결제내역</th>
                <th>결제금액</th>
                <th>결제정보</th>
                <th>결제자</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            <?php if(empty($listData)):?>
                <td colspan="7" class="text-center empty">내역이 없습니다.</td>
            <?php else:
                foreach ($listData as $list):
                    $payStatus = '';
                    switch ($list['pay_status']){
                        case 'Y':
                            $payStatus = '정상';
                            break;
                        case 'F':
                            $payStatus ='실패';
                            break;
                        case 'C':
                            $payStatus ='취소';
                            break;
                    }

                    $areaGuArray = explode(',', $list['area_gu']);
                    $areaGuCount = count($areaGuArray);

                    //프리미엄 갯수
                    $preArray = explode(',',$list['pre_area']);
                    $preCount = count($preArray);
                    // 카드 번호 뒤 4자리
                    $lastFourDigits = substr($list['card_num'], -4);
            ?>
                <tr>
                    <td><?=replaceDateFormat($list['created_at'],2,  14)?></td>
                    <?php if($list['area_gu'] !== '전화 연결'):?>
                        <td>광고</td>
                    <?php else:?>
                        <td>전화<!--광고--></td>
                    <?php endif;?>
                    <td><?=$payStatus?></td>
                    <td><?=$list['company_name']?>(<?=$list['mb_id']?>)</td>
                    <td>
                        <?php if($list['area_gu'] !== '전화 연결'):?>
                            <p>기본 상품(<?=$list['area_gu']?>)<?if ($areaGuCount > '3'):?>(+추가 <?=$areaGuCount - 3?>개)<?endif;?></p>
                            <?php if($list['main_yn'] === 'Y' && ($list['main_top'] === 'Y' || $list['main_bottom'] === 'Y')): ?>
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
                            <?php if($list['pre_yn'] === 'Y'):?>
                                <p>프리미엄 상품(<?=$list['pre_area']?>)</p>
                            <?php endif;?>
                        <?php else:?>
                            <?=$list['area_gu']?>
                        <?php endif;?>
                    </td>
                    <td><?=number_format($list['order_price'])?>원
                        <?= ($list['card_quota'] === '00') ? '' : '('.ltrim($list['card_quota'], '0').'개월)' ?>
                    </td>
                    <td><?=$list['acqu_card_name']?>(<?=$lastFourDigits?>)</td>
                    <td>
                        <?php if($list['mb_idx'] == '5' || $list['mb_idx'] == '12'):?>
                            관리자
                        <?php else:?>
                            사업주
                        <?php endif;?>
                    </td>
                    <td>
                        <? if ($list['pay_status'] !== 'C'):?>
                            <button class="btn btn_line" data-pay-idx="<?=$list['pidx']?>">결제취소</button>
                        <? else:?>
                            <p class="txt_lh">취소완료<br>(<?=replaceDateFormat($list['updated_at'],2,  14)?>)</p>
                        <?endif;?>
                    </td>
                </tr>
            <?php endforeach;
                endif;
            ?>

            </tbody>
        </table>
    </div>

    <?php include_once APPPATH."Views/component/pagination.php" // 페이징 ?>
</section>
<script src="<?= base_url()?>js/adm/ad_payment.js?<?=JS_VER?>"></script>