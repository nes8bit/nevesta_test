<?php
/**
 * @Entity
 * @Table(name="photo_like")
 */
class Like extends Model
{
    /**
     * @Id
     * @OneToOne(targetEntity="Photo")
     * @JoinColumn(name="photo_id", referencedColumnName="id")
     */
    private $photo;

    /**
     * @Id 
     * @OneToOne(targetEntity="User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    public function getUser()
    {
        return $this->user;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function __construct(User $user, Photo $photo)
    {
        $this->photo    = $photo;
        $this->user     = $user;
    }
}
