<?php
$pagehtml = file_get_contents("https://miningpoolstats.stream");

$pieces = explode('var last_time = "', $pagehtml);
$pieces = explode('"', $pieces[1]);

echo $pieces[0];

$pagehtml = file_get_contents("https://data.miningpoolstats.stream/data/zero.js?t=" . $pieces[0]);
file_put_contents('pools_info.data', $pagehtml);

unset($pagehtml);
unset($pieces);
?>