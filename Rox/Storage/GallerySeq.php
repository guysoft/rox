<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GallerySeq
 *
 * @ORM\Table(name="gallery_seq")
 * @ORM\Entity
 */
class GallerySeq
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
