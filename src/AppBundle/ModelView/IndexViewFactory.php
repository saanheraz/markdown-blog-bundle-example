<?php

namespace AppBundle\ModelView;

use Matks\MarkdownBlogBundle\Blog\Post;

class IndexViewFactory
{
    /**
     * @param Post[] $posts
     * @param int    $offset
     * @param int    $quantity
     *
     * @return IndexView
     */
    public static function buildIndexView(array $posts, $offset = 0, $quantity = 3)
    {
        $sortedPosts = self::sortPostsByDescendingDates($posts);
        $paginatedPosts = array_slice($sortedPosts, $offset, $quantity);

        $postByMonths = [];

        foreach ($paginatedPosts as $post) {
            $month = self::extractMonth($post);
            $postView = self::buildPostView($post);

            if (isset($postByMonths[$month])) {
                $postByMonths[$month][] = $postView;
            } else {
                $postByMonths[$month] = [$postView];
            }
        }

        $sortedPostByMonths = self::sortMonthByDescendingDates($postByMonths);

        $indexView = new IndexView($sortedPostByMonths);

        return $indexView;
    }

    /**
     * @param Post $post
     *
     * @return PostView
     */
    public static function buildPostView(Post $post)
    {
        $authorName = 'Mathieu';
        $authorUrl = 'https://twitter.com/mathieuKs';

        $view = new PostView(
            $authorName,
            $authorUrl,
            $post->getHtml(),
            $post->getPublishDate(),
            $post->getName()
        );

        return $view;
    }

    /**
     * @param Post $post
     *
     * @return string
     */
    private static function extractMonth(Post $post)
    {
        $date = $post->getPublishDate();

        return substr($date, 0, 7);
    }

    /**
     * @param Post[] $post
     *
     * @return array
     */
    private static function sortPostsByDescendingDates(array $posts)
    {
        usort($posts, function (Post $post1, Post $post2) {
            $date1 = self::getPostDateAsDateTime($post1);
            $date2 = self::getPostDateAsDateTime($post2);

            if ($date1 === $date2) {
                return 0;
            }

            return ($date1 < $date2) ? 1 : -1;
        });

        return $posts;
    }

    /**
     * @param array $sortedPosts
     *
     * @return array
     */
    private static function sortMonthByDescendingDates(array $sortedPosts)
    {
        uksort($sortedPosts, function ($month1, $month2) {
            $monthDate1 = new \DateTime($month1 . '-01');
            $monthDate2 = new \DateTime($month2 . '-01');

            if ($monthDate1 === $monthDate2) {
                return 0;
            }

            return ($monthDate1 < $monthDate2) ? 1 : -1;
        });

        return $sortedPosts;
    }

    /**
     * @param Post $post
     *
     * @return \DateTime
     */
    private static function getPostDateAsDateTime(Post $post)
    {
        $dateTime = new \DateTime($post->getPublishDate());
        $dateTime->setTime(0, 0, 0);

        return $dateTime;
    }
}

