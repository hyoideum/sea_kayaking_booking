@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('edit_tour', ['id' => $tour->id]) }}">
        {{ csrf_field() }}
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
                <td>{{ DateTime::createFromFormat('Y-m-d', $tour->date)->format('d-m') }}</td>
                <td>{{ date('H:i', strtotime($tour->starting_time)) }}</td>
                <td>
                    @if($tour->status == 'pending')
                        <input type="number" name="capacity" value="{{ $tour->capacity }}">
                    @else
                        <input type="hidden" name="capacity" value="{{ $tour->capacity }}">
                        {{ $tour->capacity }}
                    @endif
                </td>
                <td>{{ $tour->status }}</td>
                <td>
                    @if($tour->status == 'pending')
                        <select name="guide">
                            @if($tour->guide)
                                <option value="{{ $tour->guide->id }}">{{ $tour->guide->name }}</option>
                            @endif
                            @foreach($guides as $guide)
                                <option value="{{ $guide->id }}">{{ $guide->name }}</option>
                            @endforeach
                            @else
                                @if($tour->guide)
                                    {{ $tour->guide->name }}
                                @else
                                    Guide not set
                                @endif
                            @endif
                        </select>
                </td>
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
                @foreach($tour->bookings as $booking)
                    <td>{{ $booking->reserved_number }}</td>
                    <td>
                        @if($tour->status == "finished")
                            <select name="people[]">
                                <option>{{ $booking->reserved_number }}</option>
                                @for($i=0; $i<20; $i++)
                                    <option>{{ $i }}</option>
                                @endfor
                            </select>
                        @endif
                    </td>
                    <td>{{ $booking->names}}</td>
                    <td>{{ $booking->user->name}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-secondary">Submit</button>
        <a href="{{ url()->previous() }}" class="btn btn-primary" role="button">Back</a>
    </form>
@endsection
