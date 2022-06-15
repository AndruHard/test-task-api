<?php

// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение файлов
include_once "../config/core.php";
include_once "../shared/Utilities.php";

include_once "../config/Connection.php";
include_once "../object/Product.php";

// utilities
$utilities = new Utilities();

// создание подключения
$database = new Connection();
$db = $database->getConnection();

// инициализация объекта
$product = new Product($db);

//$sort_prod = json_decode(file_get_contents("php://input"));
$sort_input = "date";
$sort_atr = "desc";
if(isset($_GET["sort"])){
    if($_GET["sort"] == "price"){
        $sort_input = "price";
    }else{
        $sort_input = "date";
    }
}
if(isset($_GET["atr"])){
    if($_GET["atr"] == "asc"){
        $sort_atr = "asc";
    }else{
        $sort_atr = "desc";
    }
}

//    var_dump($_GET);

//$sort_atr = "";

// запрос товаров
$prod = $product->readPaging($from_record_num, $records_per_page, $sort_input, $sort_atr);
$num = $prod->rowCount();

// если больше 0 записей
    if ($num>0) {

        // массив товаров
        $products_arr=array();
        $products_arr["content"]=array();
        $products_arr["paging"]=array();

        // получаем содержимое нашей таблицы
        while ($row = $prod->fetch(PDO::FETCH_ASSOC)){
            // извлечение строки
            extract($row);

            $product_item=array(
                "id" => $id,
                "title" => $title,
                "description" => html_entity_decode($description),
                "img_1" => $img_1,
                "img_2" => $img_2,
                "img_3" => $img_3,
                "price" => $price,
                "date" => $date,
            );

            array_push($products_arr["content"], $product_item);

        }

        // подключим пагинацию
        $total_rows=$product->count();
        $page_url="{$home_url}product/paging.php?";
        $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
        $products_arr["paging"]=$paging;


        // установим код ответа - 200 OK
        http_response_code(200);

        // вывод в json-формате
        echo json_encode($products_arr);
    } else {

        // код ответа - 404 Ничего не найдено
        http_response_code(404);

        // сообщим пользователю, что товаров не существует
        echo json_encode(array("message" => "Товары не найдены."), JSON_UNESCAPED_UNICODE);
    }
