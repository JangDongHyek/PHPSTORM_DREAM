<?php
$pid = "union";
include_once("./app_head.php");

?>
    <div id="union" class="main">
        <div class="grid grid2">
            <button class="btn" type="button" onclick="location.href='./union_group'"><i class="fa-solid fa-group-arrows-rotate"></i> 교구방</button>
            <button class="btn" type="button" onclick="location.href='./class'"><i class="fa-regular fa-hands-praying"></i> 속회방</button>
            <button class="btn" type="button" onclick="location.href='./union_mission'"><i class="fa-duotone fa-solid fa-book-bible"></i> IMC 선교회</button>
            <button class="btn" type="button" onclick="location.href='./union_small'"><i class="fa-solid fa-people-group"></i>소그룹</button>
            <button class="btn" type="button" onclick="location.href='./union_ministry'"><i class="fa-solid fa-cross"></i> 사역부서</button>
            <button class="btn" type="button" onclick="location.href='../bbs/content.php?co_id=sub01_06'"><i class="fa-duotone fa-solid fa-church"></i>교회행사</button>
        </div>
    </div>

<?php
include_once("./app_tail.php");
?>