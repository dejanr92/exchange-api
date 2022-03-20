<?php

namespace Validators;

use Exception;

class CreatePostRequest {

    /**
     * __construct
     */
	public function __construct()
	{
        if(!isset($_POST['title']) || !isset($_POST['description'])) {
            throw new Exception("Please provide all requred fields : title, description", 422);
        }
        if(strlen($_POST['title']) > 255) {
            throw new Exception("The title can be maximum 255 characters", 422);
        }

        $this->title = $_POST['title'];
        $this->description = $_POST['description'];
	}

    public function all()
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}