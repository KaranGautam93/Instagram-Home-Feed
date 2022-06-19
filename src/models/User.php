<?php

class User
{
    private int $id;
    private string $name;
    private array $followers = [];

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getFollowers(): array
    {
        return $this->followers;
    }

    /**
     * @param User $follower
     * @return void
     */
    public function addFollower(User $follower): void
    {
        $this->followers[$follower->getId()] = true;
    }
}