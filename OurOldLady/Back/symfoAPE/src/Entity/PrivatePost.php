<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ApiResource(
 *      attributes={"order"={"createdAt": "DESC"}},
 *      itemOperations={
 *          "get"={"access_control"="is_granted('IS_AUTHENTICATED_FULLY')"},
 *          "put"={"access_control"="is_granted('ROLE_REDACT')"},
 *           "delete"={"access_control"="is_granted('ROLE_REDACT')"}
 *      },
 * 
 *      collectionOperations={
 *          "get"={"access_control"="is_granted('IS_AUTHENTICATED_FULLY')"},
 *           "post"={"access_control"="is_granted('ROLE_REDACT')"}
 *      },
 * )
 * @ORM\Entity(repositoryClass="App\Repository\PrivatePostRepository")
 */
class PrivatePost
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
     * @Assert\Length(min=5, minMessage="Le nom du post doit compter entre 5 et 200 caractères.", max=200, maxMessage ="Le nom du post doit compter entre 5 et 200 caractères.")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message= "Ce champ doit être renseigné.")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime
     */
    private $updatedAt;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Medium", mappedBy="privatePost", cascade={"persist", "remove"})
     */
    private $medium;


    public function __construct()
    {
        $this->createdAt = new \DateTime;
        $this->updatedAt = new \DateTime;
    }

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getMedium(): ?Medium
    {
        return $this->medium;
    }

    public function setMedium(?Medium $medium): self
    {
        $this->medium = $medium;

        // set (or unset) the owning side of the relation if necessary
        $newPrivatePost = $medium === null ? null : $this;
        if ($newPrivatePost !== $medium->getPrivatePost()) {
            $medium->setPrivatePost($newPrivatePost);
        }

        return $this;
    }
}
