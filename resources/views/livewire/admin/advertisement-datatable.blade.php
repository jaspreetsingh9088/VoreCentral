<div class="card">
    <div class="card-header">
        <h3 class="card-title">Advertisement List</h3>
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
                    <th>S.No.</th>
                    <th>Name </th>
                    <th>Horizontal Advertisement</th>
                    <th>Vertical Advertisement </th>
                    <th>Activate/Deactivate</th>
                    <!-- <th>Actions</th> -->
                </tr>
            </thead>
            <tbody>
                @forelse($ads_item as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        @if($item->content1!="")
                        <td>{!!$item->content1!!}</td>
                        @elseif($item->getRawOriginal('image1')!="")
                        <td><img src="{{ $item->image1 }}" style=" height:50px; width:200px" alt=""></td>
                        @else
                        <td>&nbsp;</td>
                        @endif

                        
                        
                        @if($item->content2!="")
                        <td>{!!$item->content2!!}</td>
                        @elseif($item->getRawOriginal('image2')!="")
                        <td><img src="{{ $item->image2 }}" style=" height:100px; width:100px" alt=""></td>
                        @else
                        <td>&nbsp;</td>
                        @endif
    
                        <td>
                            @if($item->status == 1)
                                <a class="btn btn-sm btn-danger" href="{{ URL::to('admin/advertisement/status/'.$item->id.'/0') }}">De-activate</a>
                            @elseif($item->status == 0)
                                <a class="btn btn-sm btn-success" href="{{ URL::to('admin/advertisement/status/'.$item->id.'/1') }}">Active</a>
                            @endif

                            {{-- <a href="{{ URL::to('admin/advertisement/status/'.$item->id.'/'.$item->status) }}"
                                class="<?php echo ($item->status==1?'btn btn-success':'btn btn-danger'); ?> mb-2">
                                <span class="fw-600"><?php echo ($item->status==1?'Activate':'De-activate'); ?></span>
                            </a> --}}
                        </td>
                        <!-- <td>
                            <button type="button" class="text-primary mr-2 border-0 bg-transparent"
                                onclick="edittag(this, {{ $item->id }})">Edit</button>
                            <button type="button" class="text-danger mr-2 border-0 bg-transparent"
                                wire:click="destory({{ $item->id }})">Delete</button>



                        </td> -->
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
                Showing {{ $ads_item->firstItem() ? $ads_item->firstItem() : 0 }} to
                {{ $ads_item->lastItem() ? $ads_item->lastItem() : 0 }} of
                {{ $ads_item->total() }}
                records
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    {{ $ads_item->links() }}
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
