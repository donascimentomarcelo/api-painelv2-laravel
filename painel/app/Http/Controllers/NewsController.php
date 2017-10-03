<?php

namespace Painel\Http\Controllers;

use Illuminate\Http\Request;
use Painel\Http\Controllers\Controller;
use Painel\Http\Requests;
use Painel\Repositories\NewsRepository;

class NewsController extends Controller
{
    private $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function save(Request $request)
    {
        dd($request->all());
    }

    public function show()
    {
        $news = $this->newsRepository->paginate(10);

        return view('admin.news.list', compact('news'));
    }

    public function edit($id)
    {
        $news = $this->newsRepository->find($id);

        return view('admin.news.edit', compact('news'));
    }

}
