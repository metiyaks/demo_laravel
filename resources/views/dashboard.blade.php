@extends('layouts.dashboard') @section('content')

<div class="header pb-6">
      <div class="container-fluid">
        <div class="header-body">

          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Customer</h5>
                      <span class="h2 font-weight-bold mb-0">10,000</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-active-40"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
<!--                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>-->
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Ref. Earnings</h5>
                      <span class="h2 font-weight-bold mb-0">$9,24,000</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
<!--                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>-->
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Investment</h5>
                      <span class="h2 font-weight-bold mb-0">$9,24,000</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
<!--                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>-->
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Users</h5>
                      <span class="h2 font-weight-bold mb-0">5000</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="ni ni-chart-bar-32"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
<!--                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>-->
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<!-- Page content -->

<div class="container-fluid mt--6">
    <h4 class="card-title">List<a href="javascript:void(0);" class="float-right btn btn-primary" id="add_user" data-toggle="modal" data-target="#modal-default"> Add New</a><a href="{{ url('/export-users') }}" class="float-right btn btn-dark" id="export">Export</a></h4>
     <div class="table-responsive">
                    
                    <table class="table table-sm align-items-center table-flush" id="datatable-buttons" style="overflow: hidden;">
                        <thead class="thead-light">
                            <tr class="">
                                <th class="col-1" scope="col" data-sort="id">#</th>
                                <th class="col-1" scope="col" data-sort="fname"><a href="#" onclick="javascript:sort('fname', 'sortFname');" id="sortName" class="asc">Name</a></th>
                                <th class="col-2" scope="col" data-sort="email"><a href="#" onclick="javascript:sort('email', 'sortEmail');" id="sortEmail" class="asc">Email</a></th>
                                <th class="col-1" scope="col" data-sort="contact"><a href="#" onclick="javascript:sort('contact', 'sortContact');" id="sortCountry" class="asc">Phone Number</a></th>
                                <th class="col-1" scope="col" data-sort="budget"><a href="#" onclick="javascript:sort('budget', 'sortBudget');" id="sortCountry" class="asc">Desired Budget</a></th>
                                <th class="col-1" scope="col" data-sort="message"><a href="#" onclick="javascript:sort('budget', 'sortMessage');" id="sortMessage" class="asc">Message</a></th>
                                <th class="col-1" scope="col" data-sort="status"><a href="#" onclick="javascript:sort('status', 'sortStatus');" id="sortStatus" class="asc">Status</a></th>
                                <th class="col-3" scope="col">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="list" id="tbodyUsers">
                        </tbody>
                    </table>
                </div>
    <footer class="footer">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
              &copy; 2022 <a href="3" class="font-weight-bold ml-1" target="_blank">Client Panel</a>
            </div>
          </div>
          
        </div>
      </footer>
</div>
<!-- popup --Edit -->
<div class="modal fade" id="modal-default" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-title">
                    Add New User
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
            </div>
            <div class="modal-body" id="EditForm">
                <form role="form" method="POST" name="frmAdd" id="frmAdd" action="">
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="user_id" value="">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input class="form-control name" placeholder="Name" type="text" name="name" id="name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input class="form-control email" placeholder="Email" type="email" name="email" id="email" required pattern="[^\s]+" title="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input class="form-control password" placeholder="Password" type="password" name="password" id="password" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input class="form-control re_password" placeholder="Re-Password" type="password" name="re_password" id="re_password" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-fw"></i></span>
                                        </div>
                                        <input class="form-control free_chip" placeholder="Desired Budget" type="number" name="budget" id="budget" value="" min="0" required>

                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-fw"></i></span>
                                        </div>
                                        <input class="form-control free_chip" placeholder="Phone Number" type="text" name="contact" id="contact" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-fw"></i></span>
                                        </div>
                                        <input class="form-control free_chip" placeholder="Message" type="message" name="message" id="message" value="">

                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
