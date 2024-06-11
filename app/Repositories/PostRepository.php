<?php

namespace App\Repositories;

use App\Http\Requests\Posts\PostAddFormRequest;
use App\Http\Requests\Posts\PostUpdateFormRequest;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Exception;
use Illuminate\Support\Facades\Log;

class PostRepository implements PostRepositoryInterface
{
    /**
     * get all posts
     */
    public function getAll()
    {
        return Post::all()
        ->sortByDesc('created_at');
    }
    /**
     * Delete a specific post
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        $deleted = Post::where('id', $id)
            ->delete();

        return $deleted
            ? true
            : false;
    }

    /**
     * Store a new post
     * @param PostAddFormRequest $request
     *
     * @return Post|null
     */
    public function store(PostAddFormRequest $request): Post|null
    {
        try {
            $post = new Post();
            $post->fillPost($request);
            $post->save();
            return $post;
        } catch(Exception $e) {
            Log::error($e->getMessage() . $e->getTraceAsString());
            return false;
        }
    }

    /**
     * get a specific post
     * @param int $id
     *
     * @return Post|null
     */
    public function get(int $id): Post|null
    {
        return Post::where('id', $id)->first();
    }


    /**
     * Update specific post
     * @param PostUpdateAddFormRequest $request
     *
     * @return bool
     */
    public function update(PostUpdateFormRequest $request): bool
    {
        try {
            $post = $this->get($request->id);
            $post->fillUser($request);
            return $post->update();
        } catch(Exception $e) {
            Log::error($e->getMessage() . $e->getTraceAsString());
            return false;
        }
    }

}
