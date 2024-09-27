<?php if (session()->getFlashdata('warning')) {?>
    <script>
        alert("<?= session()->getFlashdata('warning') ?>");
    </script>
<?php }?>