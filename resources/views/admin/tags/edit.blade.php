<div class="modal-content">
    @csrf
    @method('put')
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Tag</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="tag">Tag Title</label>
            <input type="text" class="form-control" name="title" placeholder="Enter Role" value="{{ $tag->title }}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</div>