@endsection
@section('script')
<script>
    loadData();
    
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
            data: '',
            cache: false,
            success: function (data) {

                var html = '';
                var i = 1;
                
                $.each(data.data, function (k, v) {
                   
                   var str = "";
                var msg = '';
                    str = v.message;
                    
                    if(str != null) {
                        msg = str.length > 15 ? str.substring(0,12) + '...' : str;
                    }
                    html += '<tr>';
                    html += '<td>' + i + '</td>';
                    html += '<td>' + v.name + '</td>';
                    html += '<td>' + v.email + '</td>';
                    html += '<td>' + v.contact + '</td>';
                    html += '<td>' + v.budget + '</td>';
                    html += '<td>' + msg + '</td>';
                    if (v.status == 0) {
                        html += '<td><a href="#" class="text-success ustatus" data-toggle="popover" title="Active" data-id= ' + v.u_id + ' status="' + v.status + '">Inactive</a></td>';
                    } else {
                        html += '<td><a href="#" class="text-danger ustatus" data-toggle="popover" title="Inactive" data-id= ' + v.u_id + ' status="' + v.status + '">Active</a></td>';
                    }

                    html += '<td class="text-right">';
                    html += '<div class="row" style="">';
                    
                   // html += '<a href="javascript:void(0);" class="btn btn-sm btn-primary ac" data-id= ' + v.id + ' title="Edit">Edit</a>';
                    html += '<a href="#" class="btn btn-sm btn-primary wp" data-name="'+v.name+'" data-email="'+v.email+'" data-id= ' + v.id + ' title="wp">Create WordPress Account</a>';
                    //html += '<input type="hidden" name="name-'+v.id+'" id="name-'+v.id+'" value="'+v.name+'">';
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

  
    $(document).on('submit', '#frmAdd', function(event) {
        event.preventDefault();
        var post_url = $(this).attr('action');
        var request_method = $(this).attr("method");
        var form_data = $(this).serialize();
        $.ajax({
            url: "{{ url('/api/addUser') }}",
            type: request_method,
            data: form_data,
            headers: {
                "Authorization": "Bearer " + window.localStorage.getItem('token')
            },
            success: function(data) {
                loadData();
                if (data.success) {
                    $.notify({
                        message: "User Added Successfully"
                    }, {
                        type: 'success',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                    });
                    $('#modal-default').hide();
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = $.parseJSON(xhr.responseText);
                    console.log(errors.errors);
                    $.each(errors.errors, function(key, val) {
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
                        if (val.hasOwnProperty('budget')) {
                            $("input[name='budget']").addClass('is-invalid');
                            $("input[name='budget']").after('<div class="invalid-feedback">' + val.budget + '</div>');
                        }
                        if (val.hasOwnProperty('contact')) {
                            $("input[name='contact']").addClass('is-invalid');
                            $("input[name='contact']").after('<div class="invalid-feedback">' + val.contact + '</div>');
                        }
                        
                        
                    });
                }
                if (xhr.status === 401) {
                    swal({
                        title: xhr.responseJSON.message,
                        text: "Please Login Again...",
                        type: "success",
                        confirmButtonText: "Login",
                        confirmButtonClass: "btn btn-default"
                    });
                    $('.swal2-confirm').click(function() {
                        window.location.href = "{{ url('/login') }}";
                    });
                }
            }
        });
    });
    
    
    $(document).on('click', '.ac', function() {
        var id = $(this).attr('data-id');
        var uname = $(this).attr('data-uname');
        var userdata = JSON.parse(window.localStorage.getItem('user'));
        $('#modal-default').modal('show');
        $('#edit-title').text("Edit");
        
        var url = "{{ url('/api/users/profile') }}";
         
        $.ajax({
            type: 'POST',
            url: url,
            headers: {
                "Authorization": "Bearer " + window.localStorage.getItem('token')
            },
            dataType: 'json',
            data: 'id='+id,
            cache: false,
            success: function (data) {

                var html = '';
                var i = 1;
                
                $.each(data.data, function (k, v) {
                   
                    html += '<tr>';
                    html += '<td>' + i + '</td>';
                    html += '<td>' + v.name + '</td>';
                    html += '<td>' + v.email + '</td>';
                    html += '<td>' + v.contact + '</td>';
                    html += '<td>' + v.budget + '</td>';
                    html += '<td>' + msg + '</td>';
                    
                });
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
        
    });
    
    $(document).on('click', '.wp', function() {
        var id = $(this).attr('data-id');
        var email = $(this).attr('data-email');
        var name = $(this).attr('data-name');
       
        //var url = "{{ url('/api/users/createWPAccount') }}";
        //var url = "http://localhost/custDemo/wp-content/plugins/import-users-from-csv/customdemo.php"; 
        var url = "http://localhost/custDemo/customdemo.php"; 
        $.ajax({
            type: 'POST',
            url: url,
//            headers: {
//                "Authorization": "Bearer " + window.localStorage.getItem('token')
//            },
            dataType: 'json',
            data: 'user_email='+email+'&password=123456&user_nicename='+name+'&display_name'+name+'&user_login='+email,
            cache: false,
            success: function (data) {
                alert(data);
               
            },
            error: function (xhr) {
                
            }
        });
        
    });

    
</script>
@endsection