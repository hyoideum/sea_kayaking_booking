@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(Session::has('message'))
        <div class="alert alert-info">
            {{ Session::get('message') }}
        </div>
    @endif

    <h4>Upcoming tours:</h4>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Capacity</th>
            <th scope="col">Status</th>
            <th scope="col">Price</th>
            <th scope="col">Book now!</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tours as $tour)
            <tr>
                <td>{{ DateTime::createFromFormat('Y-m-d', $tour->date)->format('d-m') }}</td>
                <td>{{ date('H:i', strtotime($tour->starting_time)) }}</td>
                <td>{{ $tour->capacity - $tour->number . '/' . $tour->capacity }}</td>
                @if($tour->capacity - $tour->number == 0)
                    <td><font color="red">Closed</font></td>
                    <td>{{ $tour->price }} €</td>
                    <td>/</td>
                @elseif($tour->capacity - $tour->number < 6)
                    <td><font color="orange">Last chance</font></td>
                    <td>{{ $tour->price }} €</td>
                    <td><a href="{{ route('book_now', ['id' => $tour->id]) }}" role="button" class="btn btn-success">Book
                            Now</a></td>
                @else
                    <td><font color="blue">Open</font></td>
                    <td>{{ $tour->price }} €</td>
                    <td><a href="{{ route('book_now', ['id' => $tour->id]) }}" role="button" class="btn btn-success">Book
                            Now</a></td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>

    <br>
    <h3>Select another tour</h3>
    <br>

    <form method="post" action="new" class="container center_div text-center">
        {{ csrf_field() }}

        @if(Auth::user())
            <input type="hidden" name="user_id" value={{ Auth::user()->id }}>
        @else
            <input type="hidden" name="user_id" value=2>
        @endif

        <div class="form-group">
            <label for="exampleInputEmail1">Select tour date</label>
            <select name="date" class="form-control">
                @foreach($tours_date as $tour)
                    <option>{{ $tour->date }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="time">Select tour time</label>
            <select name="time" class="form-control">
                @foreach($tours_time as $tour)
                    <option>{{ date('H:i', strtotime($tour->starting_time)) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="people">Enter number of People</label>
            <select name="people" class="form-control">
                @for($i=1; $i<21; $i++)
                    <option>{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="names">Enter names</label>
            <input type="string" required class="form-control" placeholder="Names" name="names">
        </div>

        <div class="form-group">
            <h4>Choose tour snack</h4>
            <br>
            @foreach($menu as $item)
                <label>{{ $item->name }}</label>
                <input type="hidden" name="item_id[]" value={{ $item->id }}>
                <select name="items[]">
                    @for($i=0; $i<10; $i++)
                        <option>{{ $i }}</option>
                    @endfor
                </select>
                <br>
                <br>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary" role="button">Submit</button>
        <a href="{{ url()->previous() }}" class="btn btn-primary" role="button">Back</a>
    </form>
@endsection