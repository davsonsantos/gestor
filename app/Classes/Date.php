<?php

namespace App\Classes;

/**
 * Gerencia a data e hora da aplicação
 */
class Date
{

    /**
     * Recebe atrtavés do parâmetro $format o formato de data e hora e retorna através do tempo atual.
     *
     * @param  string $format Formato a ser retornado, por padrão está definido como Y-m-d H:i:s
     * @return string Retorna a data e hora atual de acordo com o formato informado no parâmetro.
     */
    public static function getCurrentDate(string $format = 'Y-m-d H:i:s'): string
    {
        return date($format);
    }
    
    /**
     * Recebe uma data e um formato e retorna a data e hora convertida.
     *
     * @param  string $date Data a ser convertida
     * @param  string $format Novo formato a ser convertido
     * @return string Retorna a data e hora atual de acordo com o formato informado no parâmetro.
     */
    public static function convertDate(string $date, string $format = 'Y-m-d H:i:s'): string
    {
        return date($format, strtotime($date));
    }
}
