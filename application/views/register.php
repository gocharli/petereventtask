<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First SignUp Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<section class="container">
    <h1 class="page-header text-center">Signup with Email Verification</h1>
    <div class="row p-2">
        <div class="col-lg-6">
            <?php
                if(validation_errors()){
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?php echo validation_errors(); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }

                if($this->session->flashdata('message')){
                    ?>
                    <div class="alert alert-info alert-dismissible text-center" role="alert">
                        <?php echo $this->session->flashdata('message'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    unset($_SESSION['message']);
                }	
            ?>
            <h3 class="text-center">Signup Form</h3>
            <form method="POST" action="<?php echo base_url().'User/register'; ?>">
                <div class="form-group">
                    <label for="username">Name: *</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email: *</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password: *</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>" required>
                </div>
                <div class="form-group mb-2">
                    <label for="password_confirm">Confirm Password: *</label>
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" value="<?php echo set_value('password_confirm'); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
                <div class="text-right">
                    <a href="<?php echo base_url(); ?>">Already have an account ?</a>
                </div>
            </form>
            
        </div>
    </div>
</section>

</body>
</html>