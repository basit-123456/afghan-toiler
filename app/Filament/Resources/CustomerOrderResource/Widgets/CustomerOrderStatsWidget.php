<?php

namespace App\Filament\Resources\CustomerOrderResource\Widgets;

use App\Models\CustomerOrder;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CustomerOrderStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('All Orders', CustomerOrder::count())
                ->description('Total customer orders')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('success'),
            
            Stat::make("Today's Finish Date", CustomerOrder::whereDate('finish_date', today())->count())
                ->description('Orders finishing today')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('warning'),
            
            Stat::make('Not Delivered Orders', CustomerOrder::where('delivery_status', 'pending')->count())
                ->description('Pending delivery orders')
                ->descriptionIcon('heroicon-m-truck')
                ->color('danger'),
            
            Stat::make('Jami Orders', CustomerOrder::where('order_item', 'Jami')->count())
                ->description('Total Jami orders')
                ->descriptionIcon('heroicon-m-squares-2x2')
                ->color('info'),
            
            Stat::make('Waskat Orders', CustomerOrder::where('order_item', 'Waskat')->count())
                ->description('Total Waskat orders')
                ->descriptionIcon('heroicon-m-squares-2x2')
                ->color('info'),
        ];
    }
}