<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\PostAddFormRequest;
use App\Http\Requests\Posts\PostDeleteFormRequest;
use App\Http\Requests\Posts\PostEditFormRequest;
use App\Http\Requests\Posts\PostUpdateFormRequest;
use App\Http\Resources\PostsResource;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class PostController extends Controller
{   
    /**
     * get all posts
     */
    public function index(PostRepository $postRepository)
    {
        $posts = $postRepository->getAll();
        return JsonResource::collection($posts);
    }

    public function add()
    {
        return view('pages.post.form');
    }


      /**
     * Remove the specified post.
     */
    public function delete(PostDeleteFormRequest $request, PostRepository $postRepository)
    {
        $deleted = $postRepository->delete($request->id);
        $collection = collect([
            'success' => $deleted
        ]);
        return new JsonResource($collection);
    }

    /**
     * Store a new created post.
     */
    public function store(PostAddFormRequest $request, PostRepository $postRepository)
    {
        $saved = $postRepository->store($request);
        return new PostsResource(['saved' => $saved]);
    }


   /**
     * Open view to edit a specific User 
     * 
     * @return View
     */
    public function edit(PostEditFormRequest $request,  PostRepository $postRepository)
    {
        $post = $postRepository->get($request->id);
        return view('pages.user.form', compact('post'));
    }

    /**
     * Update the specified post.
     */
    public function update(PostUpdateFormRequest $request, PostRepository $postRepository)
    {
        $updated = $postRepository->update($request);
        return new PostsResource(['saved' => $updated]);
    }

  
}
