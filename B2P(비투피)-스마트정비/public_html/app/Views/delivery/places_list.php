<?php
echo view('common/header_adm');
echo view('common/adm_head');
$header_name = "출고지 관리";
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
                            <option value="placeName" <?php echo get_selected($sf, "placeName"); ?>>출고지명</option>
                        </select>
                    </div>

                    <div class="input_search">
                        <input type="text" placeholder="검색어를 입력하세요" class="border_gray" id="st" name="st" value="<?=$st?>">
                        <button><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    <a href="<?=base_url('delivery/placesList')?>" class="btn btn-blue">초기화</a>
                </div>
            </form>
        </div>

        <div class="result_wrap">
            <div class="top_text">
                <div class="wrap">
                    <h1>총 <?=number_format($delivery_data['total_count'])?>개</h1>
                </div>

                <div class="wrap">
                    <a href="<?=base_url('delivery/placesForm')?>" class="btn btn-write">
                        <i class="fa-regular fa-plus color-blue"></i> 등록하기
                    </a>
                </div>
            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th width='130px'>수정</th>
                            <th>출고(하)지 코드</th>
                            <th>출고지명</th>
                            <th>주소</th>
                            <th>전화번호</th>
                            <th>휴대전화</th>
                            <th>묶음계산방식</th>
                            <th>도서산간 추가배송비</th>
                            <th>제주도 및 부속도서 추가배송비</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        $delivery_list = $delivery_data['list'];
                        if(count($delivery_list) == 0){ ?>
                            <tr>
                                <td colspan="99">
                                    데이터가 없습니다.
                                </td>
                            </tr>
                        <? } else {
                            foreach ($delivery_list as $index => $data){
                                $sql = "select * from `address_book_list` where `addrNo` = {$data['addrNo']}";
                                $book_row = sql_fetch($sql);

                                $imposeType = "";
                                if($data['imposeType'] == 1){
                                     $imposeType = "최소 부과";
                                } else if($data['imposeType'] == 2){
                                    $imposeType = "최대 부과";
                                }

                                ?>
                                <tr>
                                    <td>
                                        <a href="<?=base_url("delivery/placesForm?w=u&idx={$data['idx']}")?>" class="btn btn-sm btn-skyblue">수정</a>
                                    </td>
                                    <td><?=$data['placeNo']?></td>
                                    <td><?=$data['placeName']?></td>
                                    <td><?=$book_row['addr1']?> <?=$book_row['addr2']?></td>
                                    <td><?=$book_row['homeTel']?></td>
                                    <td><?=$book_row['cellPhone']?></td>
                                    <td><?=$imposeType?></td>
                                    <td><?=number_format($data['backwoodsAdditionalShippingFee'])?>원</td>
                                    <td><?=number_format($data['jejuAdditionalShippingFee'])?>원</td>
                                </tr>
                            <?}?>
                        <?}?>
                    </tbody>
                </table>
            </div>

            <?php echo createPagination($page, $delivery_data['total_count'], $delivery_data['items_per_page'], getCurrentUrl()); ?>
        </div>
<?php
echo view('common/adm_tail');
echo view('common/footer');
?>