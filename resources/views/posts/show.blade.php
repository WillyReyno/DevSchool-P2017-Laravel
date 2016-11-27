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

                        @if(Auth::check() && Auth::user()->isAdmin)
                            <br>
                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-success">Modifier</a>

                            {!! Form::model($post, [
                            'route' => ['post.destroy', $post->id],
                            'method' => 'DELETE'
                            ]) !!}

                            {!! Form::submit('Supprimer', ['class' => 'btn btn-danger']) !!}

                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection