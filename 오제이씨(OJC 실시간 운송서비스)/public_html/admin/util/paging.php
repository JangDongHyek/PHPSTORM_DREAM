<?php

    /* 빈 2022-10-07 pagingUtil */
    /* page = 현재 페이지 */
    /* pagingCount = 리스트에 몇 개 노출 시킬 건지(기본 15개) */
    /* totalCount = 총 갯수 */    

    function getMaxPage($totalCount, $pagingCount){        
        $maxPage = ceil($totalCount / $pagingCount);
        if($maxPage == 0) $maxPage = 1;
        
        return $maxPage;
    }

    function getPrevPage($page){
        if($page == 1) return $page;
        
        return ($page - 1);
    }

    function getNextPage($page, $maxPage){
        if($page == $maxPage) return $page;
        
        return ($page + 1);
    }

    function getCenterPage($page, $maxPage){
        
        $maxCenterCnt = 5; // 버튼 페이징 갯수        
        $betweenCnt = floor($maxCenterCnt / 2); // 사이드에 몇 개씩 배치 할 건지
        $initPage = ($page - $betweenCnt); // 첫 페이지값
        $conditionPage = ($page + $betweenCnt); // 마지막 페이지값
        
        if($initPage <= 0) $conditionPage = $maxCenterCnt;
        if($conditionPage > $maxPage) $initPage -= ($conditionPage - $maxPage);
        
        $pageArr = array();
                
        for($p = $initPage; $p <= $conditionPage; $p++){ 
            if($p <= 0 || $p > $maxPage) continue;
            $pageArr[] = $p;
        }
        
        return $pageArr;
    }
    
    function getQueryString($queryString){
        $queryArr = explode('&', $queryString);

        $resultQuery = array();
        for($i=0; $i<count($queryArr); $i++){            
            if(explode('=', $queryArr[$i])[0] == 'page') continue;
            
            $resultQuery[] = $queryArr[$i];
        }

        $resultString = implode('&', $resultQuery);
        if($resultString){
            return '&'.$resultString;
        }
        
        return '';
    }

    function combinePage($page, $queryString){
        return '?page='.$page.$queryString;
    }
?>