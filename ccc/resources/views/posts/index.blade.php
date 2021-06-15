<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        @foreach($posts as $post)
        <table border=1>
        <tr>
            <td>Id</td>
            <td>Name</td>
            <td>CommentId</td>
        </tr>
        <tr>
            <td>{{$post->id}}</td>
            <td>{{$post->name}}</td>
            <td>{{$post->commentId}}</td>
        </tr>
        </table>
        @endforeach
    </div>
</body>
</html>