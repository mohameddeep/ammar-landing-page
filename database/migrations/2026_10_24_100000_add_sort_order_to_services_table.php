<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->unsignedInteger('sort_order')->default(0)->after('parent_id');
            $table->index(['parent_id', 'sort_order']);
        });

        // Keep the current display order (by id) as the starting order within each level.
        $groups = DB::table('services')->orderBy('id')->get(['id', 'parent_id'])->groupBy(fn ($row) => $row->parent_id ?? 'root');
        foreach ($groups as $rows) {
            foreach ($rows->values() as $position => $row) {
                DB::table('services')->where('id', $row->id)->update(['sort_order' => $position + 1]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex(['parent_id', 'sort_order']);
            $table->dropColumn('sort_order');
        });
    }
};
