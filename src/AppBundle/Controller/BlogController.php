<?php

namespace AppBundle\Controller;

use AppBundle\ModelView\IndexViewFactory;
use Matks\MarkdownBlogBundle\Blog\Library;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $bag = $request->query;

        $offset = $bag->get('o', 0);
        $limit = $bag->get('l', 3);

        $library = $this->getLibrary();
        $allPosts = $library->getAllPosts();

        $indexView = IndexViewFactory::buildIndexView(
            $allPosts,
            $offset,
            $limit
        );

        return $this->render(
            'default/index.html.twig',
            [
                'index'          => $indexView,
                'offset'         => $offset,
                'nextOffset'     => $offset + 3,
                'previousOffset' => (($offset - 3) > 0) ? ($offset - 3) : 0,
            ]
        );
    }

    /**
     * @return Library
     */
    private function getLibrary()
    {
        return $this->get('markdown_blog.library');
    }
}
