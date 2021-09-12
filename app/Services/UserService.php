<?php

namespace App\Services;

use App\Classes\ErrorMessages;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use PDOException;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->withPagination();
    }

    public function getUser($id)
    {
        return $this->userRepository->find($id);
    }

    public function saveUser($data)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->create($data);
            $this->userRepository->createContacts($user, $data['contacts']);

            DB::commit();
            return response()->json([
                'success' => true,
                'data' => $user
            ]);
        } catch (PDOException $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'code' => ErrorMessages::CAN_NOT_CREATE,
                'message' => ErrorMessages::CAN_NOT_CREATE_MSG,
                'details' => $e->getMessage()
            ]);
        }
    }

    public function deleteUser($id)
    {
        $user = $this->userRepository->find($id);

        $user->contacts()->delete();
        $user->delete();
    }
}
