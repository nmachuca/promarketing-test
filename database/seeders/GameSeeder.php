<?php

namespace Database\Seeders;

use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = [
            [
                'name' => 'BAMBOO RUSH',
                'url' => 'https://latamwin-gp3.discreetgaming.com/cwguestlogin.do?bankId=3006&gameId=806&lang=es',
                'image_url' => 'https://winchiletragamonedas.com/public/images/games/bamboo_rush.jpeg'
            ],
            [
                'name' => 'REELS OF WEALTH',
                'url' => 'https://latamwin-gp3.discreetgaming.com/cwguestlogin.do?bankId=3006&gameId=795&lang=es',
                'image_url' => 'https://winchiletragamonedas.com/public/images/games/reels_of_wealth.jpeg'
            ],
            [
                'name' => 'DRAGON & PHOENIX',
                'url' => 'https://latamwin-gp3.discreetgaming.com/cwguestlogin.do?bankId=3006&gameId=814&lang=es',
                'image_url' => 'https://winchiletragamonedas.com/public/images/games/dragon_phoenix.jpeg'
            ],
            [
                'name' => 'TAKE THE BANK',
                'url' => 'https://latamwin-gp3.discreetgaming.com/cwguestlogin.do?bankId=3006&gameId=813&lang=es',
                'image_url' => 'https://winchiletragamonedas.com/public/images/games/take_the_bank.jpeg'
            ],
            [
                'name' => 'CAISHEN’S ARRIVAL',
                'url' => 'https://latamwin-gp3.discreetgaming.com/cwguestlogin.do?bankId=3006&gameId=812&lang=es',
                'image_url' => 'https://winchiletragamonedas.com/public/images/games/caishens_arrival.jpeg'
            ],
            [
                'name' => 'GEMMED!',
                'url' => 'https://latamwin-gp3.discreetgaming.com/cwguestlogin.do?bankId=3006&gameId=811&lang=es',
                'image_url' => 'https://winchiletragamonedas.com/public/images/games/gemmed.jpeg'
            ]
        ];

        foreach ($games as $game) {
            $id = DB::table('games')->insertGetId([
                'name' => $game['name'],
                'url' => $game['name']
            ]);
            $_game = Game::find($id);
            $_game->addMediafromUrl($game['image_url']);
        }


    }
}
