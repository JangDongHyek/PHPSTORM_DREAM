<script>
    Swal.fire({
        text: "<?= esc($msg); ?>",
    });
    <?php if ($url): ?>
    document.location.replace("<?= esc($url, 'url'); ?>");
    <?php else: ?>
    history.back();
    <?php endif; ?>
</script>

<noscript>
    <div id="validation_check">
        <h1><?= $error ? '다음 항목에 오류가 있습니다.' : '다음 내용을 확인해 주세요.'; ?></h1>
        <p class="cbg">
            <?= nl2br(esc($msg)); ?>
        </p>
        <?php if ($post): ?>
            <form method="post" action="<?= esc($url, 'url'); ?>">
                <?php
                foreach ($_POST as $key => $value) {
                    if (strlen($value) < 1 || preg_match("/pass|pwd|capt|url/", $key)) {
                        continue;
                    }
                    echo '<input type="hidden" name="'.esc($key).'" value="'.esc($value).'">';
                }
                ?>
                <input type="submit" value="돌아가기">
            </form>
        <?php else: ?>
            <div class="btn_confirm">
                <a href="<?= esc($url, 'url'); ?>">돌아가기</a>
            </div>
        <?php endif; ?>
    </div>
</noscript>
