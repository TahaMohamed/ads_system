<!DOCTYPE html>
<html>
<head>
    <title>Ad reminder</title>
</head>
<body>

<h1>Hi, {{ $user->name }}</h1>
<p>You have these ads tomorrow :</p>
<ul>
    @foreach($ads as $ad)
    <li>{{ $ad->title }}</li>
    @endforeach
</ul>

<p>Thank you</p>
</body>
</html>
