<?php

namespace Kwejk\MemsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MemsController extends Controller
{
    public function listAction($page)
    {
        $mems = $this->getDoctrine()
                ->getRepository('KwejkMemsBundle:Mem')
                ->findBy([
                    'isAccepted' => true,
                ]);
        $paginator  = $this->get('knp_paginator');
        $pages = $paginator->paginate(
            $mems, 
            $page,
            5
        );
        
        return $this->render('KwejkMemsBundle:Mems:list.html.twig', array(
                'mems' => $mems,
                'pages' => $pages,
            ));    }

    public function showAction($slug)
    {
        $mem = $this->getDoctrine()
                ->getRepository('KwejkMemsBundle:Mem')
                ->findOneBy([
                    'slug' => $slug,
                ]);
        if (!$mem) 
        {
            throw $this->createNotFoundException('Mem nie istnieje');
            
        }
        
        
        return $this->render('KwejkMemsBundle:Mems:show.html.twig', array(
                'mem' => $mem,
                
            ));    
        
        }

}
