

<div class="tit_wrap">
    <h6 class="menu01">고객센터</h6>
    <div class="menu02">
        <a href="<?=base_url('/admin/notice')?>" <?php if($pid == "notice_list"||$pid == "notice_write") { echo "class='active'"; } ?>>공지사항</a>
        <a href="<?=base_url('/admin/qna')?>" <?php if($pid == "qna_list"||$pid == "qna_view") { echo "class='active'"; } ?>>Q&A</a>
        <a href="<?=base_url('/admin/msg')?>" <?php if($pid == "msg_list"||$pid == "msg_write") { echo "class='active'"; } ?>>메시지 관리</a>
        <a href="<?=base_url('/admin/lms')?>" <?php if($pid == "lms_log_list") { echo "class='active'"; } ?>>LMS로그</a>
    </div>
</div>