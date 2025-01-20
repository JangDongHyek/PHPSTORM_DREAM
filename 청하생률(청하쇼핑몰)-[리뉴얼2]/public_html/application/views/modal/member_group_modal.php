<!--관리자 그룹관리 등록/수정 모달-->
<div class="modal fade" id="groupmodal01" tabindex="-1" aria-labelledby="groupmodal01Label" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="groupmodal01Label">한의원 그룹 <span class="labelMsg">등록</span></h5>
            </div>
            <form name="groupFrm" method="post" autocomplete="off">
                <input type="hidden" name="idx" value="">
                <div class="modal-body">
                    <label>그룹명</label>
                    <input type="text" name="groupName" placeholder="그룹명을 입력해주세요">
                    <label>할증 (%)</label>
                    <input type="text" name="premiumRate" onkeyup="this.value=addCommaDecimal(this.value)" placeholder="할인율을 입력해주세요 (숫자만 입력)">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">취소</button>
                    <button type="submit" class="btn btn_green"><span class="labelMsg">등록</span></button>
                </div>
            </form>
        </div>
    </div>
</div>