<?php

// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once "../config/Connection.php";
include_once "../object/Product.php";

$database = new Connection();
$db = $database->getConnection();

$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));

    if (
        !empty($data->title) &&
        !empty($data->description) &&
        !empty($data->img_1) &&
        !empty($data->price)
    ) {

        // устанавливаем значения свойств товара
        $product->title = $data->title;
        $product->description = $data->description;
        $product->img_1 = $data->img_1;
        $product->img_2 = $data->img_2;
        $product->img_3 = $data->img_3;
        $product->price = $data->price;
        $product->date = date("Y-m-d H:i:s");


        // создание товара
        if($product->create()){

            http_response_code(201);

            echo json_encode(array("message" => "Товар был создан."), JSON_UNESCAPED_UNICODE);

        } else {

            http_response_code(503);

            echo json_encode(array("message" => "Невозможно создать товар."), JSON_UNESCAPED_UNICODE);
        }
    } else {

        http_response_code(400);

        echo json_encode(array("message" => "Невозможно создать товар. Данные неполные."), JSON_UNESCAPED_UNICODE);
    }
