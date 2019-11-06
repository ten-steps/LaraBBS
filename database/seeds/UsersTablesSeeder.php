<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facker = app(Faker\Generator::class);

        $avatars = [
            'https://avatars3.githubusercontent.com/u/41312704?s=460&v=4',
            'https://cdn.learnku.com/uploads/avatars/24327_1530087651.jpeg!/both/200x200',
        ];

        $users = factory(User::class)
            ->times(10)
            ->make()
            ->each(function ($user, $index) use ($facker, $avatars) {
                $user->avatar = $facker->randomElement($avatars);
            });
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();
        User::insert($user_array);

        $user = User::find(1);
        $user->name = '十步';
        $user->email = '1085530400@qq.com';
        $user->avatar = 'https://avatars3.githubusercontent.com/u/41312704?s=460&v=4';
        $user->save();
    }
}
