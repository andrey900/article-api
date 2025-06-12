<?php

namespace App\Filament\Managment\Resources\PostResource\Pages;

use App\Filament\Managment\Resources\PostResource;
use App\Models\Post;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Exceptions\Halt;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected $postMaxCount = 100;

    protected function beforeCreate(): void
    {
        $counts = Post::where('user_id',  auth()->user()->id)->count();
        if($counts >= $this->postMaxCount){
            Notification::make()
                ->danger()
                ->title('Post limit has reached')->send();
            throw new Halt('Post limit has reached');
        }
    }
}
