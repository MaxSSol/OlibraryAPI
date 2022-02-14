<?php

namespace App\Http\Controllers\Authors;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return AuthorResource::collection(Author::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAuthorRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(StoreAuthorRequest $request)
    {
        $this->middleware('auth:sanctum');
        if (!$request->validated()) {
            return response()->json($request->messages(), 422, ['Content-Type' => 'application/json']);
        }
        $author = Author::create($request->validated());
        $books = collect($request->books)->map(function ($book) {
            return collect($book)->get('id');
        });
        $author->books()->attach($books->toArray());

        return response(['status' => "$author->last_name has been successfully created"]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return AuthorResource
     */
    public function show($id)
    {
        return new AuthorResource(Author::with('books')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAuthorRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateAuthorRequest $request, $id)
    {
        $this->middleware('auth:sanctum');
        if (!$request->validated()) {
            return response()->json($request->messages(), 422, ['Content-Type' => 'application/json']);
        }
        $author = Author::findOrFail($id);
        $author->update($request->validated());
        $books = collect($request->books)->map(function ($book) {
            return collect($book)->get('id');
        });
        $author->books()->sync($books->toArray());
        return response()
            ->json(
                ['status' => "$author->first_name $author->last_name has been updated successfully"],
                200,
                ['Content-Type' => 'application/json']
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
        $this->middleware('auth:sanctum');
        $author = Author::findOrFail($id);
        $lastName = $author->last_name;
        $author->books()->detach();
        $author->delete();
        return response()
            ->json(
                ['status' => "$lastName has been successfully deleted"],
                200,
                ['Content-Type' => 'application/json']
            );
    }
}
