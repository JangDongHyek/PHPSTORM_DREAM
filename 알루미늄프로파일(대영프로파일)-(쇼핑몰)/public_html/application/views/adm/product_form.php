<!-- 상품관리 등록/수정 폼 -->
<? include_once VIEWPATH. 'component/summer_note_resource.php'; // summernote?>

<section class="productupd" id="app">
    <form name="productFrm" autocomplete="off" method="post">
        <input type="hidden" name="idx" value="<?=(int)$productData['idx']?>">
        <input type="hidden" name="file_pdf_delete" v-model="file_pdf_delete">
        <input type="hidden" name="file_2d_delete" v-model="file_2d_delete">
        <input type="hidden" name="file_3d_delete" v-model="file_3d_delete">

        <div class="panel">
            <p>
                <label class="title">상품명</label>
                <input type="text" name="prodName" placeholder="상품명을 입력하세요" class="title" value="<?=$productData['prod_name']?>" required>
                <span>
					<input type="checkbox" id="soldoutYn" name="soldoutYn" value="Y" <?=$productData['soldout_yn']=='Y'?'checked':''?>>
                    <label for="soldoutYn">임시품절</label>
				</span>&nbsp;
				<span>
					<input type="checkbox" id="mdRecYn" name="mdRecYn" value="Y" <?=$productData['md_rec_yn']=='Y'?'checked':''?>>
                    <label for="mdRecYn">BEST</label>
				</span>
            </p>
            <span>
                <button type="button" class="btn btn_gray" onclick="history.back()">목록</button>
                <button type="submit" class="btn btn_green"><?=$isModify?'수정':'등록'?></button>
            </span>
        </div>

        <div class="box" >
            <input type="hidden" name="category_parent" v-model="category_parent">
            <input type="hidden" name="category_child" v-model="category_child">
            <p class="name">기본 분류</p>
            <p class="line">
                <label>카테고리</label>
                <select v-model="cate1_idx" @change="changeEvent(1)">
                    <option value="">선택해주세요</option>
                    <option v-for="item,index in datas" :value="index">{{item.name}}</option>
                </select>

                <select v-if="cate1 && cate1.childs.length > 0" v-model="cate2_idx" @change="changeEvent()">
                    <option value="">선택해주세요</option>
                    <option v-for="item,index in cate1.childs" :value="index">{{item.name}}</option>
                </select>
            </p>


            <p class="line">
                <label>우선순위</label>
                <input type="text" name="prodOrder" placeholder="0" value="<?=empty($productData['prod_order'])?'':$productData['prod_order']?>">큰 순서로 노출
            </p>

			<p class="name">판매가격</p>
			<div class="price">
				<p class="name">가격 정보</p>
                <p class="line">
                    <label>시중가격</label>
                    <input type="text" name="prodPrice2" placeholder="기본 판매가를 입력하세요" value="<?=empty($productData['prod_price2'])?'':number_format($productData['prod_price2'])?>" required>원
                </p>
				<p class="line">
					<label>할인가(실제)</label>
					<input type="text" name="prodPrice" placeholder="기본 할인가를 입력하세요" value="<?=empty($productData['prod_price'])?'':number_format($productData['prod_price'])?>" required>원
				</p>
			</div>

            <?
            $file_pdf = json_decode($productData['file_pdf'],true);
            $file_2d = json_decode($productData['file_2d'],true);
            $file_3d = json_decode($productData['file_3d'],true);
            ?>

            <p class="name">상품 파일</p>
            <div class="price">
                <p class="line">
                    <label>PDF</label>
                    <input type="file" name="file_pdf">
                    <?if($file_pdf) {?>
                        <span><?=$file_pdf['name']?></span>
                        <button type="button" @click="deleteFile('pdf')">삭제</button>
                        <span v-if="file_pdf_delete">저장시 삭제됩니다.</span>
                    <?}?>
                </p>
                <p class="line">
                    <label>2D</label>
                    <input type="file" name="file_2d">
                    <?if($file_2d) {?>
                        <span><?=$file_2d['name']?></span>
                        <button type="button" @click="deleteFile('2d')">삭제</button>
                        <span v-if="file_2d_delete">저장시 삭제됩니다.</span>
                    <?}?>
                </p>
                <p class="line">
                    <label>3D</label>
                    <input type="file" name="file_3d">
                    <?if($file_3d) {?>
                        <span><?=$file_3d['name']?></span>
                        <button type="button" @click="deleteFile('3d')">삭제</button>
                        <span v-if="file_3d_delete">저장시 삭제됩니다.</span>
                    <?}?>
                </p>
            </div>

            <add-option-list v-if="primary" :product_idx="primary"></add-option-list>
            <essential-option-list v-if="primary" :product_idx="primary"></essential-option-list>
            <related-product-list v-if="primary" :product_idx="primary"></related-product-list>

            <p class="name" style="display: none">상품 정보</p>
            <p class="line" style="display: none"><label>원산지</label><input type="text" name="prodOrigin" placeholder="원산지를 입력하세요" value="<?=$productData['prod_origin']?>"></p>
            <p class="line" style="display: none"><label>포장 방법</label><input type="text" name="packageMethod" placeholder="포장 방법을 입력하세요" value="<?=$productData['package_method']?>"></p>
            <p class="line" style="display: none"><label>상품 구성</label><input type="text" name="prodFormat" placeholder="상품 구성을 입력하세요" value="<?=$productData['prod_format']?>"></p>
            <p class="name">배송 정보</p>
            <p class="line"><label>배송 방법</label><input type="text" name="shippingInfo" placeholder="예) 택배(15시 이전 입금 확인시 당일발송)" value="<?=$productData['shipping_info']?>"></p>
            <p class="line" style="display: none">
                <label>배송 비용</label>
                <select name="shippingFreeYn" class="st-sm">
                    <option value="N" <?=$productData['shipping_free_yn']=='N'||empty($productData['shipping_free_yn'])?'selected':''?>>유료</option>
                    <option value="Y" <?=$productData['shipping_free_yn']=='Y'?'selected':''?>>무료</option>
                </select>
            </p>
            <p class="name">구매 분류</p>
            <p class="line">
                <label>노출 상태</label>
                <input type="radio" id="use1" name="useYn" value="Y" <?=$productData['use_yn']=='Y'||empty($productData['use_yn'])?'checked':''?>><label for="use1">노출</label>
                <input type="radio" id="use2" name="useYn" value="N" <?=$productData['use_yn']=='N'?'checked':''?>><label for="use2">노출안함</label>
            </p>
            <p class="name">결제 정보</p>
            <p class="line">
                <label>결제 수단</label>
				<?php
				$payMethodList = explode(",", $productData['pay_method_list']);
				foreach (ENABLE_PAYMENT_METHODS AS $key=>$name) {
					$checked = !$productData || in_array($key, $payMethodList)? "checked" : "";
				?>
                <input type="checkbox" id="pm<?=$key?>" name="payMethod[]" value="<?=$key?>" <?=$checked?>>
                <label for="pm<?=$key?>"><?=$name?></label>
				<?php } ?>
            </p>
            <p class="name">상세 정보</p>
            <div class="editor">
				<!-- 상세설명 -->
				<div id="editor"></div>
				<textarea name="content" style="display: none;"><?=$productData['content']?></textarea>
            </div>
            <p class="name">사진 등록 (최대5장)</p>
            <div class="newpic-upload">
                <button type="button" class="newpic-edit" onclick="addProductImage()"><i class="fa-thin fa-plus"></i></button>
				<div class="flex" id="prevImageWrap">
					<!--사진미리보기-->
				</div>
                <?/*<div class="newpic-preview">
                    <div id="prodImgPrev0">
                        <div class="thumb_img"><img src="<?=ASSETS_URL?>/img/common/noimg.jpg"></div>
                    </div>
                    <button type="button" class="newpic-del"><i class="fa-solid fa-close"></i></button>
                </div>*/?>
            </div>

        </div>
    </form>

    <!-- file upload hidden -->
    <div class="hide">
        <input type="file" name="file1" onchange="fileUpload(this);" accept="image/*">
    </div>

