<?php


namespace App\Repository;


use App\Models\ParserOptions\ParserOptions;

class OptionRepository
{
    /**
     * @var ParserOptions
     */
    private $options;

    public function __construct(ParserOptions $options)
    {
        $this->options = $options;
    }

    public function query()
    {
        return $this->options::query();
    }

    public function with($relations = [])
    {
        return $this->query()->with($relations);
    }

    public function find($id)
    {
        return $this->query()->findOrFail($id);
    }
}
