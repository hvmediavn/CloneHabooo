<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class ArticleController extends Controller
{
    /**
     * Render a specific view of Article set
     *
     * @param string $countryId
     * @param string $articleCategory
     * @return Response
     */
    public function many($countryId, $articleCategory)
    {
        $categoryName = strstr($articleCategory, '_') !== false
            ? str_replace('_', '-', substr($articleCategory, 0, strrpos($articleCategory, '_'))) : 'front';

        $categoryArray = explode('_', $articleCategory);

        $categoryPage = end($categoryArray);

        return response(view($categoryName == 'front' ? 'ArticlesFront' : 'ArticlesCategory', [
            'country' => $countryId,
            'category' => $categoryName,
            'page' => $categoryPage
        ]), 200)->header('Content-Type', 'text/html; charset=UTF-8');
    }

    /**
     * Render a specific view of a specific Article
     *
     * @param string $countryId
     * @param string $articleName
     * @return Response
     */
    public function one($countryId, $articleName)
    {
        $articleId = substr($articleName, 0, strpos($articleName, '_'));

        return response(view('ArticleView', [
            'country' => $countryId,
            'article' => $articleId
        ]), 200)->header('Content-Type', 'text/html; charset=UTF-8');
    }
}