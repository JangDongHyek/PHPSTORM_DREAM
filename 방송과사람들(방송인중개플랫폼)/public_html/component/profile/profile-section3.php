<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <section id="profile03">
        <div>
            <h4>보유기술을 선택해 주세요</h4>
            <dl>
                <dd>
                    <button class="select openModalBtn" data-modal="modal3">보유기술</button>

                    <div id="modal3" class="modal">
                        <div class="modal-content">
                            <div class="modal-title">
                                <h5>보유기술을 선택해 주세요</h5>
                                <span class="close"><i class="fa-light fa-xmark"></i></span>
                            </div>
                            <div class="modal-search">
                                <i class="fa-light fa-magnifying-glass"></i><input type="search" placeholder="기술 검색">
                            </div>
                            <div class="modal-scroll">
                                <div class="tabs-container">
                                    <div class="tabs">
                                        <div class="tab" data-tab="tab1">디자인</div>
                                        <div class="tab" data-tab="tab2">마케팅</div>
                                        <div class="tab" data-tab="tab3">번역·통역</div>
                                        <div class="tab" data-tab="tab4">문서·글쓰기</div>
                                        <div class="tab" data-tab="tab5">IT·프로그래밍</div>
                                        <div class="tab" data-tab="tab6">세무·법무·노무</div>
                                        <div class="tab" data-tab="tab7">창업·사업</div>
                                        <div class="tab" data-tab="tab8">운세</div>
                                        <div class="tab" data-tab="tab9">직무역량 레슨</div>
                                        <div class="tab" data-tab="tab10">취업·입시</div>
                                        <div class="tab" data-tab="tab11">투잡·노하우</div>
                                        <div class="tab" data-tab="tab12">취미 레슨</div>
                                        <div class="tab" data-tab="tab13">생활서비스</div>
                                        <div class="tab" data-tab="tab14">영상·사진·음향</div>
                                        <div class="tab" data-tab="tab15">심리상담</div>
                                        <div class="tab" data-tab="tab16">주문제작</div>
                                    </div>
                                    <div class="tab-content">
                                        <div id="tab1" class="content">
                                            <div class="select">
                                                <input type="checkbox" id="checkbox1" name="checkbox1"><label for="checkbox1">Adobe Photoshop</label>
                                                <input type="checkbox" id="checkbox2" name="checkbox2"><label for="checkbox2">Adobe Illustrator</label>
                                                <input type="checkbox" id="checkbox3" name="checkbox3"><label for="checkbox3">Adobe Creative Suite</label>
                                                <input type="checkbox" id="checkbox4" name="checkbox4"><label for="checkbox4">Adobe Dreamweaver</label>
                                                <input type="checkbox" id="checkbox5" name="checkbox5"><label for="checkbox5">Adobe Flash</label>
                                                <input type="checkbox" id="checkbox6" name="checkbox6"><label for="checkbox6">Adobe XD</label>
                                                <input type="checkbox" id="checkbox7" name="checkbox7"><label for="checkbox7">Indesign</label>
                                                <input type="checkbox" id="checkbox8" name="checkbox8"><label for="checkbox8">MicroSoft PowerPoint</label>
                                                <input type="checkbox" id="checkbox9" name="checkbox9"><label for="checkbox9">Paint tool sai</label>
                                                <input type="checkbox" id="checkbox10" name="checkbox10"><label for="checkbox10">sketch up</label>
                                                <input type="checkbox" id="checkbox11" name="checkbox11"><label for="checkbox11">Corel Painter</label>
                                                <input type="checkbox" id="checkbox12" name="checkbox12"><label for="checkbox12">Sketch3</label>
                                                <input type="checkbox" id="checkbox13" name="checkbox13"><label for="checkbox13">Sketchapp</label>
                                                <input type="checkbox" id="checkbox14" name="checkbox14"><label for="checkbox14">Zeplin</label>
                                                <input type="checkbox" id="checkbox15" name="checkbox15"><label for="checkbox15">HTML &amp; CSS</label>
                                                <input type="checkbox" id="checkbox16" name="checkbox16"><label for="checkbox16">Keyshot</label>
                                                <input type="checkbox" id="checkbox17" name="checkbox17"><label for="checkbox17">3D MAX</label>
                                                <input type="checkbox" id="checkbox18" name="checkbox18"><label for="checkbox18">Rhino3D</label>
                                                <input type="checkbox" id="checkbox19" name="checkbox19"><label for="checkbox19">CATIA</label>
                                                <input type="checkbox" id="checkbox20" name="checkbox20"><label for="checkbox20">3D CAD</label>
                                                <input type="checkbox" id="checkbox21" name="checkbox21"><label for="checkbox21">PRO-E</label>
                                                <input type="checkbox" id="checkbox22" name="checkbox22"><label for="checkbox22">Fusion360</label>
                                                <input type="checkbox" id="checkbox23" name="checkbox23"><label for="checkbox23">MAYA</label>
                                                <input type="checkbox" id="checkbox24" name="checkbox24"><label for="checkbox24">Zbrush</label>
                                                <input type="checkbox" id="checkbox25" name="checkbox25"><label for="checkbox25">Cinema4d</label>
                                                <input type="checkbox" id="checkbox26" name="checkbox26"><label for="checkbox26">Redshift</label>
                                                <input type="checkbox" id="checkbox27" name="checkbox27"><label for="checkbox27">Arnold</label>
                                                <input type="checkbox" id="checkbox28" name="checkbox28"><label for="checkbox28">Substance Painter</label>
                                                <input type="checkbox" id="checkbox29" name="checkbox29"><label for="checkbox29">CAD</label>
                                                <input type="checkbox" id="checkbox30" name="checkbox30"><label for="checkbox30">v-ray</label>
                                                <input type="checkbox" id="checkbox31" name="checkbox31"><label for="checkbox31">Figma</label>
                                                <input type="checkbox" id="checkbox32" name="checkbox32"><label for="checkbox32">after effect</label>
                                                <input type="checkbox" id="checkbox33" name="checkbox33"><label for="checkbox33">auto cad</label>
                                                <input type="checkbox" id="checkbox34" name="checkbox34"><label for="checkbox34">blender</label>
                                                <input type="checkbox" id="checkbox35" name="checkbox35"><label for="checkbox35">lumion</label>
                                                <input type="checkbox" id="checkbox36" name="checkbox36"><label for="checkbox36">Live2D Cubism</label>
                                                <input type="checkbox" id="checkbox37" name="checkbox37"><label for="checkbox37">Vtube Studio</label>
                                                <input type="checkbox" id="checkbox38" name="checkbox38"><label for="checkbox38">Procreate</label>
                                                <input type="checkbox" id="checkbox39" name="checkbox39"><label for="checkbox39">Unity</label>
                                                <input type="checkbox" id="checkbox40" name="checkbox40"><label for="checkbox40">Unreal Engine</label>
                                                <input type="checkbox" id="checkbox41" name="checkbox41"><label for="checkbox41">Substance painter</label>
                                                <input type="checkbox" id="checkbox42" name="checkbox42"><label for="checkbox42">Inventor</label>
                                                <input type="checkbox" id="checkbox43" name="checkbox43"><label for="checkbox43">Spark AR</label>
                                                <input type="checkbox" id="checkbox44" name="checkbox44"><label for="checkbox44">QUARKXPRESS</label>
                                                <input type="checkbox" id="checkbox45" name="checkbox45"><label for="checkbox45">인테리어 시공</label>
                                                <input type="checkbox" id="checkbox46" name="checkbox46"><label for="checkbox46">간판 시공</label>
                                                <input type="checkbox" id="checkbox47" name="checkbox47"><label for="checkbox47">ProtoPie</label>
                                                <input type="checkbox" id="checkbox48" name="checkbox48"><label for="checkbox48">SolidWorks</label>
                                                <input type="checkbox" id="checkbox49" name="checkbox49"><label for="checkbox49">Enscape</label>
                                                <input type="checkbox" id="checkbox50" name="checkbox50"><label for="checkbox50">Adobe Substance 3D</label>
                                                <input type="checkbox" id="checkbox51" name="checkbox51"><label for="checkbox51">Adobe Lightroom</label>
                                            </div>
                                        </div>
                                        <div id="tab2" class="content">탭 2 내용</div>
                                        <div id="tab3" class="content">탭 3 내용</div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-btn">
                                <button>선택하기</button>
                            </div>
                        </div>
                    </div>
                </dd>
                <dd>(*최대 20개를 선택해 주세요)</dd>
            </dl>
            <dl>
                <dt class="flex"><strong>보유기술</strong><a class="del">전체삭제</a></dt>
                <dd class="tag">
                    <span>키워드·검색 광고 <a class="del"><i class="fa-light fa-xmark"></i></a></span>
                    <span>인스타그램 관리 <a class="del"><i class="fa-light fa-xmark"></i></a></span>
                    <span>유튜브 관리 <a class="del"><i class="fa-light fa-xmark"></i></a></span>
                </dd>
            </dl>
        </div>
    </section>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {

        },
        data: function(){
            return {
                jl : null,
                filter : {

                },
                data : {

                },
            };
        },
        created: function(){
            this.jl = new JL('<?=$componentName?>');
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            getData: function () {
                var method = "get";
                var filter = JSON.parse(JSON.stringify(this.filter));

                var objs = {
                    _method: method,
                    filter: JSON.stringify(filter)
                };

                var res = ajax("/api/example.php", objs);
                if (res) {
                    this.jl.log(res)
                    this.data = res.response.data
                }
            }
        },
        computed: {

        },
        watch : {

        }
    });
</script>

<style>

</style>