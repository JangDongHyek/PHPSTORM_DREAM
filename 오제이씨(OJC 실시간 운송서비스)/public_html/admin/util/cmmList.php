<?
    /*     
    
    
    fnc - getDispatchList(배차관리 리스트) 파라미터 정의
    
    'statusCode' => $statusCode,
    'searchType' => $searchType,
    'searchTxt' => $searchTxt,
    'startDate' => $startDate,
    'endDate' => $endDate,
    'page' => $page,
    'pagingCount' => $pagingCount        
    
    
    */

    function getDispatchList($data, $isPaging = true){
        $listData = $list = array();
        $sqlLimit = $sqlSearch = "";
        
        /***** 검색(필터) 처리 *****/
        
        /* 기간 검색 */
        $sqlSearch = "
            date(D.reg_date) >= '{$data['startDate']}' AND
            date(D.reg_date) <= '{$data['endDate']}' AND
        ";

        /* 상태 검색 */
        if(!empty($data['statusCode'])){
            $sqlSearch .= " status_code = '{$data['statusCode']}' AND ";
        }

        if(!empty($data['searchType']) && !empty($data['searchTxt'])){
            $sqlSearch .= " {$data['searchType']} LIKE '%{$data['searchTxt']}%' AND ";
        }
        
        /* 페이징 처리 */
        if($isPaging){
            $limit = getPageLimit($data['page'], $data['pagingCount']);
            
            $sqlLimit = " LIMIT {$limit}, {$data['pagingCount']} ";
        }

        $sql = "
            SELECT
                D.*,
                S.data_url
            FROM
                dispatch_list AS D LEFT JOIN
                signpad_list AS S ON S.dispatch_idx = D.idx AND S.is_use = '1'        
            WHERE
                $sqlSearch
                D.is_use = '1'
            ORDER BY
                D.idx DESC
            $sqlLimit
        ";

        $dispatchRes = sql_query($sql);

        for($i = 0; $row = sql_fetch_array($dispatchRes); $i++){
            $row['product_string'] = json_decode($row['product_string'], true);
            $row['product_string']['from_time'] = $row['from_time'];
            $row['product_string']['to_time'] = $row['to_time'];
            $row['product_full_string'] = json_decode($row['product_full_string'], true);
            $row['kr_complete_date'] = getKrDate($row['complete_date']);
            $list[] = $row;
        }

        /* 전체 갯수 구하기 */
        $sql = "
            SELECT 
                COUNT(*) AS cnt 
            FROM 
                dispatch_list AS D
            WHERE
                $sqlSearch
                D.is_use = '1'
        ";

        $totalCount = sql_fetch($sql)['cnt'];
        
        $listData['list'] = $list;
        $listData['totalCount'] = $totalCount;
        
        return $listData;
    }

    /* 
    
    fnc - getDriverList(기사관리 리스트) 파라미터 정의
    
    'searchType' => $searchType,
    'searchTxt' => $searchTxt
    'page' => $page,
    'pagingCount' => $pagingCount    
    
    
    */
    function getDriverList($data, $isPaging = true){
        $listData = $list = array();        
        $sqlLimit = $sqlSearch = "";
                
        /* 검색(필터) 처리 */        
        $DELIVERY = DELIVERY;        
        $sqlSearch = "
            mb_type = '{$DELIVERY}' AND
        ";
        
        if(!empty($data['searchType']) && !empty($data['searchTxt'])){
            $sqlSearch .= " {$data['searchType']} LIKE '%{$data['searchTxt']}%' AND ";
        }
        
        /* 페이징 처리 */        
        if($isPaging){
            $limit = getPageLimit($data['page'], $data['pagingCount']);
            
            $sqlLimit = " LIMIT {$limit}, {$data['pagingCount']} ";
        }        

        /* 본문 불러오기 */
        $sql = "
            SELECT
                M.*
            FROM
                g5_member AS M
            WHERE
                $sqlSearch
                M.is_use = '1'
            ORDER BY
                M.idx DESC
            $sqlLimit
        ";

        $deliveryRes = sql_query($sql);

        for($i = 0; $row = sql_fetch_array($deliveryRes); $i++){            
            $list[] = $row;
        }

        /* 전체 갯수 구하기 */
        $sql = "
            SELECT 
                COUNT(*) AS cnt 
            FROM 
                g5_member AS M
            WHERE
                $sqlSearch
                M.is_use = '1'
        ";

        $totalCount = sql_fetch($sql)['cnt'];

        
        $listData['list'] = $list;
        $listData['totalCount'] = $totalCount;
        
        return $listData;
    }

    /* 
    
    fnc - getComapnyList(업체관리 리스트) 파라미터 정의
    
    'searchType' => $searchType,
    'searchTxt' => $searchTxt
    'page' => $page,
    'pagingCount' => $pagingCount
    
    
    */

    function getCompanyList($data, $isPaging = true){
        
        $listData = $list = array();        
        $sqlLimit = $sqlSearch = "";
                
        /* 검색(필터) 처리 */        
        $CUSTOMER = CUSTOMER;        
        $sqlSearch = "
            mb_type = '{$CUSTOMER}' AND
            mb_id != 'admin' AND mb_id != 'lets080' AND
        ";
        
        if(!empty($data['searchType']) && !empty($data['searchTxt'])){
            $sqlSearch .= " {$data['searchType']} LIKE '%{$data['searchTxt']}%' AND ";
        }
        
        /* 페이징 처리 */        
        if($isPaging){
            $limit = getPageLimit($data['page'], $data['pagingCount']);
            
            $sqlLimit = " LIMIT {$limit}, {$data['pagingCount']} ";
        }        

        /* 본문 불러오기 */
        $sql = "
            SELECT
                M.*
            FROM
                g5_member AS M
            WHERE
                $sqlSearch
                M.is_use = '1'
            ORDER BY
                M.idx DESC
            $sqlLimit
        ";

        $deliveryRes = sql_query($sql);

        for($i = 0; $row = sql_fetch_array($deliveryRes); $i++){            
            $list[] = $row;
        }

        /* 전체 갯수 구하기 */
        $sql = "
            SELECT 
                COUNT(*) AS cnt 
            FROM 
                g5_member AS M
            WHERE
                $sqlSearch
                M.is_use = '1'
        ";

        $totalCount = sql_fetch($sql)['cnt'];

        
        $listData['list'] = $list;
        $listData['totalCount'] = $totalCount;
        
        return $listData;
    }
?>