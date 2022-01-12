<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        body{
            padding-top: 3rem;
        }
        .container {
            width: 400px;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Form to add User -->
    <h3>Show User Form</h3>
    <form action="?controller=users&action=edit" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$user['id']?>" />
        <div class="row">
            <div class="field">
                <label>Name: <input type="text" name="name" value="<?=$user['name']?>"></label>
            </div>
        </div>

        <div class="row">
            <div class="field">
                <label>Email: <input type="text" name="email" value="<?=$user['email']?>"></label>
            </div>
        </div>

        <div class="row">
            <div class="field">
                <label>Password <input type="text" name="password" value="<?=$user['password']?>"></label>
            </div>
        </div>

        <div class="row">
            <div class="field">
                <label>
                    <input class="with-gap" type="radio" name="gender"
                           <?php if ($user['gender']=='female'):?>checked<?php endif;?> value="female"/>
                    <span>Female</span>
                </label>

            </div>
            <div class="field">
                <label>
                    <input class="with-gap" type="radio" name="gender"
                           <?php if ($user['gender']=='male'):?>checked<?php endif;?> value="male"/>
                    <span>Male</span>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="file-field input-field">
                <div class="btn">
                    <span>Photo</span>
                    <input type="file" name="photo"  accept="image/png, image/gif, image/jpeg" ">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
        </div>
        <input type="submit" class="btn" value="Save">
        <a class="btn" href="?controller=users">return back</a>
    </form>
</div>
</body>
</html>
