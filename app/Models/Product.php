<?php

namespace App\Models;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'seller_id',
        'name',
        'price',
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'gambar',
    ];

    protected $casts = [
        'harga' => 'integer',
        'price' => 'integer',
        'stok' => 'integer',
    ];

    public function getNamaProdukAttribute($value): ?string
    {
        return $value ?: ($this->attributes['name'] ?? null);
    }

    public function getHargaAttribute($value): int
    {
        return (int) ($value ?? ($this->attributes['price'] ?? 0));
    }

    public function getNameAttribute($value): ?string
    {
        return $value ?: ($this->attributes['nama_produk'] ?? null);
    }

    public function getPriceAttribute($value): int
    {
        return (int) ($value ?? ($this->attributes['harga'] ?? 0));
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
