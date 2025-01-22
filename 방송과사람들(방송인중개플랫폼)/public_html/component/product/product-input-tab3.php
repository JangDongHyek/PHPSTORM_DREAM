<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div id="item_write">
            <div class="inr v2">
                <h3>재능등록</h3>
                <div class="snb">
                    <ul class="list_step">
                        <li id="">
                            <a href="" @click="event.preventDefault(); $emit('changeTab',1);">
                                <em>1</em>
                                <span>기본정보</span>
                            </a>
                        </li>
                        <li id="">
                            <a href="" @click="event.preventDefault(); $emit('changeTab',2);">
                                <em>2</em>
                                <span>서비스 설명</span>
                            </a>
                        </li>
                        <li id="" class="active">
                            <a href="" @click="event.preventDefault(); $emit('changeTab',3);">
                                <em>3</em>
                                <span>이미지 등록</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="box_list">
                    <div class="box_content">
                        <div class="box_write02">
                            <h4 class="b_tit">메인이미지등록
                                <em><i class="point" name="point">{{ product.main_image_array.length }}</i>/1</em>
                                <span v-if="product.main_image_array.length > 1" style="color : red;">메인 이미지는 최대 1장입니다.</span>
                            </h4>
                            <div class="cont">
                                <div class="area_box">

                                    <!-- 처음화면에서는 안보였다가 이미지 등록하면 나타나게 해주세요 ~~ -->
                                    <ul class="photo_list" id="file_list">
                                        <li class="file_1" v-for="item,index in product.main_image_array">
                                            <div class="area_img">
                                                <img :src="item.preview ? item.preview : jl.root+item.src">
                                                <div class="area_delete" @click="product.main_image_array.splice(index,1)" v-if="!admin"><span class="sound_only">삭제</span></div>
                                            </div>
                                        </li>
                                    </ul>
                                    <!-- //이미지 미리보기 -->

                                    <template v-if="!admin">

                                        <input type="file" name="file" id="input_file" multiple accept="*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;"
                                               ref="main_image_array" @change="jl.changeFile($event,product,'main_image_array')">
                                        <div id="fileDrag" class="img_wrap" @click="$refs.main_image_array.click();"
                                             @drop.prevent="jl.dropFile($event,product,'main_image_array')" @dragover.prevent @dragleave.prevent>
                                            <div class="area_txt">
                                                <div class="area_img"><img
                                                            :src="`${jl.root}/theme/basic_app/img/app/icon_upload.svg`"></div>
                                                <span class="w">마우스로 드래그해서 파일을 추가하세요.</span>
                                                <span class="m">파일을 추가하세요.</span>
                                            </div>
                                        </div>
                                        <em>※이미지 권장 비율(4:3)</em>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box_content">
                        <div class="box_write02">
                            <h4 class="b_tit">상세이미지등록
                                <em><i class="point" name="subpoint">{{ product.content_image_array.length }}</i>/10</em>
                                <span v-if="product.content_image_array.length > 10" style="color : red;">상세이미지는 최대 10장입니다.</span>
                            </h4>
                            <div class="cont">
                                <div class="area_box">

                                    <!-- 처음화면에서는 안보였다가 이미지 등록하면 나타나게 해주세요 ~~ -->
                                    <ul class="photo_list" id="file_list">
                                        <li class="file_1" v-for="item,index in product.content_image_array">
                                            <div class="area_img">
                                                <img :src="item.preview ? item.preview : jl.root+item.src">
                                                <div class="area_delete" @click="product.content_image_array.splice(index,1)" v-if="!admin"><span class="sound_only">삭제</span></div>
                                            </div>
                                        </li>
                                    </ul>
                                    <!-- //이미지 미리보기 -->

                                    <template v-if="!admin">
                                        <input type="file" name="file" id="input_file" multiple accept="*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;"
                                               ref="content_image_array" @change="jl.changeFile($event,product,'content_image_array')">
                                        <div id="fileDrag" class="img_wrap" @click="$refs.content_image_array.click();"
                                             @drop.prevent="jl.dropFile($event,product,'content_image_array')" @dragover.prevent @dragleave.prevent>
                                            <div class="area_txt">
                                                <div class="area_img"><img
                                                            :src="`${jl.root}/theme/basic_app/img/app/icon_upload.svg`"></div>
                                                <span class="w">마우스로 드래그해서 파일을 추가하세요.</span>
                                                <span class="m">파일을 추가하세요.</span>
                                            </div>
                                        </div>
                                        <em>※이미지 권장 사이즈: 800 x 3200px</em>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box_content">
                        <div class="box_write02">
                            <h4 class="b_tit">동영상 등록
<!--                                <em><i class="point" name="subpoint">{{product.movie_file_array.length}}</i>/8</em>-->
                                <em><i class="point" name="subpoint">{{product.movie_link.length}}</i>/10</em>
                                <!--<p><input type="checkbox"><label>링크 등록</label></p>--></h4>
                            <div class="cont">
                                <div class="area_box">
<!--                                    <div class="video_active box_dashed">-->
<!--                                        <ul>-->
<!--                                            <li v-for="item,index in product.movie_file_array">-->
<!--                                                <p>{{ item.name }}</p>-->
<!--                                                <a class="del" href="" @click="event.preventDefault(); product.movie_file_array.splice(index,1)"><i class="fa-sharp fa-light fa-xmark"></i></a>-->
<!--                                            </li>-->
<!--                                        </ul>-->
<!--                                        <button class="btn_add" @click="$refs.movieRef.click()"><i class="fa-light fa-folder-arrow-up"></i> 동영상 업로드</button>-->
<!--                                        <input v-show="false" type="file" ref="movieRef" @change="jl.changeFile($event,product,'movie_file_array')">-->
<!--                                    </div>-->
                                    <div class="link_active box_dashed">
                                        <dl v-for="item,index in product.movie_link">
                                            <dt>동영상 링크 {{ (index+1).toString().padStart(2,'0') }}.</dt>
                                            <dd><input type="text" placeholder="등록하고자하는 동영상 링크를 입력해주세요" v-model="product.movie_link[index]"></dd>
                                            <a class="del" href="" @click="event.preventDefault(); product.movie_link.splice(index,1)"><i class="fa-sharp fa-light fa-xmark"></i></a>
                                        </dl>
                                        <button class="btn_add" @click="addMovie()" v-if="!admin"><i class="fa-light fa-plus"></i> 링크 추가</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div></div>
                </div>
                <div id="area_btn" class="col02">
                    <a class="btn_prev" href="" @click="event.preventDefault(); $emit('changeTab',2)">이전</a>
                    <a class="btn_next" href="" @click="event.preventDefault(); $emit('postData')">{{product.idx ? '수정' : '등록'}}</a>
                </div>
            </div>
        </div>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary : {type : String, default : ""},
            product : {type : Object, default : null},
            admin : {type : Boolean, default : false},
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
            this.jl = new Jl('<?=$componentName?>');
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            addMovie() {
                if(this.product.movie_link.length >= 10) {
                    alert("동영상 등록은 최대 10개까지입니다.");
                    return false;
                }
                this.product.movie_link.push('');
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