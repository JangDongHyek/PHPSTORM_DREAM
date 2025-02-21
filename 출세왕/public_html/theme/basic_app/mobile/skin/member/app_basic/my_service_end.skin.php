<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>


<!-- 건의하기 모달팝업 -->
<div id="basic_modal">
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
        <h4 class="modal-title" id="myModalLabel">건의하기</h4>
      </div>

        <form name="frecom" id="frecom" action="<?= G5_BBS_URL ?>/ajax.controller.php" onsubmit="return new_frecom_submit(this)" method="post" enctype="multipart/form-data">
            <input type="hidden" id="mode" name="mode" value="review_update" class="frm_input">
            <input type="hidden" id="cw_idx" name="cw_idx" value="">
            <input type="hidden" id="ma_id" name="ma_id">
            <input type="hidden" id="mb_id" name="mb_id" value="<?=$member['mb_id']?>">
      <div class="modal-body">
        <div class="myreport photo_in cf">
            <div id="prev_area">
<!--                <div class="photo" id="p_box_1"><button type="button" class="btn_del" id="btn_del_1" onclick="btn_image_del(this)"><i class="fas fa-times"></i></button></div>-->
            </div>

            <div name="photo_box_0" class="photo" onclick="file_add()">
                <label for="image"><span class="pbtn"><i class="fas fa-camera-alt"></i></span></label>
            </div>
            <div id="file_input"></div>
            <div class="memo"><textarea cols="30" rows="4" id="re_content" name="re_content" class="my_req" placeholder="건의하실 내용을 입력해 주세요."></textarea></div>
        </div><!--myreport photo_in-->
      </div>
      <div class="modal-footer">

        <button type="submit" class="btn btn-default">건의하기</button>

        </form>
      </div>
    </div>
  </div>
</div>
</div><!--basic_modal-->
<!-- 건의하기 모달팝업 -->
<script>
    let flag = false;
    function new_frecom_submit(f) {
        if(flag) {
            return false;
        }else {
            flag = true;
        }

        if(!f.re_content.value) {
            alert("내용을 입력해주세요");
            flag = false;
            return false;
        }

        return true;
    }
</script>

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
                <div class="name"><span id="ma_modal_name"></span> 매니저 <strong class="call"><i class="fas fa-phone-alt"></i><span id = "ma_modal_hp"></span></strong>
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






<!-- 완료된서비스 -->

