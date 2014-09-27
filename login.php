<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Exotic Reservation Portal</title>

        <link rel="stylesheet" href="css/bootstrap.min.css" >
        <link href="css/signin.css" rel="stylesheet">

    </head>
    <body>

        <?php
        require_once 'core/init.php';
        //include 'navigation.php';
        if (Input::exists()) {
            $validate = new validate();
            $validation = $validate->check($_POST, array(
                'username' => array('required' => true),
                'password' => array('required' => true)
            ));

            if ($validation->passed()) {
                $user = new User();
                $remember = (Input::get('remember') === 'on') ? true : false;
                $login = $user->login(Input::get('username'), Input::get('password'), $remember);

                if ($login) {
                    Redirect::to('index.php');
                } else {
                    echo '<div class="alert alert-danger"><strong>WARNING! </strong> Wrong Username or Password</div>';
                }
            } else {
                foreach ($validation->errors() as $error) {
                    echo $error, '<br>';
                }
            }
        }
        ?>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>

        <div class="container">
            <form action="" method="post" class="form-signin " role="form">
                <div class="center-block">
                    <h3 class="form-signin-heading " ><b>Mermaid Hospitality management Portal</b></h3>
                </div>
                <input type="text" name="username" class="form-control" placeholder="Username" required>

                <div class="">
                    <br>
                </div>

                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <label class="checkbox">
                    <input class="" type="checkbox" name="remember" id="remember" value="remember-me"> Remember me
                </label>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"> 
                <button type="submit" class="btn  btn-primary btn-block">Log In</button>

            </form>
        </div>
    </body>
</html>


