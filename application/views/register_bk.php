
    <!-- <div class="row p-5">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading p-3 bg-secondary">
                <h4 class="text-light">User Registration Form</h4>
            </div>
            <div class="panel-body">
            <form method="POST" name="registrationform" action="<?php echo base_url().'user/register'; ?>">
                <div class="form-group mt-3 mb-3">
                    <label for="name">First Name</label>
                    <input class="form-control" name="fname" placeholder="Your First Name" type="text" value="<?php echo set_value('fname'); ?>" />
                    <span class="text-danger"><?php echo form_error('fname'); ?></span>
                </div>

                <div class="form-group mb-3">
                    <label for="name">Last Name</label>
                    <input class="form-control" name="lname" placeholder="Last Name" type="text" value="<?php echo set_value('lname'); ?>" />
                    <span class="text-danger"><?php echo form_error('lname'); ?></span>
                </div>
                
                <div class="form-group mb-3">
                    <label for="email">Email ID</label>
                    <input class="form-control" name="email" placeholder="Email-ID" type="text" value="<?php echo set_value('email'); ?>" />
                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                </div>

                <div class="form-group mb-3">
                    <label for="subject">Password</label>
                    <input class="form-control" name="password" placeholder="Password" type="password" />
                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                </div>

                <div class="form-group mb-3">
                    <label for="subject">Confirm Password</label>
                    <input class="form-control" name="cpassword" placeholder="Confirm Password" type="password" />
                    <span class="text-danger"><?php echo form_error('cpassword'); ?></span>
                </div>

                <div class="form-group mb-3">
                    <button name="submit" type="submit" class="btn btn-primary">Signup</button>
                    <button name="cancel" type="reset" class="btn btn-default">Cancel</button>
                </div>
                </form>
            <?php echo $this->session->flashdata('msg'); ?>
            </div>
        </div>
    </div>
</div> -->