@extends('admin.layouts.app')
@section('title', 'Edit Blog Post')
@section('page-title', 'Edit Blog Post')
@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $blog->title) }}" required
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('title') border-red-500 @enderror"
                            placeholder="Blog post title">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $blog->slug) }}"
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('slug') border-red-500 @enderror"
                            placeholder="Auto-generated if empty">
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Excerpt</label>
                        <textarea name="excerpt" rows="3"
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('excerpt') border-red-500 @enderror"
                            placeholder="Brief excerpt">{{ old('excerpt', $blog->excerpt) }}</textarea>
                        @error('excerpt')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                        <textarea name="content" id="content" rows="15"
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('content') border-red-500 @enderror">{{ old('content', $blog->content) }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" required
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>Draft
                            </option>
                            <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>
                                Published</option>
                            <option value="archived" {{ old('status', $blog->status) == 'archived' ? 'selected' : '' }}>
                                Archived</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Categories</label>
                        <div class="space-y-1 max-h-48 overflow-y-auto border border-gray-200 rounded-md p-2">
                            @php $selectedCats = old('categories', $blog->categories->pluck('id')->toArray()); @endphp
                            @foreach ($categories as $cat)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="categories[]" value="{{ $cat->id }}"
                                        {{ in_array($cat->id, $selectedCats) ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <span class="text-sm text-gray-700">{{ $cat->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                        <div id="tag-input-container"
                            class="border border-gray-300 rounded-md p-2 min-h-[42px] focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-blue-500">
                            <div id="selected-tags" class="flex flex-wrap gap-1 mb-1">
                                @php $selectedTags = old('tags', $blog->tags->pluck('id')->toArray()); @endphp
                                @foreach ($tags as $tag)
                                    @if (in_array($tag->id, $selectedTags))
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-800">
                                            {{ $tag->name }}
                                            <button type="button" class="ml-1 text-blue-600 hover:text-blue-800 remove-tag"
                                                data-tag-id="{{ $tag->id }}">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                            <input type="text" id="tag-input" placeholder="Type a tag and press Enter or comma to add..."
                                class="outline-none bg-transparent text-sm flex-1 min-w-0">
                        </div>
                        <input type="hidden" name="tags" id="tags-input" value="{{ implode(',', $selectedTags) }}">
                        <input type="hidden" name="new_tags" id="new-tags-input" value="{{ old('new_tags') }}">
                        <p class="mt-1 text-xs text-gray-500">Press Enter or comma to add tags. Click X to remove.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label>
                        @if ($blog->featured_image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $blog->featured_image) }}"
                                    class="h-20 w-auto rounded border" alt="{{ $blog->featured_image_alt }}">
                                <p class="text-xs text-gray-500 mt-1">Current image. Upload new to replace.</p>
                            </div>
                        @endif
                        <input type="file" name="featured_image" accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="mt-1 text-xs text-gray-500">Max 10MB. Will be resized & converted to WebP.</p>
                        @error('featured_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Image Alt Text</label>
                        <input type="text" name="featured_image_alt"
                            value="{{ old('featured_image_alt', $blog->featured_image_alt) }}"
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="Alt text">
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        <h4 class="text-md font-semibold text-gray-800 mb-3">SEO Details</h4>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">SEO Title</label>
                        <input type="text" name="seo_title" value="{{ old('seo_title', $blog->seo_title) }}"
                            maxlength="255"
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="Meta title">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">SEO Keywords</label>
                        <textarea name="seo_keywords" rows="2"
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="Comma-separated keywords">{{ old('seo_keywords', $blog->seo_keywords) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">SEO Description</label>
                        <textarea name="seo_description" rows="2"
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="Meta description">{{ old('seo_description', $blog->seo_description) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Canonical URL</label>
                        <input type="url" name="canonical_url"
                            value="{{ old('canonical_url', $blog->canonical_url) }}" maxlength="255"
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="https://...">
                    </div>
                </div>
            </div>
            <div class="mt-6 flex items-center space-x-3 border-t border-gray-200 pt-4">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">Update Blog
                    Post</button>
                <a href="{{ route('admin.blogs.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.tiny.cloud/1/4pfw30o42k4scpw6y3s3me426cawvmdx4mqrgig8l12tmqgq/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            tinymce.init({
                selector: '#content',
                height: 500,
                menubar: false,
                plugins: ['advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor',
                    'searchreplace', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media',
                    'table', 'help', 'wordcount'
                ],
                branding: false,
                toolbar: 'undo redo | blocks fontsize | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image link table | removeformat | help code',
                images_upload_handler: function(blobInfo, progress) {
                    return new Promise(function(resolve, reject) {
                        var data = new FormData();
                        data.append('image', blobInfo.blob(), blobInfo.filename());
                        data.append('_token', '{{ csrf_token() }}');
                        fetch('{{ route('admin.blogs.upload-image') }}', {
                                method: 'POST',
                                body: data
                            })
                            .then(function(r) {
                                return r.json();
                            })
                            .then(function(r) {
                                resolve(r.location);
                            })
                            .catch(function(e) {
                                reject('Image upload failed');
                            });
                    });
                }
            });

            // Tag input functionality
            const tagInput = document.getElementById('tag-input');
            const selectedTags = document.getElementById('selected-tags');
            const tagsInput = document.getElementById('tags-input');
            const newTagsInput = document.getElementById('new-tags-input');

            let existingTagIds = tagsInput.value ? tagsInput.value.split(',').map(id => parseInt(id)) : [];
            let newTagNames = newTagsInput.value ? newTagsInput.value.split(',').map(name => name.trim()).filter(
                name => name) : [];

            function createTagElement(tagName, tagId = null, isNew = false) {
                const tagElement = document.createElement('span');
                tagElement.className =
                    'inline-flex items-center px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-800';
                tagElement.innerHTML = `
                    ${tagName}
                    <button type="button" class="ml-1 text-blue-600 hover:text-blue-800 remove-tag" data-tag-name="${tagName}" data-tag-id="${tagId || ''}" data-is-new="${isNew}">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                `;
                return tagElement;
            }

            function addTag(tagName, tagId = null) {
                if (!tagName.trim()) return;

                // Check if tag already exists
                const existingTags = Array.from(selectedTags.querySelectorAll('.remove-tag'));
                const tagExists = existingTags.some(tag => {
                    const tagNameAttr = tag.getAttribute('data-tag-name');
                    const tagIdAttr = tag.getAttribute('data-tag-id');
                    return tagNameAttr === tagName || (tagIdAttr && tagIdAttr == tagId);
                });

                if (tagExists) return;

                const isNew = tagId === null;
                const tagElement = createTagElement(tagName, tagId, isNew);
                selectedTags.appendChild(tagElement);

                if (isNew) {
                    newTagNames.push(tagName);
                } else {
                    existingTagIds.push(parseInt(tagId));
                }

                updateHiddenInputs();
            }

            function removeTag(tagElement) {
                const tagName = tagElement.getAttribute('data-tag-name');
                const tagId = tagElement.getAttribute('data-tag-id');
                const isNew = tagElement.getAttribute('data-is-new') === 'true';

                if (isNew) {
                    newTagNames = newTagNames.filter(name => name !== tagName);
                } else {
                    existingTagIds = existingTagIds.filter(id => id != tagId);
                }

                tagElement.closest('span').remove();
                updateHiddenInputs();
            }

            function updateHiddenInputs() {
                tagsInput.value = existingTagIds.join(',');
                newTagsInput.value = newTagNames.join(',');
            }

            // Event listeners
            tagInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ',') {
                    e.preventDefault();
                    const tagName = tagInput.value.trim();
                    if (tagName) {
                        addTag(tagName);
                        tagInput.value = '';
                    }
                }
            });

            tagInput.addEventListener('blur', function() {
                const tagName = tagInput.value.trim();
                if (tagName) {
                    addTag(tagName);
                    tagInput.value = '';
                }
            });

            selectedTags.addEventListener('click', function(e) {
                if (e.target.closest('.remove-tag')) {
                    e.preventDefault();
                    removeTag(e.target.closest('.remove-tag'));
                }
            });

            // Initialize existing tags
            @php $selectedTags = old('tags', $blog->tags->pluck('id')->toArray()); @endphp
            @foreach ($tags as $tag)
                @if (in_array($tag->id, $selectedTags))
                    addTag('{{ $tag->name }}', {{ $tag->id }});
                @endif
            @endforeach

            // Initialize new tags from old input
            @if (old('new_tags'))
                @php $oldNewTags = array_map('trim', explode(',', old('new_tags'))); @endphp
                @foreach ($oldNewTags as $tagName)
                    @if (!empty($tagName))
                        addTag('{{ $tagName }}');
                    @endif
                @endforeach
            @endif
        });
    </script>
@endpush
