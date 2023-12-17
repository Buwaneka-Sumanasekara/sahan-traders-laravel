<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PmProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $item_specifics_html = '
        <div class="item-specifics">
          <h2>Item Specifics</h2>
          <div class="row">
            <div class="col-md-6">
              <ul>
                <li><strong>Condition:</strong> Used: An item that has been previously used. The item may have some signs of cosmetic wear, but is ... <a href="#">Read more about the condition</a></li>
                <li><strong>Maker:</strong> DAIHATSU</li>
                <li><strong>Brand:</strong> DAIHATSU</li>
                <li><strong>Model Code:</strong> DBA-L650S</li>
                <li><strong>Transmission:</strong> 4FT</li>
                <li><strong>Engine Model:</strong> EF-VE</li>
              </ul>
            </div>
            <div class="col-md-6">
              <ul>
                <li><strong>Engine Size:</strong> 660</li>
                <li><strong>Fuel:</strong> Gasoline / Petrol</li>
                <li><strong>Genuine Parts No:</strong> 87910B2240000</li>
                <li><strong>Body Type:</strong> 5HB</li>
                <li><strong>Trim No:</strong> FB10</li>
                <li><strong>Ext Color No:</strong> G37</li>
                <li><strong>Type Classification No:</strong> 4</li>
                <li><strong>Registered Month/Year:</strong> 1/2004</li>
                <li><strong>Mileage:</strong> 171373</li>
              </ul>
            </div>
          </div>
        </div>';

        $html2="<ul>
        <li><strong>OS:</strong> ColorOS 13 (based on Android 13)</li>
        <li><strong>CPU:</strong> Snapdragon 778G 5G 2.4GHz+1.8GHz (octa core)</li>
        <li><strong>RAM:</strong> 8GB</li>
        <li><strong>ROM:</strong> 256GB</li>
        <li><strong>Display:</strong> Approximately 6.7 inches (2412x1080)</li>
        <li><strong>Camera:</strong> Main approximately 50 million + 32 million + 8 million pixels / Approximately 32 million sub pixels</li>
        <li><strong>Wifi:</strong> a/b/g/n/ac/ax</li>
        <li><strong>Radio Band:</strong> 5G (n3/28/77/78)/4G (1/2/3/4/5/7/8/12/17/18/19/26/28/38/41/42)/3G (1/2/4/5/6/8/19)/GSM (850/900/1800/1900) MHz</li>
        <li><strong>Others:</strong> Bluetooth 5.2/GPS/NFC/Mobile wallet/face recognition/Fingerprint authentication/waterproof/dustproof</li>
        <li><strong>Size:</strong> Approximately 163(H) x 75(W) x 7.9(D)mm</li>
        <li><strong>Weight:</strong> Approximately 185g</li>
        <li><strong>Battery:</strong> 4600mAh</li>
        <li><strong>SIM size:</strong> nanoSIM x 2 + eSIM</li>
        <li><strong>External connection:</strong> Type-C</li>
    </ul>
    ";

        $ar_prods = [
            [
                "name" => "Left Tail Light SUBARU Impreza 2012 DBA-GJ7 84912FJ010",
                "note" => "Enhance the safety and style of your 2012 SUBARU Impreza DBA-GJ7 with Part Number 84912FJ010 Left Tail Light. This precision-engineered tail light not only fits seamlessly but also provides enhanced visibility, durability, and aesthetic appeal. It meets or exceeds OEM standards and is designed to endure various weather conditions. Elevate your vehicle's safety and appearance today!",
                "note_html" => "",
                "pm_group1_id" => "G1001",
                "pm_group2_id" => "G2010",
                "pm_group3_id" => "G3003",
                "pm_group4_id" => "G4008",
                "pm_group5_id" => "G5002",
                "cr_by_user_id" => config("global.default_admin_user_id"),
                "md_by_user_id" => config("global.default_admin_user_id"),
                "pm_unit_group_id" => config("global.default_unit_group_id"),
                "is_inquiry_item" => false,
                "prop_width" => 10,
                "prop_height" => 10,
                "prop_depth" => 10,
                'prop_weight' => 0,
                'ar_product_varients'=>[
                    ["name"=>"Default","sell_price"=>16342,"cost_price"=>10000]
                ]
            ],
            [
                "name" => "Right Tail Light SUBARU Impreza 2012 DBA-GJ7 84912FJ000",
                "note" => "Enhance the safety and style of your 2012 SUBARU Impreza DBA-GJ7 with Part Number 84912FJ010 Left Tail Light. This precision-engineered tail light not only fits seamlessly but also provides enhanced visibility, durability, and aesthetic appeal. It meets or exceeds OEM standards and is designed to endure various weather conditions. Elevate your vehicle's safety and appearance today!",
                "note_html" => "",
                "pm_group1_id" => "G1001",
                "pm_group2_id" => "G2010",
                "pm_group3_id" => "G3003",
                "pm_group4_id" => "G4008",
                "pm_group5_id" => "G5002",
                "cr_by_user_id" => config("global.default_admin_user_id"),
                "md_by_user_id" => config("global.default_admin_user_id"),
                "pm_unit_group_id" => config("global.default_unit_group_id"),
                "is_inquiry_item" => false,
                "prop_width" => 10,
                "prop_height" => 10,
                "prop_depth" => 10,
                'ar_product_varients'=>[
                    ["name"=>"Default","sell_price"=>16342,"cost_price"=>10000]
                ]
            ],
            [
                "name" => "Right Side Mirror DAIHATSU 2007 DBA-L650S 87910B2240",
                "note" => "Elevate the functionality and style of your 2007 DAIHATSU DBA-L650S with the Right Side Mirror (Part Number: 87910B2240). Designed to fit your vehicle flawlessly, this mirror provides not just an accurate fit but also enhances visibility and safety on the road. It's meticulously crafted for precision and meets or exceeds OEM standards, ensuring unwavering reliability and enduring performance. Seize the opportunity to enhance your vehicle's aesthetics and safety. Place your order now and enjoy improved vision and a rejuvenated appearance for your DAIHATSU!",
                "note_html" => $item_specifics_html,
                "pm_group1_id" => "G1001",
                "pm_group2_id" => "G2010",
                "pm_group3_id" => "G3002",
                "pm_group4_id" => "G4010",
                "pm_group5_id" => "G5002",
                "cr_by_user_id" => config("global.default_admin_user_id"),
                "md_by_user_id" => config("global.default_admin_user_id"),
                "pm_unit_group_id" => config("global.default_unit_group_id"),
                "is_inquiry_item" => false,
                "is_featured_product" => true,
                "prop_width" => 10,
                "prop_height" => 10,
                "prop_depth" => 10,
                'prop_weight' => 0,
                'ar_product_varients'=>[
                    ["name"=>"Default","sell_price"=>16342,"cost_price"=>10000]
                ]
            ],
            [
                "name" => "Suzuki Genuine Front Brake Pad",
                "note" => "Upgrade the stopping power and safety of your Suzuki vehicle with Suzuki Genuine Front Brake Pads. These brake pads are precision-engineered to provide optimal performance and reliability. Crafted using high-quality materials, they are designed to fit your Suzuki vehicle perfectly, ensuring a seamless installation process. With Suzuki Genuine Front Brake Pads, you can trust that your vehicle will have the braking power it needs to keep you safe on the road. Don't compromise on safety—choose Suzuki Genuine Front Brake Pads for peace of mind during every drive.",
                "note_html" => "",
                "pm_group1_id" => "G1001",
                "pm_group2_id" => "G2010",
                "pm_group3_id" => "G3004",
                "pm_group4_id" => "G4009",
                "pm_group5_id" => "G5002",
                "cr_by_user_id" => config("global.default_admin_user_id"),
                "md_by_user_id" => config("global.default_admin_user_id"),
                "pm_unit_group_id" => config("global.default_unit_group_id"),
                "is_inquiry_item" => false,
   
                "prop_width" => 10,
                "prop_height" => 10,
                "prop_depth" => 10,
                'ar_product_varients'=>[
                    ["name"=>"Default","sell_price"=>16342,"cost_price"=>10000]
                ]
            ],
            [
                "name" => "Mini excavator 12VXE",
                "note" => "Experience exceptional versatility and efficiency with the Mini Excavator 12VXE. This compact powerhouse is designed to tackle a wide range of excavation tasks with ease. Whether you're working on a construction site or landscaping project, this mini excavator offers precision and performance in a small package",
                "note_html" => "",
                "pm_group1_id" => "G1002",
                "pm_group2_id" => "G2002",
                "pm_group3_id" => "G3005",
                "pm_group4_id" => "G4011",
                "pm_group5_id" => "G5002",
                "cr_by_user_id" => config("global.default_admin_user_id"),
                "md_by_user_id" => config("global.default_admin_user_id"),
                "pm_unit_group_id" => config("global.default_unit_group_id"),
                "is_inquiry_item" => true,
                'is_featured_product' => true,
                "prop_width" => 10,
                "prop_height" => 10,
                "prop_depth" => 10,
                'ar_product_varients'=>[
                    ["name"=>"Default","sell_price"=>10118370,"cost_price"=>10015250]
                ]
            ],
            [
                "name" => "22 - 35T Medium Excavator",
                "note" => "Experience exceptional versatility and efficiency with the 22 - 35T Medium Excavator. This compact powerhouse is designed to tackle a wide range of excavation tasks with ease. Whether you're working on a construction site or landscaping project, this mini excavator offers precision and performance in a small package",
                "note_html" => "",
                "pm_group1_id" => "G1002",
                "pm_group2_id" => "G2002",
                "pm_group3_id" => "G3005",
                "pm_group4_id" => "G4011",
                "pm_group5_id" => "G5002",
                "cr_by_user_id" => config("global.default_admin_user_id"),
                "md_by_user_id" => config("global.default_admin_user_id"),
                "pm_unit_group_id" => config("global.default_unit_group_id"),
                "is_inquiry_item" => true,
                'is_featured_product' => true,
                "prop_width" => 10,
                "prop_height" => 10,
                "prop_depth" => 10,
                'ar_product_varients'=>[
                    ["name"=>"Default","sell_price"=>20118370,"cost_price"=>20015250]
                ]
            ],
            [
                "name" => "SAMSUNG GALAXY A21 (2020) (UNLOCKED)",
                "note" => "Elevate your mobile experience with the Samsung Galaxy A21 (2020) (Unlocked). This smartphone combines cutting-edge technology with sleek design, offering you a world of possibilities in the palm of your hand.",
                "note_html" => "",
                "pm_group1_id" => "G1003",
                "pm_group2_id" => "G2007",
                "pm_group3_id" => "G3000",
                "pm_group4_id" => "G4013",
                "pm_group5_id" => "G5001",
                "cr_by_user_id" => config("global.default_admin_user_id"),
                "md_by_user_id" => config("global.default_admin_user_id"),
                "pm_unit_group_id" => config("global.default_unit_group_id"),
                "is_inquiry_item" => false,
                "prop_width" => 10,
                "prop_height" => 10,
                "prop_depth" => 10,
                'ar_product_varients'=>[
                    ["name"=>"Default","sell_price"=>20118370,"cost_price"=>20015250]
                ]
            ],
            [
                "name" => "SAMSUNG GALAXY A21 (2020) (UNLOCKED)",
                "note" => "Elevate your mobile experience with the Samsung Galaxy A21 (2020) (Unlocked). This smartphone combines cutting-edge technology with sleek design, offering you a world of possibilities in the palm of your hand.",
                "note_html" => "",
                "pm_group1_id" => "G1003",
                "pm_group2_id" => "G2007",
                "pm_group3_id" => "G3000",
                "pm_group4_id" => "G4013",
                "pm_group5_id" => "G5001",
                "cr_by_user_id" => config("global.default_admin_user_id"),
                "md_by_user_id" => config("global.default_admin_user_id"),
                "pm_unit_group_id" => config("global.default_unit_group_id"),
                "is_inquiry_item" => false,
                "sell_price" => 24500,
                "cost_price" => 15000,
                "prop_width" => 10,
                "prop_height" => 10,
                "prop_depth" => 10,
                'ar_product_varients'=>[
                    ["name"=>"Default","sell_price"=>24500,"cost_price"=>15000]
                ]
            ],
            [
                "name" => "Geepas Kitchen Machine - 2 In 1 Electric Hand & Stand Mixer",
                "note" => "The Geepas Kitchen Machine is a 2 in 1 electric hand and stand mixer that is designed to make your cooking and baking experience easier and more efficient. It features a powerful 300W motor with 5 speed settings, allowing you to mix, whisk, and knead with ease. The stainless steel bowl has a capacity of 3.5L, which is perfect for making large batches of dough or batter. This kitchen machine also comes with a variety of attachments, including a dough hook, beater, and whisk, so you can create all sorts of delicious dishes. With its sleek design and compact size, this kitchen machine will fit seamlessly into any kitchen.",
                "note_html" => "",
                "pm_group1_id" => "G1007",
                "pm_group2_id" => "G2005",
                "pm_group3_id" => "G3006",
                "pm_group4_id" => "G4014",
                "pm_group5_id" => "G5002",
                "cr_by_user_id" => config("global.default_admin_user_id"),
                "md_by_user_id" => config("global.default_admin_user_id"),
                "pm_unit_group_id" => config("global.default_unit_group_id"),
                "is_inquiry_item" => false,
                'is_featured_product' => true,
                "prop_width" => 10,
                "prop_height" => 10,
                "prop_depth" => 10,
                'ar_product_varients'=>[
                    ["name"=>"Default","sell_price"=>48000,"cost_price"=>30000]
                ]
            ],
            [
                "name" => "Sauran 900W 100mm Angle Grinder with Accessories, MP-AG900 4.4",
                "note" => "The Sauran 900W 100mm Angle Grinder with Accessories, MP-AG900 4.4 is a powerful tool that can be used for a variety of tasks. It has a 900W motor and a 100mm grinding disc, which makes it perfect for cutting, grinding, and polishing. The grinder also comes with a variety of accessories, including a cutting disc, grinding disc, and polishing disc. This angle grinder is easy to use and has an ergonomic design that makes it comfortable to hold. It's also lightweight, so you can use it for long periods without getting tired. With its powerful motor and versatile design, this angle grinder is a must-have for any workshop or garage.",
                "note_html" => "",
                "pm_group1_id" => "G1006",
                "pm_group2_id" => "G2012",
                "pm_group3_id" => "G3007",
                "pm_group4_id" => "G4015",
                "pm_group5_id" => "G5002",
                "cr_by_user_id" => config("global.default_admin_user_id"),
                "md_by_user_id" => config("global.default_admin_user_id"),
                "pm_unit_group_id" => config("global.default_unit_group_id"),
                "is_inquiry_item" => false,
                "prop_width" => 10,
                "prop_height" => 10,
                "prop_depth" => 10,
                'ar_product_varients'=>[
                    ["name"=>"Default","sell_price"=>5500,"cost_price"=>3000]
                ]
            ],
            [
                "name" => "Black+Decker 6.5mm 400W VSR Orange Rotary Drill, BD65RD-IN",
                "note" => "BD65RD is low on power consumption and easy maintenance, with no compromise in performance. It has a 400-watt motor with a 6.5mm chuck. It has forward and reverse functions. Its lightweight and ergonomic design makes it easy to use for a long period of time. This Black and Decker 6.5 mm rotary drill has an ergonomic design and comes with variable speed and also has reversible options. This rotary drill has a stronger grip. It comes with 6 months of manufacturing warranty.",
                "note_html" => "",
                "pm_group1_id" => "G1006",
                "pm_group2_id" => "G2012",
                "pm_group3_id" => "G3008",
                "pm_group4_id" => "G4016",
                "pm_group5_id" => "G5002",
                "cr_by_user_id" => config("global.default_admin_user_id"),
                "md_by_user_id" => config("global.default_admin_user_id"),
                "pm_unit_group_id" => config("global.default_unit_group_id"),
                "is_inquiry_item" => false,
                "prop_width" => 10,
                "prop_height" => 10,
                "prop_depth" => 10,
                'prop_weight' => 0,
                'ar_product_varients'=>[
                    ["name"=>"Default","sell_price"=>4263.63,"cost_price"=>200.63]
                ]
            ],
            [
                "name" => "OPPO Reno10 Pro 5G SimFree Unlocked OpenLine",
                "note" => "sample note",
                "note_html" => $html2,
                "pm_group1_id" => "G1003",
                "pm_group2_id" => "G2007",
                "pm_group3_id" => "G3000",
                "pm_group4_id" => "G4017",
                "pm_group5_id" => "G5002",
                "cr_by_user_id" => config("global.default_admin_user_id"),
                "md_by_user_id" => config("global.default_admin_user_id"),
                "pm_unit_group_id" => config("global.default_unit_group_id"),
                "is_inquiry_item" => false,
                "prop_width" => 10,
                "prop_height" => 10,
                "prop_depth" => 10,
                'prop_weight' => 0,
                'ar_product_varients'=>[
                    ["name"=>"White","sell_price"=>39500.63,"cost_price"=>32500.63],
                    ["name"=>"Black","sell_price"=>38500.63,"cost_price"=>31500.63]
                ],
                'ar_additional_costs'=>[
                    ["name"=>"Normal wrap","amount"=>0],
                    ["name"=>"Additional wrap","amount"=>10]
                ]
            ],
        ];

        foreach ($ar_prods as $prod) {
            $prodObj = new \App\CustomModels\CusModel_Product();
            $prodObj->name = $prod["name"];
            $prodObj->note = $prod["note"];
            $prodObj->note_html = $prod["note_html"];
            $prodObj->pm_group1_id = $prod["pm_group1_id"];
            $prodObj->pm_group2_id = $prod["pm_group2_id"];
            $prodObj->pm_group3_id = $prod["pm_group3_id"];
            $prodObj->pm_group4_id = $prod["pm_group4_id"];
            $prodObj->pm_group5_id = $prod["pm_group5_id"];
            $prodObj->cr_by_user_id = $prod["cr_by_user_id"];
            $prodObj->md_by_user_id = $prod["md_by_user_id"];
            $prodObj->pm_unit_group_id = $prod["pm_unit_group_id"];
            $prodObj->is_inquiry_item = $prod["is_inquiry_item"];
            $prodObj->is_featured_product = isset($prod["is_featured_product"]) ? $prod["is_featured_product"] : false;

            $prodObj->prop_width = isset($prod["prop_width"]) ? $prod["prop_width"] : null;
            $prodObj->prop_height = isset($prod["prop_height"]) ? $prod["prop_height"] : null;
            $prodObj->prop_depth = isset($prod["prop_depth"]) ? $prod["prop_depth"] : null;
            $prodObj->prop_weight = isset($prod["prop_weight"]) ? $prod["prop_weight"] : null;

            $prodObj->ar_product_varients=isset($prod["ar_product_varients"])?$prod["ar_product_varients"]:[];
            $prodObj->ar_additional_costs=isset($prod["ar_additional_costs"])?$prod["ar_additional_costs"]:[];


            $prodObj->is_from_seeds = true; //only for seeds

            $prodObj->save();
        }
    }
}
