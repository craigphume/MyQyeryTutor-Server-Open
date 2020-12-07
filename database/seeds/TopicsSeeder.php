<?php

use Illuminate\Database\Seeder;

class TopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topics')->insert([
            ['id' => 1,
                'name' => "SELECT - AS",
                'position' => 1
            ],
            ['id' => 2,
                'name' => "WHERE",
                'position' => 2
            ],
            ['id' => 3,
                'name' => "ORDER BY",
                'position' => 3
            ],
            ['id' => 4,
                'name' => "AGGREGATES",
                'position' => 4
            ],
            ['id' => 5,
                'name' => "GROUP BY",
                'position' => 5
            ],
            ['id' => 6,
                'name' => "JOINS",
                'position' => 6
            ],
            ['id' => 7,
                'name' => "SUB QUERIES",
                'position' => 7
            ]
        ]);

    }
}
