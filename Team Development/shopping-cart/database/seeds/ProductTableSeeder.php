<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Product([
            'imagePath' => 'https://static.tvtropes.org/pmwiki/pub/images/harrypotterandthegobletoffire.jpg',
            'title' => 'Harry Potter',
            'description' => 'Super cool - at least as a child.',
            'price' => 10.98
        ]);
        $product->save();
        $product = new \App\Product([
            'imagePath' => 'https://m.media-amazon.com/images/M/MV5BMzU0NDY0NDEzNV5BMl5BanBnXkFtZTgwOTIxNDU1MDE@._V1_.jpg',
            'title' => 'The Hobbit',
            'description' => 'Pick a fight with a dragon and win.',
            'price' => 20.98
        ]);
        $product->save();
        $product = new \App\Product([
            'imagePath' => 'https://m.media-amazon.com/images/M/MV5BN2EyZjM3NzUtNWUzMi00MTgxLWI0NTctMzY4M2VlOTdjZWRiXkEyXkFqcGdeQXVyNDUzOTQ5MjY@._V1_.jpg',
            'title' => 'The Lord of the Rings: The Fellowship of the Ring',
            'description' => 'Start on an adventure with friends',
            'price' => 10.97
        ]);
        $product->save();
        $product = new \App\Product([
            'imagePath' => 'https://s3-us-west-1.amazonaws.com/new-covers/3352+A+Tale+of+Two+Cities+Cover.jpg',
            'title' => 'A Tale of Two Cities',
            'description' => 'Story based around the time of the French Revolution',
            'price' => 30.98
        ]);
        $product->save();
        $product = new \App\Product([
            'imagePath' => 'https://thesmartlocal.com//images/easyblog_images/1854/LOTF---TTT-poster-credit-to-Metropolitan-Festival-Orchestra.jpg',
            'title' => 'The Lord of the Rings: Two Towers',
            'description' => 'Continuation of Frodo\'s adventure.',
            'price' => 10.97
        ]);
        $product->save();
    }
}
