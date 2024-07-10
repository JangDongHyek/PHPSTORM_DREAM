<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script>
    $.ajax({
        url : "<?=G5_URL?>/api/test.php",
        method : "post",
        enctype : "multipart/form-data",
        async : false,
        cache : false,
        data : {
            "_method" : "",
        },
        dataType : "json",
        success: function(res){
            // console.log(res)
            if(!res.success) alert(res.message);
            else {
            }
        }
    });
</script>