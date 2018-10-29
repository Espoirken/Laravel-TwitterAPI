<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyTweetz</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <div class="navbar-header">
                <a href="/" class="navbar-brand">My Tweetz</a>
            </div>
        </div>
    </nav>
    <div class="container">
        <form class="card" action="{{route('post.tweet')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                @endforeach
            @endif

            <div class="form-group">
                <label for="tweet">Tweet Text</label>
                <input type="text" name="tweet" class="form-control">
            </div>
            <div class="form-group">
                <label for="images">Upload Images</label>
                <input type="file" name="images[]" multiple class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-success">Create Tweet</button>
            </div>
        </form>
        @if (!empty($data))
            @foreach ($data as $key => $tweet)
                <div class="card">
                <h3>{{$tweet['text']}}
                <i class="glyphicon glyphicon-heart">{{$tweet['favorite_count']}}</i>
                <i class="glyphicon glyphicon-repeat">{{$tweet['retweet_count']}}</i>
                </h3>
                @if (!empty($tweet['extended_entities']['media']))
                    @foreach (($tweet['extended_entities']['media']) as $i)
                        <img src="{{$i['media_url_https']}}" style="width=100px">
                    @endforeach
                @endif
                </div>
            @endforeach
        @else
            <p>No Tweets Found</p>
        @endif
    </div>
</body>
</html>