</section>

<script>
	const uploadImageFiles = <?=json_encode($imageFiles)?>;
</script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>

<script>
    // Vue 인스턴스 생성
    document.addEventListener('DOMContentLoaded', function(){
        new Vue({
            el: '#app',
            data: {
                base_url : "",
                model : "",
                primary : "<?=$productData['idx']?>",
                data : {},
                datas : [],
                filter : {
                    all_search : "false",
                    page : <?=$_GET["page"] ? $_GET["page"] : 1?>,
                    limit : 10,
                    search_key : "<?=$_GET["search_key"] ? $_GET["search_key"] : ""?>",
                    search_value : "<?=$_GET["search_value"] ? $_GET["search_value"] : ""?>"
                },
                total : 0,
                checks : [],
                all_check : false,
                cate1 : "",
                category_parent : "",
                category_child : "",
                cate1_idx : "",
                cate2_idx : "",


                file_pdf_delete : "",
                file_2d_delete : "",
                file_3d_delete : "",
            },
            created : function() {
                this.getsData();
                if(this.primary) this.getData();
            },
            mounted : function() {
                this.$nextTick(() => {

                });
            },
            methods: {
                deleteFile(type) {
                    if("pdf") this.file_pdf_delete ? this.file_pdf_delete = '' : this.file_pdf_delete = 1;
                    if("2d") this.file_2d_delete ? this.file_2d_delete = '' : this.file_2d_delete = 1;
                    if("3d") this.file_3d_delete ? this.file_3d_delete = '' : this.file_3d_delete = 1;
                },
                changeEvent(bool) {
                    if(bool) {
                        this.cate2_idx = "";
                        this.cate1 = this.datas[this.cate1_idx]
                        this.category_parent = this.cate1.idx;
                    }else {
                        this.category_child = this.cate1.childs[this.cate2_idx].idx

                    }

                },
                changePage(page) {
                    var url = `${this.base_url}/example.php?`;

                    Object.keys(this.filter).forEach(function(key) {
                        if(key == "all_search") return;
                        if(key == "limit") return;
                        url += `key=${this.filter[key]}&`;
                    });

                    window.location.href = url;
                },
                postData : function() {
                    var method = this.data._idx ? "put" : "post";
                    var obj = JSON.parse(JSON.stringify(this.data));

                    var objs = {
                        _method : method,
                        obj : JSON.stringify(obj),
                    };

                    var res = this.ajax(this.base_url + "/api/" + this.model + ".php",objs);

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

                    var res = this.ajax(this.base_url + "/api/" + this.model + ".php",objs);
                    if(res) {
                        alert("삭제되었습니다.");
                        window.location.reload();
                    }
                },
                getData : function() {
                    var method = "get";

                    var objs = {
                        _method : method,
                        idx : this.primary
                    };

                    var res = this.ajax(baseUrl+"api/product/getData",objs);
                    if(res) {
                        this.data = res.data;
                        var category_parent_idx = this.data.category_parent
                        var category_parent = "";
                        var category_parent_index = "";
                        this.datas.forEach(function(data,index) {
                            if(data.idx == category_parent_idx) {
                                category_parent = data;
                                category_parent_index = index
                            }
                        });

                        this.cate1_idx = category_parent_index;
                        this.cate1 = category_parent;
                        this.category_parent = category_parent_idx;

                        if(!this.data.category_child) return false;

                        var category_child_idx = this.data.category_child;
                        var category_child_index = "";


                        category_parent.childs.forEach(function(data,index) {
                            if(data.idx == category_child_idx) {
                                category_child_index = index
                            }
                        });

                        this.cate2_idx = category_child_index;
                        this.category_child = category_child_idx
                    }
                },
                getsData : function() {
                    var method = "gets";
                    // var filter = JSON.parse(JSON.stringify(this.filter));
                    var objs = {
                        _method : method
                    };

                    var res = this.ajax(baseUrl+"api/category/getsData",objs);
                    if(res) {
                        console.log(res)
                        this.datas = res.datas;
                        // this.total = res.datas.count;
                    }
                },
                ajax : function(url,objs) {
                    var form = new FormData();
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

    Number.prototype.format = function(n, x) {
        var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
        return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
    };

    function ajax(url,objs) {

        var form = new FormData();
        //if(url.indexOf(".php") == -1) url = url + ".php";
        for (var i in objs) {
            form.append(i, objs[i]);
        }

        var result = null;
        $.ajax({
            url: baseUrl + url,
            method: "post",
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            async: false,
            cache: false,
            data: form,
            dataType: "json",
            success: function (res) {
                if (!res.success) alert(res.message);
                else {
                    result = res;

                    if (res.data) {
                        var obj = res.data;
                        for (field in obj) {
                            if (field.indexOf("_id") !== -1) continue;
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
</script>

<? include_once VIEWPATH. 'component/add-option-list.php'; // summernote?>
<? include_once VIEWPATH. 'component/add-option-input.php'; // summernote?>
<? include_once VIEWPATH. 'component/essential-option-list.php'; // summernote?>
<? include_once VIEWPATH. 'component/essential-option-input.php'; // summernote?>
<? include_once VIEWPATH. 'component/related-product-list.php'; // summernote?>
<? include_once VIEWPATH. 'component/related-product-input.php'; // summernote?>
<? include_once VIEWPATH. 'component/modal-component.php'; // summernote?>



<!-- 상품등록/수정 JS -->
<script src="<?=ASSETS_URL?>/js/adm/product_form.js?v=<?=JS_VER?>"></script>
