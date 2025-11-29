<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HHalaman Daftar Posts </title>
</head>
<body>
    <h1>Daftar Posts</h1>
    @foreach ($posts as $post )
    
    @endforeach
    <article>
        <h2> <a href ="/posts/{{ $post->slug }}"> {{ $posts->title }}</a></h2>
    <p>{$spots->excerpt}</p></article>
</body>
</html>