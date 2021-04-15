<?php
// src/model/Bug.php

namespace Bugtracker\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Bugtracker\Model\User;
use \DateTime;

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

    /**
     * @ORM\ManyToMany(targetEntity="Product")
     */
    protected Collection $products;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="reportedBugs")
     */
    protected User $reporter;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="assignedBugs")
     */
    protected User $engineer;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function assignToProduct(Product $product):self
    {
        $this->products[] = $product;
        return $this;
    }

    public function getProducts():Collection
    {
        return $this->products;
    }

    public function setEngineer(User $engineer):self
    {
        $engineer->assignedToBug($this);
        $this->engineer = $engineer;
        return $this;
    }

    public function setReporter(User $reporter):self
    {
        $reporter->addReportedBug($this);
        $this->reporter = $reporter;
        return $this;
    }

    public function getEngineer():User
    {
        return $this->engineer;
    }

    public function getReporter():User
    {
        return $this->reporter;
    }

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

    public function close()
    {
        $this->status = "CLOSE";
    }
}