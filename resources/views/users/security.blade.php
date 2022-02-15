@extends('layouts.dashboard')
@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-2">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Users Security</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">My Childs Permission</a></li>
<!--                            <li class="breadcrumb-item active" aria-current="page">Security</li>-->
                        </ol>
                    </nav>
                </div>
<!--                <div class="col-lg-6 col-5 text-right">
                    <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-default" onclick="javascript:callData();" id="addUser_button" style="display: none;">+</a>
                </div>-->
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--6">
    <div class="row">
        <!-- Col Div -->
        <div class="col p-1">
            <!-- Card Div -->
            <div class="card">
                <div class="card-header border-0">
                    
                    <h3 class="mb-0">
                        
                        <label id="">Grant Permission for User Authentication</label>
<!--                        <div class="col-md-3"><input type="text" class="form-control" name="search" placeholder="Search"></div>-->
                    </h3>
<!--                    -->
                    
                </div>
                <div id="msg" style="display: none;"></div>
                
                <div class="table-responsive">
                    
                    <table class="table table-sm align-items-center table-flush" id="datatable-buttons" style="overflow: hidden;">
                        <thead class="thead-light">
                            <tr class="">
                                <th class="col-1" scope="col" data-sort="id">#</th>
                                <th class="col-2" scope="col" data-sort="fname"><a href="#" onclick="javascript:sort('fname', 'sortName');" id="sortName" class="asc">Name</a></th>
                                <th class="col-2" scope="col" data-sort="email"><a href="#" onclick="javascript:sort('email', 'sortEmail');" id="sortEmail" class="asc">Email</a></th>
                                <th class="col-1" scope="col" data-sort="name"><a href="#" onclick="javascript:sort('verify', 'sortverify');" id="sortCountry" class="asc">Email Auth</a></th>
                                <th class="col-1" scope="col" data-sort="name"><a href="#" onclick="javascript:sort('verify', 'sortverify');" id="sortCountry" class="asc">2FA Auth</a></th>
                                <th class="col-1" scope="col" data-sort="name"><a href="#" onclick="javascript:sort('verify', 'sortverify');" id="sortCountry" class="asc">SMS Auth</a></th>
                                <th class="col-1" scope="col" data-sort="name"><a href="#" onclick="javascript:sort('status', 'sortStatus');" id="sortStatus" class="asc">Status</a></th>
                                <th class="col-3" scope="col">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="list" id="tbodyUsers">
                        </tbody>
                    </table>
                </div>
            </div><!-- Card Div Ends -->
        </div><!-- Col Div Ends -->
        <!-- Col Div -->
    </div><!-- Row Div Ends -->
</div>


