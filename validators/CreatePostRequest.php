<?php

namespace Validators;

use Exception;

class CreatePostRequest {

    /**
     * __construct
     */
	public function __construct()
	{
        if(!isset($_GET['title']) || !isset($_GET['description'])) {
            throw new Exception("Please provide all requred fields : title, description", 422);
        }
        if(strlen($_GET['title']) > 255) {
            throw new Exception("The title can be maximum 255 characters", 422);
        }

        $this->title = $_GET['title'];
        $this->description = $_GET['description'];
	}

    public function all()
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}