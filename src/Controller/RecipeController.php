<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Entity\Recipe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class RecipeController extends AbstractController {

    #[Route("/recipe/{id}", name:"getRecipe")]
    public function getRecipe(EntityManagerInterface $doctrine, $id) {

        // tell doctrine to get a specific repo/table
        $repo = $doctrine->getRepository(Recipe::class);
        // now make the query
        $recipe = $repo->find($id);
        // dd($recipe); // dd() shows in screen the object you pass

        return $this->render("Recipes/getRecipes.html.twig", ["recipe" => $recipe] );
    }

    #[Route("/listRecipe", name:"listRecipes")]
    public function listRecipes(EntityManagerInterface $doctrine) {
        
        // tell doctrine to get a specific repo/table
        $repo = $doctrine->getRepository(Recipe::class);
        // now make the query
        $listRecipes = $repo->findAll();

        return $this->render("Recipes/listRecipes.html.twig", ["listRecipes" => $listRecipes] );
    }

    #[Route("/insert/recipe", name:"insertRecipe")]
    public function insertRecipe(EntityManagerInterface $doctrine) {
    
        $recipe =new Recipe();
        $recipe->setName("Pizza");
        $recipe->setDescription("dish of Italian origin consisting of a flattened disk of bread dough topped with some combination of olive oil, oregano, tomato, olives, mozzarella or other cheese, and many other ingredients");
        $recipe->setImage("https://s2.abcstatics.com/media/gurmesevilla/2013/04/pizza-margarita.jpg");
        $recipe->setCode(5);

        $recipe2 =new Recipe();
        $recipe2->setName("Paella");
        $recipe2->setDescription("dish of Spanish origin consisting of...");
        $recipe2->setImage("https://www.recetasnestle.com.py/sites/default/files/styles/recipe_detail_desktop/public/srh_recipes/876038bcd1cf5abcaa28e86d9705eaf6.webp?itok=mayddXYO");
        $recipe2->setCode(6);

        $recipe3 =new Recipe();
        $recipe3->setName("Pad Thai");
        $recipe3->setDescription("dish of Thai origin consisting of...");
        $recipe3->setImage("https://assets.tmecosys.com/image/upload/t_web767x639/img/recipe/ras/Assets/7DE647CE-2E09-4CBE-88EE-CFFCC70D7440/Derivates/F8CA1C89-596A-4EC0-9A63-6505DDBD528C.jpg");
        $recipe3->setCode(7);

        $ingredient = new Ingredient();
        $ingredient->setName("tomato");

        $ingredient2 = new Ingredient();
        $ingredient2->setName("olive oil");

        $recipe->addIngredient($ingredient);
        $recipe->addIngredient($ingredient2);

        $doctrine->persist($recipe); // like git add
        $doctrine->persist($recipe2);
        $doctrine->persist($recipe3);

        $doctrine->persist($ingredient);
        $doctrine->persist($ingredient2);

        $doctrine->flush(); // like "git commit" to the db
    
        return new Response("Recipes and ingredients inserted correctly");
    }

    #[Route("/newRecipe", name: "newRecipe")]
    public function newRecipe(Request $request, EntityManagerInterface $doctrine) {
        // form we want to use
        $form = $this->createForm(recipeFormType::class);
        $form->handleRequest($request);

        // si han ellegado los datos y el formulario es valido:
        if ($form->isSubmitted() && $form->isValid()) {
            // retrieve form data
            $recipe = $form->getData(); // getData() returns an object with all the fields. Coming from file "RecipeFormType, function configureOptions
            $doctrine->persist($recipe);
            $doctrine->flush();
            
            $this ->addFlash("success", "receta insertada correctamente");

            // after adding new recipe go to:
            return $this->redirectToRoute("listaRecipe");

        }

        return $this->render("Recipes/addRecipe.html.twig", ["recipeForm"->$form]);
    }
}