@extends('admin')

@section('content')

<div style="display:flex; justify-content:center; padding-top:50px">
    <div onclick="createEstablishment()">
        <label class="btn btn-primary">New Establishment</label>
    </div>
    <div class="justify-content-center text-dark" style="display:inline-block; padding: 50px; background-color:rgba(255,255,255,0.7);">
        <form action="{{ url('/establishments') }}" method="POST" class="form-group">
            @csrf
            <div class="mb-3">
                <input class="form-control" name="search" type="text" id="search" placeholder="Search by name..." autofocus></input>
                <button hidden type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        @foreach($establishments as $establishment)
        <div class="mb-1" style="cursor: pointer;" onclick="showEstablishment({{$establishment->id}})">
            <h5 class="card-header">
                <span class="text-dark">{{ $establishment->name }}</span>
            </h5>
        </div>
        @endforeach
        <div class="text-center d-flex justify-content-center" style="padding-top:50px;">
            {{ $establishments->links() }}
        </div>
    </div>
    <script>
        function showEstablishment(id) {
            window.location.href = `{{url('/establishment/')}}/${id}`;
        }

        function createEstablishment() {
            window.location.href = '/establishmentadd';
        }
    </script>
</div>
@endsection