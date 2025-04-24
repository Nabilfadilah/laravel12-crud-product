<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    // daftar atribut yang bisa diisi (dari form)
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */

    // atribut yang akan disembunyikan saat data dikonversi ke array atau JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    // cast atribut ke tipe tertentu
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // waktu verifikasi email akan dibaca sebagai datetime
            'password' => 'hashed', // password otomatis di-hash oleh Laravel
        ];
    }
}
