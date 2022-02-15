@extends('layouts.dashboard')
@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-2">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">A/C Statements</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Report</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Account Statement</li>
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
            <div class="card mb-4">
                <div class="card-header p-1">
                    <form id="r_frm">
                        <div class="col-6 col-md-3 float-left p-1">
                            <label class="mb-0">Play Mode</label>
                            <select name="mode" id="plays" class="form-control" required>
                                <option value="all" selected="selected">All</option>

                            </select>
                        </div>
                        <div class="col-6 col-md-3 float-left p-1">
                            <label class="mb-0">Account Type</label>
                            <select name="type" id="types" class="form-control" required>
                                <option value="all" selected="selected">All</option>
                                <option value="balance" selected="selected">Balance Report</option>
                                <option value="game" selected="selected">Game Report</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-2 float-left p-1">
                            <label class="mb-0">From Date</label>
                            <input class="form-control" type="date" name="from" id="from">
                        </div>
                        <div class="col-6 col-md-2 float-left p-1">
                            <label class="mb-0">To Date</label>
                            <input class="form-control" type="date" name="to" id="to">
                        </div>
                        <div class="col-6 col-md-1 float-left p-1">
                            <label class="invisible d-none d-md-block">Submit</label>
                            <button id="s_btn" class="btn btn-sm btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Card Div -->
            <div class="card">
                <div class="card-header border-0 p-2">
                    <h3 class="mb-0" id="lbluname">A/C Statements</h3>
                </div>

                <div class="table-responsive">
                    <table id="rpt_tbl" class="table table-sm table-bordered table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>Sr.</th>
                                <th>Date</th>
                                <th>Credit</th>
                                <th>Debit</th>
                                <th class="text-right">Bal</th>
                                <th>Remark</th>
                                <th>View</th>

                            </tr>
                        </thead>
                        <tbody class="list" id="tbodyReport">
                        </tbody>
                    </table>
                </div>

            </div><!-- Card Div Ends -->
            <div class="p-1 d-flex justify-content-center"><button style="display:none" id="btn-more" title="Dil Mange More" class="col-12 col-md-1 btn btn-sm btn-success">Load More</button></div>
        </div><!-- Col Div Ends -->
        <!-- Col Div -->

    </div><!-- Row Div Ends -->
</div>
<!-- popup -- -->

