<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tags List</h3>
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
                @forelse ($tags as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>
                            <button type="button" class="text-primary mr-2 border-0 bg-transparent"
                                onclick="edittag(this, {{ $item->id }})">Edit</button>
                            <button type="button" class="text-danger mr-2 border-0 bg-transparent"
                                wire:click="destory({{ $item->id }})">Delete</button>
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
                Showing {{ $tags->firstItem() ? $tags->firstItem() : 0 }} to
                {{ $tags->lastItem() ? $tags->lastItem() : 0 }} of {{ $tags->total() }} records
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    {{ $tags->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
