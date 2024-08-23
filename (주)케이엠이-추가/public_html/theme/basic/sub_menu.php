<?php
// Initialize variables
$where_sql = "";

$me_id = $co_id ?? $bo_table ?? '';

// Fetch top-level menu item
$sql = "SELECT me_code
        FROM {$g5['menu_table']} 
        WHERE me_link LIKE '%$me_id' 
            AND " . ($is_mobile ? "me_mobile_use = 1" : "me_use = 1") . " 
            AND LENGTH(me_code) = 4
        ORDER BY me_order DESC";
$result = sql_query($sql);
$row = sql_fetch_array($result);

$sub_me_arr = [];
$parent_code = '';

if ($row['me_code']) {
    $me_code = $row['me_code'];
    $parent_code = substr($row['me_code'], 0, 2);

    // Fetch sub-menu items
    $sql = "SELECT me_code, me_name, me_link, me_target
            FROM {$g5['menu_table']} 
            WHERE me_code LIKE '$parent_code%'
                AND LENGTH(me_code) = 4
            ORDER BY me_order DESC";
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result)) {
        $d_arr = [
            'me_name' => $row['me_name'],
            'me_link' => $row['me_link'],
            'me_target' => $row['me_target'],
            'me_on' => $row['me_code'] == $me_code ? 1 : 0
        ];
        $sub_me_arr[] = $d_arr;
    }
}

// Fetch the selected top-level menu item name
$selected_menu_name = '';
$selected_top_level_link = '';
$first_sub_menu_link = '';

$sql = "SELECT * FROM {$g5['menu_table']} WHERE me_mobile_use = 1 AND LENGTH(me_code) = 2 ORDER BY me_order, me_id";
$result = sql_query($sql);
while ($row = sql_fetch_array($result)) {
    if (strpos($row['me_link'], $me_id) !== false) {
        $selected_menu_name = $row['me_name'];
        $selected_top_level_link = $row['me_link'];
        break;
    }
}

if (count($sub_me_arr) > 0) {
    $first_sub_menu_link = $sub_me_arr[0]['me_link'];
}

$is_first_sub_menu = ($first_sub_menu_link && $first_sub_menu_link === $me_id);
?>

<?php if (count($sub_me_arr)) { ?>

    <!-- Breadcrumb -->
    <div class="border-top border-bottom">
        <div class="d-flex align-items-center container-lg Breadcrumb-width">
            <a href="<?php echo G5_URL ?>" target="_self">
                <div class="d-flex align-items-center border-0 border-end border-start px-4"
                     style="height:50px; background-color:#eff1ff;">
                    <i class="bi bi-house-door fs-3"></i>
                </div>
            </a>
            <!-- Top-level Menu -->
            <select class="form-select breadcrumb-select-first-width border-0" aria-label="Default select example"
                    style="height:50px;" onchange="window.open(this.value, '_self');">
                <?php
                $sql = "SELECT * FROM {$g5['menu_table']} WHERE me_mobile_use = 1 AND LENGTH(me_code) = 2 ORDER BY me_order, me_id";
                $result = sql_query($sql);
                while ($row = sql_fetch_array($result)) {
                    $link = htmlspecialchars(G5_URL . $row['me_link'], ENT_QUOTES, 'UTF-8');
                    $selected = (strpos($row['me_link'], $me_id) !== false) ? 'selected' : '';
                    echo "<option value=\"$link\" $selected>" . htmlspecialchars($row['me_name'], ENT_QUOTES, 'UTF-8') . "</option>";
                }
                ?>
            </select>
            <div class="border-end" style="height: 50px;"></div>
            <!-- Sub-menu -->
            <select class="form-select breadcrumb-select-second-width border-0" aria-label="Default select example"
                    style="height:50px;" onchange="window.open(this.value, '_self');">
                <?php foreach ($sub_me_arr as $v) { ?>
                    <option value="<?= htmlspecialchars(G5_URL . $v['me_link'], ENT_QUOTES, 'UTF-8') ?>" <?= isset($v['me_on']) && $v['me_on'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($v['me_name'], ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php } ?>
            </select>
            <div class="border-end" style="height: 50px;"></div>
            <div class="ms-auto text-secondary fs-7 mobile-none">Global Service Network Best Products - KME Co. Ltd</div>
        </div>
    </div>
<?php } ?>
