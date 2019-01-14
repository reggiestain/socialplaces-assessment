<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable{
/**
 * @ORM\Id()
 * @ORM\GeneratedValue()
 * @ORM\Column(type="integer")
 */
private $id;

/**
 * @ORM\Column(type="string", length=255, unique=true)
 */
private $username;
/**
 * @ORM\Column(type="json_array")
 */
private $roles = array();

/**
 * @ORM\Column(type="string", length=255)
 */
private $password;

/**
 * @ORM\Column(type="string", length=255, unique=true)
 */
private $email;

public function getId(): ?int{
return $this->id;
}

/**
 * A visual identifier that represents this user.
 *
 * @see UserInterface
 */
public function getUsername(): ?string{
    return (string) $this->username;
}

public function setUsername(string $username): self{
    $this->username = $username;

    return $this;
}

public function getPassword(): ?string{
    return $this->password;
}

public function setPassword(string $password): self{
    $this->password = $password;

    return $this;
}

public function getEmail(): ?string{
    return $this->email;
}

public function setEmail(string $email): self{
    $this->email = $email;

    return $this;
}

/**
* @see UserInterface
*/
public function getRoles(){
    $roles = $this->roles;
    // guarantee every user at least has ROLE_USER
    //$roles[] = 'ROLE_USER';
    return array_unique($roles);
}

public function setRoles(array $roles){
    $this->roles = $roles;
    
    return $this;
}
public function getSalt(){

}

public function eraseCredentials(){

}

public function serialize() {
    return serialize([
    $this->id,
    $this->username,
    $this->email,
    $this->password
    ]);
}

public function unserialize($string) {
    list(
    $this->id,
    $this->username,
    $this->email,
    //$this->roles,
    $this->password
    ) = unserialize($string, ['allowed_class' => false]);
}

}
