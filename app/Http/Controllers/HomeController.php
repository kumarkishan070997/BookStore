<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\BookAuthor;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // before getting into homepage system will check whether some books and authors are available or not in the database otherwise it will create them.
        $is_books_exist = Book::count();
        if($is_books_exist > 0){
            $result = $this->getQueryData();
        }else{
            // create books and authors and sendting the list here
            $result = $this->getBooks();
        }
        $result = $result->toArray();
        return view('home')->with(['data'=>$result]);
    }
    public function getBookDetail(Request $request){
        $data = $request->all();
        $result = Book::with('category')
        ->with('authors')
        ->with('reviews')
        ->where('id',$data['book_id'])
        ->first();
        // finding average rating
        $avg_rating = Review::where('book_id',$data['book_id'])->avg('rating');
        if(!$avg_rating || $avg_rating == null){
            $avg_rating = 0;
        }
        // making a response here like cal
        return view('bookDetail')->with(['data'=>$result,'avg'=>$avg_rating]);
    }
    public function createReview(Request $request){
        try{
            $data = $request->all();
            // storing data in reviews table
            $user_id = Auth::user()->id;
            Review::insert([
                'user_id'=> $user_id,
                'book_id'=>$data['book_id'],
                'rating'=>$data['rating'],
                'review'=>$data['review']
            ]);
            return  redirect('/bookdetail?book_id='.$data['book_id']);
        }catch(\Exception $e){
            return false;
        }
    }
    public function getBooks(){
        try{
            // making array to store in database
            $books = [
                [
                    'title'=>'ABSALOM, ABSALOM! BY WILLIAM FAULKNER',
                    'description'=>'sample description',
                    'price'=>100,
                    'category_id'=>1
                ],
                [
                    'title'=>'ABSALOM, ABSALOM! BY WILLIAM FAULKNER',
                    'description'=>'sample description',
                    'price'=>100,
                    'category_id'=>1
                ],
                [
                    'title'=>'ABSALOM, ABSALOM! BY WILLIAM FAULKNER',
                    'description'=>'sample description',
                    'price'=>100,
                    'category_id'=>2
                ],
                [
                    'title'=>'ABSALOM, ABSALOM! BY WILLIAM FAULKNER',
                    'description'=>'sample description',
                    'price'=>100,
                    'category_id'=>3
                ],
                [
                    'title'=>'ABSALOM, ABSALOM! BY WILLIAM FAULKNER',
                    'description'=>'sample description',
                    'price'=>100,
                    'category_id'=>4
                ],
            ];
            $authors = [
                [
                    'name' => 'sample'
                ],
                [
                    'name' => 'sample2'
                ],
                [
                    'name' => 'sample3'
                ],
                [
                    'name' => 'sample4'
                ],
                [
                    'name' => 'sample5'
                ],
                [
                    'name' => 'sample6'
                ],
            ];
            $book_author = [
                [
                    'book_id'=>1,
                    'author_id'=>1
                ],
                [
                    'book_id'=>2,
                    'author_id'=>1
                ],
                [
                    'book_id'=>1,
                    'author_id'=>2
                ],
                [
                    'book_id'=>2,
                    'author_id'=>2
                ],
                [
                    'book_id'=>3,
                    'author_id'=>4
                ],
            ];
            $categories = [
                [
                    'name'=>'Technology'
                ],
                [
                    'name'=>'Drama'
                ],
                [
                    'name'=>'History'
                ],
                [
                    'name'=>'Thriller'
                ],
            ];
            // storing the data
            Book::insert($books);
            Author::insert($authors);
            BookAuthor::insert($book_author);
            Category::insert($categories);
            
            // now fetching data from all tables through relationships
            return $this->getQueryData();
        }catch(\Exception $e){
            return false;
        }
    }
    public function getQueryData(){
        $result = Book::with('category')
        ->with('authors')
        ->with('reviews')
        ->get();
        return $result;
    }
}
