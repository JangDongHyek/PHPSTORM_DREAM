<?php
$member = session()->get('member') ?? [];
?>
<div id="board">
    <input type="hidden" name="csIdx" id="csIdx" value="<?=$get['idx']?>">
    <div class="btn_wrap">
        <?php if ( $member['mb_id'] === 'admin'): ?>
            <a href="./csForm?bo=<?=$boardData['tbl_name']?>&idx=<?=$boardData['idx']?>"><button type="button" class="btn btn_colorline" >수정</button></a>
            <button type="button" class="btn btn_colorline" id="delete" data-idx="<?=$boardData['idx']?>">삭제</button>
        <?php endif;?>
        <a href="javascript:history.back()"><button type="button" class="btn btn_gray">목록</button></a>
    </div>
    <div class="board_view">
        <div class="box_line">
            <div class="title">
                <strong>
                  <!--  <?php /*if($boardData['fix_yn'] === 'Y'):*/?>
                        <span class="icon icon_line">공지</span>
                    --><?php /*endif;*/?>
                    <?=$boardData['title']?>
                </strong>
                <div class="info">
                    작성일 :<p><?=replaceDateFormat($boardData['created_at'])?></p>
                    작성자 :<p><?=$boardData['mb_nick']?></p>
                    담당자 :<p><?=$boardData['mb_name']?>(<?=$boardData['mb_hp']?>)</p>
                </div>
            </div>
            <div class="view">
                <?=$boardData['content']?>
            </div>
            <?php if($member['mb_id'] == 'lets080'): ?>
            <div class="attached_file">
                <div class="rqselect">
                    <label><i class="fa-solid fa-message-check"></i> 진행 상태</label>
                    <select name="csStatus" id="csStatus">
                        <option value="1" <?=($boardData['status']=="1")? 'selected':'' ?> >접수완료</option>
                        <option value="2" <?=($boardData['status']=="2")? 'selected':'' ?>>검토중</option>
                        <option value="3" <?=($boardData['status']=="3")? 'selected':'' ?>>처리중</option>
                        <option value="4" <?=($boardData['status']=="4")? 'selected':'' ?>>처리완료</option>
                    </select>
                </div>
            </div>
            <?php endif;?>
            <?php if (!empty($fileData)): // 다운로드 파일 존재 ?>
                <div class="attached_file">
                    <label>첨부 파일</label>
                    <p>
                        <?php foreach ($fileData as $file):?>
                            <a href="<?=base_url()?><?=$file['download']?>"><i class="fas fa-folder-download"></i> <?=$file['orgName']?></a><br>
                        <?php endforeach;?>
                        <!-- <a href=""><i class="fas fa-folder-download"></i> 국군의_날_이미지.PNG</a><br>
                         <a href=""><i class="fas fa-folder-download"></i> 국군의_날_이미지.PNG</a><br>-->
                    </p>
                </div>
            <?php endif; ?>
            <div class="answer">
                <?php if (empty($comment)):?>
                <dl>
                    <dt>
                        답글이 업습니다.
                    </dt>
                </dl>
                <?php else:
                    foreach ($comment as $row):
                ?>
                        <dl>
                            <dt><?= $member[''];?>
                                <i class="fa-light fa-arrow-turn-down-right"></i>
                                <strong><?=$row['mb_nick']?></strong>
                                답변일 <strong><?=replaceDateFormat($row['created_at'])?></strong>
                                <?php if ($row['mb_idx'] === $member['idx'] || $member['mb_id'] === 'lets080'): ?>
                                    <a class="btn btn_line edit-btn">수정</a>
                                <?php endif;?>
                                <?php if ($row['mb_idx'] === $member['idx'] || $member['mb_id'] === 'lets080'): ?>
                                    <a class="btn btn_line delete-btn" data-up="del" data-coidx="<?=$row['idx']?>">삭제</a>
                                <?php endif; ?>
                            </dt>
                            <dd><?=$row['content']?></dd>
                        </dl>

                        <div class="comment-form" style="display: none;">
                            <form name="comment-edit" autocomplete="off">
                                <div class="answer_write">
                                    <input type="hidden" name="boardIdx" value="<?=$get['idx']?>">
                                    <input type="hidden" name="idx" data-up="edit" value="<?=$row['idx']?>">
                                    <textarea name="content" placeholder="답변을 등록해 주세요"><?=$row['content']?></textarea>
                                    <button class="btn btn_color" type="submit">답변수정</button>
                                </div>
                            </form>
                        </div>
                    <?php endforeach;
                endif;
                ?>
                <form name="comment" autocomplete="off">
                    <div class="answer_write">
                        <input type="hidden" name="boardIdx" value="<?=$get['idx']?>">
                        <textarea name="content" placeholder="답변을 등록해 주세요"></textarea>
                        <button class="btn btn_color" type="submit">답변등록</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url()?>js/app/board_view.js?<?=JS_VER?>"></script>
