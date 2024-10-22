<!-- 시행사(직원) : 계정관리 -->
</div>
<?php
if(!$project) return false;
?>
<section class="list_table" id="app">
    <account-list :project_idx="project_idx"></account-list>
</section>


<?php $jl->vueLoad();?>
<?php $jl->componentLoad("account");?>
<?php $jl->componentLoad("slot/slot-modal");?>

<script>
    const project_idx = "<?=$project['idx']?>"
    async function postUser() {
        //let obj = jl.js.getInputById(['user_id','user_pw']);
        let obj = jl.js.getFormById("userForm");
        let method = obj['idx'] ? 'update' : "insert";
        //let obj = jl.js.getUrlParams();

        let required = jl.js.getFormRequired("userForm")
        let options = {required : required};

        try {
            if(method == 'insert') {
                if(!obj.change_user_pw) throw new Error("비밀번호를 입력해주세요.");
            }
            if(obj.change_user_pw != obj.user_pw_re) throw new Error("비밀번호와 비밀번호 확인이 다릅니다.");

            let res = await jl.ajax(method,obj,"/api/user",options);

            alert("완료되었습니다.");
            window.location.reload();
        }catch (e) {
            alert(e.message)
        }
    }
</script>
