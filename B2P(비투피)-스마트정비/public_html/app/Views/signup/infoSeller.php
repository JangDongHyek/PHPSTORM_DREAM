<?php 
    echo view('common/header_adm');
    $pid = "infoSeller";
    $header_name = "사업자정보 입력";
?>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<style>
    #wrap{
        position: fixed!important;
        top: 0!important;
        left: 0!important;
        width: 100%!important;
        height: 100vh!important;
/*        height: calc(100vh - 50px)!important;*/
        z-index: 999!important;
        margin: 0!important;
    }
</style>
<div id="register">
    <div class="box">
        <div class="hd_tit">스마트정비마켓 판매회원 가입</div>
        <div class="tit_wrap">
            <h1>사업자정보를 입력해주세요</h1>
        </div>
        <form action="" class="form_wrap" id="seller_form" name="seller_form">
            <p class="tit">상호</p>
            <input type="text" class="border_gray" placeholder="입력하세요" value='<?=$company_name?>' disabled>
            <!--            <p class="msg-text">msg</p>-->

            <p class="tit">사업자등록번호(고유번호)</p>
            <input type="text" class="border_gray" placeholder="입력하세요" value='<?=$company_no?>' disabled>
            <!--            <p class="msg-text">msg</p>-->

            <p class="tit">등록명의자/대표자</p>
            <input type="text" class="border_gray" placeholder="입력하세요" value='<?=$company_owner?>' disabled>



            <p class="tit">사업자등록증</p>
            <a class="btn btn-blueline btn-modal" onclick="file_upload_modal();">
                <!-- modal.js에 추가-->
                <i class="fa-duotone fa-plus"></i>서류 사본 추가<br>

            </a>

            <input type="file" id="cp_file" name="cp_file" style="display: none">
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>
            <input type="button" class="btn btn-lg btn-white text-sm" value="이미지 보기" id="show_file" name="show_file" style="display: none">


<!--            <p class="tit">사업장 주소</p>
            <a class="btn btn-blueline btn-modal">
                <i class="fa-regular fa-magnifying-glass"></i>주소찾기
            </a>-->

            <p class="tit">사업자주소</p>
            <div class="input_search">
                <input type="text" placeholder="주소를 검색하세요" readonly class="border_gray" id="cp_addr1" name="cp_addr1" value="" onclick="daum_zip('cp_zip','cp_addr1','cp_addr2','cp_addr3','cp_addr4','cp_addr1');">
                <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>
            </div>


            <p class="tit">상세주소</p>
            <div class="input_form input_text">
                <input type="text" placeholder="입력하세요" class="border_gray" id="cp_addr2" name="cp_addr2" value="">
            </div>
            <input type="hidden" placeholder="입력하세요" class="border_gray" id="cp_zip" name="cp_zip" value="">
            <input type="hidden" placeholder="입력하세요" class="border_gray" id="cp_addr3" name="cp_addr3" value="">
            <input type="hidden" placeholder="입력하세요" class="border_gray" id="cp_addr4" name="cp_addr4" value="">

            <p class="tit">업태</p>
            <div id="business_type_container">
                <div class="input_busi">
                    <input type="text" class="border_gray" placeholder="업태" name="business_type[]" value="">
                    <button type="button" class="btn btn-gray btn-plus"><i class="fa-regular fa-plus"></i></button>
                </div>
            </div>
            <div id="business_type" style="display: none"></div>
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>

            <p class="tit">종목</p>
            <div id="business_item_container">
                <div class="input_busi">
                    <input type="text" class="border_gray" placeholder="종목" name="business_item[]" value="">
                    <button type="button" class="btn btn-gray btn-plus"><i class="fa-regular fa-plus"></i></button>
                </div>
            </div>
            <div id="business_item" style="display: none"></div>
            <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>
            <p class="guide-text">사업자등록증에 기재된 업태 및 종목을 모두 입력해주세요.</p>



            <p class="tit">통신판매업 신고번호</p>
            <div class="wh-box radi_wrap">
                <input type="radio" id="radi_direct_input" name="seller_status" value="1">
                <label for="radi_direct_input">
                    <i class="fa-duotone fa-circle-check"></i>
                    직접입력
                    <div class="input_text">
                        <input type="text" class="border_gray" placeholder="신고번호를 입력해주세요" id="direct_input_number">
                    </div>
                </label>

                <input type="radio" id="radi_exempt" name="seller_status" value="2">
                <label for="radi_exempt">
                    <i class="fa-duotone fa-circle-check"></i>
                    신고 면제 대상
                    <div class="input_select">
                        <i class="fa-light fa-angle-down"></i>
                        <select id="exempt_reason" name="exempt_reason">
                            <option value="0">신고 면제 사유</option>
                            <option value="1">간이과세자</option>
                            <option value="2">전년 통신판매 50회 미만</option>
                        </select>
                    </div>
                </label>

                <input type="radio" id="radi_not_reported" name="seller_status" value="3">
                <label for="radi_not_reported">
                    <i class="fa-duotone fa-circle-check"></i>
                    미신고
                </label>

                <input type="hidden" id="mall_register_no" name="mall_register_no">
                <p class="msg-text" style="display: none">숫자를 정확히 입력해주세요</p>
            </div>

        </form>


        <button type="button" class="btn btn-blue btn-comp" onclick="chk_sellerForm()">다음단계로</button>
    </div>
