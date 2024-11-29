<?php
include_once('./_common.php');

$g5['title'] = '아카데미 지점현황';
include_once('./_head.php');

$center_code = $_GET['center_code'];

$sql = " select * from g5_center where center_code = '{$center_code}' ";
$center = sql_fetch($sql);

?>
<link rel="stylesheet" href="<?= G5_CSS_URL ?>/style.css">
<style>
#container{ padding-bottom:0; background:#f5f5f5;}
#ft{ display:none;}
</style>


<div id="sub_family">
	<ul>
        <?php
        $sql = " select * from g5_center where idx != 13 ";
        $result = sql_query($sql);

        for($i=0; $row=sql_fetch_array($result); $i++) {
        ?>
            <li><a class="<?php if($center_code==$row['center_code']) { echo 'on'; } ?>" href="<?=G5_BBS_URL?>/site_pro.php?center_code=<?=$row['center_code']?>"><?=explode(' 아카데미', $row['center_name'])[0]?></a></li>
        <?php
        }
        ?>
    	<!--<li><a class="on">워커힐</a></li>
    	<li><a>남서울</a></li>
    	<li><a>북악</a></li>
    	<li><a>삼성</a></li>
    	<li><a>서초</a></li>
    	<li><a>세종필드</a></li>
    	<li><a>부산 센텀시티</a></li>-->
    </ul>
</div><!--#sub_family-->

<div id="site_pro">
	<div class="site_title"><?=$center['center_name']?><p>프로를 클릭하면 자세히 볼 수 있습니다</p></div><!--.site_title-->

	<div class="spro_list">
    	<ul>
            <?php
            if($center_code == 'center1') {
                $sql_order = " order by field(mb_no, 17) desc, pro_enter_date asc "; // 21.08.20 워커힐 임연석 프로 제일 마지막 순서로 변경 요청
            } else {
                $sql_order = " order by pro_enter_date asc ";
            }

            $sql = " select * from g5_member where mb_category = '프로' and center_code = '{$center_code}' and (pro_leave_date = '0000-00-00' or pro_leave_date > date_format(now(), '%Y-%m-%d')) {$sql_order} ";
            $result = sql_query($sql);

            for($i=0; $mb=sql_fetch_array($result); $i++) {
                $file = sql_fetch(" select * from g5_member_img where mb_no = '{$mb['mb_no']}' ");
            ?>
            <li onclick="show_modal('<?=$mb['mb_no']?>', '<?=$mb['mb_name']?>', '<?=$file['img_file']?>');">
                <div class="spro_img">
                    <?php if(!empty($file['img_file'])) { ?> <img src="<?=G5_DATA_URL?>/file/member/<?=$file['img_file']?>">
                    <?php } else { ?> <img src="<?php echo G5_ADMIN_URL; ?>/img/mem_noimg.gif"/> <?php } ?>
                </div>
                <div class="spro_name"><?=$mb['mb_name']?> <span>프로</span></div>
            </li>
            <?php
            }
            ?>
        </ul>
    </div><!--.spro_list-->
</div><!--#site_pro-->

<!-- 프로 상세 Modal -->
<div class="modal fade" id="spro_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-body">
      	<div class="spro_top">
        	<div class="spro_img" id="pro_img"><img src="<?php echo G5_URL ?>/adm/img/mem_noimg.gif" /></div>
            <div class="spro_name" id="pro_name">나길동 <span>프로</span></div>
        </div><!--.spro_top-->
        
        <div class="spro_cont">
        	<h1>주요이력 및 소개</h1>
        	<div id="pro_profile" style="white-space: pre-wrap;">프로소개내용</div>
        </div><!--.spro_cont-->
        
      </div><!--.modal-body-->
    </div>
  </div>
</div>

<script>
    function show_modal(no, name, file) {
        $.ajax({
            url: g5_bbs_url + "/ajax.pro_profile.php",
            data: {mb_no : no},
            type: 'POST',
            success: function (data) {
                var profile = data;

                $('#pro_profile').html(profile);
            },
        });

        $('#pro_name').html(name + ' <span>프로</span>');
        if(file != '') {
            var src = '<?=G5_DATA_URL?>/file/member/'+file;
        } else {
            var src = '<?=G5_ADMIN_URL?>/img/mem_noimg.gif';
        }
        $('#pro_img').html("<img src='"+src+"'>");

        $('#spro_Modal').modal('show');
    }
</script>


<?php
include_once('./_tail.php');
?>