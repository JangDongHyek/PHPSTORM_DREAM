<section class="ad">
    <div class="ad_info">
        <?php if (!empty($monthData)): // $monthData가 존재하는 경우에만 실행 ?>
            <?php
            $createdAt = $monthData['created_at'];
            $dateTime = new DateTime($createdAt);
            /*$dateTime->modify('+1 month');

            // 현재 날짜와 비교
            $dataVisible = (new DateTime() <= $dateTime);*/

            // 기본 상품 갯수
            $areaGuArr = explode(',', $monthData['area_gu']);
            $areaGuCount = count($areaGuArr);

            // 프리미엄 갯수
            $preArr = explode(',', $monthData['pre_area']);
            $preCount = count($preArr);
            ?>
            <dl>
                <dt><i class="fa-duotone fa-rectangle-ad"></i> 현재 진행중인 광고</dt>
                <dd>
                    <p>기본 상품(<?=$monthData['area_gu']?>)</p>
                    <?php if ($monthData['main_yn'] === 'Y'): ?>
                        <p>메인 노출 상품(<?=$monthData['main_top']==='Y' ? '메인 상단 리스트 노출':'' ?> , <?=$monthData['main_bottom']==='Y' ? '메인 하단 리스트 노출':'' ?>)</p>
                    <?php endif; ?>
                    <?php if ($monthData['pre_yn'] === 'Y'): ?>
                        <p>프리미엄 상품(<?= $monthData['pre_area'] ?>)</p>
                    <?php endif; ?>
                </dd>
            </dl>
            <dl>
                <dt><i class="fa-duotone fa-calendar"></i> 결제일</dt>
                <dd><?=$monthData['next_pay_at']?></dd>
            </dl>
        <?php endif; // $monthData가 존재하지 않으면 이 블록이 실행되지 않음 ?>
    </div>
    <hr>

    <h4>등록된 이사 업체</h4>
    <div class="table">
        <table>
            <colgroup>
                <col width="*">
                <col width="10%">
                <col width="*">
                <col width="10%">
                <col width="*">
                <col width="10%">
                <col width="auto">
                <col width="5%">
                <col width="5%">
            </colgroup>
            <thead>
            <tr>
                <th>업체명</th>
                <th>지역</th>
                <th>메인 노출</th>
                <!--<th>프리미엄 지역</th>-->
                <th>연락처</th>
                <th>관허</th>
                <th>서비스</th>
                <th>등록일</th>
                <th>링크</th>
            </tr>
            </thead>
            <tbody>
            <?php if(empty($listData)):?>
            <tr>
                <td colspan="8" class="text-center empty">내역이 없습니다.</td>
            </tr>
            <?php else:
                foreach ($listData as $list):
                    $serviceTypes = explode(',', $list['service_type']);
                    $services = []; // 서비스 유형을 저장할 배열
                    foreach (SERVICE_TYPE as $key => $value) {
                        if (in_array($key, $serviceTypes)) {
                            $services[] = $value; // 해당하는 서비스 이름을 추가
                        }
                    }
                    ?>
            <tr>
                <td><?=$list['company_name']?></td>
                <td><?=$list['area_si']?> > <?=$list['area_gu']?></td>
                <td><?=CP_TYPE[$list['cp_type']]?></td>
                <!--<td></td>-->
                <td><?=$list['cp_tel']?></td>
                <td><?=$list['grant']?></td>
                <td>
                    <?=implode(', ', $services)?>
                </td>
                <td><?=replaceDateFormat($list['created_at'])?></td>
                <td><button class="btn btn_color" onclick="location.href='./companyView?idx=<?=$list['idx']?>'">바로가기</button></td>
            </tr>
            <?php
                endforeach;
            endif;?>
            </tbody>
        </table>
    </div>

    <br>

    <?/*!--<h4>광고 결제 내역</h4>-->
    <h4>결제 내역</h4>
    <div class="list_table">
        <div id="search_form">
            <form name="searchFrm" autocomplete="off">
                <div class="panel flex ai-c jc-sb">
                    <div class="flex ai-c">
                        <p class="total">총 <strong class="txt_color"><?=$paging['totalCount'] ?? 0?></strong> 건</p>
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
                                <input type="date" name="sdt" value="<?=$param['sdt']?>">
                                <p>~</p>
                                <input type="date" name="edt" value="<?=$param['edt']?>">
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
                    <th></th>
                    <th>결제일자</th>
                    <th>결제상태</th>
                    <th>광고내역</th>
                    <th>결제금액</th>
                    <th>결제정보</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($listData)):?>
                    <tr>
                        <td colspan="5" class="text-center empty">내역이 없습니다.</td>
                    </tr>
                <?php else:
                foreach ($listData as $list):
                    //기본 상품 갯수
                    $areaGuArray = explode(',', $list['area_gu']);
                    $areaGuCount = count($areaGuArray);

                    //프리미엄 갯수
                    $preArray = explode(',',$list['pre_area']);
                    $preCount = count($preArray);
                    // 카드 번호 뒤 4자리
                    $lastFourDigits = substr($list['card_num'], -4);
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
                    ?>
                    <tr>
                        <td><?=$paging['listNo']-- ?? 0?></td>
                        <td><?=replaceDateFormat($list['created_at'],2, 14)?></td>
                        <td><?=$payStatus?></td>
                        <td>
                            <p>기본 상품<?if ($areaGuCount > '3'):?>(+추가 <?=$areaGuCount - 3?>개)<?endif;?></p>
                            <? if($list['main_yn'] === 'Y'):?>
                            <p>메인 노출 상품</p>
                            <? endif;?>
                            <? if($list['pre_yn'] === 'Y'):?>
                            <p>프리미엄 상품(<?=$preCount?>)</p>
                            <? endif;?>
                        </td>
                        <td><?=number_format($list['order_price'])?>원</td>
                        <td><?=$list['acqu_card_name']?>(<?=$lastFourDigits?>)</td>
                    </tr>
                <?php endforeach;
                endif;?>
                </tbody>
            </table>
        </div>

        <?php include_once APPPATH."Views/component/pagination.php" // 페이징 ?>
    </div>*/?>
</section>
<script src="<?= base_url()?>js/app/ad.js?<?=JS_VER?>"></script>