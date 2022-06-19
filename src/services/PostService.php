<?php

class PostService
{
    private array $posts = [];

    private static ?PostService $postServiceInstance = null;

    private function __construct()
    {
    }

    /**
     * @return PostService|null
     */
    public static function getPostService(): PostService
    {
        if (!isset(self::$postServiceInstance)) {
            self::$postServiceInstance = new PostService();
        }

        return self::$postServiceInstance;
    }

    public function addPost(User $user, $postData)
    {
        if (array_key_exists($postData['postId'], $this->posts)) {
            echo "cannot add post as post with same id already exist\n";
            return;
        }
        $post = new Post($postData['postName'], $postData['postId'], $postData['description'], $user->getId());
        $this->posts[$postData['postId']] = $post;
    }

    /**
     * @param $userId
     * @return array
     */
    public function getPostsByUserId($userId): array
    {
        return array_filter($this->posts, function (Post $post) use ($userId) {
            return $post->getAddedBy() == $userId;
        });
    }
}