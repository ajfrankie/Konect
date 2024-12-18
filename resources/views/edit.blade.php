@section('content')
    <div class="container">
        <h2>Edit Post</h2>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- This tells Laravel to use the PUT method for the form submission -->
            
            <!-- Subject -->
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" value="{{ $post->subject }}" required>
            </div>

            <!-- Content -->
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="Content" rows="5" required>{{ $post->Content }}</textarea>
            </div>

            <!-- Image -->
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                <!-- Display existing image -->
                @if($post->image)
                    <img src="{{ Storage::url($post->image) }}" alt="Current Image" class="img-thumbnail mt-2" width="150">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
@endsection
