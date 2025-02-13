<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<!-- 재작업 요청 모달팝업 -->
<div id="basic_modal">
<!-- Modal -->
<div class="modal fade" id="myRewash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form name="frecarwash" id="frecarwash" onsubmit="return frecarwash_submit(this);" method="post" enctype="multipart/form-data">
    <input type="hidden" id="rw_step" name="rw_step" value="0">
    <input type="hidden" id="cw_idx" name="cw_idx">
    <input type="hidden" id="rw_complete_cnt" name="rw_complete_cnt">
    <input type="hidden" id="mode" name="mode" value="car_re_wash">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
        <h4 class="modal-title" id="myModalLabel">재작업 요청</h4>
      </div>
      <div class="modal-body">
      
            <div id="my_service">
                <div class="bx">
                    <h2 class="big_title">불만족스러운 결과사진을 등록해 주세요.
                        <span class="coms">* 최대 5장까지 등록가능</span>
                        <span class="coms">* 야외에서 운행시 더러워진 경우 불가능</span>
                        <span class="coms">* 서비스 신청 시 등록했던 주차장과 동일한 구역일 경우만 처리가능</span>
                    </h2>

                    <div class="my_place">
                        <div class="form photo_in cf">
            
                            <div id = "prev_area"></div>
                            <!--                   -->
                            <div name="photo_box_0" class="photo"  onclick="file_add()" >
                                <label for="image"><span class="pbtn"><i class="fas fa-camera-alt"></i></span></label>
                            </div>                
                            <div id="file_input"></div>
                            <div class="memo"><textarea cols="30" rows="10" id="rw_reason" name="rw_reason" class="my_req" placeholder="재작업 요청에 대한 사유를 입력해주세요."></textarea></div>
                        </div>
                    </div><!--my_place-->
                </div><!--bx-->
                
                <div class="normal_btn"><input type="submit" class="btn" value="재작업 요청하기"></div>
                <!--<div class="normal_btn"><input type="submit" value="예약신청하기" id="" class="btn"></div>--> 
            </div>
            
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="car_wash_cancel()">확인</button>
      </div>-->
    </div>
  </div>
    </form>
</div>
</div><!--basic_modal-->
<!-- 재작업 요청 모달팝업 -->

<!-- 매니저정보 모달팝업 -->
<div id="basic_modal">
<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
        <h4 class="modal-title" id="myModalLabel">매니저 정보</h4>
      </div>
      <div class="modal-body">
            <div class="manager_info">
                <div class="img"><span><i class="fas fa-user"></i></span></div>
                <div class="name"><span id="ma_modal_name"></span> 매니저 <strong class="call"><i class="fas fa-phone-alt"></i> <span style="color: #000!important;" id="ma_modal_hp">010-4399-5562</span></strong>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">확인</button>
      </div>
    </div>
  </div>
</div>
</div><!--basic_modal-->
<!-- 매니저정보 모달팝업 -->






<!-- 출장세차 예약현황 -->

<div id="my_reser">
	<!--상단카테고리-->
    <ul class="cate02 cf">
        <li><a href="<?php echo G5_BBS_URL ?>/my_reser.php">예약내역</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/my_reser_cancel.php">예약취소</a></li>
        <li class="active"><a href="<?php echo G5_BBS_URL ?>/my_reser_end.php">완료내역</a></li>
    </ul>

