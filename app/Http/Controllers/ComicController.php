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
		// which create a string with the array of all creators of thtat type, for example
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

		// Write in db file located in config the new comic
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
		return view('comics.edit', compact('comic', 'id'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$updated_comic = $request->all();
		// @dd($id);
		// Update in db file located in config the new comic
		$all = file_get_contents(__DIR__ . '/../../../config/db.php');
		// Look for the array corresponding to the $id passed
		$array_start = 0;
		$array_end = 0;
		$updating_array = '';
		for ($i = 0; $i <= $id; $i++) {
			$array_start = strpos($all, "[\n\t\t", $array_end);
			$array_end = strpos($all, "],\n\t],", $array_end + 1);
			$current_array = substr($all, $array_start, $array_end - $array_start + 5);
			if ($i == $id) $updating_array = $current_array;
		}
        // @dd($all,$array_start, $array_end);

		// Define an array with the creator type
		$updated_comic_creators = ['writers', 'artists'];
		// For each creator type define a variable of name $variable_write_creators,
		// which create a string with the array of all creators of thtat type, for example
		// all creators of type 'writers'
		foreach ($updated_comic_creators as $creators_type) {
			$updated_comic_creators = explode(',', $updated_comic["$creators_type"]);
			$variable_write_creators = "write_$creators_type";
			$$variable_write_creators = "[\n";
			foreach ($updated_comic_creators as $creator) {
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

		$write_updated_array = <<<END
		[
				"title" => "{$updated_comic['title']}",
				"description" => "{$updated_comic['description']}",
				"thumb" => "{$updated_comic['thumb']}",
				"price" => "\${$updated_comic['price']}",
				"series" => "{$updated_comic['series']}",
				"sale_date" => "{$updated_comic['sale_date']}",
				"type" => "{$updated_comic['type']}",
				"artists" => $write_artists,
				"writers" => $write_writers,
			]
		END;
        // @dd($updated_comic, $write_updated_array, $updating_array);
		$write = str_replace($updating_array, $write_updated_array, $all);
        // @dd($write);
		file_put_contents(__DIR__ . '/../../../config/db.php', $write);
        // @dd(config('db')[$id]);

        return redirect()->route('comics.show', $id);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		//
	}
}
