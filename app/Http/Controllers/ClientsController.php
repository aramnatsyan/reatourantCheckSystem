<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Graphics;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        $clients = Clients::getAllClientasArray();
        return view('clients.clients')->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create ()
    {
        $insert = false;
        if (!empty($_POST)) {

            $insert = Clients::createClient($_POST['data']);
        }

        return $insert;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Clients $clients
     * @return \Illuminate\Http\Response
     */
    public function show (Clients $clients)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Clients $clients
     * @return \Illuminate\Http\Response
     */
    public function edit (Clients $clients)
    {
        $insert = false;
        if (!empty($_POST)) {

            $insert = Clients::editClient($_POST['data']);
        }

        return $insert;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Clients $clients
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, Clients $clients)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Clients $clients
     * @return \Illuminate\Http\Response
     */
    public function destroy (Clients $clients)
    {
        $deleted = false;
        if (!empty($_POST)) {
            $clientId = $_POST['clientId'];
            if ($clientId) {
                $deleted = clients::where('id', $clientId)->delete();
            }
        }
        return $deleted;
    }

    public static function uploadProfileImage (Request $request)
    {
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = 'profilePic' . "." . $avatar->getClientOriginalExtension();
            $clientId = \Session::get('variableName');
            if (!empty($clientId)) {
                $filePath = public_path('images/profile-images/' . $clientId);
                if (is_dir($filePath)) {
                    $files = glob($filePath . '/*');
                    foreach ($files as $file) {
                        if (is_file($file)) unlink($file);
                    }
                    rmdir($filePath);
                }
                File::makeDirectory($filePath, $mode = 0777, true, true);
                $fileNameFull = public_path('images/profile-images/' . $clientId . '/' . $filename);
                $save = Image::make($avatar)->resize(500, 500)->save($fileNameFull);
                if (file_exists($fileNameFull)) {
                    $imgNewPath = 'images/profile-images/' . $clientId . '/' . $filename;
                    Clients::updateClientProfileImagePath($clientId, $imgNewPath);
                }
            }
            return back()->with('massage', 'Prof Picture uploaded successfully');
        }
    }

    public static function sendClientIdToSession (Request $request)
    {
        if ($_POST['clientId']) {
            \Session::put('variableName', $_POST['clientId']);
        }
    }
}
