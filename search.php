<?php
require_once 'workflows.php';
require_once 'functions.php';

$affiliateToken = trim(file_get_contents('affiliate-token.txt'));
$wf = new Workflows();

$json = $wf->request(sprintf(
    'https://itunes.apple.com/search?at=%s&limit=10&entity=%s&term=%s',
    $affiliateToken,
    $entity,
    urlencode($query)
));
$json = json_decode($json, true);
$int = 1;

$urls = [
    'album' => 'collectionViewUrl',
    'musicArtist' => 'artistLinkUrl',
    'software' => 'trackViewUrl',
    'macSoftware' => 'trackViewUrl',
    'musicTrack' => 'trackViewUrl'
];

foreach($json['results'] as $result) {
    $name = getResultName($entity, $result);
    $url  = $result[$urls[$entity]];
    if (!preg_match('/geo\.itunes\.apple\.com/', $url)) {
        $url = str_replace('itunes.apple.com', 'geo.itunes.apple.com', $url);
    }
    $image = 'icon.png';
    if (isset($result['artworkUrl60'])) {
        $image = 'image-cache/'.md5($result['artworkUrl60']);
        if (!file_exists($image)) {
            file_put_contents($image, file_get_contents($result['artworkUrl60']));
        }
    }
    $wf->result($int.'.'.time(), $url, $name, 'Open page for '.$name, $image);
    $int++;
}

$results = $wf->results();
if (count($results) === 0) {
    $wf->result('itunes', $query, 'No Suggestions', 'No search suggestions found. Search iTunes for '.$orig, 'icon.png' );
}

echo $wf->toxml();
