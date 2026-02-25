<?php

namespace App\Http\Traits;

trait LanguageToggle
{
    public function t($attribute)
    {
        // Get current locale from LaravelLocalization or fallback to app locale
        $locale = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() 
            ?? app()->getLocale() 
            ?? config('app.locale', 'en');
        
        $table_attribute = $attribute.'_'.$locale;
        
        // Get the value for current locale
        $value = $this->getAttribute($table_attribute);
        
        // If value is empty or null, try fallback locale
        if (empty($value) || is_null($value)) {
            $fallbackLocale = $locale === 'ar' ? 'en' : 'ar';
            $fallbackAttribute = $attribute.'_'.$fallbackLocale;
            $value = $this->getAttribute($fallbackAttribute);
        }
        
        return $value;
    }
}
