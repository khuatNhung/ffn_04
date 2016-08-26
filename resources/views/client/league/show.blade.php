@extends($clientLayout)

@section('content')
<div class="container">
    @include('client.league.league-navigation')
    <div class="row">
        <div class="col-md-7">
            @if (count($posts))N
                @foreach ($posts as $post)
                    <div class="news-border row">
                        <div class="single-post col-md-4">
                            <div class="hover-effect">
                                <img class="img-responsive" src="{{ $post->imageLink() }}">
                                <div class="overlay">
                                    <p>
                                        <a href="{{ $post->link() }}">{{ trans('news.read_more') }}</a>
                                    </p>
                                </div>
                            </div>
                            <div class="post-content">
                                <ul class="post-tools list-inline">
                                    <li><i class="fa fa-clock-o"></i> {{ $post->published_at->format('M jS Y g:ia') }}</li>
                                    <li><i class="fa fa-user"></i> {{ $post->user->name }}</li>
                                    <li>
                                        <a href="{{ route('leagues.show', [$post->league_id]) }}">
                                            <i class="glyphicon glyphicon-globe"></i> {{ $post->league->name }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <a href="{{ $post->link() }}">
                                <h3>{{ $post->title }}</h3>
                            </a>
                            <div class="news-post-content">
                                {!! $post->content !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            {{ $posts->render() }}
        </div>
    </div>
</div>
@endsection
