<!doctype html>
<html lang="en">
<?php
    $user = $this->session->userdata('user');
    extract($user);

	?>

<head>
    <style>
    #maincontainer {
        width: 100%;
        height: 100%;
        float: right;
    }

    #leftcolumn {
        float: right;
        display: inline-block;
        width: 120px;
        height: 100%;

    }

    #contentwrapper {
        float: right;
        display: inline-block;
        width: -moz-calc(10% - 100px);
        width: -webkit-calc(10% - 100px);
        width: calc(10% - 100px);
        height: 100%;
    }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script src="<?= base_url(); ?>plugins/select2/js/select2.full.min.js"></script>
    <script>
    $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            editable: true,
            //  firstDay: 1,
            defaultView: 'month',
            height: 650,
            contentHeight: "auto",
            expandRows: true,
            timeFormat: 'H:mm',
            slotLabelFormat: "H:mm",
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            views: {
                month: {
                    columnFormat: "ddd D/M"
                }
            },

            events: "<?php echo base_url(); ?>Calendar/load",
            selectable: true,
            selectHelper: true,

            // $('#save_events').click(function(){
            select: function(start, end) {

                var view = calendar.fullCalendar('getView')

                if (view.name == "month" || view.name == "agendaWeek") {
                    $('#cal_modal').modal('show');

                    var setstart = $.fullCalendar.formatDate(start, "Y-MM-DD");
                    var setend = $.fullCalendar.formatDate(end, "Y-MM-DD");
                    var setfrom = $.fullCalendar.formatDate(start, "HH:mm:ss");
                    var setto = $.fullCalendar.formatDate(end, "HH:mm:ss");


                    $('#datefrom').val(setstart);
                    $('#dateto').val(setend);
                    $('#timefrom').val(setfrom);
                    $('#timeto').val(setto);

                } else if (view.name == "agendaDay") {
                    $('#day_modal').modal('show');

                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

                    $('#daystart').val(start)
                    $('#dayend').val(end)


                }
            },

            eventResize: function(event) {

                if (event.status == 1) {
                    event.draggable = false;

                } else {

                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

                    var title = event.title;

                    var id = event.id;

                    $.ajax({
                        url: "<?php echo base_url(); ?>Calendar/update",
                        type: "POST",
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            id: id
                        },
                        success: function() {
                            calendar.fullCalendar('refetchEvents');
                            Swal.fire({
                                icon: 'success',
                                title: 'Event Updated',
                                showConfirmButton: false,
                                timer: 2500
                            })
                        }
                    })
                }
            },
            eventDrop: function(event) {

                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                //alert(start);
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                //alert(end);
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url: "<?php echo base_url(); ?>Calendar/update",
                    type: "POST",
                    data: {
                        title: title,
                        start: start,
                        end: end,
                        id: id
                    },
                    success: function(data) {
                        calendar.fullCalendar('refetchEvents');
                        Swal.fire({
                            icon: 'success',
                            title: 'Event Updated',
                            showConfirmButton: false,
                            timer: 2500
                        })

                    }
                })
            },
            eventClick: function(event) {

                var id = event.id;
                $.ajax({
                    "url": "<?php echo base_url(); ?>Calendar/get_cal_data",
                    "data": {
                        id: id
                    },
                    "type": "POST",
                    dataType: "json",
                    success: function(data) {

                        $('#up_titles').val(data.event_title);
                        $('#up_datefrom').val(data.start_date);
                        $('#up_dateto').val(data.end_date);
                        $('#up_timefrom').val(data.start_time);
                        $('#up_timeto').val(data.end_time);
                        $('#up_id').val(data.event_id);

                        $('#update_cal_modal').modal('show');
                        $('#up_time_error').text(null);
                        $('#time_error').text(null);
                    },
                    error: function() {

                    }
                });

            }
        });
        $('#save_events_day').click(function() {
            $('#day_modal').modal('show');
            if ($('#center_name_day').val() == "") {
                $('#dis_error_day').text('Note : All Field Required');
                return false;
            } else {
                $('#dis_error_day').text(null);
                $('#day_modal').modal('hide');


                var email = $('#email').val();
                var center = $('#center_name_day').val();
                var start = $('#daystart').val();
                var end = $('#dayend').val();
                var tags = $('#tags').val();


                $.ajax({
                    url: "<?php echo base_url(); ?>Calendar/insert_day",
                    type: "POST",
                    data: {
                        title: center,
                        start: start,
                        end: end,
                        email: email,
                        tags: tags
                    },
                    success: function() {
                        $('#day_form')[0].reset()
                        calendar.fullCalendar('refetchEvents');
                        Swal.fire({
                            icon: 'success',
                            title: 'Event Added Successfully',
                            showConfirmButton: false,
                            timer: 2500
                        })
                    }
                })
            }
        });

        //save events by month and by week          

        $('#save_events').click(function() {
            if ($('#datefrom').val() == "" || $('#dateto').val() == "" || $('#center_name').val() ==
                "" || $('#timeto').val() == "" || $('#timefrom').val() == "") {
                $('#dis_error').text('Note : All Field Required');
                return false;
            } else {
                $('#dis_error').text(null);
                $('#cal_modal').modal('hide');
                $.ajax({
                    url: "<?php echo base_url(); ?>Calendar/insert",
                    type: "POST",
                    data: $('#suspend_form').serialize(),
                    success: function() {
                        $('#suspend_form')[0].reset();
                        calendar.fullCalendar('refetchEvents');
                        Swal.fire({
                            icon: 'success',
                            title: 'Event Added Successfully',
                            showConfirmButton: false,
                            timer: 2500
                        })
                    }
                })
            }
        });
        $('#up_save_events').click(function() {
            if ($('#up_datefrom').val() == "" || $('#up_dateto').val() == "" || $('#up_center_name')
                .val() == "" || $('#up_timeto').val() == "" || $('#up_timefrom').val() == "") {
                $('#up_dis_error').text('Note : All Field Required');
                return false;
            } else {
                $('#up_dis_error').text(null);
                $('#update_cal_modal').modal('hide');
                $.ajax({
                    url: "<?php echo base_url(); ?>Calendar/up_insert",
                    type: "POST",
                    data: $('#up_suspend_form').serialize(),
                    success: function() {
                        $('#up_suspend_form')[0].reset()
                        calendar.fullCalendar('refetchEvents');
                        Swal.fire({
                            icon: 'success',
                            title: 'Event Updated Successfully',
                            showConfirmButton: false,
                            timer: 2500
                        })
                    }
                });

            }
        });

        $('#del').click(function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.value) {
                    var id = $('#up_id').val();
                    $.ajax({
                        url: "<?php echo base_url(); ?>Calendar/delete",
                        type: "POST",
                        data: {
                            id: id
                        },
                        success: function() {
                            $('#update_cal_modal').modal('hide');
                            calendar.fullCalendar('refetchEvents');
                            Swal.fire({
                                icon: 'success',
                                title: 'Event Removed',
                                showConfirmButton: false,
                                timer: 2500
                            })
                        }
                    })
                }
            });
        });
    });
    </script>

