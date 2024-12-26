

<!-- 사업자 > 이사견적 열람 > 전화결제내역 -->
<div class="modal fade wide" id="callPaymentModal" tabindex="-1" aria-labelledby="callPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-close"></i></button>
                <h5 class="modal-title" id="callPaymentModalLabel">전화 결제내역</h5>
            </div>
            <div class="modal-body">
                <div class="panel">
                    <div class="panel_box">
                        <div class="select">
                            <?php
                            $dateRange = ['0'=>'전체', '1'=>'오늘', '2'=>'이번주', '3'=>'이번달'];
                            foreach ($dateRange as $key=>$val):
                                $checked = ($_REQUEST['dtRange'] == $key) || (!$_REQUEST['dtRange'] && $key == 0)? "checked" : "";
                                $id = "dtr{$key}";
                                ?>
                                <input type="radio" id="<?=$id?>" name="dtRange" class="red" value="<?=$key?>" <?=$checked?>/><!--
                                        --><label for="<?=$id?>"><?=$val?></label>
                            <?php endforeach;?>
                        </div>
                        <div class="flex">
                            <input type="date" name="sdt" value="<?=$param['sdt']?>">
                            <p>~</p>
                            <input type="date" name="edt" value="<?=$param['edt']?>">
                        </div>
                    </div>
                </div>
                <div class="table">
                    <table>
                        <colgroup>
                            <col width="20px">
                            <col width="auto">
                            <col width="auto">
                            <col width="auto">
                            <col width="auto">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>번호</th>
                            <th>결제일자</th>
                            <th>내역</th>
                            <th>결제금액</th>
                            <th>결제정보</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>24.01.02</td>
                            <td>이사견적 전화연결</td>
                            <td>3,300원</td>
                            <td>국민카드(7019)</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="paging">
                    <div class="pagingWrap">
                        <a class="first disabled"><i class="fa-light fa-chevrons-left"></i></a>
                        <a class="prev disabled"><i class="fa-light fa-chevron-left"></i></a>
                        <a class="active">1</a>
                        <a>2</a>
                        <a>3</a>
                        <a>4</a>
                        <a>5</a>
                        <a>6</a>
                        <a>7</a>
                        <a class="next disabled"><i class="fa-light fa-chevron-right"></i></a>
                        <a class="last disabled"><i class="fa-light fa-chevrons-right"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


