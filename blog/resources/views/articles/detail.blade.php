@extends("layouts.app")
@section('content')
    <div class="container">

        @if (session('error'))
        <div class="alert alert-info">
            {{ session('error') }}
        </div>
    @endif



        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    {{ $article->created_at->diffForHumans() }},
                    Category: <b>{{ $article->category->name }}</b>
                </div>
                <p class="card-text">{{ $article->body }}</p>
                <a class="btn btn-warning" href="{{ url("/articles/delete/$article->id") }}">
                    Delete
                </a>
            </div>
        </div>
        
        <li class="list-group-item active">
            <b>Comments ({{ count($article->comments) }})</b>
        </li>
        <realtime :articleid="{{ $article->id }}" :user="{{ Auth::check() ? Auth::user()->toJson() : 'null' }}"></realtime>
    </div>
    
@endsection
 