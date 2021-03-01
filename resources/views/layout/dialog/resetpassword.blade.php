<div data-backdrop="false" class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog"
    aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetPasswordModalLabel">Đổi mật khẩu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="alert alert-soft-warning" style="display: none">
                    <div class="d-flex flex-wrap">
                        <div class="mr-8pt">
                            <i class="material-icons">check_circle</i>
                        </div>
                        <div class="flex" style="min-width: 180px">
                            <small class="text-black-100 alert_content">
                                Email hướng dẫn đổi mật khẩu đã được gửi cho bạn nếu email/username của bạn tồn tại
                                trong hệ thống.
                            </small>
                        </div>
                    </div>
                </div>

                <form>
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Email/Username:</label>
                        <input id="email" type="text" class="form-control" placeholder="Email đăng ký hoặc username của bạn ...">
                        <small class="form-text text-muted">Chúng tôi sẽ gửi email hướng dẫn đổi mật khẩu cho
                            bạn.</small>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button id="resetPswdBtn" class="btn btn-primary" data-dismiss="alert">Đổi mật khẩu</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>