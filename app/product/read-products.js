jQuery(function($) {

    // показать список товаров при первой загрузке
    showProductsFirstPage();

    // когда была нажата кнопка «Все товары»
    $(document).on("click", ".read-products-button", function() {
        showProductsFirstPage();
    });

    $(document).on("click", ".pagination li", function() {
        // получаем json url
        let json_url=$(this).find("a").attr("data-page");

        // покажем список товаров
        showProducts(json_url);
    });

    $(document).on("click", "#sort", function() {
        // получаем json url
        let json_url=$(this).find("a").attr("data-sort");

        // покажем список товаров
        showProducts(json_url);
    });

});

function showProductsFirstPage() {
    let json_url="http://test-task/api/product/paging.php";
    showProducts(json_url);
}

function showProducts(json_url) {

    $.getJSON(json_url, function(data) {

        let read_products_html = `
            <button id="create-product" class="create-product-button m-b-10px btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span> Создание товара
            </button>`;
        read_products_html+= `
        
          <div class="btn-group m-b-10px">
          <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i> Сортировка</a>
          <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li id="sort"><a data-sort="http://test-task/api/product/paging.php?sort=date&atr=asc">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M3.47 7.78a.75.75 0 010-1.06l4.25-4.25a.75.75 0 011.06 0l4.25 4.25a.75.75 0 01-1.06 1.06L9 4.81v7.44a.75.75 0 01-1.5 0V4.81L4.53 7.78a.75.75 0 01-1.06 0z"></path></svg>
             По дате</a></li>
            <li id="sort"><a data-sort="http://test-task/api/product/paging.php?sort=date&atr=desc">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M13.03 8.22a.75.75 0 010 1.06l-4.25 4.25a.75.75 0 01-1.06 0L3.47 9.28a.75.75 0 011.06-1.06l2.97 2.97V3.75a.75.75 0 011.5 0v7.44l2.97-2.97a.75.75 0 011.06 0z"></path></svg>
             По дате</a></li>
            <li id="sort"><a data-sort="http://test-task/api/product/paging.php?sort=price&atr=asc">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M3.47 7.78a.75.75 0 010-1.06l4.25-4.25a.75.75 0 011.06 0l4.25 4.25a.75.75 0 01-1.06 1.06L9 4.81v7.44a.75.75 0 01-1.5 0V4.81L4.53 7.78a.75.75 0 01-1.06 0z"></path></svg>
             По цене</a></li>
            <li id="sort"><a data-sort="http://test-task/api/product/paging.php?sort=price&atr=desc">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M13.03 8.22a.75.75 0 010 1.06l-4.25 4.25a.75.75 0 01-1.06 0L3.47 9.28a.75.75 0 011.06-1.06l2.97 2.97V3.75a.75.75 0 011.5 0v7.44l2.97-2.97a.75.75 0 011.06 0z"></path></svg>
             По цене</a></li>
          </ul>
        </div>`;

    read_products_html+= ` 
 <table class="table">
     <thead>
     <tr>
        <th scope="col">Название</th>
        <th scope="col">Изображение</th>
        <th scope="col">Цена</th>
        <th scope="col">Действие</th>
     </tr>
    </thead>`;


        $.each(data.content, function (key, val) {

            read_products_html += `
        <tr>
            <td>` + val.title + `</td>
            <td><img width="100" src="` + val.img_1 + `"></td>
            <td>` + val.price + `</td>

            <td>
                <button class="btn btn-primary m-r-10px read-one-product-button" data-id="` + val.id + `">
                    <span class="glyphicon glyphicon-eye-open"></span> Просмотр
                </button>
            </td>

        </tr>`;
        });


        read_products_html += `</table>`;

        if (data.paging) {
            read_products_html+=`<ul class="pagination justify-content-center">`;

                if(data.paging.first!=""){
                    read_products_html += `<li class="page-item" ><a class="page-link" data-page="`+ data.paging.first +`">Первая страница</a></li>`;
                }

                $.each(data.paging.pages, function(key, val) {
                    let active_page;
                    if(val.current_page == "yes"){
                        active_page = ` active`;
                    }else{
                        active_page = ` `;
                    }
                    read_products_html += `<li class="page-item` + active_page + `"><a class="page-link" data-page="` + val.url + `">` + val.page + `</a></li>`;
                });

                if (data.paging.last != "") {
                    read_products_html+=`<li class="page-item"><a class="page-link" data-page="` + data.paging.last + `">Последняя страница</a></li>`;
                }
            read_products_html+="</ul>";
        }

        $("#page-content").html(read_products_html);

        // изменим заголовок страницы
        changePageTitle("Все товары");

    });

}

