<?php

namespace App\Filament\Resources\CommentResource\Widgets;

use App\Filament\Resources\CommentResource;
use App\Models\Comment;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestCommentsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Comment::whereDate('created_at', '>', now()->subDays(10)->startOfDay())
                Comment::latest()->limit(9)
            )
            ->columns([
                TextColumn::make('user.name'),
                TextColumn::make('post.title')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('comment'),
                TextColumn::make('created_at')->sortable(),
            ])
            ->actions([
                Action::make('view')
                    ->url(fn (Comment $record): string => CommentResource::getUrl('edit', ['record' => $record]))
                    ->openUrlInNewTab()
            ]);
    }
}
