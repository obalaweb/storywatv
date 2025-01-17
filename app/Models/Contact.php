<?php

namespace App\Models;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'subject', 'message', 'status'];

    protected $casts = [
        'status' => 'integer',
    ];

    protected $rules = [
        'name' => 'required|string',
        'email' => 'required|email',
        'subject' => 'string',
        'message' => 'string',
    ];

    public static function getForm()
    {
        return [
            TextInput::make('name')
                ->live(true)
                ->afterStateUpdated(function (Get $get, Set $set, ?string $operation, ?string $old, ?string $state) {

                    $set('slug', Str::slug($state));
                })
                ->required()
                ->maxLength(155),

            TextInput::make('slug')
                ->readOnly()
                ->maxLength(255),
        ];
    }

    public function scopeRead(Builder $query)
    {
        return $query->where('status', 1)->latest('created_at');
    }

    public function scopeUnread(Builder $query)
    {
        return $query->where('status', 0)->latest('created_at');
    }
}
