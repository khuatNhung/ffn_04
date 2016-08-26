@if (!empty($league))
    <div class="row league-navigation">
    <span class="league-navigation-detail">
        <a href="{{ route('leagues.show', ['id' => $league['id']]) }}">
            {{ $league['name'] }}
        </a>
    </span>
        <span class="league-navigation-detail">
        <a href="{{ route('leagues.{id}.ranks.index', ['id' => $league['id']]) }}">
            {{ trans('label.rank') }}
        </a>
    </span>
        <span class="league-navigation-detail">
        <a href="{{ route('leagues.{id}.schedules.index', ['id' => $league['id']]) }}">
            {{ trans('label.schedule') }}
        </a>
    </span>
        <span class="league-navigation-detail">
        <a href="{{ route('leagues.{id}.results.index', ['id' => $league['id']]) }}">
            {{ trans('label.result') }}
        </a>
    </span>
    </div>
@endif
