<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Actions\NotebookStoreAction;
use App\Http\Actions\NotebookUpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\NoteBookStoreRequest;
use App\Http\Resources\NotebookResource;
use App\Models\Notebook;
use Illuminate\Support\Facades\File;

class NotebookController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/NotebookController",
     *     description="returns all notebooks with pagination 10 ordered by latest",
     *     @OA\Response(response="200", description="collection of Notebooks")
     * )
     */
    public function index()
    {
        return NotebookResource::collection(Notebook::latest()->paginate(10));
    }

    /**
     * @OA\Post(
     *     path="/api/v1/NotebookController",
     *     description="adds to database a new Notebook",
     *     @OA\Response(response="200", description="returns added Notebook")
     * )
     */
    public function store(NoteBookStoreRequest $request, NotebookStoreAction $action)
    {

        return new NotebookResource($action->handle($request));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/NotebookController/{id}",
     *     description="gets the Notebook by id",
     *     @OA\Response(response="200", description="returns a Notebook by id")
     * )
     */
    public function edit($id)
    {
        return new NotebookResource(Notebook::firstWhere('id', $id));
    }

    /**
     * @OA\Post(
     *     path="/api/v1/NotebookController/{id}",
     *     description="updates a Notebook by id",
     *     @OA\Response(response="200", description="returns updated Notebook by id")
     * )
     */
    public function update(NoteBookStoreRequest $request, $id, NotebookUpdateAction $action)
    {
        $action->handle($request, $id);

        return new NotebookResource(Notebook::firstWhere('id', $id));
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/NotebookController/{id}",
     *     description="deletes a Notebook by id",
     *     @OA\Response(response="200", description="returns no content")
     * )
     */
    public function destroy($id)
    {
        $notebook = Notebook::firstWhere('id', $id);

        File::exists('img/' . $notebook->photo)
        && File::delete('img/' . $notebook->photo);

        $notebook->delete();

        return response()->noContent();
    }
}
