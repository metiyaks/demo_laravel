<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
@extends('layouts.dashboard')

@section('content')

<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Users</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Profile</a></li>
                            
                        </ol>
                    </nav>
                </div>
<!--                <div class="col-lg-6 col-5 text-right">
                    <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-default" onclick="javascript:callData();">+</a>

                </div>-->
            </div>
        </div>
    </div>
</div>


<div class="container-fluid mt--20">
    <div class="row">
        <h1>Profile</h1>
        <form role="form" method="POST" name="frmEdit" id="frmEdit" action="" style="display: none;">
                    <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-6">
                                <label>Name</label>
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
                                <label>Email</label>
                                <div class="form-group">
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input class="form-control email" placeholder="Email" type="email" name="email" id="email" required pattern="[^\s]+" title="" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                        </div>
<!--                        <div class="row">
                            <div class="col-6">
                                <label>Change Password</label>
                                <div class="form-group">
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input class="form-control password" placeholder="Password" type="password" value="" name="password" id="password" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label>Re-Password</label>
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
                        
                    </div>-->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
        
    </div>
</div>    

@endsection

@section('script')
<script>
    loadData();
    
    function loadData() {
        $('#tbodyUsers').empty();
        var userdata = JSON.parse(window.localStorage.getItem('user'));
        var email = userdata.email;
        var url = "{{ url('/api/users/profile') }}";
         
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
               
                
                $('#name').val(data.data.name);
                $('#email').val(data.data.email);
                $('#password').val('');
                //$('#re-password').val(data.data.password);
                $('#frmEdit').show();
                
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
    
    $(document).on('submit', '#frmEdit', function(event) {
        event.preventDefault();
        var post_url = $(this).attr('action');
        var request_method = $(this).attr("method");
        var form_data = $(this).serialize();
        $.ajax({
            url: "{{ url('/api/users/edit') }}",
            type: request_method,
            data: form_data,
            headers: {
                "Authorization": "Bearer " + window.localStorage.getItem('token')
            },
            success: function(data) {
                
                if (data.success) {
                    $.notify({
                        message: "Profile updated Successfully"
                    }, {
                        type: 'success',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                    });
                    loadData();
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = $.parseJSON(xhr.responseText);
                    console.log(errors.errors);
                    
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
</script>

@endsection