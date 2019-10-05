<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class FansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //获取第一个用户
        $user = User::find('1');
        //OD=1之外的其它用户
        $followers = User::all()->slice('1');
        //ID=1关于其它的所有人
        $follower_ids = $followers->toArray();
        $user->friend($follower_ids);
        //所有人关于ID=1
        foreach ($followers as $follower) {
            $follower->friend($user->id);
        }
    }
}
