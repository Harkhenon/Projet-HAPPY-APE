<?php

namespace App\Entity;

use App\Entity\Role;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(routePrefix="/profile", 
 *      normalizationContext={"groups"={"read"}},
 *      itemOperations={
 *          "get"={"access_control"="is_granted('ROLE_ADMIN') or (is_granted('ROLE_USER') and object == user)"},
 *          "put"={"access_control"="is_granted('ROLE_ADMIN') or (is_granted('ROLE_USER') and object == user)"},
 *           "delete"={"access_control"="is_granted('ROLE_ADMIN') or (is_granted('ROLE_USER') and object == user)"}
 *      },
 *      collectionOperations={
 *           "get"={"access_control"="is_granted('ROLE_ADMIN')"},
 *             "post"
 *      }   
 * )
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message = "Ce champ doit être renseigné.")
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire minimum 8 caractères")
     */
    private $password;

    /**
     * @Assert\NotBlank()
     * @Assert\Expression(
     *      "this.getPassword() === this.getRetypedPassword()",
     *      message="Les mots de passe ne sont pas identiques"
     *)
     */
    private $retypedPassword;


    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Ce champ doit être renseigné.")
     * @Assert\Length(min="2", minMessage="Votre Prénom doit faire minimum 2 caractères")
     * @Groups({"read"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Ce champ doit être renseigné.")
     * @Assert\Length(min="2", minMessage="Votre Nom doit faire minimum 2 caractères")
     * @Groups({"read"})
     */
    private $firstname;
        
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read"})
     */
    private $address_city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read"})
     */
    
    private $address_street;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read"})
     */
    private $address_other;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read"})
     */
    private $address_number;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     * @Groups({"read"})
     */
    private $address_zipcode;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"read"})
     */
    private $newsletter_subscription;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"read"})
     */
    private $isActive;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read"})
     */
    private $isParent;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Email()
     * @Groups({"read"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Length(min="2", minMessage="Votre nom d'utilisateur doit faire minimum 2 caractères")
     * @Groups({"read"})
     */
    private $username;

    /**
    * @ORM\Column(type="json_array")
     * @Groups({"read"})
     */
    private $roles = ["ROLE_USER"];

    public function __construct()
    {
        $this->createdAt = new \DateTime;
        $this->updatedAt = new \DateTime;
        $this->isActive = true;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    
    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }
    
    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
    
    public function getLastname(): ?string
    {
        return $this->lastname;
    }
    
    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;
        return $this;
    }
    
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }
    
    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }
    
    public function getAddressCity(): ?string
    {
        return $this->address_city;
    }
    
    public function setAddressCity(?string $address_city): self
    {
        $this->address_city = $address_city;
        return $this;
    }
    
    public function getAddressStreet(): ?string
    {
        return $this->address_street;
    }
    
    public function setAddressStreet(?string $address_street): self
    {
        $this->address_street = $address_street;
        return $this;
    }
    
    public function getAddressOther(): ?string
    {
        return $this->address_other;
    }
    
    public function setAddressOther(?string $address_other): self
    {
        $this->address_other = $address_other;
        return $this;
    }
    
    public function getAddressNumber(): ?int
    {
        return $this->address_number;
    }
    
    public function setAddressNumber(?int $address_number): self
    {
        $this->address_number = $address_number;
        return $this;
    }
    
    public function getAddressZipcode(): ?string
    {
        return $this->address_zipcode;
    }
    
    public function setAddressZipcode(?string $address_zipcode): self
    {
        $this->address_zipcode = $address_zipcode;
        return $this;
    }
    
    public function getNewsletterSubscription(): ?bool
    {
        return $this->newsletter_subscription;
    }
    
    public function setNewsletterSubscription(?bool $newsletter_subscription): self
    {
        $this->newsletter_subscription = $newsletter_subscription;
        return $this;
    }
    
    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }
    
    public function setIsActive(?bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }
    
    public function getIsParent(): ?bool
    {
        return $this->isParent;
    }
    
    public function setIsParent(?bool $isParent): self
    {
        $this->isParent = $isParent;
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
    
    public function __toString()
    {
        return $this->lastname;
    }
    
    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    
    public function getRetypedPassword()
    {
        return $this->retypedPassword;
    }

    public function setRetypedPassword($retypedPassword)
    {
        $this->retypedPassword = $retypedPassword;

        return $this;
    }
    
    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;
        return $this;
    }
}
