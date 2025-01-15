<script src="https://dapi.kakao.com/v2/maps/sdk.js?appkey=dfd12a16e040fdbbd95ed0649d89d55c"></script>
<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <div :id="component_idx"></div>
    </div>
</script>

<script>
    Jl_components.push({name : "<?=$componentName?>",object : {
            template: "#<?=$componentName?>-template",
            props: {
                primary : {type: String, default: ""},
            },
            data: function () {
                return {
                    jl: null,
                    component_idx: "",

                    paging: {
                        page: 1,
                        limit: 1,
                        count: 0,
                    },

                    data: {},

                    map : null,
                    maker : null
                };
            },
            async created() {
                this.jl = new Jl('<?=$componentName?>');
                this.component_idx = this.jl.generateUniqueId();
            },
            mounted() {
                this.$nextTick(() => {
                    this.initMap()
                });
            },
            updated() {

            },
            methods: {
                setMap(address) {
                    let component = this;
                    const geocoder = new kakao.maps.services.Geocoder();
                    geocoder.addressSearch(address, (result, status) => {
                        if (status === kakao.maps.services.Status.OK) {
                            const coords = new kakao.maps.LatLng(result[0].y, result[0].x);

                            // 지도 중심 이동
                            component.map.setCenter(coords);

                            // 마커 위치 변경
                            component.marker.setPosition(coords);
                        } else {
                            component.jl.alert("주소를 찾을 수 없습니다.");
                        }
                    });
                },
                initMap() {
                    const container = document.getElementById(this.component_idx);
                    const options = {
                        center: new kakao.maps.LatLng(37.5665, 126.9780), // 초기 위치 (서울)
                        level: 3 // 확대 수준
                    };
                    this.map = new kakao.maps.Map(container, options);
                    this.marker = new kakao.maps.Marker({
                        position: options.center,
                        map: this.map
                    });
                },
                async getData() {
                    let filter = {
                        table: "user",
                    }

                    if (this.paging) filter = Object.assign(filter, this.paging); // paging 객체가있다면 병합

                    try {
                        let res = await this.jl.ajax("get", filter, "/jl/JlApi.php");
                        this.data = res.data[0]
                        this.paging.count = res.count;
                    } catch (e) {
                        await this.jl.alert(e.message)
                    }
                }
            },
            computed: {},
            watch: {}
        }});

</script>

<style>

</style>