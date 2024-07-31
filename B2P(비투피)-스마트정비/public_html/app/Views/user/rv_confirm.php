<?php
echo view('common/header_user');
echo view('common/user_head');
?>


<div id="<?php echo $pid ?>">
    <div class="rv_conrim_form">
        <h6 class="input_title">
            예약정보
            <span class="color-blue">Ta2541863</span>
        </h6>
        <dl>
            <dd>
                <span>주문번호</span>
                <span class="color-gray">100256</span>
            </dd>
            <dd>
                <span>예약자명</span>
                <span class="color-gray">강남철</span>
            </dd>
            <dd>
                <span>연락처</span>
                <span class="color-gray">010-1234-5678</span>
            </dd>
            <dd>
                <span>차량번호</span>
                <span class="color-gray">가1234</span>
            </dd>
        </dl>
        <dl>
            <dd>
                <span>부품코드</span>
                <span class="color-gray">S1025</span>
            </dd>
            <dd>
                <span>상품명</span>
                <span class="color-gray">브레이크 패드</span>
            </dd>
            <dd>
                <span>정비시간</span>
                <span class="color-gray">2023.12.12 09:00</span>
            </dd>
        </dl>
        <dl>
            <dd>
                <span>예약날짜</span>
                <span class="color-gray">2023.12.03 09:00</span>
            </dd>
            <dd>
                <span>지점</span>
                <span class="color-gray">오토 오이시스 영등포점 (A503)</span>
            </dd>
            <dd>
                <span>주소</span>
                <span class="color-gray">서울시 영등포구 제일 영등포점 신기로 401</span>
            </dd>
            <dd>
                <span>전화번호</span>
                <span class="color-gray">02-232-2323</span>
            </dd>
        </dl>
    </div>

   <div class="btn_wrap">
    <a class="btn btn-darkgray" href="./rvWrite">예약 수정/취소</a>
    <a class="btn btn-blue" href="./login">확인</a>
    </div>
</div>



<script>
    
    //달력 예약선택
    $('.able_day').on('click', function() {
        $(".day").removeClass("re_se");
        $(this).addClass("re_se");
    });

</script>


<?php
echo view('common/user_tail');
echo view('common/footer');
?>