@endsection
@section('script')
<script>
 
    loadData();
    
   
    
    function loadData(type = null, user = null) {
        $('#tbodyUsers').empty();
        var userdata = JSON.parse(window.localStorage.getItem('user'));
        var email = userdata.email;
        if (type == null) {
            type = 'all';
        }

        var url = "{{ url('/api/users') }}";


        $.ajax({
            type: 'POST',
            url: url,
            headers: {
                "Authorization": "Bearer " + window.localStorage.getItem('token')
            },
            dataType: 'json',
            data: 'type=' + type + '&user=' + user,
            cache: false,
            success: function (data) {

                var html = '';
                var i = 1;
                var type = '';
                delete data.data.parent;
                $.each(data.data, function (k, v) {
                    
                    type = '';

                    html += '<tr>';
                    html += '<td>' + i + '</td>';
                    html += '<td><a href="javascript:loadData(' + v.u_role + ', \'' + v.u_id + '\');" class="text-default mb-0 usrlevel">' + v.firstname + ' ' + v.lastname + '</a></td>';
                    html += '<td>' + v.email + '</td>';
                    if(v.email_auth == 0) {
                        html += '<td><a href="#" class="btn btn-sm btn-danger email_auth" title="Enable" data-id= ' + v.u_id + ' email_auth="' + v.email_auth + '">Enable</a></td>';
                    } else {
                        html += '<td><a href="#" class="btn btn-sm btn-success email_auth" title="Enable" data-id= ' + v.u_id + ' email_auth="' + v.email_auth + '">Disable</a></td>';
                    }
                    if(v.two_fa == 0) {
                        html += '<td><a href="#" class="btn btn-sm btn-danger email_auth" title="Enable" data-id= ' + v.u_id + ' email_auth="' + v.email_auth + '">Enable</a></td>';
                    } else {
                        html += '<td><a href="#" class="btn btn-sm btn-success email_auth" title="Enable" data-id= ' + v.u_id + ' email_auth="' + v.email_auth + '">Disable</a></td>';
                    }
                    if(v.sms_auth == 0) {
                        html += '<td><a href="#" class="btn btn-sm btn-danger email_auth" title="Enable" data-id= ' + v.u_id + ' email_auth="' + v.email_auth + '">Enable</a></td>';
                    } else {
                        html += '<td><a href="#" class="btn btn-sm btn-success email_auth" title="Enable" data-id= ' + v.u_id + ' email_auth="' + v.email_auth + '">Disable</a></td>';
                    }
                    if(v.status == 0) {
                        html += '<td><a href="#" class="btn btn-sm btn-danger ustatus" title="Active" data-id= ' + v.u_id + ' email_auth="' + v.email_auth + '">Active</a></td>';
                    } else {
                        html += '<td><a href="#" class="btn btn-sm btn-success ustatus" title="Inactive" data-id= ' + v.u_id + ' email_auth="' + v.email_auth + '">Inactive</a></td>';
                    }

                    html += '<td class="text-right">';


                    html += '<div class="row" style="">';
                    html += '<a href="#" class="btn btn-sm btn-primary ac" data-id= ' + v.u_id + ' data-uname=' + v.u_name + ' title="Edit"><i class="fa fa-edit"></i></a>';
                    html += '<a href="#" class="btn btn-sm btn-primary pl" data-id= ' + v.u_id + ' data-uname=' + v.u_name + ' title="Wallet">W</a>';
                    html += '<a href="#" class="btn btn-sm btn-primary bt" data-id= ' + v.u_id + ' data-uname=' + v.u_name + ' title="Invest"><i class="fas fa-coins"></i></a>';
                    html += '</div>';
                    html += '</div>';
                    html += '</td>';
                    html += '</tr>';
                    i++;

                });
                $('#tbodyUsers').append(html);

            },
            error: function (xhr) {
                if (xhr.status == 401) {
                    swal({
                        title: xhr.responseJSON.message,
                        text: "Please Login Again...",
                        type: "success",
                        confirmButtonText: "Login",
                        confirmButtonClass: "btn btn-primary"
                    });
                    $('.swal2-confirm').click(function () {
                        window.location.href = "{{ url('/login') }}";
                    });
                }
            }
        });
    }

   
    

    $(document).on('click', '.ustatus', function () {
        var flag = $(this).attr('status');
        var uid = $(this).attr('data-id');

        if (flag == '0') {
            flag = '1';
            $(this).removeClass('btn-success');
            $(this).addClass('btn-danger');
            $(this).text('Inactive');

        } else {
            flag = '0';
            $(this).removeClass('btn-danger');
            $(this).addClass('btn-success');
            $(this).text('Active');
        }
        $(this).attr('status', flag);
        $.ajax({
            url: "{{ url('/api/changeStatus') }}",
            type: 'POST',
            data: 'flag=' + flag + '&uid=' + uid,
            headers: {
                "Authorization": "Bearer " + window.localStorage.getItem('token')
            },
            beforeSend: function (data) {
                // $("#btn-update-fw").prop('disabled', true);
            },
            success: function (data) {

                if (data.data == 2) {
                    $.notify({
                        message: data.message,
                    }, {
                        type: "success",
                        delay: 100,
                        timer: 1000,
                    });
                } else {
                    $.notify({
                        message: data.message,
                    }, {
                        type: "danger",
                        delay: 100,
                        timer: 1000,
                    });
                }
                loadData();
            },
            error: function (xhr) {
                if (xhr.status === 401) {
                    swal({
                        title: xhr.responseJSON.message,
                        text: "Please Login Again...",
                        type: "success",
                        confirmButtonText: "Login",
                        confirmButtonClass: "btn btn-default"
                    });
                    $('.swal2-confirm').click(function () {
                        window.location.href = "{{ url('/login') }}";
                    });
                }
                return false;
            }
        });
    });


    
</script>


@endsection