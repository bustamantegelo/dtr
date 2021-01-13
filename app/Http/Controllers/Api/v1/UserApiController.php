<?php

namespace App\Http\Controllers\Api\v1;

use App\Libraries\ResponseLib;
use App\Repositories\UserRepository;

/**
 * UserApiController
 * @package App\Http\Controllers\Api\v1
 * @author  Angelo C. Bustamante <bustamantegelo@gmail.com>
 * @since   13/01/2021
 * @version 1.0
 */
class UserApiController
{
    /**
     * User Repository
     *
     * @var UserRepository
     */
    protected $oUserRepository;

    /**
     * UserApiController constructor.
     *
     * @param UserRepository $oUserRepository
     */
    public function __construct(UserRepository $oUserRepository)
    {
        $this->oUserRepository = $oUserRepository;
    }

    /**
     * Create user
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function createUser()
    {
        try {
            $aCreateUserResult = $this->oUserRepository->createUser();

            return ResponseLib::filterResponse($aCreateUserResult);
        } catch (\Exception $oException) {
            return ResponseLib::setErrors($oException->getCode(), $oException->getMessage());
        }
    }

    /**
     * Get all users
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function getAllUsers()
    {
        try {
            $aAllUsersResult = $this->oUserRepository->getAllUsers();

            return ResponseLib::filterResponse($aAllUsersResult);
        } catch (\Exception $oException) {
            return ResponseLib::setErrors($oException->getCode(), $oException->getMessage());
        }
    }

    /**
     * Get user details
     *
     * @param $iUserId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function getUser($iUserId)
    {
        try {
            $aUserResult = $this->oUserRepository->getUser($iUserId);

            return ResponseLib::filterResponse($aUserResult);
        } catch (\Exception $oException) {
            return ResponseLib::setErrors($oException->getCode(), $oException->getMessage());
        }
    }

    /**
     * Get all count users
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function getAllCountUsers()
    {
        try {
            $aAllCountUsersResult = $this->oUserRepository->getAllCountUsers();

            return ResponseLib::filterResponse($aAllCountUsersResult);
        } catch (\Exception $oException) {
            return ResponseLib::setErrors($oException->getCode(), $oException->getMessage());
        }
    }

    /**
     * Update user
     *
     * @param $iUserId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function updateUser($iUserId)
    {
        try {
            $aUpdateUserResult = $this->oUserRepository->updateUser($iUserId);

            return ResponseLib::filterResponse($aUpdateUserResult);
        } catch (\Exception $oException) {
            return ResponseLib::setErrors($oException->getCode(), $oException->getMessage());
        }
    }

    /**
     * Delete user
     *
     * @param $iUserId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function deleteUser($iUserId)
    {
        try {
            $aDeleteUserResult = $this->oUserRepository->deleteUser($iUserId);

            return ResponseLib::filterResponse($aDeleteUserResult);
        } catch (\Exception $oException) {
            return ResponseLib::setErrors($oException->getCode(), $oException->getMessage());
        }
    }
}
