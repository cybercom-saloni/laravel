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
        <form method="POST" action="/posts/{{$post->id}}">
            @method('PUT')
            @csrf
            <input type="text" id="name1" value="{{$post->id}}">
            <textarea id="name">{{$post->email}}</textarea>       
        <button>IPDATE</button>
        </form>
    </div>
</body>
</html>