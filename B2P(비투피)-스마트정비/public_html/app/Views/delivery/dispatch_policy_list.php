<?php
echo view('common/header_adm');
echo view('common/adm_head');
$header_name = "발송정책 관리";
?>
<style>
    #adm_content .con_wrap .sch_wrap .box .sch01{
        grid-template-columns: 150px 1fr 150px;
    }
    #adm_content .con_wrap .sch_wrap .box .sch01 > p{
        grid-column: 1/4;
    }
    #adm_content .con_wrap .sch_wrap .box .sch01 > .info_adress{
        grid-column: 2/3;
        display: flex;
        flex-wrap: wrap;
        grid-gap: 7px 20px;
    }
    #adm_content .con_wrap .sch_wrap .box .sch01 > .info_adress > span:first-child{
        width: 100%;
        display: block;
    }
    #adm_content .con_wrap .sch_wrap .box .sch01 .btn-blue{
        font-size: 1em;
    }
    #adm_content .con_wrap .table > table > thead > tr > th,
    #adm_content .con_wrap .table > table > tbody > tr > td{
        text-align: center!important;
    }
</style>


        <?php echo view('delivery/delivery_head', $this->data); ?>

<!--
        <div class="sch_wrap">
            <p class="tit">검색결과</p>
            <div class="box">
                <div class="sch01" style="width: 100%;">
                    <p>검색하기</p>
                    <div class="input_select">
                                                <select class="border_gray">
                            <option value="출고지 주소">출고지 주소</option>
                        </select>
                    </div>

                    <div class="input_select">
                                                <select class="border_gray">
                            <option value="출고지 주소를 선택하세요">출고지 주소를 선택하세요</option>
                        </select>
                    </div>
                    <button class="btn btn-blue">검색</button>
                    
                    <div class="info_adress">
                        <span>
                            경기도 화성시 마도면 마도로620번길 43HK Tech Corporation (우 : 18541 )
                        </span>
                        <span>묶음계산방식 : 가장 큰값</span>
                        <span>도서산간 추가배송비 : 제주도 4000원 & 기타 4000원</span>
                    </div>
                </div>
            </div>
        </div>
-->

        <div class="result_wrap">
            <div class="top_text">
<!--                <div class="wrap">
                    <h1><span class="color-blue">대표 발송정책 목록 10개</span>/ 총 100개</h1>
                </div>


                <div class="wrap">
                    <a href="<?/*=base_url('delivery/dispatchPolicyForm')*/?>" class="btn btn-write">
                        <i class="fa-regular fa-plus color-blue"></i> 등록하기
                    </a>
                </div>-->

            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>지마켓 발송정책코드</th>
                            <th>옥션 발송정책코드</th>
                            <th>발송정책</th>
                            <th>발송정보</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?
                    foreach ($dispatchPolicyData as $row) {
                        echo '<tr>
                                    <td>' . $row["gmarket_reg_no"] . '</td>
                                    <td>' . $row["auction_reg_no"] . '</td>
                                    <td>' . $row["dispatch_policy"] . '</td>
                                    <td>' . $row["dispatch_info"] . '</td>
                              </tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>


<!--<script>
    let api_type = "<?/*=GMAC*/?>";
    let formData = new FormData();
    formData.append("api_type", api_type);

    $.ajax({
        url: "<?/*=base_url('/delivery/getDispatchPolicy')*/?>",
        type: 'POST',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            console.log(data);
        },
        error: function(xhr, status, error) {
            console.error('Error occurred:', status);
        },
        complete: function() {
            isAjaxIng = false;
        }
    });
</script>-->

<?php
echo view('common/adm_tail');
echo view('common/footer');
?>
