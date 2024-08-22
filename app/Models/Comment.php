<?php

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'comment_user_id', 'comment_content'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'comment_user_id');
    }
}
