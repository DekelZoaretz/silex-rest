<?php

use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
{

    /**
     * Count of user generated
     * 
     * @var int
     */
    private $userCount = 20;

    
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {

        ini_set('memory_limit', -1);
        
        /**
         * Creating a fake users
         */
        for ($i = 0 ;$i < $this->userCount; $i++) {


            $faker = Faker\Factory::create();

            $facebookProfile = (boolean)rand(0,1);
            $user = [
                'first_name'        => $faker->firstName,
                'last_name'         => $faker->lastName,
                'mobile'            => $faker->phoneNumber,
                'email'             => $faker->email,
                'unit'              => $faker->unique()->randomDigit,
                'birth_date'        => $faker->date($format = 'Y-m-d', $max = 'now'),
                'external_web_site' => $faker->url,
                'fb_token'          => ($facebookProfile) ? $faker->md5 : "",
                'about_me'          => $faker->realText(rand(10,20)),
                'experience'        => $faker->realText(rand(10,20)),
                'created_at'        => date('Y-m-d H:i:s'),
            ];
            $this->insert('users', $user);
        }






    }
}
