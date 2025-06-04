<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $label = 'محصول';
    protected static ?string $pluralLabel = 'محصولات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('نام محصول')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->label('قیمت')
                    ->required()
                    ->numeric()
                    ->step('0.01')
                    ->minValue(0),
                Forms\Components\TextInput::make('discount')
                    ->label('تخفیف (%)')
                    ->numeric()
                    ->maxValue(100)
                    ->minValue(0),
                Forms\Components\TextInput::make('stock')
                    ->label('موجودی')
                    ->required()
                    ->numeric()
                    ->minValue(0),
                Forms\Components\Textarea::make('description')
                    ->label('توضیحات')
                    ->columnSpanFull(),
                Forms\Components\Select::make('category_id')
                    ->label('دسته‌بندی')
                    ->relationship('category', 'name')
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->label('تصویر اصلی')
                    ->image()
                    ->directory('products')
                    ->disk('public')
                    ->maxSize(2048)
                    ->preserveFilenames(),
                Forms\Components\FileUpload::make('images')
                    ->label('تصاویر اضافی')
                    ->multiple()
                    ->image()
                    ->directory('products')
                    ->disk('public')
                    ->maxSize(2048)
                    ->preserveFilenames(),
                Forms\Components\KeyValue::make('attributes')
                    ->label('ویژگی‌ها')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('نام')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('قیمت')
                    ->money('toman'),
                Tables\Columns\TextColumn::make('discount')
                    ->label('تخفیف (%)'),
                Tables\Columns\TextColumn::make('stock')
                    ->label('موجودی'),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('دسته‌بندی'),
                Tables\Columns\ImageColumn::make('image')
                    ->label('تصویر'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('دسته‌بندی')
                    ->relationship('category', 'name'),
                Tables\Filters\TernaryFilter::make('stock')
                    ->label('موجودی')
                    ->trueLabel('موجود')
                    ->falseLabel('ناموجود'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}