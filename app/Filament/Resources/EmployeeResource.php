<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Employees';
    protected static ?string $pluralLabel = 'Employees';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->label('First Name'),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->label('Last Name'),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->label('Address'),
                Forms\Components\Select::make('city_id')
                    ->relationship('city', 'name')
                    ->required()
                    ->label('City'),
                Forms\Components\Select::make('state_id')
                    ->relationship('state', 'name')
                    ->required()
                    ->label('State'),
                Forms\Components\Select::make('country_id')
                    ->relationship('country', 'name')
                    ->required()
                    ->label('Country'),
                Forms\Components\Select::make('department_id')
                    ->relationship('department', 'name')
                    ->required()
                    ->label('Department'),
                Forms\Components\TextInput::make('zip_code')
                    ->required()
                    ->label('ZIP Code'),
                Forms\Components\DatePicker::make('birth_date')
                    ->required()
                    ->label('Birth Date'),
                Forms\Components\DatePicker::make('date_hired')
                    ->required()
                    ->label('Date Hired'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('last_name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('address')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('city.name')->sortable()->searchable()->label('City'),
                Tables\Columns\TextColumn::make('state.name')->sortable()->searchable()->label('State'),
                Tables\Columns\TextColumn::make('country.name')->sortable()->searchable()->label('Country'),
                Tables\Columns\TextColumn::make('department.name')->sortable()->searchable()->label('Department'),
                Tables\Columns\TextColumn::make('zip_code')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('birth_date')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('date_hired')->sortable()->searchable(),
            ])
            ->filters([
                // Add any filters you may need
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Add any relationship managers if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
