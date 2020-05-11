@extends('layouts.app')

@section('content')
<h1 class="text-lg-center text-white text-capitalize">Welcome to SIA, {{$userName}}</h1>
    <app/>
@endsection
@section('scripts')
    <script>var accessToken = "{{$accessToken}}"</script>
@endsection
