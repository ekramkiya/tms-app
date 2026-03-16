<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('نام')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('ایمیل')
                    ->searchable()
                    ->copyable(),

                // IconColumn::make('email_verified_at')
                //     ->label('Verified')
                //     ->boolean()
                //     ->trueIcon('heroicon-o-check-circle')
                //     ->falseIcon('heroicon-o-x-circle'),

                TextColumn::make('created_at')
                    ->label('ساخت شده در')
                    ->jalaliDateTime()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('به روز شده در')
                    ->jalaliDateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([
                //
            ])

            ->recordActions([
                EditAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
}