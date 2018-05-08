<div class="wrap-site">
    <header class="hidden-xs hidden-sm">
        <div class="logo text-center">
            <a href="#">
                <img src="../../../assets/images/logo.png" alt="Logo">
            </a>
        </div>
    </header>
    <main class="main-content">
        <div class="form-sing-in-up text-center">
            <h2 class="title-page font_size_18 text-uppercase color-dark">Thay đổi mật khẩu</h2>
            <!-- Alert -->
            <?php if (isset($messages)):?>
                <?php foreach ($messages as $key => $message):?>
                    <?php if ($key == 'success'):?>
                        <div class="alert alert-success alert-dismissable fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $message;?>
                        </div>
                    <?php endif;?>
                    <?php if ($key == 'error'):?>
                        <div class="alert alert-danger alert-dismissable fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $message;?>
                        </div>
                    <?php endif;?>
                <?php endforeach;?>
            <?php endif;?>
            <?php echo form_open('user/change_password');?>
            <input type="hidden" name="email" value="<?php echo $this->input->get('email');?>">
            <input type="hidden" name="_token" value="<?php echo $this->input->get('token');?>">
            <div class="form-group">
                <input type="password" name="new_password" value="" class="form-control" placeholder="Mật khẩu mới">
                <?php if (isset($messages['form_validate']['new_password']))  echo $messages['form_validate']['new_password']; ?>
            </div>
            <div class="form-group">
                <input type="password" name="re_new_password" value="" class="form-control" placeholder="Nhập lại mật khẩu mới">
                <?php if (isset($messages['form_validate']['re_new_password']))  echo $messages['form_validate']['re_new_password']; ?>
            </div>
            <button type="submit" class="btn btn-main font_size_normal">Thay đổi mật khẩu</button>
            <?php echo form_close();?>
        </div>
    </main>
    <footer>
        <p class="text-center font_size_12">Bản quyền nội dung thuộc về <a href="#" class="primary_color">Dodaihoc.com</a> - Mọi hành vi sao chép đều không được chấp thuận</p>
    </footer>
</div>