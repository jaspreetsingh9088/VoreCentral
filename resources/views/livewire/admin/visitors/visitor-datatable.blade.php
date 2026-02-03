<div class="card">
    <div class="card-header">
        <h3 class="card-title">Visitors List</h3>
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
                <th>User</th>
                <th>Creator</th>
                <th>Link</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($visitors as $visitor)
                <tr>
                    <td>
                        {{ $visitor->user->username??""  }}
                    </td>
                    <td>
                        {{ $visitor->creator->username??""  }}
                    </td>
                    <td>
                        {{ $visitor->link }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No More Data Found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-md-6">
                Showing {{ $visitors->firstItem() ? $visitors->firstItem() : 0 }} to
                {{ $visitors->lastItem() ? $visitors->lastItem() : 0 }} of {{ $visitors->total() }} records
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    {{ $visitors->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
