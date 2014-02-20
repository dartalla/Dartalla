<?php

namespace Company\Entity;

use User\Entity\User as UserEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * An example of how to implement a role aware user entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends UserEntity {

    /**
     * @var string
     * @ORM\Column(type="string", length=128)
     */
    protected $password;
    
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        if ($password) {
            $bcrypt = new \Zend\Crypt\Password\Bcrypt();
            $bcrypt->setCost(14);
            $password = $bcrypt->create($password);
            parent::setPassword($password);
        }
        $this->password = $password;
    }
}
