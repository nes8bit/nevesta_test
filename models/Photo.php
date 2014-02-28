<?php
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="photo")
 */
class Photo extends Model
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /** @Column(length=255) */
    private $src;

    /** @Column(type="datetime", name="created_at") */
    private $createdAt;

    /** @Column(type="integer", name="like_count") */
    private $likeCount;

    /**
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /** 
     * @ManyToMany(targetEntity="Tag") 
     * 
     * @JoinTable(name="photo_tag",
     *      joinColumns={@JoinColumn(name="photo_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="tag_id", referencedColumnName="id")}
     *  )
     */
    private $tags;

    /** 
     * @ManyToMany(targetEntity="Tag") 
     * 
     * @JoinTable(name="photo_tag",
     *      joinColumns={@JoinColumn(name="photo_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="tag_id", referencedColumnName="id")}
     *  )
     */
    private $excludedTags;

    /**
     * @OneToMany(targetEntity="Like", mappedBy="photo")
     * @JoinColumn(name="photo_id", referencedColumnName="id")
     */
    private $likes;

    public function __construct()
    {
        $this->tags  = new ArrayCollection();
        $this->likes = new ArrayCollection();
    }

    public function getAuthor()
    {
        return $this->user;
    }

    public function getLikeCount()
    {
        return $this->likeCount;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function getExcludedTags()
    {
        return $this->excludedTags;
    }

    public function getSrc()
    {
        return $this->src;
    }

    public function getId()
    {
        return $this->id;
    }
}
