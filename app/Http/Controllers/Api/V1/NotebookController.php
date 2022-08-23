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
    public function index()
    {
        return NotebookResource::collection(Notebook::latest()->paginate(10));
    }

    public function store(NoteBookStoreRequest $request, NotebookStoreAction $action)
    {

        return new NotebookResource($action->handle($request));
    }

    public function edit($id)
    {
        return new NotebookResource(Notebook::firstWhere('id', $id));
    }

    public function update(NoteBookStoreRequest $request, $id, NotebookUpdateAction $action)
    {
        $action->handle($request, $id);

        return new NotebookResource(Notebook::firstWhere('id', $id));
    }

    public function destroy($id)
    {
        $notebook = Notebook::firstWhere('id', $id);

        File::exists('img/' . $notebook->photo)
        && File::delete('img/' . $notebook->photo);

        $notebook->delete();

        return response()->noContent();
    }
}
