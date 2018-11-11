@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center"> 
    <div class="col-md-8">
        @foreach($addresses as $address)
        <div class="col-md-8">
            <div class="card mb-2">
                <div class="card-header">
                    Status: {{ $address->status}}</div>

                <div class="card-body">
                   {{ $address->address}}
                   <a href="#" class="btn btn-info" onclick="showMap({!! $address->id !!})">Show Map</a>
                </div>
            </div>
        </div>
        @endforeach
       <center>{{ $addresses->links() }}</center>
    </div>
     <div class="col-md-4" id="gmap">
            Google map here
     </div>
 </div>
</div>
<script>
    function showMap(id) {
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            type: 'post',
            url: 'mapshow',
            data: {
                  'id': id
            },
            success: function(data) {
                $('#gmap').html('');
                var gmap='<iframe style="border:0" src = "https://maps.google.com/maps?q='+data+'&hl=en;z=200&amp;output=embed" width="450" height="400"></iframe>';
                $('#gmap').html(gmap);
                console.log(gmap);
            }
        });
    }

    
</script>
@endsection
