<div class="card">
    <div class="card-header">
        <h3 class="card-title">Employee List</h3>
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
                <th>Name</th>
                <th>Role</th>
                <th>Email</th>
                <th>Moderator</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($employees as $emp)
                <tr>
                    <td>{{ $emp->name }}</td>
                    <td>{{ $emp->role->name }}</td>
                    <td>{{ $emp->email }}</td>
                    <td>
                        @if(isset($emp->user))
                            <span class="badge badge-success">Moderator</span>
                        @else
                            <span class="badge badge-primary">Normal</span>
                        @endif
                    </td>
                    @if (Auth::user()->admin_id == null)
                        <td>{{ $emp->parent->name }}</td>
                    @endif
                    <td class="d-flex justify-content-start">
                        <x-admin.common.role-check :type="'update'">
                            <a href="{{ route('admin.employees.edit', $emp) }}"
                               class="text-primary mr-2 border-0 bg-transparent">Edit</a>
                        </x-admin.common.role-check>
                        <x-admin.common.role-check :type="'delete'">
                            <button type="button" class="text-danger mr-2 border-0 bg-transparent"
                                    wire:click="destory({{ $emp->id }})">Delete
                            </button>
                        </x-admin.common.role-check>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="@if (auth()->user()->admin_id == null) 5 @else 4 @endif">No More Data Found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-md-6">
                Showing {{ $employees->firstItem() ? $employees->firstItem() : 0 }} to
                {{ $employees->lastItem() ? $employees->lastItem() : 0 }} of {{ $employees->total() }} records
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
