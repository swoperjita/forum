@extends('layouts.app')

@section('content')
    <style>
        .draft-box {
            background-color: #f8f9fa;
            border: 2px solid #6f42c1; /* Purple border */
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .draft-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .draft-body {
            color: #666;
            margin-bottom: 0;
        }
    </style>

    <div class="container">
        <h1>My Drafts</h1>
        @if (!$drafts->isEmpty())
            <div class="draft-list">
                @foreach ($drafts as $draft)
                    <div class="draft-box">
                        <h3 class="draft-title">{{ $draft->title }}</h3>
                        <p class="draft-body">{{ $draft->body }}</p>
                        <!-- Display other draft details as needed -->
                    </div>
                @endforeach
            </div>
        @else
            <p style="font-style: italic; color: #999;">You have no drafts.</p>
        @endif
    </div>
@endsection