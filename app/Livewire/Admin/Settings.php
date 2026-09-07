<?php

namespace App\Livewire\Admin;

use App\Models\SiteSetting;
use Livewire\Component;

class Settings extends Component
{
    public string $brandName = '';
    public string $tagline = '';
    public string $aboutTitle = '';
    public string $aboutText = '';
    public string $address = '';
    public string $phone = '';
    public string $whatsapp = '';
    public string $hours = '';
    public string $facebook = '';
    public string $instagram = '';
    public string $tiktok = '';
    public string $mapSrc = '';

    public function mount(): void
    {
        $this->brandName = SiteSetting::get('brand_name', 'INAMAN TAUHU BERGEDIL') ?? '';
        $this->tagline = SiteSetting::get('tagline', '') ?? '';
        $this->aboutTitle = SiteSetting::get('about_title', 'Kisah Kami') ?? '';
        $this->aboutText = SiteSetting::get('about_text', '') ?? '';
        $this->address = SiteSetting::get('address', '') ?? '';
        $this->phone = SiteSetting::get('phone', '') ?? '';
        $this->whatsapp = SiteSetting::get('whatsapp', '') ?? '';
        $this->hours = SiteSetting::get('hours', '') ?? '';
        $this->facebook = SiteSetting::get('facebook', '') ?? '';
        $this->instagram = SiteSetting::get('instagram', '') ?? '';
        $this->tiktok = SiteSetting::get('tiktok', '') ?? '';
        $this->mapSrc = SiteSetting::get('map_src', '') ?? '';
    }

    public function save(): void
    {
        $this->validate([
            'brandName' => ['required', 'string', 'max:255'],
            'whatsapp' => ['nullable', 'string', 'max:30'],
            'phone' => ['nullable', 'string', 'max:30'],
            'mapSrc' => ['nullable', 'string', 'max:1000'],
        ]);

        SiteSetting::set('brand_name', $this->brandName);
        SiteSetting::set('tagline', $this->tagline);
        SiteSetting::set('about_title', $this->aboutTitle);
        SiteSetting::set('about_text', $this->aboutText);
        SiteSetting::set('address', $this->address);
        SiteSetting::set('phone', $this->phone);
        SiteSetting::set('whatsapp', $this->whatsapp);
        SiteSetting::set('hours', $this->hours);
        SiteSetting::set('facebook', $this->facebook);
        SiteSetting::set('instagram', $this->instagram);
        SiteSetting::set('tiktok', $this->tiktok);
        SiteSetting::set('map_src', $this->mapSrc);

        $this->dispatch('settings-saved', message: 'Tetapan disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.settings');
    }
}