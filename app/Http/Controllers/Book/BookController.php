<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return BookResource::collection(Book::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBookRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBookRequest $request)
    {
        $this->middleware('auth:sanctum');
        if (!$request->validated()) {
            return response()->json($request->messages(), 422, ['Content-type' => 'application/json']);
        }
        $bookValidated = collect(json_decode($request->book, true));
        $authors = collect($bookValidated['authors']);
        $authors = $authors->map(function ($author) {
            return collect($author)->get('id');
        });
        $bookValidated['image_name'] = $request->image->getClientOriginalName();
        $bookValidated['file_name'] = $request->file->getClientOriginalName();
        $request->file('image')->storeAs('public/books/images', $request->image->getClientOriginalName());
        $request->file('file')->storeAs('public/books/files', $request->file->getClientOriginalName());
        $book = Book::create($bookValidated->toArray());
        $book->authors()->attach($authors->toArray());
        return response()->json([
            'status' => "The book $book->title has been successfully created",
            200,
            ['Content-type' => 'application/json']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return BookResource
     */
    public function show($id)
    {
        return new BookResource(Book::with('authors')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $this->middleware('auth:sanctum');
        if (!$request->validated()) {
            return response()->json($request->messages(), 422, ['Content-type' => 'application/json']);
        }
        $bookValidated = collect(json_decode($request->book, true));
        $book = Book::findOrFail($id);
        if ($request->hasFile('file_name')) {
            Storage::delete('public/books/files/' . $book->file_name);
            $request
                ->file('file_name')
                ->storeAs('public/books/files', $request->file_name->getClientOriginalName());
            $bookValidated['file_name'] = $request->file_name->getClientOriginalName();
        }
        if ($request->hasFile('image_name')) {
            Storage::delete('public/books/images/' . $book->image_name);
            $request
                ->file('image_name')
                ->storeAs('public/books/images', $request->image_name->getClientOriginalName());
            $bookValidated['image_name'] = $request->image_name->getClientOriginalName();
        }
        $book->update($bookValidated->toArray());
        $authors = collect($bookValidated['authors']);
        $authors = $authors->map(function ($author) {
            return collect($author)->get('id');
        });
        $book->authors()->sync($authors->toArray());
        return response()->json([
            'book' => Book::with('authors')->findOrFail($id),
            'status' => 'The book was successfully updated!'],
            200,
            ['Content-type' => 'application/json']
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $bookTitle = $book->title;
        $book->delete();
        return response()->json([
            'status' => "The book $bookTitle has been successfully added to the cart"
        ],
            200,
            ['Content-type' => 'application/json']
        );
    }
}
