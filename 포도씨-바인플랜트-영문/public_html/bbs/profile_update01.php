<?php
include_once('./_common.php');

$g5['title'] = '프로필 업데이트';
include_once('./_head.php');

loginCheck($member['mb_id'], '일반');

$mb = get_member($member['mb_id']); // 회원정보
?>

<link rel="stylesheet" href="<?=G5_THEME_URL?>/mobile/skin/member/app_basic/style.css?v=<?= G5_CSS_VER ?>">
<style>
	.profile_top .list_step > li.active:before{width:20%;}
	.profile_content h3{text-align:center !important;}
    .box-article #join_info .row .error.on {
        color: #FF0000;
    }
    .box-article #join_info .row .error {
        font-size: 0.85em;
        color: #858585;
        padding: 0;
    }
</style>

<div class="mbskin">
	<article class="box-article">
		<h3>Profile Update</h3>
        <form id="fprofile" name="fprofile" method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" id="del_file" name="del_file" value="<?=$mb['mb_img_idx']?>">
            <div id="area_join" class="profile">
                <div id="join_info">
                    <div class="profile_top">
                        <ul class="list_step">
                            <li class="active">
                                <em>1</em>
                                <span>Member Introduction</span>
                            </li>
                            <li>
                                <em>2</em>
                                <span>Work history</span>
                            </li>
                            <li>
                                <em>3</em>
                                <span>Education, Major<span class="option">Optional</span></span>
                            </li>
                            <li>
                                <em>4</em>
                                <span>Possessed Skills, Certifications<span class="option">Optional</span></span>
                            </li>
                            <li>
                                <em>5</em>
                                <span>Additional Information</span>
                            </li>
                        </ul>
                    </div>
                    <div class="profile_content">
                        <h3>Introduce Yourself!</h3>
                        <div class="profile_box">
                            <div class="area_photo">
                                <a class="upload" href="javascript:void(0);" onclick="file_add();"></a>
                                <input type="file" name="file" id="file" onchange="getImgPrev(this);" accept="image/*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;">

                                <!-- 등록 이미지 있을 때 -->
                                <div class="p_box">
                                    <div class="img_rd">
                                    <?php echo getProfileImg($mb['mb_id'], $mb['mb_category']); ?>
                                    </div>
                                </div>
                            </div>
                            <dl class="row">
                            <dt>Nickname<!--을 작성해주세요.--><em>*Optional</em></dt>
                            <dd>
                                <div class="input">
                                    <input type="text" name="mb_nick" id="reg_mb_nick" value="<?=$mb['mb_nick']?>" class="regist-input" placeholder="Enter a nickname.">
                                    <input type="hidden" name="mb_id" id="reg_mb_id" value="<?=$mb['mb_id']?>">
                                </div>
                            </dd>
                            <dd class="error col-xs-12"></dd>
                        </dl>
                        </div>

                        <dl class="row">
                            <dt>Write a brief self-introduction.</dt>
                            <dd>
                                <div class="input">
                                    <textarea id="mb_introduce" name="mb_introduce" placeholder="E.g.) Maritime project specialist?&#13;&#10;10 years of experience in repair services" required><?=$mb['mb_introduce']?></textarea>
                                </div>
                            </dd>
                        </dl>

						<!-- 국가로 변경 -->
                        <dl class="row">
                            <dt>Country</dt>
                            <dd>
                                <div class="input">
                                    <select id="mb_si" name="mb_si" required>
                                        <option value="">Please select a country</option>
                                        <?php foreach ($arr_country_code as $code=>$value) { ?>
                                        <option value="<?=$value[1]?>" <?php echo $mb['mb_si'] == $value[1] ? 'selected' : '';?>><?=$value[1]?></option>
                                        <? } ?>
                                       <!--<option value="Afganistan">Afghanistan</option>
									   <option value="Albania">Albania</option>
									   <option value="Algeria">Algeria</option>
									   <option value="American Samoa">American Samoa</option>
									   <option value="Andorra">Andorra</option>
									   <option value="Angola">Angola</option>
									   <option value="Anguilla">Anguilla</option>
									   <option value="Antigua & Barbuda">Antigua & Barbuda</option>
									   <option value="Argentina">Argentina</option>
									   <option value="Armenia">Armenia</option>
									   <option value="Aruba">Aruba</option>
									   <option value="Australia">Australia</option>
									   <option value="Austria">Austria</option>
									   <option value="Azerbaijan">Azerbaijan</option>
									   <option value="Bahamas">Bahamas</option>
									   <option value="Bahrain">Bahrain</option>
									   <option value="Bangladesh">Bangladesh</option>
									   <option value="Barbados">Barbados</option>
									   <option value="Belarus">Belarus</option>
									   <option value="Belgium">Belgium</option>
									   <option value="Belize">Belize</option>
									   <option value="Benin">Benin</option>
									   <option value="Bermuda">Bermuda</option>
									   <option value="Bhutan">Bhutan</option>
									   <option value="Bolivia">Bolivia</option>
									   <option value="Bonaire">Bonaire</option>
									   <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
									   <option value="Botswana">Botswana</option>
									   <option value="Brazil">Brazil</option>
									   <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
									   <option value="Brunei">Brunei</option>
									   <option value="Bulgaria">Bulgaria</option>
									   <option value="Burkina Faso">Burkina Faso</option>
									   <option value="Burundi">Burundi</option>
									   <option value="Cambodia">Cambodia</option>
									   <option value="Cameroon">Cameroon</option>
									   <option value="Canada">Canada</option>
									   <option value="Canary Islands">Canary Islands</option>
									   <option value="Cape Verde">Cape Verde</option>
									   <option value="Cayman Islands">Cayman Islands</option>
									   <option value="Central African Republic">Central African Republic</option>
									   <option value="Chad">Chad</option>
									   <option value="Channel Islands">Channel Islands</option>
									   <option value="Chile">Chile</option>
									   <option value="China">China</option>
									   <option value="Christmas Island">Christmas Island</option>
									   <option value="Cocos Island">Cocos Island</option>
									   <option value="Colombia">Colombia</option>
									   <option value="Comoros">Comoros</option>
									   <option value="Congo">Congo</option>
									   <option value="Cook Islands">Cook Islands</option>
									   <option value="Costa Rica">Costa Rica</option>
									   <option value="Cote DIvoire">Cote DIvoire</option>
									   <option value="Croatia">Croatia</option>
									   <option value="Cuba">Cuba</option>
									   <option value="Curaco">Curacao</option>
									   <option value="Cyprus">Cyprus</option>
									   <option value="Czech Republic">Czech Republic</option>
									   <option value="Denmark">Denmark</option>
									   <option value="Djibouti">Djibouti</option>
									   <option value="Dominica">Dominica</option>
									   <option value="Dominican Republic">Dominican Republic</option>
									   <option value="East Timor">East Timor</option>
									   <option value="Ecuador">Ecuador</option>
									   <option value="Egypt">Egypt</option>
									   <option value="El Salvador">El Salvador</option>
									   <option value="Equatorial Guinea">Equatorial Guinea</option>
									   <option value="Eritrea">Eritrea</option>
									   <option value="Estonia">Estonia</option>
									   <option value="Ethiopia">Ethiopia</option>
									   <option value="Falkland Islands">Falkland Islands</option>
									   <option value="Faroe Islands">Faroe Islands</option>
									   <option value="Fiji">Fiji</option>
									   <option value="Finland">Finland</option>
									   <option value="France">France</option>
									   <option value="French Guiana">French Guiana</option>
									   <option value="French Polynesia">French Polynesia</option>
									   <option value="French Southern Ter">French Southern Ter</option>
									   <option value="Gabon">Gabon</option>
									   <option value="Gambia">Gambia</option>
									   <option value="Georgia">Georgia</option>
									   <option value="Germany">Germany</option>
									   <option value="Ghana">Ghana</option>
									   <option value="Gibraltar">Gibraltar</option>
									   <option value="Great Britain">Great Britain</option>
									   <option value="Greece">Greece</option>
									   <option value="Greenland">Greenland</option>
									   <option value="Grenada">Grenada</option>
									   <option value="Guadeloupe">Guadeloupe</option>
									   <option value="Guam">Guam</option>
									   <option value="Guatemala">Guatemala</option>
									   <option value="Guinea">Guinea</option>
									   <option value="Guyana">Guyana</option>
									   <option value="Haiti">Haiti</option>
									   <option value="Hawaii">Hawaii</option>
									   <option value="Honduras">Honduras</option>
									   <option value="Hong Kong">Hong Kong</option>
									   <option value="Hungary">Hungary</option>
									   <option value="Iceland">Iceland</option>
									   <option value="Indonesia">Indonesia</option>
									   <option value="India">India</option>
									   <option value="Iran">Iran</option>
									   <option value="Iraq">Iraq</option>
									   <option value="Ireland">Ireland</option>
									   <option value="Isle of Man">Isle of Man</option>
									   <option value="Israel">Israel</option>
									   <option value="Italy">Italy</option>
									   <option value="Jamaica">Jamaica</option>
									   <option value="Japan">Japan</option>
									   <option value="Jordan">Jordan</option>
									   <option value="Kazakhstan">Kazakhstan</option>
									   <option value="Kenya">Kenya</option>
									   <option value="Kiribati">Kiribati</option>
									   <option value="Korea North">Korea North</option>
									   <option value="Korea Sout">Korea South</option>
									   <option value="Kuwait">Kuwait</option>
									   <option value="Kyrgyzstan">Kyrgyzstan</option>
									   <option value="Laos">Laos</option>
									   <option value="Latvia">Latvia</option>
									   <option value="Lebanon">Lebanon</option>
									   <option value="Lesotho">Lesotho</option>
									   <option value="Liberia">Liberia</option>
									   <option value="Libya">Libya</option>
									   <option value="Liechtenstein">Liechtenstein</option>
									   <option value="Lithuania">Lithuania</option>
									   <option value="Luxembourg">Luxembourg</option>
									   <option value="Macau">Macau</option>
									   <option value="Macedonia">Macedonia</option>
									   <option value="Madagascar">Madagascar</option>
									   <option value="Malaysia">Malaysia</option>
									   <option value="Malawi">Malawi</option>
									   <option value="Maldives">Maldives</option>
									   <option value="Mali">Mali</option>
									   <option value="Malta">Malta</option>
									   <option value="Marshall Islands">Marshall Islands</option>
									   <option value="Martinique">Martinique</option>
									   <option value="Mauritania">Mauritania</option>
									   <option value="Mauritius">Mauritius</option>
									   <option value="Mayotte">Mayotte</option>
									   <option value="Mexico">Mexico</option>
									   <option value="Midway Islands">Midway Islands</option>
									   <option value="Moldova">Moldova</option>
									   <option value="Monaco">Monaco</option>
									   <option value="Mongolia">Mongolia</option>
									   <option value="Montserrat">Montserrat</option>
									   <option value="Morocco">Morocco</option>
									   <option value="Mozambique">Mozambique</option>
									   <option value="Myanmar">Myanmar</option>
									   <option value="Nambia">Nambia</option>
									   <option value="Nauru">Nauru</option>
									   <option value="Nepal">Nepal</option>
									   <option value="Netherland Antilles">Netherland Antilles</option>
									   <option value="Netherlands">Netherlands (Holland, Europe)</option>
									   <option value="Nevis">Nevis</option>
									   <option value="New Caledonia">New Caledonia</option>
									   <option value="New Zealand">New Zealand</option>
									   <option value="Nicaragua">Nicaragua</option>
									   <option value="Niger">Niger</option>
									   <option value="Nigeria">Nigeria</option>
									   <option value="Niue">Niue</option>
									   <option value="Norfolk Island">Norfolk Island</option>
									   <option value="Norway">Norway</option>
									   <option value="Oman">Oman</option>
									   <option value="Pakistan">Pakistan</option>
									   <option value="Palau Island">Palau Island</option>
									   <option value="Palestine">Palestine</option>
									   <option value="Panama">Panama</option>
									   <option value="Papua New Guinea">Papua New Guinea</option>
									   <option value="Paraguay">Paraguay</option>
									   <option value="Peru">Peru</option>
									   <option value="Phillipines">Philippines</option>
									   <option value="Pitcairn Island">Pitcairn Island</option>
									   <option value="Poland">Poland</option>
									   <option value="Portugal">Portugal</option>
									   <option value="Puerto Rico">Puerto Rico</option>
									   <option value="Qatar">Qatar</option>
									   <option value="Republic of Montenegro">Republic of Montenegro</option>
									   <option value="Republic of Serbia">Republic of Serbia</option>
									   <option value="Reunion">Reunion</option>
									   <option value="Romania">Romania</option>
									   <option value="Russia">Russia</option>
									   <option value="Rwanda">Rwanda</option>
									   <option value="St Barthelemy">St Barthelemy</option>
									   <option value="St Eustatius">St Eustatius</option>
									   <option value="St Helena">St Helena</option>
									   <option value="St Kitts-Nevis">St Kitts-Nevis</option>
									   <option value="St Lucia">St Lucia</option>
									   <option value="St Maarten">St Maarten</option>
									   <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
									   <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
									   <option value="Saipan">Saipan</option>
									   <option value="Samoa">Samoa</option>
									   <option value="Samoa American">Samoa American</option>
									   <option value="San Marino">San Marino</option>
									   <option value="Sao Tome & Principe">Sao Tome & Principe</option>
									   <option value="Saudi Arabia">Saudi Arabia</option>
									   <option value="Senegal">Senegal</option>
									   <option value="Seychelles">Seychelles</option>
									   <option value="Sierra Leone">Sierra Leone</option>
									   <option value="Singapore">Singapore</option>
									   <option value="Slovakia">Slovakia</option>
									   <option value="Slovenia">Slovenia</option>
									   <option value="Solomon Islands">Solomon Islands</option>
									   <option value="Somalia">Somalia</option>
									   <option value="South Africa">South Africa</option>
									   <option value="Spain">Spain</option>
									   <option value="Sri Lanka">Sri Lanka</option>
									   <option value="Sudan">Sudan</option>
									   <option value="Suriname">Suriname</option>
									   <option value="Swaziland">Swaziland</option>
									   <option value="Sweden">Sweden</option>
									   <option value="Switzerland">Switzerland</option>
									   <option value="Syria">Syria</option>
									   <option value="Tahiti">Tahiti</option>
									   <option value="Taiwan">Taiwan</option>
									   <option value="Tajikistan">Tajikistan</option>
									   <option value="Tanzania">Tanzania</option>
									   <option value="Thailand">Thailand</option>
									   <option value="Togo">Togo</option>
									   <option value="Tokelau">Tokelau</option>
									   <option value="Tonga">Tonga</option>
									   <option value="Trinidad & Tobago">Trinidad & Tobago</option>
									   <option value="Tunisia">Tunisia</option>
									   <option value="Turkey">Turkey</option>
									   <option value="Turkmenistan">Turkmenistan</option>
									   <option value="Turks & Caicos Is">Turks & Caicos Is</option>
									   <option value="Tuvalu">Tuvalu</option>
									   <option value="Uganda">Uganda</option>
									   <option value="United Kingdom">United Kingdom</option>
									   <option value="Ukraine">Ukraine</option>
									   <option value="United Arab Erimates">United Arab Emirates</option>
									   <option value="United States of America">United States of America</option>
									   <option value="Uraguay">Uruguay</option>
									   <option value="Uzbekistan">Uzbekistan</option>
									   <option value="Vanuatu">Vanuatu</option>
									   <option value="Vatican City State">Vatican City State</option>
									   <option value="Venezuela">Venezuela</option>
									   <option value="Vietnam">Vietnam</option>
									   <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
									   <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
									   <option value="Wake Island">Wake Island</option>
									   <option value="Wallis & Futana Is">Wallis & Futana Is</option>
									   <option value="Yemen">Yemen</option>
									   <option value="Zaire">Zaire</option>
									   <option value="Zambia">Zambia</option>
									   <option value="Zimbabwe">Zimbabwe</option>-->
                                    </select>
                                </div>
                            </dd>
                        </dl>

						<dl class="row hp">
							<dt>Phone number</dt>
							<dd>
								<div class="input">
									<input type="tel" name="mb_hp" value="<?=$mb_hp?>" id="reg_mb_hp" class="regist-input required" required placeholder="Enter mobile phone number.">
								</div>
							</dd>
							<dd class="error col-xs-12"></dd>
						</dl>

                        <div class="area_btn">
                            <!-- input 다작성하면 a class="active" 추가 -->
                            <a href="javascript:void(0);" class="btn_next">Next</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
	</article>
