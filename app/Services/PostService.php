<?php

namespace App\Services;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Validator;

class PostService
{
    protected $postRepository;

    //inject the PostRepository dependency into the constructor of our PostService class
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function savePostData($data)
    {
        $validator = Validator::make($data, [
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:5'
        ]);

        if($validator->fails())
        {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->postRepository->save($data);

        return $result;
    }
}
