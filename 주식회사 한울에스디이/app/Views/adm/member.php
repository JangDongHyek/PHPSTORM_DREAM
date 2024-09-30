<!--서비스 이용자 관리-->
<div class="flex ai-c">
    <p class="txt_bold txt_darkblue">현재 서비스 이용중인 업체 <?=$all_users?>건</p>
</div>
</div>

<section class="list_table">
    <div id="search_form">
        <div class="area_filter flex ai-c jc-sb">
            <div class="flex ai-c">
                <strong class="total">총 <?=$users['count']?>건</strong>
                <select id="search_value1">
                    <option value="">구분</option>
                    <option value="시행사">시행사</option>
                    <option value="시공사">시공사</option>
                </select>

                <div class="search">
                    <select id="search_key2">
                        <option value="company_name">회사명</option>
                        <option value="company_owner">대표자명</option>
                    </select>
                    <input type="search" id="search_value2" placeholder="검색어 입력" value="" keyEvent.enter="onSearch">
                    <button type="button" class="btn_search" onclick="onSearch()"><i class="fa-regular fa-magnifying-glass"></i></button>
                </div>
            </div>
            <div>
                <button type="button" class="btn btn_blueline" onclick="putUser('true')">선택 승인</button>
                <button type="button" class="btn btn_gray" onclick="putUser('')">선택 승인 취소</button>
                <button type="button" class="btn btn_blue" onclick="location.href='./memberForm'">등록</button>
            </div>
        </div>
    </div>
    <div class="table">
        <table>
            <colgroup>
                <col width="20px">
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
                <th><input type="checkbox"/></th>
                <th>회사명</th>
                <th class="text-center">구분</th>
                <th class="text-center">대표자명</th>
                <th class="text-center">담당자</th>
                <th class="text-center">담당자 연락처</th>
                <!--<th class="text-center">사용기간</th>-->
                <th class="text-center">승인상태</th>
                <th class="text-center">등록날짜</th>
                <th class="text-center">관리</th>
            </tr>
            </thead>
            <tbody>
            <? foreach($users['data'] as $data) {?>
            <tr>
                <th><input type="checkbox" name="checks" value="<?=$data['idx']?>"/></th>
                <th><?=$data['company_name']?></th>
                <td class="text-center"><?=$data['user_type']?></td>
                <td class="text-center"><?=$data['company_owner']?></td>
                <td class="text-center"><?=$data['company_person']?></td>
                <td class="text-center"><?=$data['company_person_phone']?></td>
                <!--<td class="text-center">2018.06.18 - 2018.09.17 (3개월)</td>-->
                <?if($data['allow']) {?>
                <td class="text-center"><strong class="icon icon_gray">승인</strong></td>
                <?}else {?>
                <td class="text-center"><strong class="icon icon_sky">미승인</strong></td>
                <?}?>
                <td class="text-center"><?=explode(' ',$data['insert_date'])[0] ?></td>
                <td class="text-center"><button class="btn btn_mini btn_black" onclick="location.href='./memberForm?idx=<?=$data['idx']?>'">수정</button></td>
            </tr>
            <?}?>

            </tbody>
        </table>
    </div>

    <div class="paging" id="pagination">
        <div class="pagingWrap">
            <a class="first" first><i class="fa-light fa-chevrons-left"></i></a>
            <a class="prev" prev><i class="fa-light fa-chevron-left"></i></a>
            <span pageEvent="onSearch">
                <a class="active">1</a>
            </span>
            <a class="next" next><i class="fa-light fa-chevron-right"></i></a>
            <a class="last" last><i class="fa-light fa-chevrons-right"></i></a>
        </div>
    </div>


</section>

<? $jl->jsLoad();?>
<script>
    const page = <?=$page?>;
    const total_page = <?=$users['total_page']?>;

    jl.INIT({
        page_id : 'pagination',
        page : page,
        total_page : total_page
    });


    function onSearch(page = 1) {

        let obj = jl.getFormById('search_form');
        obj['search_key1'] = 'user_type';
        obj['page'] = page;

        let query = jl.getUrlQuery(obj);

        window.location.href = jl.getCurrentUrl() + "?" + query;
    }

    async function putUser(mode) {
        let checks = jl.getCheckboxName("checks");

        for (let user of checks) {
            let obj = {
                idx: user,
                allow: mode
            };

            let res = await jl.ajax("update", obj, "/api/user");
        }

        alert("변경되었습니다.");
        window.location.reload();
    }
</script>