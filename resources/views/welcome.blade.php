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

<button type="button" class="clearEmployer btn btn-primary btn-lg pull-right" data-toggle="modal"
        data-target="#addArticle">Добавить AJAX
</button>
<table class="table" id="empoyeerstable">
    <thead>
    <tr>
        <th>#</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Фамилия</th>
        <th>Специализация</th>
        <th>Умения</th>
        <th>Аватар</th>
    </tr>
    </thead>
    <tbody>
    @foreach($employees as $employee)
        <tr id="row{{ $employee->id }}">
            <th scope="row">{{$employee->id}}</th>
            <td id="firstname{{ $employee->id }}"><a
                        href="{{ route('profile',  $employee->id) }}">{{$employee->first_name}}</a></td>
            <td id="patronomic{{ $employee->id }}">{{$employee->patronomic}}</td>
            <td id="lastname{{ $employee->id }}">{{$employee->last_name}}</td>
            <td data-id={{$employee->specialization->id}} id="specialization{{ $employee->id }}">{{$employee->specialization->title}}</td>
            <td id="skill{{ $employee->id }}">{{$employee->getSkillsTitles()}}</td>
            <td><img id="image{{ $employee->id }}" src="{{$employee->getImage()}}" height="42" width="42"></td>
            <td>

                <button class="editEmployer" data-id="{{ $employee->id }}" data-target="#addArticle"
                        data-toggle="modal" data-token="{{ csrf_token() }}">Edit
                </button>
            <td>
                <button class="deleteEmployer" data-id="{{ $employee->id }}" data-token="{{ csrf_token() }}">
                    Delete
                </button>
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
</div>

<div class="modal fade" id="addArticle" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="wrapper wrapper--w780">
                <div class="card card-3">


                    <div class="card-body">
                        <div class="">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        style="color:#ffffff;">&times;</span></button>
                            <h2 class="title">Registration Info</h2>
                        </div>
                        <form name="forma" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="isadd" value="0">

                            <div class="input-group">
                                <input class="input--style-3" type="text" required placeholder="Имя" name="firstname">
                            </div>
                            <div class="input-group">
                                <input class="input--style-3" type="text" required placeholder="Отчество"
                                       name="patronomic">
                            </div>
                            <div class="input-group">
                                <input class="input--style-3" type="text" required placeholder="Фамилия"
                                       name="lastname">
                            </div>
                            <div class="input-group">
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select required name="specialization" id="select0">
                                        <!--   <option disabled="disabled"  selected="selected">Специализация</option>-->
                                        @foreach($specializations as $specialization)
                                            <option value="{{$specialization->id}}">{{$specialization->title}}</option>
                                        @endforeach
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                            <label required class="input--style-3">Скилы (разделитель запятая)</label>
                            <div class="text-group">
                                <textarea class="input--style-3" rows="3" cols="55" placeholder="Умения"
                                          id="textarea" name="skill"> </textarea>

                            </div>
                            <div class="text-group" style="text-align: center;">
                                <img id="avatar_image"
                                     src="{{ isset($employee) ? $employee->getImage() : 'Default Image' }}" width=30%>
                            </div>
                            <div class="p-t-10">
                                <input style="font-size:10px" class="btn btn--pill btn--green" type="file" name="avatar"
                                       id="avatar">
                            </div>

                            <div class="p-t-10">
                                <button type="button" id="AddAjax" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Jquery JS-->
<script src="vendor/jquery/jquery.min.js"></script>
<!-- Vendor JS-->
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/datepicker/moment.min.js"></script>
<script src="vendor/datepicker/daterangepicker.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- Main JS-->
<script src="js/global.js"></script>
<script>
    $(".deleteEmployer").click(function () {
        var id = $(this).data("id");
        $.ajax(
            {
                url: "/delete/" + id,
                type: 'DELETE',
                dataType: "JSON",
                data: {
                    "id": id,
                    "_token": "{{ csrf_token() }}"
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $("#row" + id).remove();
                }
            });
        $("#row" + id).remove();
    });
    $(".editEmployer").click(function () {

        var id = $(this).data("id");

        document.querySelector("input[name=firstname]").value = $('#firstname' + id).text();
        document.querySelector("input[name=patronomic]").value = $('#patronomic' + id).text();
        document.querySelector("input[name=lastname]").value = $('#lastname' + id).text();
        document.querySelector("textarea[name=skill]").value = $('#skill' + id).text();

        $('#select0').val($('#specialization' + id).data("id")).change();
        $("#avatar_image").attr("src", $('#image' + id).attr('src'));
//        $('#backimage').css('background', ' + $('#image' + id).attr('src') + '") center center/contain no-repeat;');
        document.querySelector("input[name=isadd]").value = id;
    });
    $(".clearEmployer").click(function () {

        var id = $(this).data("id");

        document.querySelector("input[name=firstname]").value = '';
        document.querySelector("input[name=patronomic]").value = '';
        document.querySelector("input[name=lastname]").value = '';
        document.querySelector("textarea[name=skill]").value = '';
        $("#avatar_image").attr("src", 'img/no-image.png');
        // $('#select0').val($('#specialization' + id).data("id")).change();
        document.querySelector("input[name=id]").value = 0;
    });
    $(function () {
        $('#AddAjax').on('click', function () {
            var formData = new FormData();
            var image = $('#avatar');
            //    alert(document.forma.isadd.value);
            formData.append('id', document.forma.isadd.value);
            formData.append('avatar', image[0].files[0]);
            formData.append('firstname', document.forma.firstname.value);
            formData.append('lastname', document.forma.lastname.value);
            formData.append('patronomic', document.forma.patronomic.value);
            formData.append('specialization', document.forma.specialization.value);
            formData.append('skill', document.forma.skill.value);
            formData.append('_token', "{{ csrf_token() }}");
            $.ajax({
                url: '{{ route('employeers.store') }}',
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#addArticle').modal('hide');
                    var str = '<tr><td>' + data['id'] +
                        '</td><td><a href="\\' + data['id'] + '">' + data['firstname'] + '</a></td>' +
                        '<td>' + data['patronomic'] + '</td>' +
                        '<td>' + data['lastname'] + '</td>' +
                        '<td>' + data['specialization'] + '</td>' +
                        '<td>' + data['skill'] + '</td>' +
                        '<td><img height="42" width="42" src="' + data['image_url'] + '"</td>' +
                        '<td><button class="editEmployer" data-id="' + data['id'] + '" data-target="#addArticle' +
                        'data-toggle="modal" data-token="' + data['_token'] + '">Edit</button><td>' +
                        '<button class="deleteEmployer" data-id="' + data['id'] + '" data-token="' + data['_token'] + '">Delete</button></td></tr>';
                    if (data['isEdit'] == 0) {
                        $('#empoyeerstable tbody').append(str)
                    }
                    else {

                        $('#firstname' + data['id']).text('<a href="http://' + window.location.domain + '/' + data['id'] + '">' + data['firstname'] + '</a>');
                        $('#lastname' + data['id']).text(data['lastname']);
                        $('#patronomic' + data['id']).text(data['patronomic']);
                        $('#specialization' + data['id']).text(data['specialization']);
                        $('#skill' + data['id']).text(data['skill']);
                        $('#image' + data['id']).text('<img height="42" width="42" src="' + data['image_url'] + '">');


                    }

                },
                error: function (msg) {
                    alert('Ошибка');
                }

            });

        });

    })

</script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->