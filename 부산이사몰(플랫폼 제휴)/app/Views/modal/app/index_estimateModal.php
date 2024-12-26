<?php
?>
<!-- 메인 간편 견적 신청  -->
<div class="modal fade" id="estimateModal" tabindex="-1" aria-labelledby="estimateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="estimateModalLabel">개인정보 등록</h5>
            </div>
            <div class="modal-body">
                <dl class="form_wrap">
                    <input type="hidden" name="mbIdx" id="mbIdx" value="<?=session()->get('member')['idx'] ?? ''?>">
                    <dt><label for="">이사 고객님</label></dt>
                    <dd><input type="text" name="mbName" id="mbName" value="<?=session()->get('member')['mb_name'] ?? ''?>" placeholder="이사 고객님" required /></dd>
                    <dt><label for="">연락처</label></dt>
                    <dd><input type="text" name="mbHp" id="mbHp" value="<?=session()->get('member')['mb_hp'] ?? ''?>" placeholder="연락처" required /></dd>
                </dl>
                <hr>
                <div class="box_line form_wrap">
                    <dl>
                        <dt>
                            <input type="checkbox" id="agree02" name="agree2" value="1">
                            <label for="agree02">개인정보처리방침 동의 <span class="txt_color">[필수]</span></label>
                        </dt>
                        <dd>
                            <div class="box_scroll">
                                <?php include APPPATH."Views/app/privacy.php"; ?>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="request">신청 완료</button>
            </div>
        </div>
    </div>
</div>