</head>

<body>
    <section class="container mt-2 mb-2">
        <div class="row">
            <div class="col-md-6 mb-2">

                <h2>Welcome to Homepage </h2>
                <h4>User Info:</h4>
                <p>Fullname: <?php echo $username; ?></p>
                <p>Email: <?php echo $email; ?></p>
                <a href="<?php echo base_url(); ?>/user/logout" class="btn btn-danger">Logout</a>
                <a href="<?php echo base_url(); ?>Roadmap/index" class="btn btn-success">View Roadmap</a>
                <a href="<?php echo base_url(); ?>Roadmap/fetch_event" class="btn btn-primary">View Events</a>
                <a href="<?php echo base_url(); ?>user/get_allusers" class="btn btn-info">View Users</a>
            </div>
        </div>
    </section>
    <section class="container p-2">
        <?php $page_title; ?>
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-md-6 justify-content-center">
                <h4 class="card-title text-center">Calendar</h4>
            </div>
            <div class="col-lg-3"></div>
            <div id="calendar"></div>
            <div class="modal" tabindex="-1" id="cal_modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><span id="dis_error" class="text-danger"></span>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="suspend_form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Event *</label>
                                        <!-- <input type="hidden" id="email" name="email" Value="<?php echo $email;?>"> -->
                                        <input type="text" class="form-control" id="event" name="title" required>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label>Add Users</label>
                                        <select class="form-control" id="user" name="user[]" style="width: 100%;"
                                            multiple data-live-search="true" required>
                                            <?php foreach ($user_data as $row) {?>
                                            <option value="<?php echo $row->email;?>">
                                                <?php echo $row->username;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label>Tags</label>
                                        <select class="form-control" id="tags" name="tags[]" multiple="multiple"
                                            data-placeholder="Enter Tags" style="width: 100%;">
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label>Description</label>

                                        <input type="text" class="form-control" id="event_desc" name="event_desc">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mt-2">Date From<span class="text-warning">*</span></label>
                                        <input type="date" class="form-control" id="datefrom" name="start" required>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="mt-2">Date To<span class="text-warning">*</span></label>
                                        <input type="date" class="form-control" id="dateto" name="end" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="mt-2">Time From<span class="text-warning">*</span></label>
                                        <input type="time" class="form-control" id="timefrom" name="timestart" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="mt-2">Time To<span class="text-warning">*</span></label>
                                        <input type="time" class="form-control" id="timeto" name="timeend" required>
                                        <span id="time_error" class="text-danger"></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="save_events" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" tabindex="-1" id="update_cal_modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn btn-primary" id="del">Delete</button>
                            <h5 class="modal-title"><span id="up_dis_error" class="text-danger"></span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form id="up_suspend_form">
                                <div class="row">
                                    <span>Note : <span class="text-warning">*</span> Denoted Field Are Required
                                    </span><br><br>
                                    <div class="col-md-12">
                                        <label>Event</label>
                                        <input type="hidden" id="email" name="email" Value="<?php echo $email; ?>">
                                        <input type="text" class="form-control" id="up_titles" name="up_title">
                                        <!-- <select class="form-control" id="up_titles" name="up_title">
                                  <option value="">Select event</option>
                                  
                                    <option value="Google">Google</option>
                                    <option value="Youtube">Youtube</option>
                              
                                </select> -->
                                    </div>

                                    <div class="col-md-12">
                                        <label class="mt-2">Date From<span class="text-warning">*</span></label>
                                        <input type="date" class="form-control" id="up_datefrom" name="up_start"
                                            readonly>
                                        <input type="hidden" class="form-control" id="up_id" name="up_id">
                                    </div>

                                    <div class="col-md-12">
                                        <label class="mt-2">Date To<span class="text-warning">*</span></label>
                                        <input type="date" class="form-control" id="up_dateto" name="up_end" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="mt-2">Time From<span class="text-warning">*</span></label>
                                        <input type="time" class="form-control" id="up_timefrom" name="up_timestart">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="mt-2">Time To<span class="text-warning">*</span></label>
                                        <input type="time" class="form-control" id="up_timeto" name="up_timeend">
                                        <span id="up_time_error" class="text-danger"></span>
                                    </div>
                                </div>

                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" id="up_save_events" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" tabindex="-1" id="day_modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><span id="dis_error_day" class="text-danger"></span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="day_form">
                                <div class="row">
                                    <span>Note : <span class="text-warning">*</span> Denoted Field Are Required
                                    </span><br>
                                    <div class="col-md-12">
                                        <label>Event</label>
                                        <input type="hidden" id="email" name="email" Value="<?php echo $email; ?>">
                                        <input type="text" class="form-control" id="center_name_day"
                                            name="center_name_day">
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label>Add Users</label>
                                        <select class="form-control" name="user[]" style="width: 100%;"
                                            data-live-search="true" multiple required>
                                            <?php foreach ($user_data as $row) {?>
                                            <option value="<?php echo $row->email;?>">
                                                <?php echo $row->username;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label>Tags</label>
                                        <select class="form-control" id="tags" name="tags[]" multiple="multiple"
                                            data-placeholder="Enter Tags" style="width: 100%;">
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label>Description</label>

                                        <input type="text" class="form-control" id="event_desc" name="event_desc">
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label class="mt-3"> <span>Drag Your Event To Change Date & Time</span></label>
                                    </div>
                                    <input type="hidden" id="daystart" name="">
                                    <input type="hidden" id="dayend" name="">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="save_events_day" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- container End-->

</body>
<script>
$("#tags").select2({
    tags: true
});
$('#user').selectpicker();
</script>

</html>