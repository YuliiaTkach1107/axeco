<?php

namespace App\Filament\Admin\Resources\Website\FAQS\Pages;

use App\Filament\Admin\Resources\Website\FAQS\FAQResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFAQ extends CreateRecord
{
    protected static string $resource = FAQResource::class;
}
