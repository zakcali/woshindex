<!DOCTYPE html>
<!-- woshindex V1.6: bu yazılım Dr. Zafer Akçalı tarafından oluşturulmuştur
programmed by Zafer Akçalı, MD -->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ResearcerID'den atıfları getirir</title>
</head>
<body>

<?php
$rid = '';
$hindex = '';
if (isset($_POST['rid'])) {
    $rid=trim($_POST['rid']);
    if ($rid =='' )
        exit ('ResearcherId gelmedi');
    $preText="https://publons.com/wos-op/api/stats/individual/";
    $postText="/";
    $url=$preText.$rid.$postText;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response=curl_exec($ch);
    curl_close($ch);
    // print_r($response);
    $citations = (json_decode($response, true));
    $hindex.= 'ResearcherID='.$rid.'<br/>';
    $hindex.= 'h-index='.$citations['hIndex'].'<br/>';
    $hindex.= 'sum of times cited='.$citations['timesCited'].'<br/>';
    $hindex.= 'publications in wos='.$citations['numPublicationsInWosCc'].'<br/>';
    foreach( array_reverse ($citations['citationsPerYear'], true) as $year=>$citation) {
        if($citation !== '0' )
            $hindex.= $citation.' citation(s) in year '.$year.'<br/>';
    }
}

?>
<form method="post" action="">
    ResearcherId  giriniz<br/>
    <input type="text" name="rid" id="rid" >
    <input type="submit" value="Atıf bilgilerini PHP ile getir">
</form>
<?php echo $hindex;?>
</body>
