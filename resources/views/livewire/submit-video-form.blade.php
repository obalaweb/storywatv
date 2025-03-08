<div>
    <div class="mx-auto max-w-4xl p-6 bg-white rounded-lg shadow-md">
        <form wire:submit.prevent="submit" class="submit-video-form validate-form">
            <div class="row g-4">
                <!-- First Name -->
                <div class="col-md-6">
                    <div class="item-input">
                        <span class="input-title">First Name *</span>
                        <label class="input-field require">
                            <input type="text" wire:model="firstName" required>
                            @error('firstName')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                </div>

                <!-- Last Name -->
                <div class="col-md-6">
                    <div class="item-input">
                        <span class="input-title">Last Name *</span>
                        <label class="input-field require">
                            <input type="text" wire:model="lastName" required>
                            @error('lastName')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <div class="item-input">
                        <span class="input-title">Your Email *</span>
                        <label class="input-field require">
                            <input type="email" wire:model="email" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                </div>

                <!-- Post Title -->
                <div class="col-md-6">
                    <div class="item-input">
                        <span class="input-title">Post Title *</span>
                        <label class="input-field require">
                            <input type="text" wire:model="title" required>
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                </div>

                <div class="divline-form"></div>

                <!-- Post Content -->
                <div class="col-12">
                    <div class="item-input">
                        <span class="input-title">Post Content</span>
                        <label class="input-field">
                            <textarea wire:model="content" rows="5"></textarea>
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                </div>

                <!-- Video URL -->
                <div class="col-12">
                    <div class="item-input">
                        <span class="input-title">Video URL (YouTube) *</span>
                        <label class="input-field require">
                            <input type="url" wire:model="videoUrl"
                                placeholder="https://www.youtube.com/watch?v=..." required>
                            @error('videoUrl')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @error('youtubeId')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="col-12">
                    <div class="item-input input-choose-file">
                        <span class="input-title">Featured Image</span>
                        <label class="input-field">
                            <span>Choose File</span>
                            <input type="file" wire:model="featuredImage">
                        </label>
                        <span class="input-file-value">
                            {{ $featuredImage ? $featuredImage->getClientOriginalName() : 'No file chosen' }}
                        </span>
                        @error('featuredImage')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="divline-form"></div>

                <!-- Video Categories -->
                <div class="col-12">
                    <div class="item-input">
                        <span class="input-title">Video Category *</span>
                        <label class="input-field require">
                            <select wire:model="categoryId" required>
                                <option value="">Select a category</option>
                                @forelse ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @empty
                                    <option value="">No categories available</option>
                                @endforelse
                            </select>
                            @error('categoryId')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                </div>

                <!-- Video Tags (Using Checkboxes) -->
                <div class="col-12">
                    <div class="item-input">
                        <span class="input-title">Video Tags</span>
                        <div class="tag-checkboxes">
                            @forelse ($availableTags as $tag)
                                <label class="tag-checkbox">
                                    <input type="checkbox" wire:model="tags" value="{{ $tag->id }}">
                                    {{ $tag->name }}
                                </label>
                            @empty
                                <p>No tags available</p>
                            @endforelse
                        </div>
                        @error('tags')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-12 text-center">
                    <button type="submit" class="btn-submit btn-large shape-round">
                        Submit Video
                    </button>
                </div>
            </div>

            @if (session('message'))
                <div class="alert alert-success mt-4">
                    {{ session('message') }}
                </div>
            @endif
        </form>
    </div>

    <style>
        .submit-video-form {
            padding: 20px;
        }

        .item-input {
            margin-bottom: 20px;
        }

        .input-title {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #2c3e50;
        }

        .input-field input,
        .input-field textarea,
        .input-field select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .input-field textarea {
            resize: vertical;
            min-height: 100px;
        }

        .input-field.require:after {
            content: '*';
            color: #e40914;
            margin-left: 5px;
        }

        .input-choose-file {
            position: relative;
        }

        .input-choose-file .input-field {
            display: flex;
            align-items: center;
            background: #f9f9f9;
            padding: 5px 10px;
        }

        .input-choose-file input[type="file"] {
            opacity: 0;
            position: absolute;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .input-file-value {
            display: block;
            color: #666;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .divline-form {
            border-top: 1px solid #eee;
            margin: 20px 0;
        }

        .btn-submit {
            background: #007bff;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 20px;
            text-transform: uppercase;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background: #0056b3;
        }

        .text-danger {
            font-size: 0.9rem;
            margin-top: 5px;
            display: block;
        }

        .tag-checkboxes {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .tag-checkbox {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .tag-checkbox input[type="checkbox"] {
            margin: 0;
        }
    </style>

    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function() {
                Livewire.on('fileUploaded', (event) => {
                    document.querySelector('.input-file-value').textContent = event.detail.fileName ||
                        'No file chosen';
                });
            });
        </script>
    @endpush
</div>
