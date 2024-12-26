<div id="board">
    <div class="panel flex ai-c jc-sb">
        <form name="search" autocomplete="off">
            <div class="flex">
                <input type="hidden" name="bo" value="<?=$param['bo']?>">
                <select name="sfl">
                    <option value="title" <?=$param['sfl'] ===  'title' ? 'selected' : ''?> >제목</option>
                    <option value="content" <?=$param['sfl'] === 'content' ? 'selected' : ''?>>내용</option>
                    <option value="mbNick" <?=$param['sfl'] === 'mbNick' ? 'selected' : ''?>>작성자</option>
                </select>
                <div class="search">
                    <input type="search" name="stx" value="<?=$param['stx']?>" placeholder="검색어를 입력하세요">
                    <button type="submit" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
                </div>
            </div>
        </form>
        <div class="btn_wrap">
            <?php if ($auth['write'] ?? false): ?>
            <a class="btn btn_small btn_color" href="./boardForm?bo=<?=$param['bo']?>">
                등록
            </a>
            <?php endif;?>
        </div>
    </div>
    <div class="board_list">
        <p>총 <strong class="txt_color"><?=$paging['totalCount'] ?? 0?></strong>개 </p>
        <ul>
            <?php if(empty($listData)): ?>
                <li><p class="empty"> 게시글이 없습니다.</p></li>
            <?php else:
                foreach ($listData as $list):
                    $createdAtDate = date('Y-m-d', strtotime($list['created_at']));
                    ?>
                    <li class="<?= $list['fix_yn'] === 'Y' ? 'notice' : '' ?>" data-board="<?=$list['idx']?>">
                        <?php if ($list['fix_yn'] === 'Y'):?>
                            <p class="p_num"><span class="icon icon_line">공지</span></p>
                        <?php else:?>
                            <?php if ($param['bo'] === 'info'):?>
                                <p class="txt_blue">●</p>
                            <?php else:?>
                                <p class="p_num"><?=$paging['listNo']-- ?? 0?></p>
                            <?php endif;?>
                        <?php endif;?>
                        <p class="p_title"><a href="./boardView?bo=<?=$param['bo']?>&idx=<?=$list['idx']?>"><?=$list['title']?></a>
                            <?php if($today === $createdAtDate):?>
                                <span class="new">N</span>
                            <?php endif;?>
                        </p>
                        <p class="p_user"></p>
                        <!--<p class="p_user"><?/*=$list['mb_nick']*/?></p>
            <p class="p_date"><?/*=replaceDateFormat($list['created_at'])*/?></p>-->
                        <p class="p_date"></p>
                    </li>
                <?php endforeach;
            endif;
            ?>

        </ul>
        <?php include_once APPPATH."Views/component/pagination.php" // 페이징 ?>
    </div>
</div>
<script src="<?=base_url()?>js/app/board_form.js?<?=JS_VER?>"></script>
