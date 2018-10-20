<?php

namespace AppBundle\Model;

use AppBundle\Entity\Wiki;
use AppBundle\Repository\WikiRepository;
use AppBundle\Utilities\RoxWikiParserBackend;
use Doctrine\ORM\EntityManager;
use Mike42\Wikitext\WikitextParser;

class WikiModel
{
    private $entityManager;

    private $roxWikiParserBackend;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->roxWikiParserBackend = new RoxWikiParserBackend($entityManager, $this);
    }

    public function getPagename($pageTitle)
    {
        return str_replace(' ', '_', trim($pageTitle));
    }

    public function getPage($pageTitle)
    {
        $pageName = $this->getPagename($pageTitle);

        /** @var WikiRepository $wikiRepository */
        $wikiRepository = $this->entityManager->getRepository(Wiki::class);

        $wikiPage = $wikiRepository->getPageByName($pageName);

        return $wikiPage;
    }

    /**
     * @param $content
     *
     * @return string
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function parseWikiMarkup($content)
    {
        try {
            // Initialise the Parser
            WikitextParser::init();
            WikitextParser::$backend = $this->roxWikiParserBackend;
            $parser = new WikitextParser($content);
            $result = $parser->result;
        } catch (\Exception $e) {
            $result = null;
        }

        return $result;
    }
}