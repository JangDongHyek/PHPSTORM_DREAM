<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div id="gnb2" class="hd_div">
        <ul id="mgnb_1dul">
            <?php for ($i = 0; $i< count($big_ctg); $i++){
                if ($big_ctg[$i]['c_idx'] == 1){
                    $tag = '<i class="fa-duotone fa-tv-retro"></i><i class="fa-light fa-tv-retro"></i>';
                }else if ($big_ctg[$i]['c_idx'] == 2){
                    $tag = '<i class="fa-duotone fa-chalkboard-user"></i><i class="fa-light fa-chalkboard-user"></i>';
                }else if ($big_ctg[$i]['c_idx'] == 3){
                    $tag = '<i class="fa-duotone fa-money-check-dollar-pen"></i><i class="fa-light fa-money-check-dollar-pen"></i>';
                }?>
                <li class="mgnb_1dli">
                    <a class="mgnb_1da" href="<?php echo G5_BBS_URL; ?>/item_list.php?ctg=<?=$big_ctg[$i]["c_idx"]?>">
                        <div class="area_icon"></div>
                        <h3><?=$big_ctg[$i]["c_name"]?></h3>
                    </a>
                    <ul class="mgnb_2dul">
                        <?php
                        $small_ctg = ctg_list($big_ctg[$i]["c_idx"]);
                        for ($a = 0; $a< count($small_ctg); $a++){ ?>
                            <li class="mgnb_2dli"><a class="mgnb_2da" href="<?php echo G5_BBS_URL; ?>/item_list.php?ctg=<?=$small_ctg[$a]["c_idx"]?>">
                                    <?=$small_ctg[$a]["c_name"]?>
                                </a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
        </ul>


    </div>
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