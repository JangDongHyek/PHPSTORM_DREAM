<section class="estimate">
    <div class="panel">
            <form name="searchFrm" autocomplete="off" class="flex ai-c jc-sb">
                <div class="flex w100">
                    <div class="flex ai-c jc-sb">
                        <p class="total">총 <strong class="txt_color"><?=$paging['totalCount'] ?? 0?></strong>개 </p>
                        <select name="serviceState">
                            <option value="" <?=$param['serviceState'] === '' ? 'selected' : ''?>>전체</option>
                            <option value="N" <?=$param['serviceState'] === 'N' ? 'selected' : ''?>>신규견적</option>
                            <option value="C" <?=$param['serviceState'] === 'C' ? 'selected' : ''?>>계약완료</option>
                        </select>
                    </div>
                    <div class="panel_box">
                        <div class="select">
                            <?php
                            $dateRange = ['0'=>'전체', '1'=>'오늘', '2'=>'이번주', '3'=>'이번달'];
                            foreach ($dateRange as $key=>$val):
                                $checked = ($_REQUEST['dtRange'] == $key) || (!$_REQUEST['dtRange'] && $key == 0)? "checked" : "";
                                $id = "dtr{$key}";
                                ?>
                                <input type="radio" id="<?=$id?>" name="dtRange" class="red" value="<?=$key?>" <?=$checked?>/><!--
                                --><label for="<?=$id?>"><?=$val?></label>
                            <?php endforeach;?>
                        </div>
                        <div class="flex">
                            <input type="date" name="sdt" value="<?=$param['sdt']?>">
                            <p>~</p>
                            <input type="date" name="edt" value="<?=$param['edt']?>">
                        </div>
                    </div>
                    <div class="flex ai-c male-auto">
                        <span>결제 상태&nbsp;</span>
                        <span class="icon icon_line">연결전</span>
                        <span class="icon icon_gray">결제완료</span>
                    </div>
                </div>
                <!--<div class="btn_wrap">
                    <button type="button" class="btn btn_black" data-toggle="modal" data-target="#callPaymentModal">전화 결제내역</button>
                </div>-->
            </form>
        </div>

        <div class="table">
        <table>
            <colgroup>
                <col width="5%">
                <col width="10%">
                <col width="10%">
                <col width="*">
                <col width="*">
                <col width="*">
                <col width="14%">
                <col width="10%">
            </colgroup>
            <thead>
            <tr>
                <th>번호</th>
                <th>신청일</th>
                <th>상태</th>
                <th>이사서비스</th>
                <th>출발지</th>
                <th>도착지</th>
                <th>이사일</th>
                <th>연락처</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($listData)):?>
                <tr>
                    <td colspan="8" class="text-center empty">내역이 없습니다.</td>
                </tr>
            <?php else:
                foreach ($listData as $list):
            ?>
            <tr <?=$list['hp'] !== null ? 'class="bg_color"' : '' ?> ><!--전화연결 결제된 리스트는 tr에 .bg_color 추가 -->
                <td><?=$paging['listNo']-- ?? 0?></td>
                <td><span class="txt_bold"><?=replaceDateFormat($list['created_at'])?></span></td>
                <td class="<?=$list['service_state'] === 'N' ? 'txt_blue' : ''?>"><?=$list['service_state'] === 'N' ? '신규견적' : '계약완료'?></td>
                <td><!--span class="icon_green icon">부동산 견적</span--><?=SERVICE_TYPE[$list['service_type']]?></td>
                <td><?=$list['origin']?></td>
                <td><?=$list['bourne']?></td>
                <td><?=replaceDateFormat($list['sched_date'])?></td>
                <td>

                    <!-- Mobile button -->
                    <button class="btn btn_color hp_open mobileButton" data-hp-open="<?= $list['mb_hp'] ?>" data-eidx="<?= $list['idx'] ?>" <?= $list['service_state'] === 'N' ? '' : 'disabled' ?> >전화연결</button>
                    <!--<button class="btn btn_color hp_open mobileButton" data-hp-open="<?/*= $list['mb_hp'] */?>" data-eidx="<?/*= $list['idx'] */?>" <?/*= $list['service_state'] === 'N' ? '' : 'disabled' */?> onclick="document.location.href='tel:<?/*= $list['mb_hp'] */?>'">전화연결</button>-->

                    <!-- PC button -->
                    <button class="btn btn_color hp_open pcButton" <?= $list['service_state'] === 'N' ? '' : 'disabled' ?> data-hp-open="<?= $list['mb_hp'] ?>" data-eidx="<?= $list['idx'] ?>">전화연결</button>
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
<?php include_once APPPATH."Views/modal/app/pay_ment_modal.php" ?>
<script src="<?= base_url()?>js/app/estimate.js?<?=JS_VER?>"></script>

<script>
    function getPhoneAlert(hp) {
        return `
        <div class="show_phone">
            <p class="txt_down"><i class="fa-duotone fa-circle-exclamation"></i> PC화면에서는 전화 연결이 되지 않습니다.</p>
            <div class="box_gray">
                <p class="txt_black">아래 전화번호를 확인해 주세요</p>
                <h2 class="txt_color">${hp}</h2>
            </div>
        </div>`;
    }

    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".hp_open");

        buttons.forEach(button => {
            if (button.hasAttribute("disabled")) {
                button.textContent = "계약완료";
            }
        });
    });
</script>