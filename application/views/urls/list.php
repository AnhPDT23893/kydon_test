<div class="content-top">
    <h4>Quản lý liên kết</h4>
    <a class="btn btn-primary m-t-20" href="/redirect_url/create"><i class="fa fa-plus"></i> Tạo mới</a>
    <a href="/info" class="btn btn-default m-t-20">Quay lại thông tin cá nhân</a>
</div>
<div class="content-bottom">
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
    <div class="profile-detail">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <th>ID</th>
                    <th>Domain</th>
                    <th>Token</th>
                    <th>Trạng thái</th>
                    <th>Người tạo</th>
                    <th>Ngày tạo</th>
                    <th>Hoạt động</th>
                </thead>
                <tbody>
                <?php if (isset($urls) && !empty($urls)):?>
                    <?php foreach ($urls as $url):?>
                    <tr>
                        <td><?= $url->id;?></td>
                        <td><?= $url->host;?></td>
                        <td><?= $url->token;?></td>
                        <td><?= $url->status == 0 ? 'Đang chờ xác nhận' : ($url->status == 1 ? 'Đang hoạt động' : 'Bị Đình chỉ');?></td>
                        <td><?= !empty($url->user) ? $url->user->fullname : '';?></td>
                        <td><?= date('d/m/Y', strtotime($url->created_at));?></td>
                        <td>
                            <a href="/redirect_url/edit/<?= $url->id;?>" class="btn btn-primary btn-sm">Sửa</a>
                            <?php if ($url->status == 0):?>
                            <button type="button" class="btn btn-primary btn-sm btn-process-url" data-toggle="modal" data-target="#modalLink" data-action="redirect_url/process/<?= $url->id;?>" data-status="<?= $url->status;?>">Xác nhận</button>
                            <?php elseif ($url->status == 1):?>
                            <a href="#" class="btn btn-danger btn-sm btn-process-url" data-toggle="modal" data-target="#modalLink" data-action="redirect_url/process/<?= $url->id;?>" data-status="<?= $url->status;?>">Đình chỉ</a>
                            <?php else:?>
                            <a href="#" class="btn btn-warning btn-sm btn-process-url" data-toggle="modal" data-target="#modalLink" data-action="redirect_url/process/<?= $url->id;?>" data-status="<?= $url->status;?>">Hủy đình chỉ</a>
                            <?php endif;?>
                            </td>
                    </tr>
                    <?php endforeach;?>
                <?php else:?>
                    <tr>
                        <td class="text-center" colspan="7"><h5>Chưa có liên kết nào!</h5></td>
                    </tr>
                <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalLink" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Xử lý liên kết</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer text-center">
                    <?php echo form_open('redirect_url/process');?>
                    <input type="hidden" name="status">
                    <button type="submit" class="btn btn-primary">Đồng ý</button>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>

