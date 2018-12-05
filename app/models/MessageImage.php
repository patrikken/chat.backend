<?php

namespace App\Models;

class MessageImage extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $messageType;

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $creationDate;

    /**
     *
     * @var integer
     */
    protected $chat_hist_id;

    /**
     *
     * @var string
     */
    protected $content;

    /**
     *
     * @var integer
     */
    protected $sender;

    /**
     *
     * @var string
     */
    protected $isReaded;

    /**
     * Method to set the value of field messageType
     *
     * @param integer $messageType
     * @return $this
     */
    public function setMessageType($messageType)
    {
        $this->messageType = $messageType;

        return $this;
    }

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field creationDate
     *
     * @param string $creationDate
     * @return $this
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Method to set the value of field chat_hist_id
     *
     * @param integer $chat_hist_id
     * @return $this
     */
    public function setChatHistId($chat_hist_id)
    {
        $this->chat_hist_id = $chat_hist_id;

        return $this;
    }

    /**
     * Method to set the value of field content
     *
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Method to set the value of field sender
     *
     * @param integer $sender
     * @return $this
     */
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Method to set the value of field isReaded
     *
     * @param string $isReaded
     * @return $this
     */
    public function setIsReaded($isReaded)
    {
        $this->isReaded = $isReaded;

        return $this;
    }

    /**
     * Returns the value of field messageType
     *
     * @return integer
     */
    public function getMessageType()
    {
        return $this->messageType;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field creationDate
     *
     * @return string
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Returns the value of field chat_hist_id
     *
     * @return integer
     */
    public function getChatHistId()
    {
        return $this->chat_hist_id;
    }

    /**
     * Returns the value of field content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Returns the value of field sender
     *
     * @return integer
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Returns the value of field isReaded
     *
     * @return string
     */
    public function getIsReaded()
    {
        return $this->isReaded;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("public");
        $this->setSource("messageImage");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'messageImage';
    }
    
    public function getSequenceName()
    {
        return "\"messageImage_id_seq\"";
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MessageImage[]|MessageImage|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MessageImage|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
