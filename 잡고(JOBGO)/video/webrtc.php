

<!DOCTYPE html>
<html lang="ko">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=5.0,user-scalable=yes,target-densitydpi=medium-dpi">
    <meta http-equiv="page-enter" content="blendTrans(duration=0.3)">
    <meta http-equiv="page-exit" content="blendTrans(duration=0.3)">
    
    <title>헬로닥터</title>

    
    <script src="https://unpkg.com/peerjs@1.4.4/dist/peerjs.min.js"></script>
    <script src="https://dreamforone.co.kr:8443/js/socket.io.js" defer></script>
    
    <script src="https://dreamforone.co.kr:8443/js/jquery-3.5.1.min.js"></script>
    <script src="https://dreamforone.co.kr:8443/js/bootstrap.min.js"></script>
    <script src="https://dreamforone.co.kr:8443/js/sweetalert2.all.min.js"></script>
    <script src="https://dreamforone.co.kr:8443/js/selectordie.min.js"></script>
    <script src="https://dreamforone.co.kr:8443/js/ui-web.js"></script>
    <script src="https://dreamforone.co.kr:8443/js/common.web.js"></script>

    
    
    <link href="https://dreamforone.co.kr:8443/css/swiper-bundle.min.css" rel="stylesheet" type="texthttps://dreamforone.co.kr:8443/css"/>
    <script src="https://dreamforone.co.kr:8443/js/swiper-bundle.min.js"></script>
    <script>
        let isLogout = ""; //
    </script>

    
    <link href="https://dreamforone.co.kr:8443/css/bootstrap.min.css" rel="stylesheet" type="texthttps://dreamforone.co.kr:8443/css"/>
    <link href="https://dreamforone.co.kr:8443/css/selectordie.css" rel="stylesheet" type="texthttps://dreamforone.co.kr:8443/css"/>
    <link href="https://dreamforone.co.kr:8443/css/import.css" rel="stylesheet" type="texthttps://dreamforone.co.kr:8443/css"/>
    <link href="https://dreamforone.co.kr:8443/css/web.css" rel="stylesheet" type="texthttps://dreamforone.co.kr:8443/css"/>
</head>


<body>

<div id="loading" style="display: none">
    <div class="box_wrap">
        <div class="box">
        <img src="/img/loading.svg">
        <p>loading</p>
        </div>
    </div>
