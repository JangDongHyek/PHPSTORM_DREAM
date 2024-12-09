<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<style>
    /*loading*/
    #loading{content: ""; display: block; width: 100%; height: 100vh; background-color: rgba(0,0,0,0.5); position: fixed; left: 0; top: 0; z-index: 999999;}
    #loading .box_wrap{position: fixed; top: 45%; left: 50%; transform: translate(-50%,-50%); display: block; text-align: center; width: 70px; height: 70px;}
    #loading .box{display:block; background-color: #fff; width: 70px; height: 70px; border-radius:5px; position: relative;}
    #loading img{width:37px; height: auto;	margin:20px auto 7px auto;}
    #loading p{font-size: 0.8em; line-height: 1em; font-weight: 500; color: #FFF;opacity: 0.5}

    #loading .box{
        box-shadow: 1px 1px 0 rgba(0,0,0,0.2), -1px -1px 0 rgba(0,0,0,0.2);
        width: 100%;
        animation: scale 1s infinite ease-in-out;
        animation-direction: alternate;
        background: linear-gradient(to right,#D66157, #CE3F6A);
    }
    @keyframes scale {
        0%   { transform: scale(0.9) }
        100%  { transform: scale(1) }
    }
</style>

<script>
    /**
     * 로딩
     * @param show: 1(show) / 0(hide)
     */
    const showLoading = (show) => {
        let loading = document.getElementById("loading");
        if (loading) loading.style.display = (show) ? "block" : "none";
    }
</script>

<div id="loading" style="display: none;">
    <div class="box_wrap">
        <div class="box">
            <img src="<?=G5_URL?>/img/logo_mark.svg">
            <p>loading</p>
        </div>
    </div>
</div>


</body>
    <script>
        AOS.init();
    </script>
</html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다. ?>