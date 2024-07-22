<?php
include_once ("./class/Lib.php");
$jl = new JL();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>카테고리 관리 리스트</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .outer-container-XYZ123 {
            max-width: 820px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .category-list {
            list-style: none;
            padding: 0;
        }
        .category-list > li {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
            padding: 10px 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .category-list > li > .category-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        .subcategory-list {
            list-style: none;
            padding: 0;
            margin: 0;
            padding-left: 20px;
        }
        .subcategory-list > li {
            background-color: #f9f9f9;
            border: 1px solid #eee;
            border-radius: 4px;
            margin-bottom: 5px;
            padding: 5px 10px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        .subcategory-list > li > .subcategory-title {
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>
<div class="outer-container-XYZ123" id="app">
    <div class="container">
        <h1>카테고리 관리 리스트</h1>
        <draggable v-model="categories" group="categories" class="category-list" @end="onEnd">
            <template v-for="element in categories">
                <li :key="element.id">
                    <div class="category-title">{{ element.title }}</div>
                    <draggable v-model="element.subcategories" group="subcategories" class="subcategory-list" @end="onEnd">
                        <template v-for="item in element.subcategories">
                <li :key="item.id">
                    <div class="subcategory-title">{{ item.title }}</div>
                </li>
            </template>
        </draggable>
        </li>
        </template>
        </draggable>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/vue/2.5.2/vue.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sortablejs@1.8.4/Sortable.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.20.0/vuedraggable.umd.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Vue({
            el: '#app',
            components: {
                draggable: vuedraggable
            },
            data: {
                categories: [
                    {
                        id: 'cat1',
                        title: '1차 카테고리 1',
                        subcategories: [
                            { id: 'subcat1-1', title: '2차 카테고리 1-1' },
                            { id: 'subcat1-2', title: '2차 카테고리 1-2' }
                        ]
                    },
                    {
                        id: 'cat2',
                        title: '1차 카테고리 2',
                        subcategories: [
                            { id: 'subcat2-1', title: '2차 카테고리 2-1' },
                            { id: 'subcat2-2', title: '2차 카테고리 2-2' }
                        ]
                    },
                    {
                        id: 'cat3',
                        title: '1차 카테고리 3',
                        subcategories: [
                            { id: 'subcat3-1', title: '2차 카테고리 3-1' },
                            { id: 'subcat3-2', title: '2차 카테고리 3-2' }
                        ]
                    }
                ]
            },
            methods: {
                onEnd(event) {
                    console.log('Drag ended', event);
                    this.$nextTick(() => {
                        console.log('DOM updated after drag');
                        // 여기에 필요한 추가 작업을 수행합니다.
                    });
                }
            }
        });
    });
</script>
</body>
</html>
