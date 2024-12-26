<section class="estimate">
        <!--<div class="guide">
            <i class="fa-duotone fa-circle-exclamation"></i> 이사업체 계약완료 후, 반드시 <span class="txt_red">계약완료</span> 버튼을 클릭해 주세요
        </div>-->
        <br>
        <div class="panel flex ai-c jc-sb">
            <div class="flex">
                <p class="total">총 <strong class="txt_color"><?=$paging['totalCount'] ?? 0?></strong>개 </p>
                <form name="searchFrm" autocomplete="off">
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
                </form>
            </div>
            <div class="btn_wrap">
                <button type="button" id="estimateState" class="btn btn_colorline" >선택 상태 변경</button>
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
                <col width="10%">
                <col width="14%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
            <tr>
                <th><input type="checkbox" id="checkAll"/></th>
                <th>번호</th>
                <th>이사서비스</th>
                <th>출발지</th>
                <th>도착지</th>
                <th>이사일</th>
                <th>연락처</th>
                <th>등록일</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php if(empty($listData)):?>
                <tr>
                    <td colspan="8" class="text-center empty">내역이 없습니다.</td>
                </tr>
            <?php else:
                foreach ($listData as $list):
            ?>
                    <tr>
                        <td><input type="checkbox" name="check" value="<?=$list['idx']?>"/></td>
                        <td><?=$paging['listNo']-- ?? 0?></td>
                        <td><?=SERVICE_TYPE[$list['service_type']]?></td>
                        <td><?=$list['origin']?></td>
                        <td><?=$list['bourne']?></td>
                        <td><?=$list['sched_date']?></td>
                        <td><?=$list['mb_hp']?></td>
                        <td><?=replaceDateFormat($list['created_at'])?></td>
                        <td>
                            <button class="btn <?=$list['service_state'] === 'Y' ? 'btn_red' :'btn_color'?> " id="modifyEsti" data-idx="<?=$list['idx']?>">
                                <?=$list['service_state'] === 'Y' ? '계약완료' :'견적수정'?></button>
                        </td>
                    </tr>
            <?php endforeach;
            endif;?>
            </tbody>
        </table>
        </div>
    <?php include_once APPPATH."Views/component/pagination.php" // 페이징 ?>
</section>
<script src="<?= base_url()?>js/app/estimate_my.js?<?=JS_VER?>"></script>