<?php

namespace App\Parser\QueryParam;

use App\Parser\Parser;
use Core\Http\Response;
use DateTime;
use Throwable;

class DateTimeParser implements Parser
{
    /**
     * @var mixed $value
     */
    private $value;

    /**
     * DateTimeParser constructor.
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function parse()
    {
        try {
            if (is_numeric($this->value) && $date = date(DATE_FORMAT, $this->value)) { // handle timestamps
                return new DateTime($date);
            }

            if ($date = DateTime::createFromFormat(DATE_FORMAT, $this->value)) { // handle date times
                return $date;
            }

            Response::sendBadRequest(
                'The dates that you have applied are not valid.'
            );
        } catch (Throwable $exception) {
            throw new $exception(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }
}