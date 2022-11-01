<?php

namespace Adue\EviniResenas\Comments;

use Adue\WordPressBasePlugin\Helpers\Traits\UseView;
use Adue\WordPressBasePlugin\Modules\Registers\Comments\BaseCommentMeta;

class WineAttribute extends BaseCommentMeta
{
    use UseView;

    protected $needLogin = 'both';
    public $showAttr = true;

    public function getKey()
    {
        return $this->key;
    }

    public function modifyCommentText($text)
    {
        if( $commentvalue = get_comment_meta( get_comment_ID(), $this->key, true ) ) {
            $commentvalue = '<strong>' . esc_attr( $this->name ) . '</strong>: '.$commentvalue.'%<br/>';
            $text = $commentvalue . $text;
        }
        return $text;
    }

    public function registerCommentMeta()
    {
        $this->view()->set('key', $this->key);
        $this->view()->set('name', $this->name);

        $this->view()->render('public/comment_meta/meta');
    }
}