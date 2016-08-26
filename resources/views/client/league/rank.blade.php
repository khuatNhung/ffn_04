@extends($clientLayout)
@section('content')
    <div class="row league-navigation">
        <span class="league-navigation-detail">
            <a href="{{ route('leagues.show', ['id' => $rank['league']['id']]) }}">
                {{ $rank['league']['name'] }}
            </a>
        </span>
        <span class="league-navigation-detail">
            <a href="{{ route('leagues.{id}.ranks.index', ['id' => $rank['league']['id']]) }}">
                {{ trans('label.rank') }}
            </a>
        </span>
        <span class="league-navigation-detail">
            <a href="{{ route('leagues.{id}.schedules.index', ['id' => $rank['league']['id']]) }}">
                {{ trans('label.schedule') }}
            </a>
        </span>
        <span class="league-navigation-detail">
            <a href="{{ route('leagues.{id}.results.index', ['id' => $rank['league']['id']]) }}">
                {{ trans('label.result') }}
            </a>
        </span>
    </div>
    <div class="page-header">
        <h2>{{ trans('label.rank_table') }}</h2>
    </div>
    <div class="col-sm-8 page-content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{ route('leagues.show', ['id' => $rank['league']['id']]) }}">
                    <span>{{ $rank['league']['name'] }}</span>
                </a>
                <i class="glyphicon glyphicon-chevron-right"></i>
                    <span>{{ $rank['season']['name'] }}</span>
                <i class="glyphicon glyphicon-chevron-right"></i>
                <a href="{{ route('leagues.{id}.ranks.index', ['id' => $rank['league']['id']]) }}">
                    <span>{{ trans('label.rank_table') }}</span>
                </a>
            </div>
            <div class='panel-body'>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>{{ trans('label.no') }}</td>
                            <td>{{ trans('label.team') }}</td>
                            <td>{{ trans('label.point') }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($rank['teams']))
                            @foreach ($rank['teams'] as $key => $team)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $team['team'] }}</td>
                                    <td>{{ $team['score'] }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
