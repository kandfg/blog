<div class="modal fade" id="upload_image" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">上傳圖片</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="/admin/products/upload-image" method='POST' enctype="multipart/form-data">
                <input type="hidden" id="product_id" name="product_id">
                <input type="file"  id="product_image" name="product_image">
                <input type="submit" value="送出">
            </form>
        </div>
      </div>
    </div>
  </div>
