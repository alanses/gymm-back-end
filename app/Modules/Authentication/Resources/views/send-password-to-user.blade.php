<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gym App</title>
</head>
<body>
<div class="h2">Dear user</div>
<div class="h2">You have a new password, use it for login</div>
<div class="order">
    Password for login <p>{{$password}}</p>
</div>
</body>
</html>

<style>
    .h2{
        font-size: 40px;
        font-weight: 700;
        margin: 30px 0;
    }
    .separator-big{
        margin-bottom: 30px;
        background-color: #db383c;
        height: 4px;
        width: 85px;
    }
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
