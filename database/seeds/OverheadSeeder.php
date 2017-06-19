<?php

use GaziWorks\Performance\Data\Models\OverheadGroup;
use GaziWorks\Performance\Data\Models\OverheadTitle;
use Illuminate\Database\Seeder;

class OverheadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $overheads =
            [
                [
                    'id'          => 1,
                    'name'        => 'Raw Materials & Factory Expenses',
                    'description' => '',
                    'titles'      => [
                        [
                            'id'                => 1,
                            'name'              => 'Staff Salary & Bonus',
                            'description'       => '',
                            'type'              => 'fixed',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 2,
                            'name'              => 'Rent',
                            'description'       => '',
                            'type'              => 'fixed',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 3,
                            'name'              => 'Gas Bill',
                            'description'       => '',
                            'type'              => 'fixed',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 4,
                            'name'              => 'Electric Bill',
                            'description'       => '',
                            'type'              => 'fixed',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 5,
                            'name'              => 'Wasa Bill',
                            'description'       => '',
                            'type'              => 'fixed',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 6,
                            'name'              => 'Telephone & Mobile Bill',
                            'description'       => '',
                            'type'              => 'fixed',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 7,
                            'name'              => 'Direct Raw Materials',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 8,
                            'name'              => 'Direct Wages with Overtime',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 9,
                            'name'              => 'Water Tanks Jumnut',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 10,
                            'name'              => 'Indirect Materials (Fittings/Ink & others)',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 11,
                            'name'              => 'Rubber Washer',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 12,
                            'name'              => 'Trolly Materials',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 13,
                            'name'              => 'Product Making Cost/Purchased (Local)',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 14,
                            'name'              => 'Factory Insurance Premium',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 15,
                            'name'              => 'Factory Maintenance',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 16,
                            'name'              => 'Gas Generator Mart Expenses',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 17,
                            'name'              => 'Printing & Stationary',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 18,
                            'name'              => 'Entertainment',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 19,
                            'name'              => 'Micro & Motor Cycle Repair & Maintenance',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 20,
                            'name'              => 'Postage & Telegraph',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 21,
                            'name'              => 'Conveyance Bill',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 22,
                            'name'              => 'Misc. Expeneses',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 1,
                        ],
                        [
                            'id'                => 23,
                            'name'              => 'Medical Expenses',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 1,
                        ],
                    ],
                ],
                [
                    'id'          => 2,
                    'name'        => 'Administrative Expenses',
                    'description' => '',
                    'titles'      => [
                        [
                            'id'                => 24,
                            'name'              => 'Proprietors A/C',
                            'description'       => '',
                            'type'              => 'fixed',
                            'overhead_group_id' => 2,
                        ],
                        [
                            'id'                => 25,
                            'name'              => 'Staff Salary & Bonus',
                            'description'       => '',
                            'type'              => 'fixed',
                            'overhead_group_id' => 2,
                        ],
                        [
                            'id'                => 26,
                            'name'              => 'Repair & Maintenance - Car & M.C',
                            'description'       => '',
                            'type'              => 'fixed',
                            'overhead_group_id' => 2,
                        ],
                        [
                            'id'                => 27,
                            'name'              => 'Rent',
                            'description'       => '',
                            'type'              => 'fixed',
                            'overhead_group_id' => 2,
                        ],
                        [
                            'id'                => 28,
                            'name'              => 'Mobile & Telephone Bill',
                            'description'       => '',
                            'type'              => 'fixed',
                            'overhead_group_id' => 2,
                        ],
                        [
                            'id'                => 29,
                            'name'              => 'Office Maintenance',
                            'description'       => '',
                            'type'              => 'fixed',
                            'overhead_group_id' => 2,
                        ],
                        [
                            'id'                => 30,
                            'name'              => 'Electric Bill',
                            'description'       => '',
                            'type'              => 'fixed',
                            'overhead_group_id' => 2,
                        ],
                        [
                            'id'                => 31,
                            'name'              => 'Wasa Bill',
                            'description'       => '',
                            'type'              => 'fixed',
                            'overhead_group_id' => 2,
                        ],
                        [
                            'id'                => 32,
                            'name'              => 'Business Development',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 2,
                        ],
                        [
                            'id'                => 33,
                            'name'              => 'Expenses - Gazi Group',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 2,
                        ],
                        [
                            'id'                => 34,
                            'name'              => 'Office Maintenance',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 2,
                        ],
                        [
                            'id'                => 35,
                            'name'              => 'Donation & Subscription',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 2,
                        ],
                        [
                            'id'                => 36,
                            'name'              => 'General Expenses',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 2,
                        ],
                        [
                            'id'                => 37,
                            'name'              => 'Misc. Expenses',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 2,
                        ],
                        [
                            'id'                => 38,
                            'name'              => 'Entertainment',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 2,
                        ],
                        [
                            'id'                => 39,
                            'name'              => 'Printing & Stationary',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 2,
                        ],
                        [
                            'id'                => 40,
                            'name'              => 'Postage & Telegram',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 2,
                        ],
                        [
                            'id'                => 41,
                            'name'              => 'Conveyance Bill',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 2,
                        ],
                        [
                            'id'                => 42,
                            'name'              => 'Medical Expenses',
                            'description'       => '',
                            'type'              => 'variable',
                            'overhead_group_id' => 2,
                        ],
                        [
                            'id'                => 43,
                            'name'              => 'Fees & Renewals',
                            'description'       => '',
                            'type'              => 'provision',
                            'overhead_group_id' => 2,
                        ],
                    ],
                ],
            ];

        foreach ($overheads as $group)
        {
            $g = new OverheadGroup();
            $g->name = $group['name'];
            $g->description = $group['description'];
            $g->save();

            foreach ($group['titles'] as $title)
            {
                $o = new OverheadTitle();
                $o->name = $title['name'];
                $o->description = $title['description'];
                $o->type = $title['type'];
                $o->overhead_group_id = $g->id;
                $o->save();
            }
        }

    }
}
