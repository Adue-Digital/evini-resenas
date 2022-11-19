<?php

namespace Adue\EviniResenas\Comments;

use Adue\WordPressBasePlugin\Helpers\Traits\UseView;
use Adue\WordPressBasePlugin\Modules\Registers\Comments\BaseCommentMeta;

class DidYouTasteAttribute extends BaseCommentMeta
{
    use UseView;

    protected $needLogin = 'both';
    protected $key = 'wine_tasted';

    public function registerCommentMeta()
    {
        $this->view()->set('key', $this->key);
        $this->view()->render('public/comment_meta/did_you_taste');
    }
}