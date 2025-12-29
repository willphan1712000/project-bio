<?php

namespace business\purchase;

use persistence\EntityManager;
use persistence\Database;
use persistence\Entity\Purchase;
use persistence\Entity\Style;
use persistence\Entity\StyleDefault;
use persistence\Entity\User;

class POST
{
    private string $username;
    private array $templates;

    function __construct(string $username, array $templates)
    {
        $this->username = $username;
        $this->templates = $templates;
    }

    private function addPurchase()
    {
        $entityManager = EntityManager::getEntityManager();

        // Calculate subtotal
        $subtotal = $this->operation->execute();
        // Suppose tax rate
        $rate = 0.06;
        $total = $subtotal * (1 + $rate);

        // Add new purchase
        $purchase = new Purchase();
        $purchase
            ->set('username', $this->username)
            ->set('subtotal', $subtotal)
            ->set('total', $total);

        /** @var User|NULL */
        $user = $entityManager->find(User::class, ['username' => $this->username]);

        // Check if user exists or not
        if ($user === NULL) {
            throw new \Exception("user does not exist");
        }

        // iteratively add each purchased template
        foreach ($this->templates as $template) {
            $style = (new Style())
                ->set('username', $this->username)
                ->set('template_id', $template)
                ->set('font', Database::GET(StyleDefault::class, 'font', ['template_id' => $template]))
                ->set('fontSize', Database::GET(StyleDefault::class, 'fontSize', ['template_id' => $template]))
                ->set('fontColor', Database::GET(StyleDefault::class, 'fontColor', ['template_id' => $template]))
                ->set('background', Database::GET(StyleDefault::class, 'background', ['template_id' => $template]));

            $purchase->setStyle($style);
            $user->setStyle($style);

            /** @var StyleDefault|NULL */
            $styleDefault = $entityManager->find(StyleDefault::class, ['template_id' => $template]);
            $styleDefault->setStyle($style);
        }

        $entityManager->persist($purchase);
        $entityManager->flush();
        return true;
    }

    public function execute()
    {
        return $this->addPurchase();
    }
}
