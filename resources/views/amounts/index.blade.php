@extends('layouts.app')

@section('content')

<h1>Your Amounts</h1>
  <form action="{{ route('amounts.store') }}" method="POST">
      @csrf
      <input type="number" step="0.01" name="amount" placeholder="Enter Amount" required>
      <button type="submit">Add Amount</button>
  </form>

  @if($amounts && count($amounts) > 0)

  <ul>
      @foreach ($amounts as $amount)
          <li>
              <form action="{{ route('amounts.update', $amount->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <input type="number" step="0.01" name="amount" value="{{ $amount->amount }}" required>
                  <button type="submit">Update</button>
              </form>

              <form action="{{ route('amounts.destroy', $amount->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit">Delete</button>
              </form>

              <p>
                  {{ $amount->amount }} USD = 
                  @foreach ($exchangeRates as $currency => $rate)
                      {{ $amount->amount * $rate }} {{ $currency }} |
                  @endforeach
              </p>
          </li>
      @endforeach
  </ul>
    @else
        <p>No amounts available.</p>
    @endif

  @endsection
