
<?php
echo view('common/header_adm');
echo view('common/adm_head');
$header_name = "제품 일괄 등록";

alert($msg);
?>

    <?php echo view('goods/goods_head', $this->data); ?>

        <div class="result_wrap">
            <div class="top_text">
                <div class="wrap w100">
                    <a href="" class="btn btn-mini btn-write gray">
                        <i class="fa-solid fa-rotate-right" onclick="location.reload()"></i>재조회
                    </a>
                    <h1>현재 업로드 대기 파일이 <span class="color-blue"><?=$file_count?></span>건 있습니다.</h1>
                    <p class="color-blue">* 엑셀등록은 순차적으로 진행됩니다.</p>
                </div>

                <div class="wrap">

                    <a href="<?= base_url('excel/download/' . base64_encode('b2p_category.xls')) ?>" class="btn btn-write gray">
                        <i class="fa-regular fa-list color-gray"></i> 카테고리 다운로드
                    </a>

                    <a href="<?= base_url('delivery/addressList')?>" target="_blank" class="btn btn-write gray2">
                        <i class="fa-regular fa-code color-gray"></i> 배송정책코드 보기
                    </a>
                    
                    <a href="<?= base_url('excel/download/' . base64_encode('b2p_goods.xlsx')) ?>" class="btn btn-write gray">
                        <i class="fa-regular fa-down-to-line color-gray"></i> 엑셀폼 다운로드
                    </a>

                    <button type="button" onclick="uploadExcel()" class="btn btn-write">
                        <i class="fa-regular fa-up-to-line color-gray"></i> 엑셀업로드
                    </button>

                    <form id="uploadExcelForm" action="<?= base_url('excel/upload') ?>" method="post" enctype="multipart/form-data" style="display: none;">
                        <input type="file" id="excelFileInput" name="excelFileInput" accept=".xls,.xlsx">
                        <input type="hidden" name="excelType" id="excelType" value="goodsExcel">
                    </form>
                </div>
            </div>
            <div class="table">
                <div class="upload_box <?php if($file_count == 0) { echo "hide"; }?>">
                    <div class="load">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <p>현재 업로드 중입니다</p>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>상품명</th>
                            <th>상태</th>
                            <th>실패사유</th>
                            <th>상품번호</th>
                            <th>완료일</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?
                    $goods_excel_list = $goods_excel_data['list'];
                    if(count($goods_excel_list) == 0){ ?>
                        <tr class="nodata_tr">
                            <td colspan="99">
                                <p><i class="fa-duotone fa-circle-exclamation"></i>데이터가 없습니다</p>
                            </td>
                        </tr>
                    <? } else {
                        foreach ($goods_excel_list as $index => $data){
                            $process = "대기중";
                            $reason = "";
                            if($data['is_process'] == 'T'){
                                if($data['is_success'] == "T"){
                                    $process = "완료";
                                } else if($data['is_success'] == "F"){
                                    $process = "실패";
                                    $reason = json_decode($data['reason'], true)['message'];
                                }
                            }

                            ?>
                            <tr>
                                <td><?=$data['goods_name']?></td>
                                <td><?=$process?></td>
                                <td><?=$data['reason']?></td>
                                <td><?=$data['goods_no']?></td>
                                <td><?=$data['reg_date']?></td>
                            </tr>
                        <?}?>
                    <?}?>

                    </tbody>
                </table>
            </div>
            <?php echo createPagination($page, $goods_excel_data['total_count'], $goods_excel_data['items_per_page'], getCurrentUrl()); ?>
        </div>

<script>
    function uploadExcel(){
        $('#excelFileInput').click();
    }

    $('#excelFileInput').on('change', function() {
        $("#loading ").show();
        $('#uploadExcelForm').submit();
    });
</script>

<?php
echo view('common/adm_tail');
echo view('common/footer');
?>