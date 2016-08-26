@extends($clientLayout)
@section('content')
    <div class="col-sm-8">
        <div class="schedule">
            <div class="schedule-title">{{ $match['name'] }}</div>
            <div class="score-avatar">
                <div class="team">
                    <img class="logo" alt="{{ $match['team1']['name'] }}"
                         src="{{ asset($match['team1']['logo']) }}">
                    <div class="team-name">{{ $match['team1']['name'] }}</div>
                </div>
                <div class="score">
                    <div class="team-score">{{ $match['score_team1'] or 0 }}</div>
                    <div class="vs">{{ trans('label.vs') }}</div>
                    <div class="team-score">{{ $match['score_team2'] or 0 }}</div>
                </div>
                <div class="team">
                    <img class="logo" alt="{{ $match['team2']['name'] }}"
                         src="{{ asset($match['team2']['logo']) }}">
                    <div class="team-name">{{ $match['team2']['name'] }}</div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div
        class="col-sm-8"
        id="match-events"
        data-url="{{ route('matches.match-events', ['id' => $match['id']]) }}"
        data-match-id="{{ $match['id'] }}"
        data-icon="{{ asset(config('common.blank_icon')) }}"
    >
    </div>
@endsection
@section('script')
    {!! Html::script('/bower/jqueryui-timepicker-addon/dist/jquery-ui-timepicker-addon.min.js') !!}
    {!! Html::script('/bower/browser-js/browser.min.js') !!}
    {!! Html::script('/bower/react/react.min.js') !!}
    {!! Html::script('/bower/react/react-dom.min.js') !!}
    {!! Html::script('/bower/react/react-dom-server.min.js') !!}
    {!! Html::script('/bower/react/react-with-addons.min.js') !!}
    {!! Html::script('/js/match_show.js', ['type' => 'text/babel']) !!}
@endsection
