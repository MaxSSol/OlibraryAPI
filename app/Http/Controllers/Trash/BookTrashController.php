<?php

namespace App\Http\Controllers\Trash;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookTrashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return BookResource::collection(Book::onlyTrashed()->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return BookResource
     */
    public function show($id)
    {
        return new BookResource(Book::onlyTrashed()->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $book = Book::onlyTrashed()->findOrFail($id);
        $book->restore();

        return response()->json(['status' => "The book '$book->title' was successfully restored"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $book = Book::onlyTrashed()->findOrFail($id);
        $bookTitle = $book->title;
        $book->categories()->detach();
        $book->authors()->detach();
        $book->favorites()->detach();
        $book->forceDelete();

        return response()->json(['status' => "The book '$bookTitle' was successfully deleted"]);
    }
}
