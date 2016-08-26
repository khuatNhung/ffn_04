@extends($clientLayout)
@section("content")
    <div class="page-header">
        <h2>{{ trans('label.team_profile') }}</h2>
    </div>
    <div class="col-sm-12">
        <div class="jumbotron row">
            <div class="col-sm-4">
                <img class="img img-responsive" src="{{ asset($team['logo']) }}" alt="{{ $team['name'] }}">
            </div>
            <div class="col-sm-8">
                <h2 class="text-primary">{{ $team['name'] }}</h2>
                <p>{{ $team['description'] }}</p>
            </div>
        </div>
        <div class="players row">
            <h3 class="bg-primary player-title">{{ trans('label.player') }}</h3>
            <div class="player-list">
                @if (!empty($players))
                    @foreach ($players as $player)
                        <a href="{{ route('players.show', ['id' => $player['id']]) }}" class="player-information">
                            <img class="img img-responsive player-img" src="{{ asset($player['image']) }}">
                            <div class="detail">
                                <h4>{{ $player['name'] }}</h4>
                                <div>{{ trans('label.player_role', ['role' => $player['role']]) }}</div>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
