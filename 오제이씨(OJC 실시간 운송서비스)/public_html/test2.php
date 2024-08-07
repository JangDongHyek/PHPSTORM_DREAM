<?php
    $url = "http://itforone.com/~gracebridgewide/app/?isLg=1&lg=en";
    
    // HTML 내용을 가져옵니다
    $html = file_get_contents($url);

    // DOMDocument 객체를 생성하고 HTML을 로드합니다
    $doc = new DOMDocument();
    @$doc->loadHTML($html);

    // DOMXPath 객체를 생성합니다
    $xpath = new DOMXPath($doc);

    // property 속성이 있는 모든 meta 태그를 검색합니다
    $metaTags = $xpath->query("//meta[@property]");

    // 모든 태그를 순회하며 내용을 출력합니다
    foreach ($metaTags as $metaTag) {
        $property = $metaTag->getAttribute('property');
        $content = $metaTag->getAttribute('content');
        echo "$property: $content\n";
    }

    function getCopyLog()             
?>