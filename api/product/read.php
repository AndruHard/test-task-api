<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/Connection.php";
include_once "../object/Product.php";



$database = new Connection();
$db = $database->getConnection();

$product = new Product($db);


$prod = $product->read();
//var_dump($prod);
$num = $prod->rowCount();


    if ($num>0) {

        $prod_arr = array();
        $prod_arr["content"] = array();


        while ($row = $prod->fetch(PDO::FETCH_ASSOC)) {

            extract($row);

            $product_item = array(
                "id" => $id,
                "title" => $title,
                "description" => html_entity_decode($description),
                "img_1" => $img_1,
                "img_2" => $img_2,
                "img_3" => $img_3,
                "price" => $price,
                "date" => $date,
            );

            array_push($prod_arr["content"], $product_item);
        }

        http_response_code(200);

        echo json_encode($prod_arr);

    }else {
        http_response_code(404);

        echo json_encode(array("message" => "Товары не найдены."), JSON_UNESCAPED_UNICODE);
    }

