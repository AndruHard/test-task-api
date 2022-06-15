jQuery(function($){


    $(document).on("click", ".create-product-button", function() {

        let create_product_html=` 
            <form id="create-product-form" action="#" method="post" onsubmit="return validate()">
                <table class="table">
    
            <tr>
            <td>Название</td>
            <td><input type="text" name="title" class="form-control" max="200" required /></td>
            </tr>
            
            <tr>
            <td>Ссылка на первую картинка</td>
            <td><input type="text" name="img_1" class="form-control" required /></td>
            </tr> 
                       
            <tr>
            <td>Ссылка на вторую картинка</td>
            <td><input type="text" name="img_2" class="form-control" /></td>
            </tr>  
                      
            <tr>
            <td>Ссылка на третью картинка</td>
            <td><input type="text" name="img_3" class="form-control" /></td>
            </tr>
    
            <tr>
            <td>Цена</td>
            <td><input type="number" name="price" class="form-control" min="1" required /></td>
            </tr>
    
            <tr>
            <td>Описание</td>
            <td><textarea name="description" class="form-control" required></textarea></td>
            </tr>
                
            <tr>
            <td>Действие</td>
            <td>
            <button type="submit" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span> Создать товар
                </button>
                </td>
                </tr>
    
                </table>
            </form>`;

        $("#page-content").html(create_product_html);
        changePageTitle("Создание товара");

    });



    $(document).on("submit", "#create-product-form", function(){
        // получение данных формы
        let form_data=JSON.stringify($(this).serializeObject());

        // отправка данных формы в API
        $.ajax({
            url: "http://test-task/api/product/create.php",
            type : "POST",
            contentType : "application/json",
            data : form_data,
            success : function(result) {
                alert("Товар создан")
                showProductsFirstPage();
            },
            error: function(xhr, resp, text) {
                console.log(xhr, resp, text);
            }
        });

        return false;
    });
});