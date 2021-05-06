<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>hello</h1>
    <div class="container">
        @foreach($posts as $post)
        <table>
        <h1>{{$post->id}}</h1>
        </table>
        @endforeach
    </div>
</body>
</html>