<?php
namespace App\Helpers;

class Alias
{

    public static function generateAlias($tile)
    {
        //all delimiters
        $deleteCarater = array(".", ",", "/", "'", "\"", "`", "_", "!", "?");

        //replace spaces
        $tile = str_replace(' ',  '-', $tile);

        //replace delimiters
        $tile = str_replace($deleteCarater,  '', $tile);

        //replace romanian Letters
        $tile = str_replace('ă',  'a', $tile);
        $tile = str_replace('Ă',  'A', $tile);

        $tile = str_replace('î',  'i', $tile);
        $tile = str_replace('Î',  'I', $tile);

        $tile = str_replace('ș',  's', $tile);
        $tile = str_replace('Ș',  'S', $tile);

        $tile = str_replace('ț',  't', $tile);
        $tile = str_replace('Ț',  'T', $tile);

        $tile = str_replace('â',  'i', $tile);
        $tile = str_replace('Â',  'Â', $tile);

        return $tile;
    }
}