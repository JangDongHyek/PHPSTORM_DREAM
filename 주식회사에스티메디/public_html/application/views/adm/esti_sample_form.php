<!--관리자 비교견적 샘플 등록/수정-->
<section class="estimateupd" id="app">
	<form name="estimate" autocomplete="off">
		<input type="hidden" name="idx" value=""/>

		<div class="panel">
			<label class="title">샘플 제목</label>
			<input type="text" id="title" name="title" placeholder="샘플 제목을 입력하세요" class="title" required maxlength="30" value=""/>
			<span>
                <button type="button" class="btn btn_gray" onclick="history.back()">목록</button>
                <button type="button" class="btn btn_blue" onclick="postData()">등록</button>
            </span>
		</div>
		<div class="box">
			<p class="name">우선순위</p>
			<p class="line">
				<input type="number" id="priority" name="" value="" /> 높을수록 우선
			</p>
			<p class="name">샘플내용</p>
			<div class="table">
				<table>
					<thead>
						<tr>
							<th>No.</th>
							<th>품명</th>
							<th>기존단가</th>
							<th>타사단가</th>
							<th>ST단가</th>
							<th>수량</th>
							<th><button type="button" class="btn btn_blue" onclick="contents.push(jl.copyObject(content))">추가</button></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="item,index in contents">
							<td>{{index+1}}</td>
							<td><input type="text"   v-model="contents[index].name" name="" value="" required /></td>
							<td><input type="number" v-model="contents[index].origin_price" name="" value="" required /></td>
							<td><input type="number" v-model="contents[index].other_price" name="" value="" required /></td>
							<td><input type="number" v-model="contents[index].price" name="" value="" required /></td>
							<td><input type="number" v-model="contents[index].amount" name="" value="" required /></td>
							<td><button type="button" @click="contents.splice(index,1)" class="btn btn_line">삭제</button></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</form>
</section>

<?php $jl->vueLoad();?>

<script>
    let contents = [];
    let content = {
        name : "",
        origin_price : "",
        other_price : "",
        price : "",
        amount : "",
    }

    Jl_data.contents = contents;

    async function postData() {
        //let obj = jl.js.getInputById(['user_id','user_pw']);
        //let obj = jl.js.getFormById("form_id");
        //let obj = jl.js.getUrlParams();

        let obj = {
            title : jl.js.getInputById("title"),
            contents : contents,
            priority : jl.js.getInputById("priority"),
        }

        try {
            //if(obj.user_id == "") throw new Error("아이디를 입력해주세요.")

            let res = await jl.ajax("insert",obj,"/api/bs_comparative");
        }catch (e) {
            alert(e.message)
        }
    }

</script>
