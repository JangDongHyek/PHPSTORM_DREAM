<?php
echo view('common/header_adm');
echo view('common/adm_head');
$header_name = "주소록 관리";
alert();
?>
<style>
    #adm_content .con_wrap .sch_wrap .box .sch01{
        grid-template-columns: 150px 1fr 150px;
    }
    #adm_content .con_wrap .sch_wrap .box .sch01 > p{
        grid-column: 1/4;
    }
    #adm_content .con_wrap .sch_wrap .box .sch01 .btn-blue{
        font-size: 1em;
    }
    #adm_content .con_wrap .table{    
        overflow-x: scroll;
    }
    #adm_content .con_wrap .table > table > thead > tr > th,
    #adm_content .con_wrap .table > table > tbody > tr > td{
        text-align: center!important;
    }
</style>



        <?php echo view('delivery/delivery_head', $this->data); ?>

        <div class="sch_wrap">
            <p class="tit">검색결과</p>
            <form class="box">
                <div class="sch01" style="width: 100%;">
                    <p>검색하기</p>
                    <div class="input_select">
                        <select class="border_gray" id="sf" name="sf">
                            <option value="addrName" <?php echo get_selected($sf, "addrName"); ?>>주소록명</option>
                            <option value="addr1" <?php echo get_selected($sf, "addr1"); ?>>주소</option>
                            <option value="addr2" <?php echo get_selected($sf, "addr2"); ?>>상세 주소</option>
                            <option value="homeTel" <?php echo get_selected($sf, "homeTel"); ?>>전화 번호</option>
                            <option value="cellPhone" <?php echo get_selected($sf, "cellPhone"); ?>>휴대폰 번호</option>
                        </select>
                    </div>

                    <div class="input_search">
                        <input type="text" placeholder="검색어를 입력하세요" class="border_gray" id="st" name="st" value="<?=$st?>">
                        <button><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    <a href="<?=base_url('delivery/addressList')?>" class="btn btn-blue">초기화</a>
                </div>
            </form>
        </div>

        <div class="result_wrap">
            <div class="top_text">
                <div class="wrap">
                    <h1>총 <?=number_format($address_data['total_count'])?>개</h1>
                </div>

                <div class="wrap">
                    <a href="<?=base_url('delivery/addressForm')?>" class="btn btn-write">
                        <i class="fa-regular fa-plus color-blue"></i> 등록하기
                    </a>
                </div>
            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th width='130px'>수정</th>
                            <th>반품/교환지 코드</th>
                            <th>주소록명</th>
                            <th>주소</th>
                            <th>전화번호</th>
                            <th>휴대전화</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                            $address_list = $address_data['list'];
                            if(count($address_list) == 0){ ?>
                                <tr>
                                    <td colspan="99">
                                        데이터가 없습니다.
                                    </td>
                                </tr>
                            <? } else {
                                foreach ($address_list as $index => $data){ ?>
                                    <tr>

                                        <td>
                                            <a href="<?=base_url("delivery/addressForm?w=u&idx={$data['idx']}")?>" class="btn btn-sm btn-skyblue">수정</a>
                                        </td>
                                        <td><?=$data['addrNo']?></td>
                                        <td><?=$data['addrName']?></td>
                                        <td><?=$data['addr1']?> <?=$data['addr2']?></td>
                                        <td><?=$data['homeTel']?></td>
                                        <td><?=$data['cellPhone']?></td>
                                    </tr>
                                <?}?>
                            <?}?>
                    </tbody>
                </table>
            </div>

            <?php echo createPagination($page, $address_data['total_count'], $address_data['items_per_page'], getCurrentUrl()); ?>
        </div>


<script>
    let isAjaxIng = false;
</script>

<?php
echo view('common/adm_tail');
echo view('common/footer');
?>