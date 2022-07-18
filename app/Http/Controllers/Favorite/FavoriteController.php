<?php

namespace App\Http\Controllers\Favorite;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoriteResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return FavoriteResource
     */
    public function index(Request $request)
    {
        return new FavoriteResource($request->user()->favorites()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if (!Auth::user()) {
            return response()->json(['status' => 'unauthenticated'], 403);
        }

        $validated = $request->validate(['book_id' => 'required|integer']);

        $book = Book::findOrFail($validated);

        Auth::user()->favorites()->attach($book);

        return response()->json(['status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        if (!Auth::user()) {
            return response()->json(['status' => 'unauthenticated'], 403);
        }

        $favorite = Auth::user()->favorites()->where('book_id', $id)->exists();

        if (!$favorite) {
            return response()->json(['status' => false]);

        }
        return response()->json(['status' => true]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (!Auth::user()) {
            return response()->json(['status' => 'unauthenticated'], 403);
        }

        Auth::user()->favorites()->detach($id);

        return response()->json(['status' => false]);
    }
}
