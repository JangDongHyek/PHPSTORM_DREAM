var order_stock_check = function() {
    var result = "";
    $.ajax({
        type: "POST",
        url: g5_url+"/shop/ajax.orderstock.php",
        cache: false,
        async: false,
        success: function(data) {
            result = data;
        }
    });
    return result;
}

var price_check = function(od_price, send_cost, send_cost2, send_coupon, temp_point) {
    var result = "";
    $.ajax({
        type: "POST",
        url: g5_url + "/shop/ajax.price_check.php",
        data: {
            chk_price: od_price,
            chk_cost: send_cost,
            chk_cost2: send_cost2,
            chk_coupon: send_coupon,
            chk_point: temp_point
        },
        cache: false,
        async: false,
        success: function(data) {
            result = data;
        }
    });
    return result;
}
