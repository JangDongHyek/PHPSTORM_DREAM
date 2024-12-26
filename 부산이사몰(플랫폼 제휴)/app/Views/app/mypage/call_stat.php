<section class="call_stat">
    <div class="area_total">
        <div class="grid grid3">
            <dl>
                <dt>총 수신 건수</dt>
                <dd><?=number_format($totalReceived['totalCount'] ?? 0)?></dd>
            </dl>
            <dl>
                <dt>월 수신 건수</dt>
                <dd><?=number_format($totalReceived['monthCount'] ?? 0)?></dd>
            </dl>
            <dl>
                <dt>일일 수신 건수</dt>
                <dd><?=number_format($totalReceived['dayCount'] ?? 0)?></dd>
            </dl>
        </div>
    </div>
    <hr>
    <h3>수신 상세내역</h3>
    <div class="panel">
        <form name="searchFrm" autocomplete="off" class="flex ai-c jc-sb">
            <div class="flex ai-c">
                <p class="total">총 <strong class="txt_color"><?= $paging['totalCount'] ?? 0 ?></strong>개 </p>
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
                        <input type="date" name="sdt" value="<?=$param['sdt'] ?? ''?>">
                        <p>~</p>
                        <input type="date" name="edt" value="<?=$param['edt'] ?? ''?>">
                    </div>
                </div>
            </div>
            <div class="search_wrap">
                <select name="sfl">
                    <option value="name" <?=$param['sfl'] === 'name' ? 'selected' : ''?>>이름</option>
                    <option value="tel" <?=$param['sfl'] === 'tel' ? 'selected' : ''?>>수신번호</option>
                </select>
                <div class="search">
                    <input type="search" name="stx" value="<?=$param['stx']??''?>" placeholder="검색어를 입력하세요">
                    <button class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="table">
        <table>
            <colgroup>
                <col width="5%">
                <col width="*">
                <col width="*">
                <col width="*">
                <col width="*">
            </colgroup>
            <thead>
            <tr>
                <th></th>
                <th>날짜</th>
                <th>수신번호</th>
                <th>이름</th>
                <th>통화시간</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($listData)): ?>
                <tr>
                    <td colspan="5" class="text-center empty">내역이 없습니다.</td>
                </tr>
            <?php else:
                foreach ($listData as $list):
                    ?>
                    <tr>
                        <td><?= $paging['listNo']-- ?? 0 ?></td>
                        <td><?= replaceDateFormat($list['cs_time'], 2, 14) ?></td>
                        <td><?= addHyphenContact($list['called_num']) ?></td>
                        <td><?= $list['mb_name'] ?></td>
                        <td><?= $list['call_duration'] ?></td>
                    </tr>
                <?php endforeach;
            endif;
            ?>
            </tbody>
        </table>
    </div>
    <?php include_once APPPATH . "Views/component/pagination.php" // 페이징 ?>

</section>
<script src="<?= base_url()?>js/app/call_stat.js?<?=JS_VER?>"></script>
