<a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fa-light fa-bars"></i>
</a>
<nav id="sidebar" class="sidebar-wrapper">
    <div class="bluebar">
        <p>NR GLOBAL</p>
        <span class="active"><i class="fa-solid fa-buildings"></i></span>
        <span><i class="fa-regular fa-user-helmet-safety"></i></span>
    </div>
    <div class="sidebar-content">
        <div class="sidebar-brand">
            <a href="#"><img src="<?=base_url()?>/img/common/logo.svg" alt="엔알글로벌"/></a>
            <div id="close-sidebar">
                <i class="fa-sharp fa-light fa-xmark"></i>
            </div>
        </div>

        <div class="sidebar-header">
            <div class="user-info">
                <p class="user-name">한울시행사</p>
                <p class="user-role">한울 시행사 김드림(dream87)</p>
                <!--시행사(직원)-->
                <p class="user-point flex jc-sb" onclick="location.href=''">
                    <span>참여 프로젝트</span><strong>2건</strong>
                </p>
                <!--시행사(직원)-->
                <!--시공사(담당자)
                <p class="user-zone"><span class="icon icon_grayblue">담당</span> 101동 [24F] A-1</p>
                시공사(담당자)-->
            </div>
        </div>

        <div class="sidebar-menu">
            <!-- sidebar-content  -->
            <div id="side-icon1">
                <ul>
                    <li class="header-menu">
                        <span></span>
                    </li>
                    <!--<li class="sidebar-dropdown ready_bubble">
                        <a href="./index.php" <?php /*if($pid == "index") { echo "class='active'"; }*/?>>
                            <i class="fa-sharp fa-light fa-house"></i>
                            <span>홈</span>
                             <span class="badge badge-pill badge-danger">3</span>
                        </a>
                        <div class="sidebar-submenu" <?php /*if($pid == "px_prescribe1" || $pid == "px_prescribe2"  || $pid == "px_prescribe3"  || $pid == "px_prescribe4"  || $pid == "px_prescribe5") { echo "style='display: block'"; }*/?>>
                            <ul>
                                <li <?php /*if($pid == "px_prescribe1") { echo "class='active'"; }*/?>>
                                    <a href="../med/px.prescribe1.php">탕전처방</a>
                                </li>
                                <li <?php /*if($pid == "px_prescribe2") { echo "class='active'"; }*/?>>
                                    <a href="../med/px.prescribe2.php">환제처방</a>
                                </li>
                                <li <?php /*if($pid == "px_prescribe3") { echo "class='active'"; }*/?>>
                                    <a href="../med/px.prescribe3.php">산제처방</a>
                                </li>
                                <li <?php /*if($pid == "px_prescribe4") { echo "class='active'"; }*/?>>
                                    <a href="../med/px.prescribe4.php">약속처방</a>
                                </li>
                                <li <?php /*if($pid == "px_prescribe5") { echo "class='active'"; }*/?>>
                                    <a href="../med/px.prescribe5.list.php">서술식</a>
                                </li>
                            </ul>
                        </div>
                    </li>-->
                    <li class="sidebar-dropdown">
                        <a href="./index" <?php if($pid == "index") { echo "class='active'"; }?>>
                            <i class="fa-sharp fa-light fa-house-window"></i>
                            <span>대시보드</span>
                        </a>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="./project" <?php if($pid == "project") { echo "class='active'"; }?>>
                            <i class="fa-sharp fa-light fa-rectangle-history-circle-user"></i>
                            <span>프로젝트 관리</span>
                        </a>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="./publicProject" <?php if($pid == "public_project") { echo "class='active'"; }?>>
                            <i class="fa-sharp fa-light fa-magnifying-glass"></i>
                            <span>회사 공개 프로젝트</span>
                        </a>
                    </li>
                    <!--관리자-->
                    <li class="sidebar-dropdown">
                        <a href="./employee" <?php if($pid == "employee") { echo "class='active'"; }?>>
                            <i class="fa-sharp fa-light fa-user-gear"></i>
                            <span>직원 관리</span>
                        </a>
                    </li>
                    <!--관리자-->
                </ul>
            </div>
            <div id="side-icon2">
                <ul>
                    <li class="header-menu">
                        <span></span>
                    </li>
                    <li class="sidebar-dropdown">
                        <a class="flex ai-c jc-sb">
                            <p>개별 프로젝트</p><span class="arrow"></span>
                        </a>
                        <div class="sidebar-submenu" <?php if($pid == "overall" || $pid == "schedule" || $pid == "schedule_weekly" || $pid == "week_task"  || $pid == "payment"  || $pid == "record" || $pid == "invoice" || $pid == "price_list" || $pid == "account" || $pid == "filebox") { echo "style='display: block'"; }?>>
                            <ul>
                                <li <?php if($pid == "overall") { echo "class='active'"; }?>>
                                    <a href="./overall">
                                        <i class="fa-light fa-flag-swallowtail"></i>
                                        <span>종합공정</span>
                                    </a>
                                </li>
                                <li <?php if($pid == "schedule" || $pid == "schedule_weekly" || $pid == "week_task") { echo "class='active'"; }?>>
                                    <a href="./schedule">
                                        <i class="fa-light fa-timeline-arrow"></i>
                                        <span>작업관리</span>
                                    </a>
                                </li>
                                <li <?php if($pid == "payment") { echo "class='active'"; }?>>
                                    <a href="./payment">
                                        <i class="fa-light fa-money-check-dollar"></i>
                                        <span>기성관리</span>
                                    </a>
                                </li>
                                <li <?php if($pid == "record" || $pid == "invoice" || $pid == "price_list") { echo "class='active'"; }?>>
                                    <a href="./record">
                                        <i class="fa-light fa-table"></i>
                                        <span>내역관리</span>
                                    </a>
                                </li>
                                <li <?php if($pid == "account") { echo "class='active'"; }?>>
                                    <a href="./account">
                                        <i class="fa-light fa-users"></i>
                                        <span>계정관리</span>
                                    </a>
                                </li>

                                <li <?php if($pid == "filebox") { echo "class='active'"; }?>>
                                    <a href="./filebox">
                                        <i class="fa-light fa-box-archive"></i>
                                        <span>파일함</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div id="side-icon3">
                <ul>
                    <li class="header-menu">
                        <span></span>
                    </li>
                    <li class="sidebar-dropdown active">
                        <a class="flex ai-c jc-sb">
                            <p>최근 업데이트</p><span class="arrow"></span>
                        </a>
                        <div class="sidebar-submenu" style="display: block;">
                            <ul>
                                <li>
                                    <a href="" class="i_green">하늘마을 주택 단지 작업진행</a>
                                </li>
                                <li>
                                    <a href="" class="i_orange">블루워터 프라자 리모델링</a>
                                </li>
                                <li>
                                    <a href="" class="i_red">블루워터 프라자 리모델링</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>


        <!-- sidebar-menu  -->
    </div>

</nav>