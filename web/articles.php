<?php
	chdir("common");
    require_once("init.php");

    //next example will recieve all messages for specific conversation
$service_url = 'localhost:49300/api/artigosarmazens';
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response, true);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}
//var_dump($decoded);

    // get warehouses
    $warehouses = array();
    // Template
    $smarty->assign("articles", $decoded);
    $smarty->display("articles.tpl");
?>