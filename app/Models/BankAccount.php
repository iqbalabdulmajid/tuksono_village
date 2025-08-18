<?php
// 2. Buat model baru: app/Models/BankAccount.php
// Jalankan: php artisan make:model BankAccount

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'bank_name', 'account_holder_name', 'account_number', 'bank_logo'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
