<script>
    const w = "<?=$w?>";

    let isAjaxIng = false;

    // 판매가 입력하면 수수료 자동계산
    $('#price').on('input', function() {
        let value = Number($(this).val().replace(/[^0-9]/g,""));
        $(this).val(value.toLocaleString());
    });

    $(document).ready(function() {
    });

    function save_goods() {
        showLoading(true);

        let formData = new FormData($('#item_form')[0]);
        formData.append("api_type","<?=GMAC?>");
        $.ajax({
            url: '<?= base_url("goods/setGoods")?>',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if(data.code == 200 || data.code == 201 || data.code == 202){
                    swal('등록되었습니다.').then((result) => {
                        window.location.href = "<?=base_url("goods")?>";
                    });;
                } else {
                    swal(data.msg);
                }
                console.log(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
            },
            complete: function(jqXHR, textStatus) {
                isAjaxIng = false;
                showLoading(false);
            }
        });
    }



    // 판매기간
    $("input[type='radio'][name='sellingPeriod']").on('change', function () {
        let selectedValue = $(this).val();
        if (selectedValue == "T") {
            $("#div_sellingPeriod").show();
        } else {
            $("#div_sellingPeriod").hide();
        }
    });

    // 옵션설정
    $("input[type='radio'][name='useSelectOption']").on('change', function () {
        let selectedValue = $(this).val();
        if (selectedValue == "T") {
            $("#div_selectOption").show();
        } else {
            $("#div_selectOption").hide();
        }
    });

    // 옵션설정
    $("input[type='radio'][name='useTextOption']").on('change', function () {
        let selectedValue = $(this).val();
        if (selectedValue == "T") {
            $("#div_option").show();
        } else {
            $("#div_option").hide();
        }
    });



</script>
