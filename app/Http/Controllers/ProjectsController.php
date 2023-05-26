<?php

namespace App\Http\Controllers;

use App\Models\FileManagementSystem;
use App\Models\Fms;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProjectsController extends Controller
{
    //

    public function index()
    {
        return view('fms.dashboard');
    }

    public function storeMedia(Request $request)
    {
        $directory = storage_path('app/public/tmp');
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($directory, $name);

        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required', // validates that each document file is present and valid
            'document' => 'required', // validates that each document file is present and valid
            'telephone' => 'required|numeric' // validates that the telephone field is present and contains a numeric value
        ]);
        $fileManagementSystem = Fms::create($request->all());
        foreach ($request->input('document', []) as $file) {
            $fileManagementSystem->addMedia(storage_path('app/public/tmp/' . $file))->toMediaCollection('document');
        }
        session()->flash('status', 'Files has been successfully added into FMS.');

        return to_route('fms.index');
    }

    public function update(Request $request, Fms $fms)
    {
        $validatedData = $request->validate([
            'document' => 'required', // validates that each document file is present and valid
        ]);
        $fms->update($request->all());
        foreach ($request->input('document', []) as $file) {
            $fms->addMedia(storage_path('app/public/tmp/' . $file))->toMediaCollection('document');
        }
        session()->flash('status', 'Files has been successfully added into FMS.');
        return to_route('fms.show', $fms->id);

    }

    public function destroy(Media $media, Fms $fms)
    {
        if ($media) {
            $path = $media->getPath(); // Get the full path of the media file
            $media->delete(true); // Delete the media file from the disk and the database, including its associated directory

            // Delete the directory if it's empty
            $directory = dirname($path);
            if (is_dir($directory) && count(scandir($directory)) == 2) {
                rmdir($directory);
            }
            session()->flash('status', 'Files has been successfully deleted.');
            return to_route('fms.show', $fms);
        }
    }
}
