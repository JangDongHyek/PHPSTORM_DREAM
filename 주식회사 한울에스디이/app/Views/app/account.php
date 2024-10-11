<!-- 시행사(직원) : 계정관리 -->
</div>
<?php
if(!$project) return false;
?>
<section class="list_table">
    <div class="area_filter flex ai-c jc-sb">
        <div class="flex ai-c">
            <strong class="total">총 4건</strong>
            <div class="search">
                <select name="sfl">
                    <option value="">소속사명</option>
                    <option value="">이름</option>
                    <option value="">아이디</option>
                    <option value="">연락처</option>
                </select>
                <input type="search" name="stx" placeholder="검색어 입력" value="">
                <button type="submit" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
            </div>
        </div>
        <button type="button" class="btn btn_darkblue" data-toggle="modal" data-target="#accountFormModal">계정 등록</button>
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
            </colgroup>
            <thead>
            <tr>
                <th></th>
                <th>소속사명</th>
                <th>아이디</th>
                <th class="text-center">이름</th>
                <th class="text-center">연락처</th>
                <th class="text-center">담당</th>
                <th class="text-center">비고</th>
                <th class="text-center">등록일</th>
                <th class="text-center">관리</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th class="text-center">4</th>
                <th>대우건설</th>
                <td>nr_global01</td>
                <td class="text-center">안재홍</td>
                <td class="text-center">010-1234-1234</td>
                <td class="text-center">거푸집 엔지니어</td>
                <td class="text-center">경력 10년</td>
                <td class="text-center">2024.06.19</td>
                <td class="text-center"><button class="btn btn_mini btn_black">수정</button></td>
            </tr>
            <tr>
                <th class="text-center">3</th>
                <th>대우건설</th>
                <td>nr_global01</td>
                <td class="text-center">이주현</td>
                <td class="text-center">010-1234-1234</td>
                <td class="text-center">레미콘 품질 관리자</td>
                <td class="text-center">-</td>
                <td class="text-center">2024.06.19</td>
                <td class="text-center"><button class="btn btn_mini btn_black">수정</button></td>
            </tr>
            <tr>
                <th class="text-center">2</th>
                <th>대우건설</th>
                <td>nr_global01</td>
                <td class="text-center">진준수</td>
                <td class="text-center">010-1234-1234</td>
                <td class="text-center">철근 배근 엔지니어</td>
                <td class="text-center">-</td>
                <td class="text-center">2024.06.19</td>
                <td class="text-center"><button class="btn btn_mini btn_black">수정</button></td>
            </tr>
            <tr>
                <th class="text-center">1</th>
                <th>대우건설</th>
                <td>nr_global01</td>
                <td class="text-center">김설주</td>
                <td class="text-center">010-1234-1234</td>
                <td class="text-center">기계 엔지니어</td>
                <td class="text-center">-</td>
                <td class="text-center">2024.06.19</td>
                <td class="text-center"><button class="btn btn_mini btn_black">수정</button></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="paging">
        <div class="pagingWrap">
            <a class="first disabled"><i class="fa-light fa-chevrons-left"></i></a>
            <a class="prev disabled"><i class="fa-light fa-chevron-left"></i></a>
            <a class="active">1</a>
            <a>2</a>
            <a>3</a>
            <a>4</a>
            <a>5</a>
            <a>6</a>
            <a>7</a>
            <a class="next disabled"><i class="fa-light fa-chevron-right"></i></a>
            <a class="last disabled"><i class="fa-light fa-chevrons-right"></i></a>
        </div>
    </div>


</section>

<!-- 담당자 계정 생성 -->
<div class="modal fade" id="accountFormModal" tabindex="-1" aria-labelledby="accountFormModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="accountFormModalLabel">담당자 계정 등록</h5>
            </div>
            <div class="modal-body" id="userForm">
                <div class="form_wrap">
                    <input type="hidden" id="project" value="<?=$project['idx']?>">
                    <input type="hidden" id="idx" value="">
                    <input type="hidden" id="level" value="20">
                    <input type="hidden" id="allow" value="true">

                    <label for="">소속사명</label>
                    <input type="text" id="company_name" placeholder="소속사명" required="소속사를 입력해주세요."/>
                    <label for="">아이디</label>
                    <input type="text" id="user_id" placeholder="아이디" required="아이디를 입력해주세요"/>
                    <label for="">비밀번호</label>
                    <input type="password" id="change_user_pw" placeholder="비밀번호"/>
                    <label for="">비밀번호 확인</label>
                    <input type="password" id="user_pw_re" placeholder="비밀번호 확인"/>
                    <label for="">이름</label>
                    <input type="text" id="company_person" placeholder="이름" required="이름을 입력해주세요."/>
                    <label for="">연락처</label>
                    <input type="tel" id="company_person_phone" placeholder="연락처" required="연락처를 입력해주세요."/>
                    <label for="">담당</label>
                    <select id="company_position">
                        <option value="콘크리트 타설">콘크리트 타설</option>
                    </select>
                    <label for="">비고</label>
                    <input type="text" id="notes" placeholder="비고"/>
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
    async function postUser() {
        //let obj = jl.js.getInputById(['user_id','user_pw']);
        let obj = jl.js.getFormById("userForm");
        let method = obj['idx'] ? 'update' : "insert";
        //let obj = jl.js.getUrlParams();

        let required = jl.js.getFormRequired("userForm")
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
