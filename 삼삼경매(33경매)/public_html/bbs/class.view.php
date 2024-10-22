<?
include_once("./_common.php");
$g5['title'] = '삼삼 CLASS';
$co_id = 'class';
include_once(G5_PATH.'/_head.php');
?>

    <div class="area_expert" id="app">
        <div class="expert_view">
            <div class="view">
                <div class="area_img">
                    <div class="img"><img :src="data.file.src"></div>
                    <div class="title">
                        <!--<span>{{data.category}}</span>-->
                        <p>{{data.subject}}</p>
                    </div>
                </div>
                <div style="background:#eaedf2">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist" style="margin:0 !important">
                        <li class="active" data-target="#tab-view"><a href="#tab-view">강의 소개</a></li>
                        <li data-target="#tab-info"><a href="#tab-info">커리큘럼</a></li>
                        <li data-target="#tab-schedule"><a href="#tab-schedule">교육일정</a></li>
                        <li data-target="#tab-refund"><a href="#tab-refund">환불정책</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane" id="tab-view">
                            <!--상품정보 탭-->
                            <div id="product-details">
                                <div class="details" v-html="data.curriculum"></div>
                                <!--<button type="button" class="btn" name="btnToggle">강의소개 자세히 보기 <i class="fa-light fa-angle-down"></i></button>-->
                            </div>
                        </div>
                        <div v-html="data.introduction" class="tab-pane" id="tab-info"></div>
                        <div class="tab-pane" id="tab-schedule">
                            <!--교육일정-->
                            <img src="../images/class03.png" />
                        </div>
                        <div class="tab-pane" id="tab-refund">
                            <!--환불정책-->
                            <img src="../images/class04.png" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="info">
                <div class="sticky">
                    <div class="area_img">
                        <div class="img"><img :src="data.file.src"></div>
                        <div class="title">
                            <span>{{data.category}}</span>
                            <p>{{data.subject}}</p>
                        </div>
                    </div>
                    <div class="area_info">
                        <h5>{{data.subject}}</h5>
						<!--//업체 요청으로 당분간 고정 문구로 변경 2024.10.07<h5>[{{data.category}}] {{data.subject}}</h5>-->
                        <dl>
                            <dt>신청기간</dt>
							<dd>수시접수(7기까지 선착순모집 후 종결)</dd>
                            <!--//업체 요청으로 당분간 고정 문구로 변경 2024.10.07<dd>
                                {{data.request_s_date}} ~ {{data.request_e_date}}
                                <span id="countdown" class="red">10일 12:43:39 남음</span>
                                <span class="black" v-if="request_check">신청마감</span>
                            </dd>-->
                            <dt>교육기간</dt>
                            <dd>매월 3주진행(자세한일정 추후안내)</dd>
							<!--//업체 요청으로 당분간 고정 문구로 변경 2024.10.07<dd>{{data.education_s_date}} ~ {{data.education_e_date}}</dd>-->
                            <dt>강사</dt>
                            <dd>{{data.teacher}}</dd>
                        </dl>
                        <div class="area_price">
                            <div>2,000000원</div>
                            <div>
                                <p>월 166,667원</p>
                                <span>12개월 할부시</span>
                            </div>
                        </div>
                        <div class="btn_wrap">
                            <button class="btn" @click="form_reqeust">클래스 신청하기</button>
                            <?php if ($is_admin) {  ?>
                                <button class="btn btn_line" onclick="location.href='<?php echo G5_BBS_URL ?>/class.register.list.php'">신청리스트</button>
                            <?php }  ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>
                            
