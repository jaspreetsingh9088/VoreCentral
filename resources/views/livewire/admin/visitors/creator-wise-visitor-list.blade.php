@push('links')
    <link href="{{ url('public/assets/css/select2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        .select2-selection {
            height: 100% !important;
        }
    </style>
@endpush

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4">
                <h3 class="card-title">Creator Wise Visitor List</h3>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4 mt-2">
                        <input type="text" wire:model="start_date" id="start-date-picker" class="form-control"/>
                    </div>
                    <div class="col-md-4 mt-2">
                        <input type="text" wire:model="end_date" id="end-date-picker" class="form-control"/>
                    </div>
                    <div class="col-md-4 d-flex mt-2">
                        <select wire:model="creator_id" class="select2 w-100 h-100">
                            <option>--select creator--</option>
                            @foreach ($creators as $creator)
                                <option value="{{ $creator->id }}">{{ $creator->username }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-primary ml-2 select2-clear">Clear</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th>Creator</th>
                <th>Count</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($visitors as $visitor)
                <tr>
                    <td>
                        {{ $visitor->creator->username??""  }}
                    </td>
                    <td>
                        {{ $visitor->visits_count }}
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
                    {{ $visitors->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script src="{{ url('public/assets/js/select2.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            var selectElement = $('.select2').select2();
            $('.select2').on('change', function () {
                let data = $(this).select2('data');
                @this.
                set('creator_id', data.map(item => item.id));
            });

            Livewire.on('reset-select2', function () {
                selectElement.select2();
            });

            $(".select2-clear").on("click", function () {
                @this.
                set('creator_id', null);
                @this.
                set('start_date', null);
                @this.
                set('end_date', null);
            })
        });

        flatpickr("#start-date-picker", {
            // Configure the options for the start date picker
            dateFormat: "Y-m-d",
            // You can add more options as needed
        });

        flatpickr("#end-date-picker", {
            // Configure the options for the end date picker
            dateFormat: "Y-m-d",
            // You can add more options as needed
        });

    </script>
@endpush
