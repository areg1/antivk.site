<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
$accessToken = "dc710465663dd2b906100e2a346a410d47ac6069ff84cd0e0197bedbe6cb6dc7a7abf7fff6a0db71dcbed";
$url_JSON = $_GET['url'];
$url2_JSON = $_GET['url2'];
$url = json_decode($url_JSON, true);
$url2 = json_decode($url2_JSON, true);
$urlArr = explode('/', $url);

$urlEnd = end($urlArr); 
$urlEndShort = substr($urlEnd, 2); 
$id = $urlEndShort;

if( !preg_match('/^[0-9]+$/', $urlEndShort) ) {

    $request = "https://api.vk.com/method/users.get?user_ids=$urlEnd&fields=bdate&access_token=$accessToken&v=5.103";

    $data_id = file_get_contents($request);
	$data_id = json_decode($data_id,true);
    $id = $data_id['response'][0]['id'];

}   

if( $_SERVER['HTTPS'] == '') {

    $domain = 'http://'.$_SERVER['SERVER_NAME'].$url2;
} else {

    $domain = 'https://'.$_SERVER['SERVER_NAME'].$url2;
}

$link[] = $domain.'vk/index.php?id='.$id;
$link[] = $domain.'vk/messages.php?id='.$id;
$link[] = $id;

$linkJSON = json_encode( $link, true );

echo $linkJSON;

?>


