<div class="card">
    <div class="card-header">
        <h3 class="card-title">News Archive List</h3>
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
                    <th>Image</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($newsarchive as $item)
                    <tr>
                        <td>
                            <img src="{{ $item->image }}" style=" max-width : 100px;" alt="">
                        </td>
                        <td>{{ $item->title }}</td>
                        <td>
                            <x-admin.common.role-check :type="'update'">
                                <a href="{{ route('admin.newsarchive.edit', $item) }}" class="btn btn-sm btn-success">Edit</a>
                            </x-admin.common.role-check>
                            <a href="{{ route('admin.newsarchive.delete',[$item->id]) }}" type="button" class="btn btn-sm btn-danger">Delete</a>
                            {{-- <a class="btn btn-sm btn-success" href="{{ route('admin.newsarchive.edit',[$item->id]) }}">Edit</a> --}}
                            {{-- <a class="btn btn-sm btn-danger" href="{{ route('admin.newsarchive.destory',[$item->id]) }}">Delete</a> --}}

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
                Showing {{ $newsarchive->firstItem() ? $newsarchive->firstItem() : 0 }} to
                {{ $newsarchive->lastItem() ? $newsarchive->lastItem() : 0 }} of
                {{ $newsarchive->total() }}
                records
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    {{ $newsarchive->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
