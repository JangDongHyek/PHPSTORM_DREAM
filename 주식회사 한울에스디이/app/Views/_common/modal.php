<!-- 프로젝트 이동 -->
<?php if($projects) {?>
<div class="modal fade" id="moveModal" tabindex="-1" aria-labelledby="moveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="moveModalLabel">프로젝트 이동</h5>
            </div>
            <div class="modal-body">
                <div class="form_wrap">
                    <label for="">프로젝트 선택</label>
                    <select onchange="changeProject(this)">
                        <? foreach($projects['data'] as $p) { ?>
                        <option value="<?=$p['idx']?>" <?=$p['idx'] == $project['idx'] ? 'selected' : ''?>><?=$p['name']?></option>
                        <?}?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<script>
    async function changeProject(el) {
        const val = el.value;

        let obj = {idx : val};

        try {
            let res = await jl.ajax("change",obj,"/api/project_base");
            window.location.reload();
        }catch (e) {
            alert(e.message)
        }
    }
</script>



<!-- 수량산출서 수량 등록 -->
<div class="modal fade" id="recordFormModal" tabindex="-1" aria-labelledby="recordFormModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="recordFormModalLabel">수량 등록</h5>
            </div>
            <div class="modal-body">
                <div class="form_wrap">
                    <label for="">품명</label>
                    <input type="text" name="" id="" placeholder="품명"/>
                    <label for="">규격</label>
                    <input type="text" name="" id="" placeholder="규격"/>
                    <label for="">단위</label>
                    <input type="text" name="" id="" placeholder="단위"/>
                    <label for="">수량</label>
                    <input type="text" name="" id="" placeholder="수량"/>
                    <label for="">단가</label>
                    <input type="text" name="" id="" placeholder="단가"/>
                    <label for="">금액</label>
                    <input type="text" name="" id="" placeholder="금액"/>
                    <label for="">비고</label>
                    <input type="text" name="" id="" placeholder="비고"/>
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>-->
                <button type="button" class="btn btn-primary">등록 완료</button>
            </div>
        </div>
    </div>
</div>

<!-- 다운로드 모달 -->
<div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="downloadModalLabel">파일 다운로드</h5>
            </div>
            <div class="modal-body">
                <div class="download_wrap">
                   <input type="checkbox"><label>전체 선택</label>
                   <ul>
                       <li>
                           <span><input type="checkbox" /><label>230926_TBN충남교통방송청사신축공사_건축내역서_(2).xlsx</label></span>
                           <button class="btn btn_mini btn_blue">다운로드</button>
                       </li>
                       <li>
                           <span><input type="checkbox" /><label>계룡-갑천2지구 지하주차장_공정별물량_(1).xlsx</label></span>
                           <button class="btn btn_mini btn_blue">다운로드</button>
                       </li>
                       <li>
                           <span><input type="checkbox" /><label>230926_금일 보고서.xlsx</label></span>
                           <button class="btn btn_mini btn_blue">다운로드</button>
                       </li>
                   </ul>
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>-->
                <button type="button" class="btn btn-primary">선택 다운로드</button>
            </div>
        </div>
    </div>
</div>

<!-- 작업구역 관리 -->
<div class="modal fade" id="sectionModal" tabindex="-1" aria-labelledby="sectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="sectionModalLabel">작업 구역 관리</h5>
            </div>
            <div class="modal-body">
                <div class="form_wrap">
                    <label for="">동 정보</label>
                    <div class="flex ai-c">
                        <select>
                            <option>101동</option>
                        </select>
                        <span>~</span>
                        <select>
                            <option>101동</option>
                        </select>
                    </div>
                    <label for="">층 정보</label>
                    <div class="flex ai-c">
                        <input type="text" name="" id="" placeholder="0"/>&nbsp;<span>층</span>
                    </div>
                    <label for="">구역 정보</label>
                    <div class="flex ai-c">
                        <select>
                            <option>A-1</option>
                        </select>
                        <span>~</span>
                        <select>
                            <option>A-20</option>
                        </select>
                    </div>
                    <br>
                    <div class="flex ai-c">
                        <label for="" class="txt_up">공종명 등록</label>&nbsp;&nbsp;
                        <button class="btn btn_mini btn_black">추가</button>
                    </div>
                    <ul>
                        <li class="flex ai-c"><input type="text" placeholder="공종명을 입력하세요"> <button class="btn btn_mini btn_gray">삭제</button></li>
                        <li class="flex ai-c"><input type="text" placeholder="공종명을 입력하세요"> <button class="btn btn_mini btn_gray">삭제</button></li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>-->
                <button type="button" class="btn btn-primary">등록 완료</button>
            </div>
        </div>
    </div>
</div>
