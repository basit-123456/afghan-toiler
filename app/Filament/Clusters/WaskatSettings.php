<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class WaskatSettings extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    
    protected static ?string $navigationGroup = 'Configuration';
    
    protected static ?string $navigationLabel = 'Waskat Settings';
}
