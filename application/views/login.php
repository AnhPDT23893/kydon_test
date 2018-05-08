<div class="wrap-site">
    <header class="hidden-xs hidden-sm">
    </header>
    <main class="main-content">
        <div class="form-sing-in-up text-center">
            <h2 class="title-page font_size_18 text-uppercase color-dark">ĐĂNG NHẬP TÀI KHOẢN</h2>
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
            <?php echo form_open('sign_in');?>
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
            </div>        
            <button type="submit" class="btn btn-main font_size_normal">ĐĂNG NHẬP</button>
            <?php echo form_close();?>
            <div class="choose-diff">
                <div class="choose__direct">
                    <div class="choo__singup text-left">
                        Bạn chưa có tài khoản? <a href="/register" class="primary_color"><b>Đăng ký</b></a>
                    </div>
                </div>
                        <p class="font_size_14"><i> - Hoặc - </i></p>
                        <div class="choose__face">
                            <a href="javascript:void(0)" class="btn" onclick="return login();">
                                <i class="fa fa-facebook"></i> Đăng Nhập Qua Facebook
                            </a>
                        </div>
            </div>
        </div>
    </main>
</div>