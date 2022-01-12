<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        .container {
            width: 400px;
        }
    </style>
</head>
<body style="padding-top: 3rem;">

<div class="container">
    <div class="row">
        <table>
            <?php if($_SESSION['auth']==true){?>
                <tr>
                    <td><a href="?controller=users&action=show&id=<?=$user['id']?>"><?=$user['id']?></a></td>
            <td><?=$user['name']?></td>
            <td><?=$user['email']?></td>
            <td><?=$user['gender']?></td>
            <td><img width="100px" height="100px" src='<?=$user['path_to_img']?>'/></td>
            </tr>
            <?php } ?>
            <?php if($_SESSION['auth']==false){ foreach ($users as $user):?>
                <tr>
                    <td><a href="?controller=users&action=show&id=<?=$user['id']?>"><?=$user['id']?></a></td>
                    <td><?=$user['name']?></td>
                    <td><?=$user['email']?></td>
                    <td><?=$user['gender']?></td>
                    <td><img width="100px" height="100px" src='<?=$user['path_to_img']?>'/></td>
                    <td><a href="?controller=users&action=delete&id=<?=$user['id']?>">X</a></td>
                </tr>
            <?php endforeach;}?>
        </table>
    </div>
    <?php if($_SESSION['auth']==false){ ?>
    <a class="btn" href="?controller=users&action=addForm">add new user</a>
    <?php }?>
    <a class="btn" href="?controller=index">return back</a>
</div>
</body>
</html>
