
</div>
<?php if ($footer_type == 0) { ?>
<?php } else if ($footer_type == 1) { ?>
    <footer>
        <ul>
            <li>
                <a href="<?php echo G5_URL ?>/app"><i class="fa-solid fa-house"></i></a>
            </li>
            <li>
                <a href="<?php echo G5_URL ?>/app/friend">교우소식</a>
            </li>
            <li>
                <a href="<?php echo G5_URL ?>/app/rental">대관신청</a>
            </li>
            <li>
                <a href="<?php echo G5_URL ?>/app/lost">분실물찾기</a>
            </li>
            <li>
                <a href="<?php echo G5_URL ?>/app/helper">도우미</a>
            </li>
        </ul>
    </footer>
<?php } else if ($footer_type == 2) { ?>
    <footer>
        <ul>
            <li>
                <a href="<?php echo G5_URL ?>/app"><i class="fa-solid fa-house"></i></a>
            </li>
            <li>
                <a href="javascript:history.back();"><i class="fa-solid fa-left"></i></a>
            </li>
        </ul>
    </footer>
<?php } ?>


<?php
require_once('../tail.sub.php');
?>