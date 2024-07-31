<?php
echo view('common/header_adm');
echo view('common/adm_head');

alert($msg);

?>


        <?php echo view('member/member_head'); ?>
        <div class="sch_wrap">
            <div>
                <form class="box">
                    <div class="sch01">
                        <p>검색하기</p>
                        <div class="input_select">
                            <select class="border_gray" id="sf" name="sf">
                                <option value="mb_id" <?php echo get_selected($sf, "mb_id"); ?>>아이디</option>
                                <option value="mb_name" <?php echo get_selected($sf, "mb_name"); ?>>이름</option>
                            </select>
                        </div>

                        <div class="input_search">
                            <input type="text" placeholder="검색어를 입력하세요" class="border_gray" id="st" name="st" value="<?=$st?>">
                            <button><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                    <div class="sch02">
                        <p>승인여부</p>
                        <div class="input_select">
                            <select class="border_gray" id="sf_sign" name="sf_sign">
                                <option value="" <?php echo get_selected($sf_sign, ""); ?>>전체</option>
                                <option value="Y" <?php echo get_selected($sf_sign, "Y"); ?>>승인</option>
                                <option value="N" <?php echo get_selected($sf_sign, "N"); ?>>비승인</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="result_wrap">
            <div class="top_text">
                <div class="wrap">
                    <h1>총 <?=number_format($member_data['total_count'])?>개</h1>
<!--                    <div class="input_select2">
                        <select>
                            <option value="10개씩 보기">10개씩 보기</option>
                            <option value="20개씩 보기">20개씩 보기</option>
                            <option value="30개씩 보기">30개씩 보기</option>
                        </select>
                    </div>-->
                </div>

                <div class="wrap">
                    <a href="<?=base_url('member/member_form?member_type='.$member_type)?>" class="btn btn-write">
                        <i class="fa-regular fa-plus color-blue"></i> 등록하기
                    </a>
                </div>
            </div>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th width='100px'>회원고유번호</th>
                        <th>성명(아이디)</th>
                        <th>연락처</th>
                        <th>이메일</th>
                        <th>등록일</th>
                        <th width='100px'>상태</th>
                        <th width='130px'>편집</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?
                        $list = $member_data['list'];
                        if(count($list) == 0){ ?>
                            <tr>
                                <td colspan="100">
                                    <div class="nodata">
                                        <p>검색결과가 없습니다.</p>
                                    </div>
                                </td>
                            </tr>
                        <?} else {
                            for($i=0; $i<count($list); $i++) {
                                $data = $list[$i];
                                $sign = "승인";
                                if($data['is_sign'] != "Y"){
                                    $sign = "비승인";
                                }

                                ?>
                                <tr>
                                    <td><?=$data['mb_no']?></td>
                                    <td><?=$data['mb_name']."(".$data['mb_id'].")"?></td>
                                    <td><?=$data['mb_hp']?></td>
                                    <td><?=$data['mb_email']?></td>
                                    <td><?=$data['reg_date']?></td>
                                    <td><?=$sign?></td>
                                    <td>
                                        <div class="btn_wrap">
                                            <a href="<?=base_url("member/member_form?w=u&mb_no={$data['mb_no']}&member_type={$member_type}")?>" class="btn btn-sm btn-skyblue">수정</a>
                                            <!--<a onclick="confirm_modal()" class="btn btn-sm btn-gray">삭제</a>-->
                                        </div>
                                    </td>
                                </tr>
                            <?}?>
                        <?}?>
                    </tbody>
                </table>
            </div>

            <?php echo createPagination($page, $member_data['total_count'], $member_data['items_per_page'], getCurrentUrl()); ?>
        </div>

<?php
echo view('common/adm_tail');
echo view('common/footer');
?>