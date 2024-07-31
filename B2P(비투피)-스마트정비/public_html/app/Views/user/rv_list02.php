<?php
echo view('common/header_user');
echo view('common/user_head');
?>

<ul class="tab_wrap">
    <li>
        <a href="./rvList">예약대기</a>
    </li>
    <li class="active">
        <a href="./rvDone">예약완료</a>
    </li>
</ul>

<div class="user_info">
    <h6><strong>강남철</strong>님</h6>
    <div class="color-blue">010-1234-6789</div>
</div>

<div class="user_con">
    <div id="<?php echo $pid ?>">

        <div class="rv_list">
            <a href="./rvConfirm" class="">
                <h6>엔진오일1</h6>
                <p>예약번호<span class="color-blue sm-lg">Ta12354</span><i class="fa-light fa-chevron-right"></i></p>
            </a>
            <a class="nodata">
                <p>예약된 내역이 없습니다.</p>
            </a>
        </div>

    </div>
</div>

<?php
echo view('common/user_tail');
echo view('common/footer');
?>
