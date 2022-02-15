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
                            <li class="breadcrumb-item active">Add </li>
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

                <div id="msg" style="display: none;"></div>
                <div class="tab-content">

                    <div id="msg-inner" style="display: none;"></div>
                    <div class="alert-danger" id="validation_errors" style="display: none;">
                        <ul></ul>
                    </div>
                    <form method="post" id="frmAdd" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group-sm">
                                        <label for="gender">Gender</label>    
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="Mr" selected="selected">Mr.</option>
                                            <option alue="Mrs">Mrs</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fname">First Name</label>  
                                        <input class="form-control" placeholder="First Name" type="text" name="fname" id="fname" required>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mname">Middle Name</label>  
                                        <input class="form-control" placeholder="Middle Name" type="text" name="mname" id="mname" required>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="lname">Last Name</label>  
                                        <input class="form-control" placeholder="Last Name" type="text" name="lname" id="lname" required>

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
            </div><!-- Card Div Ends -->
        </div><!-- Col Div Ends -->
        <!-- Col Div -->
    </div><!-- Row Div Ends -->
</div>

<style>
    fieldset 
    {
        border: 1px solid #ddd !important;
        margin: 0;
        xmin-width: 0;
        padding: 10px;       
        position: relative;
        border-radius:4px;
        background-color:#f5f5f5;
        padding-left:10px!important;
    }	

    legend
    {
        font-size:14px;
        font-weight:bold;
        margin-bottom: 0px; 
        width: 35%; 
        border: 1px solid #ddd;
        border-radius: 4px; 
        padding: 5px 5px 5px 10px; 
        background-color: #ffffff;
    }
</style>
@endsection
@section('script')

@endsection