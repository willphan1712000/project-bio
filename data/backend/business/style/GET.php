<?php

namespace business\style;

use business\IAPI;
use persistence\Database;
use persistence\Entity\Style;
use persistence\Entity\User;
use persistence\EntityManager;

class GET implements IAPI
{
    protected string $username;
    protected ?int $template;

    function __construct(string $username, ?int $template = null)
    {
        $this->username = $username;
        $this->template = $template;
    }

    private function getStyle()
    {
        try {
            if ($this->template === null) {
                $this->template = Database::GET(User::class, 'defaultTemplate', ['username' => $this->username]);
            }

            $entityManager = EntityManager::getEntityManager();

            $styles = $entityManager->getRepository(Style::class)->findBy([
                'username' => $this->username,
                'template_id' => $this->template
            ]);

            $out = [];
            foreach ($styles as $style) {
                array_push($out, [
                    "element" => $style->get("element"),
                    "font" => $style->get("font"),
                    "fontSize" => $style->get("fontSize"),
                    "fontColor" => $style->get("fontColor")
                ]);
            }

            return [
                'success' => true,
                'data' => $out
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function execute()
    {
        return $this->getStyle();
    }
}
