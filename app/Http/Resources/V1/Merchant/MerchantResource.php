<?php

namespace App\Http\Resources\V1\merchant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function App\Http\Helpers\fileFullPath;

class MerchantResource extends JsonResource
{
    public function __construct($resource)
    {
        parent::__construct($resource);
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'image' => fileFullPath($this->image),
            'is_active' =>$this->is_active,
            'type' =>$this->type,

    
        ];
    }
}
