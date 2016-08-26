@extends($clientLayout)
@section("content")
    <div class="container">
        <div class="bet-content">
            <div class="bet-header">
                {{ trans('bets.header') }}
            </div>
            {!! Form::model($userBet, [
                'route' => ['matches.{id}.bets.update', $userBet->match_id, $userBet->id],
                'method' => 'PATCH',
                'class' => 'form-horizontal required'
                ])
            !!}
            @include('layout.error')
            <div class="bet-body">
                <!-- Choose team win -->
                <div class="choose-team">
                    <div class="choose-team-title">
                        {{ trans('bets.title') }}
                    </div>

                    <div class="col-md-5 team-img">
                        <div class="img">
                            <img class="img img-thumbnail img-row img-team" src="{{ asset($match->team1['logo']) }}">
                        </div>
                        <div class="radio">
                            {{ Form::radio('team_id', $match->team1['id']) }}
                            {{ Form::label('team_id', $match->team1['name'])}}
                        </div>
                    </div>

                    <div class="col-md-2 text">
                        {{ trans('bets.vs') }}
                    </div>

                    <div class="col-md-5">
                        <div class="img">
                            <img class="img img-thumbnail img-row img-team" src="{{ asset($match->team2['logo']) }}">
                        </div>
                       <div class="radio">
                            {{ Form::radio('team_id', $match->team2['id']) }}
                            {{ Form::label('team_id', $match->team2['name'] )}}
                        </div>
                    </div>
                </div>
                <!-- Point -->
                <div class="col-md-6 point">
                    {{ Form::label('point', trans('bets.point')) }}
                    {!! Form::text('point', null, ['class' => 'form-control', 'placeholder' => trans('bets.enter_point')]) !!}
                </div>

            </div>
            <div class="bet-footer">
                {{ Form::button('<i class="fa fa-plus-circle"></i> ' . trans('bets.bet'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
            </div>
        </div>
    </div>
@endsection