</div>

<script>

    let isAjaxIng = false;
    function chk_sellerForm() {
        if(isAjaxIng) {
            return false;
        }
        isAjaxIng = true;

        $('.msg-text').hide();

        //삭제해야함
        if("<?=$pass?>" == "T"){
            location.href = "<?=base_url('signup/infoBasic')?>";
        }


        let formData = new FormData($('#seller_form')[0]);
        $.ajax({
            url: '<?= base_url("signup/chkSellerForm")?>',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if(data.code == 200){
                    location.href = "<?=base_url('signup/infoBasic')?>";
                } else {
                    err_msg(data.err_id, data.msg);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
            },
            complete: function(jqXHR, textStatus) {
                isAjaxIng = false;
            }
        });
    }

    // + 버튼 클릭 시 필드 추가
    $(document).on('click', '.btn-plus', function() {
        var container = $(this).closest('div').parent();
        var placeholderText = container.attr('id') === 'business_type_container' ? '업태' : '종목';
        var nameAttr = container.attr('id') === 'business_type_container' ? 'business_type[]' : 'business_item[]';

        var newField = `
            <div class="input_busi">
                <input type="text" class="border_gray" placeholder="${placeholderText}" name="${nameAttr}" value="">
                <button type="button" class="btn btn-white btn-close"><i class="fa-regular fa-xmark"></i></button>
                <button type="button" class="btn btn-gray btn-plus"><i class="fa-regular fa-plus"></i></button>
            </div>
        `;

        // 기존 + 버튼 제거
        $(this).closest('.input_busi').find('.btn-plus').remove();

        // 새로운 필드 추가
        container.append(newField);

        // 하나 이상의 필드가 있을 경우 모든 필드에 삭제 버튼 추가
        if (container.children().length > 1) {
            container.children().each(function() {
                if ($(this).find('.btn-close').length === 0) {
                    $(this).find('input').after('<button type="button" class="btn btn-white btn-close"><i class="fa-regular fa-xmark"></i></button>');
                }
            });
        }
    });

    // X 버튼 클릭 시 필드 삭제
    $(document).on('click', '.btn-close', function() {
        var container = $(this).closest('div').parent();
        $(this).parent().remove();

        // 모든 + 버튼 제거
        container.find('.btn-plus').remove();

        // 마지막 필드에 + 버튼 추가
        if (container.children().length > 0) {
            container.children().last().append('<button type="button" class="btn btn-gray btn-plus"><i class="fa-regular fa-plus"></i></button>');
        }

        // 필드가 하나만 남았을 경우 삭제 버튼 제거
        if (container.children().length === 1) {
            container.find('.btn-close').remove();
        }
    });

    function updateSellerNo() {
        let sellerNo = '';
        if ($('#radi_direct_input').is(':checked')) {
            sellerNo = $('#direct_input_number').val();
        } else if ($('#radi_exempt').is(':checked')) {
            sellerNo = $('#exempt_reason').val();
        } else if ($('#radi_not_reported').is(':checked')) {
            sellerNo = '미신고';
        }
        $('#mall_register_no').val(sellerNo);
    }

    $('#direct_input_number').on('input', updateSellerNo);
    $('#exempt_reason').on('change', updateSellerNo);
    $('input[name="seller_status"]').on('change', updateSellerNo);

    let show_img = "";
    $(document).on('change', '#cp_file', function() {
        let file = this.files[0];
        let validFileTypes = ['image/jpeg', 'image/png', 'image/jpg'];

        if (file && validFileTypes.includes(file.type)) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $("#show_file").show();
                show_img = e.target.result;
                $('.msg-text').hide();
            };
            reader.readAsDataURL(file);
        } else {
            swal('업로드 가능한 파일은 jpg, png 파일입니다.');
            $("#show_file").hide();
        }
    });

    $('#show_file').click(function() {
        if(show_img != ""){
            Swal.fire({
                text: "",
                imageUrl: show_img,
                confirmButtonText: `확인`,
            });
        } else {
            swal("등록된 이미지가 없습니다.");
        }
    });



</script>


<?php echo view('common/footer'); ?>
