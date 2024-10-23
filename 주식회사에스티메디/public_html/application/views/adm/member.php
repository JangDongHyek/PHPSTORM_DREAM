<!--관리자-회원관리 목록-->
<section class="member">
    <form name="searchFrm" autocomplete="off">
        <div class="panel">
            <p>총 <span class="green"><?=$paging['totalCount']?></span>개 </p>
            <div>
                <select name="sfl">
                    <!--
                    <option value="cname">한의원명</option>
                    -->
                    <option value="name" <?=$_GET['sfl']=='name'?'selected':''?>>이름</option>
                    <option value="id" <?=$_GET['sfl']=='id'?'selected':''?>>아이디</option>

                    <!--
                    <option value="rname">대표자명</option>
                    <option value="brno">사업자등록번호</option>

                    -->
                    <option value="mb_hp" <?=$_GET['sfl']=='mb_hp'?'selected':''?>>휴대폰</option>
                    <option value="addr" <?=$_GET['sfl']=='addr'?'selected':''?>>주소</option>
                </select>
                <input class="search-bar" name="stx" type="search" value="<?=$_GET['stx']?>" placeholder="검색어를 입력하세요">
                <button type="submit" class="btn_search"><i class="fa-light fa-magnifying-glass"></i></button>
            </div>
            <span>
                <button type="button" class="btn btn_blue"  onclick="update_checked_INSU('Y')">보험가 적용</button>
                <button type="button" class="btn btn_blueline"  onclick="update_checked_INSU('N')">기본가 적용</button>

                <button type="button" class="btn btn_black"  onclick="set_checked_agency()">에이전시 연결</button>
                <button type="button" class="btn btn_green" onclick="location.href='<?=ADM_URL?>/memberForm'">등록하기</button>
            </span>
        </div>
        <div class="box">
            <div class="tagbox">
                <?/*div>
                    <p><strong>그룹</strong></p>
                </div>
                <div>
                    <input type="hidden" name="groupIdx" value="<?=$_GET['groupIdx']?>">
                    <p><a><span class="tag <?=empty($_GET['groupIdx'])?'active':''?>" onclick="searchFilter('groupIdx', '')">전체</span></a></p>
                    <?php foreach ($searchFilter['groupNames'] as $key=>$value) { ?>
                        <p><a><span class="tag <?=$_GET['groupIdx']==$key?'active':''?>" onclick="searchFilter('groupIdx', '<?=$key?>')"><?=$value?></span></a></p>
                    <?php } ?>
                </div*/?>
                <div>
                    <p><strong>승인상태</strong></p>
                </div>
                <div>
                    <input type="hidden" name="isAuth" value="<?=$_GET['isAuth']?>">
                    <input type="hidden" name="agency" value="<?=$_GET['agency']?>">
                    <p><a><span class="tag <?=empty($_GET['isAuth'])?'active':''?>" onclick="searchFilter('isAuth', '')">전체</span></a></p>
                    <p><a><span class="tag <?=$_GET['isAuth']=='Y'?'active':''?>" onclick="searchFilter('isAuth', 'Y')">승인</span></a></p>
                    <p><a><span class="tag <?=$_GET['isAuth']=='N'?'active':''?>" onclick="searchFilter('isAuth', 'N')">미승인</span></a></p>
                </div>

                <div>
                    <p><strong>삭제상태</strong></p>
                </div>
                <div>
                    <input type="hidden" name="del_yn" value="<?=$_GET['del_yn']?>">
                    <p><a><span class="tag <?=empty($_GET['del_yn'])?'active':''?>" onclick="searchFilter('del_yn', '')">미삭제</span></a></p>
                    <p><a><span class="tag <?=$_GET['del_yn']=='Y'?'active':''?>" onclick="searchFilter('del_yn', 'Y')">삭제됨</span></a></p>
                </div>
                
                <div>
                    <p><strong onclick="set_agency_members()">에이전시</strong></p>
                </div>

                <div id="agency_filter_list" >
                    <p><a><span class="tag active">전체</span></a></p>
                    <!--
                    <p><a><span class="tag">A에이전시</span></a></p>
                    <p><a><span class="tag">B에이전시</span></a></p>
                    -->
                </div>
            </div>
        </div>
    </form>
    <form name="agency" method="post"></form>
    <div class="boxline">
        <div class="table adm">
            <table>
                <thead>
                <tr>
                    <th><input type="checkbox" onclick="selectAllCheckbox(this, 'checkIdx')"></th>
                    <th>No.</th>

                    <th>승인상태</th>
                    <th>아이디</th>
                    <th>병원명</th>
                    <th>담당자이름</th>
                    <th>담당자번호</th>
                    <!--
                    <th>사업자등록번호</th>
                    -->
                    <th>주소</th>
                    <th>병원전화</th>
                    <!--
                    <th>그룹</th>
                    -->
                    <th>에이전시</th>
                    <th>가격적용</th>
                    <th>등록일</th>
                    <!--
                    <th>미수</th>
                    -->
                    <th>비고</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($listData as $list) {
                    ?>
                    <tr>
                        <td><input type="checkbox" name="checkIdx" value="<?=$list['idx']?>"/></td>
                        <td><?=$paging['listNo']?></td>

                    <td><?=$list['auth_yn']=='Y'?'승인':'미승인'?></td>

                        <!--
                    <td><?=$list['cn_name']?></td>
                    -->
                        <td id="list_mb_id<?=$list['idx']?>"><?=$list['mb_id']?></td>
                        <td id="list_mb_name<?=$list['idx']?>"><?=$list['mb_name']?></td>
                        <td><?=$list['rep_name']?></td>
                        <td id="list_mb_hp<?=$list['idx']?>"><?=$list['mb_hp']?></td>
                        <!--
                    <td><?=!empty($list['biz_rno']) ? $list['biz_rno'] : '없음'?></td>
                    -->
                        <td><?=$list['cn_addr'].' '.$list['cn_addr_detail']?></td>


                    <td><?=$list['cn_tel']?></td>
                        <!--
                    <td><?=$list['groupName']?></td>
                    -->
                        <td><?=$list['agency']?></td>
                        <td <?php if($list['INSU_CHECK'] == "Y") { echo "class='txt_bold'";}?>><?=$list['INSU_CHECK'] == "Y" ? "보험가" : "기본가"?></td>
                        <td><?=replaceDateFormat($list['reg_date'])?></td>
                        <!--
                    <td><input type="checkbox" value="<?=$list['idx']?>" onclick="misuCheck(this)" <?=$list['misu_yn']=='Y'?'checked':''?>></td>
                    -->
                        <td>
                            

                            <?php if($list['del_yn'] == 'Y'){ ?>
                                <button type="button" class="btn btn_greenline" onclick="deleteCancelMember(<?=$list['idx']?>)">복구</button>
                            <?php }else{ ?>
                                <button type="button" class="btn btn_black" onclick="location.href='<?=ADM_URL?>/memberForm/<?=$list['idx']?>'">수정</button>
                            <?php } ?>
                            <!--<button type="button" class="btn btn_greenline" onclick="commonActionDelete('/apiAdmin/deleteMember', '<?=$list['idx']?>')">삭제</button>-->
                        </td>
                    </tr>
                    <?php
                    $paging['listNo']--;
                }
                if ($paging['totalCount'] == 0) { ?>
                    <tr><td colspan="20" class="noDataAlign">등록된 회원이 없습니다.</td></tr>
                <?php } ?>
                </tbody>
            </table>

        </div>

        <button type="button" class="btn btn_orange"  onclick="deleteMember('Y')">회원 삭제</button>


        <? include_once VIEWPATH . 'component/pagination.php'; // 페이징?>
    </div>
