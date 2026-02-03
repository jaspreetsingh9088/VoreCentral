<div class="card">
    <div class="card-header">
        <h3 class="card-title">Users List</h3>
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
                    <th>Images</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Date Of Birth</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>
                            <img src="{{ $user->image }}" alt="profileimg" class="img-thumbnail size-px-80">
                        </td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->dob }}</td>
                        <td>
                            <livewire:admin.common.toogle-button :data="$user" wire:key="{{ $loop->index }}" />
                        </td>
                        <td>
                            <a href="{{ route('admin.users.show', $user) }}" class="text-primary">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No More Data Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-md-6">
                Showing {{ $users->firstItem() ? $users->firstItem() : 0 }} to
                {{ $users->lastItem() ? $users->lastItem() : 0 }} of {{ $users->total() }} records
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
