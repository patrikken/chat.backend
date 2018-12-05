<?php

namespace App\Models;
use App\Models\Message;

class MessageText extends Message
{ 
    const MESSAGE_TYPE = 'TEXT';
    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $contenu; 

    /**
     *
     * @var integer
     */
    protected $sender;
 

     public function onConstruct() { 
        $this->messageType = self::MESSAGE_TYPE;
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
     * Method to set the value of field contenu
     *
     * @param string $contenu
     * @return $this
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

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
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    } 

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("public");
        $this->setSource("messageText");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'messageText';
    }
    
    public function getSequenceName()
    {
        return "\"messageText_id_seq\"";
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MessageText[]|MessageText|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MessageText|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
