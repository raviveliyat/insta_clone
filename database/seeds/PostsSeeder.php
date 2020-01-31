<?php
use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $post_pics = [
            'https://www.dhresource.com/0x0/f2/albu/g4/M00/12/49/rBVaEFmVotuAXou9AAL3rP5jSuc531.jpg',
            'https://previews.123rf.com/images/farang/farang1305/farang130500044/19595443-tropical-sea-scenery-square-composition.jpg',
            'http://www.digital-ladies-and-allies.org/upload/2018/01/22/3d-square-with-nature-landscape-wallpaper-murals-simple-scenery-nature-wall-murals-simple-l-659b5ed49819630a.jpg',
            'https://thumbs.dreamstime.com/z/vineyard-marlborough-new-zealand-square-beautiful-tucked-up-under-mountains-s-wine-growing-region-128373599.jpg',
            'https://www.dhresource.com/0x0/f2/albu/g4/M00/12/49/rBVaEFmVotuAXou9AAL3rP5jSuc531.jpg',
            'https://previews.123rf.com/images/farang/farang1305/farang130500044/19595443-tropical-sea-scenery-square-composition.jpg',
            'http://www.digital-ladies-and-allies.org/upload/2018/01/22/3d-square-with-nature-landscape-wallpaper-murals-simple-scenery-nature-wall-murals-simple-l-659b5ed49819630a.jpg',
            'https://thumbs.dreamstime.com/z/vineyard-marlborough-new-zealand-square-beautiful-tucked-up-under-mountains-s-wine-growing-region-128373599.jpg',
            'https://www.dhresource.com/0x0/f2/albu/g4/M00/12/49/rBVaEFmVotuAXou9AAL3rP5jSuc531.jpg',
            'https://previews.123rf.com/images/farang/farang1305/farang130500044/19595443-tropical-sea-scenery-square-composition.jpg',
            'http://www.digital-ladies-and-allies.org/upload/2018/01/22/3d-square-with-nature-landscape-wallpaper-murals-simple-scenery-nature-wall-murals-simple-l-659b5ed49819630a.jpg',
            'https://thumbs.dreamstime.com/z/vineyard-marlborough-new-zealand-square-beautiful-tucked-up-under-mountains-s-wine-growing-region-128373599.jpg',
        ];

        //
        $users = User::all(); //select * from users;

        foreach ($users as $user) {
            $posts = factory(Post::class, 10)->make();
            $i = 1;
            foreach ($posts as $post) {
                $post->user_id = $user->id;
                $post->post_pic_url = $post_pics[$i++];
                $post->save();
            }
        }
    }
}
