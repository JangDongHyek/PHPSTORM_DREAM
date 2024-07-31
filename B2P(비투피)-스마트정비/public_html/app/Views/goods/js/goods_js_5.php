<script>
    $("input[type='radio'][name='use_comparison']").on('change', function () {
        if ($(this).val() === 'T') {
            $("#div_use_coupon").show();
        } else {
            $("#div_use_coupon").hide();
        }
    });
</script>