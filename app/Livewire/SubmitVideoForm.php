<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Video;
use Livewire\Component;
use Livewire\WithFileUploads;

class SubmitVideoForm extends Component
{
    use WithFileUploads;

    public $firstName, $lastName, $email, $title, $content, $videoUrl, $featuredImage, $categoryId, $tags = [];
    public $youtubeId; // Add as public property
    public $categories = [], $availableTags = [];

    protected $rules = [
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'title' => 'required|string|max:255',
        'content' => 'nullable|string',
        'videoUrl' => 'required|url',
        'youtubeId' => 'required|unique:videos,youtube_id',
        'featuredImage' => 'nullable|image|max:2048',
        'categoryId' => 'required|exists:categories,id',
        'tags' => 'array',
        'tags.*' => 'exists:tags,id',
    ];

    protected $messages = [
        'youtubeId.unique' => 'This video has already been submitted.',
    ];

    public function mount()
    {
        $this->categories = Category::all() ?? collect();
        $this->availableTags = Tag::all() ?? collect();
    }

    public function updatedVideoUrl($value)
    {
        $this->youtubeId = $this->extractYouTubeId($value);
        $this->validateOnly('youtubeId');
    }

    public function submit()
    {
        $this->validate();

        $thumbnailUrl = $this->featuredImage
            ? $this->featuredImage->store('thumbnails', 'public')
            : "https://img.youtube.com/vi/{$this->youtubeId}/hqdefault.jpg";

        $video = Video::create([
            'title' => $this->title,
            'description' => $this->content,
            'youtube_id' => $this->youtubeId,
            'youtube_url' => $this->videoUrl,
            'thumbnail_url' => $thumbnailUrl,
            'user_id' => auth()->id() ?? null,
            'category_id' => $this->categoryId,
            'status' => 'pending',
        ]);

        $video->tags()->sync($this->tags);

        session()->flash('message', 'Video submitted successfully! Awaiting moderation.');
        $this->reset();
    }

    private function extractYouTubeId($url)
    {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $match);
        return $match[1] ?? null;
    }

    public function updatedFeaturedImage()
    {
        $this->validateOnly('featuredImage');
    }

    public function render()
    {
        return view('livewire.submit-video-form');
    }
}
