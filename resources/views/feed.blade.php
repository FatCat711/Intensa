@extends('layout.layout')

@section('content')
    <a href="{{ route('show') }}">
        <button class="btn btn-outline-light">
            Create Lead
        </button>
    </a>
    <a href="/all-leads-csv">
        <button class="btn btn-outline-light">
            Export as csv
        </button>
    </a>
    <div class="row">
        <div class="col-3">
        </div>
        <div class="col-6">
            @include('shared.success-message')
            @include('shared.error-message')
            <a style="text-decoration: none" href="{{ route('feed') }}">
                <h1>Feed Page</h1>
            </a>
            @forelse ($leads as $lead)
                <p>Fullname: {{ $lead->fullname }}</p>
                <p>Email: {{ $lead->email }}</p>
                <p>Phone: {{ $lead->phone_number }}</p>
                <p>City: {{ $lead->city->name }}</p>
                <hr>
            @empty
                <p class="text-center mt-4">No Results Found</p>
            @endforelse
        </div>
        <div class="col-3">
            <form action="{{ route('feed') }}" method="get">
                <select name="city" class="form-control-plaintext border rounded py-1 px-3 mt-2">
                    @foreach (App\City::values() as $key => $value)
                        <option class="form-control-plaintext" value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                <div class="mt-4">
                    <button type="submit" class="btn btn-outline-secondary"> Search </button>
                </div>
            </form>
        </div>
    </div>
@endsection
