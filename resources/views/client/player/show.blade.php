@extends($clientLayout)
@section("content")
    <div class="page-header">
        <h2>{{ trans('label.player_profile') }}</h2>
    </div>
    <div class="col-sm-8">
        <div class="row">
            <div class="col-sm-4">
                <img class="img img-responsive player-image" src="{{ asset($player['image']) }}" alt="{{ $player['name'] }}">
            </div>
            <div class="col-sm-8">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <td><strong>{{ trans('label.name') }}</strong></td>
                        <td>{{ $player['name'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>{{ trans('label.team') }}</strong></td>
                        <td>{{ $player['team']['name'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>{{ trans('label.role') }}</strong></td>
                        <td>{{ $player['role'] }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
