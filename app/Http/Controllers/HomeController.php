<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Faker\Provider\Lorem;
use Illuminate\Http\Request;

class HomeController extends HomeProductController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->data['slider'] = [
            0 => [
                "title" => "T-Shirts",
                "subtitle" => "",
                "description" => "We are living through historic times for the T-shirt. The basic tee, once imbued so indelibly with ties to the counter-culture courtesy of associations with on-screen famous faces like Brando and Dean, is now so innocuous it's downright mainstream. These days, you could even say the T-shirt has become the de facto building block of the everyday outfit, long since replacing stuffier counterparts like the collared shirt, let alone (*checks notes*) the suit. All of which means there have never been more options to choose from. And while we're ever-thankful for the variety, it can sure get a little overwhelming.",
                "image" => 'tshirt.png'
            ],
            1 => [
                'title' => 'Jeans',
                'subtitle' => '',
                'description' => "Jeans are probably one of the most important investments you'll make in your signature style. You might have a job for which you wear them every single day or you might have to slip them on after you've slipped out of your nine-to-five suit. Either way, they're an item you'll wear more than any other you own.However, over the past decade something funny has happened to jeans. As their status as the workhorse of a man's armoury became cemented, they also became something of a starting point to an outfit, as opposed to the stars. The beauty of jeans is that they are a superb canvas upon which to build the rest of your get-up.",
                'image' => 'jeans.png'
            ],
            2 => [
                'title' => 'Suits',
                'subtitle' => '',
                'description' => "Every man should have a suit in his wardrobe. There we’ve said it.There really is no exception. Gay Talese, former journalist at the New Yorker, once said, “Putting on a beautifully designed suit elevates my spirit, extols my sense of self and helps define me as a man to whom details matter,” and it will do the exact same for you. Even if you don’t work in an office, whether for a wedding, job interview or funeral, it’s likely you’ll need a smart, tailored look at least once a year.",
                'image' => 'suit.png'
            ]
        ];
        $this->data['products'] = Product::getTopNewestProducts(6);
    }

    public function index()
    {
        //var_dump($request->get("idCat"));
        return view("pages.home",$this->data);
    }
}
