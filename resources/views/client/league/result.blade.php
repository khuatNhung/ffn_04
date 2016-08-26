@extends($clientLayout)
@section('content')
    <div class="row league-navigation">
        <span class="league-navigation-detail">
            <a href="{{ route('leagues.show', ['id' => $result['league']['id']]) }}">
                $result['league']['name'] }}
            </a>
        </span>
        <span class="league-navigation-detail">
            <a href="{{ route('leagues.{id}.ranks.index', ['id' => $result['league']['id']]) }}">
                {{ trans('label.rank') }}
            </a>
        </span>
        <span class="league-navigation-detail">
            <a href="{{ route('leagues.{id}.schedules.index', ['id' => $result['league']['id']]) }}">
                {{ trans('label.schedule') }}
            </a>
        </span>
        <span class="league-navigation-detail">
            <a href="{{ route('leagues.{id}.results.index', ['id' => $result['league']['id']]) }}">
                {{ trans('label.result') }}
            </a>
        </span>
    </div>

    <div class="page-header">
        <h2>{{ trans('label.result') }}</h2>
    </div>
    <div class="col-sm-8 page-content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{ route('leagues.show', ['id' => $result['league']['id']]) }}">
                    <span>{{ $result['league']['name'] }}</span>
                </a>
                <i class="glyphicon glyphicon-chevron-right"></i>
                    <span>{{ $result['season']['name'] }}</span>
                <i class="glyphicon glyphicon-chevron-right"></i>
                <a href="{{ route('leagues.{id}.results.index', ['id' => $result['league']['id']]) }}">
                    <span>{{ trans('label.result') }}</span>
                </a>
            </div>
            <div class='panel-body'>
                <table class="table table-striped table-bordered">
                    @if (!empty($result['matches']))
                        @foreach ($result['matches'] as $key => $matches)
                            <thead>
                                <tr>
                                    <td class="schedule-matches-head" colspan="4">{{ $key }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matches as $match)
                                    <tr>
                                        <td>{{ $match['start_time'] }}</td>
                                        <td class="align-right">{{ $match['team1']['name'] }}</td>
                                        @if (is_null($match['score_team1']))
                                            <td class="align-center">{{ trans('label.vs') }}</td>
                                        @else
                                            <td class="align-center">{{ trans('label.score_two_team', ['score_team1' => $match['score_team1'], 'score_team2' => $match['score_team2']]) }}</td>
                                        @endif
                                        <td>{{ $match['team2']['name'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection
