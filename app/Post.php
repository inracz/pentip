<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
use Actuallymab\LaravelComment\HasComments;
use Actuallymab\LaravelComment\Contracts\Commentable;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use EloquentFilter\Filterable;
use Carbon\Carbon;
use CyrildeWit\EloquentViewable\Viewable;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;
use App\Events\PostCreated;
use Overtrue\LaravelFollow\Traits\CanBeBookmarked;

class Post extends Model implements Commentable, ViewableContract
{
    use CanBeLiked, 
        HasComments,
        Filterable,
        Viewable,
        CanBeBookmarked;

    protected $guarded = [];

    /**
     * The event map for a post
     * 
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => PostCreated::class
    ];

    /**
     * User relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Comment relationship
     */
    public function comments() : MorphMany
    {
        return $this->morphMany(config('comment.model'), 'commentable')->latest();
    }

    /**
     * How much time will take the user to read the article
     * 
     * @return string Time in minutes
     */
    public function timeToRead()
    {
        return (int) round(str_word_count($this->content)/200);
    }

    /**
     * Get post's views
     * 
     * @return string Views
     */
    public function getViews()
    {
        return views($this)->count();
    }

    /**
     * Convert content to PDF
     * 
     * @return string PDF
     */
    public function getPdf()
    {
        $html = \GrahamCampbell\Markdown\Facades\Markdown::convertToHTML($this->content);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();
        return $dompdf->stream( str_slug($this->title) );
    }

}
