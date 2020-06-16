@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           @include('threads._list' )
           {{$threads->render()}}
        </div>

        <div class="card mb-4" style="height: 200px;border:none">
            <div class="card-header">
                Search
            </div>
            <div class="card-body" style="border:none">
                <form method="GET" action="/threads/search">
                    <div class="form-group">
                        <input type="text" placeholder="Search for..." name="q" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-outline-secondary btn-sm" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>



    </div>


    

</div>
@endsection