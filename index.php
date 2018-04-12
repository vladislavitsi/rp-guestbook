<?php
    session_start();
?>
<!doctype html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.min.css">

    <title>Hello, world!</title>
    <style type="text/css">
        #container {
            width: 100%;
            margin: auto;
        }
        .padd {
            padding-top: 15px;
        }
        #messages-list {
            max-height: 95vh;
            overflow: auto;
        }
    </style>
    <script src="getRecords.js"></script>
</head>
<body>
<div id="container" class="row">
    <div class="col-md-4 col-sm-12 col-xs-12" >
        <form method="post" action="post.php">
            <div class="row">
                <div id="textarea" class="text col-xs-12 col-sm-8 col-md-12 padd">
                    <textarea name="text" class="form-control" rows="8" id="message"></textarea>
                </div>
                <div id="login-form" class="login col-xs-12 col-sm-4 col-md-12 padd">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" id="password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    <div id="error-message" style="color: red">
                        <?php
                            echo $_SESSION['error-message'];
                            $_SESSION['error-message'] = '';
                        ?>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-8 col-sm-12 col-xs-12 padd">
        <div id="messages-list" class="list-group">
            <script>
                getRecords();
            </script>
        </div>
    </div>
</div>
</body>
</html>