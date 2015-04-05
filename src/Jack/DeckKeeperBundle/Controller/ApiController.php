<?php

namespace Jack\DeckKeeperBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations\View as RestView;

class ApiController extends FOSRestController
{
    /**
     * @RestView
     */
    public function getCardsAction()
    {
        $cards = $this
            ->getDoctrine()
            ->getRepository('Jack\DeckKeeperBundle\Entity\Card')
            ->findAll()
        ;

        return View::create($cards);
    }

    /**
     * @RestView
     */
    public function getCardAction($id)
    {
        $card = $this
            ->getDoctrine()
            ->getRepository('Jack\DeckKeeperBundle\Entity\Card')
            ->find($id)
        ;

        return View::create($card);
    }

    /**
     * @RestView
     */
    public function getSetsAction()
    {
        $sets = $this
            ->getDoctrine()
            ->getRepository('Jack\DeckKeeperBundle\Entity\CardSet')
            ->findAll()
        ;

        return View::create($sets);
    }

    /**
     * @RestView
     */
    public function getSetAction($id)
    {
        $set = $this
            ->getDoctrine()
            ->getRepository('Jack\DeckKeeperBundle\Entity\CardSet')
            ->find($id)
        ;

        return View::create($set);
    }
}
