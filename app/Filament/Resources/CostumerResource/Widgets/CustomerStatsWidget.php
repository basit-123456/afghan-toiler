<?php

namespace App\Filament\Resources\CostumerResource\Widgets;

use App\Models\Customer;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CustomerStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Customers', Customer::count())
                ->description('All registered customers')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),
            
            Stat::make('New Customers This Month', Customer::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count())
                ->description('Customers registered in the current month')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('info'),
            
            Stat::make('Customers Registered Today', Customer::whereDate('created_at', today())->count())
                ->description('Number of customers who registered today')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('warning'),
        ];
    }
}
