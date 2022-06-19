<?php

class Post
{
    private string $postName;
    private string $postId;
    private string $postData;
    private int $addedBy;

    public function __construct(string $postName, string $postId, string $postData, string $addedBy)
    {
        $this->postName = $postName;
        $this->postId = $postId;
        $this->postData = $postData;
        $this->addedBy = $addedBy;
    }

    /**
     * @return string
     */
    public function getPostName(): string
    {
        return $this->postName;
    }

    /**
     * @return string
     */
    public function getPostId(): string
    {
        return $this->postId;
    }

    /**
     * @return string
     */
    public function getPostData(): string
    {
        return $this->postData;
    }

    /**
     * @return int|string
     */
    public function getAddedBy()
    {
        return $this->addedBy;
    }

    public function printPost()
    {
        echo $this->getPostId()." - ". $this->getPostName()."\n";
        echo $this->getPostData()."\n-------------------------------------------------\n";
    }

}