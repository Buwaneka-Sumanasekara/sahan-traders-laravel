<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PmGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Group1
        $ar_group1 = [
            ["id" => "G1001", "name" => "Spare parts", "active" => true],
            ["id" => "G1002", "name" => "Machinery", "active" => true],
            ["id" => "G1003", "name" => "Electronic", "active" => true],
            ["id" => "G1004", "name" => "Industrial Equipments", "active" => true],
            ["id" => "G1005", "name" => "Vehicle", "active" => true],
            ["id" => "G1006", "name" => "Tools & Outdoor equipments", "active" => true],
            ["id" => "G1007", "name" => "Home appliances", "active" => true],
        ];
        foreach ($ar_group1 as $group1) {
            \App\Models\PmGroup1::create($group1);
        }

        //Group2
        $ar_group2 = [
            ["id" => "G2000", "name" => "N/A", "active" => true],
            ["id" => "G2001", "name" => "General", "active" => true],
            ["id" => "G2002", "name" => "Construction", "active" => true],
            ["id" => "G2003", "name" => "Heavy", "active" => true],
            ["id" => "G2004", "name" => "Agriculture", "active" => true],
            ["id" => "G2005", "name" => "Kitchen", "active" => true],
            ["id" => "G2006", "name" => "House hold", "active" => true],
            ["id" => "G2007", "name" => "Mobile phones", "active" => true],
            ["id" => "G2008", "name" => "Water pump", "active" => true],
            ["id" => "G2009", "name" => "Hand tools", "active" => true],
            ["id" => "G2010", "name" => "Car", "active" => true],
            ["id" => "G2011", "name" => "Van", "active" => true],
            ["id" => "G2012", "name" => "Power tools", "active" => true],
        ];
        foreach ($ar_group2 as $group2) {
            \App\Models\PmGroup2::create($group2);
        }


        //Group3
        $ar_group3 = [
            ["id" => "G3000", "name" => "N/A", "active" => true],
            ["id" => "G3001", "name" => "Tools", "active" => true],
            ["id" => "G3002", "name" => "Side Mirrors", "active" => true],
            ["id" => "G3003", "name" => "Tail lights", "active" => true],
            ["id" => "G3004", "name" => "Brake pad", "active" => true],
            ["id" => "G3005", "name" => "Excavators", "active" => true],
            ["id" => "G3006", "name" => "Stand Mixers", "active" => true],
            ["id" => "G3007", "name" => "Grinders", "active" => true],
            ["id" => "G3008", "name" => "Drill Machine", "active" => true],
        ];
        foreach ($ar_group3 as $group3) {
            \App\Models\PmGroup3::create($group3);
        }

        //Group4
        $ar_group4 = [
            ["id" => "G4000", "name" => "N/A", "active" => true],
            ["id" => "G4001", "name" => "Toyota", "active" => true],
            ["id" => "G4002", "name" => "Nissan", "active" => true],
            ["id" => "G4003", "name" => "Sony", "active" => true],
            ["id" => "G4004", "name" => "Canon", "active" => true],
            ["id" => "G4005", "name" => "Fujifilm", "active" => true],
            ["id" => "G4006", "name" => "Nikon", "active" => true],
            ["id" => "G4007", "name" => "GoPro", "active" => true],
            ["id" => "G4008", "name" => "Subaru", "active" => true],
            ["id" => "G4009", "name" => "Suzuki", "active" => true],
            ["id" => "G4010", "name" => "Daihatsu", "active" => true],
            ["id" => "G4011", "name" => "Kato Imer", "active" => true],
            ["id" => "G4012", "name" => "Sany", "active" => true],
            ["id" => "G4013", "name" => "Samsung", "active" => true],
            ["id" => "G4014", "name" => "Geepas", "active" => true],
            ["id" => "G4015", "name" => "Sauran", "active" => true],
            ["id" => "G4016", "name" => "Black+Decker", "active" => true],
        ];
        foreach ($ar_group4 as $group4) {
            \App\Models\PmGroup4::create($group4);
        }

        //Group5
        $ar_group5 = [
            ["id" => "G5000", "name" => "N/A", "active" => true],
            ["id" => "G5001", "name" => "Used", "active" => true],
            ["id" => "G5002", "name" => "Brand new", "active" => true],
            ["id" => "G5003", "name" => "Auction", "active" => true],
        ];
        foreach ($ar_group5 as $group5) {
            \App\Models\PmGroup5::create($group5);
        }


        //Group mapping
        $ar_group_mapping = [
            ["pm_group1_id" => "G1001", "pm_group2_id" => "G2010", "pm_group3_id" => "G3002", "pm_group4_id" => "G4008", "pm_group5_id" => "G5002"],
            ["pm_group1_id" => "G1001", "pm_group2_id" => "G2010", "pm_group3_id" => "G3003", "pm_group4_id" => "G4008", "pm_group5_id" => "G5002"],
            ["pm_group1_id" => "G1001", "pm_group2_id" => "G2010", "pm_group3_id" => "G3002", "pm_group4_id" => "G4010", "pm_group5_id" => "G5002"],
            ["pm_group1_id" => "G1001", "pm_group2_id" => "G2010", "pm_group3_id" => "G3004", "pm_group4_id" => "G4009", "pm_group5_id" => "G5002"],

            ["pm_group1_id" => "G1002", "pm_group2_id" => "G2002", "pm_group3_id" => "G3005", "pm_group4_id" => "G4011", "pm_group5_id" => "G5002"],
            ["pm_group1_id" => "G1002", "pm_group2_id" => "G2010", "pm_group3_id" => "G3005", "pm_group4_id" => "G4012", "pm_group5_id" => "G5002"],

            ["pm_group1_id" => "G1003", "pm_group2_id" => "G2002", "pm_group3_id" => "G3005", "pm_group4_id" => "G4011", "pm_group5_id" => "G5002"],
            ["pm_group1_id" => "G1003", "pm_group2_id" => "G2007", "pm_group3_id" => "G3000", "pm_group4_id" => "G4013", "pm_group5_id" => "G5001"],

            ["pm_group1_id" => "G1007", "pm_group2_id" => "G2005", "pm_group3_id" => "G3006", "pm_group4_id" => "G4014", "pm_group5_id" => "G5002"],
            ["pm_group1_id" => "G1006", "pm_group2_id" => "G2012", "pm_group3_id" => "G3007", "pm_group4_id" => "G4015", "pm_group5_id" => "G5002"],
            ["pm_group1_id" => "G1006", "pm_group2_id" => "G2012", "pm_group3_id" => "G3008", "pm_group4_id" => "G4016", "pm_group5_id" => "G5002"],


        ];

        foreach ($ar_group_mapping as $group_mapping) {
            \App\Models\PmGroupMapping::create($group_mapping);
        }
    }
}
