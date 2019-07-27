<div class="posts">
    @foreach ($posts as $post)
        <div class="post">
            <img src="{{ $post->thumbnail ? 'storage/' . $post->thumbnail : '/images/default_thumbnail.jpg' }}" width="120px" style="padding: 10px">
            <div>
                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a><br>
                <small>{{ $post->created_at->format('d/m/Y') }}</small>
                <p>by <a href="{{ route('users.show', $post->user->id) }}">{{ $post->user->name }}</a></p>
            </div>
        </div>
    @endforeach
</div>