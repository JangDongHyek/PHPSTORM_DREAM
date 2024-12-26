<!--전화 연결 통계-->
<section class="call_stat">
    <div id="search_form">
        <div class="panel flex ai-c jc-sb">
            <div class="flex ai-c">
                <p class="total">총 <strong class="txt_color"><?=$paging['totalCount'] ?? 0?></strong> 건</p>
                <form name="searchFrm" class="flex ai-c jc-sb" autocomplete="off">
                    <div class="search_wrap">
                        <?php
                        $dateRange = [''=>'전체상태', '1'=>'접수완료', '2'=>'검토중', '3'=>'처리중', '4'=>'처리완료'];
                        ?>
                        <select name="status">
                            <?php foreach ($dateRange as $key => $val): ?>
                                <option value="<?= $key ?>" <?=$param['status'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select name="sfl">
                            <option value="title" <?=$param['sfl'] === 'title' ? 'selected' : '' ?>>제목</option>
                            <option value="content" <?=$param['sfl'] === 'content' ? 'selected' : '' ?>>내용</option>
                        </select>
                        <div class="search">
                            <input type="search" name="stx" value="<?=$param['stx']??''?>" placeholder="검색어를 입력하세요">
                            <button class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="btn_wrap">
                <button type="button" class="btn btn_colorline" id="csDel">선택 삭제</button>
                <a href="<?=base_url()?>adm/csForm"><button type="button" class="btn btn_gray">등록하기</button></a>
            </div>
        </div>
    </div>
    <div class="table">
        <table>
            <colgroup>
                <col width="5%">
                <col width="5%">
                <col width="5%">
                <col width="10%">
                <col width="*">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
            <tr>
                <th><input type="checkbox" id="checkAll" /></th>
                <th>NO</th>
                <th class="text-center">진행상태</th>
                <th class="text-center">담당자</th>
                <th class="text-center">제목</th>
                <th class="text-center">작성자</th>
                <th class="text-center">일자</th>
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
                        <td><input type="checkbox" name="check" value="<?=$list['idx']?>" /</td>
                        <td><?= $paging['listNo']-- ?? 0 ?></td>
                        <td class="<?=CSDATERANGE[$list['status']] === "처리완료" ? 'txt_red' : 'txt_blue' ?> txt_bold"><?= CSDATERANGE[$list['status']]?></td>
                        <td><?= $list['mb_name']?></td>
                        <td><a href="<?=base_url()?>adm/csView?bo=<?=$list['tbl_name']?>&idx=<?=$list['idx']?>"><?= $list['title']?></a></td>
                        <td><?= $list['mb_nick']?></td>
                        <td><?= replaceDateFormat($list['created_at'])?></td>
                    </tr>
                <?php endforeach;
            endif;?>
            </tbody>
        </table>
    </div>
    <?php include_once APPPATH."Views/component/pagination.php" // 페이징 ?>

</section>

<script src="<?= base_url()?>js/adm/cs.js?<?=JS_VER?>"></script>
