<?php

namespace App\Services;

use App\Models\PrivateChat;

/**
 * business logic for users
 *
 * Class UsersService
 */
class PrivateChatService extends AbstractService {

    /** Unable to create user */
    const ERROR_UNABLE_TO_FIND_CHAT = 11001;

    /**
     * Returns users chat history
     *
     * @return array
     */
    public function getPrivateChat($user1, $user2, $createIfNoChat = false) {
        try {
            $chatBox = PrivateChat::findFirst(
                            [
                                'conditions' => '(user1 = :user1: and user2 = :user2:) or (user1 = :user2: and user2 = :user1:)',
                                'bind' => [
                                    "user1" => $user1,
                                    "user2" => $user2
                                ],
                            ]
            );

            if (!$chatBox && $createIfNoChat) {

                $chatBox = new PrivateChat();
                $chatHis = $this->chatHistoryService->createChatHistory();
                $chatBox->setUser1($user1)
                        ->setUser2($user2)
                        ->setChatHistId($chatHis->getId())
                        ->create();
                return $chatBox;
            }

            return $chatBox;
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e, $this->logger);
        }
    }

    /**
     * Returns users chat history
     *
     * @return array
     */
    public function getChatHistory($user1, $user2, $createIfNoexist = false) {
        try {
            $chatBox = $this->getPrivateChat($user1, $user2, $createIfNoexist);
              if (!$chatBox)
                return null;
            return $chatBox->Chathistory;
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e , $this->logger);
        }
    }

}
