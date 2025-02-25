<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Role\RoleHierarchyInterface;

/**
 * @ApiResource(routePrefix="/admin", 
 *      itemOperations={
 *               "get",
 *               "put"={
 *                  "access_control"="is_granted('ROLE_ADMIN')"
 *              },
 *                "delete"={
 *                  "access_control"="is_granted('ROLE_ADMIN')"
 *              }
 *           },
 *           collectionOperations={
 *                "get",
 *               "post"={
 *                  "access_control"="is_granted('ROLE_ADMIN')"
 *              }
 *           }   
 * )
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role implements RoleHierarchyInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, unique=true)
     */
    private $role;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="roles")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
        }

        return $this;
    }
}
