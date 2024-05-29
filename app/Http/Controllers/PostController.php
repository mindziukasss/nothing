<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PaginationService;
use App\Services\QueryTimerService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    protected $postModel;
    protected $queryTimerService;
    protected $paginationService;

    public function __construct(
        Post $postModel,
        QueryTimerService $queryTimerService,
        PaginationService $paginationService)
    {
        $this->postModel = $postModel;
        $this->queryTimerService = $queryTimerService;
        $this->paginationService = $paginationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Inertia\Response
    {
        $this->queryTimerService->start();
        $perPage = $request->input('perPage', 15);
        $currentPage = $request->query('page', 1);
        $functionName = $request->query('function', 'default');

        $posts = $this->postModel->getPosts($perPage, $currentPage, $functionName);
        $paginatedPosts = $this->paginationService->paginate($posts['posts'], $perPage, $posts['totalCount']);

        return Inertia::render('Post/List', [
            'posts' => $paginatedPosts,
            'duration' => $this->queryTimerService->getDurationInSeconds(),
            'functionName' => $functionName
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return Inertia::render('Post/Show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
