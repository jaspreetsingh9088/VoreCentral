<div class="card">
    <div class="card-header">
        <h3 class="card-title">Forum category List</h3>
        <div class="card-tools">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" wire:model="search">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($forumcategories as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" onclick="edittag(this, {{ $item->id }})">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('Forum category',`{{ route('admin.forumcategory.delete',[$item->id]) }}`)">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">No More Data Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-md-6">
                Showing {{ $forumcategories->firstItem() ? $forumcategories->firstItem() : 0 }} to
                {{ $forumcategories->lastItem() ? $forumcategories->lastItem() : 0 }} of {{ $forumcategories->total() }} records
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    {{-- {{ $forumcategories->links('vendor.pagination.adminpanel') }} --}}
                    {{ $forumcategories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
