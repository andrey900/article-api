<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Admin\Resources\UsersResource\Pages\ListUsers;
use App\Models\User;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Filament\Tables\Actions\ButtonAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserSettings extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.admin.pages.user_settings';

    protected static ?string $navigationLabel = "Settings";

    public ?array $data = []; // массив для состояния формы (optional)
    public ?array $passwordData = []; // массив для состояния формы (optional)
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Api access settings')
                    ->description('Manage you api keys')
                    ->schema([

                    ])
            ])
            ->statePath('data');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(\Auth::user()->tokens()->getQuery())
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('abilities'),
                TextColumn::make('last_used_at'),
                TextColumn::make('expires_at'),
            ])->actions([
//                ButtonAction::make('delete')
//                    ->action('delete')
//                    ->color('danger')
//                    ->size('xs'),
            ]);
    }

    protected function getForms(): array
    {
        return [
            'form',
            'editPasswordForm',
        ];
    }

    public function editPasswordForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Change Password')
                    ->description('Ensure your account is using long, random password to stay secure.')
                    ->schema([
                        TextInput::make('password')->label('New password')
                            ->required()
                            ->password()
                            ->rule(Password::default())
//                            ->minLength(8)
//                            ->maxLength(32)
//                            ->regex("/^(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z]).*$/"),
                    ]),
            ])
            ->statePath('passwordData');
    }

    public function editPasswordAction()
    {
        $data = $this->passwordData;
        try {
            \Auth::user()->update([
                'password' => Hash::make($data['password']),
            ]);
        } catch (Halt $exception) {
            Notification::make()
                ->title('Error change password, please try again')
                ->danger()
                ->send();
            return;
        }

        $this->form->fill([]);
        Notification::make()
            ->title('Password changed')
            ->success()
            ->send();
    }

    public function save(): void
    {
        dd($this->data);
        // Получаем данные формы

    }
}
