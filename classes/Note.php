<?php

class Note 
{
    public $id;
    public $title;
    public $content;
    public $create_at;
    public $updated_at;

    public function __construct($id, $title, $content, $create_at = null, $updated_at = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->create_at = $create_at;
        $this->updated_at = $updated_at;
    }

}