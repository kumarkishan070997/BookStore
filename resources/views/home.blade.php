@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Author</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $books)
                <tr>
                    <td>{{$books['title']}}</td>
                    <td>{{$books['description']}}</td>
                    <td>{{$books['price']}}</td>
                    <td>{{$books['category']['name'] ?? ""}}</td>
                    @foreach($books['authors'] as $author)
                        <td>
                            <span class="badge text-bg-primary">{{$author['name']}}</span>
                        </td>
                    @endforeach
                    <td>
                        <button class="btn btn-primary" onclick="window.location.href='{{route('book-detail').'?book_id='.$books['id']}}'">View Details</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection
