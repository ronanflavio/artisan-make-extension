<?php

namespace App\DataTransferObjects;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

abstract class DataTransferObject
{
    public function toArray()
    {
        return (array) $this;
    }

    public static function fromRequest(FormRequest $request)
    {
        return self::montarObjeto($request->input());
    }

    public static function fromCollection(Collection $collection)
    {
        $lista = [];

        foreach ($collection as $item) {
            $lista[] = self::montarObjeto($item->toArray());
        }

        return $lista;
    }

    public static function fromModel(Model $model)
    {
        return self::montarObjeto($model->toArray());
    }

    public static function fromGeneric($obj)
    {
        return self::montarObjeto( (array) $obj );
    }

    protected static function montarObjeto(array $dados)
    {
        $class = get_called_class();
        $obj = new $class;

        foreach ($dados as $prop => $valor) {
            if (property_exists($obj, $prop)) {
                $obj->{$prop} = $valor;
            }
        }

        return $obj;
    }
}
