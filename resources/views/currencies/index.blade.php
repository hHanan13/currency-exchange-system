@extends('layouts.app')

@section('content')

<h1>Manage Exchange Rates</h1>
<form action="{{ route('currencies.store') }}" method="POST">
    @csrf
    <input type="text" name="currency" placeholder="Currency Code" required>
    <input type="number" step="0.01" name="rate" placeholder="Exchange Rate" required>
    <button type="submit">Add Currency</button>
</form>

<ul>
    @foreach ($currencies as $currency => $rate)
        <li>
            <form action="{{ route('currencies.update', $currency) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="text" name="currency" value="{{ $currency }}" readonly>
                <input type="number" step="0.01" name="rate" value="{{ $rate }}" required>
                <button type="submit">Update</button>
            </form>

            <form action="{{ route('currencies.destroy', $currency) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>

@endsection
