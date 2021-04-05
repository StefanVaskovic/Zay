$(document).ready(function (){
    const token = $('meta[name="csrf-token"]').attr('content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });



    $(document).on('click','#btnOrder',function (){
        $.ajax({
            url:'/order',
            method:'post',
            success: function (data){
                localStorage.removeItem('cartItems')
                $('.cart').text(0)

                console.log(data)
                let x = `<div class="text-center alert alert-success">
                           ${data.message}
                        </div>`

                $("#cart").html(x)
            },
            error: function (error,xhr,status){
                console.log(error)
                $("#snackbar").text(error.responseJSON.message)
                toast()
            }
        });
    })

    $(document).on('change','.quantity',function (){
        let input = $(this)
        let quantity = $(this).val()
        let idProduct = $(this).data('idproduct')
        let size = $(this).data('size')

       $.ajax({
            url:'/cart',
            method:'post',
            data:{
                size:size,
                quantity:quantity,
                id:idProduct,
                changeQuantity:'yes'
            },
            success: function (data){
                console.log(data.cartItems)
                if(data.message !== "Quantity is changed!")
                {
                    $("#snackbar").text(data.message)
                    $(input).val(data.max)
                    toast()
                }

                let totalPrice = 0
                for (const item of data.cartItems) {
                    totalPrice+=parseInt(item.price) * parseInt(item.quantity)
                }
                $('.totalPrice').text("$"+totalPrice)

                let product = data.cartItems.find(x=>{
                    if(x.id==idProduct && x.size == size)
                        return true;
                    return false
                })

                let newPrice = product.quantity * product.price
                let tdTag = $(input).parent().siblings('td.price')

                $(tdTag).text("$"+newPrice)

            },
            error: function (error,xhr,status){
                console.log(error)
                $("#snackbar").text(error.responseJSON.message)
                toast()
            }
        });
    })

    $(document).on('click','#btnRemoveFromCart',function (){
        let idProduct = $(this).data('idproduct')
        let size = $(this).data('size')

        let trToRemove = $(this).parents('tr')
        $.ajax({
            url: publicFolder+'/cart/remove',
            method:'delete',
            data:{
                size:size,
                id:idProduct
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

                $(trToRemove).remove()


                let totalPrice = 0
                for (const item of data.cartItems) {
                    totalPrice+=parseInt(item.price) * parseInt(item.quantity)
                }
                $('.totalPrice').text("$"+totalPrice)

                if(totalPrice == 0)
                {
                    let x = ` <div class="text-center alert alert-info">
                            You cart is empty!
                        </div>`

                    $('#cart').html(x)
                }
            },
            error: function (error,xhr,status){
                console.log(error)
            }
        });
    })
})


