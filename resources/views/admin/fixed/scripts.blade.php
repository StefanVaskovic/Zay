<script>
    const adminFolder = `{{url('/adminAssets')}}`
    const publicFolder = `{{url('/')}}`
    const methodDelete = `@method('delete')`
    const csrf = `@csrf`
</script>
<script src="{{asset('adminAssets/assets/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
{{--<script src="{{asset('assets/js/Toast-Loading-Indicator-Plugin/jquery.toast.js')}}"></script>--}}
<script src="{{asset('adminAssets/assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('adminAssets/assets/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{asset('adminAssets/assets/js/plugins/bootstrap-switch.js')}}"></script>
<!--  Google Maps Plugin    -->
{{--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>--}}
<!--  Chartist Plugin  -->
<script src="{{asset('adminAssets/assets/js/plugins/chartist.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('adminAssets/assets/js/plugins/bootstrap-notify.jsp')}}"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="{{asset('adminAssets/assets/js/light-bootstrap-dashboard.js')}}?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('adminAssets/assets/js/demo.js')}}"></script>


@yield("additionalScripts")

