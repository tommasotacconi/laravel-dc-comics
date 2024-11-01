<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ComicController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $comics = config('db');

        return view('comics.index', compact('comics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('comics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $new_comic = $request->all();
        // Define an array with the creator type
        $new_comic_creators = ['writers', 'artists'];
        // For each creator type define a variable of name $variable_write_creators,
        // which create a string with the array of the related creators, for example
        // all creators of type 'writers'
        foreach ($new_comic_creators as $creators_type) {
            $new_comic_creators = explode(',', $new_comic["$creators_type"]);
            $variable_write_creators = "write_$creators_type";
            $$variable_write_creators = "[\n";
            foreach ($new_comic_creators as $creator) {
                // Trim undesired characters
                $creator = mb_trim($creator);
                $creator_string = <<<END
                            "$creator",\n
                END;
                $$variable_write_creators .= $creator_string;
            };
            $$variable_write_creators .= <<<END
                    ]
            END;
        }

        // Write in db file in config the new comic
        $all = file_get_contents(__DIR__ . '/../../../config/db.php');
        $pos = strlen($all) - 3;
        $write = substr($all, 0, $pos) . <<<END
            [
                "title" => "{$new_comic['title']}",
                "description" => "{$new_comic['description']}",
                "thumb" => "{$new_comic['thumb']}",
                "price" => "\${$new_comic['price']}",
                "series" => "{$new_comic['series']}",
                "sale_date" => "{$new_comic['sale_date']}",
                "series" => "{$new_comic['series']}",
                "type" => "{$new_comic['type']}",
                "artists" => $write_artists,
                "writers" => $write_writers,
            ],\n
        END . substr($all, $pos);
        file_put_contents(__DIR__ . '/../../../config/db.php', $write);

        // Redirect user to show of new comic, after looking for it in config/db.php
        $last_comic_pos = count(config('db'));
        // @dd($last_comic_id);
        // @dd(compact('last_comic'));
        return redirect()->route('comics.show', $last_comic_pos);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $comic)
    {
        //
        $comic = config('db')[$comic];
        return view('comics.show', compact('comic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $comic = config('db')[$id];
        return view('comics.edit', compact('comic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
