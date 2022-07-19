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

                <h2>Users </h2>
                <h4>User Info:</h4>
                <p>Fullname: <?php echo $username; ?></p>
                <p>Email: <?php echo $email; ?></p>
                <a href="<?php echo base_url(); ?>/user/logout" class="btn btn-danger">Logout</a>
                <a href="<?php echo base_url(); ?>user/dashboard" class="btn btn-success">Go to Dashboard</a>
                <a href="<?php echo base_url(); ?>Roadmap/index" class="btn btn-primary">View Roadmap</a>
                <a href="<?php echo base_url(); ?>Roadmap/fetch_event" class="btn btn-info">View Events</a>
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
              
                    <?php
            echo  $this->session->flashdata('error');
            ?>
                </div>
                <?php } ?>
            </div>
            <button type="button" class="btn btn-success btn-sm flex-end mb-2" data-toggle="modal"
                data-target="#addNewModal">Add New User</button><br />
            <table class="table table-striped table-bordered mt-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                $count=1;
                if(isset($allusers)){
                    foreach($allusers as $userdata){ 
            ?>
                    <tr>
                        <td><?php echo $count++;?></td>
                        <td><?php echo $userdata->username;?></td>

                        <td><?php echo $userdata->email;?></td>
                        <td>
                            
                            <a href="#" data-user_id="<?php echo $userdata->user_id;?>" class="btn btn-info btn-sm update-record" data-toggle="modal" data-target="#UpdateModal">Edit</a>
                            <a href="<?php base_url('user/delete_user_profile/').$userdata->user_id; ?>"
                                class="btn btn-danger btn-sm">Delete</a>
                           

                        </td>
                    </tr>
                    <?php } } ?>
                </tbody>

            </table>
    </section>
    <!-- Add User Modal -->
    <form action="<?php echo base_url('User/register');?>" method="post">
        <div class="modal fade" id="addNewModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel"><b>Add New User</b></h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="username">Name: *</label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="<?php echo set_value('username'); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email: *</label>
                            <input type="text" class="form-control" id="email" name="email"
                                value="<?php echo set_value('email'); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password: *</label>
                            <input type="password" class="form-control" id="password" pattern=".{7,}"
                                title="Seven or more characters" name="password"
                                value="<?php echo set_value('password'); ?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="password_confirm">Confirm Password: *</label>
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm"
                                value="<?php echo set_value('password_confirm'); ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Update Profile Modal -->
    <form action="<?php echo base_url('User/up_insert');?>" method="post">
        <div class="modal fade" id="UpdateModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel"><b>Update Profile</b></h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="user_id" name="user_id"
                                value="" required>
                        <div class="form-group">
                            <label for="up_name">Name: *</label>
                            <input type="text" class="form-control" id="up_name" name="up_name"
                                value="" required>
                        </div>
                        <div class="form-group">
                            <label for="up_email">Email: *</label>
                            <input type="text" class="form-control" id="up_email" name="up_email"
                                value="" required>
                        </div>
                        <div class="form-group">
                            <label for="up_password">Password: *</label>
                            <input type="password" class="form-control" id="up_password" pattern=".{7,}"
                                title="Seven or more characters" name="up_password"
                                value="" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="edit_id" required>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</body>

</html>
<script>
    $(document).ready(function(){
        $('.update-record').on('click',function(){
            var user_id = $(this).data('user_id');
            
            $.ajax({
                url: "<?php echo base_url(); ?>User/update_user_profile",
                data: {user_id: user_id},
                method: "POST",
                success: function(data){
                    obj = JSON.parse(data);
                    $('#user_id').val(user_id);
                    $('#up_email').val(obj.email);
                    $('#up_name').val(obj.username);
                    $('#up_password').val(obj.password);
                }
            });
        });
    });
    
</script>
