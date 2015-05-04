<?php

namespace Site\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{
    public function indexAction()
    {
    	$em = $this -> get ('doctrine') ->getManager();
    	$news = $em -> getRepository('SiteNewsBundle:News') -> findAll();
    	//var_dump($news);
        return $this->render('SiteNewsBundle:News:news.html.twig', array('news' => $news));
    }

     public function articleAction($slug)
    {
        $em = $this->get('doctrine')->getManager();
        $article = $em->getRepository('SiteNewsBundle:News') -> findOneBy(['slug' => $slug]);
        //var_dump($article);
        if (is_null($article) || empty($article)) {
            throw $this->createNotFoundException('Запрашиваемая страница перемещена или удалена!');
        } else {
            return $this->render('SiteNewsBundle:News:article.html.twig', ['article' => $article]); 
        }
    }
    public function categoryAction($slug)
    {
    	$em = $this -> get ('doctrine') ->getManager();
    	$category = $em -> getRepository('SiteNewsBundle:Category') -> findOneBy(['slug' => $slug]);
    	//var_dump($news);
        return $this->render('SiteNewsBundle:News:category.html.twig', array('category' => $category));
    }
    
     public function tagAction($slug)
    {
    	$em = $this -> get ('doctrine') ->getManager();
    	$tag = $em -> getRepository('SiteNewsBundle:Tag') -> findOneBy(['slug' => $slug]);
    	//var_dump($news);
        return $this->render('SiteNewsBundle:News:tag.html.twig', array('tag' => $tag));
    }
}