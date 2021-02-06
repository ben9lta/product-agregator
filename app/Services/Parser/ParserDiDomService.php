<?php


namespace App\Services\Parser;
use App\Models\Parser\DtoProductParser;
use DiDom\Document;

class ParserDiDomService
{
    /**
     * @var Document
     */
    private $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    private function getHtml($url, $isFile = false, $encoding = 'UTF-8')
    {
        $this->document = new Document($url, $isFile, $encoding);
    }

    public function parse($model, $url)
    {
        $this->getHtml($url, true, $model->option->encoding ?? 'UTF-8');
        $dto = new DtoProductParser($model);

        if($model->option->next_page) {
            $nextPage = $this->getNextPage($model);
            if($nextPage) {
                $this->parse($model, $nextPage);
            }
        }

        return $this->getData($dto);
    }

    private function getNextPage($model)
    {
        $nextPageSelector = $model->option->next_page;
        if($this->document->has($nextPageSelector))
        {
            $page = $this->document->first($nextPageSelector)->attr('href');
            return filter_var($page, FILTER_VALIDATE_URL) ? $page : $model->store->info . $page;
        }

        return null;
    }

    private function getData(DtoProductParser $dto)
    {
        $result = [];
        foreach ($dto as $attribute => $selector) {
            if(!empty($selector) && $attribute !== 'category_id' && $attribute !== 'store_id' )
            {
                $html = $this->document->find($selector);
                foreach ($html as $index => $element) {
                    switch ($attribute) {
                        case 'price':
                        case 'old_price':
                            $result[$index][$attribute] = (float)trim($element->text());
                            break;
                        case 'img':
                            $src = $element->attr('data-src') ?? $element->attr('src') ?? $element->attr('rel');
                             $result[$index][$attribute] = $src;
                            break;
                        default:
                            $result[$index][$attribute] = trim($element->firstChild()->text());
                            break;
                    }
                    $result[$index]['category_id'] = $dto->category_id;
                    $result[$index]['store_id']    = $dto->store_id;
                }
            }
        }

        foreach ($result as $key => $res)
        {
            if( empty($res['name']) )
            {
                unset($result[$key]);
            }
        }

        return $result;
    }


}
