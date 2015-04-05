<?php

namespace Jack\DeckKeeperBundle;

use Symfony\Component\EventDispatcher\Event;

use Jack\DeckKeeperBundle\Entity\Card;
use Jack\DeckKeeperBundle\Entity\CardSet;

class AddCardEvent extends Event
{
    const ADD_CARD_EVENT = 'add_card_event';

    protected $card;
    protected $cardSet;

    public function __construct(Card $card, CardSet $cardSet)
    {
        $this->card = $card;
        $this->cardSet = $cardSet;
    }

    public function getCard()
    {
        return $this->card;
    }

    public function getCardSet()
    {
        return $this->cardSet;
    }

}
