<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class ProductsController extends AbstractController
{
    private array $products;

    public function __construct() {

        $this->products = [
            [
                'id' => 1,
                'title' => 'Playstation 5',
                'price' => 499.99,
                'price_reduction' => 0,
                'image' => 'https://gmedia.playstation.com/is/image/SIEPDC/ps5-product-thumbnail-01-en-14sep21?$facebook$',
                'categories' => ['console', 'sony']
            ],
            [
                'id' => 2,
                'title' => 'Xbox Series X',
                'price' => 499.99,
                'price_reduction' => 0,
                'image' => 'https://assets.xboxservices.com/assets/fb/d2/fbd2cb56-5c25-414d-9f46-e6a164cdf5be.png?n=XBX_A-BuyBoxBGImage01-D.png',
                'categories' => ['console', 'microsoft']
            ],
            [
                'id' => 3,
                'title' => 'Nintendo Switch',
                'price' => 299.99,
                'price_reduction' => 0,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/5/5e/Nintendo_Switch_Console.png',
                'categories' => ['console', 'nintendo']
            ],
            [
                'id' => 4,
                'title' => 'Playstation 4',
                'price' => 299.99,
                'price_reduction' => 199.99,
                'image' => 'https://gmedia.playstation.com/is/image/SIEPDC/ps4-product-thumbnail-01-en-14sep21?$facebook$',
                'categories' => ['console', 'sony']
            ],
            [
                'id' => 5,
                'title' => 'Xbox One',
                'price' => 299.99,
                'price_reduction' => 199.99,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2b/Microsoft-Xbox-One-Console-wKinect.png/800px-Microsoft-Xbox-One-Console-wKinect.png',
                'categories' => ['console', 'microsoft']
            ],
        ];
    }
    #[Route('/products', name: 'list_products')]
    public function listProducts()
    {




        return $this->render('products.html.twig', [
            'products' => $this->products
        ]);

    }




    #[Route('/product-show/{idProduct}', name: 'show_product')]
    public function showProduct($idProduct): Response
    {


        $productFound = null;

        foreach ($this->products as $product) {
            if($product['id'] === (int)$idProduct) {
                $productFound = $product;
            }
        }

        return $this->render('show_product.html.twig', [
            'product' => $productFound
        ]);



    }




}