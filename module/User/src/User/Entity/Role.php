<?php

/**
 * BjyAuthorize Module (https://github.com/bjyoungblood/BjyAuthorize)
 *
 * @link https://github.com/bjyoungblood/BjyAuthorize for the canonical source repository
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * An example entity that represents a role.
 *
 * @ORM\Entity
 * @ORM\Table(name="user_role")
 *
 */
class Role {

    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(type="string", length=255, unique=true, nullable=true)
     */
    protected $roleId;

    /**
     * @var string
     * @ORM\Column(name="is_default", type="integer", nullable=false)
     */
    protected $default;

    /**
     * @var Role
     * @ORM\ManyToOne(targetEntity="User\Entity\Role")
     * @ORM\JoinColumn(name="parent", referencedColumnName="roleId")
     */
    protected $parent;

    /**
     * Get the role id.
     *
     * @return string
     */
    public function getDefault() {
        return $this->default;
    }

    /**
     * Set the role id.
     *
     * @param string $default
     *
     * @return void
     */
    public function setDefault($default) {
        $this->default = (string) $default;
    }

    /**
     * Get the parent role
     *
     * @return Role
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * Set the parent role.
     *
     * @param Role $role
     *
     * @return void
     */
    public function setParent(Role $parent) {
        $this->parent = $parent;
    }

    /**
     * Get the role id.
     *
     * @return string
     */
    public function getRoleId() {
        return $this->roleId;
    }

    /**
     * Set the role id.
     *
     * @param string $roleId
     *
     * @return void
     */
    public function setRoleId($roleId) {
        $this->roleId = (string) $roleId;
    }
}
