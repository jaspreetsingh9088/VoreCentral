<div class="modal-content">
    @csrf
    @method('put')
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Subscription</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
        <label for="tag">Title</label>
        <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{ $subscription->title }}">
        </div>
        <div class="form-group">
        <label for="tag">Price</label>
        <input type="text" class="form-control" name="price" placeholder="Enter Price" value="{{ $subscription->price }}">
        </div>
        <div class="form-group">
        <label for="tag">Duration</label>
        <input type="text" class="form-control" name="duration" placeholder="Enter Duration" value="{{ $subscription->duration }}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</div>
