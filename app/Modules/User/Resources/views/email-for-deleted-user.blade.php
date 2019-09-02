<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo app</title>
</head>
<body>
<div class="order">
    <p>Welcome to our website</p>
</div>
<div class="h2">Dear</div>
<h2>{{$user['name']}}</h2>
<p>Your been deleted by some reason, please connect with admin</p>

</body>
</html>

<style>
    .order p{
        font-size: 18px;
        line-height: 32px;
    }
    .order span{
        font-weight:bold;
    }
    .order table{
        margin: 20px 0 40px;
        font-size: 18px;
    }
    .order td{
        padding: 0 15px 5px 0;
    }
</style>
