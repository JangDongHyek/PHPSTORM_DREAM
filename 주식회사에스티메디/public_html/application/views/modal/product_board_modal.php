<!--상품 후기/문의 등록/수정 모달-->
<?php
$isAdminAccount = isAdminCheck($this->session->userdata('member')['mb_level']); // 관리자여부?
?>
<div class="modal fade" id="boardModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="myModalLabel"></h5>
            </div>
            <form name="write" autocomplete="off">
                <input type="hidden" name="idx" value="">
                <input type="hidden" name="ref_idx" value="<?=$productData['idx']?>">
                <input type="hidden" name="category" value="review">

                <div class="modal-body">
                    <div class="board_write">
                        <div class="form">
                            <input type="text" name="title" placeholder="제목을 작성해주세요" required>
                            <textarea name="content" placeholder="상세내용을 작성해주세요"></textarea>
                        </div>
                        <div>
                            <dl class="addFile">
                                <dd id="addFile1" style="margin-bottom: 5px;">
                                    <a class="btn btn_black">파일첨부</a>
                                    <span>파일을 선택하세요..</span>
                                </dd>
                                <dd id="addFile2">
                                    <a class="btn btn_black">파일첨부</a>
                                    <span>파일을 선택하세요..</span>
                                </dd>
                            </dl>
                            <input type="hidden" name="fileName[1]" value="">
                            <input type="hidden" name="fileName[2]" value="">
                            <input type="hidden" name="orgFileName[1]" value="">
                            <input type="hidden" name="orgFileName[2]" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn_line" data-dismiss="modal">닫기</button>
                    <button type="submit" class="btn btn_gray"><span class="labelMsg">등록</span></button>
                </div>
            </form>
            <!-- file upload hidden -->
            <div class="hide">
                <input type="file" name="file1" onchange="fileUpload(this, 1);">
                <input type="file" name="file2" onchange="fileUpload(this, 2);">
            </div>
        </div>
    </div>
</div>

<!--상품 후기 상세 모달-->
<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="myModalLabel">상품후기 상세</h5>
            </div>
            <div class="modal-body">
                <div class="board_view">
                    <div class="title">
                        <strong id="boardTitle">빠른 배송 감사합니다!</strong>
                        <div class="info">
                            작성자 <p id="boardCnname">**병원</p>
                            작성일 <p id="boardRegdate">2023.05.06</p>
                        </div>
                    </div>
                    <div class="view" id="boardContent">
                        빠른 배송 감사합니다!
                    </div>
                    <!--이미지-->
                    <div class="img" id="boardFiles"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_line" data-dismiss="modal">닫기</button>
                <!--<button type="button" class="btn btn_gray">확인</button>-->
            </div>
        </div>
    </div>
</div>

<!--상품 문의 상세 모달-->
<div class="modal fade" id="qnaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="myModalLabel">상품문의 상세</h5>
            </div>
            <div class="modal-body">
                <div class="board_view">
                    <div class="title">
                        <strong id="boardTitle">빠른답변부탁드립니다</strong>
                        <div class="info">
                            작성자 <p id="boardCnname">**병원</p>
                            작성일 <p id="boardRegdate">2023.05.06</p>
                        </div>
                    </div>
                    <div class="view" id="boardContent">
                        배송관련 질문입니다.<br>
                        16일에 주문했는데, 발송전인거 같습니다.<br>
                        확인부탁드립니다.
                    </div>
                    <!--이미지-->
                    <div class="img" id="boardFiles"></div>
                    <div class="answer">
                        <div id="answerList">
                            <!--답변목록-->
                        </div>
                        <? if($isAdminAccount) { ?>
                        <div class="answer_write hide">
                            <input type="hidden" name="boardIdx" value="">
                            <input type="hidden" name="commentIdx" value="">
                            <textarea name="answer" placeholder="답변을 등록해 주세요"></textarea>
                            <a class="btn btn_blue" onclick="registerAnswer()">답변등록</a>
                        </div>
                        <? } ?>

                        <input type="hidden" name="level" value="<?=$this->session->userdata('member')['mb_level']?>">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_line" data-dismiss="modal">닫기</button>
                <!--<button type="button" class="btn btn_gray">확인</button>-->
            </div>
        </div>
    </div>
</div>
