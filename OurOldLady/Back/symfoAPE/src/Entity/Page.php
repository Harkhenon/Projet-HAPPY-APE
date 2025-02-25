<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @ApiResource(
*       itemOperations={
 *          "get",
 *          "put"={"access_control"="is_granted('ROLE_ADMIN')"},
 *           "delete"={"access_control"="is_granted('ROLE_ADMIN')"}
 *      },
 *      collectionOperations={
 *           "get",
 *          "post"={"access_control"="is_granted('ROLE_ADMIN')"}
 *      }   
*)
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 */
class Page
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
      * @Assert\NotBlank(message= "Ce champ doit être renseigné.")
     * @Assert\Length(min=4, minMessage="Plus court que 'home', comme nom de page, ça fait vraiment short, non ?", max=200, maxMessage ="Il s'agit du title de la page, pas d'un roman ;).")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * * @Assert\NotBlank(message= "Ce champ doit être renseigné.")
     * @Assert\Length(min=50, minMessage = "Moins de 50 caractères sur une page, ça ne fait pas très sérieux... ")
     */
    private $content;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }
}
