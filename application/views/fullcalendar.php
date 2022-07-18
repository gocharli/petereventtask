<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <script>
    $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            editable: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: "<?php echo base_url(); ?>/fullcalendar/load",
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {
                var event_name = prompt("Enter Event Title");
                console.log('Event_name', event_name);
                if (event_name) {
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    console.log('Start', start);
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                    console.log('End', end);
                    console.log('AllDay', allDay);
                    $.ajax({
                        url: "<?php echo base_url(); ?>/fullcalendar/insert",
                        type: "POST",
                        data: {
                            event_name: event_name,
                            start: start,
                            end: end
                        },
                        success: function() {
                            calendar.fullCalendar('refetchEvents');
                            alert("Added Successfully");
                        }
                    })
                }
            },
            editable: true,
            eventResize: function(event) {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

                var event_name = event.event_name;

                var id = event.id;

                $.ajax({
                    url: "<?php echo base_url(); ?>/fullcalendar/update",
                    type: "POST",
                    data: {
                        event_name: event_name,
                        start: start,
                        end: end,
                        id: id
                    },
                    success: function() {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Update");
                    }
                })
            },
            eventDrop: function(event) {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                //alert(start);
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                //alert(end);
                var event_name = event.event_name;
                var id = event.id;
                $.ajax({
                    url: "<?php echo base_url(); ?>/fullcalendar/update",
                    type: "POST",
                    data: {
                        event_name: event_name,
                        start: start,
                        end: end,
                        id: id
                    },
                    success: function() {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Updated");
                    }
                })
            },
            eventClick: function(event) {
                if (confirm("Are you sure you want to remove it?")) {
                    var id = event.id;
                    $.ajax({
                        url: "<?php echo base_url(); ?>/fullcalendar/delete",
                        type: "POST",
                        data: {
                            id: id
                        },
                        success: function() {
                            calendar.fullCalendar('refetchEvents');
                            alert('Event Removed');
                        }
                    })
                }
            }
        });
    });
    </script>
</head>

<body>
    <section class="p-5">
        <h2 align="center"><a href="#">FullCalendar</a></h2>
        <div class="container">
            <div id="calendar"></div>
        </div>
    </section>
</body>

</html>