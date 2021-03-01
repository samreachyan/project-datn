<div data-backdrop="false" class="modal fade" id="editLessonModal" tabindex="-1" role="dialog"
    aria-labelledby="editLessonModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLessonModalLabel">Chỉnh sửa bài học</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Video:</label>
                        <input type="file" class="form-control" placeholder="File Video">
                        <input type="text" class="form-control" placeholder="Hoặc link">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Thông tin:</label>
                        <textarea type="text" class="form-control">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button id="SaveLessonInfo" class="btn btn-primary" data-dismiss="alert">Lưu</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>