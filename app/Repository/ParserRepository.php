<?php


namespace App\Repository;


use App\Models\Parser\Parser;

class ParserRepository
{
    /**
     * @var Parser
     */
    private $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function query()
    {
        return $this->parser::query();
    }

    public function with($relations = [])
    {
        return $this->query()->with($relations);
    }

    public function find($id)
    {
        return $this->query()->findOrFail($id);
    }

    public function whereActive()
    {
        return $this->query()->where('status', '=', 1);
    }

}
