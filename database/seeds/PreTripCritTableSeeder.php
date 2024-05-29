<?php

use App\Models\Master\PreTripCriteria;
use Illuminate\Database\Seeder;

class PreTripCritTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            0 => [
                'name' => 'Sabuk Pengaman Kursi dan Bantalan Kursi, Sopir dan Semua Penumpang.',
                'desc' => 'Safety Belts, Seats, Mounting, Driver-Passengers',
            ],
            1 => [
                'name' => 'Ban, Minimum Kedalaman Ragi Ban 3 mm. Ban Serep kalau ada.',
                'desc' => 'Tire, Tread Depth Minimum 3 mm incl Spare tire if available.',
            ],
            2 => [
                'name' => 'Kaca Spion Dalam, Kiri dan Kanan.',
                'desc' => 'Rear View Mirror, Internal and Side.',
            ],
            3 => [
                'name' => 'Lampu Pengarah, Lampu Rem, Lampu Besar dan Lampu Kabut.',
                'desc' => 'Signal Light, Brake Lights, Head Lights and Fog Lamp.',
            ],
            4 => [
                'name' => 'Kipas Kaca, Kaca Depan dan Kaca Pintu.',
                'desc' => 'Windshield Wiper, Windshield Glass & Door Glass.',
            ],
            5 => [
                'name' => 'Rem Parkir dan Rem Kaki.',
                'desc' => 'Parking Brake & Service Brake.',
            ],
            6 => [
                'name' => 'Ukuran Kecepatan, Ukuran Kilometer,Klakson.',
                'desc' => 'Speedometer, Odometer, Horn.',
            ],
            7 => [
                'name' => 'Semua Kunci Pintu.',
                'desc' => 'All Door & Locks Conditions.',
            ],
            8 => [
                'name' => 'Pemadam Api Ringan 0.5 - 1kg.',
                'desc' => 'Firex - LV 0.5 - 1kg.',
            ],
            9 => [
                'name' => 'Perlengkapan Pertolongan Pertama (PP).',
                'desc' => 'First Aid Kit ( PP ).',
            ],
            10 => [
                'name' => 'Segitiga Pengaman, Dongkrak, Kunci Baut Roda.',
                'desc' => 'Safety Triangles, Jack, Wheel Lug Wrench.',
            ],
            11 => [
                'name' => 'SIM / Dokumen.',
                'desc' => 'Government License / Document.',
            ],
            12 => [
                'name' => 'System Pendingin.',
                'desc' => 'Air Conditioning System.',
            ],
            13 => [
                'name' => 'Kondisi Kabin : Karatan, Bocor Asap, Bocor Air.',
                'desc' => 'Cabin Condition: Excess Corrosion, Leaks Smoke, Water.',
            ],
            14 => [
                'name' => 'Minyak Mesin / Air Radiator / Tali Kipas/ Minyak Lainnya.',
                'desc' => 'Engine Oils/ Engine Coolant/ Drive Belts / Oils.',
            ],
            15 => [
                'name' => 'Kopling / Periksa Air Aki dan Terminalnya / Bahan Bakar.',
                'desc' => 'Clutch / Battery Levels and Terminals / Fuel.',
            ],
            16 => [
                'name' => 'Semua Rem / Baut Roda / Minyak Rem (selang minyak rem).',
                'desc' => 'All Brakes/ Wheel Nuts / Brake Fluid (Hose).',
            ],
            17 => [
                'name' => 'Sistem Kemudi / Penyetelan Semua Rem.',
                'desc' => 'All Steering /All Brake setting.',
            ],
            18 => [
                'name' => 'Bodi / Pengait Tutup Mesin.',
                'desc' => 'Body / Hood Safety Latch.',
            ],
            19 => [
                'name' => 'Tambahan Asesoris : Payung, Senter, Alarm Mundur.',
                'desc' => 'Additional Accessories : Umbrella, Flashlight, Reverse Alarm.',
            ],
        ];
        foreach ($data as $key => $value) {
            $record = new PreTripCriteria;
            $record->fill($value);
            $record->save();
        }
    }
}
