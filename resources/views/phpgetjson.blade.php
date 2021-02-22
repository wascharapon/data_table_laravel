<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>datatable_realtime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- นำเข้า  CSS จาก Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300;400&display=swap" rel="stylesheet">
    <!-- นำเข้า  CSS จาก dataTables -->
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <!-- นำเข้า  Javascript จาก  Jquery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- นำเข้า  Javascript  จาก   dataTables -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

</head>
<style>
    body {
        overflow-x: hidden;
        font-family: 'Mitr', sans-serif;
    }

    td {
        vertical-align: middle;
    }

    td.details-control {
        background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
        cursor: pointer;
    }

    tr.shown td.details-control {
        background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
    }

</style>
<script>
    /* Formatting function for row details - modify as you need */
    function format(d) {
        // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
            '<tr>' +
            '<td>email:</td>' +
            '<td>' + d.email + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td> created_at:</td>' +
            '<td>' + d.created_at + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td> updated_at:</td>' +
            '<td>' + d.updated_at + '</td>' +
            '</tr>' +
            '</table>';
    }


    $(document).ready(function() {
        //select data
        $('#block_click').hide();
        //datatable
        var table = $('#example').DataTable({
            "ajax": {
                "url": 'http://127.0.0.1:8000/data',
                "cache": false,
                "error": function(e) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'ไม่สำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                "beforeSend": function(e) {
                    $('#block_click').show();
                    setTimeout(function() {
                        $('#block_click').hide();
                    }, 3000);
                },
            },
            "columns": [{
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {
                    "data": "id"
                },
                {
                    "data": "name"
                },
                {
                    "data": "lastname"
                },
                {
                    "data": "status"
                },

            ],
            "order": [
                [1, 'asc']
            ]
        });

        // Add event listener for opening and closing details
        $('#example tbody').on('click', 'td.details-control', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });
    });

    function search_date() {
        date_begin = $('#date_begin').val();
        date_end = $('#date_end').val();
        if (date_begin == '' || date_end == '') {
            Swal.fire({
                icon: 'warning',
                title: 'กรุณาเลือกวันที่ให้ครบถ้วน',
                showConfirmButton: false,
                timer: 1500
            })
        } else {
            window.location.href = 'data/' + date_begin + '/' + date_end;
        }


    }

</script>

<body>
    <div id="block_click" class="bg-primary w-100" style="opacity:0.5;height:100%;position: absolute;z-index: 1">&nbsp;
    </div>
    <br><br>
    <div class="d-flex flex-column bd-highlight  mt-2 bt-2 text-center">
        <div class="p-2 bd-highlight">
            <div class="container">
                <div class="row">
                    <div class="col-sm ">
                        <div class="row">
                            <div class="col-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fa fa fa-calendar  "></i></span>
                                    <input type="date" id="date_begin" class="form-control" placeholder="Username"
                                        aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fa fa fa-calendar  "></i></span>
                                    <input type="date" id="date_end" class="form-control" placeholder="Username"
                                        aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="button" onclick="search_date()"
                                    class="btn btn-primary btn-sm w-100">ค้นหา</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column bd-highlight  mt-2 bt-2 text-center">
        <div class="p-2 bd-highlight">
            <div class="container">
                <div class="row">
                    <div class="col-sm ">
                        <table id="example" class="table table-hover table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>&nbsp;&nbsp;</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Lastname</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
