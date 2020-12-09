<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    /**
     *  Adding dummy articles
     */
    public function run()
    {
        DB::collection('articles')->delete();

        DB::collection('articles')->insert([
            'title' => 'Bhutan',
            'content' => '“We do not believe in Gross National Product. Gross National Happiness is more important”. And so the teenage King of Bhutan famously said in 1979. Since then, Gross National Happiness has become a Bhutanese philosophy.',
            'slug' => 'buthan',
            'creation_date' => new DateTime('2 days')
        ]);

        DB::collection('articles')->insert([
            'title' => 'Kazakhstan',
            'content' => 'The national drink is made from fermented horse milk (not urine as Borat would have you believe!); one of Kazakhstan’s most popular dishes, Kazy, is smoked horsemeat sausage; and the country’s most popular sport, “Buzkashi”, which literally means “grabbing the dead goat”, sees players on horseback vie for control of the “ball”, which, as the name suggests, is the headless carcass of a goat.',
            'slug' => 'kazakhstan',
            'creation_date' => new DateTime('3 days')
        ]);

        DB::collection('articles')->insert([
            'title' => 'North Korea',
            'content' => 'A proudly reclusive, quasi-communist state, no list of the world’s weirdest countries would be complete without North Korea. While Beijing is the only way for Western tourists to enter the country, once inside, it’s surprisingly safe, provided you toe the government’s line. You’ll be accompanied everywhere by two state-employed guides, and hear a somewhat questionable account of North Korea’s history. You’ll be under constant surveillance during your stay, and probably only see what the government wants you to see. Unsettling, yes, but it is a small preview of what life is like in the world’s most tightly controlled nation. Visas to North Korea are issued in Beijing, so this is where you should shop around for tours. Koryo Tours has been touring North Korea for 20 years, while Young Pioneer Tours is the go-to group for younger travellers.',
            'slug' => 'north-korea',
            'creation_date' => new DateTime('20 days')
        ]);

        DB::collection('articles')->insert([
            'title' => 'Belarus',
            'content' => 'After the fall of the Soviet Union, a cluster of countries in Eastern Europe pushed to join the EU. Enticed by grand promises from the continent’s big players, Belarus’s neighbours quickly signed up. But Belarus, nestled between Russia and Poland, bucked the trend and opted for isolation and reclusiveness, essentially turning its back on a united Europe. Off the radar of most travellers, a trip to Belarus offers a much-needed respite from the crowds of Europe’s more popular cities. Its capital, Minsk, has been burned down 18 times.',
            'slug' => 'belarus',
            'creation_date' => new DateTime('11 days')
        ]);
    }
}
