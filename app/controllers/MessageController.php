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
        $data["sender"] = $this->request->getPost("sender");
        $data["reciever"] = $this->request->getPost("reciever");
        $data["content"] = $this->request->getPost("content");
        $data["type"] = $this->request->getPost("type");
        try {
            $this->messageService->sendMessage($data);
        } catch (ServiceException $e) {
            throw new Http500Exception(_('Internal Server Error'), $e->getCode(), $e);
        }
        return parent::chatResponce('User successfull created');
    }

    /**
     * Updating existing user
     *
     * @param string $userId
     */
    public function updateUserAction($userId) {
        
    }

    /**
     * Delete an existing user
     *
     * @param string $userId
     */
    public function deleteUserAction($userId) {
        
    }

}
