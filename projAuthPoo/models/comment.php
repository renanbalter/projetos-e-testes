<?php

class Comment {
    public $id;
    public $content;
    public $users_id;
    public $posts_id;



}

interface CommentDAOInterface {
    
    public function newComment($data);
    public function create($data);
    public function FindPostComments($posts_id);
}