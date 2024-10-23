<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alert and Redirect</title>
    <script>
        // Alert 후 페이지 이동 or 뒤로가기
        window.onload = function() {
            alert('<?=$message?>');

            <? if ($redirectUrl) { ?>
            window.location.href = '<?=$redirectUrl?>';
            <? } ?>

            <? if ($historyBack) { ?>
            history.back();
            <? } ?>
        }
    </script>
</head>
<body>
</body>
</html>
