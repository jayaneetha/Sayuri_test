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
        require_once 'protect.php';
        $function = new Functions();
        $user = new User();

        include_once 'navigation.php';
        include_once 'register.php';
//        if(!$user->hasPermissions('admin')){
//            die($function->alert('danger', 'Warning!','You are not allowed here!'));
//        }
        ?>

        <div class="col-md-12">

            <div class="panel">
                <div class="panel panel-info">
                    <div class="panel panel-heading">Create User</div>
                    <div class="panel-body">
                        <div class="col-md-4">
                            <form action ="" method ="post">
                                <div class="input-group">
                                    <label class="input-group-addon" for="username">Username</label>
                                    <input class="form-control" type="text" name="username" id="username" value="<?php // echo escape(Input::get('username')); ?>" autocomplete ="off">
                                </div>

                                <div style="line-height: 8px;">&nbsp;
                                </div>

                                <div class="input-group">
                                    <label class="input-group-addon" for="password">Password</label>
                                    <input class="form-control" type="password" name="password" id="password">
                                </div>

                                <div style="line-height: 8px;">&nbsp;
                                </div>

                                <div class="input-group">
                                    <label class="input-group-addon" for="password_again">Password again</label>
                                    <input class="form-control" type="password" name="password_again" id="password_again">
                                </div>

                                <div style="line-height: 8px;">&nbsp;
                                </div>

                                <div class="input-group">
                                    <label class="input-group-addon" for="name">Your Name</label>
                                    <input class="form-control" type="text" name="name" value="<?php echo escape(Input::get('name')); ?>" id="name">
                                </div>

                                <div style="line-height: 8px;">&nbsp;
                                </div>
                               

                                <div style="line-height: 8px;">&nbsp;
                                </div>

                                <div class="btn-group-sm">
                                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                    <button class="btn btn-group" type="submit" value="Register">Register</button>
                                </div>

                            </form>
                        </div>
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