<script>
// Vue 인스턴스 생성
document.addEventListener('DOMContentLoaded', function(){
    new Vue({
        el: '#app',
        data: {
            idx : "<?=$_GET['id']?>",
            base_url : "<?=G5_URL?>",
            data : {},
            datas : [],
            filter : [],
            total : [],
            checks : [],
            all_check : false,
        },
        created : function() {
            this.getData();
        },
        mounted : function() {
            $('button[name="btnToggle"]').click(function(){
                $('#product-details .details').toggleClass('expanded');

                // 버튼 텍스트와 아이콘 변경
                if($('#product-details .details').hasClass('expanded')){
                    $(this).html('강의소개 숨기기 <i class="fa-light fa-angle-up"></i>');
                } else {
                    $(this).html('강의소개 자세히 보기 <i class="fa-light fa-angle-down"></i>');
                }
            });

            // 타겟 시간을 현재 시간으로부터 10일 후 12:43:39으로 설정
            var targetDate = new Date(this.data.request_e_date + " 23:59:59");

            function updateCountdown() {
                var now = new Date().getTime();
                var distance = targetDate - now;

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // 표시할 시간을 두 자리 형식으로 변환
                hours = hours < 10 ? '0' + hours : hours;
                minutes = minutes < 10 ? '0' + minutes : minutes;
                seconds = seconds < 10 ? '0' + seconds : seconds;

                // 카운트다운 표시 업데이트
                $('#countdown').html(days + '일 ' + hours + ':' + minutes + ':' + seconds + ' 남음');

                // 시간이 다 되면 메시지를 표시
                if (distance < 0) {
                    clearInterval(x);
                    $('#countdown').html("시간이 다 되었습니다.");
                }
            }

            // 1초마다 카운트다운 업데이트
            var x = setInterval(updateCountdown, 1000);
        },
        methods: {
            form_reqeust : function() {
                if(this.request_check) {
                    alert("신청기간이 마감되었습니다.");
                    return false;
                }
                location.href= this.base_url + '/bbs/class.register.form.php?id=' + this.data._idx
            },
            postData : function() {
                var method = this.data._idx ? "put" : "post";
                var obj = JSON.parse(JSON.stringify(this.data));

                var objs = {
                    _method : method,
                    obj : JSON.stringify(obj),
                };

                var res = this.ajax(this.base_url + "/api/",objs);

                if(res) {
                    console.log(res)
                }
            },
            deletesData : function() {
                var method = "deletes";

                if(this.checks.length <= 0) {
                    alert("하나 이상 선택하셔야합니다.");
                    return false;
                }

                var objs = {
                    _method : method,
                    arrays : JSON.stringify(this.checks)
                };

                var res = this.ajax(this.base_url + "/api/",objs);
                if(res) {
                    alert("삭제되었습니다.");
                    window.location.reload();
                }
            },
            getData : function() {
                var method = "get";

                var objs = {
                    _method : method,
                    _idx : this.idx
                };

                var res = this.ajax(this.base_url + "/api/g5_class.php",objs);
                if(res) {
                    console.log(res)
                    this.data = res.data;
                }
            },
            getsData : function() {
                var method = "gets";

                var objs = {
                    _method : method,
                    filter : this.filter
                };

                var res = this.ajax(this.base_url + "/api/",objs);
                if(res) {
                    console.log(res)
                    this.datas = res.datas.datas;
                    this.total = res.datas.count;
                }
            },
            ajax : function(url,objs) {
                var form = new FormData();
                if(url.indexOf(".php") == -1) url = url + ".php";
                for(var i in objs) {
                    form.append(i, objs[i]);
                }

                var result = null;
                $.ajax({
                    url : url,
                    method : "post",
                    enctype : "multipart/form-data",
                    processData : false,
                    contentType : false,
                    async : false,
                    cache : false,
                    data : form,
                    dataType : "json",
                    success: function(res){
                        if(!res.success) alert(res.message);
                        else {
                            result = res;

                            if(res.data) {
                                var obj = res.data;
                                for(field in obj) {
                                    if(field.indexOf("_id") !== -1) continue;
                                    try {
                                        obj[field] = JSON.parse(obj[field]);
                                    } catch (e) {

                                    }
                                }
                                res.data = obj;
                            }
                        }
                    }
                });

                return result;
            }
        },
        computed : {
            request_check : function() {
                var targetDate = new Date(this.data.request_e_date + " 23:59:59");
                var newDate = new Date();

                return newDate > targetDate;
            }
        },
        watch : {
            all_check : function() {
                this.checks = [];

                if(this.all_check) {
                    this.datas.forEach((item) => {
                        this.checks.push(item._idx);
                    });
                }
            }
        }

    });
}, false);
</script>

    <script>
        //상세보기
        $(document).ready(function(){

        });

        //카운트
        $(document).ready(function () {
            
        });

    </script>

    <script>
        //탭 스크롤
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.nav-tabs li');
            const sections = document.querySelectorAll('.tab-pane');

            // Click event to scroll to the section with 200px offset
            tabs.forEach(tab => {
                tab.addEventListener('click', function(event) {
                    event.preventDefault();

                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('active'));

                    // Add active class to clicked tab
                    tab.classList.add('active');

                    // Get the target section
                    const targetId = tab.getAttribute('data-target');
                    const targetSection = document.querySelector(targetId);

                    // Scroll to the target section with a 200px offset from the top
                    const offsetTop = targetSection.offsetTop - 0;

                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth' // Smooth scrolling
                    });
                });
            });

            // IntersectionObserver to highlight tabs based on scroll position
            const observerOptions = {
                root: null,
                rootMargin: '-0px 0px 0px 0px', // Adjust rootMargin to consider the 200px offset
                threshold: 0.5
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    const targetSection = entry.target;
                    const tab = document.querySelector(`.nav-tabs li[data-target="#${targetSection.id}"]`);

                    if (entry.isIntersecting) {
                        tabs.forEach(t => t.classList.remove('active'));
                        tab.classList.add('active');
                    }
                });
            }, observerOptions);

            sections.forEach(section => observer.observe(section));
        });
    </script>

<?
include_once(G5_PATH.'/_tail.php');
?>