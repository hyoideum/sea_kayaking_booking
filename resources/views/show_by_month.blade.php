@extends('layouts.app')

@section('content')
    @if($bookings->isEmpty())
        <h3>No bookings</h3>
    @else
        <h4>Bookings for month: {{ date("F", mktime(0, 0, 0, $month, 1)) }}</h4>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Reserved number</th>
                <th scope="col">Attended number</th>
                <th scope="col">Names</th>
                <th scope="col">Commission</th>
                <th scope="col">Edit</th>
                <th scope="col">Cancel</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ DateTime::createFromFormat('Y-m-d', $booking->date)->format('d-m') }}</td>
                    <td>{{ date('H:i', strtotime($booking->starting_time)) }}</td>
                    <td>{{ $booking->reserved_number }}</td>
                    <td>{{ $booking->attended_number }}</td>
                    <td>{{ $booking->names }}</td>
                    <?php $percent = $booking->price / 100 * 20 * $booking->reserved_number;
                    echo "<td> $percent €</td>"; ?>
                    <td><a href={{ route('edit_booking', ['id' => $booking->id]) }}>Edit</a></td>
                    <td><a href={{ route('delete_booking',['id' => $booking->id]) }}>Delete</a></td>
                </tr>
            @endforeach
            <td>Ukupno: {{ $total }} €</td>
            </tbody>
        </table>
    @endif
@endsection
