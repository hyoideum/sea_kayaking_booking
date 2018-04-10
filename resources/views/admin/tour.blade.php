@extends('layouts.app')

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-info">
            {{ Session::get('message') }}
        </div>
    @endif
    @if($people == null)
        <h3>No bookings for this tour yet</h3>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Capacity</th>
            <th scope="col">Status</th>
            <th scope="col">Guide</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            @if($tour)
                <td>{{ DateTime::createFromFormat('Y-m-d', $tour->date)->format('d-m') }}</td>
                <td>{{ date('H:i', strtotime($tour->starting_time)) }}</td>
                <td>{{ $tour->capacity - $tour->number}}</td>
                <td>{{ $tour->status }}</td>
                @if($tour->guide)
                    <td>{{ $tour->guide->name }}</td>
                @else
                    <td>Guide not set</td>
                @endif
            @endif
        </tr>
        </tbody>
    </table>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Reserved number</th>
            <th scope="col">Attended number</th>
            <th scope="col">Names</th>
            <th scope="col">Booker</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            @if($tour)
                @foreach($tour->bookings as $booking)
                    <td>{{ $booking->reserved_number }}</td>
                    <td>{{ $booking->attended_number }}</td>
                    <td>{{ $booking->names}}</td>
                    <td>{{ $booking->user->name}}</td>
        </tr>
        @endforeach
        @endif
        </tbody>
    </table>

    <h6>Total number of people:</h6>
    @if($people)
        <p>{{ $people->number }}</p>
    @else
        <p>0</p>
    @endif
    <br>

    <h5>Tour snack</h5>
    <table class="table">
        <thead>
        <tr>
            @foreach($tour->tour_menu as $menu)
                <th scope="col">{{ $menu->menu->name }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        <tr>
            @foreach($tour->tour_menu as $menu)
                <td>{{ $menu->quantity }}</td>
            @endforeach
        </tr>
        </tbody>
    </table>
    <a href="{{ route('edit_tour', ['id' => $tour->id]) }}" class="btn btn-primary" role="button">Edit tour</a>
    @if($tour->status == 'pending')
        <a href="{{ route('cancel_tour', ['id' => $tour->id]) }}" class="btn btn-primary" role="button">Cancel tour</a>
    @endif
    @if($tour->status == 'canceled' && $tour->tour_time > now())
        <a href="{{ route('restore_tour', ['id' => $tour->id]) }}" class="btn btn-primary" role="button">Restore</a>
    @endif
@endsection
