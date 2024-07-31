<?php 
    echo view('common/header_adm'); 
    $pid = "delivery_info_write";
    $header_name = "출고지 관리";
?>
<style>
</style>


<div id="adm_content">
    <?php echo view('common/admin_menu'); ?>

    <div class="con_wrap">

        <div class="tit_wrap">
            <h6 class="menu01">배송정보 관리</h6>
            <div class="menu02">
                <a href="<?=base_url('admin/delivery_info_list')?>" class="active">출고지 관리</a>
            </div>
        </div>


        <div class="write_wrap">
            <div class="top_wrap">
                <h1>배송정보 등록하기</h1>
                <div class="btn_wrap">
                    <a href="<?=base_url('admin/delivery_info_list')?>" class="btn btn-sm btn-gray">목록</a>
                    <a href="<?=base_url('admin/delivery_info_list')?>" class="btn btn-sm btn-blue">저장</a>
                </div>
            </div>
            <div class="box">
                <div class="input_form input_text">
                    <p><span class="color-blue">(필수)</span>주소록명</p>
                    <input type="text" placeholder="입력하세요" class="border_gray">

                    <div class="flex gap20">
                        <div class="input_checkbox">
                            <input type="checkbox" id="radi_address_name01">
                            <label for="radi_address_name01">
                                <i class="fa-duotone fa-square-check"></i>
                                대표 반품주소 설정
                            </label>
                        </div>
                        <div class="input_checkbox">
                            <input type="checkbox" id="radi_address_name02">
                            <label for="radi_address_name02">
                                <i class="fa-duotone fa-square-check"></i>
                                대표 방문수령 주소 설정
                            </label>
                        </div>
                    </div>
                </div>
                <div class="input_form input_text">
                    <p><span class="color-blue">(필수)</span>주소</p>

                    <div class="flex gap20">
                        <div class="input_checkbox">
                            <input type="checkbox" id="radi_address01">
                            <label for="radi_address01">
                                <i class="fa-duotone fa-square-check"></i>
                                사업자 정보와 동일
                            </label>
                        </div>
                        <div class="input_checkbox">
                            <input type="checkbox" id="radi_address02">
                            <label for="radi_address02">
                                <i class="fa-duotone fa-square-check"></i>
                                글로벌 셀러
                            </label>
                        </div>
                    </div>

                    <div class="input_adress">
                        <div class="flex gap10 ">
                            <input type="text" placeholder="우편번호" class="border_gray" disabled>
                            <button class="btn btn-blue">우편번호 검색</button>
                        </div>
                        <input type="text" placeholder="주소" class="border_gray" disabled>
                        <input type="text" placeholder="상세주소" class="border_gray">
                    </div>
                </div>

                <div class="wrap">

                    <!--                   번호입력폼은 둘중 편하신거 아무거나 복붙해서쓰세요-->

                    <div class="input_text">
                        <p>전화번호</p>
                        <div class="input_select">
                            <input type="text" placeholder="-을 제외한 숫자를 입력하세요" class="border_gray" maxlength='11'>
                        </div>
                    </div>
                    <div class="input_phone">
                        <p><span class="color-blue">(필수)</span>휴대전화</p>
                        <div class="input_select">
                            <select class="border_gray">
                                <option value="010">010</option>
                                <option value="010">010</option>
                                <option value="010">010</option>
                            </select>
                        </div>
                        -
                        <input type="text" placeholder="4자리" class="border_gray" maxlength='4'>
                        -
                        <input type="text" placeholder="4자리" class="border_gray" maxlength='4'>
                    </div>
                </div>

                <div class="input_form input_text">
                    <p>약도/지도</p>
                    <div class="input_file2">
                        <div class="input_select">
                            <select class="border_gray">
                                <option value="이미지 등록">이미지 등록</option>
                                <option value="지도URL">지도URL</option>
                            </select>
                        </div>
                        <label for="btn-file">
                            <input type="file" id="btn-file" style="display:none;">
                            <input type="text" placeholder="2MB이하로 등록하세요" class="border_gray">
                            <button class="btn btn-blue">이미지 선택</button>
                        </label>
                    </div>

                </div>

                <div class="input_form">
                    <p>위치설명</p>
                    <input type="text" placeholder="위치명을 입력해주세요" class="border_gray">
                </div>

            </div>
        </div>
    </div>
</div>


<?php echo view('common/footer'); ?>
