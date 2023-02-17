
<!DOCTYPE html>

<html>
  
<head>
    <meta charset="UTF-8">
    <meta name="viewpoint" content=
        "width=device-width, initial-scale=1.0">
 </head>
  
  <body>    

<div class="container">
        <?php echo form_open('user/login'); ?>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" value="<?php echo set_value('email'); ?>" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
            <?php echo form_error('email'); ?>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
            <?php echo form_error('password'); ?>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <?php echo $this->session->flashdata('login_error'); ?>
        <?php form_close(); ?>
    </body>
  
  </html>