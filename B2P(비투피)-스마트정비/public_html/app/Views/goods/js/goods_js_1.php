<script>

    // 카테고리 가져오기
    let cateName = "";
    function getCategory(cate_index, cate_no, cate_name = '', is_last = false) {
        if (isAjaxIng) {
            return;
        }
        isAjaxIng = true;

        $('#' + cate_index + '> li').removeClass('is-selected');
        $('li[data-cate_no="' + cate_no + '"]').addClass('is-selected');


        // is_last가 true면 최종선택된 카테고리
        if (is_last == true) {
            isAjaxIng = false;
            cateName = cate_name;
            getGmAcCategory(cate_no);
        } else {
            let this_index = Number(cate_index.replace("cate", ''));
            let next_index = this_index+1;
            $("#cate"+next_index).html("<li class=\"list-item\" role=\"presentation\"><button class=\"button__category\" type=\"button\">로딩중</button></li>");

            let api_type = "<?=GMAC?>";
            $.ajax({
                url: "<?=base_url('/goods/getCategory')?>",
                type: 'POST',
                dataType: 'json',
                data: {
                    'api_type': api_type,
                    "cate_no": cate_no,
                },
                success: function(data) {
                    if (data.status == "200") {

                        setCategory(next_index, data.body);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error occurred:', status);
                },
                complete: function() {
                    isAjaxIng = false;
                }
            });
        }
    }

    // 카테고리 리스트에 뿌리기
    function setCategory(index, jsonData) {
        for(let i=index; i<6; i++){
            $("#cate" + i).html("");
        }
        let html = "";
        let cate = "cate" + index;
        let data = JSON.parse(jsonData);
        $.each(data.sdCategoryTree, function(index, item) {
            html += "<li class=\"list-item\" role=\"presentation\" data-cate_no=\"" + item.SDCategoryCode + "\">";
            html += "<button class=\"button__category\" type=\"button\" onclick=\"getCategory('" + cate + "','" + item.SDCategoryCode + "','" + item.SDCategoryName + "', " + item.IsLeafCategory + ")\">" + item.SDCategoryName + "</button>";
            if(item.IsLeafCategory == false){
                html += "<button type=\"button\" class=\"button__category--more\"><i class=\"fa-light fa-chevron-right\"></i></button>";
            }
            html += "</li>";
        });
        $("#" + cate).html(html);
    }

    // 진짜 카테고리 검색해서 가져오기
    function getGmAcCategory(cate_no){
        if (isAjaxIng) {
            return;
        }
        isAjaxIng = true;

        let api_type = "<?=GMAC?>";
        $.ajax({
            url: "<?=base_url('/goods/getGmAcCategory')?>",
            type: 'POST',
            dataType: 'json',
            data: {
                'api_type': api_type,
                "cate_no": cate_no,
            },
            success: function(data) {
                if (data.status == "200") {
                    let body = JSON.parse(data.body);
                    try {
                        let gmarketCatCode = body.MatchedCategory.Gmkt[0].catCode;
                        $("#gm_cate").val(gmarketCatCode);
                    } catch (e) {
                    }

                    try {
                        let iacCatCode = body.MatchedCategory.Iac[0].catCode;
                        $("#ac_cate").val(iacCatCode);
                    } catch (e) {
                    }

                    try {
                        $("#esm_cate").val(cate_no);
                    } catch (e) {

                    }

                    $("#cate_name").val(cateName);
                }

            },
            error: function(xhr, status, error) {
                console.error('Error occurred:', status);
            },
            complete: function() {
                isAjaxIng = false;
            }
        });
    }



    $('#price').on('input', function() {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
        originalPrice = parseInt($(this).val()) || 0;
        calculateFinalPrice();
    });

    // 할인설정
    $("input[type='radio'][name='sellerDiscount']").on('change', function () {
        let selectedValue = $(this).val();
        if (selectedValue == "T") {
            $("#div_sellerDiscount").show();
        } else {
            $("#div_sellerDiscount").hide();
        }
    });

    // 특정기간 할인 체크박스 변경 시 이벤트 처리
    $('#sellerDiscountDday').change(function() {
        if ($(this).is(':checked')) {
            $('#discountDates').show();
        } else {
            $('#discountDates').hide();
        }
    });

    // 할인 가격 또는 할인 타입 변경 시 이벤트 처리
    $('#discountprice, #sellerDiscountType').on('input change', function() {
        calculateFinalPrice();
    });

    let originalPrice = parseInt($('#price').val().replace(/,/g, '')) || 0;
    function calculateFinalPrice() {
        let discountPrice = parseInt($('#discountprice').val().replace(/,/g, '')) || 0;
        let discountType = $('#sellerDiscountType').val();
        let discountAmount = 0;
        let finalPrice = originalPrice;

        if (discountType == '2') { // 퍼센트 할인
            discountAmount = Math.round((originalPrice * discountPrice) / 100);
        } else if (discountType == '1') { // 원 할인
            discountAmount = discountPrice;
        }

        finalPrice = originalPrice - discountAmount;

        if (finalPrice < 0) {
            finalPrice = 0;
        }

        finalPrice = finalPrice.toLocaleString();
        discountAmount = discountAmount.toLocaleString();

        $('#finalPrice').text(finalPrice + '원');
        $('#discountAmount').text('(' + discountAmount + '원 할인)');
    }




    // useGmarket 체크박스 이벤트 핸들러
    $('#useGmarket').change(function() {
        if(w == ""){
            $('#div_gmarket').css('display','none');
        } else {
            if ($(this).is(':checked')) {
                $('#div_gmarket').css('display','flex');
            } else {
                $('#div_gmarket').css('display','none');
            }
        }


    });

    // useAuction 체크박스 이벤트 핸들러
    $('#useAuction').change(function() {
        if(w == ""){
            $('#div_auction').css('display','none');
        } else {
            if ($(this).is(':checked')) {
                $('#div_auction').css('display','flex');
            } else {
                $('#div_auction').css('display','none');
            }
        }

    });

    // useAuction 체크박스 이벤트 핸들러
    $('#sellerDiscountDday').change(function() {
        if ($(this).is(':checked')) {
            $('#div_sellerDiscountDday').show();
        } else {
            $('#div_sellerDiscountDday').hide();
        }
    });

    $('input[name="periodValue"]').change(function() {
        var days = parseInt($(this).val());
        var today = new Date();
        var endDate = new Date();
        endDate.setDate(today.getDate() + days);

        var day = ("0" + endDate.getDate()).slice(-2);
        var month = ("0" + (endDate.getMonth() + 1)).slice(-2);
        var year = endDate.getFullYear();

        var formattedDate = year + "-" + month + "-" + day;
        $('#endSellDate').val(formattedDate);
    });
</script>