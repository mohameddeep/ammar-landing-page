<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Str;

/**
 * Helpers for content authored in the dashboard WYSIWYG editor (Summernote).
 */
final class RichText
{
    /**
     * Return editor HTML that is safe to print unescaped.
     */
    public static function html(?string $html): string
    {
        $html = (string) $html;

        if ($html === '') {
            return '';
        }

        // Content saved as escaped entities (&lt;p&gt;...) is decoded back to markup.
        if (! str_contains($html, '<') && str_contains($html, '&lt;')) {
            $html = html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        // Plain text without markup keeps its line breaks.
        if ($html === strip_tags($html)) {
            return nl2br(e(html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8')));
        }

        $html = preg_replace('#<(script|style|iframe|object|embed|form|link|meta)\b[^>]*>.*?</\1\s*>#is', '', $html) ?? '';
        $html = preg_replace('#<(script|style|iframe|object|embed|form|link|meta)\b[^>]*/?>#is', '', $html) ?? '';
        $html = preg_replace('#\son[a-z]+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)#i', '', $html) ?? '';
        $html = preg_replace('#(href|src)\s*=\s*(["\'])\s*(javascript|vbscript|data):[^"\']*\2#i', '$1=$2#$2', $html) ?? '';

        return $html;
    }

    /**
     * Return editor content as plain text (for cards, excerpts, meta).
     */
    public static function text(?string $html, ?int $limit = null): string
    {
        $html = (string) $html;
        $html = preg_replace('#</(p|div|li|h[1-6])>|<br\s*/?>#i', ' ', $html) ?? '';
        $text = html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = trim(preg_replace('/[\s\x{00A0}]+/u', ' ', $text) ?? '');

        return $limit ? Str::limit($text, $limit) : $text;
    }
}
