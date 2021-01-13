<?php


namespace App\Repositories;

use App\Constants\AppConstants;
use App\Constants\UserConstants;
use App\Models\Users;
use Illuminate\Http\Request;

/**
 * UserRepository
 * @package App\Repositories
 * @author  Angelo C. Bustamante <bustamantegelo@gmail.com>
 * @since   13/01/2021
 * @version 1.0
 */
class UserRepository extends BaseRepository
{
    /**
     * Users model
     * @var Users $oUsers
     */
    protected $oUsers;

    /**
     * UserRepository constructor.
     *
     * @param Request $oRequest
     * @param Users $oUsers
     */
    public function __construct(Request $oRequest, Users $oUsers)
    {
        $this->oRequest = $oRequest;
        $this->oUsers = $oUsers;
    }

    /**
     * Save user data
     *
     * @return mixed
     */
    public function createUser()
    {
        $aData = [
            UserConstants::FIRST_NAME     => $this->oRequest->get(UserConstants::FIRST_NAME),
            UserConstants::MIDDLE_NAME    => $this->oRequest->get(UserConstants::MIDDLE_NAME),
            UserConstants::LAST_NAME      => $this->oRequest->get(UserConstants::LAST_NAME),
            UserConstants::USERNAME       => $this->oRequest->get(UserConstants::USERNAME),
            UserConstants::PASSWORD       => $this->oRequest->get(UserConstants::PASSWORD),
            UserConstants::SCHOOL         => $this->oRequest->get(UserConstants::SCHOOL),
            UserConstants::TYPE           => $this->oRequest->get(UserConstants::TYPE),
            UserConstants::DESIGNATION    => $this->oRequest->get(UserConstants::DESIGNATION),
            UserConstants::REQUIRED_HOURS => $this->oRequest->get(UserConstants::REQUIRED_HOURS),
            UserConstants::RENDERED_HOURS => $this->oRequest->get(UserConstants::RENDERED_HOURS)
        ];

        return $this->oUsers->create($aData);
    }

    /**
     * Get all users
     *
     * @return mixed
     */
    public function getAllUsers()
    {
        $iType = $this->oRequest->get(UserConstants::TYPE);
        $iDesignation = $this->oRequest->get(UserConstants::DESIGNATION);
        $aUsers = $this->oUsers
            ->where(UserConstants::TYPE, $iType)
            ->where(UserConstants::DESIGNATION, $iDesignation)
            ->get()
            ->toArray();
        $aCount = $this->getAllCountUsers();

        return array_merge($aCount, [AppConstants::USERS => $aUsers]);
    }

    /**
     * Get user details
     *
     * @param $iUserId
     * @return array
     */
    public function getUser($iUserId)
    {
        $aUser = $this->oUsers
            ->where(UserConstants::USER_ID, $iUserId)
            ->first()
            ->toArray();

        return [
            AppConstants::USER => $aUser
        ];
    }

    /**
     * Count users
     *
     * @return array
     */
    public function getAllCountUsers()
    {
        $iType = $this->oRequest->get(UserConstants::TYPE);
        $iDesignation = $this->oRequest->get(UserConstants::DESIGNATION);
        $iCount = $this->oUsers
            ->where(UserConstants::TYPE, $iType)
            ->where(UserConstants::DESIGNATION, $iDesignation)
            ->count();

        return [
            AppConstants::COUNT => $iCount
        ];
    }

    /**
     * Update user details
     *
     * @param $iUserId
     * @return array
     */
    public function updateUser($iUserId)
    {
        $aUser = [
            UserConstants::FIRST_NAME     => $this->oRequest->get(UserConstants::FIRST_NAME),
            UserConstants::MIDDLE_NAME    => $this->oRequest->get(UserConstants::MIDDLE_NAME),
            UserConstants::LAST_NAME      => $this->oRequest->get(UserConstants::LAST_NAME),
            UserConstants::USERNAME       => $this->oRequest->get(UserConstants::USERNAME),
            UserConstants::PASSWORD       => $this->oRequest->get(UserConstants::PASSWORD),
            UserConstants::SCHOOL         => $this->oRequest->get(UserConstants::SCHOOL),
            UserConstants::TYPE           => $this->oRequest->get(UserConstants::TYPE),
            UserConstants::DESIGNATION    => $this->oRequest->get(UserConstants::DESIGNATION),
            UserConstants::REQUIRED_HOURS => $this->oRequest->get(UserConstants::REQUIRED_HOURS),
            UserConstants::RENDERED_HOURS => $this->oRequest->get(UserConstants::RENDERED_HOURS)
        ];
        $aUpdateUser = $this->oUsers
            ->where(UserConstants::USER_ID, $iUserId)
            ->update($aUser);

        return [
            AppConstants::BRESULT => (bool) $aUpdateUser,
            AppConstants::USER    => $aUser
        ];
    }

    /**
     * Delete user
     *
     * @param $iUserId
     * @return array
     */
    public function deleteUser($iUserId)
    {
        $bDeletedUser = $this->oUsers
            ->where(UserConstants::USER_ID, $iUserId)
            ->delete();
        $sMessage = sprintf('%s deleted user id %s', (bool) $bDeletedUser ? 'Successfully' : 'Unsuccessfully', $iUserId);

        return [
            AppConstants::BRESULT => (bool) $bDeletedUser,
            AppConstants::MESSAGE => $sMessage
        ];
    }
}
