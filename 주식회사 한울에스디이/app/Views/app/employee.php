<!--시행사(관리자) : 직원 관리-->
</div>

<section class="list_table">
    <div class="area_filter flex ai-c jc-sb" id="search_form">
        <div class="flex ai-c">
            <strong class="total">총 <?=$staff['count']?>건</strong>
            <div class="search">
                <select id="search_key1">
                    <option value="company_person">이름</option>
                    <option value="user_id">아이디</option>
                    <option value="company_person_phone">연락처</option>
                </select>
                <input type="search" id="search_value1" placeholder="검색어 입력" value="" keyEvent.enter="onSearch">
                <button type="submit" class="btn-search" onclick="onSearch()"><i class="fa-regular fa-magnifying-glass"></i></button>
            </div>
        </div>
        <button type="button" class="btn btn-darkblue" onclick="openModal()">직원계정 등록</button>
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
                <th></th>
                <th>아이디</th>
                <th class="text-center">이름</th>
                <th class="text-center">소속부서</th>
                <th class="text-center">직급</th>
                <th class="text-center">연락처</th>
                <th class="text-center">비고</th>
                <th class="text-center">권한</th>
                <th class="text-center">등록일</th>
                <th class="text-center">관리</th>
            </tr>
            </thead>
            <tbody>
            <? foreach($staff['data'] as $s) {
                switch ($s['level']) {
                    case '10' :
                        $level = '관리자';
                        break;
                    case '15' :
                        $level = "직원";
                        break;
                    default :
                        $level = "";
                        break;
                }
            ?>

            <tr>
                <th class="text-center"><?=$s['data_page_no']?></th>
                <th><?=$s['user_id']?></th>
                <td class="text-center"><?=$s['company_person']?></td>
                <td class="text-center"><?=$s['company_department']?></td>
                <td class="text-center"><?=$s['company_position']?></td>
                <td class="text-center"><?=$s['company_person_phone']?></td>
                <td class="text-center">-</td>
                <td class="text-center"><?=$level?></td>
                <td class="text-center"><?=explode(" ",$s['insert_date'])[0]?></td>
                <td class="text-center"><button class="btn btn-mini btn-black" onclick="getUser('<?=$s['idx']?>')">수정</button></td>
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

<!-- 직원계정 생성 -->
<div class="modal fade" id="employeeFormModal" tabindex="-1" aria-labelledby="employeeFormModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="employeeFormModalLabel">직원계정 등록</h5>
            </div>
            <div class="modal-body">
                <div class="form_wrap">
                    <input type="hidden" id="parent" value="<?=$user['idx']?>">
                    <input type="hidden" id="user_type" value="<?=$user['user_type']?>">
                    <input type="hidden" id="company_name" value="<?=$user['company_name']?>">
                    <input type="hidden" id="company_owner" value="<?=$user['company_owner']?>">
                    <input type="hidden" id="company_number" value="<?=$user['company_number']?>">
                    <input type="hidden" id="allow" value="true">

                    <div id="resetForm">
                        <input type="hidden" id="idx" value="">
                        <label for="">아이디</label>
                        <input type="text" name="" id="user_id" placeholder="아이디" required="아이디를 입력해주세요."/>
                        <label for="">비밀번호</label>
                        <input type="password" name="" id="change_user_pw" placeholder="비밀번호"/>
                        <label for="">비밀번호 확인</label>
                        <input type="password" name="" id="user_pw_re" placeholder="비밀번호 확인"/>
                        <p class="flex ai-c">
                            <input type="text" name="" id="company_department" placeholder="소속부서" required="소속부서를 입력해주세요."/>
                            <input type="text" name="" id="company_position" placeholder="직급" required="직급을 입력해주세요."/>
                            <!--<select>
                                <option>소속부서</option>
                            </select>
                            <select>
                                <option>직급</option>
                            </select>-->
                        </p>
                        <label for="">이름</label>
                        <input type="text" name="" id="company_person" placeholder="이름" required="이름을 입력해주세요."/>
                        <label for="">연락처</label>
                        <input type="tel" name="" id="company_person_phone" placeholder="연락처" required="연락처를 입력해주세요."/>
                        <select id="level">
                            <!--<option value="">권한을 선택해주세요</option>-->
                            <option value="15">직원</option>
                            <option value="10">관리자</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>-->
                <button type="button" class="btn btn-primary" onclick="postUser()">등록 완료</button>
            </div>
        </div>
    </div>
</div>

<?php $jl->jsLoad();?>

<script>
    const page = <?=$page?>;
    const total_page = <?=$staff['total_page']?>;

    jl.INIT({
        page_id : 'pagination',
        page : page,
        total_page : total_page
    });

    function openModal() {
        jl.js.resetElement('resetForm');
        let el = document.getElementById('user_id');
        el.disabled = false;
        $('#employeeFormModal').modal('show');
    }

    function onSearch(page = 1) {

        let obj = jl.getFormById('search_form');
        obj['page'] = page;

        let query = jl.getUrlQuery(obj);

        window.location.href = jl.getCurrentUrl() + "?" + query;
    }

    async function getUser(idx) {
        let obj = {idx : idx}

        try {
            let res = await jl.ajax("get",obj,"/api/user");
            jl.js.setElement(res.data[0]);
            $('#employeeFormModal').modal('show');

            let el = document.getElementById('user_id');
            el.disabled = true;

        }catch (e) {
            alert(e.message)
        }
    }

    async function postUser() {
        //let obj = jl.js.getInputById(['user_id','user_pw']);
        let obj = jl.js.getFormById("employeeFormModal");
        let method = obj['idx'] ? 'update' : "insert";
        //let obj = jl.js.getUrlParams();

        let required = jl.js.getFormRequired("employeeFormModal")
        let options = {required : required};

        try {
            if(method == 'insert') {
                if(!obj.change_user_pw) throw new Error("비밀번호를 입력해주세요.");
            }
            if(obj.change_user_pw != obj.user_pw_re) throw new Error("비밀번호와 비밀번호 확인이 다릅니다.");

            let res = await jl.ajax(method,obj,"/api/user",options);

            alert("완료되었습니다.");
            window.location.reload();
        }catch (e) {
            alert(e.message)
        }
    }
</script>
