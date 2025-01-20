<!--관리자-그룹관리 목록-->
<section class="member">
    <form name="searchFrm" autocomplete="off">
        <input type="hidden" name="page" value="1">
        <div class="panel">
            <p>총 <span class="green"><?=$paging['totalCount']?></span>개 </p>
            <div>
                <select name="sfl">
                    <option value="gname">그룹명</option>
                </select>
                <input class="search-bar" name="stx" type="search" value="<?=$_GET['stx']?>" placeholder="검색어를 입력하세요">
                <button type="submit" class="btn_search"><i class="fa-light fa-magnifying-glass"></i></button>
            </div>
            <button type="button" class="btn btn_green" onclick="openRegisterModal()">등록하기</button>
        </div>
    </form>
    <div class="boxline">
        <div class="table adm">
            <table>
                <colgroup>
                    <col width="5%">
                    <col width="*">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="15%">
                </colgroup>
                <thead>
                <tr>
                    <th>No.</th>
                    <th>그룹명</th>
                    <th>등록 한의원 수</th>
                    <th>할증</th>
                    <th>등록일</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($listData as $list) {
                ?>
                <tr>
                    <td><?=$paging['listNo']?></td>
                    <td><?=$list['group_name']?></td>
                    <td>
                        <?if ($list['clinicCnt'] > 0) { ?>
                        <a href="/adm/clinic?groupIdx=<?=$list['idx']?>" target="_blank" style="display: inline-block;"><?=number_format($list['clinicCnt'])?></a>
                        <? } else {
                            echo number_format($list['clinic_cnt']);
                        } ?>
                    </td>
                    <td><?=$list['premium_rate']?>%</td>
                    <td><?=replaceDateFormat($list['reg_date'])?></td>
                    <td>
                        <button type="button" class="btn btn_black" onclick="openRegisterModal('<?=$list['idx']?>')">수정</button>
                        <button type="button" class="btn btn_greenline" onclick="commonActionDelete('/apiAdmin/deleteMemberGroup', '<?=$list['idx']?>')">삭제</button>
                    </td>
                </tr>
                <?php
                    $paging['listNo']--;
                }
                if ($paging['totalCount'] == 0) { ?>
                <tr><td colspan="20" class="noDataAlign">등록된 그룹이 없습니다.</td></tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <? include_once VIEWPATH. 'component/pagination.php'; // 페이징?>
    </div>
</section>

<?php include_once MODAL_PATH. "member_group_modal.php" // 등록/수정 모달 ?>

<script>
    const searchFrm = document.searchFrm; // 검색 폼
    const groupFrm = document.groupFrm; // 등록/수정 폼
    const groupModal = $('#groupmodal01'); // 모달
    let label = "등록";

    // 등록/수정 모달
    const openRegisterModal = async (idx) => {
        clearForm('groupFrm');
        groupModal.modal();

        if(idx) {
            const response = await fetchData(`/apiAdmin/memberGroupInfo/${idx}`, "", "GET");
            if (!response.data || Object.keys(response.data).length == 0) {
                showAlert(`정보를 불러오는데 실패했습니다.`);
                return false;
            }

            const data = response.data;
            groupFrm.idx.value = data.idx;
            groupFrm.groupName.value = data.group_name;
            groupFrm.premiumRate.value = addCommaDecimal(data.premium_rate);
            label = "수정";
        }
        groupModal.find(".labelMsg").text(label);
    }

    // 등록/수정
    groupFrm.addEventListener('submit', async (e) => {
        e.preventDefault();

        // 필수필드 검사
        groupFrm.groupName.value = removeWhitespace(groupFrm.groupName.value);
        if (groupFrm.groupName.value.length < 2) {
            showAlert('그룹명을 입력해 주세요.', groupFrm.groupName.focus());
            return false;
        }

        const formData = new FormData(groupFrm);
        await commonActionRegister('/apiAdmin/registerMemberGroup', formData, label);
    });
</script>
