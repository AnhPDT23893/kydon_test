<div class="form-sing-in-up text-center">
    <h2 class="title-page font_size_18 text-uppercase color-dark">Lỗi xác nhận</h2>
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
        <a href="/login" class="btn btn-main font_size_normal">Quay về đăng nhập</a>
    </div>
</div>