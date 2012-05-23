<?php

namespace Vns\TodoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vns\TodoBundle\Entity\todoItem
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vns\TodoBundle\Entity\todoItemRepository")
 */
class todoItem
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=80)
     */
    private $title;

    /**
     * @var text $body
     *
     * @ORM\Column(name="body", type="text",nullable=true)
     */
    private $body;

    /**
     * @var integer $item_order
     *
     * @ORM\Column(name="item_order", type="integer")
     */
    private $item_order;

    /**
     * @var boolean $done
     *
     * @ORM\Column(name="done", type="boolean")
     */
    private $done;

    /**
     * @var datetime $create_at
     *
     * @ORM\Column(name="create_at", type="datetime")
     */
    private $create_at;

    /**
     * @var datetime $update_at
     *
     * @ORM\Column(name="update_at", type="datetime")
     */
    private $update_at;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param text $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Get body
     *
     * @return text 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set item_order
     *
     * @param integer $itemOrder
     */
    public function setItemOrder($itemOrder)
    {
        $this->item_order = $itemOrder;
    }

    /**
     * Get item_order
     *
     * @return integer 
     */
    public function getItemOrder()
    {
        return $this->item_order;
    }

    /**
     * Set done
     *
     * @param boolean $done
     */
    public function setDone($done)
    {
        $this->done = $done;
    }

    /**
     * Get done
     *
     * @return boolean 
     */
    public function getDone()
    {
        return $this->done;
    }

    /**
     * Set create_at
     *
     * @param datetime $createAt
     */
    public function setCreateAt()
    {
        $this->create_at = new \DateTime("now");
    }

    /**
     * Get create_at
     *
     * @return datetime 
     */
    public function getCreateAt()
    {
        return $this->create_at;
    }

    /**
     * Set update_at
     *
     * @param datetime $updateAt
     */
    public function setUpdateAt()
    {
        $this->update_at = new \DateTime("now");
    }

    /**
     * Get update_at
     *
     * @return datetime 
     */
    public function getUpdateAt()
    {
        return $this->update_at;
    }

    public function toJson() { 
        return json_encode($this); 
    } 
}