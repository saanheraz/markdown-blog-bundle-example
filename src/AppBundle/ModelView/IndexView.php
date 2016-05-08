<?php

namespace AppBundle\ModelView;

use Matks\MarkdownBlogBundle\Blog\Post;

class IndexView
{
    /**
     * @var array
     */
    private $posts;

    /**
     * @param Post[] $posts
     */
    public function __construct(array $posts)
    {
        $this->posts = $posts;
    }

    /**
     * @return string[]
     */
    public function getPostsGroupedByMonths()
    {
        return $this->posts;
    }
}
