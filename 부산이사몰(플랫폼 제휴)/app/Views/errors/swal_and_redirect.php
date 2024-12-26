<?php include_once APPPATH."Views/template/head.sub.php"; ?>

<script>
    window.onload = function () {
        // (공통) Alert 후 페이지 이동 or 뒤로가기
        utils.showAlert('<?=$message ?? ''?>', () => {
            <?php if (!empty($redirectUrl)): ?>
            window.location.href = '<?=$redirectUrl?>';
            return;
            <?php endif; ?>

            <?php if (!empty($historyBack)): ?>
            history.back();
            return;
            <?php endif; ?>

            location.href = '/';
        });
    }
</script>

