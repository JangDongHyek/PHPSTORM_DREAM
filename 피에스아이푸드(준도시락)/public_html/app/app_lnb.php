<?php
loginCheck($member['mb_id']);
?>
<!--2차메뉴-->
<div id="lnb">
    <a class="" data-toggle="modal" data-target="#myModal"><?=$lnb_name?> <i class="fal fa-angle-down"></i></a>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <ul>
                <li><a href="<?php echo APP_URL;?>/menu_deli.php">정기배달도시락</a></li>
                <li><a href="<?php echo APP_URL;?>/menu_event.php">행사용도시락</a></li>
                <!--<li><a href="<?php /*echo APP_URL;*/?>/menu_salad.php">샐러드팩</a></li>-->
                <!--<li><a href="<?php /*echo APP_URL;*/?>/menu_warm.php">발열도시락 안내</a></li>-->
            </ul>
        </div>
      </div>
    </div>
</div>
