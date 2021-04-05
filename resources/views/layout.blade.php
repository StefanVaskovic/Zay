
<!DOCTYPE html>
<html lang="en">

<head>
    @include("fixed.head")
</head>

<body>
<!-- Start Top Nav -->
@include("fixed.nav")
<!-- Close Top Nav -->


<!-- Header -->
@include("fixed.header")
<!-- Close Header -->

@yield("content")


<!-- Start Footer -->
@include("fixed.footer")
<!-- End Footer -->

<!-- Start Script -->
@include("fixed.scripts")
<!-- End Script -->
</body>

</html>
