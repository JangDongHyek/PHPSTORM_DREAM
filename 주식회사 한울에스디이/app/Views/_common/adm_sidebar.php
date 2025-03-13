<a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fa-light fa-bars"></i>
</a>
<nav id="sidebar" class="sidebar-wrapper">
    <div class="bluebar">
        <p>NR GLOBAL</p>
    </div>
    <div class="sidebar-content">
        <div class="sidebar-brand">
            <a href="#"><img src="<?=base_url()?>/img/common/logo_white.svg" alt="엔알글로벌"/></a>
            <div id="close-sidebar">
                <i class="fa-sharp fa-light fa-xmark"></i>
            </div>
        </div>

        <div class="sidebar-header">
            <div class="user-info">
                <p class="user-name">플랫폼 관리자</p>
                <a class="btn btn-mini btn-gray" href="./admInfo">관리자정보 <i class="fa-light fa-gear"></i></a>
            </div>
        </div>

        <div class="sidebar-menu">
            <!-- sidebar-content  -->
            <div id="side-icon1">
                <ul>
                    <li class="header-menu">
                        <span></span>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="./member" <?php if($pid == "adm_member"  || $pid == "adm_member_form") { echo "class='active'"; }?>>
                            <i class="fa-sharp fa-light fa-address-book"></i>
                            <span>서비스 이용자 관리</span>
                        </a>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="./faq" <?php if($pid == "adm_faq" || $pid == "adm_faq_form") { echo "class='active'"; }?>>
                            <i class="fa-sharp fa-light fa-comments-question-check"></i>
                            <span>자주 묻는 질문</span>
                        </a>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="./qna" <?php if($pid == "adm_qna" || $pid == "adm_qna_view") { echo "class='active'"; }?>>
                            <i class="fa-sharp fa-light fa-headset"></i>
                            <span>1:1 문의</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>


        <!-- sidebar-menu  -->
    </div>

</nav>