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
                <!--
                <button type="button" class="btn btn_gray" onclick="authCheck('Y')">선택 승인</button>
                <button type="button" class="btn" onclick="authCheck('N')">선택 승인취소</button>
                -->
                <button type="button" class="btn btn_green" onclick="location.href='<?=ADM_URL?>/memberForm'">등록하기</button>
            </span>
        </div>
        <div class="box">
            <div class="tagbox" style="display: none">
                <div>
                    <p><strong>그룹</strong></p>
                </div>
                <div>
                    <input type="hidden" name="groupIdx" value="<?=$_GET['groupIdx']?>">
                    <p><a><span class="tag <?=empty($_GET['groupIdx'])?'active':''?>" onclick="searchFilter('groupIdx', '')">전체</span></a></p>
                    <?php foreach ($searchFilter['groupNames'] as $key=>$value) { ?>
                    <p><a><span class="tag <?=$_GET['groupIdx']==$key?'active':''?>" onclick="searchFilter('groupIdx', '<?=$key?>')"><?=$value?></span></a></p>
                    <?php } ?>
                </div>
                <div>
                    <p><strong>승인상태</strong></p>
                </div>
                <div>
                    <input type="hidden" name="isAuth" value="<?=$_GET['isAuth']?>">
                    <p><a><span class="tag <?=empty($_GET['isAuth'])?'active':''?>" onclick="searchFilter('isAuth', '')">전체</span></a></p>
                    <p><a><span class="tag <?=$_GET['isAuth']=='Y'?'active':''?>" onclick="searchFilter('isAuth', 'Y')">승인</span></a></p>
                    <p><a><span class="tag <?=$_GET['isAuth']=='N'?'active':''?>" onclick="searchFilter('isAuth', 'N')">미승인</span></a></p>
                </div>
                <div>
                    <p><strong>미수업체</strong></p>
                </div>
                <div>
                    <input type="hidden" name="isMisu" value="<?=$_GET['isMisu']?>">
                    <p><a><span class="tag <?=empty($_GET['isMisu'])?'active':''?>" onclick="searchFilter('isMisu', '')">전체</span></a></p>
                    <p><a><span class="tag <?=$_GET['isMisu']=='Y'?'active':''?>" onclick="searchFilter('isMisu', 'Y')">여</span></a></p>
                    <p><a><span class="tag <?=$_GET['isMisu']=='N'?'active':''?>" onclick="searchFilter('isMisu', 'N')">부</span></a></p>
                </div>
            </div>
        </div>
    </form>
    <div class="boxline">
        <div class="table adm">
            <table>
                <thead>
                <tr>
                    <th><input type="checkbox" onclick="selectAllCheckbox(this, 'checkIdx')"></th>
                    <th>No.</th>
                    <!--
                    <th>승인상태</th>
                    <th>한의원명</th>
                    -->
                    <th>아이디</th>
                    <th>성함</th>
                    <th>휴대폰</th>
                    <!--
                    <th>사업자등록번호</th>
                    -->
                    <th>주소</th>
                    <!--
                    <th>대표전화</th>
                    <th>그룹</th>
                    -->
                    <th>등록일</th>
                    <!--
                    <th>미수</th>
                    -->
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($listData as $list) {
                ?>
                <tr>
                    <td><input type="checkbox" name="checkIdx" value="<?=$list['idx']?>"/></td>
                    <td><?=$paging['listNo']?></td>
                    <!--
                    <td><?=$list['auth_yn']=='Y'?'승인':'미승인'?></td>
                    <td><?=$list['cn_name']?></td>
                    -->
                    <td><?=$list['mb_id']?></td>
                    <td><?=$list['mb_name']?></td>
                    <td><?=$list['mb_hp']?></td>
                    <!--
                    <td><?=!empty($list['biz_rno']) ? $list['biz_rno'] : '없음'?></td>
                    -->
                    <td><?=$list['cn_addr'].' '.$list['cn_addr_detail']?></td>
                    <!--
                    <td><?=$list['cn_tel']?></td>
                    <td><?=$list['groupName']?></td>
                    -->
                    <td><?=replaceDateFormat($list['reg_date'])?></td>
                    <!--
                    <td><input type="checkbox" value="<?=$list['idx']?>" onclick="misuCheck(this)" <?=$list['misu_yn']=='Y'?'checked':''?>></td>
                    -->
                    <td>
                        <button type="button" class="btn btn_black" onclick="location.href='<?=ADM_URL?>/memberForm/<?=$list['idx']?>'">수정</button>
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
</script>