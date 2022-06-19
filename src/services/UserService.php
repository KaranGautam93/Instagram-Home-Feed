<?php

class UserService
{
    private array $users = [];
    private static ?UserService $userServiceInstance = null;

    private function __construct()
    {

    }

    /**
     * @return UserService|null
     */
    public static function getUserService(): UserService
    {
        if (!isset(self::$userServiceInstance)) {
            self::$userServiceInstance = new UserService();
        }
        return self::$userServiceInstance;
    }

    /**
     * @param $userId
     * @param $userDetails
     * @return void
     */
    public function addUser($userId, $userDetails)
    {
        if (array_key_exists($userId, $this->users)) {
            echo "User already exist\n";
            return;
        }

        $user = new User($userId, $userDetails['name']);
        $this->users[$userId] = $user;
    }

    /**
     * @param $userId
     * @return User|void
     */
    public function getUserById($userId)
    {
        if (!array_key_exists($userId, $this->users)) {
            echo "User not found\n";
            return;
        }

        return $this->users[$userId];
    }

    /**
     * @param $userId
     * @param $postData
     * @return void
     */
    public function addPost($userId, $postData)
    {
        $postService = PostService::getPostService();

        $user = $this->getUserById($userId);

        if ($user == null) {
            echo "Cannot add post for user, as user is not found\n";
            return;
        }

        $postService->addPost($user, $postData);
    }

    /**
     * @param $userId
     * @return array
     */
    public function getPostsByUserId($userId): array
    {
        if (!array_key_exists($userId, $this->users)) {
            echo "user with id $userId not found\n";
        }
        $postService = PostService::getPostService();
        return $postService->getPostsByUserId($userId);
    }


    /**
     * @param int $followee
     * @param int $follower
     * @return void
     */
    public function followUser(int $followee, int $follower)
    {
        $followeeUser = $this->getUserById($followee);
        $followerUser = $this->getUserById($follower);

        if (!$followeeUser || !$followerUser) {
            echo "Either follower or followee not exist\n";
            return;
        }

        $followeeUser->addFollower($followerUser);
    }


    /**
     * @param int $userId
     * @return array
     */
    public function getFollowedUsersPosts(int $userId): array
    {
        $followerUser = $this->getUserById($userId);

        if (!$followerUser) {
            echo "User not exist\n";
        }

        $posts = [];
        /**
         * @var User $user
         */
        foreach ($this->users as $user) {
            if ($userId != $user->getId() && in_array($followerUser->getId(), $user->getFollowers())) {
                $posts = array_merge($posts, $this->getPostsByUserId($user->getId()));
            }
        }

        return $posts;
    }

    /**
     * @param int $userId
     * @return array
     */
    public function getHomeFeed(int $userId): array
    {
        return array_merge($this->getPostsByUserId($userId), $this->getFollowedUsersPosts($userId));
    }
}