<?php


class Nettoyer
{
    public static function sanitize_string($var){
        return filter_var($var, FILTER_SANITIZE_STRING);
    }
}