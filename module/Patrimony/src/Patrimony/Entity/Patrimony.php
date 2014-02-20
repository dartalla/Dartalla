<?php

namespace Patrimony\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="patrimony")
 */
class Patrimony {
    
    /**
     * @ORM\Id
     * @ORM\Column(name="patrimony_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $patrimonyId;

    /**
     * @ORM\Column(name="patrimony_name", type="string")
     * @var string
     */
    protected $patrimonyName;
    
    /**
     * @ORM\Column(name="patrimony_value", type="decimal", precision=2)
     */
    protected $patrimonyValue;
    
    /**
     * @ORM\Column(name="patrimony_debit", type="decimal", precision=2)
     */
    protected $patrimonyDebit;
    
    
    public function __construct() {
        $this->patrimonyValue      = 0.00;
        $this->patrimonyDebit      = 0.00;
    }
    
    public function getPatrimonyId() {
        return $this->patrimonyId;
    }

    public function setPatrimonyId($patrimonyId) {
        $this->patrimonyId = $patrimonyId;
        return $this;
    }

    public function getPatrimonyName() {
        return $this->patrimonyName;
    }

    public function setPatrimonyName($patrimonyName) {
        $this->patrimonyName = $patrimonyName;
        return $this;
    }

    public function getPatrimonyValue() {
        return $this->patrimonyValue;
    }

    public function setPatrimonyValue($patrimonyValue) {
        $this->patrimonyValue = $patrimonyValue;
        return $this;
    }
    
    public function getPatrimonyDebit() {
        return $this->patrimonyDebit;
    }

    public function setPatrimonyDebit($patrimonyDebit) {
        $this->patrimonyDebit = $patrimonyDebit;
        return $this;
    }
}
