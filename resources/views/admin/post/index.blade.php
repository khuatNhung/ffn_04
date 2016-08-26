@extends($layout)
@section("content")
    <div class="grid">
        <div class="page-header">
            <h2>{{ trans('label.manage_subject', ['subject' => 'posts']) }}</h2>
            <button id="btn-create" type="button"
                    class="btn btn-default btn-lg btn-header"
                    data-manage="{{ route('admin.posts.index') }}"
                    data-url="{{ route('admin.posts.create') }}">
                {{ trans('label.create') }}
            </button>
            <button id="btn-delete-user" type="button"
                    class="btn btn-default btn-lg btn-header"
                    data-manage="{{ route('admin.posts.index') }}"
                    data-url="{{ route('admin.posts.destroy', ['id' => 1]) }}"
                    data-alert="{{ trans('message.delete_these_items') }}"
                    data-check="{{ trans('message.choose_item_before_deleting') }}"
                    data-success="{{ trans('message.delete_successfully') }}">
                {{ trans('label.delete') }}
            </button>
        </div>
        <div class="page-content">
            @include('common.errors')
            @include('common.flash_message')
            <table class="table table-bordered table-striped table-responsive table-grid" id="users">
                <thead>
                    <tr>
                        <th><span class="select-all">{{ trans('label.all') }}</span></th>
                        <th>{{ trans('label.no') }}</th>
                        <th>{{ trans('label.username') }}</th>
                        <th>{{ trans('label.category') }}</th>
                        <th>{{ trans('label.league') }}</th>
                        <th>{{ trans('label.image') }}</th>
                        <th>{{ trans('label.title') }}</th>
                        <th>{{ trans('label.is_post') }}</th>
                        <th title="edit">{{ trans('label.edit') }}</th>
                        <th title="show">{{ trans('label.show') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $key => $post)
                        <tr id = 'row-{{ $post->id }}'>
                            <td>
                                {!! Form::checkbox('select', $post->id, false, ['class' => 'select']) !!}
                            </td>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <a href="{{ route('admin.users.show', ['id' => $post->user_id]) }}" >
                                    {{ $post->user['name'] }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.posts.show', ['id' => $post->id]) }}" >
                                    {{ $post->category['name'] }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.leagues.show', ['id' => $post->league_id]) }}">
                                    {{ $post->league['name'] }}
                                </a>
                            </td>
                            <td>
                                <img src="{{ url(isset($post['image']) ? $post['image'] : config('news.posts_image_default')) }}" class="img img-thumbnail img-row">
                            </td>
                            <td>
                                <a href="{{ route('admin.posts.show', ['id' => $post->id]) }}">
                                    {{ $post->title }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.posts.show', ['id' => $post->id]) }}">
                                    {{ $optionPost[$post->is_post] }}
                                </a>
                            </td>
                            <td>
                                @can('updatePost', $post)
                                    <a href="{{ route('admin.posts.edit', ['id' => $post->id]) }}" title="edit">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                @endcan
                            </td>
                            <td>
                                <a href="{{ route('admin.posts.show', ['id' => $post->id]) }}" title="show">
                                    <i class="glyphicon glyphicon-arrow-right"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $posts->render() !!}
        </div>
    </div>
@endsection
