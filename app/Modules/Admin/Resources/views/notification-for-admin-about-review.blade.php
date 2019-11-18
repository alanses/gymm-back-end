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
<div class="h2">You have reviews problem</div>
<h2>User info</h2>
<div class="order">User name: {{optional($review->user)->name}}</div>
<div class="order">User email: {{optional($review->user)->email}}</div>
<h2>Review info</h2>
<div class="order">Review ID: {{optional($review->user)->id}}</div>
<div class="order">Rating: {{$review->rating_value}}</div>
<div class="order">Comment: {{$review->comment}}</div>

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
