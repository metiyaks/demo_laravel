@extends('layouts.dashboard')
@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-2">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Users</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">My Childs</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Childs</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-default" onclick="javascript:callData();" id="addUser_button" style="display: none;">+</a>
                </div>
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
                        <button style="display: none;" class="btn btn-primary btn-sm btn-back"><i class="fas fa-arrow-left"></i></button>
                        <label id="top_title">Users</label>
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
                                <th class="col-1" scope="col" data-sort="created"><a href="#" onclick="javascript:sort('created', 'sortCreated');" id="sortCreated" class="asc">Member Since</a></th>
                                <th class="col-1" scope="col" data-sort="name"><a href="#" onclick="javascript:sort('Country', 'sortCountry');" id="sortCountry" class="asc">Country</a></th>
                                <th class="col-1" scope="col" data-sort="name"><a href="#" onclick="javascript:sort('verify', 'sortverify');" id="sortCountry" class="asc">Verified</a></th>
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
<div class="col-md-4">
    <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header p-1 bg-secondary">
                    <h6 class="modal-title pl-3 pt-1" id="modal-title-default">Create New User</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div id="msg-inner" style="display: none;"></div>
                <div class="alert-danger" id="validation_errors" style="display: none;">
                    <ul></ul>
                </div>
                <form method="post" id="frmAdd" enctype="multipart/form-data" onload="javascript:getCountries();">
                    {{ csrf_field() }}
                    <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group-sm">
                                        <label for="gender">Username</label>    
                                        <input class="form-control" placeholder="Username" type="text" name="username" id="uname" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">First Name</label>  
                                        <input class="form-control" placeholder="First Name" type="text" name="fname" id="fname" required>

                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="lname">Last Name</label>  
                                        <input class="form-control" placeholder="Last Name" type="text" name="lname" id="lname" required>

                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <label for="gender">Country</label>    
                                    <select class="form-control" id="country" name="country">
                                        <option value="" selected="selected">Select Country</option>
                                    </select>
                                </div>
                            
                                <div class="col-md-6">
                                    <label for="gender">Mobile (M)</label>    
                                    <input class="form-control" placeholder="Mobile Number" type="text" name="mobile" id="mobile" required>
                                </div>
                                
                            </div>
                        
                            <div class="row">
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Email</label>  
                                    <input class="form-control" placeholder="Email" type="email" name="email" id="email" required>

                                </div>
                            </div>
                                </div>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>  
                                    <input class="form-control" placeholder="Password" type="password" name="password" id="password" required>
                                </div>  

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="re_password">Confirm Password</label>  
                                    <input class="form-control" placeholder="Confirm Password" type="password" name="re_password" id="re_password" required>
                                </div>  

                            </div>
                        </div>
                        
<!--                            <div class="row">
                                <div class="col-md-2">
                                    <label for="gender">Document Type</label>    
                                    <select class="form-control" id="docType" name="docType">
                                        <option value="passport" selected="selected">Passport.</option>
                                        <option value="aadharcard">Aadharcard</option>
                                        <option value="driving_license">Driving License</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="proof">Upload Document</label>    
                                    <input type="file" name="proof" class="form-control" id="proof" onchange="previewFileDoc(this);" />

                                </div>
                                <div class="col-md-3">
                                    <img class="form-control" id="previewDoc" src="{{ asset('public/assets/img/img_preview.png') }}" alt="Preview Document" style="width:150px; height: 121px;">
                                </div>
                                
                                <div class="col-md-2">
                                    <div class="form-group-sm">
                                        <label for="avatar">Avatar</label>    
                                        <input data-preview="#previewAvatar" type="file" name="avatar" class="form-control" id="avatar" onchange="previewFile(this);" />

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <img class="form-control" id="previewAvatar" src="{{ asset('public/assets/img/img_preview.png') }}" alt="Preview Avatar" style="width:150px; height: 121px;">
                                </div>
                                
                            </div> -->
                        
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">Submit</button>
                                </div>
                                </div>
                            </div>
                        
                    </div>
