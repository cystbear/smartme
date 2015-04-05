<?php

namespace Jack\DeckKeeperBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Jack\DeckKeeperBundle\Entity\Card;
use Jack\DeckKeeperBundle\Form\CardType;

use Jack\DeckKeeperBundle\AddCardEvent;

class CardController extends Controller
{
    public function indexAction()
    {
        $cards = $this
            ->getDoctrine()
            ->getRepository('JackDeckKeeperBundle:Card')
            ->findAll()
        ;

        return $this->render('JackDeckKeeperBundle:Card:index.html.twig', array(
            'cards' => $cards,
        ));
    }

    /**
     * @ParamConverter("card", class="JackDeckKeeperBundle:Card")
     */
    public function cardAction(Card $card)
    {
        return $this->render('JackDeckKeeperBundle:Card:card.html.twig', array(
            'card' => $card,
        ));
    }

    public function newAction(Request $request)
    {
        $form = $this->createForm(new CardType());

        $form->handleRequest($request);
        if ($form->isValid()) {
            $card = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($card);

            if ($imageFile = $card->getImageFile()) {
                $uploadableManager = $this->get('stof_doctrine_extensions.uploadable.manager');
                $uploadableManager->markEntityToUpload($card, $imageFile);
            }

            $em->flush();

            $eventDispatcher = $this->get('event_dispatcher');
            $addCardEvent = new AddCardEvent($card, $card->getCardSet());

            $eventDispatcher->dispatch(AddCardEvent::ADD_CARD_EVENT, $addCardEvent);
            $em->flush();

            return $this->redirect($this->generateUrl('frontend_deck_keeper_index'));
        }

        return $this->render('JackDeckKeeperBundle:Card:new.html.twig', array(
            'form' => $form->createView()
        ));

    }
}
