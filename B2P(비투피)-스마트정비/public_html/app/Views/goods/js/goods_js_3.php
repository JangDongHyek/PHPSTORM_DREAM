<script>
    $('#officialNotice_all').change(function() {
        if (this.checked) {
            $('textarea[name="officialNoticeItemelementValue[]"]').val('상품 상세설명 참조');
        } else {
            $('textarea[name="officialNoticeItemelementValue[]"]').val('');
        }
    });


    // 옵션설정

    $("input[type='radio'][name='buyableQuantity']").on('change', function () {
        let selectedValue = $(this).val();
        if (selectedValue == "T") {
            $("#div_buyableQuantity").show();
        } else {
            $("#div_buyableQuantity").hide();
        }
    });

    $("input[type='radio'][name='buyableQuantityChild']").on('change', function () {
        let selectedValue = $(this).val();
        if (selectedValue == "1") {
            $("#p_buyableQuantity").html('1회 구매 시 최대 <input type="text" class="border_gray" style="width:100px" value="0" id="buyableQuantityQty" name="buyableQuantityQty" placeholder="최대 999">개 까지 구매가능(최대 999개)');
        } else if(selectedValue == "3") {
            $("#p_buyableQuantity").html('구매자 1명이 <input type="text" class="border_gray" style="width:100px" value="0" id="buyableQuantityUnitDate" name="buyableQuantityUnitDate" placeholder="최대 210"> 일 동안 최대 <input type="text" class="border_gray" style="width:100px" value="0" id="buyableQuantityQty" name="buyableQuantityQty" placeholder="최대 999">개 까지 구매가능');
        } else {
            $("#p_buyableQuantity").html('ID당 최대 <input type="text" class="border_gray" style="width:100px" value="0" id="buyableQuantityQty" name="buyableQuantityQty" placeholder="최대 999">개 까지 구매 가능');
        }
    });



    const allSearch = document.getElementById("all_search");
    function getBrand() {
        if(isAjaxIng){
            return;
        }
        isAjaxIng = true;
        let brandName = $("#input_brandSearch").val();
        if(brandName == ""){
            isAjaxIng = false;
            return;
        }

        let api_type = "<?=GMAC?>";
        let formData = new FormData();
        formData.append("api_type", api_type);
        formData.append("brandName", brandName);

        $.ajax({
            url: "<?=base_url('/goods/getBrand')?>",
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.code == "200") {
                    const bodyArr = JSON.parse(data.body);
                    populateCategories(bodyArr['makers']);
                } else {
                    console.error('Unexpected response format:', data);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error occurred:', status);
            },
            complete: function() {
                isAjaxIng = false;
            }
        });

        toggleAllSearch();
    }

    function populateCategories(makers) {
        let brandList = "";
        let makerList = "";
        let productBrandList = "";

        makers.forEach(item => {
            brandList += `<li class="list-item" role="presentation" data-brandno="${item.brandNo}" data-brandname="${item.brandName}" data-makername="${item.makerName}" data-productbrandname="${item.productBrandName}">
                        <button class="button__category" type="button" onclick="selectValue(this)">${item.brandName}</button>
                      </li>`;
            makerList += `<li class="list-item" role="presentation" data-brandno="${item.brandNo}" data-brandname="${item.brandName}" data-makername="${item.makerName}" data-productbrandname="${item.productBrandName}">
                        <button class="button__category" type="button" onclick="selectValue(this)">${item.makerName}</button>
                      </li>`;
            if (item.productBrandName) {
                productBrandList += `<li class="list-item" role="presentation" data-brandno="${item.brandNo}" data-brandname="${item.brandName}" data-makername="${item.makerName}" data-productbrandname="${item.productBrandName}">
                                   <button class="button__category" type="button" onclick="selectValue(this)">${item.productBrandName}</button>
                                 </li>`;
            } else {
                productBrandList += `<li class="list-item" role="presentation" data-brandno="${item.brandNo}" data-brandname="${item.brandName}" data-makername="${item.makerName}" data-productbrandname="${item.productBrandName}">
                                   <button class="button__category" type="button" onclick="selectValue(this)">-</button>
                                 </li>`;
            }
        });

        $("#brand_cate1").html(brandList);
        $("#brand_cate2").html(makerList);
        $("#brand_cate3").html(productBrandList);
    }

    function selectValue(element) {
        let brandNo = $(element).parent().data('brandno');
        let brandName = $(element).parent().data('brandname');
        let makerName = $(element).parent().data('makername');
        let productBrandName = $(element).parent().data('productbrandname');

        $("#brandNo").val(brandNo);
        $("#brandName").val(brandName);
        $("#makerName").val(makerName);
        $("#productBrandName").val(productBrandName);

        $("#span_brandName").text(brandName);
        $("#span_makerName").text(makerName);
        $("#span_productBrandName").text(productBrandName);

        $("#div_selectedBrand").show();
        toggleAllSearch();
    }

    function toggleAllSearch() {
        if (allSearch.style.display === "none" || allSearch.style.display === "") {
            allSearch.style.display = "block";
        } else {
            allSearch.style.display = "none";
        }
    }
</script>