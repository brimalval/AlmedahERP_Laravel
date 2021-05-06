<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\ManufacturingMaterials;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $components = Component::get();
        $raw_materials = ManufacturingMaterials::get();
        return view('modules.manufacturing.component', [
            'components' => $components,
            'raw_materials' => $raw_materials,
        ]);
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
            'component_code' => 'nullable|string',
            'component_name' => 'required|string',
            'component_image' => 'nullable|image',
            'component_description' => 'nullable|string',
            'item_code' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }
        try {
            $component = new Component();

            if ($request->hasFile('component_image')) {
                $component_image = $request->file('component_image')->store('uploads/jobscheduling/components', 'public');
                $component->component_image = $component_image;
            }else{
                $component->component_image = '';
            }

            if (!$request->component_code) {
                $component_name = $request->component_name;
                $name_words = preg_split('/[\s,]+|[^a-zA-Z0-9]+/', $component_name);
                $abbreviate = function ($word) {
                    return strtoupper(substr($word, 0, 3));
                };
                $component_code = join("_", array_map($abbreviate, $name_words));
                $component->component_code = $component_code;
            } else {
                $component->component_code = $request->component_code;
            }

            $component->component_name = $request->component_name;
            $component->item_code = $request->item_code;
            $component->component_description = $request->component_description ?? '';
            $component->save();

            return response()->json([
                'status' => 'success',
                'message' => "Successfully created the component $component->component_code ($component->component_name)!",
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function getItem(Request $request, $item_code)
    {
        $raw_material = ManufacturingMaterials::where('item_code', $item_code)->first();
        if(empty($raw_material)){
            return response()->json(['error' => 'Error msg'], 404);
        }
        return response($raw_material);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function show(Component $component)
    {
        dd($component->raw_material);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function edit(Component $component)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Component $component)
    {
        $rules = [
            'component_code' => 'nullable|string',
            'component_name' => 'nullable|string',
            'component_image' => 'nullable|image',
            'component_description' => 'nullable|string',
            'item_code' => 'nullable|exists:env_raw_materials',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
                'message' => 'Please make sure that all the information entered is valid.',
            ]);
        }

        try {
            $component->update(array_filter($request->all()));

            if ($request->hasfile('component_image')) {
                $component->component_image = $request->file('component_image')->store('uploads/jobscheduling/components', 'public');
                $component->save();
            }

            return response()->json([
                'status' => 'success',
                'message' => "Successfully updated $component->component_code ($component->component_name)!",
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
     * @param  \App\Models\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function destroy(Component $component)
    {
        try {
            $component_name = $component->component_name;
            $component_code = $component->component_code;
            $component->delete();
            return response()->json([
                'status' => 'success',
                'message' => "Successfully deleted $component_code ($component_name).",
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
