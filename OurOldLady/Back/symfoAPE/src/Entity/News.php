<?php
namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Utils\Slugger;
/**
 * @ApiResource(
 *      itemOperations={
 *          "get", 
 *          "put"={"access_control"="is_granted('ROLE_REDACT')"},
 *           "delete"={"access_control"="is_granted('ROLE_REDACT')"}
 *      },
 *      collectionOperations={
 *          "get", 
 *          "post"={"access_control"="is_granted('ROLE_REDACT')"}
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\NewsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class News
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
     * @Assert\Length(min=5, minMessage="Le titre de la news doit compter entre 5 et 200 caractères.", max=200, maxMessage ="Le titre de la news doit compter entre 5 et 200 caractères.")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message= "Ce champ doit être renseigné.")
     * @Assert\Length(min=50, minMessage = "Au moins 50 caractères SVP.")
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
     * @ORM\Column(type="boolean")
     */
    private $isPublished;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag")
     */
    private $tags;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     * @ApiSubresource
     */
    private $author;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Medium", mappedBy="news", cascade={"persist", "remove"})
     */
    private $medium;
    public function __construct()
    {
        $this->createdAt = new \DateTime;
        $this->updatedAt = new \DateTime;
        $this->isPublished = true;
        $this->tags = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function applySlug(){
        $slugger = new Slugger(true);
        $slug = $slugger->slugify($this->title);
        $this->slug = $slug;
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

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(?bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }


    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
    }


    public function getSlug()
    {
        return $this->slug;
    }


    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }
    
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

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
        $newNews = $medium === null ? null : $this;
        if ($newNews !== $medium->getNews()) {
            $medium->setNews($newNews);
        }

        return $this;
    }

}