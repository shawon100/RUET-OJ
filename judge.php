<?php

/**
* @link http://restunited.com/docs/3bqbx05520d0
*/

require_once 'HackerRank/HackerRank.php';




$l=$_POST['lan'];
$tc=$_POST['in'];

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fu"]["name"]);
$uploadOk = 1;

if(move_uploaded_file($_FILES["fu"]["tmp_name"], $target_file))
{
	$fname=basename( $_FILES["fu"]["name"]);
	//echo "$fname";
}






// Get your key at https://www.hackerrank.com/api/docs
$api_key   = "hackerrank|506454-980|3672eeb10462853e8c7fb2ea12b9d6082a71c97e";
$source    = file_get_contents("uploads/$fname");
$lang      = $l; // 1 = c, 2 = cpp
$testcases = "[\"1 2\", \"3 4\",\"0 0\"]";

echo "$tc";

$format    = "JSON";
$wait      = "true";

try {
    $api_client  = new HackerRank\APIClient();
    $checker_api = new HackerRank\CheckerAPI($api_client);
    $response    = $checker_api->submission($api_key, $source, $lang, $testcases, $format);
    
    //var_dump($response);
    echo"<pre>".print_r($response,1)."</pre>";
}
catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), "\n";
}
