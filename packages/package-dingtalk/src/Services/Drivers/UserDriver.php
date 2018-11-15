<?php 

namespace Fisher\Schedule\Services\Drivers;

class UserDriver extends DriverAbstract
{
	/**
     * Get the provider.
     *
     * @return string
     */
    public function provider(): string
    {
        return 'user';
    }

	/**
     * @param string $userId
     *
     * @return array
     */
    public function get(string $userId)
    {
        return $this->httpGet('user/get', ['userid' => $userId]);
    }

    /**
     * Create a new user.
     *
     * @param array $params
     *
     * @return array
     */
    public function create(array $params)
    {
        return $this->httpPostJson('user/create', $params);
    }

    /**
     * Update an exist user.
     *
     * @param array $params
     *
     * @return array
     */
    public function update(array $params)
    {
        return $this->httpPostJson('user/update', $params);
    }

    /**
     * @param array|string $userId
     *
     * @return array
     */
    public function delete($userId)
    {
        if (is_array($userId)) {
            return $this->httpPostJson('user/batchdelete', ['useridlist' => $userId]);
        }

        return $this->httpGet('user/delete', $userId);
    }

    /**
     * @param int   $departmentId
     * @param array $params
     *
     * @return array
     */
    public function simpleList(int $departmentId, array $params = [])
    {
        return $this->httpGet('user/simplelist', [
            'department_id' => $departmentId,
        ] + $params);
    }

    /**
     * @param int   $departmentId
     * @param int   $size
     * @param int   $offset
     * @param array $params
     *
     * @return array
     */
    public function list(int $departmentId, int $size = 100, int $offset = 0, array $params = [])
    {
        return $this->httpGet('user/list', [
            'department_id' => $departmentId,
            'offset' => $offset,
            'size' => $size,
        ] + $params);
    }

    /**
     * @return array
     */
    public function admin()
    {
        return $this->httpGet('user/get_admin');
    }

    /**
     * UnionId to userId.
     *
     * @param string $unionId
     *
     * @return array
     */
    public function toUserId(string $unionId)
    {
        return $this->httpGet('user/getUseridByUnionid', [
            'unionid' => $unionId,
        ]);
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function count(array $params)
    {
        return $this->httpGet('user/get_org_user_count', $params);
    }

    /**
     * @param string $code
     *
     * @return array
     */
    public function getUserInfo(string $code)
    {
        return $this->httpGet('user/getuserinfo', ['code' => $code]);
    }
}