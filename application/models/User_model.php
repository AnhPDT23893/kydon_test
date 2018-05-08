<?php
class User_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->load->config('test');
    }

    /**
     * Insert user
     * 
     * @param $data
     * @return bool
     */
    public function insert($data)
    {
        $insertData = [];
        if (isset($data['name']) && !empty($data['name'])) {
            $insertData['name'] = $data['name'];
        }
        if (isset($data['username']) && !empty($data['username'])) {
            $insertData['username'] = $data['username'];
        }
        if (isset($data['email']) && !empty($data['email'])) {
            $insertData['email'] = $data['email'];
        }
        if (isset($data['phone']) && !empty($data['phone'])) {
            $insertData['phone'] = $data['phone'];
        }
        if (isset($data['password']) && !empty($data['password'])) {
            $insertData['password'] = bcrypt($data['password']);
        }
        if (isset($data['birthday']) && !empty($data['birthday'])) {
            $insertData['birthday'] = $data['birthday'];
        }
    
        $insertData['status'] = 1;
        $insertData['created_at'] = date('Y-m-d H:m:s', time());
        $insertData['updated_at'] = date('Y-m-d H:m:s', time());

        try
        {
            $this->db->insert('user', $insertData);

            $this->cache->clean();
            return $this->getUser($this->db->insert_id());
        } catch (Exception $ex) {
            log_message('error', 'Create user error: ' .$ex->getMessage());
        }
        
        return false;
    }
    
    public function update($data)
    {
        $updateData = [];
        if (isset($data['name']) && !empty($data['name'])) {
            $updateData['name'] = $data['name'];
        }
        if (isset($data['username']) && !empty($data['username'])) {
            $updateData['username'] = $data['username'];
        }
        if (isset($data['email']) && !empty($data['email'])) {
            $updateData['email'] = $data['email'];
        }
        if (isset($data['phone']) && !empty($data['phone'])) {
            $updateData['phone'] = $data['phone'];
        }
        if (isset($data['birthday']) && !empty($data['birthday'])) {
            $updateData['birthday'] = $data['birthday'];
        }
        if (isset($data['avatar']) && !empty($data['avatar'])) {
            $updateData['avatar'] = $data['avatar'];
        }
        if (isset($data['FB_ID']) && !empty($data['FB_ID'])) {
            $user = $this->getByFbID($data['FB_ID']);
            if (!$user) {
                $updateData['FB_ID'] = $data['FB_ID'];
                $updateData['FB_Profile'] = 'https://www.facebook.com/app_scoped_user_id/'.$data['FB_ID'].'/';
            } else {
                echo 'Tài khoản Facebook của bạn đã được sử dụng cho người dùng khác. Vui lòng sử dụng tài khoản khác.';
            }
        }

        $updateData['updated_at'] = date('Y-m-d H:m:s', time());
        
        if ($this->db->where('id', $data['id'])->update('user', $updateData)) {
            $this->cache->clean();
            return $this->getUser($data['id']);
        }
        
        return false;
    }

    /**
     * Get user
     * 
     * @param $user_id
     * @return mixed
     */
    public function getUser($user_id)
    {
        $result = $this->db->select('*')->from('user')->where('id', $user_id)->get()->row();

        if ($result) {
            return $result;
        }

        return false;
    }

    /**
     * Get by email
     * 
     * @param $email
     * @return mixed
     */
    public function getByEmail($email)
    {
        $result = $this->db->select('*')->from('user')->where('email', $email)->get()->row();
            
        if ($result) {
            return $result;
        }
        
        return false;
    }

    /**
     * Check session id
     * 
     * @param $user_id
     * @param $session_id
     * @return bool
     */
    public function checkSessionID($user_id, $session_id)
    {
        $result = $this->db->select('*')->from('user')->where(['id' => $user_id])->get()->row();
        
        if ($result) {
            return true;
        }
        
        return false;
    }

    public function getByFbID($fb_id)
    {
        $result = $this->db->select('*')->from('user')->where(['fb_id' => $fb_id])->get()->row();

        return $result;
    }
}