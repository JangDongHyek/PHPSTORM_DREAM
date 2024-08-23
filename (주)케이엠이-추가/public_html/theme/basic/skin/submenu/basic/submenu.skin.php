<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>


<div class="border-top border-bottom">
    <div class="d-flex align-items-center container-lg Breadcrumb-width">
        <a href="<?php echo G5_URL ?>" target="_self">
            <div class="d-flex align-items-center border-0 border-end border-start px-4"
                 style="height:50px; background-color:#eff1ff;">
                <i class="bi bi-house-door fs-3"></i>
            </div>
        </a>

        <select class="form-select breadcrumb-select-first-width border-0" aria-label="Default select example" style="height:50px;" onchange="window.open(this.value,'_self');">
            <?php
            // Array of main options
            $main_options = [
                "../bbs/content.php?co_id=greetings" => "ABOUT US",
                "../bbs/content.php?co_id=marine" => "BUSINESS FIELD",
                "../bbs/content.php?co_id=off_lighting" => "PRODUCTS",
                "../bbs/board.php?bo_table=reference" => "REFERENCE",
                "../bbs/board.php?bo_table=customer" => "CONTACT US"
            ];

            // Loop through the options to generate <option> elements
            foreach ($main_options as $link => $name) {
                // Check if the current option should be selected
                $selected = ($title['sm_name'] == $name) ? "selected" : "";
                echo "<option value='$link' $selected>$name</option>";
            }
            ?>
        </select>

        <div class="border-end" style="height: 50px;"></div>
        <select class="form-select breadcrumb-select-second-width border-0" aria-label="Default select example"
                style="height:50px;" onchange="window.open(this.value,'_self');">
            <?php
            // 두 번째 select 옵션을 동적으로 생성
            while($sub = sql_fetch_array($result)) {
                $sub_link = $sub['sm_course'] ? G5_URL.$sub['sm_link'] : $sub['sm_link'];
                $selected = ($sm_tid == $sub['sm_tid']) ? "selected" : "";
                echo "<option value='$sub_link' $selected>{$sub['sm_name']}</option>";
            }
            ?>
        </select>
        <div class="border-end" style="height: 50px;"></div>
        <div class="ms-auto text-secondary fs-7 mobile-none">Global Service Network Best Products - KME Co. Ltd</div>
    </div>
</div>
