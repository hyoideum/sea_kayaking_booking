@extends('layouts.app')

@section('content')
    @if($tours->isEmpty())
        <h3>No tours to show for a date: {{ DateTime::createFromFormat('Y-m-d', $date)->format('d-m-Y') }}</h3>
    @else
        <form method="post" action="{{ route('guides', ['date' => $date]) }}">
            {{ csrf_field() }}
            <h3>Displaying tours for a date: {{ DateTime::createFromFormat('Y-m-d', $date)->format('d-m-Y') }}</h3>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Tour ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Capacity</th>
                    <th scope="col">Status</th>
                    <th scope="col">Guide</th>
                    <th scope="col">Cancel</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tours as $tour)
                    <tr>
                        <td><a href="{{ route('edit_tour', ['id' => $tour->id]) }}">{{ $tour->id }}</a></td>
                        <td>{{ DateTime::createFromFormat('Y-m-d', $tour->date)->format('d-m') }}</td>
                        <td>{{ date('H:i', strtotime($tour->starting_time)) }}</td>
                        <td>{{ $tour->capacity}}</td>
                        <td>{{ $tour->status }}</td>
                        <td>
                            @if($tour->status == 'pending')
                                <select name="guides[]">
                                    @if($tour->guide)
                                        <option value="{{ $tour->guide->id }}">{{ $tour->guide->name }}</option>
                                    @else
                                        <option value="{{ null }}">No guide</option>
                                    @endif
                                    @foreach($guides as $guide)
                                        <option value="{{ $guide->id }}">{{ $guide->name }}</option>
                                    @endforeach
                                </select>
                            @else
                                @if($tour->guide)
                                    {{ $tour->guide->name }}
                                @else
                                    <option value="{{ null }}">No guide</option>
                                @endif
                            @endif
                        </td>
                        @if($tour->status == 'pending')
                            <td><a href="{{ route('cancel_tour', ['id' => $tour->id]) }}">Cancel</a></td>
                        @else
                            <td>/</td>
                        @endif
                        <td><a href={{ route('delete_tour',['id' => $tour->id]) }}>Delete</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
    @endif
@endsection
