
<?php
$member = session()->get('member') ?? [];
$lev = $member['mb_level'] ?? 0;
?>
<div id="board">
    <div class="panel flex ai-c jc-sb">
        <form>
            <div class="flex">
                <select name="sfl">
                    <option value="자주묻는질문유형" <?=($param['sfl'] === '자주묻는질문유형')? 'selected' : '' ?>>자주 묻는 질문 유형</option>
                    <option value="견적문의" <?=($param['sfl'] === '견적문의')? 'selected' : '' ?>>견적문의</option>
                    <option value="광고문의" <?=($param['sfl'] === '광고문의')? 'selected' : '' ?>>광고문의</option>
                    <option value="기타" <?=($param['sfl'] === '기타')? 'selected' : '' ?>>기타</option>
                </select>
                <div class="search">
                    <input type="search" name="stx" value="<?=$param['stx']?>" placeholder="검색어를 입력하세요">
                    <button class="btn_search" type="submit"><i class="fa-regular fa-magnifying-glass"></i></button>
                </div>
            </div>
        </form>

        <div class="btn_wrap">
            <?php if($lev === '10'):?>
            <a class="btn btn_small btn_color" href="./faqForm">등록</a>
            <?php endif;?>
        </div>
    </div>

    <div class="faq_list">
        <p>총 <strong class="txt_color"><?=$paging['totalCount'] ?? 0?></strong>개 </p>
        <?php if(empty($listData)):?>
            내용이 없습니다
        <?php else:
            foreach ($listData as $list):
        ?>
                <details>
                    <summary>
                        <div>
                            <div class="flex ai-c">
                                <p class="p_cate"><span class="txt_color txt_bold"><?=$list['category']?></span></p>
                                <p class="p_date"><?=replaceDateFormat($list['created_at'])?></p>
                                <div>
                                    <?php if($lev === '10' ):?>
                                    <a class="btn btn_mini btn_line editFaq" data-faq="<?=$list['idx']?>">수정</a>
                                    <?php endif;?>
                                    <?php if ($lev === '10'):?>
                                    <a class="btn btn_mini btn_line deleteFaq" data-faq="<?=$list['idx']?>">삭제</a>
                                    <?php endif;?>
                                </div>
                            </div>
                            <p class="p_title">Q. <?=$list['title']?></p>
                        </div>
                    </summary>
                    <div class="details">
                        <?=$list['content']?>
                    </div>
                </details>
        <?php endforeach;
        endif;?>
        <!--<details>
            <summary>
                <div>
                    <div class="flex ai-c">
                        <p class="p_cate"><span class="txt_color txt_bold">견적문의</span></p>
                        <p class="p_date">23.05.06</p>
                        <div>
                            <a class="btn btn_mini btn_line">수정</a>
                            <a class="btn btn_mini btn_line">삭제</a>
                        </div>
                    </div>
                    <p class="p_title">Q. 이사 견적은 어떻게 받을 수 있나요?</p>
                </div>
            </summary>
            <div class="details">
                이사 견적은 전화, 이메일 또는 웹사이트의 온라인 견적 요청 양식을 통해 요청하실 수 있습니다. 고객님의 이사 일정, 주소, 물품의 종류와 양에 따라 정확한 견적을 제공합니다.
            </div>
        </details>
        <details>
            <summary>
                <div>
                    <div class="flex ai-c">
                        <p class="p_cate"><span class="txt_color txt_bold">견적문의</span></p>
                        <p class="p_date">23.05.06</p>
                        <div>
                            <a class="btn btn_mini btn_line">수정</a>
                            <a class="btn btn_mini btn_line">삭제</a>
                        </div>
                    </div>
                    <p class="p_title">Q. 이사 비용은 어떻게 결정되나요?</p>
                </div>
            </summary>
            <div class="details">
                이사 비용은 이사 거리, 물품의 양, 포장 서비스 유무, 추가 서비스(청소, 가전 설치 등) 여부에 따라 결정됩니다. 자세한 비용은 상담 후 안내해 드립니다.
            </div>
        </details>
        <details>
            <summary>
                <div>
                    <div class="flex ai-c">
                        <p class="p_cate"><span class="txt_color txt_bold">견적문의</span></p>
                        <p class="p_date">23.05.06</p>
                        <div>
                            <a class="btn btn_mini btn_line">수정</a>
                            <a class="btn btn_mini btn_line">삭제</a>
                        </div>
                    </div>
                    <p class="p_title">Q. 포장 서비스를 이용하면 어떤 점이 좋은가요?</p>
                </div>
            </summary>
            <div class="details">
                포장 서비스를 이용하면 전문 포장 인력이 안전하게 물품을 포장하여 손상을 방지합니다. 또한, 시간이 절약되고, 이사 당일의 혼잡을 줄일 수 있습니다.
            </div>
        </details>-->

        <?php include_once APPPATH."Views/component/pagination.php" // 페이징 ?>
        <script src="<?= base_url()?>js/app/faq.js?<?=JS_VER?>"></script>
    </div>


</div>
