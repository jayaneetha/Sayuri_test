<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Exotic Reservation Portal</title>

        <link rel="stylesheet" href="css/bootstrap.min.css" >
        <link rel="stylesheet" href="css/bootstrap.css" >
        <link rel="stylesheet" href="" >

        <!--link rel="stylesheet" href="css/styles.css"-->


    </head>
    <body>
        <?php
        require_once 'core/init.php';

        $user = new User();

        if (!$user->isLoggedIn()) {

            include_once '';
            Redirect::to('index.php');
        }

        if ($user->isLoggedIn()) {
            $active = array("", "", "", "", "active");
            require_once 'navigation.php';
        } else {
            Redirect::to('login.php');
        }

        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'password_current' => array(
                        'required' => true,
                        'min' => 6
                    ),
                    'password_new' => array(
                        'required' => true,
                        'min' => 6
                    ),
                    'password_new_again' => array(
                        'required' => true,
                        'min' => 6,
                        'matches' => 'password_new'
                    )
                ));

                if ($validation->passed()) {
                    if (Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
                        echo 'Your current password is wrong!';
                    } else {
                        $salt = Hash::salt(32);
                        $user->update(array(
                            'password' => Hash::make(Input::get('password_new'), $salt),
                            'salt' => $salt
                        ));

                        Session::flash('home', 'Your password has been changed!');
                        Redirect::to('index.php');
                    }
                } else {
                    foreach ($validation->errors() as $error) {
                        echo $error, '<br>';
                    }
                }
            }
        }
        ?>
        <div class="col-md-12">

            <div class="panel">
                <div class="panel panel-info">
                    <div class="panel panel-heading">Change Password</div>
                    <div class="panel-body">
                        <div class="col-md-4">
                        <form action ="" method ="post">

                            <div class="input-group input-group-sm">
                                <label class="input-group-addon" for="password_current">Current password</label>
                                <input class="form-control" type="password" name="password_current" id="password_current" required>
                            </div>

                            <div style="line-height: 8px;">&nbsp;</div>

                            <div class="input-group input-group-sm">
                                <label class="input-group-addon" for="password_new">New password&nbsp;&nbsp;</label>
                                <input class="form-control" type="password" name="password_new" id="password_new" required>
                            </div>

                            <div style="line-height: 8px;">&nbsp;</div>

                            <div class="input-group input-group-sm">
                                <label class="input-group-addon" for="password_new_again">Password again </label>
                                <input class="form-control" type="password" name="password_new_again" id="password_new_again" required>
                            </div>

                            <div style="line-height: 8px;">&nbsp;</div>

                            <div class="btn btn-group-sm">
                                <button class="btn btn-group-sm btn-info form-control" type="submit" value="Change">Change Password</button>
                                <input class="form-control" type="hidden" name="token" value="<?php echo Token::generate(); ?>">		
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
