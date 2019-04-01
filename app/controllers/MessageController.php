<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Controllers\HttpExceptions\Http400Exception;
use App\Controllers\HttpExceptions\Http422Exception;
use App\Controllers\HttpExceptions\Http500Exception;
use App\Services\AbstractService;
use App\Services\ServiceException;
use App\Services\UserService;

class MessageController extends AbstractController {

    /**
     * send message to other user
     * Returns user list
     *
     * @return array
     */
    public function sendMessageAction() {
        $data = [];
        $jsonData = $this->request->getJsonRawBody();
        $data["sender"] = $jsonData->user_sender_id;
        $data["reciever"] = $jsonData->user_reciever_id;
        $data["content"] = $jsonData->body;
        $data["type"] = $jsonData->type; 
        try {
            $this->messageService->sendMessage($data);
        } catch (ServiceException $e) {
            throw new Http500Exception(_('Internal Server Error'), $e->getCode(), $e);
        }
        return parent::chatResponce('');
    }
    
    /**
     * send message to other user
     * Returns user list
     *
     * @return array
     */
    public function getChatBoxAction() {
        $data = [];
        $jsonData = $this->request->getJsonRawBody();
        $data["sender"] = $jsonData->sender;
        $data["reciever"] = $jsonData->reciever; 
        $data["page"] =  $jsonData->page;  
       
        try {
           $reponse = $this->messageService->getMessages($data); 
        } catch (ServiceException $e) {
            throw new Http500Exception(_('Internal Server Error'), $e->getCode(), $e);
        }
        return parent::chatResponce('',$reponse);
    }

    /**
     * send message to other user
     * Returns user list
     *
     * @return array
     */
    public function setAllToReadAction() {
        $data = [];
        $jsonData = $this->request->getJsonRawBody();
        $data["sender"] = $jsonData->sender;
        $data["reciever"] = $jsonData->reciever;     
       
        try {
           $reponse = $this->privateChatService->setAllMessageToReaded($data["sender"], $data["reciever"]); 
        } catch (ServiceException $e) {
            throw new Http500Exception(_('Internal Server Error'), $e->getCode(), $e);
        }
        return parent::chatResponce('',$reponse);
    }
 

}
