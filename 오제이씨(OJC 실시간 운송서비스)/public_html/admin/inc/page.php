<?
    include_once("./util/paging.php");

    $maxPage = getMaxPage($totalCount, $pagingCount);
    $prevPage = getPrevPage($page);
    $nextPage = getNextPage($page, $maxPage);
    $pageArr = getCenterPage($page, $maxPage);
    $queryString = getQueryString($_SERVER['QUERY_STRING']); //파라미터 들고오기
?>

<nav aria-label="Page navigation">
  <ul class="pagination justify-content-center">
  
    <? if($page != 1){ ?>
        <li class="page-item disabled">
            <a class="page-link" href="<?=combinePage($prevPage, $queryString)?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
	<? } ?>
	
	<? for($p=0; $p < count($pageArr); $p++){ ?>
        <li class="page-item <?=($pageArr[$p] == $page)? 'active': ''?>">
            <a class="page-link" href="<?=combinePage($pageArr[$p], $queryString)?>"><?=$pageArr[$p]?></a>
        </li>
    <? } ?>
    
	<? if($page != $maxPage){ ?>    
	    <li class="page-item">
          <a class="page-link"href="<?=combinePage($nextPage, $queryString)?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
	<? } ?>
  </ul>
</nav>
