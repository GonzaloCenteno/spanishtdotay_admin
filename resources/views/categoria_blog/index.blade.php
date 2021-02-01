@extends('layouts.app')

@section('content')

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card">
        <h5 class="card-header">CATEGORIA BLOG</h5>
        <div class="card-body">
            <a href="{{ route('categoria_blog.create') }}" type="button" class="btn btn-outline-info"><i class="fa fa-plus-circle fa-2x"></i> </a>
        </div>
    </div>
</div>

@endsection
