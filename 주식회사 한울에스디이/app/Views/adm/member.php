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
                <td class="text-center"><button class="btn btn_mini btn_black" onclick="location.href='./memberForm'">수정</button></td>
            </tr>
            <?}?>

            </tbody>
        </table>
    </div>

    <div class="paging" id="pagination">
        <div class="pagingWrap">
            <a class="first" first><i class="fa-light fa-chevrons-left"></i></a>
            <a class="prev disabled" prev><i class="fa-light fa-chevron-left"></i></a>
            <span page="onSearch">
                <a></a>
            </span>
            <a class="next disabled" next><i class="fa-light fa-chevron-right"></i></a>
            <a class="last disabled" last><i class="fa-light fa-chevrons-right"></i></a>
        </div>
    </div>


</section>

<? $jl->jsLoad();?>
<script>
    jl.js.INIT();

    setPage("pagination",1,10)

    function setPage(div_id,page,total_page,active_class='active' ,page_el = 'a') {
        const paginationElement = document.getElementById(div_id);

        if (!paginationElement) {
            jl.log('페이지 div 가 없습니다');
            return;
        }

        const firstElement = paginationElement.querySelector('[first]');
        const prevElement = paginationElement.querySelector('[prev]');
        const nextElement = paginationElement.querySelector('[next]');
        const lastElement = paginationElement.querySelector('[last]');

        if(page == 1 && firstElement) firstElement.remove();
        if(page == total_page && lastElement) lastElement.remove();

        const pageSpanElement = paginationElement.querySelector('[page]');
        if (!paginationElement) {
            jl.log('pageSpan 엘리먼트가 없습니다.');
            return false;
        }

        const functionName = pageSpanElement.getAttribute('page');
        if (typeof window[functionName] !== 'function') {
            console.log("함수없음");
        }

        // 첫 번째 태그를 복사
        const pageElement = pageSpanElement.querySelector(page_el);
        if (!pageElement) {
            jl.log('pageSpan에 첫번째 태그가 없습니다');
            return false;
        }


        //span 태그 초기화
        pageSpanElement.innerHTML = "";

        let start_page = page - 3
        let end_page = page + 4

        if(start_page < 1) start_page = 1
        if(end_page > total_page) end_page = total_page;

        for (let i = start_page; i <= end_page; i++) {
            let el = pageElement.cloneNode(true);
            if(i == page) el.classList.add(active_class)
            el.textContent = i;

            //function으로 안감싸주면 호출되는 버그생김
            el.addEventListener('click',function() {
                window[functionName](i);
            });

            pageSpanElement.appendChild(el)
        }
    }

    function onSearch(page = 1) {

        let obj = jl.js.getFormById('search_form');
        obj['search_key1'] = 'user_type';
        obj['page'] = page;

        let query = jl.js.getUrlQuery(obj);

        window.location.href = jl.js.getCurrentUrl() + "?" + query;
    }

    async function putUser(mode) {
        let checks = jl.js.getCheckboxName("checks");

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