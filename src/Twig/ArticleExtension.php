<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 29/04/2019
 * Time: 15:55
 */

namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ArticleExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('trword',[$this,'truncateWords'])
        ] ;
    }

    public function truncateWords($word,$numberWords=100) {
        if(strlen($word)>$numberWords) {
            return substr($word,0,$numberWords)."....." ;
        }
        return $word ;
    }


}