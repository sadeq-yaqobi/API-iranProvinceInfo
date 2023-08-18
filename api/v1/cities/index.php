<?php
include_once "../../../loader.php";

use \App\Services\CityService;
use \App\Utilities\Response;
use \App\Utilities\CacheUtility;

#  check authorization(use a jwt token)
$token = getBearerToken();
$user = isValidToken($token);
if (!$user)
    Response::respondAndDie('Invalid token!', Response::HTTP_UNAUTHORIZED);
# Authentication ok
# get request token and validate it

$request_method = $_SERVER['REQUEST_METHOD'];
$request_body = json_decode(file_get_contents('php://input'), true);
$city_service = new CityService();
switch ($request_method) {
    case 'GET':
        $province_id = $_GET['province_id'] ?? null;
        if (!hasAccessToProvince($user, $province_id))
            Response::respondAndDie('You have not access to this province!', Response::HTTP_FORBIDDEN);
        CacheUtility::start();
        $page = $_GET['page'] ?? null;
        $pagesize = $_GET['pagesize'] ?? null;
        $fields = $_GET['fields'] ?? null;
        $orderby = $_GET['orderby'] ?? null;
        $request_data = [
            'province_id' => $province_id,
            'page' => $page,
            'pagesize' => $pagesize,
            'fields' => $fields,
            'orderby' => $orderby
        ];
        $response = $city_service->getCities($request_data);
        if (empty($response))
            Response::respondAndDie($response, Response::HTTP_NOT_FOUND);
        echo Response::respond($response, Response::HTTP_OK);
        CacheUtility::end();
        die();
    case 'POST':

        if (!hasAccessToDeletePushPost($user))
            Response::respondAndDie('You have not access to this action!', Response::HTTP_FORBIDDEN);
        $validation = isValidCity($request_body);
        if (!$validation)
            Response::respondAndDie(['Invalid City Data...'], Response::HTTP_BAD_REQUEST);
        $response = $city_service->createCity($request_body);
        Response::respondAndDie($response, Response::HTTP_CREATED);
    case 'PUT':
        if (!hasAccessToDeletePushPost($user))
            Response::respondAndDie('You have not access to this action!', Response::HTTP_FORBIDDEN);
        [$city_id, $city_name] = [$request_body['city_id'], $request_body['name']];
        if (!is_numeric($city_id) || empty($city_name))
            Response::respondAndDie(['Invalid City Data...'], Response::HTTP_BAD_REQUEST);
        $result = $city_service->updateCityName($city_id, $city_name);
        if ($result == 0)
            Response::respondAndDie(['Invalid City Data...'], Response::HTTP_BAD_REQUEST);
        Response::respondAndDie($result, Response::HTTP_OK);


    case 'DELETE':
        if (!hasAccessToDeletePushPost($user))
            Response::respondAndDie('You have not access to this action!', Response::HTTP_FORBIDDEN);
        $city_id = $_GET['city_id'] ?? null;
        if (!is_numeric($city_id) || is_null($city_id))
            Response::respondAndDie(['Invalid City id...'], Response::HTTP_BAD_REQUEST);
        $result = $city_service->deleteCity($city_id);
        if ($result == 0)
            Response::respondAndDie(['Invalid City id...'], Response::HTTP_BAD_REQUEST);
        Response::respondAndDie($result, Response::HTTP_OK);
    default:
        Response::respondAndDie(['Invalid request method'], Response::HTTP_METHOD_NOT_ALLOWED);
}


// $cs = new CityService();
// $result = $cs->getCities((object)[123, 2, 58, 974]);
// Response::respondAndDie($result, Response::HTTP_OK);
