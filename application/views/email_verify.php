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
            <h2 class="title-page font_size_18 text-uppercase color-dark">Đăng ký email</h2>
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
            <div class="title__sub text-center">
                <p>
                    <i>
                        Vui lòng nhập email của bạn để có thể đăng nhập
                    </i>
                </p>
            </div>
            <?php echo form_open('user/fb-add-email');?>
            <div class="form-group">
                <input type="email" name="email" value="<?= isset($email) ? $email : ''?>" class="form-control" placeholder="Email">
                <?php if (isset($messages['form_validate']['email']))  echo $messages['form_validate']['email']; ?>
            </div>
            <button type="submit" class="btn btn-main font_size_normal">Gửi</button>
            <?php echo form_close();?>
        </div>
    </main>
    <footer>
        <p class="text-center font_size_12">Bản quyền nội dung thuộc về <a href="#" class="primary_color">Dodaihoc.com</a> - Mọi hành vi sao chép đều không được chấp thuận</p>
    </footer>
</div>