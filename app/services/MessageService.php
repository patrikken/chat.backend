<?php

namespace App\Services;

use App\Models\Message;
use App\Models\ChatHistory;

/**
 * business logic for users
 *
 * Class UsersService
 */
class MessageService extends AbstractService {

    /** Unable to create user */
    const ERROR_UNABLE_GET_DATA = 11001;

    /**
     * Send message
     *
     * @param boolean $success
     */
    public function sendMessage($data) {
        try {

            $chatHitory = $this->privateChatService->getChatHistory($data['sender'], $data['reciever'], true);
            $msg = new Message();
            $msg->setSender($data["sender"])
                    ->setContent($data["content"])
                    ->setChatHistId($chatHitory->getId())
                    ->setMessageType($data["type"])
                    ->create();
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e, $this->logger);
        }
        return true;
    }

    /**
     * Send message
     *
     * @param array of message
     */
    public function getMessages($data) {
        try {

            $chatHitory = $this->privateChatService->getChatHistory($data['sender'], $data['reciever']);

            if (!$chatHitory) {
                return [];
            }

            $msgs = $chatHitory->getRelated('messages', [ 
                'order' => 'creationDate DESC',
                'limit' => 2,
                'offset' => $data['page'], // offset of result
                'count' => 'id'
            ]);
            $result = $msgs->toArray(); 
            return $result;
        } catch (\PDOException $e) {
            $this->logger->critical(
                    $e->getMessage() . ' ' . $e->getCode()
            );
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
        return true;
    }

    /**
     * Updating an existing user
     *
     * @param array $userData
     */
    public function updateUser(array $userData) {
        try {
            $user = User::findFirst(
                            [
                                'conditions' => 'id = :id:',
                                'bind' => [
                                    'id' => $userData['id']
                                ]
                            ]
            );

            $userData['email'] = (is_null($userData['email'])) ? $user->getemail() : $userData['email'];
            $userData['password'] = (is_null($userData['password'])) ? $user->getPass() : password_hash($userData['password'], PASSWORD_DEFAULT);
            $userData['first_name'] = (is_null($userData['first_name'])) ? $user->getFirstName() : $userData['first_name'];
            $userData['last_name'] = (is_null($userData['last_name'])) ? $user->getLastName() : $userData['last_name'];

            $result = $user->setemail($userData['email'])
                    ->setPass($userData['password'])
                    ->setFirstName($userData['first_name'])
                    ->setLastName($userData['last_name'])
                    ->update();

            if (!$result) {
                throw new ServiceException('Unable to update user', self::ERROR_UNABLE_UPDATE_USER);
            }
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Delete an existing user
     *
     * @param int $userId
     */
    public function deleteUser($userId) {
        try {
            $user = User::findFirst(
                            [
                                'conditions' => 'id = :id:',
                                'bind' => [
                                    'id' => $userId
                                ]
                            ]
            );

            if (!$user) {
                throw new ServiceException("User not found", self::ERROR_USER_NOT_FOUND);
            }

            $result = $user->delete();

            if (!$result) {
                throw new ServiceException('Unable to delete user', self::ERROR_UNABLE_DELETE_USER);
            }
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns user list
     *
     * @return array
     */
    public function getUserList() {
        try {
            $users = User::find(
                            [
                                'conditions' => '',
                                'bind' => [],
                                'columns' => "id, email, first_name, last_name, lastconnexion",
                            ]
            );

            if (!$users) {
                return [];
            }

            return $users->toArray();
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

}
