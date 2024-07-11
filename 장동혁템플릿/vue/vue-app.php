<script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>

<!--<page-component :page="filter.page" :limit="filter.limit" :total="total" @change="changePage"></page-component>-->
<!--<modal-component v-if="modal" @close="modal = false" v-slot="slot"></modal-component>-->

<script>
    // Vue 인스턴스 생성
    document.addEventListener('DOMContentLoaded', function () {
        new Vue({
            el: '#app',
            data: {
                base_url: "<?=G5_URL?>",
                model: "",
                primary: "<?=$_GET['idx']?>",
                data: {},
                datas: [],
                filter: {
                    page: <?=$_GET["page"] ? $_GET["page"] : 1?>,
                    limit: 10,
                    search_key1: "<?=$_GET["search_key1"] ? $_GET["search_key1"] : ""?>",
                    search_value1: "<?=$_GET["search_value1"] ? $_GET["search_value1"] : ""?>"
                },
                total: 0,
                checks: [],
                all_check: false,
                modal: false
            },
            created: function () {
                // this.getsData();
                if (this.primary) this.getData();
            },
            mounted: function () {
                this.$nextTick(() => {

                });
            },
            methods: {
                changePage(page) {
                    var url = `${this.base_url}/example.php?`;

                    Object.keys(this.filter).forEach(function (key) {
                        if (key == "limit") return;
                        url += `key=${this.filter[key]}&`;
                    });

                    window.location.href = url;
                },
                postData: function () {
                    var method = this.data._idx ? "update" : "insert";
                    var obj = JSON.parse(JSON.stringify(this.data));

                    var objs = {
                        _method: method,
                        obj: JSON.stringify(obj),
                    };

                    var res = this.ajax(this.base_url + "/api/" + this.model + ".php", objs);

                    if (res) {
                        console.log(res)
                    }
                },
                getData: function () {
                    var method = "get";
                    var filter = JSON.parse(JSON.stringify(this.filter));
                    var objs = {
                        _method: method,
                        filter: JSON.stringify(filter)
                    };

                    var res = this.ajax(this.base_url + "/api/" + this.model + ".php", objs);
                    if (res) {
                        console.log(res)
                    }
                },
                deletesData: function () {
                    var method = "deletes";

                    if (this.checks.length <= 0) {
                        alert("하나 이상 선택하셔야합니다.");
                        return false;
                    }

                    var objs = {
                        _method: method,
                        arrays: JSON.stringify(this.checks)
                    };

                    var res = this.ajax(this.base_url + "/api/" + this.model + ".php", objs);
                    if (res) {
                        alert("삭제되었습니다.");
                        window.location.reload();
                    }
                },
                ajax: function (url, objs) {
                    var form = new FormData();
                    //if(url.indexOf(".php") == -1) url = url + ".php";
                    for (var i in objs) {
                        form.append(i, objs[i]);
                    }

                    var result = null;
                    $.ajax({
                        url: url,
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
            },
            computed: {

            },
            watch: {
                all_check: function () {
                    this.checks = [];

                    if (this.all_check) {
                        this.datas.forEach((item) => {
                            this.checks.push(item._idx);
                        });
                    }
                }
            }

        });
    }, false);

    Number.prototype.format = function (n, x) {
        var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
        return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
    };
</script>