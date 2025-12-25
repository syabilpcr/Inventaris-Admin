<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class CreatePelangganDummy extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // 1. Definisi Kategori
        $kategoriList = [
            ['nama' => 'Elektronik', 'kode' => 'ELC', 'min' => 2000000, 'max' => 15000000],
            ['nama' => 'Kendaraan', 'kode' => 'KND', 'min' => 150000000, 'max' => 400000000],
            ['nama' => 'Furniture', 'kode' => 'FNT', 'min' => 500000, 'max' => 5000000],
            ['nama' => 'Alat Kantor', 'kode' => 'OFC', 'min' => 100000, 'max' => 2000000],
        ];

        $nomorUrut = 1;
        $tanggalBerurutan = Carbon::now()->subYears(2);

        foreach ($kategoriList as $item) {
            $kategoriId = DB::table('kategori_aset')->insertGetId([
                'nama'       => $item['nama'],
                'kode'       => $item['kode'],
                'deskripsi'  => 'Inventaris aset ' . $item['nama'] . ' perusahaan',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 2. Buat 25 Aset per kategori agar total menjadi 100 (4 kategori x 25 = 100)
            foreach (range(1, 25) as $j) {
                $kodeAset = 'AST-' . str_pad($nomorUrut, 5, '0', STR_PAD_LEFT);
                
                // Tambahkan 5-10 hari saja agar 100 data tetap masuk dalam rentang waktu yang logis
                $tanggalBerurutan->addDays(rand(5, 10));

                $asetId = DB::table('aset')->insertGetId([
                    'kategori_id'     => $kategoriId,
                    'kode_aset'       => $kodeAset,
                    'nama_aset'       => $this->getNamaAset($item['nama'], $faker),
                    'tgl_perolehan'   => $tanggalBerurutan->format('Y-m-d'),
                    'nilai_perolehan' => $faker->numberBetween($item['min'], $item['max']),
                    'kondisi'         => $faker->randomElement(['Sangat Baik', 'Baik', 'Rusak Ringan']),
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ]);

                // 3. Lokasi Aset
                DB::table('lokasi_aset')->insert([
                    'aset_id'     => $asetId,
                    'keterangan'  => 'Ruang ' . $faker->randomElement(['Utama', 'Manager', 'Staff', 'Gudang', 'Rapat']),
                    'lokasi_text' => $faker->address,
                    'rt'          => str_pad(rand(1, 20), 3, '0', STR_PAD_LEFT),
                    'rw'          => str_pad(rand(1, 10), 3, '0', STR_PAD_LEFT),
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);

                // 4. Pemeliharaan
                DB::table('pemeliharaan_aset')->insert([
                    'aset_id'    => $asetId,
                    'tanggal'    => Carbon::parse($tanggalBerurutan)->addMonths(rand(1, 4))->format('Y-m-d'),
                    'tindakan'   => $faker->randomElement(['Servis Berkala', 'Pembersihan', 'Perbaikan Ringan']),
                    'biaya'      => $faker->numberBetween(50000, 500000),
                    'pelaksana'  => $faker->name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // 5. Mutasi
                DB::table('mutasi_aset')->insert([
                    'aset_id'      => $asetId,
                    'tanggal'      => Carbon::parse($tanggalBerurutan)->addDays(2)->format('Y-m-d'),
                    'jenis_mutasi' => 'Penempatan Awal',
                    'keterangan'   => 'Registrasi aset sistem',
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);

                $nomorUrut++;
            }
        }
    }

    private function getNamaAset($kategori, $faker) {
        $data = [
            'Elektronik'  => ['Laptop ASUS', 'Macbook Pro', 'Printer Epson', 'Monitor Samsung', 'Proyektor BenQ', 'Tablet Samsung', 'PC Dell'],
            'Kendaraan'   => ['Toyota Avanza', 'Honda Vario', 'Mitsubishi Xpander', 'Yamaha NMAX', 'Suzuki Carry', 'Honda Civic'],
            'Furniture'   => ['Meja Kantor L', 'Kursi Ergonomis', 'Lemari Arsip Besi', 'Sofa Tamu', 'Rak Buku', 'Meja Rapat'],
            'Alat Kantor' => ['Mesin Fotocopy', 'Penghancur Kertas', 'Telepon Kantor', 'AC Split', 'Dispenser', 'Scanner Canon'],
        ];
        return $faker->randomElement($data[$kategori]);
    }
}