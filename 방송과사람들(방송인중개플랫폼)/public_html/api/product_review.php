<?php
include_once("../class/Model.php");
//include_once("../class/File.php");

$response = array("message" => "");
$_method = $_POST["_method"];

$model_config = array(
    "table" => "product_review",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
);


try {
    $model = new Model($model_config);

    $join_table = "g5_member";
    $join_table_delete = false; // true시 join테이블 데이터가 없으면 조회된 데이터 삭제

    //$file = new File("/data/example");

    switch (strtolower($_method)) {
        case "get":
        {
            $obj = $model->jsonDecode($_POST['obj']);

            //필터 가공
            foreach ($obj as $key => $value) {
                if(strpos($key,"primary") !== false) $obj[$model->primary] = $value;
                if(strpos($key,"search_key") !== false) $column = $value;
                if(strpos($key,"search_value") !== false) $obj[$column] = $value;
                if(strpos($key,"order_by_desc") !== false) $model->order_by($obj['order_by_desc'],"DESC");
                if(strpos($key,"order_by_asc") !== false) $model->order_by($obj['order_by_desc'],"ASC");
            }

            $model->where($obj);
            $object = $model->get($obj["page"], $obj["limit"]);

            if ($join_table) {
                $deletes = array();
                $joinModel = new Model(array(
                    "table" => $join_table,
                    "primary" => "mb_no"
                ));

                foreach ($object["data"] as $index => $data) {
                    $joinModel->where($joinModel->primary, $data["member_idx"]);
                    $join_data = $joinModel->get()['data'][0];

                    $object["data"][$index][strtoupper($join_table)] = $join_data;

                    if ($join_table_delete) {
                        if (!$join_data) array_push($deletes, $index);
                    }


                }

                if ($join_table_delete) {
                    foreach ($deletes as $index) {
                        unset($object["data"][$index]);
                        $object["count"]--;
                    }
                }
            }

            $response['data'] = $object['data'];
            $response['count'] = $object['count'];
            $response['filter'] = $obj;
            $response['success'] = true;
            break;
        }

        case "insert":
        {
            $obj = $model->jsonDecode($_POST['obj']);

            foreach ($_FILES as $key => $file_data) {
                $file_result = $file->bindGate($file_data);
                $obj[$key] = $file_result;
            }

            // 리뷰가 달릴때 상품의 리뷰카운트 증가 * 조인으로 처리할시 쿼리복잡도 코드 복잡도가 상승하여 이렇게 처리
            $productModel = new Model(array(
                "table" => "member_product",
                "primary" => "idx"
            ));
            $productModel->where("idx",$obj['product_idx']);
            $product = $productModel->get()['data'][0];
            $product['review_count'] = (int)$product['review_count']+ 1;
            $product['review_score'] = (int)$product['review_score']+ (int)$obj['score'];
            $productModel->update($product);

            $model->insert($obj);
            $response['success'] = true;
            break;
        }
        case "update":
        {
            $obj = $model->jsonDecode($_POST['obj']);

            //업데이트는 기존 사진 데이터 가져와서 머지를 해줘야하기때문에 값 가져오기
            $model->where($model->primary,$obj[$model->primary]);
            $getData = $model->get()['data'][0];

            foreach ($_FILES as $key => $file_data) {
                $file_result = $file->bindGate($file_data);

                //바인드의 리턴값은 encode되서 오기때문에 decode
                $file_result = json_decode($file_result, true);
                //데이터의 값은 encode되어있기떄문에 decode
                $org_data = $model->jsonDecode($getData[$key],false);
                $result = array_merge($org_data,$file_result);

                //문자열로 저장되어야하기떄문에 encode
                $obj[$key] = json_encode($result,JSON_UNESCAPED_UNICODE);
            }

            // 리뷰가 달릴때 상품의 리뷰카운트 증가 * 조인으로 처리할시 쿼리복잡도 코드 복잡도가 상승하여 이렇게 처리
            $productModel = new Model(array(
                "table" => "member_product",
                "primary" => "idx"
            ));
            $productModel->where("idx",$obj['product_idx']);
            $product = $productModel->get()['data'][0];
            $product['review_score'] = (int)$product['review_score'] - (int)$obj['prev_score'] + (int)$obj['score'];
            $productModel->update($product);

            $model->update($obj);
            $response['success'] = true;
            break;
        }
        case "delete":
        {
            $obj = $model->jsonDecode($_POST['obj'],false);

            //$file->deleteDirGate($obj['data_column']);
            $data = $model->delete($obj);

            $response['success'] = true;
            break;
        }

        case "where_delete" :
            $obj = $model->jsonDecode($_POST['obj'],false);

            $model->where($obj);
            $data = $model->whereDelete();

        case "deletes":
        {
            $arrays = $model->jsonDecode($_POST['arrays']);

            foreach ($arrays as $primary) {
                $model->delete(array(
                    $model->primary => $primary
                ));
            }

            $response['arrays'] = $arrays;
            $response['success'] = true;
            break;
        }
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = $e->getMessage();
}

echo json_encode($response);

?>