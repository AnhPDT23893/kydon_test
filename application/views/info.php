<div class="content-top">
    <h4>Thông tin người dùng</h4>
</div>
<h5 class="error-phone"><?php if (isset($messages['phone_validation']))  echo $messages['phone_validation']; ?></h5>
<div class="content-bottom">
    <?php echo form_open_multipart('user/update', ['class' => 'form-horizontal form-update']);?>
    <div class="profile-detail row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label">Ảnh đại diện</label>
                <div class="col-md-8">
                    <div class="profile-avatar">
                        <?php if (!empty($user->avatar)):?>
                            <img src="<?php echo $user->avatar .'?nocache='.time();?>" alt="Avatar">
                        <?php else:?>
                            <img src="../../assets/images/avatar/male.gif" alt="Avatar">
                        <?php endif;?>
                        <label class="label-avatar" for="user-avatar" title="Thay đổi ảnh đại diện"><i class="fa fa-camera-retro fa-2x" aria-hidden="true"></i></label>
                    </div>
                    <input type="file" name="avatar" id="user-avatar">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Họ và tên</label>
                <div class="col-md-8">
                    <input type="text" name="name" value="<?php echo $user->name;?>" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Tên đăng nhập</label>
                <div class="col-md-8">
                    <input type="text" name="username" value="<?php echo $user->username;?>" class="form-control" disabled>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-3 control-label">Email</label>
                <div class="col-md-8">
                    <input type="email" name="email" value="<?= $user->email;?>" class="form-control" disabled>
                </div>
            </div>
            
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label">Số điện thoại</label>
                <div class="col-md-8">
                    <input type="text" name="phone" value="<?= $user->phone;?>" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Ngày sinh</label>
                <div class="col-md-8 form-inline">
                    <input type="text" name="birthday" id="date-picker" value="<?php echo date('d-m-Y', strtotime($user->birthday))?>" placeholder="Ngày sinh">
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <button type="submit" class="btn btn-primary btn-info-update">Cập nhật</button>
    </div>
    <?php echo form_close();?>
</div>

