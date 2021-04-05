
<script src="{{asset('assets/js/jquery-1.11.0.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-migrate-1.2.1.min.js')}}"></script>
<script>
    const publicFolder = `{{url('/')}}`

    /*var countOfItemsInCart = 0
    if(localStorage.getItem('countOfItemsInCart') != null)
    {
        countOfItemsInCart = parseInt(localStorage.getItem('countOfItemsInCart'))
    }
    $('.cart').text(countOfItemsInCart)*/

    var countOfItemsInCart = 0
    if(localStorage.getItem('cartItems') != null)
    {
        countOfItemsInCart = JSON.parse(localStorage.getItem('cartItems')).length
    }
    console.log(countOfItemsInCart)
    $('.cart').text(countOfItemsInCart)

    $(document).on('click','#Logout',function (){
        localStorage.removeItem('cartItems')
        localStorage.removeItem('sectionToShow')
    })

    function toast() {
        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }
</script>

<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/templatemo.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>

@yield("additionalScripts")
