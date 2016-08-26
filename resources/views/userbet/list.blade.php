@extends($clientLayout)
@section("content")
<div class="container">
    <table class="table table-bordered" id="dataTables-example">
    @include('common.errors')
    @include('common.flash_message')
        <thead>
            <tr class="list_department">
                <th>{{ trans('bets.match') }}</th>
                <th>{{ trans('bets.team_win') }}</th>
                <th>{{ trans('bets.point') }}</th>
                <th>{{ trans('bets.edit') }}</th>
                <th>{{ trans('bets.delete') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($myBets as $bet)
            <tr>
                <td>
                    <a href="{{ route('matches.show', $bet->match_id) }}">{{ $bet->match->team1->name . ' - ' . $bet->match->team2->name }}
                    </a>
                </td>
                <td>{{ $bet->team->name }}</td>
                <td>{{ $bet->point }}</td>
                <td class="center">
                    {!! Form::open(['method' => 'GET', 'route' => ['matches.{id}.bets.edit', $bet->match_id, $bet->id]]) !!}
                    {{ Form::button(
                        '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> ' . trans('bets.edit'), [
                        'type' => 'submit',
                        'class' => 'btn btn-primary'])
                    }}
                    {!! Form::close() !!}
                </td>
                <td class="center">
                    {!! Form::open(['method' => 'DELETE', 'route' => ['matches.{id}.bets.destroy', $bet->match_id, $bet->id]]) !!}
                    {!! Form::button(
                        '<i class="fa fa-trash-o" aria-hidden="true"></i> ' . trans('bets.delete'), [
                        'type' => 'submit',
                        'class' => 'btn btn-danger',
                        'onclick' => "return confirm('" . trans('bets.request') . "')"
                        ])
                    !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- pagination -->
    <div class="pagination pull-right">
        {!! $myBets->appends(Request::except('page'))->links() !!}
    </div>
</div>
@stop
