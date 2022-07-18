<!doctype html>
<html lang="en">
<?php
    $user = $this->session->userdata('user');
    extract($user);
?>

<head>
    <style>
        :root {
            --colorPrincipal: #7DB4B5;
            --colorSecundario: #680148;
            --colorSombra: rgba(125, 180, 181, 0.2)
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: rgb(248, 248, 248);
        }

        h1 {
            font-size: 48px !important;
            text-align: center;
            text-transform: uppercase;
            padding: 25px 0;
            letter-spacing: 2px;
            color: var(--colorPrincipal);
        }

        /*Timeline*/
        .timeline {
            position: relative;
            margin: 50px auto;
            padding: 40px 0;
            width: 100%;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            width: 2px;
            height: 100%;
            background-color: #e4e4e4;
        }

        .timeline ul li:hover .time {
            transform: scale(1.1);
        }

        /*Elementos de lista*/
        .timeline ul li {
            list-style: none;
            position: relative;
            width: 50%;
            padding: 20px 40px;
        }

        .timeline ul li:nth-child(odd) {
            float: left;
            text-align: right;
            clear: both;
        }

        .timeline ul li:nth-child(even) {
            float: right;
            text-align: left;
            clear: both;
        }

        /*Circulo indicador*/
        .timeline ul li::before {
            content: '';
            position: absolute;
            top: 30px;
            width: 10px;
            height: 10px;
            background-color: var(--colorPrincipal);
            border-radius: 50%;
            box-shadow: 0 0 0 3px var(--colorSombra);
        }

        .timeline ul li:nth-child(odd)::before {
            right: -6px;
        }

        .timeline ul li:nth-child(even)::before {
            left: -4px;
        }

        .timeline ul li:hover::before {
            transform: scale(1.5);
        }

        /*Fecha*/
        .time {
            display: inline-block;
            font-weight: 200;
            font-size: 14px !important;
            padding: 5px 10px;
            margin-bottom: 15px;
            background-color: #E0EFF1;
            color: var(--colorSecundario);
            border-radius: 20px;
            box-shadow: 0 0 0 3px var(--colorSombra);
        }

        h3 {
            font-weight: 200;
            font-size: 14px !important;
        }

        /*Contenido*/
        .content {
            padding-bottom: 20px;
        }

        .timeline ul li h2 {
            font-weight: 200;
            color: var(--colorPrincipal);
        }

        .timeline ul li p {
            margin: 10px 0;
            font-weight: 300;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <section class="container mt-2 mb-2">
        <div class="row p-2">
            <div class="col-md-4">

                <h2>Roadmap Event </h2>
                <h4>User Info:</h4>
                <p>Fullname: <?php echo $username; ?></p>
                <p>Email: <?php echo $email; ?></p>
                <a href="<?php echo base_url(); ?>user/logout" class="btn btn-danger">Logout</a> 
                <a href="<?php echo base_url(); ?>user/dashboard" class="btn btn-success">Go to Dashboard</a>
                <a href="<?php echo base_url(); ?>Roadmap/fetch_event" class="btn btn-primary">View Events</a>
            </div>
        </div>
    </section>
    <section>
        <h1>Timeline</h1>
        <div class="timeline">
            <ul>
                <?php if(isset($event_data)){
                    foreach($event_data as $data){ ?>
                <li>
                    <div class="content">
                        <div class="time">
                            <h3><?php echo date_format(date_create($data->start_event),'M Y'); ?></h3>
                        </div>
                        <h2><?php echo $data->event_title; ?></h2>
                        <p><?php echo $data->event_description; ?></p>
                    </div>
                </li>
                <?php } }?>
                <div style="clear: both;"></div>
                
            </ul>
        </div>
    </section>

</body>

</html>