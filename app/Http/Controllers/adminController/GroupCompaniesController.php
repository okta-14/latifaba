<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\GroupCompanies;
use Illuminate\Http\Request;

class GroupCompaniesController extends Controller
{
    public function index()
    {
        $companies = GroupCompanies::latest()->get();

        return view('admin.groupcompanies.index', compact('companies'));
    }


    public function create()
    {
        return view('admin.groupcompanies.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|max:255',
            'image'  => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'url'    => 'nullable|url',
            'status' => 'required',
        ]);


        $data = [];

        $data['title'] = $request->title;
        $data['url'] = $request->url;
        $data['status'] = $request->status;


        $uploadPath = public_path('uploads/groupcompanies');


        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }


        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $fileName = time().'_'.$file->getClientOriginalName();

            $file->move($uploadPath, $fileName);

            $data['image'] = 'uploads/groupcompanies/'.$fileName;
        }


        GroupCompanies::create($data);


        return redirect()
            ->route('groupcompanies.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $company = GroupCompanies::findOrFail($id);

        return view('admin.groupcompanies.edit', compact('company'));
    }



    public function update(Request $request, $id)
    {
        $company = GroupCompanies::findOrFail($id);


        $request->validate([
            'title'  => 'required|max:255',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'url'    => 'nullable|url',
            'status' => 'required',
        ]);



        $data = [];

        $data['title'] = $request->title;
        $data['url'] = $request->url;
        $data['status'] = $request->status;



        $uploadPath = public_path('uploads/groupcompanies');


        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }



        if ($request->hasFile('image')) {


            if ($company->image && file_exists(public_path($company->image))) {

                unlink(public_path($company->image));

            }



            $file = $request->file('image');


            $fileName = time().'_'.$file->getClientOriginalName();


            $file->move($uploadPath, $fileName);


            $data['image'] = 'uploads/groupcompanies/'.$fileName;

        }



        $company->update($data);



        return redirect()
            ->route('groupcompanies.index')
            ->with('success', 'Data berhasil diperbarui.');
    }




    public function destroy($id)
    {
        $company = GroupCompanies::findOrFail($id);



        if ($company->image && file_exists(public_path($company->image))) {

            unlink(public_path($company->image));

        }



        $company->delete();



        return redirect()
            ->route('groupcompanies.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}