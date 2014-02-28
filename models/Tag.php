<?php
/**
 * @Entity
 * @Table(name="tag")
 */
class Tag extends Model
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /** @Column(length=45) */
    private $title;

    public function getTitle()
    {
        return $this->title;
    }

    public function getId()
    {
        return $this->id;
    }
}