</section>

<script>
    const searchFrm = document.searchFrm; // 검색 폼

    // 검색
    searchFrm.addEventListener('submit', async (e) => {
        e.preventDefault();

        // 검색어 2글자 이상
        if(e.target.stx.value.length === 1) return showAlert("검색어를 2글자 이상 입력해 주세요.");
        searchFrm.submit();
    });

    // 검색 필터
    const searchFilter = (filter, value) => {
        searchFrm[filter].value = value;
        searchFrm.submit();
    }

    // 승인/승인취소
    const authCheck = async (isAuth) => {
        let idxArr = [];

        const checkboxes = document.querySelectorAll('input[name="checkIdx"]:checked');
        checkboxes.forEach((checkbox) => {
            idxArr.push(checkbox.value);
        });

        if(idxArr.length == 0) return showAlert("회원을 선택해 주세요.");

        const response = await fetchData(`/apiAdmin/updateAuthMember`, {idxArr, isAuth});
        if (response.result) {
            location.reload();
        } else {
            let message = response.message ? response.message : `변경에 실패하였습니다.`;
            showAlert(`${message}`, () => { location.reload(); });
        }
    }

    // 미수업체 등록/취소
    const misuCheck = async (checkbox) => {
        const idx = checkbox.value;
        const misuYn = checkbox.checked? 'Y' : 'N';
        const flag = (misuYn == 'Y')? '등록' : '취소';

        const confirmResult = await showConfirm(`미수업체 ${flag} 하시겠습니까?`);
        if (confirmResult.isConfirmed !== true) {
            return location.reload();
        }

        const response = await fetchData(`/apiAdmin/updateMisuMember`, {idx, misuYn});
        if (response.result) {
            showAlert(`완료되었습니다.`);
        } else {
            let message = response.message ? response.message : `변경에 실패하였습니다.`;
            showAlert(`${message}`, () => { location.reload(); });
        }
    }

    const set_agency_members = async () => {
        const agency_form = document.agency; // 등록 폼
        const formData = new FormData(agency_form);
        formData.append('agency', $('#mb_id').val());


        const response = await fetchData(`/agency/getAgencyMember`, formData);
        const now_agency = '<?=$_GET['agency']?>';
        if(response.listData){
            var list_data = response.listData;
            var html = '';
            var html2 = '';

            html2 = '<option value="">해제</option>';
            
            for (var i=0 ; i < list_data.length ; i++){

                if(i == 0 && now_agency == ''){
                    html += ' <p><a><span class="tag active" onclick="searchFilter(\'agency\',\'\')">전체</span></a></p>';
                }else if(i == 0){
                    html += ' <p><a><span class="tag" onclick="searchFilter(\'agency\',\'\')">전체</span></a></p>';
                }

                if(now_agency == list_data[i]['mb_id']){
                    html += '<p><a><span class="tag active" onclick="searchFilter(\'agency\',\'' + list_data[i]['mb_id'] + '\')">'+list_data[i]['mb_id']+'</span></a></p>';
                }else{
                    html += '<p><a><span class="tag" onclick="searchFilter(\'agency\',\'' + list_data[i]['mb_id'] + '\')">'+list_data[i]['mb_id']+'</span></a></p>';
                }

                html2 += '<option value="'+list_data[i]['mb_id']+'">'+list_data[i]['mb_id']+ '(' + list_data[i]['mb_name'] + ')</option>';
            }

            if(html){
                $('#agency_filter_list').html(html);
                $('#agency_option_list').html(html2);
            }else{
                $('#agency_filter_list').html(html);
                $('#agency_option_list').html(html2);
            }
        }

        console.log(response);
    }
    set_agency_members();

    // 승인/승인취소
    const set_checked_agency = async () => {
        let idxArr = [];

        const checkboxes = document.querySelectorAll('input[name="checkIdx"]:checked');
        checkboxes.forEach((checkbox) => {
            idxArr.push(checkbox.value);
        });

        if(idxArr.length == 0) return showAlert("회원을 선택해 주세요.");

        $('#agencyModal').modal('show');

        var html = '';
        var mb_id = '';
        var mb_name = '';
        var mb_hp = '';



        for (var i = 0 ; i < idxArr.length ; i++){
            mb_hp = $('#list_mb_hp' + idxArr[i]).html();
            mb_name = $('#list_mb_name' + idxArr[i]).html();
            mb_id = $('#list_mb_id' + idxArr[i]).html();
            html += '<li><span class="icon line">' + mb_id + '</span><strong>' + mb_name + ' | </strong>' + mb_hp + '</li>';
        }
        $('#agency_selected_list').html(html);

        var html2 = '';
        html2 = '선택 ' + idxArr.length + '개 업체';
        $('#agency_selected_cnt').html(html2);
    }

    // 선택된거 에이전시 업데이트
    const update_checked_agency = async () => {
        let idxArr = [];

        const checkboxes = document.querySelectorAll('input[name="checkIdx"]:checked');
        checkboxes.forEach((checkbox) => {
            idxArr.push(checkbox.value);
        });

        if(idxArr.length == 0) return showAlert("회원을 선택해 주세요.");
        isAuth = $('#agency_option_list').val();
        const response = await fetchData(`/apiAdmin/updateAgencyMember`, {idxArr, isAuth});
        if (response.result) {
            location.reload();
        } else {
            let message = response.message ? response.message : `변경에 실패하였습니다.`;
            showAlert(`${message}`, () => { location.reload(); });
        }
    }

    // 선택된거 보험가적용 업데이트
    const update_checked_INSU = async (INSU_CHECK) => {
        let idxArr = [];

        const checkboxes = document.querySelectorAll('input[name="checkIdx"]:checked');
        checkboxes.forEach((checkbox) => {
            idxArr.push(checkbox.value);
        });

        if(idxArr.length == 0) return showAlert("회원을 선택해 주세요.");

        const response = await fetchData(`/apiAdmin/updateMemberINSU`, {INSU_CHECK,idxArr});
        if (response.result) {
            location.reload();
        } else {
            let message = response.message ? response.message : `변경에 실패하였습니다.`;
            showAlert(`${message}`, () => { location.reload(); });
        }
    }

    // 회원삭제
    const deleteMember = async () => {
        let idxArr = [];

        const checkboxes = document.querySelectorAll('input[name="checkIdx"]:checked');
        checkboxes.forEach((checkbox) => {
            idxArr.push(checkbox.value);
        });

        if(idxArr.length == 0) return showAlert("회원을 선택해 주세요.");

        const confirmResult = await showConfirm('정말로 회원을 삭제하시겠습니까?');
        if (confirmResult.isConfirmed !== true) return false;
        else {

            var del_yn = 'Y';
            const response = await fetchData(`/apiAdmin/deleteMember`, {del_yn,idxArr});
            if (response.result) {
                location.reload();
            } else {
                let message = response.message ? response.message : `변경에 실패하였습니다.`;
                showAlert(`${message}`, () => { location.reload(); });
            }

        }
    }

    // 회원삭제 취소
    const deleteCancelMember = async (idx) => {

        let idxArr = [];
        idxArr.push(idx);

        if(idxArr.length == 0) return showAlert("회원을 선택해 주세요.");

        const confirmResult = await showConfirm('회원을 복구하시겠습니까?');
        if (confirmResult.isConfirmed !== true) return false;
        else {

            var del_yn = 'N';
            const response = await fetchData(`/apiAdmin/deleteMember`, {del_yn,idxArr});
            if (response.result) {
                location.reload();
            } else {
                let message = response.message ? response.message : `변경에 실패하였습니다.`;
                showAlert(`${message}`, () => { location.reload(); });
            }

        }
    }
</script>


<!-- Modal -->
<div class="modal fade" id="agencyModal" tabindex="-1" aria-labelledby="agencyModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="agencyModalLabel">에이전시 연결</h5>
			</div>
			<div class="modal-body">
				<div class="box box_gray">
					<details>
						<summary><p><span class="txt_blue txt_bold" id="agency_selected_cnt">선택 2개 업체</span>를 연결할 에이전시를 선택하세요.</p></summary>
						<div class="details">
							<ul id="agency_selected_list">
								<li><span class="icon line">구분</span><strong>업체명</strong> | 성함 | 아이디</li>
								<li><span class="icon line">구분</span><strong>업체명</strong> | 성함 | 아이디</li>
							</ul>
						</div>
					</details>

				</div>
				<select name="agency_option_list" id="agency_option_list">
					<option>A에이전시</option>
					<option>B에이전시</option>
				</select>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn_gray" data-dismiss="modal">닫기</button>
				<button type="button" class="btn btn_blue" onclick="update_checked_agency()">연결</button>
			</div>
		</div>
	</div>
</div>
