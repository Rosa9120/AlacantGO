@extends('admin')

@section('title', 'Set Brand success')

@section('content')

<div style="display:flex; justify-content:center; padding-top:35px">
    <div class="m-3 justify-content-center text-dark" style="display:inline-block; padding: 20px; background-color:rgba(255,255,255,0.7);">

    <p href="{{ url('/admin/brands/updateDone', ['e_name' => $e_name, 'b_name' => $b_name]) }}">
    <?php echo "<h1>Now the establishment $e_name belongs to $b_name<h1>"; ?>
    </p>
    </div>
</div>
@endsection