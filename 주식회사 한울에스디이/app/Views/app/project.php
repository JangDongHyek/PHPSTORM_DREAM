<!--시행사 : 프로젝트 관리-->
    <div class="flex ai-c">
        <p class="txt_bold txt_darkblue">현재 진행중인 프로젝트 4건</p>
        <!--관리자는 전체 / 직원은 본인 프로젝트만!-->
    </div>
</div>

<section class="list_table">
    <div class="area_filter flex ai-c jc-sb">
        <div class="flex ai-c" id="search_form">
            <strong class="total">총 3건</strong>
            <input type="date" id="start_between" placeholder="날짜 선택" value="">
            ~
            <input type="date" id="end_between" placeholder="날짜 선택" value="">
            <div class="search">
                <select id="search_key">
                    <option value="name">프로젝트 명</option>
                    <option value="company_name">시공사 명</option>
                </select>
                <input type="search" id="search_value" placeholder="검색어 입력" value="" keyEvent.enter="onSearch">
                <button type="submit" class="btn_search" onclick="onSearch()"><i class="fa-regular fa-magnifying-glass"></i></button>
            </div>
        </div>
        <!--관리자만-->
        <button type="button" class="btn btn_darkblue" data-toggle="modal" data-target="#projectFormModal">프로젝트 생성</button>
        <!--관리자만-->
    </div>
        <div class="table">
            <table>
                <colgroup>
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
                        <th>프로젝트 명</th>
                        <th>공사 위치</th>
                        <th>공사 기간</th>
                        <th class="text-center">시공사명</th>
                        <th class="text-center">비용 예산(억원)</th>
                        <th class="text-center">소요 비용(억원)</th>
                        <th class="text-center">진행율</th>
                        <th class="text-center">관리</th>
                    </tr>
                </thead>
                <tbody>
                <? foreach($projects['data'] as $p) {?>
                    <tr>
                        <th>
                            <!--개별 프로젝트로 이동-->
                            <a href="./overall"><p class="i_green"><?=$p['name']?></p></a>
                        </th>
                        <td><?=$p['name']?></td>
                        <td><?=explode(" ",$p['start_date'])[0]?> - <?=explode(" ",$p['end_date'])[0]?> (총 897일)</td>
                        <td class="text-center"><?=$p['company_name']?></td>
                        <td class="text-center"><?=$p['budget']?></td>
                        <td class="text-center">미정</td>
                        <td class="text-center">미정%</td>
                        <td class="text-center"><button class="btn btn_mini btn_black">수정</button></td>
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

<!-- 프로젝트 생성 -->
<div class="modal fade" id="projectFormModal" tabindex="-1" aria-labelledby="projectFormModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="projectFormModalLabel">프로젝트 생성</h5>
            </div>
            <div class="modal-body">
                <div class="form_wrap" id="projectForm">
                    <input type="hidden" id="idx" value="">
                    <!-- 부모가 있으면 회사 계정의 관리자로 인식 확장성을 위해 예비 코드 -->
                    <input type="hidden" id="user_idx" value="<?=$user['parent'] ? $user['parent'] : $user['idx'] ?>">

                    <label for="">프로젝트 명</label>
                    <input type="text" id="name" placeholder="프로젝트 명" required="프로젝트 이름을 입력 해주세요."/>
                    <label for="">공사 위치</label>
                    <input type="text" id="address" placeholder="공사 위치" required="공사 위치를 입력 해주세요."/>
                    <p class="flex ai-c jc-sb">
                        <label for="">공사기간</label><span>(총0일)</span>
                    </p>
                    <p class="flex ai-c">
                        <input type="date" id="start_date" required="공사 시작기간을 입력해주세요."/><span>~</span>
                        <input type="date" id="end_date" required="공사 종료기간을 입력해주세요."/>
                    </p>
                    <label for="">시공사 명</label>
                    <input type="text" id="company_name" placeholder="시공사 명" required="시공사를 입력해주세요."/>
                    <label for="">비용 예산(억원)</label>
                    <input type="text" id="budget" placeholder="비용 예산(억원)" required="예산을 입력해주세요."/>
                    <label for="">담당자 지정</label>
                    <input type="text" id="person" placeholder="담당자 지정" data-toggle="modal" data-target="#pmSearchModal" readonly/>

                    <input type="hidden" id="person_idx" value="" required="담당자를 지정해주세요.">

                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>-->
                <button type="button" class="btn btn-primary" onclick="postProject()">생성 완료</button>
            </div>
        </div>
    </div>
</div>

<!-- 담당자 검색 -->
<div class="modal fade" id="pmSearchModal" tabindex="-1" aria-labelledby="pmSearchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="pmSearchModalLabel">담당자 지정</h5>
            </div>
            <div class="modal-body">
                <div class="search_wrap">
                    <div class="flex" id="userSearchForm">
                        <input type="hidden" id="parent" value="<?=$user['parent'] ? $user['parent'] : $user['idx'] ?>">
                        <select id="search_like_key1">
                            <option value="company_person">이름</option>
                            <option value="user_id">아이디</option>
                        </select>
                        <input type="search" id="search_like_value1" placeholder="아이디 or 이름으로 검색해주세요" keyEvent.enter="getUser"/>
                        <button type="button" class="btn_search" onclick="getUser()"><i class="fa-regular fa-magnifying-glass"></i></button>
                    </div>
                    <div class="sch_field" id="" style="display: block">
                        <table class="sch_field_tb" id="data-list">

                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>-->
                <button type="button" class="btn btn-primary">선택 완료</button>
            </div>
        </div>
    </div>
</div>

<?php $jl->jsLoad(); ?>
<script>
    const page = <?=$page?>;
    const total_page = <?=$projects['total_page']?>;

    jl.INIT({page_id : 'pagination',page : page, total_page : total_page})

    function onSearch(page = 1) {

        let obj = jl.getFormById('search_form');
        obj['page'] = page;

        let query = jl.getUrlQuery(obj);

        window.location.href = jl.getCurrentUrl() + "?" + query;
    }

    function selectUser(idx,name) {
        document.getElementById('person').value = name;
        document.getElementById('person_idx').value = idx;

        $("#pmSearchModal").modal('hide');
    }

    function setTable(datas) {
        const table = document.getElementById('data-list');
        table.innerHTML = '';  // 기존 내용을 초기화

        if(datas.length) {
            datas.forEach(data => {
                table.innerHTML += `
                    <tr>
                        <th class="txt_bold">${data.company_person}</th>
                        <td>${data.company_department}</td>
                        <td>${data.company_position}</td>
                        <td>
                            <button class="btn btn_mini2 btn_line" onclick="selectUser('${data.idx}','${data.company_person}')">선택</button>
                        </td>
                    </tr>
                `;
            });
        }else {
            table.innerHTML += `
                <tr>
                    <td colspan="5"><div class="empty">검색 결과가 없습니다.</div></td>
                </tr>
            `
        }
    }

    async function getUser() {
        //let obj = jl.js.getInputById(['user_id','user_pw']);
        let obj = jl.js.getFormById("userSearchForm");
        //let obj = jl.js.getUrlParams();

        try {
            //if(obj.user_id == "") throw new Error("아이디를 입력해주세요.")
            let res = await jl.ajax("get",obj,"/api/user");
            setTable(res.data)
        }catch (e) {
            alert(e.message)
        }
    }

    async function postProject() {
        //let obj = jl.js.getInputById(['user_id','user_pw']);
        let obj = jl.js.getFormById("projectForm");
        //let obj = jl.js.getUrlParams();

        let required = jl.js.getFormRequired("projectForm")
        let options = {required : required};

        try {
            //if(obj.user_id == "") throw new Error("아이디를 입력해주세요.")

            let res = await jl.ajax("insert",obj,"/api/project_base",options);

            alert("완료되었습니다.");
            window.location.reload();
        }catch (e) {
            alert(e.message)
        }
    }
</script>