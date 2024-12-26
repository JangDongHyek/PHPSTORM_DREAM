<section class="estimate">
    <form name="estimate" autocomplete="off">
        <input type="hidden" name="mbidx" value="<?=session()->get('member')['idx'] ?? 0?>">
        <input type="hidden" name="estIdx" value="<?=$idxData['idx'] ?? 0?>">
        <div class="box_gray">
            <div class="select">
                <?php
                foreach (SERVICE_TYPE as $key => $value) :
                    if ($key !== '') : ?>
                        <input type="radio" id="serviceType<?=$key?>" name="movingType" value="<?=$key?>"  <?=(($idxData['service_type'] ?? '') === $key || $key === 'P') ? 'checked' : ''; ?> /><label for="serviceType<?=$key?>"><?=$value?></label>
                    <?php endif;
                endforeach; ?>
            </div>

            <br>
            <div>
                <dl class="form_wrap">
                    <dt><label for="schedDate">이사 예정일</label></dt>
                    <dd><input type="date" name="schedDate" id="schedDate" placeholder="이사 예정일" value="<?=$idxData['sched_date'] ?? ''?>" required /></dd>
                    <dt><label for="origin">출발지</label></dt>
                    <dd><input type="text" name="origin" id="origin" placeholder="출발지" value="<?=$idxData['origin'] ?? ''?>" required /></dd>
                    <dt><label for="bourne">도착지</label></dt>
                    <dd><input type="text" name="bourne" id="bourne" placeholder="도착지" value="<?=$idxData['bourne']?>" required /></dd>
                </dl>
                <hr>
                <dl class="form_wrap">
                    <dt><label for="mbName">이사 고객님</label></dt>
                    <dd><input type="text" name="mbName" id="mbName" value="<?=session()->get('member')['mb_name'] ?? ''?>" placeholder="이사 고객님" required /></dd>
                    <dt><label for="mbHp">연락처</label></dt>
                    <dd><input type="text" name="mbHp" id="mbHp" value="<?=session()->get('member')['mb_hp'] ?? ''?>" placeholder="연락처" data-format="tel" required /></dd>
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
        </div>
        <br>
        <button type="submit" class="btn btn_large btn_color">이사견적 <?=(!empty($idxData) ? '수정' : '신청')?></button>
    </form>
</section>
<script src="<?=base_url()?>js/app/estimate.js?<?=JS_VER?>"></script>