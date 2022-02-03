<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
<div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
    <div class="wrapper wrapper--w780">
        <div class="card card-3">
            <div class="card-heading" style='background: url("{{$employee->getImage()}}") center center/contain no-repeat;'></div>
            <div class="card-body">
                <h2 class="title">Registration Info</h2>

                <form method="POST" action="{{route('employeers.create')}}" enctype="multipart/form-data">
                    @csrf
                @method('put')
                    <div class="input-group">
                        <input class="input--style-3" type="text" placeholder="{{$employee->first_name}}" readonly="readonly" name="firstname">
                    </div>
                    <div class="input-group">
                        <input class="input--style-3" type="text" placeholder="{{$employee->patronomic}}" name="patronomic" readonly="readonly">
                    </div>     <td></td>


                    <div class="input-group">
                        <input class="input--style-3" type="text" placeholder="{{$employee->last_name}}" name="lastname"readonly="readonly">
                    </div>
                    <div class="input-group">
                        <div class="rs-select2 js-select-simple select--no-search">
                            <select name="specialization">
                                <option disabled="disabled" selected="selected">{{$employee->specialization->title}}</option>


                            </select>
                            <div class="select-dropdown"></div>
                        </div>
                    </div>
                    <div class="text-group">
                        <textarea class="input--style-3"  rows="3" cols="25" placeholder="Умения" name="skill"> </textarea>
                    </div>


                </form>
            </div>
        </div>

    </div>

</div>

<!-- Jquery JS-->;
<script>document.querySelector("textarea[name=skill]").value="{{$employee->getSkillsTitles()}}"</script>

<script src="vendor/jquery/jquery.min.js"></script>
<!-- Vendor JS-->
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/datepicker/moment.min.js"></script>
<script src="vendor/datepicker/daterangepicker.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- Main JS-->
<script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->