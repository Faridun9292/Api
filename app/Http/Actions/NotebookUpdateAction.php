<?php

namespace App\Http\Actions;

use App\Http\Requests\NoteBookStoreRequest;
use App\Models\Notebook;
use Illuminate\Support\Facades\File;

class NotebookUpdateAction
{
    public function handle(NoteBookStoreRequest $request, $id)
    {
        $notebook = Notebook::firstWhere('id', $id);

        $photo = $notebook->photo;

        if ($request->hasFile('photo')) {
            File::exists('img/' . $notebook->photo)
            && File::delete('img/' . $notebook->photo);
            $photo = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('img'), $photo);
        };

        $notebook->update([
            'initials' => $request->initials,
            'company' => $request->company,
            'phone' => $request->phone,
            'email' => $request->email,
            'birthday' => $request->birthday,
            'photo' => $photo
        ]);
    }
}
