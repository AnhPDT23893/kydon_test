<?php

// Upload image
function uploadImage($data)
{
    $ci =& get_instance();
    
    // Upload logo
    $upload_dir = '../assets/uploads/'.$data['upload_dir'];
    $config['file_name'] = $data['file_name'];
    $config['upload_path'] =  realpath(APPPATH . $upload_dir);
    $config['allowed_types'] = 'gif|jpg|png';
    $config['overwrite'] = true;

    $ci->load->library('upload');
    $ci->upload->initialize($config);

    if (!$ci->upload->do_upload($data['name'])) {
        log_message('error', 'Upload image error: '.$ci->upload->display_errors());
    } else {
        $upload_data = $this->upload->data();

        $img_url = base_url().'assets/uploads/'.$data['upload_dir']. $upload_data['file_name'];

        return $img_url;
    }
    
    return false;
}

// Encryption data
function encryption($data, $key_data)
{
    $ci =& get_instance();
    $ci->load->library('encryption');

    $key = base64_encode($key_data);

    // Set encrypt type
    $ci->encryption->initialize(
        array(
            'cipher' => 'aes-256',
            'mode' => 'ctr',
            'key' => $key
        )
    );

    return $ci->encryption->encrypt($data);
}

// Decryption data
function decryption($data, $key_data)
{
    $ci =& get_instance();

    $ci->load->library('encryption');

    $key = base64_encode($key_data);

    // Set encrypt type
    $ci->encryption->initialize(
        array(
            'cipher' => 'aes-256',
            'mode' => 'ctr',
            'key' => $key
        )
    );
    return $ci->encryption->decrypt($data);
}

// Password hashing
function bcrypt($password)
{
    $password_encode = base64_encode($password);

    $options = [
        'cost' => 12
    ];
    
    return password_hash($password_encode, PASSWORD_BCRYPT, $options);
}

// Verify password
function verify_bcrypt($password, $hash)
{
    $password_endcode = base64_encode($password);

    if (password_verify($password_endcode, $hash)) {
        return true;
    }
    return false;
}

// Check session
function checkSession($user_id, $session_id)
{
    
}