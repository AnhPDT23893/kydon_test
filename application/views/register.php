<div class="wrap-site wrap-register">
    <header class="hidden-xs hidden-sm">
    
    </header>
    <main class="main-content">
        <div class="form-sing-in-up text-center">
            <h2 class="title-page font_size_18 text-uppercase color-dark">ĐĂNG KÝ TÀI KHOẢN</h2>
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
            <?php echo form_open('/sign_up', ['class' => 'form-horizontal form-register']);?>
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Họ và tên">
            </div>
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập">
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" name="phone" class="form-control" placeholder="Mobile (09xxxx, 01xxxx)">
            </div>
            <div class="form-group">
                <input id="date-picker" type="text" name="birthday" class="form-control" placeholder="Ngày sinh">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu >= 6 ký tự" minlength="5">
            </div>
            <div class="form-group">
                <input type="password" name="re_password" class="form-control" placeholder="Nhập lại mật khẩu" minlength="6">
            </div>
            <div class="error"></div>
            <button type="button" class="btn btn-main font_size_normal btn-register">ĐĂNG KÝ</button>
            <?php echo form_close();?>
            <div class="choose-diff">
                <p class="choose__singin">
                    Bạn đã có tài khoản?
                    <a href="/login" class="primary_color"><b>Đăng nhập</b></a>
                </p>
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