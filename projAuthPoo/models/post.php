<?php

class Post {
    public $id;
    public $title;
    public $image;
    public $content;
    public $users_id;

    public function generateImageName() {
        return bin2hex(random_bytes(60)) . ".jpg";
    }

}

interface PostDAOInterface{
    public function newPost($data);
    public function getLatestPosts();
    public function getPostByUserId($id);
    public function findById($id);
    public function findByTitle($title);
    public function create(Post $post);
    public function update(Post $post);
    public function destroy($id);
    public function findAllPosts();
}








?>