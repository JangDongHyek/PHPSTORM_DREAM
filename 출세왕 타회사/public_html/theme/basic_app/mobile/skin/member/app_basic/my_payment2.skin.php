<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

    <!-- 출장세차 예약현황 -->
<?php
$sql = "select * from new_payment where userId = '{$_SESSION['ss_mb_id']}'";
$dan_pay_query = sql_query($sql);
?>

    <div id="my_reser">
        <!--상단카테고리-->
        <ul class="cate02 cf">
            <li><a href="<?php echo G5_BBS_URL ?>/my_payment.php">정기결제</a></li>
            <li class="active"><a href="<?php echo G5_BBS_URL ?>/my_payment2.php">단기결제</a></li>
        </ul>

        <?php if (sql_num_rows($dan_pay_query) > 0){?>
        <!--내용부분-->
        <div class="in">
            <div class="cslist">
                <?php for ($i = 0; $row = sql_fetch_array($dan_pay_query); $i++){?>

                    <div class="bx">
                        <div class="tx">
                            <dl class="tx_m">
                                <dt>결제일</dt>
                                <dd><?php
                                    $date = explode(" ",$row['wr_datetime']);
                                    $day = explode('-',$date[0]);
                                    echo $day[0] . "년 " . $day[1] . "월 " . $day[2] . "일  ". date('H:i',strtotime($date[1])) ?></dd>
                            </dl>
                            <dl class="tx_m">
                                <dt>카드정보</dt>
                                <dd><?= $row['goodsName'] ?> / <?= $row['fn_name'] ?> </dd>
                            </dl>
                            <dl class="tx_m">
                                <dt>금액</dt>
                                <dd>
                                    <?=number_format($row['Amt']);?> 원
                                </dd>

                            </dl>

                        </div><!--tx-->

                    </div><!--bx-->
                <?php } ?>

            </div>
        </div><!--in-->
    </div><!--my_reser-->
    <?php }else{

        echo '<div class="service_none" style="margin-top: 20px"><span><i class="fas fa-smile"></i></span>예약된 서비스가 없습니다.!</div>';

    }?>
    <!-- 출장세차 예약현황 -->
    <script>
        $(document).ready(function() {
            //취소모달
            $('#myModal').on('show.bs.modal', function(event) {
                idx = $(event.relatedTarget).data('idx');
                $('#modal_idx').val(idx);
            });
            //매니저정보
            $('#myModal2').on('show.bs.modal', function(event) {
                ma_name = $(event.relatedTarget).data('name');
                hp = $(event.relatedTarget).data('hp');
                $('#ma_modal_name').text(ma_name);
                $('#ma_modal_hp').text(hp);
                $('#ma_modal_a_hp').attr('href', 'tel:'+hp);
            });
        });


        function car_wash_cancel() {
            var idx = $('#modal_idx').val();

            $.ajax({
                url : g5_bbs_url + "/ajax.controller.php",
                data: {'idx': idx, 'mode':'car_wash_cancel'},
                type: 'POST',
                // datatype : 'json',
                success : function(data) {
                    if(data == 1){
                        window.location.href = g5_bbs_url+'/my_reser_cancel.php';
                    }else{
                        alert("통신에 실패했습니다.");
                    }

                },
                err : function(err) {
                    alert(err.status);
                }
            });

        }
    </script>