<?php if (sql_num_rows($cancel_result) > 0){?>

    <!--내용부분--> 
    <div class="in">
		<div class="cslist">
            <?php for ($i = 0; $row = sql_fetch_array($cancel_result); $i++){
                $manager_member =get_member($row['ma_id']);
                //가장 최근 재작업 1개만
                $sql = "select * from new_re_car_wash where cw_idx = '{$row["cw_idx"]}' order by rw_idx desc limit 1";
                $re_result = sql_fetch($sql);
                ?>

            <div class="bx">
            	<h2 class="tit"><?= $cdt_list[$row['car_date_type']] ?><strong class="size"><?= $cs_list[$row['car_size']] ?></strong>
                    <?php if($re_result['cw_idx'] == $row['cw_idx']){ ?>
                    <strong style='background: #f1f1f1'>재작업 요청건</strong>
                    <?php   }   ?>
                </h2>
                <div class="tx">
                    <dl class="tx_m">
                        <dt>접수일</dt>
                        <dd><?php
                            $date = explode(" ",$row['wr_datetime']);
                            $day = explode('-',$date[0]);
                            echo $day[0] . "년 " . $day[1] . "월 " . $day[2] . "일  ". date('H:i',strtotime($date[1])) ?></dd>
                    </dl>
                    <dl class="tx_m">
                        <dt>차량정보</dt>
                        <dd><?= $row['car_no'] ?> / <?= $row['car_type'] ?> / <?= $row['car_color'] ?></dd>
                    </dl>

                    <dl class="tx_m">
                        <dt>세차일정</dt>
                        <dd>
                            <?php
                            successking_date($row['car_w_date'],$row['car_w_date2']);
                            ?>
                        </dd>

                    </dl>
                    <!-- 23.04.17  가리기 내부세차 따로 빼줌 wc -->
                    <dl class="tx_m" style="display: none">
                        <dt>내부세차</dt>
                        <dd class="ins"><span><?= $row['car_in_yn'] == 'Y' ? "<i class=\"far fa-check-circle\"></i> 포함" : "<i class=\"far fa-times-circle\"></i> 포함안함"; ?></span></dd>
                    </dl>

                    <dl class="tx_m">
                        <dt>작업완료</dt>
                        <dd><a data-toggle="modal" data-target="#myModal_end" class="doneListA"><?=$row["complete_cnt"]?>회</a></dd>
                    </dl>


                    <!-- 2024-07-04 이승환 추가 -->
                    <dl class="tx_m">
                        <dt>사용포인트</dt>
                        <dd><a data-toggle="modal" data-target="#myModal_end" class="doneListA"><?=number_format($row["cp_price"]);?></a></dd>
                    </dl>

                    <dl class="tx_m">
                        <dt>작업완료일</dt>
                        <dd><a data-toggle="modal" data-target="#myModal_end" class="doneListA"><?=$row["complete_datetime"]?></a></dd>
                    </dl>
                    <dl class="tx_m">
                        <?php if ($row['cw_step'] == "0"){ ?>
                        <dt>예상이용금액</dt>
                        <dd><span class="price">-+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                       <?php }else{ ?>
                    <dl class="tx_m">
                        <dt>총 결제금액</dt>
                        <dd class="ins"><span> <? echo number_format($total_price);?> 원</span></dd>
                    </dl>
                        <dt>총 사용금액</dt>
                        <dd><span class="price">
                        <?php } ?>

                        <!-- date_type 2는 정기세차 -->
                        <?
                        if($row['car_date_type'] ==2)
                        {
                            //여기는 정기세차 횟수만큼 계산해서 뿌려줌
                            echo number_format(($row["complete_cnt"]*12375) - $row['cp_price']);
                        }
                        else
                        {
                            //여기에 최종 결제 금액을 뿌려줌
                            echo number_format($row['final_pay']);
                        }
                        ?>

                        </span>원
                            <!-- 쿠폰있으면 아이콘 표시 -->
                            <!--
                            <?php if($row['cp_id'] != ""){ ?>
                                <span class="ico">POINT 사용</span>
                            <?php } ?>
                            -->
                        </dd>
                    </dl>

                    <dl class="tx_m manager"><!--관리자가 담당매니저 정해주면 고객쪽에 뜨게 됨-->
                        <dt>담당매니저</dt>
                        <dd><?=$manager_member['mb_name']?> <span class="info"><a data-toggle="modal" data-target="#myModal2" data-name="<?=$manager_member['mb_name']?>" data-hp="<?=$manager_member['mb_hp']?>" class="info"><i class="fas fa-user-circle"></i> 매니저 정보</a></span></dd>
                    </dl>
                                    </div><!--tx-->
                    <div class="mini_btn cf">
                            <a href="<?php echo G5_BBS_URL ?>/my_reser_view.php?idx=<?=$row['cw_idx']?>" class="bt view a5">자세히보기</a><!--해당 예약의 상세뷰 화면으로 바로 이동-->
                        <!--     재작업요청이 가능 할 때  cw_idx가 있으면 cnt(완료회차가 같지 않아야 함.), 오늘이내     -->
                        <?php if (($re_result['cw_idx'] == "" || ($re_result['cw_idx'] != "" && $re_result['rw_complete_cnt'] != $row["complete_cnt"]))
                                    && date("Y-m-d", strtotime($row["complete_datetime"])) == G5_TIME_YMD ){ ?>
                            <a data-toggle="modal" data-target="#myRewash" class="bt view a5" data-idx = "<?=$row['cw_idx']?>" data-cnt = "<?=$row['complete_cnt']?>"style="background:#495462; border:1px solid #495462"><i class="fas fa-redo"></i> 재작업 요청</a>
                            <?php }else{ ?>
                            <a href="javascript:void(0)" class="bt view a5" data-idx = "<?=$row['cw_idx']?>" style="background:#f1f1f1; border:1px solid #f1f1f1"><i class="fas fa-redo"></i> 재작업 요청</a>
                            <?php }?>
                    </div>
            </div>
            <?php } ?>
        </div><!--//cslist--> 
    </div><!--//in-->


<?php }else{

    echo '<div class="service_none" style="margin-top: 20px"><span><i class="fas fa-smile"></i></span>완료된 서비스가 없습니다.</div>';

}?>
<!-- 출장세차 예약현황 -->
<script>
    $(document).ready(function() {
        //재작업모달
        $('#myRewash').on('show.bs.modal', function(event) {
            idx = $(event.relatedTarget).data('idx');
            cnt = $(event.relatedTarget).data('cnt');
            $('#cw_idx').val(idx);
            $('#rw_complete_cnt').val(cnt);
        });

        //매니저정보
        $('#myModal2').on('show.bs.modal', function(event) {
            ma_name = $(event.relatedTarget).data('name');
            hp = $(event.relatedTarget).data('hp');
            $('#ma_modal_name').text(ma_name);
            $('#ma_modal_hp').text(hp);
        });
    });



    var box_idx = 0; //고유 idx,해당 idx로 photo div를 읽어와 미리보기 사진을 없앰
    //이미지 미리보기
    function getImgPrev(input) {
        var reg_ext = /(.*?)\.(jpg|jpeg|png)$/;
        var leng = $(".btn_del").size();
        var files = input.files;
        var files_arr = Array.prototype.slice.call(files);
        if (leng+input.files.length > 5  ){
            alert('최대 5개까지 등록 가능 합니다.');
            return false
        }

        for (var i = 0; i<input.files.length; i++) {
            // img_idx++;

            var file_name = input.files[i].name.toLowerCase();
            if (!reg_ext.test(file_name)) {
                alert("이미지만 등록이 가능합니다. (jpg, jpeg, png)");
                return false;
            }
            filesTempArr.push(files_arr[i]);
            $('[name="placehold_img"]').css('display', 'none');
            //i가 이상하게 돌아서 a 설정함

            if (input.files && input.files[i]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    box_idx++;

                    var html = "<div class='photo' id ='p_box_"+box_idx+"'>";
                    html1 = "<button type='button' class='btn_del' id ='btn_del_"+(box_idx)+"' onclick=\"btn_image_del(this)\"><i class='fas fa-times'></i></button>";
                    html1 += "<img style='width:60px;height:60px' src='"+ e.target.result +"'></div>";


                    $('#prev_area').append(html+html1);

                }

                reader.readAsDataURL(input.files[i]);
            }

        }
        // console.log(filesTempArr)

    }

    var file_idx = 0;
    function file_add() {
        var leng = $(".btn_del").size();

        upload = $('<input type="file" name="image[]" class="frm_file" id="image' + file_idx + '" multiple onchange="getImgPrev(this)" accept="image/*" >');

        if (leng < 5) {
            $("#file_input").after(upload);
            upload.trigger('click');
            // file_idx++;

        } else {
            alert("최대 5장까지 등록 가능합니다.");
            return false;
        }
    }


    var filesTempArr = [];
    function btn_image_del(f) {

        var btn_del = document.getElementById(f.id),
            div_del = btn_del.parentNode,
            file_idx = btn_del.id.split('_');

        $('#'+div_del.id).html('');
        $('#'+div_del.id).css('display','none');

        //splice하면 index꼬여서 delete처리함.
        delete filesTempArr[(file_idx[2]-1)];
        console.log(filesTempArr);
        // filesTempArr.splice((file_idx[2]-1),1);
    }

    function frecarwash_submit(f) {

        if ($('#rw_reason').val() == "" ){
            error_swal("사유를 입력해주세요.");
            return false;
        }

        if (filesTempArr.length == 0 ){
            error_swal("사진을 등록해주세요.");
            return false;
        }

        re_car_wash_update();
        return false;

    }



    function error_swal(text) {
        swal({
            title: "경고창",
            text: text,
            icon: "error",
            button: "확인",
        });
    }

    function re_car_wash_update() {

        var form = $('#frecarwash')[0];
        var formData = new FormData(form);

        //파일 배열로 담기
        for (var i = 0; i < filesTempArr.length; i++) {
            formData.append("bf_file[]", filesTempArr[i]);
        }


        $.ajax({
            url:g5_bbs_url+"/ajax.controller.php",
            processData: false,
            contentType: false,
            type:"POST",
            async: false,
            data: formData,
            success:function(data){
                if (data != "") {
                    window.location.href = g5_bbs_url + "/my_reser_end.php";
                }
            }
        });

    }


</script>