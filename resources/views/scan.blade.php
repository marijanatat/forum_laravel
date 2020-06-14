@extends('layouts.app')

@section('content')
        <ais-instant-search :search-client="searchClient" index-name="demo_ecommerce">
        </ais-instant-search>
@endsection