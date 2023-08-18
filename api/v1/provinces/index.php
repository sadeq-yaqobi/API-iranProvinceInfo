<?php
include_once "../../../loader.php";

use \App\Services\ProvinceService;
use \App\Utilities\Response;
use \App\Utilities\CacheUtility;

$request_method = $_SERVER['REQUEST_METHOD'];
$request_body = json_decode(file_get_contents('php://input'), true);
$province_service = new ProvinceService();
switch ($request_method) {
    case 'GET':
        CacheUtility::start();
        $id = $_GET['id'] ?? null;
        $page = $_GET['page'] ?? null;
        $pagesize = $_GET['pagesize'] ?? null;
        $fields = $_GET['fields'] ?? null;
        $orderby = $_GET['orderby'] ?? null;
        $request_data = [
            'id' => $id,
            'page' => $page,
            'pagesize' => $pagesize,
            'fields' => $fields,
            'orderby' => $orderby
        ];
        $response = $province_service->getProvinces($request_data);
        if (empty($response))
            Response::respondAndDie($response, Response::HTTP_NOT_FOUND);
        echo Response::respond($response, Response::HTTP_OK);
        CacheUtility::end();
        die();
    case 'POST':
        $validation = isValidProvince($request_body);
        if (!$validation)
            Response::respondAndDie(['Invalid Province Data...'], Response::HTTP_BAD_REQUEST);
        $response = $province_service->createProvince($request_body);
        Response::respondAndDie($response, Response::HTTP_CREATED);
    case 'PUT':
        [$id, $name] = [$request_body['id'], $request_body['name']];
        if (!is_numeric($id) || empty($name))
            Response::respondAndDie(['Invalid Province Data...'], Response::HTTP_BAD_REQUEST);
        $result = $province_service->updateProvinceName($id, $name);
        if ($result == 0)
            Response::respondAndDie(['Invalid Province Data...'], Response::HTTP_BAD_REQUEST);
        Response::respondAndDie($result, Response::HTTP_OK);
    case 'DELETE':
        $id = $_GET['id'] ?? null;
        if (!is_numeric($id) || is_null($id))
            Response::respondAndDie(['Invalid Province id...'], Response::HTTP_BAD_REQUEST);
        $result = $province_service->deleteProvince($id);
        if ($result == 0)
            Response::respondAndDie(['Invalid Province id...'], Response::HTTP_BAD_REQUEST);
        Response::respondAndDie($result, Response::HTTP_OK);
    default:
        Response::respondAndDie(['Invalid request method'], Response::HTTP_METHOD_NOT_ALLOWED);
}
