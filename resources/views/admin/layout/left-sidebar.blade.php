<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title">
            <a href="{{ route('admin.index') }}" class="site_title">
                <i class="fa fa-newspaper-o"></i>
                <span>{{ trans('label.football_news') }}</span>
            </a>
        </div>
        <div class="clearfix"></div>
        <!-- menu profile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="{{ url(Auth::user()->avatar) }}" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>{{ trans('label.welcome') }}</span>
                <h2>{{ Auth::user()->name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        <br />
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>{{ trans('label.general') }}</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-soccer-ball-o"></i>{{ trans('label.league') }}<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('admin.leagues.index') }}">{{ trans('label.league') }}</a></li>
                            <li><a href="{{ route('admin.seasons.index') }}">{{ trans('label.season') }}</a></li>
                            <li><a href="{{ route('admin.ranks.index') }}">{{ trans('label.rank') }}</a></li>
                            <li><a href="{{ route('admin.matches.index') }}">{{ trans('label.match') }}</a></li>
                            <li><a href="{{ route('admin.match-events.index') }}">{{ trans('label.match_event') }}</a></li>
                            <li><a href="{{ route('admin.teams.index') }}">{{ trans('label.team') }}</a></li>
                            <li><a href="{{ route('admin.players.index') }}">{{ trans('label.player') }}</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-user"></i>{{ trans('label.user') }}<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('admin.users.index') }}">{{ trans('label.user') }}</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-comments"></i>{{ trans('label.post') }}<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('admin.posts.index') }}">{{ trans('label.post') }}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>{{ trans('label.other') }}</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="{{ route('home') }}">
                            <i class="fa fa-laptop"></i>
                            {{ trans('label.landing_page') }}
                            <span class="label label-success pull-right">
                                {{ trans('label.check_now') }}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
