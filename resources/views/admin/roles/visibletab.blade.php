<div class="modal-content">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Role Permissions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Visible</th>
                    <th scope="col">Name</th>
                    <th scope="col">Add</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tabs as $tab)
                    @php
                        $vis = $rolevisibles->where('tab_id', $tab->id)->first();
                        $authcheck = $authtabs->where('tab_id', $tab->id)->first();
                    @endphp
                    <tr>
                        <td>
                            <input type="checkbox" class="mainTab" value="1"
                                data-target="subTab{{ $tab->id }}" name="tab[{{ $tab->id }}][visible]"
                                @checked(isset($vis) && $vis->visible)>
                        </td>
                        <td>{{ $tab->name }}</td>
                        <td>
                            @if ((isset($authcheck) && $authcheck->add_row) || Auth::user()->role_id == null)
                                <input type="checkbox" class="subTab{{ $tab->id }}" value="1"
                                    name="tab[{{ $tab->id }}][add]"
                                    @if (!isset($vis)) disabled @endif @checked(isset($vis) && $vis->add_row)>
                            @endif
                        </td>
                        <td>
                            @if ((isset($authcheck) && $authcheck->update_row) || Auth::user()->role_id == null)
                                <input type="checkbox" class="subTab{{ $tab->id }}" value="1"
                                    name="tab[{{ $tab->id }}][update]"
                                    @if (!isset($vis)) disabled @endif @checked(isset($vis) && $vis->update_row)>
                            @endif
                        </td>
                        <td>
                            @if ((isset($authcheck) && $authcheck->delete_row) || Auth::user()->role_id == null)
                                <input type="checkbox" class="subTab{{ $tab->id }}" value="1"
                                    name="tab[{{ $tab->id }}][delete]"
                                    @if (!isset($vis)) disabled @endif @checked(isset($vis) && $vis->delete_row)>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">You Not have any Tab permission</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</div>
<script>
    $(".mainTab").on('change', function() {
        var subClass = $(this).data('target');
        if ($(this).prop("checked") == true) {
            $('.' + subClass).attr('disabled', false);
        } else {
            $('.' + subClass).attr('disabled', true);
        }
        $('.' + subClass).prop('checked', $(this).prop("checked"));
    });
</script>
