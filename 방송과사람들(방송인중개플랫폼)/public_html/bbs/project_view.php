<? 
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");
$g5['title'] = '프로젝트 의뢰';
include_once('./_head.php');
$name = "project_view";
$pid = "project_list";
?>

<div id="area_project">
    <div class="inr">
        <ul id="area_history"><li><a href="">홈</a></li> <!----> <li><a href="" class="current">프로젝트</a></li></ul>
    </div>

    <project-view primary="<?=$_GET['primary']?>" mb_no="<?=$member['mb_no']?>"></project-view>
</div>

    <div class="modal fade portfolio-container" id="joinViewModal" tabindex="-1" role="dialog" aria-labelledby="joinViewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">

                    <div>
                        <div class="portfolio-header">
                            작품 상세 보기
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="portfolio-grid">
                            <div class="portfolio-info">
                                <h1 class="title">작품명</h1>
                                <p class="winner-badge">1등</p>
                                <p class="description">안녕하세요. 작품 설명은 상세 이미지를 참조 부탁드립니다.<br>
                                    우승작 선정 후 컬러, 서체, 디테일 등 자유롭게 수정 가능합니다. 감사합니다.</p>
                                <div class="profile">
                                    <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로필 이미지">
                                    <span>지원자</span>
                                </div>
                                <button type="button" class="btn-down">
                                    첨부파일 다운로드
                                </button>
                            </div>
                            <div class="portfolio-image">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                                <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<? $jl->vueLoad('area_project',['swiper']); ?>
<? $jl->componentLoad("/project"); ?>


<?php
include_once('./_tail.php');
?>