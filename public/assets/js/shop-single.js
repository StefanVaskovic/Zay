$('.replyForm').hide();

$(document).ready(function (){
    const token = $('meta[name="csrf-token"]').attr('content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });


    //getProduct(id);
    getComments()

    var rate = 0;
    var index = 0;
    var stars = [];
    var starsWarning = $('.starsWarning')

    /*$('.ratings').hover(
        function (){
            rate = $(this).data('rate')
            index = rate - 1
            starsWarning = $('.starsWarning')
            stars = $(this).parent().children().filter((i,x) => i <= index)

            $('.stars').removeClass('text-warning')
            $('.stars').addClass('text-secondary')
            for (let i = 0; i < stars.length; i++) {

                $(stars[i].firstChild).addClass('text-warning')
                $(stars[i].firstChild).addClass('starsWarning')
                $(stars[i].firstChild).removeClass('text-secondary')
                $(stars[i].firstChild).removeClass('starsSecondary')
            }

        },
        function (){
            $('.stars').removeClass('text-warning')
            $('.stars').removeClass('starsWarning')
            $('.stars').addClass('text-secondary')
            $('.stars').addClass('starsSecondary')
            for (let i = 0; i < starsWarning.length; i++) {
                $(starsWarning[i]).addClass('text-warning')
                $(starsWarning[i]).addClass('starsWarning')
                $(starsWarning[i]).removeClass('text-secondary')
                $(starsWarning[i]).removeClass('starsSecondary')
            }
        }
    )*/

    $(document).on('click','.ratings',function (){
        let rate = $(this).data('rate')

        $.ajax({
            url: publicFolder+'/rate',
            method:'post',
            data:{
                rate:rate,
                idProduct:id
            },
            dataType: 'json',
            success: function (data){

                $(starsWarning).removeClass('text-warning')
                $(starsWarning).removeClass('starsWarning')
                $(starsWarning).addClass('text-secondary')
                $(starsWarning).addClass('starsSecondary')
                for (let i = 0; i < rate; i++) {
                    $($('.stars')[i]).addClass('text-warning')
                    $($('.stars')[i]).addClass('starsWarning')
                    $($('.stars')[i]).removeClass('text-secondary')
                    $($('.stars')[i]).removeClass('starsSecondary')
                }

                starsWarning = $('.starsWarning')
            },
            error: function (error,xhr,status){
                console.log(error)
                $("#snackbar").text('You need to be logged in to be able to rate a product!')
                toast()
            }
        });
    })

    $(document).on('click','#btnAddToCart',function (){
        if(idUser == ''){
            $("#snackbar").text('You need to be logged in to be able to add to cart!')
            toast()
            return;
        }

        let size = $('input[name=product-size]').val();
        let quantity = $('input[name=product-quanity]').val();
        let form = $(this).parents('form')[0]

        $.ajax({
            url:'/cart',
            method:'post',
            data:{
                size:size,
                quantity:quantity,
                id:id
            },
            dataType: 'json',
            success: function (data){
                console.log(data.cartItems)

                if(localStorage.getItem('cartItems') != null) {
                    localStorage.setItem('cartItems',JSON.stringify(data.cartItems))
                    countOfItemsInCart = JSON.parse(localStorage.getItem('cartItems')).length
                }else{
                    localStorage.setItem('cartItems',JSON.stringify(data.cartItems))
                    countOfItemsInCart = 1
                }
                $('.cart').text(countOfItemsInCart)
                $("#snackbar").text(data.message)
                toast()
                $("#errors").html('')
            },
            error: function (error,xhr,status){
                console.log(error)
                if(error.responseJSON.errors != undefined)
                {
                    printCartErrors(error.responseJSON.errors)
                }
                else
                {
                    $("#snackbar").text(error.responseJSON.message)
                    toast()
                }
            }
        });
    })



    function printCartErrors(errors)
    {
        let x = `<div class="alert alert-danger col-md-12 m-auto mt-2">`
        for (const i in errors) {
            x+=`
                <ul>
                    <li>${errors[i]}</li>
                </ul>
            `
        }
        x+=`</div>`
        $("#errors").html(x)
    }



    $(document).on('click','.reply',function (e){
        e.preventDefault()

        console.log(idUser)
        if(idUser == ''){
            $("#snackbar").text('You need to be logged in to be able to comment!')
            toast()
            return;
        }

        let form = $(this).parent().children('form');

        if($(form).data('loggedin') == null)
        {
            $("#snackbar").text('You need to be logged in to be able to send a comment!')
            toast()
            return
        }

        if($(form).is(':hidden')) {
            $('.replyForm').hide('slow');
            $(form).show('slow')
        }

    })

    $(document).on('click','.like',function (e){
        e.preventDefault()

        if(idUser == ''){
            $("#snackbar").text('You need to be logged in to be able to like comment!')
            toast()
            return;
        }
        let idcomment = $(this).data('idcommentlike');
        let idproduct = $(this).data('idproduct');

        console.log(idcomment)
        console.log(idproduct)


        $.ajax({
            url:'/api/likes',
            method:'post',
            data:{
                product_id:idproduct,
                comment_id:idcomment
            },
            dataType: 'json',
            success: function (data){
                console.log(data)
                printComments(data.product,data.product.comments,data.comments,data.users,data.only_for_checking_if_user_liked_a_comment)
                //printProduct(data.product, data.comments, data.commentDetails)
            },
            error: function (error,xhr,status){
                printErrors(error.responseJSON.errors.text,form)
            }
        });

    })

    $(document).on('click','.send',function (){


        let form = $(this).parents('form')[0]

        if(idUser == ''){
            $("#snackbar").text('You need to be logged in to be able to comment!')
            toast()
            return;
        }

        let textarea = $(form).find('textarea')[0]
        let text = $(textarea).val()
        let user_replied_id = $(form).data('iduser')
        let comment_id = $(form).data('idcomment')
        let product_id = $(form).data('idproduct')

        console.log(text)
        console.log(user_replied_id)
        console.log(comment_id)
        console.log(product_id)

        $.ajax({
            url:'/api/comments',
            method:'post',
            data:{
                text:text,
                user_replied_id:user_replied_id,
                comment_id:comment_id,
                product_id:product_id
            },
            dataType: 'json',
            success: function (data){
                console.log(data)
                printComments(data.product,data.product.comments,data.comments,data.users,data.only_for_checking_if_user_liked_a_comment)
                //printProduct(data.product, data.comments, data.commentDetails)
            },
            error: function (error,xhr,status){
                printErrors(error.responseJSON.errors.text,form)
            }
        });

    })

    $(document).on('click','#btnMainComment',function (){


        if(idUser == ''){
            $("#snackbar").text('You need to be logged in to be able to comment!')
            toast()
            return;
        }

        let form = $(this).parents('form')[0]

        let textarea = $(form).find('textarea')[0]
        let text = $(textarea).val()

        console.log(text)


        $.ajax({
            url:'/api/mainComments',
            method:'post',
            data:{
                text:text,
                product_id:id
            },
            dataType: 'json',
            success: function (data){
                console.log(data)
                printComments(data.product,data.product.comments,data.comments,data.users,data.only_for_checking_if_user_liked_a_comment)
                //printProduct(data.product, data.comments, data.commentDetails)
            },
            error: function (error,xhr,status){
                printErrors(error.responseJSON.errors.text,form)
            }
        });

    })


})

var repliedUser = ''

function getComments() {
    $.ajax({
        url:'/api/comments/'+id,
        method:'get',

        dataType: 'json',
        success: function (data){
/*            console.log(data)*/
            printComments(data.product,data.product.comments,data.comments,data.users,data.only_for_checking_if_user_liked_a_comment)
            //printProduct(data.product, data.comments, data.commentDetails)
        },
        error: function (error,xhr,status){
            printErrors(error.responseJSON.errors.text,form)
        }
    });
}


function printComments(product,comments,liked_comments,users,only_for_check) {
    let x=``
    var totalComments = 0
    let i = 0;
    for (const comment of comments) {
        if(comment.pivot.parent_id == null && comment.pivot.user_replied_id == null){
            x+=`
<div class="single-comment-item">
    <div class="sc-author">
        <img src="${publicFolder+"/assets/img/profile_image.png"}" alt="${comment.name}">
    </div>
    <div class="sc-text">
        <span>${comment.pivot.date}</span>
        <h5>${comment.name}</h5>
        <p>${comment.pivot.text}</p>
        <a href="#" class="like" data-idproduct="${product.id}" data-idcomment="${comment.pivot.id}" data-idcommentlike="${comment.pivot.id}"
           data-iduser="${comment.id}" data-form="${i}" data-loggedin=""><i class="fa fa-thumbs-up ${checkIfLikedComment(only_for_check,comment) ? 'yes_liked' : 'no_liked'}"></i></a>${liked_comments[i].liked_comments.length}
        <a href="#" class="comment-btn reply" data-idcomment="${comment.pivot.id}"
           data-iduser="${comment.id}" data-form="${i}" data-loggedin=""><i class="fa fa-mail-reply"></i></a>
        <form class="replyForm" data-idproduct="${product.id}" data-idcomment="${comment.pivot.id}"
           data-iduser="${comment.id}" data-form="${i}" data-loggedin="">
            <div class="mb-3">
                <textarea class="form-control mt-1" rows="8"></textarea>
            </div>
            <p class="error text-danger"></p>
            <div class="row">
                <div class="col text-end mt-2">
                    <input  class="btn btn-success btn-lg px-3 send" type="button" value="Send"/>
                </div>
            </div>
        </form>
    </div>
</div>
`

            let j = 0;
            for (const c of comments) {
                if(comment.pivot.id == c.pivot.parent_id)
                {
                    x+=`${printSubComments(comment,c,users,liked_comments[j].liked_comments.length,j,only_for_check)}`
                }
                j++
            }

        }


        i++

        totalComments++
    }

    function printSubComments(comment,subComment,users,likes,j,only_for_check) {


        let x = ``
            findRepliedUser(subComment)
            x+=`<div class="single-comment-item reply-comment">
        <div class="sc-author">
            <img src="${publicFolder+"/assets/img/profile_image.png"}" alt="${subComment.name}">
        </div>
        <div class="sc-text">
            <span>${subComment.pivot.date}</span>
            <h5>${subComment.name}</h5>

            <p><span>@ ${repliedUser}</span> ${subComment.pivot.text}</p>
            <a href="#" class="comment-btn like" data-idproduct="${product.id}" data-idcommentlike="${subComment.pivot.id}" data-idcomment="${subComment.pivot.parent_id}"
               data-iduser="${subComment.id}" data-form="${j}" data-loggedin=""><i class="fa fa-thumbs-up ${checkIfLikedSubComment(only_for_check,subComment) ? 'yes_liked' : 'no_liked'}"></i></a>${likes}
            <a href="#" class="comment-btn reply" data-idcomment="${subComment.pivot.parent_id}"
               data-iduser="${subComment.id}" data-form="${j}" data-loggedin=""><i class="fa fa-mail-reply"></i></a>
            <form class="replyForm" data-idproduct="${product.id}" data-idcomment="${subComment.pivot.parent_id}"
               data-iduser="${subComment.id}" data-form="${j}" data-loggedin="">
                <div class="mb-3">
                    <textarea name="comment" class="form-control mt-1" rows="8"></textarea>
                </div>
                <p class="error text-danger"></p>
                <div class="row">
                    <div class="col text-end mt-2">
                        <input  class="btn btn-success btn-lg px-3 send" type="button" value="Send"/>
                    </div>
                </div>
            </form>
        </div>
    </div>`

            j++


        return x

    }


    function findRepliedUser(subComment) {

        $.ajax({
            url:'/getUser/'+subComment.pivot.user_replied_id,
            method:'get',
            async: false,
            dataType: 'json',
            success: function (data){

                repliedUser = data.name;
                console.log(repliedUser)
                console.log(data.name)
                //printProduct(data.product, data.comments, data.commentDetails)
            },
            error: function (error,xhr,status){
                printErrors(error.responseJSON.errors.text,form)
            }
        });
        console.log(subComment)
        /*let repliedUser = ''

        for (const u of users) {
            if(u.id == subComment.pivot.user_replied_id)
            {
                repliedUser = u.name
            }
        }

        return repliedUser*/
    }

    function checkIfLikedComment(liked,comment) {
/*        console.log(liked)
        console.log(comment)*/
        for (const l of liked) {
            if(l.comment_id == comment.pivot.id && l.userWhoLiked == idUser)
            {
                return  true
            }
        }

        return false
    }

    function checkIfLikedSubComment(liked,subComment) {
        /*console.log(liked)
        console.log(subComment)*/
        for (const l of liked) {
            if(l.comment_id == subComment.pivot.id && l.userWhoLiked == idUser)
            {
                return  true
            }
        }

        return false
    }


    $('#comments').html(x)
    $('#comments').prepend(`<h4>${totalComments} Comments</h4>`)
    $('#numOfComments').html(` ${totalComments}`)
    $('.replyForm').hide();
}


function printErrors(errors,form) {
    let p = $(form).find('p')[0]

    p.innerText = errors[0]
}





function getProduct(id) {
    $.ajax({
        url:'/api/products/'+id,
        method:'get',
        dataType: 'json',
        success: function (data){
            console.log(data)
            printProduct(data.product, data.comments, data.commentDetails)
        },
        error: function (error,xhr,status){
            console.log(error.responseText)
        }
    });
}

function printPrevious(images) {
    if(images.length / 3 > 1)
    {
        return `<a href="#multi-item-example" role="button" data-bs-slide="prev">
                                  <i class="text-dark fa fa-chevron-left"></i>
                                  <span class="sr-only">Previous</span>
                              </a>`
    }
}

function printNext(images) {
    if(images.length / 3 > 1) {
        return `<a href="#multi-item-example" role="button" data-bs-slide="next">
                                  <i class="text-dark fa fa-chevron-right"></i>
                                  <span class="sr-only">Next</span>
                              </a>`
    }
}

var iterator = function(a, n) {
    var current = 0,
        l = a.length;
    return function() {
        end = current + n;
        var part = a.slice(current,end);
        current =  end < l ? end : 0;
        return part;
    };
};

function printSlider(images) {
    var threeImages = iterator(images, 3);
    let y = ``
    for($i = 0; $i < images.length/3; $i++){

        y+= `<div class="carousel-item @if($i == 0) active @endif">
    <div class="row">
        ${iterateThreeImages(threeImages())}
    </div>
</div>`;
    }

    return y

    function iterateThreeImages(threeImages) {
        let x = ``
        for (const image of threeImages) {
            x+=`<div class="col-4">
            <a href="#">
                <img class="card-img img-fluid" src="${image.image}}" alt="Product Image 1">
            </a>
        </div>`
        }

        return x
    }
}



function printProduct(product,comments,commentDetails) {
    let x = `<div class="col-lg-5 mt-5">
                      <div class="card mb-3" id="cover">
                          <img class="card-img img-fluid" src="${product.cover}" alt="${product.name}"
                               id="product-detail">
                      </div>
                      <div class="row">
                          <!--Start Controls-->

                          <div class="col-1 align-self-center">
                            ${printPrevious(product.images)}
                          </div>

                          <!--End Controls-->
                          <!--Start Carousel Wrapper-->

                          <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item" data-bs-ride="carousel">
                              <!--Start Slides-->
                              <div class="carousel-inner product-links-wap" role="listbox">
                                   ${printSlider(product.images)}

                              </div>
                              <!--End Slides-->
                          </div>
                          <!--End Carousel Wrapper-->
                          <!--Start Controls-->
                          <div class="col-1 align-self-center">
                                ${printNext(product.images)}


                          </div>

                          <!--End Controls-->
                      </div>
                  </div>
                  <!-- col end -->
                  <div class="col-lg-7 mt-5">
                      <div class="card">
                          <div class="card-body">
                              <h1 class="h2">${product.name}</h1>
                              <p class="h3 py-2">${product.current_price}</p>
                              <p class="py-2">
                                  Rating:
                                  @if($product->rate!=0)
                                      @for($i = 0;$i<$product->rate;$i++)
                                      <i class="fa fa-star text-warning"></i>
                                      @endfor
                                      @for($i = 0;$i<5-$product->rate;$i++)
                                          <i class="fa fa-star text-secondary"></i>
                                      @endfor
                                  @else
                                      Not rated yet.
                                  @endif
                                  <span class="list-inline-item text-dark">| {{count($newComments)}}
                                      Comments</span>
                              </p>
                              <ul class="list-inline">
                                  <li class="list-inline-item">
                                      <h6>Brand: </h6>
                                  </li>
                                  <li class="list-inline-item">
                                      <p class="text-muted"><strong>{{$product->brand->name}}</strong></p>
                                  </li>
                              </ul>
                              <ul class="list-inline">
                                  <li class="list-inline-item">
                                      <h6>Color :</h6>
                                  </li>
                                  <li class="list-inline-item">
                                      <p class="text-muted"><strong>{{$product->color}}</strong></p>
                                  </li>
                              </ul>
                              <h6>Description:</h6>
                              <p>{{$product->description}}</p>
                              <form action="" method="GET">
                                  <input type="hidden" name="product-title" value="Activewear">
                                  <div class="row">
                                      <div class="col-auto">
                                          <ul class="list-inline pb-3">
                                              <li class="list-inline-item">Size :
                                                  <input type="hidden" name="product-size" id="product-size" value="S">
                                              </li>
                                              <li class="list-inline-item"><span class="btn btn-success btn-size">S</span></li>
                                              <li class="list-inline-item"><span class="btn btn-success btn-size">M</span></li>
                                              <li class="list-inline-item"><span class="btn btn-success btn-size">L</span></li>
                                              <li class="list-inline-item"><span class="btn btn-success btn-size">XL</span></li>
                                          </ul>
                                      </div>
                                      <div class="col-auto">
                                          <ul class="list-inline pb-3">
                                              <li class="list-inline-item text-right">
                                                  Quantity
                                                  <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                              </li>
                                              <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                                              <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                              <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                                          </ul>
                                      </div>
                                  </div>
                                  <div class="row pb-3">
                                      <div class="col d-grid">
                                          <button type="submit" class="btn btn-success btn-lg" name="submit" value="buy">Buy</button>
                                      </div>
                                      <div class="col d-grid">
                                          <button type="submit" class="btn btn-success btn-lg" name="submit" value="addtocard">Add To Cart</button>
                                      </div>
                                  </div>
                              </form>

                          </div>
                      </div>



                  </div>`;

    $('#product').html(x)

}
