<?php
// src/Model/User.php

namespace Bugtracker\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    protected int $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected string $name;

    /**
     * @ORM\OneToMany(targetEntity="Bug", mappedBy="reporter")
     * @var Bug[] An ArrayCollection of Bug objects.
     */
    protected $reportedBugs;

    /**
     * @ORM\OneToMany(targetEntity="Bug", mappedBy="engineer")
     * @var Bug[] An ArrayCollection of Bug objects.
     */
    protected $assignedBugs;

    public function __construct()
    {
        $this->reportedBugs = new ArrayCollection();
        $this->assignedBugs = new ArrayCollection();
    }


    /***********************************************************************************
     * A seguir os chamados inversed methods, que o autor optou por nomea-los no passado
     * que deve indicar que a atribuicao ja foi realizada e os metodos sao usados apenas
     * para garantir a consistencia das referencias. É a abordagem sugerida pelo autor.
     * O Bug esta do lado owning do relacionamento, pois ele e dependente de User. Em
     * um modelo relacional, Bug guardaria a referencia para User, a chave estrangeira.
     */
    public function addReportedBug(Bug $bug):self
    {
        $this->reportedBugs[] = $bug;
        return $this;
    }

    public function assignedToBug(Bug $bug):self
    {
        $this->assignedBugs[] = $bug;
        return $this;
    }
    /**
     * You can see from User#addReportedBug() and User#assignedToBug() that using this 
     * method in userland alone would not add the Bug to the collection of the owning 
     * side in Bug#reporter or Bug#engineer. Using these methods and calling Doctrine 
     * for persistence would not update the Collections' representation in the database.
     * Only using Bug#setEngineer() or Bug#setReporter() correctly saves the relation 
     * information. 
     * Whenever a new bug is saved or an engineer is assigned to the bug, we don't want 
     * to update the User to persist the reference, but the Bug. This is the case with 
     * the Bug being at the owning side of the relation.
     * doctrine-project.org/projects/doctrine-orm/en/2.8/tutorials/getting-started.html
     * ****************************************************************************** */


    public function getId():int
    {
        return $this->id;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function setName($name):self
    {
        $this->name = $name;
        return $this;
    }
}