<!--1:1문의-->
</div>

<section class="list_table">
    <div class="area_filter flex ai-c jc-sb">
        <div class="flex ai-c">
            <strong class="total">총 <?=$board['count']?>건</strong>
        </div>
        <button type="button" class="btn btn-darkblue" onclick="location.href='qnaForm'">등록</button>
    </div>
    <div class="table">
        <table>
            <colgroup>
                <col width="40px">
                <col width="auto">
                <col width="200px">
                <col width="120px">
                <col width="100px">
            </colgroup>
            <thead>
            <tr>
                <th></th>
                <th>제목</th>
                <th class="text-center">답변상태</th>
                <th class="text-center">등록날짜</th>
                <th class="text-center">관리</th>
            </tr>
            </thead>
            <tbody>
            <? foreach($board['data'] as $d) { ?>
            <tr>
                <th><?=$d['data_page_no']?></th>
                <td><a href="./qnaView?idx=<?=$d['idx']?>"><?=$d['title']?></a></td>
                <?if($d['reply_status']) {?>
                    <td class="text-center"><strong class="icon icon-sky">답변완료</strong></td>
                <?}else{?>
                    <td class="text-center"><strong class="icon icon-gray">미답변</strong></td>
                <?}?>
                <td class="text-center"><?=explode(' ',$d['insert_date'])[0]?></td>
                <td class="text-center"><button class="btn btn-mini btn-black" onclick="location.href='qnaView?idx=<?=$d['idx']?>'">상세</button></td>
            </tr>
            <?}?>
            </tbody>
        </table>
    </div>
    <div class="paging" id="pagination">
        <div class="pagingWrap">
            <a class="first disabled" first><i class="fa-light fa-chevrons-left"></i></a>
            <a class="prev disabled" prev><i class="fa-light fa-chevron-left"></i></a>
            <span pageEvent="onSearch">
                <a class="active">1</a>
            </span>
            <a class="next disabled" next><i class="fa-light fa-chevron-right"></i></a>
            <a class="last disabled" last><i class="fa-light fa-chevrons-right"></i></a>
        </div>
    </div>


</section>

<?php $jl->jsLoad();?>

<script>
    const page = <?=$page?>;
    const total_page = <?=$board['total_page']?>;

    jl.INIT({page_id : 'pagination',page : page, total_page : total_page})

    function onSearch(page = 1) {

        let obj = {};
        obj['page'] = page;

        let query = jl.getUrlQuery(obj);

        window.location.href = jl.getCurrentUrl() + "?" + query;
    }
</script>