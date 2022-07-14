<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<section class="container">
    <h1 class="page-header text-center">Login</h1>
    <div class="row p-2">
		<div class="col-sm-4 col-sm-offset-4">
			<div class="login-panel panel panel-primary">
		        <div class="panel-heading">
		            <h3 class="panel-title"><span class="glyphicon glyphicon-lock"></span> Login
		            </h3>
		        </div>
		    	<div class="panel-body">
		        	<form method="POST" action="<?php echo base_url(); ?>/user/login">
		            	<fieldset>
		                	<div class="form-group mb-2">
		                    	<input class="form-control" placeholder="Email" type="email" name="email" required>
		                	</div>
		                	<div class="form-group mb-2">
		                    	<input class="form-control" placeholder="Password" type="password" name="password" required>
		                	</div>
		                	<button type="submit" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-log-in"></span> Login</button>
		            	</fieldset>
		        	</form>
                    <div class="col-12 col-sm-8 text-right">
                        <a href="<?php echo base_url(); ?>user/register">Don't have an account yet?</a>
                    </div>
		    	</div>
		    </div>
			<?php
				if($this->session->flashdata('error')){
					?>
					<div class="alert alert-danger alert-dismissible text-center" role="alert" style="margin-top:20px;">
						<?php echo $this->session->flashdata('error'); ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					<?php
				}
				
			?>
		</div>
	</div>
</section>

</body>
</html>