</div>



    <style>
        html, body{overflow: hidden;}
        body{background-color: #2A2A2A;}
        #youVideo video{width:100%;}
        #fileSwiper img {cursor: pointer;}
        .btn_box .blueline {background: #2A2A2A;}
    </style>



<header id="header">
            <nav id="gnb">
                <a class="adm_logo">
                    <img src="/img/hospital/admin_logo.svg" alt="">
                </a>
                <ul id="gnb_1dul">
                    <li>
                        <a href="/hospital/remoteList">원격 진료</a>
                        <ul class="gnb_2dul">
                            <li><a href="/hospital/remoteList">예약 신청</a></li>
                            <li><a href="/hospital/remoteReceipt">접수</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/hospital/treatList">진료 내역</a>
                    </li>
                    <li>
                        <a href="/hospital/pxReissue">처방전 재발행</a>
                    </li>
                    <li>
                        <a href="/hospital/calculate">정산</a>
                    </li>
                    <li>
                        <a href="/hospital/admAccount">관리</a>
                        <ul class="gnb_2dul">
                            <li><a href="/hospital/admAccount">계정관리</a></li>
                            <li><a href="/hospital/admSubAccount">서브 계정 관리</a></li>
                            <li><a href="/hospital/admHospital">병원 정보 관리</a></li>
                            <li><a href="/hospital/admBank">정산 계좌 관리</a></li>
                            <li><a href="/hospital/admTreat">진료 예약 관리</a></li>
                            <li><a href="/hospital/admPharmacy">지정 약국 관리</a></li>
                            <li><a href="/hospital/admPatient">지정 환자 관리</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/hospital/reviewList">게시판</a>
                        <ul class="gnb_2dul">
                            <li><a href="/hospital/reviewList">리뷰 관리</a></li>
                            <li><a href="/hospital/csList">CS 문의</a></li>
                            <li><a href="/hospital/notice">공지사항</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="logout_wrap">
                <span class="user_name"></span> 선생님, 반갑습니다.
                <a href="/hospital/logout" class="ic_logout">
                    <img src="/img/hospital/ic_logout.svg" alt="">
                </a>
            </div>
    </header>



<div id="remote_treat" class="container">
    
    <div style="width:100%;float:left;position:fixed;left:0px">
        <iframe src="webrtc_iframe.php?roomId=200" frameborder="0" style="height: 95vh;width: 100vw;"></iframe>
    </div>

    <div class="patient_info">
        <div class="frm_wrap">
            
            
                <div class="half">
                    <dl>
                        <dt>이름</dt>
                        <dd>김드림</dd>
                        <dt>생년월일</dt>
                        <dd>1992-11-23</dd>
                        <dt>성별</dt>
                        <dd>남</dd>
                    </dl>
                    <dl>
                        <dt>나이</dt>
                        <dd>29세</dd>
                        <dt>신장</dt>
                        <dd>160cm</dd>
                        <dt>체중</dt>
                        <dd>50kg</dd>
                    </dl>
                </div>
                <div>
                    <dl>
                        <dt>참고내용 : </dt>
                        <dd class="box">
                            
                                <textarea readonly>ddffffff</textarea>
                            
                            
                        </dd>
                    </dl>
                </div>
                <div>
                    <ul>
                        <li>환자 의료영상 <strong>N</strong><a>보기</a></li>
                        <li>기타 첨부파일 <strong id="etcFileCount">N</strong><a id="linkEtdFile">보기</a></li>
                    </ul>
                </div>
            

            
            <form name="frm01" autocomplete="off" onsubmit="return saveOpinion(this)">
                <input type="hidden" name="idx" value="0">
                <input type="hidden" name="medicalIdx" value="200">
                <input type="hidden" name="doctorIdx" value="1">
                <dl>
                    <dt>주증상 : </dt>
                    <dd>
                        <textarea name="symptom"></textarea>
                    </dd>
                </dl>
                <dl>
                    <dt>현병력 : </dt>
                    <dd>
                        <textarea name="currentHistory"></textarea>
                    </dd>
                </dl>
                <dl>
                    <dt>과거병력 - 고지혈증, 간질환, 당뇨병, 고혈압, 심장질환 : </dt>
                    <dd><textarea name="oldHistoryInput" placeholder="과거병력을 기재해 주십시요"></textarea></dd>
                    
                </dl>
                <dl>
                    <dt>가족력 : </dt>
                    <dd><textarea name="famHistory"></textarea></dd>
                </dl>
                <dl>
                    <dt>진단 : </dt>
                    <dd><textarea name="diagnosis"></textarea></dd>
                </dl>
                <dl>
                    <dt>계획 : </dt>
                    <dd><textarea name="plan"></textarea></dd>
                </dl>
                <dl>
                    <dt>Medication Recommendation :</dt>
                    <dd><textarea name="mediReco"></textarea></dd>
                </dl>
                <dl>
                    <dt>Workup Recommendation :</dt>
                    <dd><textarea name="workupReco"></textarea></dd>
                </dl>
                <div class="btn_box">
                    <button type="button" class="btn small blueline" onclick="history.back();">나가기</button>
                    <button type="submit" class="btn small blue">저장</button>
                </div>
            </form>

        </div>
    </div>
    <div class="btn_set">
        <button onclick="isVideoType = isVideoType?false:true;screenChange();" type="button" id="video-btn">
            <img src="/img/hospital/btn_treat_video.svg">
        </button>
        <button onclick="isAudioType = isAudioType?false:true;audioChange();" id="audio-btn">
            <img src="/img/hospital/btn_treat_mic.svg" alt="켜짐">
        </button>
        <button onclick="chatExit()"><img src="/img/hospital/btn_hang_up.svg"></button>
    </div>

    
    <div class="modal fade" id="etcFileModal" tabindex="-1" aria-labelledby="etcFileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">질환정보 첨부파일</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    
                    <div class="swiper" id="fileSwiper">
                        <div class="swiper-wrapper">
                            
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>



<footer id="footer">
    
</footer>





    <script src="./webcam.js" defer></script>

    <script type="text/javascript">
        $('#gnb #gnb_1dul>li').eq(0).addClass('active');
        $('#gnb .gnb_2dul').remove();

        /*<![CDATA[*/
        const ROOM_ID = "200";
        const users = "doctor01";
        /*]]>*/

        const swiper = new Swiper("#fileSwiper", {
            autoHeight: true,
            spaceBetween: 20,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        //
        document.querySelector("#linkEtdFile").addEventListener("click", etcFileOpen);
        function etcFileOpen() {
            let fileLength = document.querySelectorAll("#fileSwiper img").length;

            if (fileLength > 0) $("#etcFileModal").modal();
            else swal.fire({html: "등록된 첨부파일이 없습니다."});
        }
        //
        document.querySelector("#etcFileCount").innerHTML = (document.querySelectorAll("#fileSwiper img").length > 0)? "Y" : "N";

        //
        function openImgNewTab(img) {
            let src = img.getAttribute("src");
            window.open(src);
        }

        //
        function saveOpinion(f) {
            let submit = false;
            let textBox = document.querySelectorAll("form[name=frm01] textarea");
            for (let i=0; i<textBox.length; i++) {
                if (textBox[i].value != "") submit = true;
            }

            if (!submit) {
                swal.fire({html: "입력된 진료소견이 없습니다.", confirmButtonText : '확인',});
                return false;
            }

            callPageLoading(1);
            setTimeout(function() {
                let formData = new FormData(f);
                let errMsg = "저장에 실패했습니다.<br>잠시 후 다시 시도해 주세요.";
                $.ajax({
                    url: "/hospital/saveMedicalOpinion",
                    data: formData,
                    type: "POST",
                    async: false,
                    enctype: "multipart/form-data",
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        let data = JSON.parse(response);
                        if (data.result) {
                            document.querySelector("form[name=frm01] input[name=idx]").value = data.idx;
                            swal.fire({html: "저장이 완료되었습니다.", confirmButtonText : '확인'});
                        }
                        else swal.fire({html: errMsg, confirmButtonText : '확인'});
                    },
                    error: function(xhr) {
                        console.log("[serverUploadImage] : [error] : ", xhr);
                        swal.fire({html: errMsg, confirmButtonText : '확인',});
                    },
                    complete:function(data,textStatus) {
                        callPageLoading();
                    }
                });
            }, 500);

            return false;
        }
    </script>

</body>

</html>