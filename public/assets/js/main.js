$(document).ready(function (){
    const token = $('meta[name="csrf-token"]').attr('content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    function ajaxFilterSortSearchPagination(page, catIds, gender, search, sort, sizes, printProducts) {
        $.ajax({
            url: '/api/products',
            method: 'get',
            data: {
                page: page,
                catIds: catIds,
                gender: gender,
                search: search,
                sort: sort,
                sizes: sizes
            },
            dataType: 'json',
            success: function (data) {
                console.log(data)
               /* if(data.products.length == 0){
                    $("#products").html(`<h2>There is no products with this type of criteria!</h2>`)
                    return
                }*/
                printProducts(data.products, data.pages, data.page)
            },
            error: function (error, xhr, status) {
                console.log(error)
            }
        });
    }

    function getProducts()
    {
        $.ajax({
           url:'/api/products',
           method:'get',
           dataType: 'json',
           success: function (data){
               console.log(data)

               printProducts(data.products, data.pages, data.page)
           },
           error: function (error,xhr,status){
                console.log(error.responseText)
           }
        });
    }

    function getCategories() {
        $.ajax({
            url:'/api/categories',
            method:'get',
            dataType: 'json',
            success: function (data){
                printCategories(data)
                printGenders()

            },
            error: function (error,xhr,status){
                console.log(error.responseText)
            }
        });
    }

    function getSizes() {
        $.ajax({
            url:'/api/sizes',
            method:'get',
            dataType: 'json',
            success: function (data){
                printSizes(data)
            },
            error: function (error,xhr,status){
                console.log(error.responseText)
            }
        });
    }

    getProducts()
    getCategories()
    getSizes()

    function printSizes(data)
    {
        console.log(data)
        let x = ``;

        for (const item of data) {
            x += `<li class="pb-3">
                <input type="checkbox" class="sizes" name="sizes[]" value="${item.id}"/> ${item.size}
            </li> `
        }
        $("#sizes").html(x)
    }

    function printCategories(data) {
        let x=``
        for (const cat of data) {
           /* x+=`<li class="pb-3">
                            <li><a class="text-decoration-none categories" data-idCat="${cat.id}" href="#">${cat.name}</a></li>
                    </li>`*/
            x+=`<li class="pb-3">
                    <input type="checkbox" class="categories" name="categories[]" value="${cat.id}"/> ${cat.name}
                </li>`
        }
        $("#categories").html(x)


    }

    function printGenders() {
        let x=``
        let genders = ["All","Male","Female"];
        for (let i = 0; i < genders.length ;i++) {
            x+=`<li class="pb-3">
                        <input type="radio" class="genders" name="genders[]" value="${genders[i]}"/> ${genders[i]}
                    </li>`
        }
        $("#genders").html(x)
    }

    function printProducts(products,pages,page)
    {
        if(products.length != 0){
        let x = ``;
        for (const item of products) {
            x+=`<div class="col-md-4">
    <div class="card mb-4 product-wap rounded-0">
        <div class="card rounded-0">
            <img class="card-img rounded-0 img-fluid" src="${baseUrl+'/storage/products/cover/'+item.cover}">
            <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                <ul class="list-unstyled">
                    <li><a class="btn btn-success text-white mt-2" href="${productsShow+'/'+item.id}"><i class="fa fa-eye"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <a href="${productsShow+'/'+item.id}" class="h3 text-decoration-none">${item.name}</a>
            <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                <li>
                 ${printSizesForProduct(item.sizes,item)}
                </li>

                <!--<li class="pt-2">
                    <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                    <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                    <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                    <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                    <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                </li>-->
            </ul>
            <p><b>Category:</b> ${item.category.name}</br>
            <b>Gender:</b> ${item.gender}</p>

            <ul class="list-unstyled d-flex justify-content-center mb-1">
                <li>
                ${printStars(item.rate)}
                    <!--<i class="text-warning fa fa-star"></i>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-muted fa fa-star"></i>
                    <i class="text-muted fa fa-star"></i>-->
                </li>
            </ul>

            <p class="text-center mb-0">$${item.current_price}</p>
            <del class="text-center text-danger form-control-sm mb-0">${item.discount_price != null? `${'$'+item.discount_price}` : ''}</del>
        </div>
    </div>
</div>
`
            }

            $("#products").html(x)
        }
        else{
            $("#products").html(`<h2>There is no products with this type of criteria!</h2>`)
        }

        printPages(pages,page);
    }

    function printStars(rate) {
        let y = ``
        if(rate != null)
        {
            for (let i = 0; i < rate; i++) {
                y+=`<i class="text-warning fa fa-star"></i>`
            }
            for (let i = 0; i < 5 - rate; i++) {
                y+=`<i class="text-muted fa fa-star"></i>`
            }
        }
        else
        {
            y = `<h5>Zero votes</h5>`
        }

        return y
    }

    function printPages(pages,page) {
        let x =``;
        for (let i = 1; i <= pages ; i++) {
            x+=`<li class="page-item ${page==i ? "disabled" : ""}">
                <a class="page-link page-pagination  ${page==i ? "active" : ""} rounded-0 mr-3
                                shadow-sm border-top-0 border-left-0" data-page="${i}" href="#"
                   tabindex="-1">${i}</a></li>`
        }

        $("#pages").html(x)

    }

    function printSizesForProduct(sizes,product) {
        let x = `<b>Sizes: </b> `

        let i = 0
        let newSizes = product.sizes.filter((s)=>s.pivot.quantity != 0);
        if(newSizes.length == 0)
        {
            x = `<h3 style="color: red;padding: 3px;">Not in stock.</h3>`
            console.log(x)
        }
        for (const item of newSizes) {
            /*if(item.pivot.quantity != 0)
            {*/
                if(i == newSizes.length - 1)
                {
                    x+=`${item.size} `
                }
                else
                {
                    x+=`${item.size} / `
                }

/*            }*/
            i++
        }
        return x

    }

    var page = 1;
    var catIds = [];
    var gender = "All";
    var search = "";
    var sort = "0";
    var sizes = [];

    $(document).on('click','.page-pagination',function (e) {
        e.preventDefault();
        page = parseInt($(this).data('page'));
        ajaxFilterSortSearchPagination(page, catIds, gender, search, sort, sizes, printProducts);
    })

    $(document).on('change','.categories',function (e) {
        e.preventDefault();
        let idcat = parseInt($(this).val());
        catIds.indexOf(idcat) == -1 ? catIds.push(idcat) : catIds.splice(catIds.indexOf(idcat),1)
        ajaxFilterSortSearchPagination(page, catIds, gender, search, sort, sizes, printProducts);
    })

    $(document).on('change','.genders',function () {
        gender = $(this).val();
        ajaxFilterSortSearchPagination(page, catIds, gender, search, sort, sizes, printProducts);
    })

    $(document).on('keyup','#search',function () {
        search = $(this).val();
        ajaxFilterSortSearchPagination(page, catIds, gender, search, sort, sizes, printProducts);
    })

    $(document).on('change','#sort',function () {
        sort = $(this).val();
        ajaxFilterSortSearchPagination(page, catIds, gender, search, sort, sizes, printProducts);
    })


    $(document).on('change','.sizes',function () {
        let size = $(this).val();
        sizes.indexOf(size) == -1 ? sizes.push(size) : sizes.splice(sizes.indexOf(size),1)
        ajaxFilterSortSearchPagination(page, catIds, gender, search, sort, sizes, printProducts);
    })

})
