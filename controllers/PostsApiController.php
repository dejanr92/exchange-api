<?php

namespace Controllers;

use Exception;
use Traits\RenderableTrait;
use Repositories\BlogRepository;
use Validators\CreatePostRequest;
use Validators\PaginationRequest;

class PostsApiController {

    use RenderableTrait;

    /**
     * index
     *
     * @return void
     */
    public static function index()
    {
        try {
            $exchangeRequest = new PaginationRequest();
            $requestData = $exchangeRequest->all();
        } catch(Exception $e) {
            return self::renderError($e->getMessage(), $e->getCode());
        }
        
        $blogRepository = new BlogRepository();
        $data = $blogRepository->getAllPosts($requestData ['offset'], $requestData['limit']);
        
    
        return self::renderSuccess($data);

    }

    public static function create()
    {
        try {
            $createRequest = new CreatePostRequest();
            $requestData = $createRequest->all();
        } catch(Exception $e) {
            return self::renderError($e->getMessage(), $e->getCode());
        }
        
        $blogRepository = new BlogRepository();
        $data = $blogRepository->createPost($requestData);

        return self::redirectToPage('/posts');


    }

    public static function show()
    {
        $postId = (int) $_GET['id'];
        $blogRepository = new BlogRepository();
        $data = $blogRepository->getPostById($postId);

        return self::renderSuccess($data);

    }

    public static function edit($id)
    {
        $blogRepository = new BlogRepository();
        $data = $blogRepository->getPostById($id);

        return self::renderSuccess($data);
    }

}