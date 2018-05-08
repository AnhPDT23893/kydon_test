<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model(['user_model']);
        $this->load->helper(['form', 'url', 'url_helper', 'test_helper']);
        $this->load->library(['session', 'form_validation', 'email', 'upload', 'encryption', 'image_lib']);
        $this->load->config('test');
    }

    public function loginFB()
    {
        $res = [
            'status' => false,
            'url' => '',
            'messages' => null
        ]
        $postData = $this->input->post();

        if (isset($postData['id']) && !empty($postData['id'])) {
            if (isset($postData['email']) && !empty($postData['email'])) {
                $user = $this->user_model->getByEmail($postData['email']);
                $saved = true;
                if ($user) {
                    if (!$this->db->where('id', $user->id)->update('user', ['fb_id' => $postData['id'], 'fb_profile' => $postData['link']])) {
                        $saved = false;
                    }
                } else {
                    $insertData = [
                        'name' => $postData['name'],
                        'email' => $postData['email'],
                        'fb_id' => $postData['id'],
                        'fb_profile' => 'https://www.facebook.com/app_scoped_user_id/'.$postData['id'].'/',
                        'status' => 1,
                        'created_at' => date('Y-m-d H:i:s', time()),
                        'updated_at' => date('Y-m-d H:i:s', time()),
                    ];

                    if (!$this->db->insert('user', $insertData)) {
                        $saved = false;
                    }
                }
                if ($saved) {
                    $res['status'] = true;

                    $user = $this->user_model->getByEmail($postData['email']);

                    // Create session login
                    $this->session->set_userdata(['logged_in' => $user]);

                    $res['url'] = base_url() . 'info';
                } else {
                    $message = 'Đã có lỗi xảy ra. Vui lòng thử lại sau';
                }
            } else {
                $user = $this->user_model->getByFbID($postData['id']);

                $this->db->where('id', $user->id)->update('user', ['SID' => base64_encode(time())]);
                if (!$user) {
                    $insertData = [
                        'name' => $postData['name'],
                        'fb_id' => $postData['id'],
                        'fb_profile' => 'https://www.facebook.com/app_scoped_user_id/'.$postData['id'].'/',
                        'status' => 1,
                        'created_at' => date('Y-m-d H:i:s', time()),
                        'updated_at' => date('Y-m-d H:i:s', time()),
                    ];

                    $this->db->insert('user', $insertData);

                    $user = $this->user_model->getUser($this->db->insert_id());
                    $res['status'] = true;
                    // Create session login
                    $this->session->set_userdata(['logged_in' => $user]);

                    $res['url'] = base_url() . 'info';
                }
            }
        } else {
            $message = 'Đã có lỗi xảy ra. Vui lòng thử lại';
        }

        return $this->output->set_content_type('application/json')
            ->set_output(json_encode($res));
    }


    public function login()
    {
        $this->session->unset_userdata(['logged_in', 'url_return']);
        $getData = $this->input->get();
        if (!empty($getData)) {
            // Create session url return
            $this->session->set_userdata('url_return', $getData);
        }
        if ($this->session->userdata('logged_in')) {
            $url_return = $this->session->userdata('url_return');

            if (!empty($url_return)) {
                $return_url = $this->_processGetData($url_return, $this->session->userdata('logged_in'));

                if (!empty($return_url)) {
                    return redirect($return_url);
                }
            }

            return redirect('info');
        }
        // Get title
        $data['title'] = 'Đăng nhập';

        // Get content
        $data['content'] = 'login';

        // Get messages form validate
        $data['messages'] = $this->session->flashdata('messages');

        return $this->load->view('layout/login', $data);
    }

    /**
     * Sign in function
     */
    public function sign_in()
    {
        $postData = $this->input->post();

        if ((isset($postData['getData']) && !empty($postData['getData']))) {
            // Parse string data return link
            parse_str($postData['getData'], $arr);

            // Create session url return
            $this->session->set_userdata('url_return', $arr);
        }

        // Validate rules
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]|max_length[30]');

        $this->form_validation->set_message('required', 'Vui lòng nhập trường này');
        $this->form_validation->set_message('min_length', '{field} phải lớn hơn {param} kí tự.');
        $this->form_validation->set_message('max_length', '{field} phải nhỏ hơn {param} kí tự.');
        $this->form_validation->set_message('valid_email', '{field} không đúng định dạng email.');

        if ($this->form_validation->run() == FALSE) {
            // Set data flash validate
            $form_validate = [
                'email' => form_error('email'),
                'password' => form_error('password'),
            ];

            $this->session->set_flashdata('messages', ['form_validate' => $form_validate]);
        } else {
            $user = $this->_login($postData);
            if ($user) {
                $url_return = $this->session->userdata('url_return');

                if (!empty($url_return)) {
                    $return_url = $this->_processGetData($url_return, $user);

                    if (!empty($return_url)) {
                        return redirect($return_url);
                    }
                }
                $this->session->set_flashdata('messages', ['success' => 'Đăng nhập thành công!']);
                return redirect('info');
            }
        }

        // Get title
        $data['title'] = 'Đăng nhập';

        // Get content
        $data['content'] = 'login';

        // Get messages form validate
        $data['messages'] = $this->session->flashdata('messages');

        $data['email'] = $postData['email'];
        $data['password'] = $postData['password'];

        return $this->load->view('layout/login', $data);
    }

    /**
     * @return mixed
     */
    public function register()
    {
        // Get title
        $data['title'] = 'Đăng kí';

        // Get content
        $data['content'] = 'register';


        // Get messages form validate
        $data['messages'] = $this->session->flashdata('messages');

        return $this->load->view('layout/login', $data);
    }

    /**
     * Sign up
     */
    public function sign_up()
    {
        $res = [
            'status' => false,
            'messages' => null
        ];

        $postData = $this->input->post();

        // Validate rules
        $this->form_validation->set_rules('name', 'Họ và tên', 'required');
        $this->form_validation->set_rules('username', 'Tên đăng nhập', 'required|min_length[3]|max_length[30]|alpha_dash|is_unique[user.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]|max_length[50]');
        $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]|max_length[30]');
        $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'required|min_length[6]|max_length[30]|matches[password]');
        // $this->form_validation->set_rules('gender', 'Giới tính', 'required');
        $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|min_length[10]|max_length[11]');

        // Set messages validation
        $this->form_validation->set_message('required', 'Vui lòng nhập trường {field}');
        $this->form_validation->set_message('min_length', '{field} phải lớn hơn {param} kí tự.');
        $this->form_validation->set_message('max_length', '{field} phải nhỏ hơn {param} kí tự.');
        $this->form_validation->set_message('is_unique', '{field} đã tồn tại.');
        $this->form_validation->set_message('valid_email', '{field} không đúng định dạng email.');
        $this->form_validation->set_message('alpha_dash', '{field} chỉ bao gồm kí tự chữ, số, dấu gạch chân và dấu gạch ngang.');
        $this->form_validation->set_message('matches', '{field} phải giống với {param}.');

        if ($this->form_validation->run() == FALSE) {
            // Set data flash validate
            if (form_error('fullname')) {
                $res['messages'][] = form_error('fullname');
            }
            if (form_error('username')) {
                $res['messages'][] = form_error('username');
            }
            if (form_error('email')) {
                $res['messages'][] = form_error('email');
            }
            if (form_error('password')) {
                $res['messages'][] = form_error('password');
            }
            if (form_error('re_password')) {
                $res['messages'][] = form_error('re_password');
            }
            if (form_error('phone')) {
                $res['messages'][] = form_error('phone');
            }


        } else {
            $postData['birthday'] = date('Y-m-d', strtotime($postData['birthday']));

            // Set link
            if ($user = $this->user_model->insert($postData)) {
                $this->session->set_userdata(['logged_in' => $user]);
                $res['status'] = true;
                $res['url'] = '/info';
            } else {
                $res['messages'][] = 'Đã có lỗi xảy ra. Vui lòng thử lại';
            }

        }

        return $this->output->set_content_type('application/json')
            ->set_output(json_encode($res));
    }
    
    public function register_success()
    {
        // Get title
        $data['title'] = 'Đăng kí thành công';

        // Get content
        $data['content'] = 'register_success';

        // Get messages form validate
        $data['messages'] = $this->session->flashdata('messages');

        return $this->load->view('layout/login', $data);
    }

    /**
     * @return mixed
     */
    public function forgot_password()
    {
        // Get title
        $data['title'] = 'Quên mật khẩu';

        // Get content
        $data['content'] = 'forgot_password';

        // Get messages form validate
        $data['messages'] = $this->session->flashdata('messages');

        return $this->load->view('layout/login', $data);
    }

    /**
     * Show info
     */
    public function info()
    {
        if ($this->session->userdata('logged_in')) {
            // Get current user
            $user = $this->session->userdata('logged_in');

            // Check session id
            // Get title
            $data['title'] = 'Thông tin người dùng';

            // Get content
            $data['content'] = 'info';

            // Get user
            $data['user'] = $user;

            // Get messages
            $data['messages'] = $this->session->flashdata('messages');

            return $this->load->view('layout/app', $data);


        } else {
            $this->session->set_flashdata('messages', ['error' => 'Chúng tôi không tìm thấy thông tin tài khoản của bạn. Vui lòng đăng nhập lại']);
        }

        return redirect('login', 'refresh');
    }

    /**
     * Update info
     */
    public function update()
    {
        $postData = $this->input->post();

        if ($this->session->userdata('logged_in')) {
            $user = $this->session->userdata('logged_in');
            
            $postData['id'] = $user->id;
            // Update avatar
            if (isset($_FILES['avatar']) && $_FILES['avatar']['size'] > 0) {
                // Upload logo
                $upload_dir = './uploads/avatars/';
                $config['file_name'] = $user->id;
                $config['upload_path'] = $upload_dir;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['overwrite'] = true;
                $config['max_size'] = 1024 * 5 * 1000;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('avatar')) {
                    log_message('error', 'Upload image error: ' . $this->upload->display_errors());

                    $this->session->set_flashdata('messagges', ['error' => 'Lỗi tải ảnh lên. Vui lòng thử lại']);
                } else {
                    $upload_data = $this->upload->data();

                    $avatar_url = base_url() . 'uploads/avatars/' . $upload_data['file_name'];

                    $postData['avatar'] = $avatar_url;
                }
            }

            // Set birthday
            $postData['birthday'] = date('Y-m-d', strtotime($postData['birthday']));

            // Update data;
            $user_update = $this->user_model->update($postData);

            if ($user_update) {
                $this->session->set_userdata('logged_in', $user_update);
            }

            return redirect('info', 'refresh');
        } else {
            $this->session->set_flashdata('messages', ['error' => 'Chúng tôi không tìm thấy thông tin tài khoản của bạn. Vui lòng đăng nhập lại']);
        }

        return redirect('login', 'refresh');
    }

    /**
     * Logout function
     */
    public function logout()
    {
        // Get current user
        $user = $this->session->set_userdata('logged_in');

        // Delete session logged_in
        $this->session->unset_userdata(['logged_in', 'SID', 'url_return']);

        $getData = $this->input->get();
        if (isset($getData) && !empty($getData)) {
            $return_url = $this->_processGetData($getData);

            if (!empty($return_url)) {
                return redirect($return_url);
            }
        }

        return redirect('login', 'refresh');
    }

    /**
     * Check user login
     *
     * @param $email
     * @param $password
     * @return bool
     */
    private function _login($data)
    {
        $user = $this->user_model->getByEmail($data['email']);

        if ($user && verify_bcrypt($data['password'], $user->password)) {
            if ($user->status == 1) {
    
                // Create session login
                $this->session->set_userdata(['logged_in' => $user]);

                return $user;
            } else {
                $this->session->set_flashdata('messages', ['error' => 'Tài khoản của bạn đã bị xóa']);
            }
        } else {
            $this->session->set_flashdata('messages', ['error' => 'Email hoặc mật khẩu không đúng. Vui lòng thử lại']);
        }

        return false;
    }
}
