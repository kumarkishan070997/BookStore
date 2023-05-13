@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col">
                <h4>Book Title</h4>
            </div>
            <div class="col">
                <h5>{{$data['title']}}</h5>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h4>Book Description</h2>
            </div>
            <div class="col">
                <h5>{{$data['description']}}</h5>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h4>Price</h4>
            </div>
            <div class="col">
                <h5>{{$data['price']}}</h5>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h4>Authors</h4>
            </div>
            <div class="col">
                @foreach($data['authors'] as $author)
                <span class="badge text-bg-primary">{{$author['name']}}</span>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h4>Average Rating</h4>
            </div>
            <div class="col">
                <h5>{{$avg}}</h5>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h1>Reviews</h1>
            </div>
            <div class="col">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Review</button>
            </div>
        </div>

        {{-- code for submit review modal --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Add a Review</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form name='review-form' action="{{url('createreview')}}" method="post">
                    @csrf
                    <input type="text" class="form-control" value="{{$data['id']}}" name="book_id">
                    <input type="text" class="form-control" value="{{$data['title']}}" name="book_title" disabled>
                    <textarea class="form-control" placeholder="Leave a review here" id="floatingTextarea" name="review"></textarea>
                    <input type="number" class="form-control" name="rating" placeholder="Provide rating beetween 1 to 5">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>


        @foreach($data['reviews'] as $review)
            <div class="row">
                <div class="col">
                    <p>{{$review['review']}}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
