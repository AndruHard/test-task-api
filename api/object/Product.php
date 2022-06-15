<?php


class Product
{

    private $conn;
    private $t_name = "products";

    public $id;
    public $title;
    public $description;
    public $img_1;
    public $img_2;
    public $img_3;
    public $price;
    public $date;



    public function __construct($db){
        $this->conn = $db;
    }

    public function read()
    {

        $query = "SELECT * FROM " . $this->t_name . " p ORDER BY p.date DESC";

        $prod = $this->conn->prepare($query);

        $prod->execute();

        return $prod;
    }

    // метод create - создание товаров
    public function create(){

        // запрос для вставки (создания) записей
        $query = "INSERT INTO " . $this->t_name . " SET title=:title, description=:description, img_1=:img_1, img_2=:img_2, img_3=:img_3, price=:price, date=:date";

        // подготовка запроса
        $prod = $this->conn->prepare($query);

        // очистка
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->img_1=htmlspecialchars(strip_tags($this->img_1));
        $this->img_2=htmlspecialchars(strip_tags($this->img_2));
        $this->img_3=htmlspecialchars(strip_tags($this->img_3));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->date=htmlspecialchars(strip_tags($this->date));

        // привязка значений
        $prod->bindParam(":title", $this->title);
        $prod->bindParam(":description", $this->description);
        $prod->bindParam(":img_1", $this->img_1);
        $prod->bindParam(":img_2", $this->img_2);
        $prod->bindParam(":img_3", $this->img_3);
        $prod->bindParam(":price", $this->price);
        $prod->bindParam(":date", $this->date);

        // выполняем запрос
        if ($prod->execute()) {
            return true;
        }

        return false;
    }

    // используется при заполнении формы обновления товара
    public function readOne() {

        // запрос для чтения одной записи (товара)
        $query = "SELECT p.id, p.title, p.description, p.img_1, p.img_2, p.img_3, p.price, p.date
            FROM
                " . $this->t_name . " p
            WHERE
                p.id = ?
            LIMIT
                0,1";

        // подготовка запроса
        $prod = $this->conn->prepare( $query );

        // привязываем id товара, который будет обновлен
        $prod->bindParam(1, $this->id);

        // выполняем запрос
        $prod->execute();

        // получаем извлеченную строку
        $row = $prod->fetch(PDO::FETCH_ASSOC);

        // установим значения свойств объекта
        $this->title = $row["title"];
        $this->description = $row["description"];
        $this->img_1 = $row["img_1"];
        $this->img_2 = $row["img_2"];
        $this->img_3 = $row["img_3"];
        $this->price = $row["price"];

    }

    public function readPaging($from_record_num, $records_per_page, $sort_input, $sort_atr){

        // выборка
        $query = "SELECT p.id, p.title, p.description, p.img_1, p.img_2, p.img_3, p.price, p.date  
            FROM
                " . $this->t_name . " p
            ORDER BY " . $sort_input . " " . $sort_atr . "
            LIMIT ?, ?";

        // подготовка запроса
        $prod = $this->conn->prepare( $query );

        // свяжем значения переменных
        $prod->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $prod->bindParam(2, $records_per_page, PDO::PARAM_INT);

        // выполняем запрос
        $prod->execute();

        // вернём значения из базы данных
        return $prod;
    }

    // используется для пагинации товаров
    public function count() {
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->t_name;

        $prod = $this->conn->prepare( $query );
        $prod->execute();
        $row = $prod->fetch(PDO::FETCH_ASSOC);

        return $row["total_rows"];
    }

}