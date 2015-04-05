<?php

namespace Jack\DeckKeeperBundle;

use Jack\DeckKeeperBundle\AddCardEvent;

class CardsCountListener
{
    public function onCardCreated(AddCardEvent $event)
    {
        $card = $event->getCard();
        $set = $event->getCardSet();

        $set->incrementCardsCount();
    }

    public static function getSubscribedEvents()
    {
        return array(
            AddCardEvent::ADD_CARD_EVENT => 'onCardCreated',
        );
    }

}
