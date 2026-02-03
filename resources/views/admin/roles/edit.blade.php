<div class="modal-content">
    @csrf
    @method('put')
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="tag">Role Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter Role" value="{{ $role->name }}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</div>
