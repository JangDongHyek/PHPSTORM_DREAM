<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>


<!--프로필(취미/관심사)-->
<div id="my_profile" class="my_hobb">
    <!--상단카테고리-->
    <ul class="cate cf">
        <li><a href="javascript:void(0);" onclick="save('my_profile01.php');">기본정보</a></li>
        <li><a href="javascript:void(0);" onclick="save('my_profile02.php');">인터뷰</a></li>
        <li class="active"><a href="javascript:void(0);">추가항목</a></li>
    </ul>

    <!--작성 폼 시작-->
    <div class="in">
        <div class="regi_info">
            <p>
                입력하시는 모든 내용은 회원에게 전체공개되는 내용입니다.<br>
                신중하고 정확한 입력부탁드립니다.
            </p>
        </div>
        <form id="fprofile3" name="fprofile3" action="./my_profile03_update.php" method="post" >
            <input type="hidden" name="mb_id" value="<?=$mb_id?>">
            <input type="hidden" id="page" name="page" value="">
            <input type="hidden" id="save_op" name="save_op" value="">
            <input type="hidden" name="hobby_code" value="">

            <div class="form-group">
                <h3 class="title"><span class="ess_icon hide">*</span>좋아하는 취미를 선택해 주세요<strong class="comm">(최대 5개까지 선택 가능)</strong></h3>
                <div class="selc cf">
                <?php
                $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
                $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                if(!empty($mb['mb_no'])) {
                    $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
                }
                $sql .= " where co.co_code_name = '취미' order by co.co_code*1 ";
                $result = sql_query($sql);
                for($i=0;$row=sql_fetch_array($result);$i++) {
                    $checked = "";
                    $class_on = "";
                    if($mb['mb_no'] == $row['mb_no'] && !empty($row['hobby_code'])) {
                        $checked = "checked";
                        $class_on = "on";
                    }
                ?>
                    <span><input type="checkbox" id="hobby_<?=$row['co_code']?>" class="code hobby <?=$class_on?>" <?=$checked?>><label for="hobby_<?=$row['co_code']?>"><?=$row['co_main_code_value']?></label></span>
                <?php
                }
                ?>
                </div><!--selc-->
            </div><!--form-group-->
            <div class="form-group">
                <h3 class="title"><span class="ess_icon hide">*</span>좋아하는 운동을 선택해 주세요<strong class="comm">(최대 5개까지 선택 가능)</strong></h3>
                <div class="selc cf">
                <?php
                $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
                $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                if(!empty($mb['mb_no'])) {
                    $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
                }
                $sql .= " where co.co_code_name = '운동' order by co.co_code*1 ";
                $result = sql_query($sql);
                for($i=0;$row=sql_fetch_array($result);$i++) {
                    $checked = "";
                    $class_on = "";
                    if($mb['mb_no'] == $row['mb_no'] && !empty($row['hobby_code'])) {
                        $checked = "checked";
                        $class_on = "on";
                    }
                ?>
                    <span><input type="checkbox" id="exercise_<?=$row['co_code']?>" class="code exercise <?=$class_on?>" <?=$checked?>><label for="exercise_<?=$row['co_code']?>"><?=$row['co_main_code_value']?></label></span>
                <?php
                }
                ?>
                </div><!--selc-->
            </div><!--form-group-->
            <div class="form-group">
                <h3 class="title"><span class="ess_icon hide">*</span>좋아하는 관심사를 선택해 주세요<strong class="comm">(각 분야별 최대 3개까지 선택 가능)</strong></h3>
                <div class="st">
                    <div class="tit">영화부문</div>
                    <div class="selc cf">
                    <?php
                    $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
                    $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                    if(!empty($mb['mb_no'])) {
                        $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
                    }
                    $sql .= " where co.co_code_name = '영화' ";
                    $sql .= " order by co.co_code*1 ";
                    $result = sql_query($sql);
                    for($i=0;$row=sql_fetch_array($result);$i++) {
                        $checked = "";
                        $class_on = "";
                        if($mb['mb_no'] == $row['mb_no'] && !empty($row['hobby_code'])) {
                            $checked = "checked";
                            $class_on = "on";
                        }
                    ?>
                        <span><input type="checkbox" id="movie_<?=$row['co_code']?>" class="code movie <?=$class_on?>" <?=$checked?>><label for="movie_<?=$row['co_code']?>"><?=$row['co_main_code_value']?></label></span>
                    <?php
                    }
                    ?>
                    </div><!--selc-->
                </div>
                <div class="st">
                    <div class="tit">음악부문</div>
                    <div class="selc cf">
                    <?php
                    $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
                    $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                    if(!empty($mb['mb_no'])) {
                        $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
                    }
                    $sql .= " where co.co_code_name = '음악' order by co.co_code*1 ";
                    $result = sql_query($sql);
                    for($i=0;$row=sql_fetch_array($result);$i++) {
                        $checked = "";
                        $class_on = "";
                        if($mb['mb_no'] == $row['mb_no'] && !empty($row['hobby_code'])) {
                            $checked = "checked";
                            $class_on = "on";
                        }
                    ?>
                        <span><input type="checkbox" id="music_<?=$row['co_code']?>" class="code music <?=$class_on?>" <?=$checked?>><label for="music_<?=$row['co_code']?>"><?=$row['co_main_code_value']?></label></span>
                    <?php
                    }
                    ?>
                    </div><!--selc-->
                </div>
                <div class="st">
                    <div class="tit">TV부문</div>
                    <div class="selc cf">
                    <?php
                    $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
                    $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                    if(!empty($mb['mb_no'])) {
                        $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
                    }
                    $sql .= " where co.co_code_name = 'TV' order by co.co_code*1 ";
                    $result = sql_query($sql);
                    for($i=0;$row=sql_fetch_array($result);$i++) {
                        $checked = "";
                        $class_on = "";
                        if($mb['mb_no'] == $row['mb_no'] && !empty($row['hobby_code'])) {
                            $checked = "checked";
                            $class_on = "on";
                        }
                    ?>
                        <span><input type="checkbox" id="tv_<?=$row['co_code']?>" class="code tv <?=$class_on?>" <?=$checked?>><label for="tv_<?=$row['co_code']?>"><?=$row['co_main_code_value']?></label></span>
                    <?php
                    }
                    ?>
                    </div><!--selc-->
                </div>
            </div><!--form-group-->

        </form>
    </div><!--in-->

    <!--저장 부분-->
    <div class="f_arr cf">
        <div class="arr">
            <span><a href="#" onclick="save('my_profile02.php');"><i class="fal fa-angle-left"></i> 이전</a></span>
        </div>
        <div class="save"><a href="#" onclick="save('my_profile_end.php', 'save');">저 장</a></div>
    </div><!--f_arr-->

