<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Category::get());
        $ctg = Category::all()->sortByDesc("modified")->values()->all();
        $data = $this->paginate($ctg,10);

        return response()->json($data,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ' :attribute harus diisi',
            'string'    => ' :attribute harus berformat teks',
            'file'    => ' :attribute harus berformat file',
            'mimes' => 'format :attribute harus jpg,jpeg,png',
            'max'      => 'ukuran file :attribute maksimal :max MB',
        ];

        $request->validate([
            'name' => 'required|',
            'icon' => 'required|file|max:1000|mimes:jpg,jpeg,png'
        ],$messages);


        $return = [
            'message' => 'failed',
        ];
        $stts = 500;
        $category = new Category;
        $category->name = $request->name;
        $category->icon = $request->icon->store('images/category/icon');
        if($category->save()){
            $return['message'] = 'success';
            $stts = 200;
        }

        return response()->json([$return],$stts);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
