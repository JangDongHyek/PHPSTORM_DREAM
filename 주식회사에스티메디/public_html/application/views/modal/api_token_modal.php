<!--관리자 기본 배송비 설정-->
<div class="modal fade" id="apiTokenModal" tabindex="-1" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">토큰 설정</h5>
            </div>
            <div class="modal-body">
                <label>아이디</label>
                <input type="text" name="apiId" placeholder="아이디" value="stmedi"/>
                <label>비밀번호</label>
                <input type="text" name="apiPass" placeholder="비밀번호" value="6318702972"/>


                <?php if($configData['cf_access_token']){ ?>
                    <br>
                    <label>ACCESS_TOKEN</label>
                    <input type="text" name="" placeholder="엑세스토큰" value="<?=$configData['cf_access_token']?>"/>
                <?php } ?>

                <?php if($configData['cf_use_token']){ ?>
                    <br>
                    <label>USE_TOKEN</label>
                    <input type="text" name="" placeholder="유즈토큰" value="<?=$configData['cf_use_token']?>"/>
                <?php } ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn_blue" onclick="setDefaultToken('ACCESS')">ACCESS 토큰저장</button>
                <button type="button" class="btn btn_blue" onclick="setDefaultToken('USE')">USE 토큰저장</button>
            </div>
        </div>
    </div>
</div>