<div class="modal fade center" id="edit_event_model" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header p-3">
                <h5 class="modal-title" id="edit-title">
                    Title
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        X
                    </span>
                </button>
            </div>
            <div class="modal-body p-0" id="EditForm">
                <div class="table-responsive">
                    <table class="table table-sm align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>Sr.</th>
                                <th>Event Name</th>
                                <th>Play</th>
                                <th>Runner</th>
                                <th>Rate</th>
                                <th>Stake</th>
                                <th>P/L</th>
                                <th>User Name</th>
                                <th>Ref.</th>
                                <th>Ip</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody class="list" id="tbodyBets"></tbody>
                    </table>
                    <center>
                        <button style="display:none" id="btn-more_match" title="Dil Mange More" class="col-12 col-md-3 btn btn-sm btn-success">Load More</button>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    var index = 1;
    var index_match = 1;
    var last = 1;
    var winner = "";
    var i = 1;
    var uid = '{{ $id }}';
    $(document).ready(function() {
        var uname = '{{ $uname }}';
        if (uname) {
            $('#lbluname').html('A/C Statements [' + uname + ']');
        } else {
            $('#lbluname').html('A/C Statements');
        }
        $('#plays').val('all');
        $('#types').val('all');
        $('#from').val(setDate(new Date(new Date().setDate(new Date().getDate() - 15))))
        $('#to').val(setDate(new Date()))
        loadPlays();
        if (uid) {
            $('#s_btn').click();
        }
    });

    $(document).on("click", "#btn-more", function(e) {
        e.preventDefault();
        var plays = $('#plays').val().trim();
        var type = $('#types').val().trim();
        var from = $('#from').val().trim();
        var to = $('#to').val().trim();
        getStatements(plays, type, from, to, index);
    })

    function loadPlays() {
        $.ajax({
            type: 'POST',
            url: "{{ url('/api/getPlay') }}",
            headers: {
                "Authorization": "Bearer " + window.localStorage.getItem('token')
            },
            dataType: 'json',
            cache: false,
            success: function(data) {
                var html = '';
                $.each(data.data, function(k, v) {
                    html += '<option value="' + v.id + '">' + v.play + '</option>';
                });
                $('#plays').append(html);
            },
            error: function(xhr) {
                if (xhr.status == 401) {
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
    }

    $("#r_frm").submit(function(e) {
        e.preventDefault();
        var plays = $('#plays').val().trim();
        var type = $('#types').val().trim();
        var from = $('#from').val().trim();
        var to = $('#to').val().trim();
        $("#tbodyReport").empty();
        $("#s_btn").attr("disabled", true)
        index = 1;
        index_match = 1;
        last = 1;
        getStatements(plays, type, from, to, index)
    });

    function getStatements(mode = 'all', type = 'all', from = '', to = '', page = 1) {
        $.ajax({
            type: 'POST',
            url: "{{ url('/api/getStatements') }}",
            headers: {
                "Authorization": "Bearer " + window.localStorage.getItem('token')
            },
            dataType: 'json',
            data: 'mode=' + mode + '&type=' + type + '&fromDate=' + from + '&toDate=' + to + '&page=' + page + '&uid=' + uid,
            cache: false,
            success: function(data) {
                $("#s_btn").attr("disabled", false)
                var html = '';
                var i = 1;
                var credit;
                var debit;
                var closing = 0;
                var totalCR = 0;
                var totalDR = 0;
                if (data.data && data.data.length > 0) {
                    index++;
                    $.each(data.data, function(k, v) {
                        html += '<tr class="">';
                        html += '<td>' + last + '</td>';
                        html += '<td>' + dateReport(v.created_at) + '</td>';
                        if (v.type == "CR") {
                            totalCR = totalCR + v.amount;
                            html += '<td class="text-success text-right">' + v.amount + '</td>';
                            html += '<td> - </td>';
                        } else {
                            totalDR = totalDR + v.amount;
                            html += '<td> - </td>';
                            html += '<td class="text-danger text-right">' + v.amount + '</td>';
                        }
                        html += '<td class="text-right">' + v.new_bal + '</td>';
                        html += '<td>' + parseLastTxt(v.remark, true);
                        html += '<span class="text-success font-weight-bold">' + parseLastTxt(v.remark, false) + "</span>";
                        html += "</td>"
                        var ach = "Settlement"
                        if (v.market_id != 0) {
                            ach = '<a href="#" class="btn btn-sm btn-success mb-0" onclick="view(\'' + v.event_id + '\',\'' + v.market_id + '\',\'' + parseLastTxt(v.remark, false) + '\' ,1);">Bets</a>';
                        }
                        html += '<td>' + ach + '</td>';
                        html += '</tr>';
                        closing = v.new_bal
                        last++;
                    });
                    $("#btn-more").show()
                } else {
                    $("#btn-more").hide()
                }
                var tbody = $("#tbodyReport");
                if (tbody.children().length == 0) {
                    tbody.html(html);
                } else {
                    $('#tbodyReport tr:last').after(html);
                }

            },
            error: function(xhr) {
                $("#s_btn").attr("disabled", false)
                if (xhr.status == 401) {
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
        }); //inner ajax

    }
    $(document).on("click", "#btn-more_match", function(e) {
        e.preventDefault();
        var eid = $('#btn-more_match').attr('e_id');
        var mid = $('#btn-more_match').attr('m_id');
        view(eid, mid, '', index_match);
    });

    $('#edit_event_model').on('hidden.bs.modal', function(e) {
        i = 1;
        $('#tbodyBets').empty();
        index_match = 1;
    });

    function view(event_id, market_id, wn = '', page = 1) {
        winner = (wn) ? wn : winner;
        $('#btn-more_match').attr('e_id', event_id);
        $('#btn-more_match').attr('m_id', market_id);
        var uid = '{{ $id }}';
        $.ajax({
            type: 'POST',
            url: "{{ url('/api/getBets') }}",
            headers: {
                "Authorization": "Bearer " + window.localStorage.getItem('token')
            },
            dataType: 'json',
            data: 'event_id=' + event_id + "&market_id=" + market_id + "&limit=20&page=" + page + '&uid=' + uid,
            cache: false,
            success: function(data) {
                var html = "";
                var profit = 0;
                index_match++;
                $.each(data.data, function(k, v) {
                    var size = '';
                    profit = (v.rate - 1) * v.stake;
                    profit = Number(profit).toFixed(2);
                    if (v.table_name == 'tbl_line_runners') {
                        profit = parseInt(v.stake);
                    }
                    if (v.table_name == 'tbl_fancy_runners') {
                        size = "/" + v.size;
                        profit = (v.stake * v.size / 100).toFixed(0);
                    }
                    if (v.table_name == 'tbl_odds_runners') {
                        profit = (v.rate * v.stake / 100).toFixed(0);
                    }
                    html += '<tr class="' + v.bet_type + '">';
                    html += '<td>' + i + '</td>';
                    html += '<td>' + v.event_name + '</td>';
                    html += '<td>' + v.play + '</td>';
                    html += '<td>' + v.runner + '</td>';
                    html += '<td class="text-right">' + v.rate + size + '</td>';
                    html += '<td class="text-right">' + v.stake + '</td>';
                    html += '<td class="text-right">' + parseInt(profit) + '</td>';
                    html += '<td>' + v.u_name + '</td>';
                    html += '<td>' + v.webref + '</td>';
                    html += '<td><a href="javascript:void(0)" title=\"' + v.device_info + '\">' + v.ip_addr + '</a></td>';
                    html += '<td>' + dateFormate(v.created) + '</td>';
                    html += '</tr>';
                    i++;
                });

                $("#edit_event_model").modal("show");
                $("#edit-title").text("Winner " + winner + "/Bets");
                if (data.data.length > 19) {
                    $('#btn-more_match').show();
                } else {
                    $('#btn-more_match').hide();
                    i = 1;
                }
                var tbody = $("#tbodyBets");
                if (tbody.children().length == 0) {
                    tbody.html(html);
                } else {
                    $('#tbodyBets tr:last').after(html);
                }
            },
            error: function(xhr) {
                //console.log(xhr.responseText);
                if (xhr.status == 401) {
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
        }); //inner ajax

    }

    function setDate(dtToday) {
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10) month = "0" + month.toString();
        if (day < 10) day = "0" + day.toString();
        return year + "-" + month + "-" + day;
    }

    function dateReport(date) {
        var new_date = date + "+00:00";
        var d = new Date(new_date);
        return d.toLocaleDateString("en-IN", {
            month: "2-digit",
            day: "2-digit",
            year: "numeric",
        });
    };

    function parseLastTxt(str, first) {
        let arr = str.split("/");
        let last_el = arr.length > 1 ? arr[arr.length - 1] : arr[0];
        arr.pop();
        if (first) {
            if (arr.length > 1) {
                return arr.join("/") + "/";
            } else {
                return arr[0];
            }
        } else {

            return last_el;
        }
    }

    function dateFormate(date) {
        var new_date = date + "+00:00";
        var d = new Date(new_date);
        return d.toLocaleDateString("en-US", {
            month: "long",
            day: "2-digit",
            year: "numeric",
            hour: "2-digit",
            minute: "2-digit",
        });
    };
</script>
@endsection