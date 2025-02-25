<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *      itemOperations={
 *          "get",
 *          "put"={
 *             "access_control"="is_granted('ROLE_REDACT')"
 *         },
 *           "delete"={
 *             "access_control"="is_granted('ROLE_REDACT')"
 *         }
 *      },
 *      collectionOperations={
 *           "get",
 *          "post"={
 *             "access_control"="is_granted('ROLE_REDACT')"
 *         }
 *      }   
 * )
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 */
class Tag
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message= "Ce champ doit être renseigné.")
     * @Assert\Length(min=3, 
     *      minMessage="Le nom du tag doit compter entre 3 et 20 caractères.",       
     *      max=20, 
     *      maxMessage ="Le nom du tag doit compter entre 3 et 20 caractères.")
     */
    private $title;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
