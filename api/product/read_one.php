<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once "../config/Connection.php";
include_once "../object/Product.php";

$database = new Connection();
$db = $database->getConnection();

$product = new Product($db);

$product->id = isset($_GET["id"]) ? $_GET["id"] : die();

$product->readOne();

    if ($product->title!==null) {

        $product_arr = array(
            "id" =>  $product->id,
            "title" => $product->title,
            "description" => $product->description,
            "img_1" => $product->img_1,
            "img_2" => $product->img_2,
            "img_3" => $product->img_3,
            "price" => $product->price,

        );

        http_response_code(200);
        echo json_encode($product_arr);

    } else {

        http_response_code(404);
        echo json_encode(array("message" => "Товар не существует."), JSON_UNESCAPED_UNICODE);
    }