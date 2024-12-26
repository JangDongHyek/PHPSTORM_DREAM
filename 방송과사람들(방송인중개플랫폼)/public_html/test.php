<?php
include_once ("./jl/JlConfig.php");
?>
<div>
    <div id="editor"></div>
    <textarea name="serviceDesc" style="display: none"></textarea>
</div>

<?php //$jl->vueLoad("app");?>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/summernote.min.js"></script>
<script src="js/summernote-ko-KR.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        $('#editor').summernote('code', document.querySelector('[name="serviceDesc"]').value);
    })
    
    $('#editor').summernote(getSummerNoteSettings('editor', true, false, true));
</script>