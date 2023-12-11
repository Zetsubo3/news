<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Лента новостей</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"> {{-- asset - папка паблик --}}
</head>

<header> </header>

<body>
    <div>
        @foreach($news as $singleNews)
            <div class="container col-md-12">
                <div class="card mb-3">
                    <div class="card-body" id="news_{{$singleNews->id}}">
                        <a href="{{$singleNews->guid}}" class="h2">{{$singleNews->title }}</a>
                        <p>{{$singleNews->pubDate}}</p>
                        <p>{{$singleNews->description}}</p>

                        @if($singleNews->photo)
                                <?php
                                $imageData = base64_encode($singleNews->photo);
                                $imageFormat = 'jpeg';
                                $base64 = 'data:' . $imageFormat . ';base64,' . $imageData;
                                ?>
                            <img src="{{$base64}}" alt="Описание изображения">
                        @endif

                        <ul class="list-unstyled">
                            @foreach($singleNews->categories as $category)
                                <li>{{ $category->name }}</li>
                            @endforeach
                        </ul>

                        <form action="{{ route('like.index', $singleNews->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="page" value="{{ $news->currentPage()}}">
                            <input type="submit" value="Нравится" class="btn btn-success"> <p>{{ $singleNews->likes_count }}</p>
                        </form>
                        <form action="{{ route('dislike.index', $singleNews->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="page" value="{{ $news->currentPage()}}">
                            <input type="submit" value="Не нравится" class="btn btn-danger"> <p>{{ $singleNews->dislikes_count }}</p>
                        </form>
                        <p>Рэйтинг: {{ $singleNews->rating}}</p>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <div >{{$news->links()}}</div>
</body>

<footer></footer>

</html>


