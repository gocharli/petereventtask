<!doctype html>
<html lang="en">
<?php
    $user = $this->session->userdata('user');
    extract($user);
?>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <section class="container p-4">
        <div class="row">
            <div class="col-md-6 mb-2">

                <h2>Events </h2>
                <h4>User Info:</h4>
                <p>Fullname: <?php echo $username; ?></p>
                <p>Email: <?php echo $email; ?></p>
                <a href="<?php echo base_url(); ?>/user/logout" class="btn btn-danger">Logout</a>
                <a href="<?php echo base_url(); ?>user/dashboard" class="btn btn-success">Go to Dashboard</a>
                <a href="<?php echo base_url(); ?>Roadmap/index" class="btn btn-primary">View Roadmap</a>
            </div>
        </div>
    </section>
    <section class="container mt-4">
        <div class="col-md-12 mt-2">

            <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <!-- <h4><i class="icon fa fa-warning"></i> Alert!</h4> -->
                <?php
            echo  $this->session->flashdata('success');
            ?>
            <?php } if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <!-- <h4><i class="icon fa fa-warning"></i> Alert!</h4> -->
                    <?php
            echo  $this->session->flashdata('error');
            ?>
            </div>
            <?php } ?>
        </div>
        <table class="table table-striped table-bordered mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Event Title</th>
                    <th>Event Tags</th>
                    <th>Event Discription</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count=1;
                if(isset($event_data)){
                    foreach($event_data as $data){ 
            ?>
                <tr>
                    <td><?php echo $count++;?></td>
                    <td><?php echo $data->event_title;?></td>
                    <td>
                        <?php if(isset($data->event_tags)){?>
                        <div class="page-keywords mt-1">
                            <?php  
                                $tags = explode(",", $data->event_tags);
                                foreach($tags as $event_keyword) {
                                $event_keyword = trim($event_keyword); 
                                if(!empty($event_keyword)){ 
                                ?>
                            <span class="badge bg-secondary mr-1 rounded-1"
                                title="<?php echo $event_keyword; ?>"><?php echo $event_keyword; ?></span>
                            <?php } }?>
                        </div>
                        <?php } ?>
                    </td>
                    <td><?php echo $data->event_description;?></td>
                    <td>
                        <a href="<?= base_url('Roadmap/sendmail/').$data->event_id; ?>"
                            class="btn btn-warning btn-sm">Send Reminder</a>

                    </td>
                </tr>
                <?php } } ?>
            </tbody>

        </table>
    </section>
</body>

</html>