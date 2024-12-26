<!--견적신청 관리-->
<section class="estimate">
    <div class="panel">
        <p class="total">총 <strong class="txt_color"><?=$paging['totalCount'] ?? 0?></strong>개 </p>
        <div class="flex ai-c jc-sb">
            <form name="searchFrm" autocomplete="off">
                <div class="panel_box">
                    <div class="flex ai-c">
                        <select name="state">
                            <option value="" <?=$param['state'] === '' ? 'selected' : ''?>>전체</option>
                            <option value="Y" <?=$param['state'] === 'Y' ? 'selected' : ''?>>승인</option>
                            <option value="N" <?=$param['state'] === 'N' ? 'selected' : ''?>>미승인</option>
                            <!--<option>신규견적</option>
                            <option>견적진행</option>
                            <option>계약완료</option>-->
                        </select>
                        <select name="dateType">
                            <option value="createdAt" <?=$param['dateType'] === 'createdAt' ? 'selected' : ''?>>등록일</option>
                            <option value="schedDate" <?=$param['dateType'] === 'schedDate' ? 'selected' : ''?>>이사일</option>
                        </select>
                    </div>
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
            </form>
            <div class="btn_wrap">
                <button type="button" class="btn btn_colorline" id="approve">선택 승인</button>
                <button type="button" class="btn btn_gray" id="revoke">선택 승인 취소</button>
                <button type="button" class="btn btn_color" id="estimate">선택 견적상태 변경</button>
            </div>
        </div>
    </div>
    <div class="table">
    <table>
        <colgroup>
            <col width="5%">
            <col width="5%">
            <col width="10%">
            <col width="*">
            <col width="*">
            <col width="*">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="8%">
        </colgroup>
        <thead>
        <tr>
            <th>번호</th>
            <th><input type="checkbox" id="checkAll" /></th>
            <th>이사서비스</th>
            <th>출발지</th>
            <th>도착지</th>
            <th>이사일</th>
            <th>신청인(ID)</th>
            <th>연락처</th>
            <th>등록일</th>
            <th>승인상태</th>
            <th>견적상태</th>
        </tr>
        </thead>
        <tbody>
        <?php if(empty($listData)):?>
        <tr><td colspan="10" class="text-center empty">내역이 없습니다.</td></tr>
        <?php else:
        foreach ($listData as $list):
        ?>
            <tr>
                <td><?=$paging['listNo']-- ?? 0?></td>
                <td><input type="checkbox" name="check" value="<?=$list['idx']?>"/></td>
                <td><?=SERVICE_TYPE[$list['service_type']]?></td>
                <td><?=$list['origin']?></td>
                <td><?=$list['bourne']?></td>
                <td style="white-space: nowrap"><?=$list['sched_date']?></td>
                <td><?=$list['mb_name']?>(<?=$list['mb_id']?>)<!--회원일때(아이디)--></td>
                <td><?=$list['mb_hp']?></td>
                <td><?=replaceDateFormat($list['created_at'],2,14)?></td>
                <td><span class="txt_color"><?=ESTATE[$list['state']]?></span></td>
                <td>
                    <select name="serviceState">
                        <option value="N" <?=$list['service_state'] === 'N' ? 'selected' :'' ?> >신규견적</option>
                        <option value="Y" <?=$list['service_state'] === 'Y' ? 'selected' :'' ?>>계약완료</option>
                    </select>
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
<script src="<?= base_url()?>js/adm/estimate.js?<?=JS_VER?>"></script>