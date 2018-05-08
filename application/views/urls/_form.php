<div class="form-sing-in-up text-center">
    <h2 class="title-page font_size_18 text-uppercase color-dark"><?= $title;?></h2>
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
    <?php if (isset($url)):?>
        <?php echo form_open('redirect_url/update/'.$url->id);?>
    <?php else:?>
        <?php echo form_open('redirect_url/store');?>
    <?php endif;?>
        <div class="form-group">
            <input type="text" name="host" value="<?= isset($url) ? $url->host : '';?>" class="form-control" placeholder="Liên kết (Ex: dodaihoc.com)">
            <?php if (isset($messages['form_validate']['host']))  echo $messages['form_validate']['host']; ?>
        </div>
        
        <button type="submit" class="btn btn-main font_size_normal"><?= isset($url) ? 'Cập nhật' : 'Thêm';?></button>
        <?php echo form_close();?>
</div>