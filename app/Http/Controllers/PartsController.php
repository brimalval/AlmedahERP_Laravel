<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\map;

class PartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'part_code' => 'nullable|string',
            'part_name' => 'required|string',
            'part_image' => 'nullable|image',
            'part_description' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }

        // Remove null entries
        $data = array_filter($request->all());

        try {
            // If no part code is given,
            if (!isset($data['part_code'])) {
                // get the part name
                $part_name = $data['part_name'];
                // split the name using the non-alphanumeric characters, commas, or spaces,
                $name_words = preg_split('/[\s,]+|[^a-zA-Z0-9]+/', $part_name);
                // abbreviate the words by taking only the first three letters as uppercase,
                $abbreviate = function ($word) {
                    return strtoupper(substr($word, 0, 3));
                };
                // and join the new words together with underscores
                $part_code = join("_", array_map($abbreviate, $name_words));
                $data['part_code'] = $part_code;
            }
            $part = new Part();

            if ($request->hasfile('part_image')) {
                $part->part_image = $request->file('part_image')->store('uploads/jobscheduling/parts', 'public');
            }

            $part->part_code = $data['part_code'];
            $part->part_name = $data['part_name'];
            $part->part_description = $data['part_description'] ?? '';
            $part->save();

            dd($part);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function show(Part $part)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function edit(Part $part)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Part $part)
    {
        $rules = [
            'part_code' => 'nullable|string',
            'part_name' => 'nullable|string',
            'part_image' => 'nullable|image',
            'part_description' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }

        try {
            if($request->hasFile('part_image')){
                $path = $request->file('part_image')->store('uploads/jobscheduling/parts', 'public');
                $part->part_image = $path;
                $part->save();
            }
            $data = array_filter($request->all());
            unset($data['part_image']);
            $part->update($data);

            return response()->json([
                'status' => 'success',
                'message' => "Successfully updated $part->part_name!",
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function destroy(Part $part)
    {
        try{
            $part_name = $part->part_name;
            $part->delete();
            return response()->json([
                'status' => 'success',
                'message' => "Successfully deleted $part_name.",
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
