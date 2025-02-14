<? 
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");
$g5['title'] = '프로젝트 의뢰';
include_once('./_head.php');
$name = "project_form";
$pid = "project_form";
?>

<div id="area_project">
    <project-input mb_no="<?=$member['mb_no']?>"></project-input>
</div>

<?
$jl->vueLoad("area_project",["summernote"]);
$jl->componentLoad("project");
$jl->componentLoad("external");
?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let product = {
                options: [
                    { detail: "custom", name: "", description: "" }
                ]
            };

            const areaFilter = document.getElementById("area_filter");
            const addPrizeBtn = document.getElementById("addPrizeBtn");

            function renderOptions() {
                areaFilter.innerHTML = "";

                product.options.forEach((item, index) => {
                    const rank = (index + 1) + "등"; // 등수 자동 증가
                    const li = document.createElement("li");
                    li.innerHTML = `
                        <div class="filter_active">
                            <p>${rank}</p>
                            <dl class="grid">
                                <dt><label>인원</label></dt>
                                <dd><input type="text" placeholder="인원을 입력해주세요" data-index="${index}" class="titleInput"></dd>
                                <dt><label>인당 상금</label></dt>
                                <dd><input type="number" placeholder="상금을 입력해주세요" data-index="${index}" class="descInput"></dd>
                            </dl>
                        </div>
                    `;
                    areaFilter.appendChild(li);
                });

                document.querySelectorAll(".titleInput").forEach(input => {
                    input.addEventListener("input", function () {
                        const index = this.getAttribute("data-index");
                        product.options[index].name = this.value;
                    });
                });

                document.querySelectorAll(".descInput").forEach(input => {
                    input.addEventListener("input", function () {
                        const index = this.getAttribute("data-index");
                        product.options[index].description = this.value;
                    });
                });
            }

            addPrizeBtn.addEventListener("click", function () {
                product.options.push({ detail: "custom", name: "", description: "" });
                renderOptions();
            });

            renderOptions();
        });
    </script>

<script>

    document.addEventListener("DOMContentLoaded", function () {
        let images = [];
        const fileList = document.getElementById("file_list");
        const imgCount = document.getElementById("img_count");
        const imgLimitMsg = document.getElementById("img_limit_msg");
        const inputFile = document.getElementById("input_file");
        const fileDrag = document.getElementById("fileDrag");

        function updateList() {
            fileList.innerHTML = images.map((img, i) => `
            <li class="file_1">
                <div class="area_img">
                    <img src="${img}" width="100">
                    <div class="area_delete" onclick="removeImage(${i})"></div>
                </div>
            </li>
        `).join("");

            imgCount.textContent = images.length;
            imgLimitMsg.style.display = images.length > 10 ? "block" : "none";
        }

        function handleFiles(files) {
            if (images.length >= 10) return alert("최대 10장까지만 업로드할 수 있습니다.");
            [...files].forEach(file => {
                if (!file.type.startsWith("image/")) return;
                const reader = new FileReader();
                reader.onload = e => {
                    if (images.length < 10) images.push(e.target.result);
                    updateList();
                };
                reader.readAsDataURL(file);
            });
        }

        window.removeImage = i => {
            images.splice(i, 1);
            updateList();
        };

        inputFile.addEventListener("change", e => handleFiles(e.target.files));
        fileDrag.addEventListener("click", () => inputFile.click());
        fileDrag.addEventListener("drop", e => { e.preventDefault(); handleFiles(e.dataTransfer.files); });
        fileDrag.addEventListener("dragover", e => e.preventDefault());
    });


</script>

<?php
include_once('./_tail.php');
?>