</div>

<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<script>
    $(function() {
        $('#mb_si').val('<?=$mb['mb_si']?>').attr("selected", "selected"); // 지역 ==> 국가
        form_check();

        // input 전부 작성 시 active 클래스 추가
        $(":input").on("change keyup", function(e) {
            form_check();
        });
    });

    // 폼체크(필수값)
    function form_check() {
        if($.trim($('#mb_introduce').val()).length != 0 && $('#mb_si').val() != "" && $.trim($('#reg_mb_hp').val()).length != 0) {
            $('.btn_next').addClass('active');
            $('.btn_next').attr('href', 'javascript:profile_update();');
        } else {
            $('.btn_next').removeClass('active');
            $('.btn_next').attr('href', 'javascript:void(0);');
        }
    }

    // 프로필 사진 등록
    function file_add() {
        $("#file").click();
    }

    // 사진 미리보기
    var filesTempArr = [];
    function getImgPrev(input) {
        var regex = /(.*?)\.(jpg|jpeg|png|PNG|bmp|JPG|gif)$/;

        if (!regex.test(input.files[0].name)) {
            swal("Only images can be registered.\n(jpg/jpeg/png/bmp/gif)");
            input.value = "";
            return false;
        }

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var div = document.createElement('div'),
                    div_img = document.createElement('div'),
                    img = document.createElement('img');
                // btn = document.createElement('button');

                var el = $(input),
                    prev_area = el.nextAll("div.p_box"),
                    file_area = el.nextAll("div.wr_files");
                if (prev_area.length > 0) prev_area.remove();
                //if (file_area.length > 0) file_area.remove();

                div.setAttribute("class", "p_box");

                div_img.setAttribute("class", "img_rd");
                img.setAttribute("class", "p_img");
                img.setAttribute("src", e.target.result);
                img.setAttribute("style", "width:80px;height:80px;border-radius:50px");

                // btn.setAttribute("type", "button");
                // btn.setAttribute("class", "btn");
                // btn.innerHTML = "X";

                div_img.appendChild(img);
                div.appendChild(div_img);
                // div.appendChild(btn);

                el.after(div);
            }
            reader.readAsDataURL(input.files[0]);

            var files = input.files;
            var files_arr = Array.prototype.slice.call(files);
            filesTempArr.push(files_arr);

            /*var form = $('form')[0];
            var formData = new FormData(form);
            formData.append("file[]", filesTempArr);

            // return false;
            // 이미지 등록
            $.ajax({
                url : g5_bbs_url + "/ajax.profile_update.php",
                processData: false,
                contentType: false,
                data: formData,
                type: 'POST',
                success : function(data) {
                    if(data){
                        swal('사진 등록이 완료되었습니다.');
                        $('#del_file').val(data);
                    }else{
                        swal("통신에 실패했습니다.");
                    }
                },
                err : function(err) {
                    alert(err.status);
                }
            });*/
        }
    }

    // 닉네임 중복 검사
    $("#reg_mb_nick").keyup(function () {
        // 공백제거
        $(this).val($(this).val().replace(/ /gi, ''));
        var state = $(this).parents(".row").find(".status_ico");
        var err = $(this).parents(".row").find(".error");

        if($.trim($("#reg_mb_nick").val()).length != 0) {
            var msg = reg_mb_nick_check();
            if (msg) {
                state.removeClass("pas").addClass("err");
                err.addClass("on").html(msg);
            } else {
                state.removeClass("err").addClass("pas");
                err.html("");
            }
        }
        else {
            err.html("");
        }
    });

    // 프로필 업데이트 - 회원소개
    function profile_update() {
        // 닉네임중복체크
        if($.trim($('#reg_mb_nick').val()) != 0) {
            var msg = reg_mb_nick_check();
            if (msg) {
                swal(msg);
                $('#reg_mb_nick').focus();
                return false;
            }
        }

        var form = $('form')[0];
        var formData = new FormData(form);
        formData.append("file[]", filesTempArr);
        formData.append("mode", 'profile01');

        $.ajax({
            url : g5_bbs_url + "/ajax.profile_update.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            success : function(data) {
                if(data){
                    location.href = '<?php echo G5_BBS_URL ?>/profile_update02.php';

                    //if('<?//=$member['mb_active_business']?>//' == 1) { // 학생 또는 취업준비생이면 2단계 경력사항에 해당되지 않으므로 3단계(학력, 전공)로 바로 넘어감
                    //     swal("경력사항에 해당사항이 없으므로\n학력, 전공 입력으로 넘어갑니다.")
                    //     .then(()=>{
                    //        location.href = '<?php //echo G5_BBS_URL ?>///profile_update03.php';
                    //     });
                    // } else {
                    //    location.href = '<?php //echo G5_BBS_URL ?>///profile_update02.php';
                    // }
                }
            },
            err : function(err) {
                swal(err.status);
            }
        });
    }
</script>

<?
include_once('./_tail.php');
?>