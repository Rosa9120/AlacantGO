@extends('admin')

@section('content')

<div style="display:flex; justify-content:center; padding-top:35px">
    <div class="m-3 justify-content-center text-dark" style="display:inline-block; padding: 20px; background-color:rgba(255,255,255,0.7);">

        <p href="{{ url('/brands/establishmentNotFound', ['inexistent_name' => $inexistent_name]) }}">
        <?php echo "There is not any establishment called  $inexistent_name"; ?>
        </p>

    </div>
</div>
@endsection