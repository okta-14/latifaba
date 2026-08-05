<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Kategori;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stichoza\GoogleTranslate\GoogleTranslate;

class BlogAdminController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();

        return view('admin.blog.index', compact('blogs'));
    }


    public function create()
    {
        $categories = Kategori::orderBy('title')->get();
        $tags = Tags::orderBy('slug')->get();

        return view('admin.blog.create', compact('categories', 'tags'));
    }


    public function store(Request $request)
    {
        $request->validate([

            'date'        => 'required|date',

            'title.id'    => 'required|max:500',
            'title.en'    => 'nullable|max:500',
            'title.jp'    => 'nullable|max:500',

            'caption.id'  => 'nullable|max:500',
            'caption.en'  => 'nullable|max:500',
            'caption.jp'  => 'nullable|max:500',

            'content.id'  => 'required',
            'content.en'  => 'nullable',
            'content.jp'  => 'nullable',

            'img'         => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'      => 'required|in:Show,Hide',
            'id_category' => 'required|exists:kategori,id',
            'tags'        => 'required|array',
            'tags.*'      => 'exists:tags,id',
            'keyword'     => 'nullable|string',

        ]);


        $data = $request->except('img');


        $data['slug'] = Str::slug($request->input('title.id'));


        $data['hit'] = 0;


        // tags sekarang berisi ID (dari checkbox), simpan dipisah titik-koma
        $data['tags'] = implode(';', $request->tags);



        if (empty($request->keyword)) {

            $keywords = [$request->input('title.id')];

            $tagTitles = Tags::whereIn('id', $request->tags)
                ->get()
                ->map(fn ($tag) => $tag->getTranslation('title', 'id'));

            $keywords = array_merge($keywords, $tagTitles->toArray());

            $data['keyword'] = implode(', ', $keywords);

        } else {

            $data['keyword'] = $request->keyword;

        }



        $data = $this->autoTranslate($data, ['title', 'caption', 'content']);



        $uploadPath = public_path('uploads/blog');


        if (!file_exists($uploadPath)) {

            mkdir($uploadPath, 0777, true);

        }



        if ($request->hasFile('img')) {


            $file = $request->file('img');


            $fileName = time() . '_' .
                Str::slug($request->input('title.id')) .
                '.' .
                $file->getClientOriginalExtension();


            $file->move($uploadPath, $fileName);


            $data['img'] = 'uploads/blog/' . $fileName;

        }



        Blog::create($data);



        return redirect()
            ->route('blogadmin.index')
            ->with('success', 'Blog berhasil ditambahkan.');

    }





    public function edit($id)
    {

        $blog = Blog::findOrFail($id);


        $categories = Kategori::orderBy('title')->get();

        $tags = Tags::orderBy('slug')->get();


        return view('admin.blog.edit', compact('blog', 'categories', 'tags'));

    }





    public function update(Request $request, $id)
    {

        $blog = Blog::findOrFail($id);



        $request->validate([

            'date'        => 'required|date',

            'title.id'    => 'required|max:500',
            'title.en'    => 'nullable|max:500',
            'title.jp'    => 'nullable|max:500',

            'caption.id'  => 'nullable|max:500',
            'caption.en'  => 'nullable|max:500',
            'caption.jp'  => 'nullable|max:500',

            'content.id'  => 'required',
            'content.en'  => 'nullable',
            'content.jp'  => 'nullable',

            'img'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'      => 'required|in:Show,Hide',
            'id_category' => 'required|exists:kategori,id',
            'tags'        => 'required|array',
            'tags.*'      => 'exists:tags,id',
            'keyword'     => 'nullable|string',

        ]);



        $data = $request->except('img');



        $data['slug'] = Str::slug($request->input('title.id'));



        $data['tags'] = implode(';', $request->tags);





        if (empty($request->keyword)) {


            $keywords = [$request->input('title.id')];

            $tagTitles = Tags::whereIn('id', $request->tags)
                ->get()
                ->map(fn ($tag) => $tag->getTranslation('title', 'id'));

            $keywords = array_merge($keywords, $tagTitles->toArray());

            $data['keyword'] = implode(', ', $keywords);


        } else {


            $data['keyword'] = $request->keyword;


        }



        $data = $this->autoTranslate($data, ['title', 'caption', 'content']);




        $uploadPath = public_path('uploads/blog');


        if (!file_exists($uploadPath)) {

            mkdir($uploadPath, 0777, true);

        }




        if ($request->hasFile('img')) {


            if ($blog->img && file_exists(public_path($blog->img))) {

                unlink(public_path($blog->img));

            }



            $file = $request->file('img');



            $fileName = time() . '_' .
                Str::slug($request->input('title.id')) .
                '.' .
                $file->getClientOriginalExtension();



            $file->move($uploadPath, $fileName);



            $data['img'] = 'uploads/blog/' . $fileName;


        }




        $blog->update($data);




        return redirect()
            ->route('blogadmin.index')
            ->with('success', 'Blog berhasil diperbarui.');

    }





    public function destroy($id)
    {

        $blog = Blog::findOrFail($id);



        if ($blog->img && file_exists(public_path($blog->img))) {

            unlink(public_path($blog->img));

        }



        $blog->delete();



        return redirect()
            ->route('blogadmin.index')
            ->with('success', 'Blog berhasil dihapus.');

    }



    private function autoTranslate(array $data, array $fields): array
    {
        foreach ($fields as $field) {

            $idText = $data[$field]['id'] ?? '';

            if (empty($idText)) {
                continue;
            }

            if (empty($data[$field]['en'])) {
                try {
                    $data[$field]['en'] = (new GoogleTranslate('en'))->translate($idText);
                } catch (\Exception $e) {
                    //
                }
            }

            if (empty($data[$field]['jp'])) {
                try {
                    $data[$field]['jp'] = (new GoogleTranslate('ja'))->translate($idText);
                } catch (\Exception $e) {
                    //
                }
            }

        }

        return $data;
    }

}