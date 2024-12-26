<?php
$member = session()->get('member') ?? [];
?>
<div id="board">

    <div class="btn_wrap">
        <?php if ($auth['modify'] ?? false): ?>
        <a class="btn btn_small btn_gray2" href="./boardForm?bo=<?=$boardData['tbl_name']?>&idx=<?=$boardData['idx']?>">수정</a>
        <?php endif;?>
        <?php if ($auth['delete'] ?? false): ?>
        <a class="btn btn_small btn_gray" id="delete" data-idx="<?=$boardData['idx']?>">삭제</a>
        <?php endif;?>
        <a class="btn btn_small btn_gray" href="javascript:history.back()">목록</a>
    </div>

    <div class="board_view">
        <div class="box_line">
            <div class="title">
                <strong>
                    <?php if($boardData['fix_yn'] === 'Y'):?>
                        <span class="icon icon_line">공지</span>
                    <?php endif;?>
                    <?=$boardData['title']?>
                </strong>
                <!--<div class="info">
                    작성자 <p><?/*=$boardData['mb_nick']*/?></p>
                    작성일 <p><?/*=replaceDateFormat($boardData['created_at'])*/?></p>
                </div>-->
            </div>
            <div class="view">
                <?=$boardData['content']?>
            </div>
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
            <!--<div class="answer">
                <?php /*if (empty($comment)):*/?>
                <dl>
                    <dt>
                        답글이 업습니다.
                    </dt>
                </dl>
                <?php /*else:
                    foreach ($comment as $row):
                */?>
                        <dl>
                            <dt><?/*= $member[''];*/?>
                                <i class="fa-light fa-arrow-turn-down-right"></i>
                                작성자 <strong><?/*=$row['mb_nick']*/?></strong>
                                답변일 <strong><?/*=replaceDateFormat($row['created_at'])*/?></strong>
                                <?php /*if ($row['mb_idx'] === $member['idx'] || $member['mb_id'] === 'admin' || $member['mb_id'] === 'lets080'): */?>
                                    <a class="btn btn_line edit-btn">수정</a>
                                <?php /*endif;*/?>
                                <?php /*if ($row['mb_idx'] === $member['idx'] || $member['mb_id'] === 'admin' || $member['mb_id'] === 'lets080'): */?>
                                    <a class="btn btn_line delete-btn" data-up="del" data-coidx="<?/*=$row['idx']*/?>">삭제</a>
                                <?php /*endif; */?>
                            </dt>
                            <dd><?/*=$row['content']*/?></dd>
                        </dl>

                        <div class="comment-form" style="display: none;">
                            <form name="comment-edit" autocomplete="off">
                                <div class="answer_write">
                                    <input type="hidden" name="boardIdx" value="<?/*=$get['idx']*/?>">
                                    <input type="hidden" name="idx" data-up="edit" value="<?/*=$row['idx']*/?>">
                                    <textarea name="content" placeholder="답변을 등록해 주세요"><?/*=$row['content']*/?></textarea>
                                    <button class="btn btn_color" type="submit">답변수정</button>
                                </div>
                            </form>
                        </div>
                    <?php /*endforeach;
                endif;
                */?>
                <form name="comment" autocomplete="off">
                    <div class="answer_write">
                        <input type="hidden" name="boardIdx" value="<?/*=$get['idx']*/?>">
                        <textarea name="content" placeholder="답변을 등록해 주세요"></textarea>
                        <button class="btn btn_color" type="submit">답변등록</button>
                    </div>
                </form>
            </div>-->
        </div>
    </div>
</div>
<script src="<?= base_url()?>js/app/board_view.js?<?=JS_VER?>"></script>
