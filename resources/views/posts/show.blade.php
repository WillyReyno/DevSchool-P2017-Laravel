@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $post->title }}</div>

                    <div class="panel-body">
                        {{ $post->content }}

                        <br>
                        <em>Auteur : {{ $post->user->name }} </em>

                        <br>
                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-success">Modifier</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection