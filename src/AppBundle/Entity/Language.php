<?php
/*
 * @codingStandardsIgnoreFile
 *
 * Auto generated file ignore for Code Sniffer
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Language.
 *
 * @ORM\Table(name="languages", uniqueConstraints={@ORM\UniqueConstraint(name="ShortCode", columns={"ShortCode"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LanguageRepository")
 *
 * @SuppressWarnings(PHPMD)
 * Auto generated class do not check mess
 */
class Language
{
    /**
     * @var string
     *
     * @ORM\Column(name="EnglishName", type="text", length=255, nullable=false)
     */
    private $englishname;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="text", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     */
    private $translatedname;

    /**
     * @var string
     *
     * @ORM\Column(name="ShortCode", type="string", length=16, nullable=false)
     */
    private $shortcode;

    /**
     * @var string
     *
     * @ORM\Column(name="WordCode", type="text", length=255, nullable=false)
     */
    private $wordcode;

    /**
     * @var int
     *
     * @ORM\Column(name="FlagSortCriteria", type="integer", nullable=false)
     */
    private $flagsortcriteria = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="IsWrittenLanguage", type="boolean", nullable=false)
     */
    private $iswrittenlanguage = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="IsSpokenLanguage", type="boolean", nullable=false)
     */
    private $isspokenlanguage = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="IsSignLanguage", type="boolean", nullable=false)
     */
    private $issignlanguage = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Set englishname.
     *
     * @param string $englishname
     *
     * @return Language
     */
    public function setEnglishname($englishname)
    {
        $this->englishname = $englishname;

        return $this;
    }

    /**
     * Get englishname.
     *
     * @return string
     */
    public function getEnglishname()
    {
        return $this->englishname;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Language
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Language
     */
    public function setTranslatedName($name)
    {
        $this->translatedname = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getTranslatedName()
    {
        return $this->translatedname;
    }

    /**
     * Set shortcode.
     *
     * @param string $shortcode
     *
     * @return Language
     */
    public function setShortcode($shortcode)
    {
        $this->shortcode = $shortcode;

        return $this;
    }

    /**
     * Get shortcode.
     *
     * @return string
     */
    public function getShortcode()
    {
        return $this->shortcode;
    }

    /**
     * Set wordcode.
     *
     * @param string $wordcode
     *
     * @return Language
     */
    public function setWordcode($wordcode)
    {
        $this->wordcode = $wordcode;

        return $this;
    }

    /**
     * Get wordcode.
     *
     * @return string
     */
    public function getWordcode()
    {
        return $this->wordcode;
    }

    /**
     * Set flagsortcriteria.
     *
     * @param int $flagsortcriteria
     *
     * @return Language
     */
    public function setFlagsortcriteria($flagsortcriteria)
    {
        $this->flagsortcriteria = $flagsortcriteria;

        return $this;
    }

    /**
     * Get flagsortcriteria.
     *
     * @return int
     */
    public function getFlagsortcriteria()
    {
        return $this->flagsortcriteria;
    }

    /**
     * Set iswrittenlanguage.
     *
     * @param bool $iswrittenlanguage
     *
     * @return Language
     */
    public function setIsWrittenlanguage($iswrittenlanguage)
    {
        $this->iswrittenlanguage = $iswrittenlanguage;

        return $this;
    }

    /**
     * Get iswrittenlanguage.
     *
     * @return bool
     */
    public function getIsWrittenlanguage()
    {
        return $this->iswrittenlanguage;
    }

    /**
     * Set isspokenlanguage.
     *
     * @param bool $isspokenlanguage
     *
     * @return Language
     */
    public function setIsSpokenlanguage($isspokenlanguage)
    {
        $this->isspokenlanguage = $isspokenlanguage;

        return $this;
    }

    /**
     * Get isspokenlanguage.
     *
     * @return bool
     */
    public function getIsSpokenlanguage()
    {
        return $this->isspokenlanguage;
    }

    /**
     * Set issignlanguage.
     *
     * @param bool $issignlanguage
     *
     * @return Language
     */
    public function setIsSignlanguage($issignlanguage)
    {
        $this->issignlanguage = $issignlanguage;

        return $this;
    }

    /**
     * Get issignlanguage.
     *
     * @return bool
     */
    public function getIsSignlanguage()
    {
        return $this->issignlanguage;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
