<?php

namespace App\Repositories\Post;

use App\Models\Post;
use Auth;
use Request;
use App\Repositories\Post\PostRepositoryInterface;
use Carbon\Carbon;
use App\Repositories\User\UserRepository;
use File;
use DB;
use Exception;

class PostRepository implements PostRepositoryInterface
{
    protected $model;

    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    public function index()
    {
        return $this->model->isPosted()->latest('published_at')
            ->published()
            ->orderBy('published_at', 'desc')
            ->paginate(config('news.posts_per_page'));
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findBy($slug)
    {
        $post = $this->model->whereSlug($slug)->firstOrFail();

        if (!$post) {
            return ['error' => trans('message.item_not_exist')];
        }

        return $post;
    }

    public function latestPosts()
    {
        return $this->model->isPosted()->latest('published_at')->published()->take(config('news.latest_posts'))->get();
    }

    public function createOrUpdate($request, $id = null)
    {
        $post = $this->model->findOrNew($id);
        $post->user_id = $request->user_id;
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->league_id = $request->league_id;
        $post->content = $request->content;
        $post->is_post = $request->is_post;
        $post->published_at = ($request->is_post == config('common.post.un_published')) ? $request->published_at : Carbon::now();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = str_slug($post->title) . '-' . $image->getClientOriginalName();
            $request->file('image')->move(public_path(config('news.posts_image_path')), $filename);
            $post->image = config('news.posts_image_path') . $filename;
        } else {
            if (Request::isMethod('post')) {
                $post->image = config('news.posts_image_default');
            }
        }

        return $post->save();
    }

    public function lists()
    {
        $limit = isset($options['limit']) ? $options['limit'] : config('common.limit.page_limit');
        $order = isset($options['order']) ? $options['order'] : ['key' => 'id', 'aspect' => 'DESC'];
        $filter = isset($options['filter']) ? $options['filter'] : [];

        try {
            $posts = $this->model->where($filter)->orderBy($order['key'], $order['aspect'])->paginate($limit);
            return $posts;
        } catch (Exception $ex) {
            return ['error' => $ex->getMessage()];
        }
    }

    public function destroy($ids)
    {
        try {
            $image = $this->model->whereIn('id', $ids)->lists('image');
            $this->deleteImage($image);
            DB::beginTransaction();
            $data = $this->model->destroy($ids);
            if (!$data) {
                return ['error' => trans('message.deleting_error')];
            }
            DB::commit();

            return $data;
        } catch (Exception $e) {
            DB::rollBack();

            return ['error' => $e->getMessage()];
        }
    }

    public function deleteImage($pathImage = [])
    {
        if (!empty($pathImage) && file_exists($pathImage)) {
            File::delete($pathImage);
        }
    }

    public function findPost($id)
    {
        try {
            $post = $this->model->findOrFail($id);

            if (!$post) {
                return ['error' => trans('message.item_not_exist')];
            }

            return $post;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function taskSchedule()
    {
        $posts = $this->model->unPost()->get();

        foreach ($posts as $post) {
            $diffTime = Carbon::now()->diffInMinutes(Carbon::instance($post->published_at));

            if ($diffTime < config('common.post.limit')) {
                $post = $this->model->find($post->id);
                $post->is_post = config('common.post.is_published');
                $post->save();
            }
        }
    }

    public function optionPost()
    {
        $option = [
            config('common.post.is_published') => trans('label.is_post'),
            config('common.post.un_published') => trans('label.not_post'),
        ];

        return $option;
    }

    public function getRecentPosts()
    {
        try {
            $posts = $this->model->with('user')->isPosted()->latest('published_at')->published()->take(config('news.latest_posts'))->get();

            foreach ($posts as $key => $post) {
                $posts[$key]['time_ago'] = $post['published_at']->diffForHumans();
            }

            return $posts;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function leaguePosts($leagueId)
    {
        try {
            $posts = $this->model->isPosted()->latest('published_at')
                ->where('league_id', $leagueId)
                ->published()
                ->orderBy('published_at', 'desc')
                ->paginate(config('news.posts_per_page'));

            foreach ($posts as $key => $post) {
                $posts[$key]['time_ago'] = $post['published_at']->diffForHumans();
            }

            return $posts;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
