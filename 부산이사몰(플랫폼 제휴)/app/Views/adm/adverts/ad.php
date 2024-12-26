<!--광고 신청 관리-->
<section class="list_table">
    <div id="search_form">
        <div class="panel">
            <form name="searchFrm" autocomplete="off" class="flex ai-c jc-sb">
                <div class="flex ai-c">
                    <p class="total">총 <strong class="txt_color"><?=$paging['totalCount'] ?? 0?></strong> 건</p>
                    <!--<div class="panel_box">
                        <div class="select">
                            <input type="radio" name="dtRange" id="payment_all"  <?/*=$param['dtRange'] === '' ? 'checked' : '' */?>  value="" />
                            <label for="payment_all">전체</label>
                            <input type="radio" name="dtRange" id="payment_paid" <?/*=$param['dtRange'] === 'Y' ? 'checked' : '' */?> value="Y"/>
                            <label for="payment_paid">결제완료</label>
                            <input type="radio" name="dtRange" id="payment_unpaid" <?/*=$param['dtRange'] === 'R' ? 'checked' : '' */?> value="R" />
                            <label for="payment_unpaid">미결제</label>
                        </div>
                    </div>-->
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

                    <div class="search_wrap">
                        <select id="" name="sfl">
                            <option value="mbId" <?=$param['sfl'] === "mbId" ? 'selected' : '' ?>>아이디</option>
                            <option value="companyName" <?=$param['sfl'] === "companyName" ? 'selected' : '' ?>>회사명</option>
                        </select>
                        <div class="search">
                            <input type="search" id="search_value2" name="stx" placeholder="검색어 입력" value="<?=$param['stx']?>" keyEvent.enter="onSearch">
                            <button type="button" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
                        </div>
                    </div>

                </div>
                <div class="btn_wrap">
                    <button type="button" class="btn btn_colorline" id="nextPayAt">결제일 선택변경</button>
                </div>
            </form>
        </div>
    </div>
    <div class="table">
        <table>
            <colgroup>
                <col width="20px">
                <col width="140px">
               <!-- <col width="100px">-->
                <col width="auto">
                <col width="auto">
                <col width="auto">
                <col width="100px">
                <col width="100px">
            </colgroup>
            <thead>
            <tr>
                <th><input type="checkbox" id="checkAll"/></th>
                <th class="text-center">최초가입일</th>
                <!--<th class="text-center">상태</th>-->
                <th class="text-center">회사명(아이디)</th>
                <th class="text-center">광고 내역</th>
                <th class="text-center">다음 결제일</th>
                <th class="text-center">관리</th>
                <th class="text-center"></th>
            </tr>
            </thead>
            <tbody>
                <?php if(empty($listData)):?>
                <tr>
                    <td colspan="7" class="text-center empty">내역이 없습니다.</td>
                </tr>
                <?php else:
                    foreach ($listData as $list):
                        //기본 상품 갯수
                        $areaGuArray = explode(',', $list['order']['area_gu']);
                        $areaGuCount = count($areaGuArray);

                        //프리미엄 갯수
                        $preArray = explode(',',$list['order']['pre_area']);
                        $preCount = count($preArray);
                ?>
                    <tr>
                        <td><input type="checkbox" name="check" value="<?=$list['idx']?>"/></td>
                        <td><?=replaceDateFormat($list['earliest_created_at'])?></td>
                       <!-- <td>
                            <select name="status" data-idx="<?/*=$list['idx']*/?>">
                                <option value="R" <?/*=$list['status']==='R' ? 'selected':''*/?>>미결제</option>
                                <option value="Y" <?/*=$list['status']==='Y' ? 'selected':''*/?>>결제 완료</option>
                            </select>
                        </td>-->
                        <td><?=$list['companyName']?>(<?=$list['mb_id']?>)</td>
                        <td>
                            <p>기본 상품(<?=$list['order']['area_gu']?>)<?if ($areaGuCount > '3'):?>(+추가 <?=$areaGuCount - 3?>개)<?endif;?></p>
                            <? if($list['order']['main_yn'] === 'Y'):?>
                                <p>메인 노출 상품 (<?=$list['order']['main_top']==='Y' ? '메인 상단 리스트 노출':'' ?> , <?=$list['order']['main_bottom']==='Y' ? '메인 하단 리스트 노출':'' ?>)</p>
                            <? endif;?>
                            <? if($list['order']['pre_yn'] === 'Y'):?>
                                <p>프리미엄 상품(<?=$list['order']['pre_area']?>)</p>
                            <? endif;?>
                        </td>
                        <td><input type="date" name="nextPayAt" value="<?=$list['next_pay_at']?>" data-idx="<?=$list['idx']?>"></td>
                        <td>
                            <button class="btn btn_color" onclick="location.href='./adForm?idx=<?=$list['idx']?>'">결제</button>
                        </td>
                        <td>
                            <button class="btn btn_colorline" onclick="location.href='./memberForm?idx=<?=$list['idx']?>'">광고 등록</button>
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
<script src="<?= base_url()?>js/adm/ad.js?<?=JS_VER?>"></script>