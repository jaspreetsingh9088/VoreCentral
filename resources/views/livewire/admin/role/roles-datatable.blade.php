<div class="card">
    <div class="card-header">
        <h3 class="card-title">Roles List</h3>
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
                    <th>Role</th>
                    <th>Visible</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            <x-admin.common.role-check :type="'update'">
                                <button type="button" class="btn btn-primary"
                                    onclick="visibletabs(this, {{ $role->id }})">
                                    <i class="fas fa-eye"></i>
                                    <span class="sr-only">Visible Tabs</span>
                                </button>
                            </x-admin.common.role-check>
                        </td>
                        <td>
                            <x-admin.common.role-check :type="'update'">
                                <button type="button" class="text-primary mr-2 border-0 bg-transparent"
                                    onclick="editrole(this, {{ $role->id }})">Edit</button>
                            </x-admin.common.role-check>
                            <x-admin.common.role-check :type="'delete'">
                                <button type="button" class="text-danger mr-2 border-0 bg-transparent"
                                    wire:click="destory({{ $role->id }})">Delete</button>
                            </x-admin.common.role-check>
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
                Showing {{ $roles->firstItem() ? $roles->firstItem() : 0 }} to
                {{ $roles->lastItem() ? $roles->lastItem() : 0 }} of {{ $roles->total() }} records
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        function visibletabs(e, id) {
            addLoader(e);
            $.ajax({
                url: "{{ url('admin/roles') }}/" + id,
                type: 'get',
                success: function($response) {
                    console.log();
                    $("#visibletabsform").attr('action', $response.data.url);
                    $("#visibletabsform").html($response.data.html);
                    $('#visibletabs').modal('show');
                    removeLoader(e);
                },
                error: function($response) {
                    console.log($response.responseJSON.message);
                    removeLoader(e);
                }
            });
        }
    </script>
@endpush
