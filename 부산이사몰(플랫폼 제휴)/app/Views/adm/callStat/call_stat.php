<!--전화 연결 통계-->
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
    <div id="search_form">
        <div class="panel flex ai-c jc-sb">
            <div class="flex ai-c">
                <p class="total">총 <strong class="txt_color"><?=$paging['totalCount'] ?? 0?></strong> 건</p>
                <form name="searchFrm" class="flex ai-c jc-sb" autocomplete="off">
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
                    <div class="search_wrap">
                        <select name="sfl">
                            <option value="company" <?=$param['sfl'] === 'company' ? 'selected' : ''?>>회사이름</option>
                            <option value="calling" <?=$param['sfl'] === 'calling' ? 'selected' : ''?>>발신번호</option>
                            <option value="vno" <?=$param['sfl'] === 'vno' ? 'selected' : ''?>>가상번호</option>
                            <option value="tel" <?=$param['sfl'] === 'tel' ? 'selected' : ''?>>수신번호</option>
                        </select>
                        <div class="search">
                            <input type="search" name="stx" value="<?=$param['stx']??''?>" placeholder="검색어를 입력하세요">
                            <button class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <!--<div class="btn_wrap">
                <button type="button" id="changeState" class="btn btn_colorline" >선택 승인 변경</button>
                <button type="button" class="btn btn_color" onclick="location.href='./memberForm?lv=2'">일반회원 등록</button>
                <button type="button" class="btn btn_color" onclick="location.href='./memberForm?lv=5'">사업자회원 등록</button>
            </div>-->
        </div>
    </div>
    <div class="table">
        <table>
            <colgroup>
                <col width="5%">
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
                <th class="text-center">날짜</th>
                <th class="text-center">회사(아이디)</th>
                <th class="text-center">발신번호</th>
                <th class="text-center">가상번호</th>
                <th class="text-center">수신번호</th>
                <th class="text-center">통화시간</th>
            </tr>
            </thead>
            <tbody>
                <?php if (empty($listData)):?>
                    <tr>
                        <td colspan="8" class="text-center empty">내역이 없습니다.</td>
                    </tr>
                <?php else:
                    foreach ($listData as $list):?>
                    <tr>
                        <td><?= $paging['listNo']-- ?? 0 ?></td>
                        <td><?= replaceDateFormat($list['cs_time'], 2, 14) ?></td>
                        <td><?= $list['company_name']?>(<?= $list['mb_id']?>)</td>
                        <td><?= addHyphenContact($list['calling_num'])?></td>
                        <td><?= addHyphenContact050($list['vno'])?></td>
                        <td><?= addHyphenContact($list['called_num']) ?></td>
                        <td><?= $list['call_duration'] ?></td>
                    </tr>
                <?php endforeach;
                endif;?>
            </tbody>
        </table>
    </div>
    <?php include_once APPPATH."Views/component/pagination.php" // 페이징 ?>

</section>

<script src="<?= base_url()?>js/app/call_stat.js?<?=JS_VER?>"></script>