<div id="my_reser">
	<!--상단카테고리-->
    <ul class="cate cf">
        <li class="active"><a href="<?php echo G5_BBS_URL ?>/my_service_end.php">완료된 서비스</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/my_report.php">내 건의함</a></li>
    </ul>
    
    <!--내용부분--> 
    <div class="in">
		<div class="cslist">

            <?php
            if (sql_num_rows($end_result) > 0 ){
            for ($i = 0; $row = sql_fetch_array($end_result); $i ++){
                //가장 최근 재작업 1개만
                $sql = "select * from new_re_car_wash where cw_idx = '{$row["cw_idx"]}' order by rw_idx desc limit 1";
                $re_result = sql_fetch($sql);

            ?>
            
			<div class="bx">
            	<h2 class="tit"><?= $cdt_list[$row['car_date_type']]?><strong class="size"><?= $cs_list[$row['car_size']]?></strong>
                    <?php if($re_result['cw_idx'] == $row['cw_idx']){ ?>
                        <strong style='background: #f1f1f1'>재작업 요청건</strong>
                    <?php   }   ?>
                </h2>
                <div class="tx">
                    <dl class="tx_m">
                        <dt>작업완료일</dt>
                        <dd><?php
                            $date = explode(" ",$row['up_datetime']);
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
                    <!--
                    <dl class="tx_m">
                        <dt>내부세차</dt>
                        <dd class="ins"><span> <?= $row['car_in_yn'] == 'Y' ? "<i class=\"far fa-check-circle\"></i> 포함" : "<i class=\"far fa-times-circle\"></i> 포함안함"; ?></span></dd>
                    </dl>
                    -->
                    <dl class="tx_m">
                        <dt>이용금액</dt>
                        <dd><span class="price"> <?php echo number_format($row['final_pay']); ?></span>원</dd>
                    </dl>
                    <?php if ($row['ma_id'] != ""){
                    $manager = get_member($row['ma_id']); ?>
                    <dl class="tx_m manager"><!--관리자가 담당매니저 정해주면 고객쪽에 뜨게 됨-->
                        <dt>담당매니저</dt>
                        <dd><?= $manager['mb_name'] ?> <span class="info"><a data-toggle="modal" data-target="#myModal2" data-name = "<?= $manager['mb_name'] ?>" data-hp = "<?= hyphen_hp_number($manager['mb_hp']) ?>" class="info"><i class="fas fa-user-circle"></i> 매니저 정보</a></span></dd>
                    </dl>
                    <?php } ?>
                </div><!--tx-->
                <div class="mini_btn cf">
                    <a href="<?php echo G5_BBS_URL ?>/my_service_view.php?idx=<?=$row['cw_idx']?>" class="bt view">자세히보기</a><!--해당 예약의 상세뷰 화면으로 바로 이동-->
                	<?php if($row['review_datetime'] <= 0){ ?>
                    <a data-toggle="modal" data-target="#myModal" data-maid="<?=$row['ma_id']?>" data-cwidx="<?=$row['cw_idx']?>" onclick="$('#cw_idx').val(this.dataset.cwidx)" class="bt report">건의하기</a>
                    <? } ?>
                </div>
            </div><!--bx-->

            <?php }
            }else{
                echo '<div class="service_none"><span><i class="fas fa-smile"></i></span>완료된 서비스가 없습니다.</div>';

            } ?>

        </div><!--cslist-->
    </div><!--in-->
</div><!--my_reser-->

<!-- 완료된서비스 -->
    <script>
        $(document).ready(function() {
            //매니저정보
            $('#myModal2').on('show.bs.modal', function(event) {
                ma_name = $(event.relatedTarget).data('name');
                hp = $(event.relatedTarget).data('hp');
                $('#ma_modal_name').text(ma_name);
                $('#ma_modal_hp').text(hp);
            });
            //건의하기
            $('#myModal').on('show.bs.modal', function(event) {
                ma_id = $(event.relatedTarget).data('maid');
                $('#ma_id').val(ma_id);
            });
        });

        function review_update() {
            var content = $("#re_content").val(),
                ma_id = $('#ma_id').val();

            var cw_idx = $('#cw_idx').val();

            $.ajax({
                url:g5_bbs_url+"/ajax.controller.php",
                type:"POST",
                data: {mb_id:'<?=$member['mb_id']?>', re_content:content, ma_id:ma_id,mode:'review_update',cw_idx:cw_idx},
                success:function(data){
                    //window.location.href = g5_bbs_url + data;
                }
            });

        }

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
                        //확인 div는 이미지 크기 달라서 지정
                        html2 = "<img style='width:80px;height:80px' src='"+ e.target.result +"'></div>";

                        $('#prev_area').append(html+html1);
                        $('#prev_area_ok').append(html+html2);


                    }

                    reader.readAsDataURL(input.files[i]);
                }

            }
            // console.log(filesTempArr)

        }

        var file_idx = 0;
        function file_add() {
            var leng = $(".btn_del").size();
            file_idx++;
            upload = $('<input type="file" name="bf_file[]" class="frm_file" id="image' + file_idx + '" multiple onchange="getImgPrev(this)" accept="image/*" > multiple="multiple"');

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

            //서비스확인 div에도 이미지 넣어줌
            $("#prev_area_ok").find("#"+div_del.id).css('display','none');
            $("#prev_area_ok").find("#"+div_del.id).html('');
            //splice하면 index꼬여서 delete처리함.
            delete filesTempArr[(file_idx[2]-1)];
            console.log(filesTempArr);
            // filesTempArr.splice((file_idx[2]-1),1);
        }

    </script>