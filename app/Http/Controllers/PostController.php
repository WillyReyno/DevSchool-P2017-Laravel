<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Post::paginate(10);

        return view('posts.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Doit retourner le formulaire de création des articles
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'title' => 'required|min:5',
                'content' => 'required|min:10'
            ],
            [
                'title.required' => 'Titre requis',
                'title.min' => 'Le titre doit contenir au moins 5 caractères',

                'content.required' => 'Contenu requis',
                'content.min' => 'L\'article doit contenir au moins 10 caractères'
            ]);

        $post = new Post;
        $input = $request->input();
        $input['user_id'] = Auth::user()->id;

        $post->fill($input)->save();

        return redirect()
            ->route('post.index')
            ->with('success', 'L\'article a bien été ajouté.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'title' => 'required|min:5',
                'content' => 'required|min:10'
            ],
            [
                'title.required' => 'Titre requis',
                'title.min' => 'Le titre doit contenir au moins 5 caractères',

                'content.required' => 'Contenu requis',
                'content.min' => 'L\'article doit contenir au moins 10 caractères'
            ]);

        $post = Post::findOrFail($id);
        $input = $request->input();
        $post->fill($input)->save();

        return redirect()->route('post.show', $id)
            ->with('success', 'L\'article a bien été modifié.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect()
            ->route('post.index')
            ->with('success', 'L\'article a bien été supprimé.');
    }
}
