@extends('layouts.app')

@section('content')
    @if($bookings->isEmpty())
        <h3>No bookings</h3>
    @else
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Reserved number</th>
                <th scope="col">Attended number</th>
                <th scope="col">Names</th>
                <th scope="col">Booker</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>
                        <a href={{ route('show_by_date',['date' => $booking->date]) }}>{{ DateTime::createFromFormat('Y-m-d', $booking->date)->format('d-m') }}</a>
                    </td>
                    <td>{{ date('H:i', strtotime($booking->starting_time)) }}</td>
                    <td>{{ $booking->reserved_number }}</td>
                    <td>{{ $booking->attended_number }}</td>
                    <td>{{ $booking->names }}</td>
                    <td><a href={{ route('show_bookings', ['id' => $booking->user_id]) }}>{{ $booking->name }}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
