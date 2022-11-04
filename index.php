<?php
// woshindex V1.3
$preText="https://www.webofscience.com/wos/api/proxy/wos-researcher/stats/individual/";
$rid="AAJ-5802-2021";
$postText="/";
$url=$preText.$rid.$postText;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response=curl_exec($ch);
curl_close($ch);
$citations = (json_decode($response, true));
echo ('ResearcherID='.$rid.'<br/>');
echo ('h-index='.$citations['hIndex'].'<br/>');
echo ('sum of times cited='.$citations['timesCited'].'<br/>');
echo ('publications in wos='.$citations['numPublicationsInWosCc'].'<br/>');
foreach( array_reverse ($citations['citationsPerYear'], true) as $year=>$citation) {
	if($citation !== '0' )
		echo ($citation.' citation in year '.$year.'<br/>');
    }
?>