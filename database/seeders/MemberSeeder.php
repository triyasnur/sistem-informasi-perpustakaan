<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'nomor_anggota' => 'NIM-240101',
                'nama' => 'Triyas Nurlita',
                'jenis_kelamin' => 'P',
                'telepon' => '085298765432',
                'alamat' => 'Sleman, Yogyakarta',
            ],
            [
                'nomor_anggota' => 'NIM-240102',
                'nama' => 'Risma Kumala Sari',
                'jenis_kelamin' => 'P',
                'telepon' => '081234567890',
                'alamat' => 'Bantul, Yogyakarta',
            ],
            [
                'nomor_anggota' => 'NIM-240103',
                'nama' => 'Dimas Pratama',
                'jenis_kelamin' => 'L',
                'telepon' => '087712345678',
                'alamat' => 'Depok, Sleman',
            ],
            [
                'nomor_anggota' => 'NIM-240104',
                'nama' => 'Nadia Putri',
                'jenis_kelamin' => 'P',
                'telepon' => '089612345001',
                'alamat' => 'Kota Yogyakarta',
            ],
        ];

        foreach ($members as $member) {
            Member::updateOrCreate(
                ['nomor_anggota' => $member['nomor_anggota']],
                $member
            );
        }
    }
}
