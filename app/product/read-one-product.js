jQuery(function($) {


    $(document).on("click", ".read-one-product-button", function() {
        let id = $(this).attr("data-id");

        $.getJSON("http://test-task/api/product/read_one.php?id=" + id, function(data) {
            let read_one_product_html=`

            <div id="read-products" class="btn btn-primary pull-right m-b-15px read-products-button">
                <span class="glyphicon glyphicon-list"></span> Все товары
            </div>
            

<table class="table">

    <tr>
        <td class="w-30-pct">Название</td>
        <td class="w-70-pct">` + data.title + `</td>
    </tr>

    <tr>
        <td>Цена</td>
        <td>` + data.price + `</td>
    </tr>

    <tr>
        <td>Описание</td>
        <td>` + data.description + `</td>
    </tr>    
    
    <tr>
        <td>Картинки</td>
        <td><img width="100" src="` + data.img_1 + `">
    `;

    if(data.img_2 !== ""){
        read_one_product_html += `
        <img width="100" src="` + data.img_2 + `">`
    }
    if(data.img_3 !== ""){
      read_one_product_html += `
      <img width="100" src="` + data.img_3 + `">`
    }
    read_one_product_html += `</td></tr>
</table>`;

            $("#page-content").html(read_one_product_html);

            changePageTitle("Просмотр товара");

        });
    });

});