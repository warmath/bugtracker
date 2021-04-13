<?php
// src/model/Bug.php

namespace Bugtracker\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="bugs")
 */
class Bug
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    protected int $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected string $description;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    protected $created;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected string $status;

    public function getId():int
    {
        return $this->id;
    }

    public function getDescription():string
    {
        return $this->description;
    }

    public function setDescription($description):self
    {
        $this->description = $description;
        return $this;
    }

    public function setCreated(DateTime $created):self
    {
        $this->created = $created;
        return $this;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setStatus($status):self
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus():string
    {
        return $this->status;
    }
}