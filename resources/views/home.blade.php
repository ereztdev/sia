@extends('layouts.app')

@section('content')
<h1 class="text-lg text-center text-white text-capitalize">Welcome to {{config('app.name', 'PIOUS')}}, {{$userName}}</h1>
    <app/>
@endsection
@section('scripts')
    <script>
        var accessToken = "{{$accessToken}}";
        var podcastResponse = {!! $podcastResponse !!};
        console.log(podcastResponse);

    </script>
@endsection