</div><!--my_profile-->
<!--프로필(취미/관심사)-->

<script>
    $(function() {
        $(function () {
            // history.replaceState(null, null, g5_bbs_url+'/mypage.php'); // 뒤로가기 이벤트 때문에 history 추가
        });

        // 취미/관심사 선택처리
        $(".code").click(function () {
            if($('#'+this.id).hasClass("on")) {
                $("#"+this.id).removeClass("on");
            }
            else {
                $("#"+this.id).addClass("on");
            }

            if($(".code.hobby.on").length > 5 || $(".code.exercise.on").length > 5) {
                swal('최대 5개까지 선택 가능합니다.');
                $("#"+this.id).removeClass("on");
                return false;
            }

            if($(".code.movie.on").length > 3 || $(".code.music.on").length > 3 || $(".code.tv.on").length > 3) {
                swal('최대 3개까지 선택 가능합니다.');
                $("#"+this.id).removeClass("on");
                return false;
            }
        });
    });

    // 저장
    function save(page, save_op) {
        $('#page').val(page);
        $('#save_op').val(save_op);

        // if($(".code.hobby.on").length == 0) {
        //     swal('좋아하는 취미를 선택하세요.');
        //     return false;
        // }
        // if($(".code.exercise.on").length == 0) {
        //     swal('좋아하는 운동을 선택하세요.');
        //     return false;
        // }
        // if($(".code.movie.on").length == 0) {
        //     swal('좋아하는 영화를 선택하세요.');
        //     return false;
        // }
        // if($(".code.music.on").length == 0) {
        //     swal('좋아하는 음악을 선택하세요.');
        //     return false;
        // }
        // if($(".code.tv.on").length == 0) {
        //     swal('좋아하는 TV를 선택하세요.');
        //     return false;
        // }

        var hobby_code = "";
        $('.code').each(function(){
            if($("#"+this.id).hasClass("on")) {
                hobby_code += this.id + ',';
            }
        });
        $('input[name=hobby_code]').val(hobby_code.slice(0,-1));

        var form = $('form')[0];
        var formData = new FormData(form);
        $.ajax({
            url : g5_bbs_url + "/my_profile03_update.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            async: false,
            success : function(data) {
                if(data == 'mypage'){
                    location.replace(g5_bbs_url + "/mypage.php");
                } else {
                    location.replace(g5_bbs_url + "/" + page + "?mb_id=<?=$mb_id?>");
                }
            },
        });

        // $('#fprofile3').submit();
    }
</script>