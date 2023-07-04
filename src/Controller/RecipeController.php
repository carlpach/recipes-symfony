<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class RecipeController extends AbstractController {

    #[Route("/recipe", name:"getPokemon")]
    public function getRecipe() {
        $recipe = [
            "code" => "466hf5",
            "name" => "Paella",
            "country" => "Spain",
            "image" => "https://www.recetasnestle.com.py/sites/default/files/styles/recipe_detail_desktop/public/srh_recipes/876038bcd1cf5abcaa28e86d9705eaf6.webp?itok=mayddXYO",
            "ingredients" => ["rice", "prawns"]
        ];

        return $this->render("Recipes/getRecipes.html.twig", ["recipe" => $recipe] );
    }

    #[Route("/recipes", name:"listRecipes")]
    public function getRecipes() {
        $listRecipes = [
            [
                "code" => "#0001",
                "name" => "Paella",
                "country" => "Spain",
                "image" => "https://www.recetasnestle.com.py/sites/default/files/styles/recipe_detail_desktop/public/srh_recipes/876038bcd1cf5abcaa28e86d9705eaf6.webp?itok=mayddXYO",
                "ingredients" => ["rice", "prawns"]
            ],
            [
                "code" => "#0002",
                "name" => "Gazpacho",
                "country" => "Spain",
                "image" => "https://www.recetasnestle.com.py/sites/default/files/styles/recipe_detail_desktop/public/srh_recipes/876038bcd1cf5abcaa28e86d9705eaf6.webp?itok=mayddXYO",
                "ingredients" => ["tomato", "olive oil"]
            ],
            [
                "code" => "#0003",
                "name" => "Pad Thai",
                "country" => "Thailand",
                "image" => "https://www.recetasnestle.com.py/sites/default/files/styles/recipe_detail_desktop/public/srh_recipes/876038bcd1cf5abcaa28e86d9705eaf6.webp?itok=mayddXYO",
                "ingredients" => ["rice", "prawns"]
            ],
        ];

        return $this->render("Recipes/listRecipes.html.twig", ["listRecipes" => $listRecipes] );
    }
}