<?php


use Phinx\Seed\AbstractSeed;

class DistanceSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'date' => $faker->dateTime($max = 'now', $timezone = null)->format("Y-m-d"),
                'name' => sha1($faker->userName),
                'quantity' => rand(1, 10),
                'distance' => rand(100, 1500),
            ];
        }

        $this->table('distance')->insert($data)->saveData();
    }
}
