<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\Action;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Riwayat Pesanan';
    protected static ?string $navigationGroup = 'Manajemen Toko';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Order ID')->sortable(),
                TextColumn::make('customer_name')->label('Nama Pelanggan')->searchable(),
                TextColumn::make('total_price')
                    ->label('Total Harga')
                    ->money('IDR')
                    ->sortable(),
                BadgeColumn::make('status')
                    ->colors([
                        'primary' => 'diproses',
                        'success' => 'selesai',
                        'danger' => 'dibatalkan',
                    ])
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Waktu Pesanan')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\ActionGroup::make([
                    Action::make('tandai_selesai')
                        ->label('Tandai Selesai')
                        ->icon('heroicon-s-check-circle')
                        ->color('success')
                        ->action(fn (Order $record) => $record->update(['status' => 'selesai']))
                        ->requiresConfirmation()
                        ->hidden(fn (Order $record) => in_array($record->status, ['selesai', 'dibatalkan'])),
                    Action::make('tandai_diproses')
                        ->label('Tandai Diproses')
                        ->icon('heroicon-s-arrow-path')
                        ->color('primary')
                        ->action(fn (Order $record) => $record->update(['status' => 'diproses']))
                        ->requiresConfirmation()
                        ->hidden(fn (Order $record) => in_array($record->status, ['diproses', 'dibatalkan'])),
                    Action::make('batalkan_pesanan')
                        ->label('Batalkan Pesanan')
                        ->icon('heroicon-s-x-circle')
                        ->color('danger')
                        ->action(fn (Order $record) => $record->update(['status' => 'dibatalkan']))
                        ->requiresConfirmation()
                        ->hidden(fn (Order $record) => in_array($record->status, ['selesai', 'dibatalkan'])),
                ])
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make('Informasi Pesanan')
                    ->schema([
                        Components\TextEntry::make('customer_name')->label('Nama Pelanggan'),
                        Components\TextEntry::make('total_price')->label('Total Harga')->money('IDR'),
                        Components\TextEntry::make('status')->badge()->colors([
                            'primary' => 'diproses',
                            'success' => 'selesai',
                            'danger' => 'dibatalkan',
                        ]),
                        Components\TextEntry::make('created_at')->label('Tanggal Pesan')->dateTime(),
                    ])->columns(2),
                Components\Section::make('Item Pesanan')
                    ->schema([
                        Components\RepeatableEntry::make('items')
                            ->label('')
                            ->schema([
                                Components\TextEntry::make('menuItem.name')->label('Menu'),
                                Components\TextEntry::make('quantity')->label('Jumlah'),
                                Components\TextEntry::make('price')->label('Harga Satuan')->money('IDR'),
                            ])->columns(3),
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            // 'create' => Pages\CreateOrder::route('/create'),
            // 'view' => Pages\ViewOrder::route('/{record}'),
            // 'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
