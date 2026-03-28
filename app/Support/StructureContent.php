<?php

namespace App\Support;

use App\Models\Structure;

final class StructureContent
{
    public static function decode(?Structure $row): ?array
    {
        if (! $row || empty($row->content)) {
            return null;
        }

        $decoded = json_decode((string) $row->content, true);

        return is_array($decoded) ? $decoded : null;
    }
}
