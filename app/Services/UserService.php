<?php

namespace App\Services;

use App\Classes\ErrorMessages;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use PDOException;

class UserService extends BaseService
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
            $user = $this->userRepository->createUser($data);

            DB::commit();

            return $this->successResponse($user);
        } catch (PDOException $e) {
            DB::rollback();

            return $this->errorResponse(
                ErrorMessages::CAN_NOT_CREATE_MSG,
                ErrorMessages::CAN_NOT_CREATE,
                $e->getMessage()
            );
        }
    }

    public function deleteUser($id)
    {
        $user = $this->userRepository->find($id);

        if (!$user) {
            abort(404, 'User not found!');
        }

        $user->contacts()->delete();
        $user->delete();
    }

    public function updateUser(array $data, $id)
    {
        DB::beginTransaction();
        try {
            $this->userRepository->updateUser($data, $id);

            DB::commit();

            return $this->successResponse('success');
        } catch (PDOException $e) {
            DB::rollback();

            return $this->errorResponse(
                ErrorMessages::CAN_NOT_UPDATE_MSG,
                ErrorMessages::CAN_NOT_UPDATE,
                $e->getMessage()
            );
        }
    }
}
