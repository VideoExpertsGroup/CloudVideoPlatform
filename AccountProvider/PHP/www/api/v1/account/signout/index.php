<?php
/*
 * API_NAME: Signout
 * API_METHOD: POST
 * API_DESCRIPTION: Method for logout user in the system
 * API_ACCESS: authorized
 */

$curdir = dirname(__FILE__);
$apilib = $curdir.'/../../../lib/api.helpers.php';
include_once ($apilib);

$response = APIHelpers::startpage_post();
$request = APIHelpers::$REQUEST;

if(isset($_COOKIE['AccpToken'])){
	$conn = APIHelpers::createConnection();
	$query = 'DELETE FROM users_token WHERE token = ?';
	$stmt = $conn->prepare($query);
	$stmt->execute(array($_COOKIE['AccpToken']));

	unset($_COOKIE['AccpToken']);
	setcookie('AccpToken', null, -1, '/');
	$response['result'] = 'ok';
}

APIHelpers::endpage($response);
