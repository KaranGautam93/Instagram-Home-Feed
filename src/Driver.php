<?php

require_once 'models/Post.php';
require_once 'models/User.php';
require_once 'services/PostService.php';
require_once 'services/UserService.php';

class Driver
{
    public function __construct()
    {
        $this->startApp();
    }

    private function startApp()
    {
        $userService = UserService::getUserService();

        $userService->addUser(1, ['name' => 'User 1']);
        $userService->addUser(2, ['name' => 'User 2']);
        $userService->addUser(3, ['name' => 'Karan']);

        // 2 <- 1, 2 <- 3
        $userService->followUser(2, 1);
        $userService->followUser(2, 3);
        $userService->followUser(2, 2);

        $userService->addPost(1, [
            'postName' => 'user 1 first post',
            'postId' => 1,
            'description' => 'My first post'
        ]);

        $userService->addPost(1, [
            'postName' => 'user 1 second post',
            'postId' => 2,
            'description' => 'My second post'
        ]);

        $userService->addPost(2, [
            'postName' => 'user 2 first post',
            'postId' => 3,
            'description' => 'My first post'
        ]);

        $userService->addPost(3, [
            'postName' => 'user 3 first post',
            'postId' => 4,
            'description' => 'My first post'
        ]);

        $userService->addPost(2, [
            'postName' => 'User 2 second post',
            'postId' => 5,
            'description' => 'Good to have other thoughts as well'
        ]);

        echo "-------------- Home feed ---------------\n";
        $userFeed = $userService->getHomeFeed(3);

        /**
         * @var Post $post
         */
        foreach ($userFeed as $post) {
            $post->printPost();
        }
    }
}

new Driver();