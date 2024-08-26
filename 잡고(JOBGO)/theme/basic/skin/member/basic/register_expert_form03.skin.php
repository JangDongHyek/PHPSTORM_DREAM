<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//include_once($member_skin_path.'/mb.head.php');\
?>
<style>
body{background: #f5f5f5;}
.box-article .box-body dd input {
	background: #f3f6fc !important;
}
.box-article .box-body dd input {
	background: #fff !important;
	border: 1px solid #e6e6e6;
	border-radius: 0 !important;
}
.box-article .box-body dd textarea {
	background: #fff !important;
	border: 1px solid #e6e6e6;
	border-radius: 0 !important;
	width:100%;
	padding:20px;
}
#profile section{ padding:10px 0}
.mem_info{ border:0}
.mem_info p.name{ margin:30px 0 15px}
input[type="file"]{display: none}

.box-article .box-body dd input.addfile{
	    background: #9998a7 !important;
    width: 100%;
    padding: 15px !important;
    margin: 0 0 10px;
    color: #fff;
    text-align: center;
    font-size: 1.10em;
    font-weight: 400;
}
.addfile.textVer{
    color: #9998a7;
    background: #FFF;
    padding: 10px 0 0 !important;
    text-align: left;
}
</style>



<!-- 프로필 관리 -->
<article id="profile" class="new_win mbskin_profile">
    <form id="profilefrm" >
        <input type = "hidden" id="mb_id" name="mb_id" value="<?=$member['mb_id']?>">
        <input type = "hidden" id="pf_idx" name="pf_idx" value="<?=$view['pf_idx']?>">
        <input type = "hidden" id="re" name="re" value="<?=$_REQUEST['re']?>">
        <!--가입절차단계-->
        <div class="process">
             <ul>
                 <li>1</li>
                 <li>2</li>
                 <li class="current">3</li>
             </ul>
        </div>

        <section class="mem_info">

              <!--<div class="profile">
                    <ul>
                       <li>
                           <dl>
                              <dt>총 작업수</dt>
                              <dd>565<span>건</span></dd>
                           </dl>
                       </li>
                       <li>
                           <dl>
                              <dt>의뢰인 만족도</dt>
                              <dd>98%</dd>
                           </dl>
                       </li>
                       <li>
                           <dl>
                              <dt>평균응답시간</dt>
                              <dd>1시간<span>이내</span></dd>
                           </dl>
                       </li>
                    </ul>
              </div>-->

              <div class="box-article">
                  <div id="join_exinfo">
                      <div class="box-body">
                            <!--사업자-->
                          <?php /*
                          <dl class="row">
                              <dd class="col-xs-1 req">*</dd>
                              <dd class="col-xs-12 cate_wrap">
                                  <label for="reg_mb_worktime">사업자 입니까?</label>
                                  <ul>
                                      <li>
                                        <span class="rdo_ico"><input type="radio" onclick="buisnessman_chk('Y')" name = "mb_buisnessman" value="Y" id="reg_mb_worktime_y"><label for="reg_mb_worktime_y" class="normal">예</label></span>
                                          <span class="rdo_ico"><input type="radio" onclick="buisnessman_chk('N')" name = "mb_buisnessman" value="N" <?php if($member["mb_buisnessman"]== "") echo 'checked'; ?> id="reg_mb_worktime_n"><label for="reg_mb_worktime_n" class="normal">아니오</label></span>
                                      </li>
                                      <li id="buis_li" style="display: none">
										  <div class="addfile textVer">사업자 등록증을 첨부해주세요</div>
                                        <?php
                                        $mb_dir = substr($member['mb_id'], 0, 2);
                                        $buis_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$member['mb_id'].'_buis.jpg';

                                        if(file_exists($buis_file)){ ?>
                                          <img style="height: 150px" src = '<?=G5_DATA_URL.'/member/'.$mb_dir.'/'.$member['mb_id'].'_buis.jpg'?>'>
                                          <?php } ?>
                                          <input type="file" id="mb_buisnessman_file" name = "mb_buisnessman_file" style="display: block!important;" class="addfile">
                                      </li>
                                  </ul>
                              </dd>
                              <dd class="error col-xs-12"></dd>
                          </dl>
                     */ ?>

                            <!--응답시간-->
                            <dl class="row">
                                <dd class="col-xs-1 req">*</dd>
                                <dd class="col-xs-12 cate_wrap">
                                    <label for="reg_mb_worktime">응답시간</label>
                                    <ul>
                                       <li>
                                       <select name="pf_time" class="select" id="mb_1" title="응답시간">
                                           <?php for ($i=1;$i <= count($pf_time_list);$i++){ ?>
                                              <option value="<?=$i?>"><?=$pf_time_list[$i]?></option>
                                           <?php } ?>
                                       </select>
                                       </li>
                                    </ul>
                                </dd>
                                <dd class="error col-xs-12"></dd>
                            </dl>

                            <!--연락가능시간-->
                            <dl class="row">
                                <dd class="col-xs-1 req">*</dd>
                                <dd class="col-xs-12 worktime_wrap">
                                    <label for="reg_mb_worktime">연락가능시간</label>
                                    <ul>
                                       <li>
                                           <dl>
                                                 <dd>
                                                 <select name="call_hour_1" class="select" id="call_hour_1" title="시간">
                                                      <option value="">시간</option>
                                                        <?php for ($i = 1; $i <= 24; $i++){
                                                            if ($i < 10){
                                                                $number = "0"."".$i;
                                                            }else{
                                                                $number = $i;
                                                            }
                                                            echo '<option value="'.$number.'">'.$number.'</option>';
                                                        }?>
                                                 </select> 
                                                 </dd>
                                                 <dd> 
                                                 <select name="call_min_1" class="select" id="call_min_1" title="분">
                                                      <option value="">분</option>
                                                     <?php for ($i = 0; $i <= 5; $i++){
                                                         echo '<option value="'.$i.'0">'.$i.'0</option>';
                                                     }?>
                                                 </select> 
                                                 </dd>
                                            </dl> 
                                       </li>
                                       <li>
                                           <dl>
                                               <dd>
                                                   <select name="call_hour_2" class="select" id="call_hour_2" title="시간">
                                                       <option value="">시간</option>
                                                       <?php for ($i = 1; $i <= 24; $i++){
                                                           if ($i < 10){
                                                               $number = "0"."".$i;
                                                           }else{
                                                               $number = $i;
                                                           }
                                                           echo '<option value="'.$number.'">'.$number.'</option>';
                                                       }?>
                                                   </select>
                                               </dd>
                                               <dd>
                                                   <select name="call_min_2" class="select" id="call_min_2" title="분">
                                                       <option value="">분</option>
                                                       <?php for ($i = 0; $i <= 5; $i++){
                                                           echo '<option value="'.$i.'0">'.$i.'0</option>';
                                                       }?>
                                                   </select>
                                               </dd>
                                            </dl> 
                                       </li>
                                    </ul>
                                </dd>
                                <dd class="error col-xs-12"></dd>
                            </dl>


                            <!--자기소개 글-->
                            <dl class="row">
                                <dd class="col-xs-1 req">*</dd>
                                <dd class="col-xs-12">
                                    <label for="reg_mb_introduce">자기소개 글</label>
                                    <textarea placeholder="소개글을 입력해주세요." maxlength="255" rows="6" spellcheck="false" name="pf_produce" id="pf_produce" style="height: 204px;"><?= $view['pf_produce']?></textarea>
                                </dd>
                                <dd class="error col-xs-12"></dd>
                            </dl>

                            <!--전문분야 및 상세분야 선택-->
                            <dl class="row">
                                <dd class="col-xs-1 req">*</dd>
                                <dd class="col-xs-12 cate_wrap">
                                    <label for="reg_mb_worktime">전문분야 및 상세분야 선택<span>복수입력가능</span></label>
                                   <ul>
                                       <li>
                                       <select onchange="pro_ctg1_change(this.value,'pro')" name="pro_ctg1" class="select" id="pro_ctg1">
                                           <option value="">1차 카테고리 선택</option>
                                           <?= common_code('ctg','code_ctg','html')?>
                                       </select>
                                       </li>
                                       <li>
                                       <select onchange="pro_ctg1_change(this.value,'pro2')" name="pro_ctg2" class="select" id="pro_ctg2" title="2차 카테고리 선택">
                                           <option value="">2차 카테고리 선택</option>
                                       </select>
                                       </li>
                                       <li>
                                           <select onchange="add_pro_ctg(this.options[this.selectedIndex].text,this.value,'pro')" name="pro_ctg3" class="select" id="pro_ctg3" title="3차 카테고리">
                                                <option value="">3차 카테고리 선택</option>
                                           </select>
                                       </li>
                                   </ul>
                                </dd>
                                <dd class="error col-xs-12"></dd>
                                <dd>
                                    <ul id = "pro_ctg1_ul">
                                        <?= $pro_ctg1_html ?>
                                    </ul>
                                </dd>
                            </dl>

                            <!--분야 별 보유기술 선택-->
                            <dl class="row">
                                <dd class="col-xs-1 req">*</dd>
                                <dd class="col-xs-12 cate_wrap">
                                    <label for="reg_mb_worktime">분야 별 보유기술 선택<span>복수입력가능</span></label>
                                   <ul>
                                       <li>
                                           <select onchange="pro_ctg1_change(this.value,'hold')" name="hold_ctg1" class="select" id="pf_hold_ctg1">
                                               <option value="">1차 카테고리 선택</option>
                                               <?= common_code('ctg','code_ctg','html')?>
                                           </select>
                                       </li>
                                       <li>
                                           <select onchange="add_pro_ctg(this.options[this.selectedIndex].text,this.value,'hold')" name="hold_ctg2" class="select" id="pf_hold_ctg2" title="상세분야 선택">
                                               <option value="">2차 카테고리 선택</option>

                                           </select>
                                       </li>
                                   </ul>
                                </dd>
                                <dd class="error col-xs-12"></dd>
                                <dd>
                                    <ul id = "hold_ctg1_ul">
                                        <?= $hold_ctg1_html ?>
                                    </ul>
                                </dd>
                            </dl>

                            <!--학력 및 전공-->
<!--                            <dl class="row">-->
<!--                                <dd class="col-xs-1 req">*</dd>-->
<!--                                <dd class="col-xs-12">-->
<!--                                    <label for="reg_mb_introduce">학력 및 전공</label>-->
<!--                                    <input type="text" name="pf_school" value="--><?php //echo $view['pf_school'] ?><!--" id="pf_school" class="regist-input" placeholder="학교명 입력">-->
<!--                                    <div class="account_wrap t_margin10">-->
<!--                                         <ul>-->
<!--                                              <li>-->
<!--                                              <input name="pf_major" type="text" value="--><?php //echo $view['pf_major'] ?><!--" id="pf_major" class="regist-input" placeholder="전공 입력">-->
<!--                                              </li>-->
<!--                                              <li>-->
<!--                                              <select name="pf_grad" class="select" id="pf_grad" title="졸업여부 선택">-->
<!--                                                  <option value="">졸업여부 선택</option>-->
<!--                                                  <option value="J">재학중</option>-->
<!--                                                  <option value="H">휴학중</option>-->
<!--                                                  <option value="G">졸업</option>-->
<!--                                              </select>-->
<!--                                              </li>-->
<!--                                          </ul>-->
<!--                                    </div>-->
<!--                                </dd>-->
<!--                                <dd class="error col-xs-12"></dd>-->
<!--                            </dl>-->

                            <!--보유 자격증 hidden 영역 style="display: none"-->
                          <span id = "file_span">
                          <input type="file"  name="image[]" class="frm_file" id="image<?= $certificate_image != 0 ? $certificate_image: "0";?>" onchange="getImgPrev(this)" accept="image/*" >
                          </span>
                          <!--보유 자격증 hidden 영역 끝-->
                          <dl class="row"  style="margin-bottom: 100px!important;">
                                <dd class="col-xs-1 req">*</dd>
                                <dd class="col-xs-12">
                                    <label for="reg_mb_introduce">보유 자격증<span>복수입력가능</span></label>
<!--                                    <button type="button" onclick="certificate_add()" class="add">+ 자격증 추가</button>-->
                                    <div style="cursor: pointer" id="file_<?= $certificate_image != 0 ? $certificate_image: "0";?>" onclick="file_click(this)" ><!--이미지 등록 전-->
                                                 <div id="prev_area"></div>
                                                 <div class="addfile"><i class="fas fa-id-card"></i> 자격증 이미지 첨부</div>
                                    </div>
                                    <input type="text" name="" value="" id="certificate_name" class="regist-input" placeholder="자격증명">
                                    <div class="account_wrap t_margin10">
                                         <ul>
                                              <li>
                                              <input name="" type="text" value="" id="certificate_date" class="regist-input" placeholder="취득일(예:20201210)">
                                              </li>
                                              <li>
                                              <input name="" type="text" value="" id="certificate_agency" class="regist-input" placeholder="발급기관">
                                              </li>
                                          </ul>
                                          <button type="button" class="addcerti" onclick="certificate_add()">자격증 추가하기</button>
                                    </div>

                                </dd>
                                <dd class="error col-xs-12"></dd>
                                <dd id = "certificate_dd">
                                    <?= $certificate_html ?>
                                </dd>
                            </dl>

                            <!--포트폴리오 작성-->
<!--                            <dl class="row">-->
<!--                                <dd class="col-xs-1 req">*</dd>-->
<!--                                <dd class="col-xs-12">-->
<!--                                    <label for="reg_mb_introduce">포트폴리오 작성<span>복수입력가능</span></label>-->
<!--                                    <input type="text" name="mb_worktime" value="--><?php //echo $member['mb_worktime'] ?><!--" id="reg_mb_worktime" class="regist-input" placeholder="포트폴리오 제목 입력">-->
<!--                                    <textarea placeholder="포트폴리오 내용 입력" maxlength="255" rows="6" spellcheck="false" id="reg_mb_introduce" style="height: 204px; margin:10px 0 0"></textarea>-->
<!--                                </dd>-->
<!--                                <dd class="error col-xs-12"></dd>-->
<!--                                <dd>-->
<!--                                    <div class="tag_t">대표이미지</div>-->
<!--                                    <div class="img_up_profile">-->
<!--                                        <ul class="mainType">-->
<!--                                                <li class="">-->
<!--                                                   <a href="">-->
<!--                                                       <div class="img"><img src="http://itforone.co.kr/~holoho/theme/holoholic/img/photo/03.jpg" alt=""></div>-->
<!--                                                       <div class="del"></div>-->
<!--                                                   </a>-->
<!--                                                </li>-->
<!--                                                <li class="">-->
<!---->
<!--                                                </li>-->
<!--                                        </ul>-->
<!--                                    </div>-->
<!--                                    <div class="tag_t">상세이미지</div>-->
<!--                                    <div class="img_up_profile">-->
<!--                                        <ul class="mainType">-->
<!--                                                <li class="">-->
<!--                                                   <a href="">-->
<!--                                                       <div class="img"><img src="http://itforone.co.kr/~holoho/theme/holoholic/img/photo/03.jpg" alt=""></div>-->
<!--                                                       <div class="del"></div>-->
<!--                                                   </a>-->
<!--                                                </li>-->
<!--                                                <li class="">-->
<!---->
<!--                                                </li>-->
<!--                                        </ul>-->
<!--                                    </div>-->
<!--                                 </dd>-->
<!--                            </dl>-->
                      </div>
                   </div>
                   <input type="button" onclick="form_ajax()"  class="btn_submit ft_btn" value="<?php echo isset($view)?'프로필 수정':'재능인 등록 요청'; ?>" accesskey="s">
              </div>

        </section>

    </form>
</article>
<!-- //프로필 관리 -->
<script>

    $(document).ready(function () {
        var pro_ctg1 = $('[name = pro_ctg1]').val();
        var hold_ctg1 = $('[name = hold_ctg1]').val();
        // ready 시 대분류 1로 임의설정
        // pro_ctg1_change(pro_ctg1,'pro');
        // pro_ctg1_change(hold_ctg1,'hold');

        <?php if (isset($view)){ ?>
            $('[name = pf_time]').val(<?=$view["pf_time"]?>);
            $('#pf_grad').val('<?=$view["pf_grad"]?>');

            $('#call_hour_1').val('<?=$pf_call_time1[0]?>');
            $('#call_min_1').val('<?=$pf_call_time1[1]?>');
            $('#call_hour_2').val('<?=$pf_call_time2[0]?>');
            $('#call_min_2').val('<?=$pf_call_time2[1]?>');

            //buisnessman_chk('<?//=$member["mb_buisnessman"]?>//');
            $("input:radio[name='mb_buisnessman']:radio[value='<?=$member['mb_buisnessman']?>']").prop("checked", true);
        <?php } ?>
    });

    
    function pro_ctg1_change(val,type) {

        $.ajax({
            url: g5_bbs_url+"/ajax.controller.php",
            type: "POST",
            data: {
                "pro_ctg1": val,
                "mode": "pro_ctg2_common"
            },
            dataType: "html",
            success: function(data) {
                if(type == 'pro') {
                    $('#pro_ctg2').html('<option value="">2차 카테고리 선택</option>' + data);
                    $('#pro_ctg3').html('<option value="">3차 카테고리 선택</option>');
                }else if (type == 'hold') {
                    $('#pf_hold_ctg2').html('<option value="">2차 카테고리 선택</option>' + data);
                }else if(type == 'pro2') {
                    $('#pro_ctg3').html('<option value="">3차 카테고리 선택</option>' + data);
                }
            }
        });

    }

    function add_pro_ctg(text,val,type) {

        var html = "";
        var sub_html = "";


        //카테고리1 값 받아오기
        var sel = "";
        if (type == 'pro') {
            var sel = document.getElementById("pro_ctg1");
        }else if (type == 'hold') {
            var sel = document.getElementById("pf_hold_ctg1");
        }
        var id = type;

        var ctg1 = sel.options[sel.selectedIndex].text;
        var ctg1_val = sel.options[sel.selectedIndex].value;


        if (type == 'pro') {
            var sel2 = document.getElementById("pro_ctg2");
            var ctg2 = sel2.options[sel2.selectedIndex].text;
            var ctg2_val = sel2.options[sel2.selectedIndex].value;

            text = ctg2 +"/"+text;
            sub_html += "<input type='hidden' id='"+id+"input_tag2_"+val+"' value='"+val+"'>";

        }else{
            // pro일 경우 3차 카테고리가 들어가서 ctg2_val 을넣어줌.
            // hold일 경우 상관없어서 val로 변수 재설정
            ctg2_val = val;
        }


        sub_html += "<div id='"+id+"tag_"+val+"' class=\"tag02\">\n" +
            "            <div class=\"close\" onclick='tag_del("+val+","+ctg1_val+","+"\""+id+"\");'><i class=\"fal fa-times\"></i></div>\n" +
            "        <span>"+text+"</span>\n" +
            "        <input type='hidden' value='"+ctg2_val+"' id='"+id+"input_tag_"+val+"'>\n" +
            "        </div>";
        // html += "<input type='hidden' id='"+id+"input_tag2_"+val+"' value='"+val+"'>";
        html += "<li id='"+id+"_ctg_sub_"+ctg1_val+"'>";

        html += "<input type='hidden' id='"+id+"input_ctg1_"+ctg1_val+"' value='"+ctg1_val+"'>";
        html += "<div class=\"tag_t\">"+ctg1+"</div>\n";
        html += sub_html
        html += "</li>";

        if ($('#'+id+'_ctg1_ul').find('#'+id+'_ctg_sub_'+ctg1_val).length == 0) {
            $('#'+id+'_ctg1_ul').append(html);
        }else{
            //value값이 없거나 같은게 들어가잇을 경우 추가안함
            if (val != '' && !document.getElementById(id+'tag_'+val) ) {
                $('#' + id + '_ctg_sub_' + ctg1_val).append(sub_html);
            }
        }


    }

    var update_idx = [];
    //전문분야 상세분야 삭제
    function tag_del(idx,ctg1,type){

        var id = type;
        $('#'+id+'tag_'+idx).remove();
        if(type == 'certificate') {
            $('#image' + idx).remove();
            update_idx.push( $('#file_input_idx_'+ idx).val());
            console.log(update_idx);
        }


        //밑에 메뉴가 없을 경우 그 부분 완전히 삭제
        if ($('#'+id+'_ctg_sub_'+ctg1).find('div').length < 2){
            $('#'+id+'_ctg_sub_'+ctg1).remove();
        }
    }

    //자격증 추가
    var i = <?= $certificate_image != 0 ? $certificate_image: "1";?>;
    function certificate_add() {

        //이미지 담겼는지 확인
        if ($('#image'+i).val() == ""){
            swal("해당 자격증 이미지를 첨부해주세요");
            return false;
        }

        var name = $('#certificate_name').val(),
            date = $('#certificate_date').val(),
            agency = $('#certificate_agency').val(),
            html = "";
        html += " <div id='certificatetag_"+i+"' class=\"tag\">\n" +
            "<div onclick='tag_del("+i+",0,\"certificate\");' class=\"close\"><i class=\"fal fa-times\"></i></div>\n" +
            "<span name = 'certificate_span'>"+name+"/"+date+"/"+agency+"</span>\n" +
            "</div>"

        $('#certificate_dd').append(html);

        $('#certificate_name').val("");
        $('#certificate_date').val("");
        $('#certificate_agency').val("");
        $('#prev_area').html('');
        i ++;

        image_add();



    }


    function form_ajax() {

        var form = $('#profilefrm')[0];
        var formData = new FormData(form);

        var certificate_text = $('[name=certificate_span]');
        var certificate_arr = [];
        var pro_input_tag_arr = [];
        var hold_input_tag_arr = [];
        var pro_input_ctg1_arr = [];
        var hold_input_ctg1_arr = [];
        var pro_input_tag2_arr = [];
        //자격증명 배열 담기
        for (a = 0; a < certificate_text.length;a++){
            certificate_arr.push(certificate_text[a].innerHTML);
        }

        var pro_input_tag = $("[id^='proinput_tag_']"),
            hold_input_tag = $("[id^='holdinput_tag_']"),
            pro_input_ctg1 = $("[id^='proinput_ctg1_']"),
            hold_input_ctg1 = $("[id^='holdinput_ctg1_']");
            pro_input_tag2 = $("[id^='proinput_tag2_']");



        for (a = 0; a < pro_input_tag.length;a++){
            pro_input_tag_arr.push(pro_input_tag[a].value);
        }
        for (a = 0; a < hold_input_tag.length;a++){
            hold_input_tag_arr.push(hold_input_tag[a].value);
        }
        for (a = 0; a < pro_input_ctg1.length;a++){
            pro_input_ctg1_arr.push(pro_input_ctg1[a].value);
        }
        for (a = 0; a < hold_input_ctg1.length;a++){
            hold_input_ctg1_arr.push(hold_input_ctg1[a].value);
        }
        for (a = 0; a < pro_input_tag2.length;a++){
            pro_input_tag2_arr.push(pro_input_tag2[a].value);
        }


        formData.append("mode", "profile_form");
        formData.append("certificate_arr", certificate_arr);
        formData.append("pro_ctg1_arr", pro_input_ctg1_arr);
        formData.append("pro_ctg2_arr", pro_input_tag_arr);
        formData.append("pro_ctg3_arr", pro_input_tag2_arr);
        formData.append("hold_ctg1_arr", hold_input_ctg1_arr);
        formData.append("hold_ctg2_arr", hold_input_tag_arr);
        //자격증 이미지
        formData.append("update_idx", update_idx);

        //사업자 등록증
        formData.append("mb_buisnessman", $('input[name="mb_buisnessman"]:checked').val());
        formData.append("mb_buisnessman_file", $('#mb_buisnessman_file').val());

        $.ajax({
            url : g5_bbs_url + "/ajax.controller.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            // datatype : 'json',
            success : function(data) {
                data = JSON.parse(data);

                swal(data.msg)
                    .then((value) => {
                    location.href = data.url;
                    });


            },
            err : function(err) {
                swal(err.status);
            }
        });

    }

    var subfilesTempArr = [];
    function image_add() {
        var input_id = "image" + i;


        html = '<input type="file" name="image[]" class="frm_file" id="'+input_id+'" onchange="getImgPrev(this)" accept="image/*" >';


        // $("#" + id + "file_input").after(upload);
        $('#file_'+ (i-1)).attr('id','file_'+i);
        $('#file_span').append(html);


    }

    //id 바꿔주기
    function file_click(f) {
        // console.log(f);
        // console.log(f.id);
        var id = f.id.split("_");
        $('#image'+id[1]).trigger('click');
    }

    //이미지 미리보기
    function getImgPrev(input) {
        var reg_ext = /(.*?)\.(jpg|jpeg|png)$/;
        var files = input.files;
        var files_arr = Array.prototype.slice.call(files);

        for (var i = 0; i < input.files.length; i++) {
            // img_idx++;

            var file_name = input.files[i].name.toLowerCase();
            if (!reg_ext.test(file_name)) {
                swal("이미지만 등록이 가능합니다. (jpg, jpeg, png)");
                return false;
            }

            subfilesTempArr.push(files_arr[i]);

            if (input.files && input.files[i]) {
                var reader = new FileReader();
                reader.onload = function (e) {

                    var html = "<li id ='p_box'>";
                    html += "<div class=\"img\">"+file_name+"</div>"
                    html += "</li>"
                    $('#prev_area').html(html);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }
        // console.log(filesTempArr)
    }





</script>