<!--                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default ml-auto" data-dismiss="modal">Cancel</button>
                    </div>-->
                </form>
            </div>
                 
        </div>
    </div>
    <div class="modal fade" id="deposite_model" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center text-muted mb-4">
                        <h3 id="title-chips"></h3>
                    </div>
                    <div id="DepositeForm"></div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    
    $(document).ready(function () {
        loadData();
    });
    
    
    function loadData() {
        $('#tbodyUsers').empty();
        var userdata = JSON.parse(window.localStorage.getItem('user'));
        var email = userdata.email;
        var url = "{{ url('/api/users') }}";


        $.ajax({
            type: 'POST',
            url: url,
            headers: {
                "Authorization": "Bearer " + window.localStorage.getItem('token')
            },
            dataType: 'json',
            data: 'role=1&user=' + user,
            cache: false,
            success: function (data) {

                var html = '';
                var i = 1;
                var type = '';
                var parent = data.data.parent;
                delete data.data.parent;
                pre_arr.length > 0 ? $(".btn-back").show() : $(".btn-back").hide();
                pre_arr.push({
                    type: type,
                    user: user
                })
                $.each(data.data, function (k, v) {

                    type = '';

                    $('#top_title').text(parent);

                    html += '<tr>';
                    html += '<td>' + i + '</td>';
//                    if (v.u_role != '5') {
//                        html += '<td><a href="javascript:loadData(' + v.u_role + ', \'' + v.u_id + '\');" class="text-default mb-0 usrlevel">' + v.u_name + ' [' + type + ']</a></td>';
//                    } else {
//                        html += '<td><a href="#anchor" class="text-default mb-0">' + v.u_name + ' [' + type + ']</a></td>';
//                    }

                    html += '<td><a href="javascript:loadData(' + v.u_role + ', \'' + v.u_id + '\');" class="text-default mb-0 usrlevel">' + v.firstname + ' ' + v.lastname + '</a></td>';
                    html += '<td>' + v.email + '</td>';
                    html += '<td>' + v.member_since + '</td>';
                    html += '<td>' + v.country + '</td>';
                    if(v.doc_verify == 0) {
                        html += '<td><i class="ni ni-check-bold text-danger"></i></td>';
                    } else {
                        html += '<td><i class="ni ni-check-bold text-success"></i></td>';
                    }
                    if (v.status == 0) {
                        html += '<td><a href="#" class="text-success ustatus" data-toggle="popover" title="Active" data-id= ' + v.u_id + ' status="' + v.status + '"><i class="ni ni-check-bold"></i></a></td>';
                    } else {
                        html += '<td><a href="#" class="text-danger ustatus" data-toggle="popover" title="Inactive" data-id= ' + v.u_id + ' status="' + v.status + '"><i class="ni ni-check-bold"></i></a></td>';
                    }

                    html += '<td class="text-right">';

//                    html += '<div class="dropdown">';
//                    html += '<a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
//                    html += '<i class="fas fa-ellipsis-v"></i>';
//                    html += '</a>';
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

    $(document).on('submit', '#frmAdd', function (event) {
        event.preventDefault();
        var post_url = $(this).attr('action');
        //var request_method = $(this).attr("method");
        var form_data = $(this).serialize();
        var formData = new FormData($(this)[0]);
        let file = $('input[type=file]')[0].files[0];
        formData.append('file', file, file.name);
        $.ajax({
            url: "{{ url('/api/addUser') }}",
            type: "POST",
            data: formData,

            //dataType:'text',
            contentType: false,
            cache: false,
            processData: false,
            headers: {
                "Authorization": "Bearer " + window.localStorage.getItem('token')
            },
            success: function (data) {
                loadData();
                //getBalance();

                $.notify({
                    message: "User Added Successfully"
                }, {
                    type: 'success',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    delay: 100,
                    timer: 500,
                });
                $('#modal-default').hide();
                setTimeout(function () {
                    $('#msg').show();
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();

                }, 500);
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    var errors = $.parseJSON(xhr.responseText);
                    console.log(errors.errors);
                    $.each(errors.errors, function (key, val) {
                        $("input + .invalid-feedback").remove();
                        $("input").removeClass('is-invalid');
                        if (val.hasOwnProperty('email')) {
                            $("input[name='email']").addClass('is-invalid');
                            $("input[name='email']").after('<div class="invalid-feedback">' + val.email + '</div>');
                        }
                        if (val.hasOwnProperty('name')) {
                            $("input[name='name']").addClass('is-invalid');
                            $("input[name='name']").after('<div class="invalid-feedback">' + val.name + '</div>');
                        }
                        if (val.hasOwnProperty('password')) {
                            $("input[name='password']").addClass('is-invalid');
                            $("input[name='password']").after('<div class="invalid-feedback">' + val.password + '</div>');
                        }
                        if (val.hasOwnProperty('re_password')) {
                            $("input[name='re_password']").addClass('is-invalid');
                            $("input[name='re_password']").after('<div class="invalid-feedback">' + val.re_password + '</div>');
                        }
                        if (val.hasOwnProperty('type')) {
                            $("input[name='type']").addClass('is-invalid');
                            $("input[name='type']").after('<div class="invalid-feedback">' + val.type + '</div>');
                        }
                        if (val.hasOwnProperty('free_chip')) {
                            $("input[name='free_chip']").addClass('is-invalid');
                            $("input[name='free_chip']").after('<div class="invalid-feedback">' + val.free_chip + '</div>');
                        }
                        if (val.hasOwnProperty('downline_Cricket')) {
                            $("input[name='downline_Cricket']").addClass('is-invalid');
                            $("input[name='downline_Cricket']").after('<div class="invalid-feedback">' + val.downline_Cricket + '</div>');
                        }
                        if (val.hasOwnProperty('downline_Football')) {
                            $("input[name='downline_Football']").addClass('is-invalid');
                            $("input[name='downline_Football']").after('<div class="invalid-feedback">' + val.downline_Football + '</div>');
                        }
                        if (val.hasOwnProperty('downline_Tennis')) {
                            $("input[name='downline_Tennis']").addClass('is-invalid');
                            $("input[name='downline_Tennis']").after('<div class="invalid-feedback">' + val.downline_Tennis + '</div>');
                        }
                    });
                }
                if (xhr.status === 401) {
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
    });

    
</script>


@endsection