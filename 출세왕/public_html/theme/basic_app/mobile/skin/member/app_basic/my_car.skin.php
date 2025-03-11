<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<!-- 차량삭제 모달팝업 -->
<div id="basic_modal">
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <input type="hidden" id="modal_idx">
    <input type="hidden" id="modal_car_no">
    <input type="hidden" id="modal_car_img">


  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
        <h4 class="modal-title" id="myModalLabel">차량삭제</h4>
      </div>
      <div class="modal-body">
          해당차량을 정말 삭제하시겠습니까?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default"  onclick="car_del();">확인</button>
      </div>
    </div>
  </div>
</div>
</div><!--basic_modal-->
<!-- 차량삭제 모달팝업 -->




<!-- 내 차량관리 -->

<div id="my_car" class="adm">
    
    <!--내용부분--> 
    <div class="in">
		<div class="list">
            <h2 class="title">내 차량 목록</h2>
            <ul>
                <?php for ($i = 0; $row = sql_fetch_array($car_result); $i++){
                    if($row['car_img']){
                        $file_url = G5_DATA_URL."/file/car_photo/".$row['car_img'];
                    }else{
                        $file_url = G5_DATA_URL."/file/car_photo/".str_replace(" ", "",$row['car_no']).".jpg";
                    }

                    ?>
                <li>
                    <span class="ico"><i class="fas fa-car"></i></span><?= $row['car_no']?> / <?= $row['car_type']?> / <?= $row['car_color']?>
                    <a data-toggle="modal" data-target="#myModal" data-idx = "<?= $row['gc_idx'] ?>" data-car_no = "<?= $row['car_no'] ?>" data-car_img = "<?= $row['car_img'] ?>" class="del">삭제</a>
                    <div style="padding:20px 0 0"><img style="width: 100%; height: auto; border-radius:7px" src="<?=$file_url?>"></div>
                </li><!--삭제누르면 리스트에서 없어짐-->
                <?php } ?>
            </ul>
        </div><!--list-->
        <form name="frecom" id="frecom" action="<?= G5_BBS_URL ?>/ajax.controller.php" onsubmit="return frecom_submit(this)" method="post" enctype="multipart/form-data">
        <input type="hidden" id="mode" name="mode" value="go_car_update" class="frm_input">
        <div class="add">
            <h3 class="stitle">신규차량 추가 <i class="fas fa-cars"></i></h3><!--아래 차량정보 모두 입력하고 추가하기 누르면 상단 내 차량 목록에 추가됨-->
            <div class="form"><input type="text" name="car_no" value="" maxlength="8" onkeyup="empty_replace(this.value)" id="car_no" placeholder="차량번호 입력 (예:12가1234)" class="frm"></div>
            <div class="form"><input type="text" name="car_type" value="" id="car_type" placeholder="차량종류 입력 (예:아반떼XD)" class="frm"></div>
            <div class="form"><input type="text" name="car_color" value="" id="car_color" placeholder="차량색상 입력 (예:흰색)" class="frm"></div>
            <div class="form">
                <label for="bf_file" class="btn" id="bf_file_txt">파일 선택</label>
                <input type="file" name="bf_file" value="" id="bf_file" placeholder="자동차 사진(정면사진 첨부)" class="frm" accept="image/*" onchange="$('#bf_file_txt').html('파일 선택 : '+this.value.split('\\').reverse()[0])" style="visibility:hidden;">
            </div>

            <input type="submit" class="btn_add" value="+ 추가하기">
        </div>
        </form>
    </div><!--in-->
    
</div><!--my_car-->

<!-- 내 차량관리 -->
<script>

    $(document).ready(function() {
        $('#myModal').on('show.bs.modal', function(event) {
            idx = $(event.relatedTarget).data('idx');
            car_no = $(event.relatedTarget).data('car_no');
            car_img = $(event.relatedTarget).data('car_img');
            $('#modal_idx').val(idx);
            $('#modal_car_no').val(car_no);
            $('#modal_car_img').val(car_img);
        });
    });

    //삭제
    function car_del() {

        var idx =  $('#modal_idx').val();
        var car_no =  $('#modal_car_no').val();
        var car_img =  $('#modal_car_img').val();

        $.ajax({
            url: g5_bbs_url+"/ajax.controller.php",
            type: "POST",
            data: {
                "mode": "go_car_del",
                "del_mb_icon": 1,
                "car_no": car_no,
                "car_img": car_img,
                "idx": idx
            },
            dataType : "json",
            success: function(res) {
                if(!res.success) {
                    swal({
                        title: "경고창",
                        text: res.message,
                        icon: "error",
                        button: "확인",
                    }).then(() => {
                        location.reload(); // 페이지 새로고침
                    });
                    return false;
                }

                window.location.reload();

            }
        });
    }

    function frecom_submit(f) {


        if (f.car_no.value == ""){
            swal_func('차량번호를 입력해주세요.');
            return false;
        }else{
            is_dup = is_car_no_dup(f.car_no.value);

        }



        if (is_dup){
            swal_func('중복된 차량번호가 존재합니다. 차량번호를 다시 확인해주세요.');
            return false;

        }

        var reg2 =/^[0-9]{2,3}[가-힣\s]{1}[0-9]{4}$/
        if (!reg2.test($('#car_no').val())){
            swal_func('차량번호는 ex)12가3456 형식으로 입력해주세요.');
            return false;
        }
        var reg = /^[가-힣\s]+$/
        if (!reg.test($('#car_color').val())){
            swal_func('차량 색상을 한글로 입력해주세요.');
            return false;
        }

        if (f.bf_file.value == ""){
            swal_func('차량사진을 등록해주세요.');
            return false;
        }




    }

    function swal_func(text) {

        swal({
            title: "경고창",
            text: text,
            icon: "error",
            button: "확인",
        });

    }

    function empty_replace(val) {
        $('#car_no').val(val.replace(/ /g,""));
    }
</script>
