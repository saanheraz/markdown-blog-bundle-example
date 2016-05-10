<?php

namespace AppBundle\ModelView;

class PostView
{
    /**
     * @var string
     */
    private $authorName;

    /**
     * @var string
     */
    private $authorUrl;

    /**
     * @var string
     */
    private $date;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * @param string $authorName
     * @param string $authorUrl
     * @param string $content
     * @param string $date
     * @param string $title
     */
    public function __construct($authorName, $authorUrl, $content, $date, $title)
    {
        $this->authorName = $authorName;
        $this->authorUrl = $authorUrl;
        $this->content = $content;
        $this->date = $date;
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @return string
     */
    public function getAuthorUrl()
    {
        return $this->authorUrl;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        $title = str_replace('-', ' ', $this->title);

        return $title;
    }
}
