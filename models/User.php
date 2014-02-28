<?php
/**
 * @Entity
 * @Table(name="user")
 */
class User extends Model
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /** @Column(length=45) */
    private $name;

    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }
}
