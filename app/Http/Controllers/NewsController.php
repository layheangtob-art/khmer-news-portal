<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use App\Events\NewsCreated;
use Illuminate\Http\Request;
use App\Events\NewsStatusUpdated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $latestNews = News::where('status', 'Accept')
            ->orderBy('is_pinned', 'desc')
            ->latest()
            ->take(10)
            ->get();
        $topNews = News::where('status', 'Accept')->orderBy('views', 'desc')->take(5)->get();
        $popularNews = News::where('status', 'Accept')
            ->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(5)
            ->get();
        $topCategory = Category::orderBy('views', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Get all categories with their latest news for the tabbed interface
        $categoriesWithNews = Category::whereHas('news', function ($query) {
            $query->where('status', 'Accept');
        })
        ->with(['news' => function ($query) {
            $query->where('status', 'Accept')->latest();
        }])
        ->get();

        // Limit news per category manually to avoid SQL issues with limit in eager load
        $categoriesWithNews->each(function($category) {
            $category->setRelation('news', $category->news->take(6));
        });

        // Get active banners for home page
        $homeBanners = \App\Models\Banner::active()
            ->forHome()
            ->ordered()
            ->get();

        return view('home', compact(
            'latestNews',
            'topNews',
            'popularNews',
            'topCategory',
            'homeBanners',
            'categoriesWithNews'
        ));
    }

    public function listAllNews()
    {
        // Get all accepted news ordered by pinned status and date
        $allNews = News::where('status', 'Accept')
            ->with(['category', 'author'])
            ->orderBy('is_pinned', 'desc')
            ->latest()
            ->paginate(10);

        // Get global latest news for sidebar
        $globalLatestNews = News::where('status', 'Accept')->latest()->take(6)->get();

        // Get popular news for sidebar
        $popularNews = News::where('status', 'Accept')
            ->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(5)
            ->get();

        // Get banners for list page
        $listBanners = \App\Models\Banner::active()
            ->forDetail()
            ->ordered()
            ->get();

        return view('news.list', compact('allNews', 'globalLatestNews', 'popularNews', 'listBanners'));
    }

    public function uploadImage(Request $request)
    {
        try {
            $request->validate([
                'upload' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048',
            ]);

            if ($request->hasFile('upload')) {
                $image = $request->file('upload');
                $imageName = $image->hashName();
                $image->storeAs('public/images', $imageName);

                $url = asset('storage/images/' . $imageName);

                return response()->json([
                    'url' => $url
                ]);
            }

            return response()->json(['error' => ['message' => 'No image file provided']], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => ['message' => $e->getMessage()]], 400);
        }
    }

    public function manage()
    {
        $allNews = News::with(['category', 'author'])->get();
        return view('admin.news.manage', compact('allNews'));
    }

    public function viewCategory(Category $categories)
    {
        $latestNews = $categories->news()->where('status', 'Accept')->latest()->get();
        $topNews = $categories->news()->where('status', 'Accept')->orderBy('views', 'desc')->get();
        $popularNews = $categories->news()
            ->where('status', 'Accept')
            ->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->get();

        // Get global latest news for sidebar
        $globalLatestNews = News::where('status', 'Accept')->latest()->take(6)->get();

        // Get banners for category page
        $categoryBanners = \App\Models\Banner::active()
            ->forDetail()
            ->ordered()
            ->get();

        $categories->increment('views');

        return view('viewCategory', compact('categories', 'latestNews', 'topNews', 'popularNews', 'globalLatestNews', 'categoryBanners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allCategory = Category::all();
        return view('news.create', compact('allCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|min:1|max:1000',
                'content' => 'required|string|min:1',
                'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
                'additional_images.*' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
                'category_id' => 'required|exists:category,id',
            ]);

            $imageHashName = null;
            $additionalImages = [];

            // Handle main image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageHashName = $image->hashName();
                $image->storeAs('public/images', $imageHashName);
            }

            // Handle additional images
            if ($request->hasFile('additional_images')) {
                foreach ($request->file('additional_images') as $additionalImage) {
                    $additionalImageName = $additionalImage->hashName();
                    $additionalImage->storeAs('public/images', $additionalImageName);
                    $additionalImages[] = $additionalImageName;
                }
            }

            $news = News::create([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => Auth::id(),
                'category_id' => $request->category_id,
                'image' => $imageHashName,
                'images' => !empty($additionalImages) ? $additionalImages : null,
                'is_pinned' => $request->has('is_pinned') ? true : false,
            ]);

            event(new NewsCreated($news));

            return response()->json([
                'success' => true,
                'message' => 'Successfully saved the data.',
                'redirect_url' => route('dashboard')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        $randomNews = News::inRandomOrder()->take(2)->get();
        $news->increment('views');

        // Get active banners for detail page
        $detailBanners = \App\Models\Banner::active()
            ->forDetail()
            ->ordered()
            ->get();

        return view('detail', compact('news', 'randomNews', 'detailBanners'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $allCategory = Category::all();

        // Allow editing for Super Admin or if user is the author of the news
        if (Auth::user()->hasRole('Super Admin') || $news->user_id == Auth::id()) {
            return view('news.edit', compact('news', 'allCategory'));
        }

        return redirect()->back()->with('error', 'You are not authorized to edit this news article.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:1000',
                'content' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
                'additional_images.*' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
                'category_id' => 'required|exists:category,id'
            ]);

            $data = [
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => Auth::id(),
                'category_id' => $request->category_id,
                'is_pinned' => $request->has('is_pinned') ? true : false,
            ];

            // Handle main image update
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image->storeAs('public/images/', $image->hashName());

                // Delete old main image
                if ($news->image) {
                    Storage::delete('public/images/' . $news->image);
                }

                $data['image'] = $image->hashName();
            }

            // Handle additional images update
            if ($request->hasFile('additional_images')) {
                $additionalImages = [];

                // Delete old additional images
                if ($news->images && is_array($news->images)) {
                    foreach ($news->images as $oldImage) {
                        Storage::delete('public/images/' . $oldImage);
                    }
                }

                // Store new additional images
                foreach ($request->file('additional_images') as $additionalImage) {
                    $additionalImageName = $additionalImage->hashName();
                    $additionalImage->storeAs('public/images', $additionalImageName);
                    $additionalImages[] = $additionalImageName;
                }

                $data['images'] = !empty($additionalImages) ? $additionalImages : null;
            }

            $news->update($data);

            event(new NewsCreated($news));

            // Redirect based on user role
            if (Auth::user()->hasRole('Super Admin')) {
                return redirect()->route('admin.news.manage')->with('success', 'News updated successfully.');
            } else {
                return redirect()->route('news.draft')->with('success', 'News updated successfully.');
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update news: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        try {
            Storage::delete('public/images/' . $news->image);
            $news->delete();

            return response()->json([
                'success' => true,
                'message' => 'Successfully delete the data.',
                'redirect_url' => route('admin.news.manage')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function status(Request $request, News $news)
    {
        $draftNews = News::with('category')
            ->whereIn('status', ['Pending', 'Reject'])
            ->get();

        return view('news.status', compact('draftNews'));
    }

    public function view(Request $request, News $news)
    {
        return view('news.view', compact('news'));
    }

    public function updateStatus(Request $request, News $news)
    {
        try {
            $request->validate([
                'status' => 'required'
            ]);

            $news->status = $request->status;
            $news->save();

            event(new NewsStatusUpdated($news));

            return response()->json([
                'success' => true,
                'message' => 'Successfully updated status the news.',
                'redirect_url' => route('news.status')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function draft()
    {
        $userId = Auth::id();

        $acceptedNews = News::with('category')
            ->where('status', 'Accept')
            ->where('user_id', $userId)
            ->get();

        $notAcceptedNews = News::with('category')
            ->whereIn('status', ['Pending', 'Reject'])
            ->where('user_id', $userId)
            ->get();

        return view('admin.users.draft', compact('acceptedNews', 'notAcceptedNews'));
    }

    /**
     * Search for news articles - prioritizing title matches
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if (empty($query)) {
            return response()->json([
                'success' => false,
                'message' => 'ពាក្យគន្លឹះស្វែងរកទទេ',
                'data' => []
            ]);
        }

         // Trim and clean the query
        $query = trim($query);

        // Search strategy: Prioritize title matches, then content matches
        $titleMatches = News::where('status', 'Accept')
            ->where(function($q) use ($query) {
                $q->where('title', 'LIKE', '%' . $query . '%')
                  ->orWhereRaw('BINARY title LIKE ?', ['%' . $query . '%']);
            })
            ->with(['category', 'author'])
            ->orderBy('created_at', 'desc')
            ->get();

        // If no title matches, search in content as well
        $contentMatches = collect();
        if ($titleMatches->isEmpty()) {
            $contentMatches = News::where('status', 'Accept')
                ->where(function($q) use ($query) {
                    $q->where('content', 'LIKE', '%' . $query . '%')
                      ->orWhereRaw('BINARY content LIKE ?', ['%' . $query . '%']);
                })
                ->with(['category', 'author'])
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        }

        // Combine results (title matches first)
        $news = $titleMatches->merge($contentMatches)->unique('id')->take(20);

        $results = $news->map(function($item) use ($query, $titleMatches) {
            // Highlight the search term in title for better UX
            $highlightedTitle = $this->highlightSearchTerm($item->title, $query);

            return [
                'id' => $item->id,
                'title' => $item->title,
                'highlighted_title' => $highlightedTitle,
                'content' => Str::limit(strip_tags($item->content), 100),
                'category' => $item->category->name ?? '',
                'author' => $item->author->name ?? '',
                'image' => $item->image ? asset('storage/images/' . $item->image) : null,
                'url' => route('news.show', $item->id),
                'created_at' => $item->created_at->diffForHumans(),
                'match_type' => $titleMatches->contains('id', $item->id) ? 'title' : 'content'
            ];
        });

        $message = $results->count() > 0
            ? 'រកឃើញ ' . $results->count() . ' លទ្ធផល'
            : 'រកមិនឃើញលទ្ធផល';

        if ($request->ajax()) {
            return response()->json([
                'success' => $results->count() > 0,
                'message' => $message,
                'data' => $results,
                'total' => $results->count()
            ]);
        }

        return view('search-results', compact('results', 'query'));
    }

    /**
     * Highlight search terms in text
     */
    private function highlightSearchTerm($text, $searchTerm)
    {
        if (empty($searchTerm)) {
            return $text;
        }

        // For Khmer text, use a simple case-insensitive replacement
        return preg_replace('/(' . preg_quote($searchTerm, '/') . ')/ui', '<mark>$1</mark>', $text);
    }
}
