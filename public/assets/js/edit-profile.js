$(document).ready(function (){
    const token = $('meta[name="csrf-token"]').attr('content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });


    $(".sectionToShow").css("display","none")
    $(""+section+"").css("display","block")

    $(".section-link").click(function(e){
        e.preventDefault()
        let href = $(this).attr("href")
        $(".sectionToShow").css("display","none")
        $(""+href+"").css("display","block")

        localStorage.setItem('sectionToShow',href);
        section = localStorage.getItem('sectionToShow')

        $("#orderDetails").css('display','none')
        // console.log()
    })

    $("#orderDetails").css('display','none')

    $(document).on('click','.orderInfo',function (){
        let idOrder = $(this).data('idorder')

        $("#orderDetails").css('display','block')

        $.ajax({
            url:publicFolder+'/orderDetails',
            method:'post',
            data:{
                idOrder:idOrder
            },
            success: function (data){
                printOrderDetails(data.orders[0].order_details);
            },
            error: function (error,xhr,status){
                console.log(error)
            }
        });


    })
})


function printOrderDetails(orderDetails)
{
    console.log(orderDetails)
    let x = ``
    let i = 0
    for (const od of orderDetails) {
        x+=`<tr>
                <td class="align-middle text-center">${++i}</td>
                <td class="align-middle text-center"><img src="${publicFolder+'/storage/products/cover/'+od.cover}" alt="${od.name}" width="150px"
                         height="150px"/></td>
                <td class="align-middle text-center"><a href="${publicFolder+"/products/"+od.pivot.product_id}"> ${od.name}</a></td>
                <td class="align-middle text-center">${od.pivot.size}</td>
                <td class="align-middle text-center">${od.pivot.quantity}</td>
                <td class="align-middle text-center">$${od.pivot.price}</td>
            </tr>`
    }


    $('#orderDetailsData').html(x)
}
