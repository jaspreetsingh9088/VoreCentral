<div>
    <div class="form-check">
        <input type="radio" class="form-check-input"
               name="type" id="normal" value="normal" autocomplete="off" wire:model="type">
        <label for="normal">Normal Employee</label>
    </div>
    <div class="form-check">
        <input type="radio" class="form-check-input"
               name="type" id="moderator" value="moderator" autocomplete="off" wire:model="type">
        <label for="moderator">Moderator Employee</label>
    </div>
    @if($type === "moderator")
        <div class="form-group">
            <label for="email">Email</label>
            <select class="select2 form-control" name="email" id="newemail" wire:model="selected_user">
                @foreach($users as $user)
                    <option value="{{$user->email}}">{{$user->email}}</option>
                @endforeach
            </select>
        </div>
        <script>
            document.addEventListener('livewire:load', function () {
                $(document).ready(function () {
                    $('#newemail').select2();
                });
            });
            $(document).ready(function () {
                $('#newemail').select2();
            });
        </script>
    @else
        <div class="form-group">
            <label for="newemail">Email</label>
            <input type="email" class="form-control" name="email" id="newemail"
                   placeholder="Enter email" autocomplete="off">
        </div>
    @endif

</div>

