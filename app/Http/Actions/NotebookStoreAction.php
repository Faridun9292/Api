<?php

namespace App\Http\Actions;

use App\Http\Requests\NoteBookStoreRequest;
use App\Models\Notebook;

class NotebookStoreAction
{
    public function handle(NoteBookStoreRequest $request)
    {
        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('img'), $photo);
        }
        $notebook = Notebook::create([
            'initials' => $request->initials,
            'company' => $request->company,
            'phone' => $request->phone,
            'email' => $request->email,
            'birthday' => $request->birthday,
            'photo' => $photo
        ]);

        return $notebook;
    }
}
